<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use App\Project;
use App\Utilities;
use Illuminate\Support\Facades\DB;

class UtilitiesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$utilityList = DB::table('utilities')
		->join('projects', 'utilities.project_id', '=', 'projects.id')
		->select('utilities.id', 'utilities.title', 'utilities.project_id','utilities.updated_at', 'projects.project_name' )
		->get();
		return view ( 'admin.utility.index' )->with ( [
				'utilityList' => $utilityList
		] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$projects = Project::pluck('project_name', 'id');
		return view ( 'admin.utility.create' )->with('projects', $projects);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		$rules = array(
				'project_id' => 'required|numeric',
				'title' => 'required',
				'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('admin/utility/create')
			->withErrors($validator)
			;
		} else {
			// store
			$utility = new Utilities();
			$utility->project_id  = Input::get ( 'project_id' );
			$utility->title = Input::get ( 'title' );
			$utility->slug = Input::get ( 'slug' );
			$utility->content = Input::get ( 'content' );
			$utility->page_title = Input::get ( 'page_title' );
			$utility->meta_keyword = Input::get ( 'meta_keyword' );
			$utility->meta_description = Input::get ( 'meta_description' );
			$utility->save ();
			
			// redirect
			return Redirect::to ( 'admin/utility' );
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		$utility = Utilities::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.utility.show' )->with ( [
				'utility' => $utility
		] );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$utility = Utilities::find($id);
		$projects = Project::pluck('project_name', 'id');
		// show the view and pass the nerd to it
		return view ( 'admin.utility.edit' )->with ( [
				'utility' => $utility, 'projects'=> $projects] );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
		$rules = array(
				'project_id' => 'required|numeric',
				'title' => 'required',
				'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('admin/utility/'. $id .'/edit')
			->withErrors($validator)
			;
		} else {
			// store
			$utility = Utilities::find($id);
			$utility->project_id  = Input::get ( 'project_id' );
			$utility->title = Input::get ( 'title' );
			$utility->slug = Input::get ( 'slug' );
			$utility->content = Input::get ( 'content' );
			$utility->page_title = Input::get ( 'page_title' );
			$utility->meta_keyword = Input::get ( 'meta_keyword' );
			$utility->meta_description = Input::get ( 'meta_description' );
			$utility->save ();
			
			// redirect
			return Redirect::to ( 'admin/utility' );
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
			//            DB::table('users')->where('votes', '>', 100)->delete();
			$utility = Utilities::find($id);
			$utility->delete();
		} catch (Exception $ex) {
			event(new ExceptionOccurred($ex));
			
			return response()->json([
					'error' => [
							'message' => $ex->getMessage(),
					]
			]);
		}
		
		return response()->json();
	}
	public function checkProject(Request $request){
		try {
			if($request->input('id') != null){
				$utility= Utilities::where('project_id', '=', $request->input('projectId') , 'and id !=', $request->input('id'))->first();}
				else{
					$utility = Utilities::where('project_id', '=', $request->input('projectId'))->first();
				}
			
			if($utility!= null){
				
				return response()->json(['code' => 1, 'utilityId' => $utility->id]);
			}
		} catch (Exception $ex) {
			event(new ExceptionOccurred($ex));
			
			return response()->json([
					'error' => [
							'message' => $ex->getMessage(),
					]
			]);
		}
		
	}
	public function delete(Request $request){
		try {
			
			$utility = Utilities::where('project_id', '=', $request->input('projectId'))->first();
			$utility->delete();
			
			return response()->json(['code' => 1]);
			
		} catch (Exception $ex) {
			event(new ExceptionOccurred($ex));
			
			return response()->json([
					'error' => [
							'message' => $ex->getMessage(),
					]
			]);
		}
		
	}
}
