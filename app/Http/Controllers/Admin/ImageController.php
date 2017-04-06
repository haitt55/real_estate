<?php

namespace App\Http\Controllers\Admin;

use App\Images;
use App\Project;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    protected $currentProject;

    function __construct()
    {
        $this->currentProject = Project::where('is_current', 1)->get()->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chosenProject = '';
        $projectOptions = DB::table('projects')->orderBy('created_at', 'desc')->pluck('project_name', 'id')->toArray();
        if ($this->currentProject) {
            $images = Images::all()->where('project_id', $this->currentProject->id)->sortByDesc('is_new');
            $chosenProject = $this->currentProject->id;
        } else {
            $chosenProject = '';
            $images = Images::all()->sortByDesc('created_at');
        }
        $data = $request->all();
        if (array_key_exists('project_id', $data)) {
            if ($request->get('project_id') != '') {
                $chosenProject = $request->get('project_id');
                $images = Images::all()->where('project_id', $request->get('project_id'))->sortByDesc('is_new');
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
