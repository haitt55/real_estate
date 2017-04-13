<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;
use App\Project;
use App\MainProject;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Images;

class MainProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$mainProjects = MainProject::all();
    	return view('admin.main_project.index')->with(['mainProjects' => $mainProjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main_project.create');
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
            'project_image_logo' => 'mimes:jpeg,jpg,gif,png',
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
            $project_image_logo = $request->file('project_image_logo');
            $project_image_header = $request->file('project_image_header');
            $project_image_ads = $request->file('project_image_ads');
            $project_image_ads1 = $request->file('project_image_ads1');
            $project = New MainProject();
            if ($project_image_logo) {
                $name = time() . '-' . create_slug($project_image_logo->getClientOriginalName());
                $extention = $project_image_logo->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_logo->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_logo = $path . '/' . $filename;
            }
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
            return redirect()->route('admin.main_project.index')->with('message','Success');
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
        $mainProject = MainProject::find($id);
        return view('admin.main_project.show')->with(['mainProject' => $mainProject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainProject = MainProject::find($id);
        $images = Images::all()->where('project_id', $id)->sortByDesc('created_at');
        return view('admin.main_project.edit')->with(['mainProject' => $mainProject, 'images' => $images]);
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
        $project = MainProject::find($id);
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|unique:projects,project_name,' . $id,
            'project_image_logo' => 'mimes:jpeg,jpg,gif,png',
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
            $oldImageLogo = $project->project_image_logo;
            $oldImageHeader = $project->project_image_header;
            $oldImageAds = $project->project_image_ads;
            $oldImageAds1 = $project->project_image_ads1;
            $project_image_header = $request->file('project_image_header');
            $project_image_logo = $request->file('project_image_logo');
            $project_image_ads = $request->file('project_image_ads');
            $project_image_ads1 = $request->file('project_image_ads1');
            if ($project_image_logo) {
                $name = time() . '-' . create_slug($project_image_logo->getClientOriginalName());
                $extention = $project_image_logo->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($project_image_logo->getRealPath())->save(public_path($path . '/' . $filename));
                $project->project_image_logo = $path . '/' . $filename;
                // delete old image
                if ($oldImageLogo && file_exists(public_path($oldImageLogo))) {
                    unlink(public_path($oldImageLogo));
                }
            }
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
                if ($oldImageAds1 && file_exists(public_path($oldImageAds1))) {
                    unlink(public_path($oldImageAds1));
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
            return redirect()->route('admin.main_project.index')->with('message','Success');
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
            $project = MainProject::find($id);
            if ($project->delete()) {
                DB::table('progress')->where('main_project_id', $id)->delete();
                DB::table('projects')->where('main_project_id', $id)->delete();
                DB::table('images')->where('main_project_id', $id)->delete();
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
        DB::table('main_projects')->where('id', '<>', $id)->update(['is_current' => 0]);
    }
}
