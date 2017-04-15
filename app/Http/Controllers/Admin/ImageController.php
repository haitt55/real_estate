<?php

namespace App\Http\Controllers\Admin;

use App\Images;
use App\MainProject;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    protected $currentProject;

    function __construct()
    {
        $this->currentProject = MainProject::where('is_current', 1)->get()->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chosenProject = '';
        $projectOptions = DB::table('main_projects')->orderBy('created_at', 'desc')->pluck('project_name', 'id')->toArray();
        if ($this->currentProject) {
            $images = Images::all()->where('project_id', $this->currentProject->id)->sortByDesc('created_at');
            $chosenProject = $this->currentProject->id;
        } else {
            $chosenProject = '';
            $images = Images::all()->sortByDesc('created_at');
        }
        $data = $request->all();
        if (array_key_exists('project_id', $data)) {
            if ($request->get('project_id') != '') {
                $chosenProject = $request->get('project_id');
                $images = Images::all()->where('project_id', $request->get('project_id'))->sortByDesc('created_at');
            } else {
                $chosenProject = '';
                $images = Images::all()->sortByDesc('created_at');
            }
        }
        return view('admin.image.index')->with([
            'images' => $images,
            'projectOptions' => $projectOptions,
            'currentProject' => $this->currentProject,
            'chosenProject' => $chosenProject
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = MainProject::where('id', $request->get('project_id'))->get()->first();
        $images = Images::all()->where('project_id', $request->get('project_id'))->sortByDesc('created_at');
        return view('admin.image.create')->with([
            'project' => $project,
            'images' => $images
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $imageObj = new Images();
            $image = $request->file('file');
            $path = config('custom.project_image_path');
            if ($image) {
                $name = time() . '-' . create_slug($image->getClientOriginalName());
                $extention = $image->getClientOriginalExtension();
                $filename = "{$name}.{$extention}";
                Image::make($image->getRealPath())->save(public_path($path . '/' . $filename));
                $imageObj->image = $path . '/' . $filename;
                $imageObj->title = $image->getClientOriginalName();
            }
            $imageObj->project_id = $request->get('project_id');
            $imageObj->save();
        } catch (\Exception $e) {
            unlink(public_path($imageObj->image));
            echo $e->getMessage();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
