<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use App\Project;
use App\Grounds;

class GroundController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$groundList = Grounds::all ();
		return view ( 'admin.ground.index' )->with ( [
				'groundList' => $groundList
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
		return view ( 'admin.ground.create' )->with('projects', $projects);
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
			return Redirect::to('admin/ground/create')
			->withErrors($validator)
			;
		} else {
			// store
			$ground = new Grounds();
			$ground->project_id  = Input::get ( 'project_id' );
			$ground->title = Input::get ( 'title' );
			$ground->slug = Input::get ( 'slug' );
			$ground->content = Input::get ( 'content' );
			$ground->page_title = Input::get ( 'page_title' );
			$ground->meta_keyword = Input::get ( 'meta_keyword' );
			$ground->meta_description = Input::get ( 'meta_description' );
			$ground->save ();
			
			// redirect
			return Redirect::to ( 'admin/ground' );
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
		$ground = Grounds::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.ground.show' )->with ( [
				'ground' => $ground
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
		$ground = Grounds::find($id);
		$projects = Project::pluck('project_name', 'id');
		// show the view and pass the nerd to it
		return view ( 'admin.ground.edit' )->with ( [
				'ground' => $ground, 'projects'=> $projects] );
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
			return Redirect::to('admin/ground/'. $id .'/edit')
			->withErrors($validator)
			;
		} else {
			// store
			$ground = Grounds::find($id);
			$ground->project_id  = Input::get ( 'project_id' );
			$ground->title = Input::get ( 'title' );
			$ground->slug = Input::get ( 'slug' );
			$ground->content = Input::get ( 'content' );
			$ground->page_title = Input::get ( 'page_title' );
			$ground->meta_keyword = Input::get ( 'meta_keyword' );
			$ground->meta_description = Input::get ( 'meta_description' );
			$ground->save ();
			
			// redirect
			return Redirect::to ( 'admin/ground' );
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
			$ground = Grounds::find($id);
			$ground->delete();
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
				$ground= Grounds::where('project_id', '=', $request->input('projectId') , 'and id !=', $request->input('id'))->first();}
				else{
					$ground = Grounds::where('project_id', '=', $request->input('projectId'))->first();
				}
			
			if($ground!= null){
				
				return response()->json(['code' => 1, 'groundId' => $ground->id]);
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
			
			$ground = Grounds::where('project_id', '=', $request->input('projectId'))->first();
			$ground->delete();
			
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
