<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;
use App\Project;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$projects = Project::all();
    	return view('admin.project.index')->with(['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|unique:projects',
            'project_image_header' => 'mimes:jpeg,jpg,gif,png',
            'project_image_ads' => 'mimes:jpeg,jpg,gif,png',
            'project_image_ads1' => 'mimes:jpeg,jpg,gif,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            $path = config('custom.project_image_path');
            $project_image_header = $request->file('project_image_header');
            $project_image_ads = $request->file('project_image_ads');
            $project_image_ads1 = $request->file('project_image_ads1');
            $project = New Project();
            if ($project_image_header) {
                $name = time() . '-' . create_slug($project_image_header->getClientOriginalName());
                $extention = $project_image_header->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_header->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_header = $path . '/' . $filename;
            }
            if ($project_image_ads) {
                $name = time(). '-' . create_slug($project_image_ads->getClientOriginalName());
                $extention = $project_image_ads->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_ads->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_ads = $path . '/' . $filename;
            }
            if ($project_image_ads1) {
                $name = time(). '-' . create_slug($project_image_ads1->getClientOriginalName());
                $extention = $project_image_ads1->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_ads1->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_ads1 = $path . '/' . $filename;
            }
            $project->project_name = $data['project_name'];
            $project->description = $data['description'];
            if (isset($data['is_current'])) {
                $project->is_current = 1;
            } else {
                $project->is_current = 0;
            }
            $project->page_title = $data['page_title'];
            $project->meta_keyword = $data['meta_keyword'];
            $project->meta_description = $data['meta_description'];
            $project->save();
            if ($project->is_current == 1) {
                $this->changeStatusOtherProject($project->id);
            }
            DB::commit();
            return redirect()->route('admin.project.index')->with('message','Success');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('admin.project.show')->with(['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('admin.project.edit')->with(['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|unique:projects,project_name,' . $id,
            'project_image_header' => 'mimes:jpeg,jpg,gif,png',
            'project_image_ads' => 'mimes:jpeg,jpg,gif,png',
            'project_image_ads1' => 'mimes:jpeg,jpg,gif,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            $path = config('custom.project_image_path');
            $oldImageHeader = $project->project_image_header;
            $oldImageAds = $project->project_image_ads;
            $project_image_header = $request->file('project_image_header');
            $project_image_ads = $request->file('project_image_ads');
            $project_image_ads1 = $request->file('project_image_ads1');
            if ($project_image_header) {
                $name = time() . '-' . create_slug($project_image_header->getClientOriginalName());
                $extention = $project_image_header->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_header->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_header = $path . '/' . $filename;
                // delete old image
                if ($oldImageHeader && file_exists(public_path($oldImageHeader))) {
                    unlink(public_path($oldImageHeader));
                }
            }
            if ($project_image_ads) {
                $name = time(). '-' . create_slug($project_image_ads->getClientOriginalName());
                $extention = $project_image_ads->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_ads->getRealPath())->save(public_path($path . '/' . $filename));
                    $project->project_image_ads = $path . '/' . $filename;
                // delete old image
                if ($oldImageAds && file_exists(public_path($oldImageAds))) {
                    unlink(public_path($oldImageAds));
                }
            }
            if ($project_image_ads1) {
                $name = time(). '-' . create_slug($project_image_ads1->getClientOriginalName());
                $extention = $project_image_ads1->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_ads1->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_ads1 = $path . '/' . $filename;
                // delete old image
                if ($oldImageAds && file_exists(public_path($oldImageAds))) {
                    unlink(public_path($oldImageAds));
                }
            }
            if (isset($data['is_current'])) {
                $project->is_current = 1;
            } else {
                $project->is_current = 0;
            }
            $project->project_name = $data['project_name'];
            $project->description = $data['description'];
            $project->page_title = $data['page_title'];
            $project->meta_keyword = $data['meta_keyword'];
            $project->meta_description = $data['meta_description'];
            $project->save();
            if ($project->is_current == 1) {
                $this->changeStatusOtherProject($project->id);
            }

            DB::commit();
            return redirect()->route('admin.project.index')->with('message','Success');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $project = Project::find($id);
            if ($project->delete()) {
                DB::table('positions')->where('project_id', $id)->delete();
                DB::table('grounds')->where('project_id', $id)->delete();
                DB::table('utilities')->where('project_id', $id)->delete();
                DB::table('prices_policies')->where('project_id', $id)->delete();
                DB::table('news')->where('project_id', $id)->delete();
                DB::table('images')->where('project_id', $id)->delete();
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                'error' => [
                    'message' => $ex->getMessage(),
                ]
            ]);
        }

        return response()->json();
    }

    public function changeStatusOtherProject($id)
    {
        DB::table('projects')->where('id', '<>', $id)->update(['is_current' => 0]);
    }
}
