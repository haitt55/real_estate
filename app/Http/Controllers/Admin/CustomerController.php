<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CustomerController extends Controller
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
            $customers = Customer::all()->where('product_id', $this->currentProject->id)->sortByDesc('is_new');
            $chosenProject = $this->currentProject->id;
        } else {
            $chosenProject = '';
            $customers = Customer::all()->sortByDesc('is_new');
        }
        $data = $request->all();
        if (array_key_exists('project_id', $data)) {
            if ($request->get('project_id') !== '') {
                $chosenProject = $request->get('project_id');
                $customers = Customer::all()->where('product_id', $request->get('project_id'))->sortByDesc('is_new');
            } else {
                $chosenProject = '';
                $customers = Customer::all()->sortByDesc('is_new');
            }
        }
        return view('admin.customer.index')->with([
            'customers' => $customers,
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

    public function changeStatus(Request $request)
    {

    }
}
