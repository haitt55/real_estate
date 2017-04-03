<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use App\Project;
use App\News;

class NewsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$newList = News::all ();
		return view ( 'admin.new.index' )->with ( [
				'newList' => $newList
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
		return view ( 'admin.new.create' )->with('projects', $projects);
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
			return Redirect::to('admin/new/create')
			->withErrors($validator)
			;
		} else {
			// store
			$new = new News();
			$new->project_id  = Input::get ( 'project_id' );
			$new->title = Input::get ( 'title' );
			$new->slug = Input::get ( 'slug' );
			$new->content = Input::get ( 'content' );
			$new->page_title = Input::get ( 'page_title' );
			$new->meta_keyword = Input::get ( 'meta_keyword' );
			$new->meta_description = Input::get ( 'meta_description' );
			$new->published= Input::get('published');
			$new->save ();
			
			// redirect
			return Redirect::to ( 'admin/new' );
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
		$new = News::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.new.show' )->with ( [
				'new' => $new
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
		$new = News::find($id);
		$projects = Project::pluck('project_name', 'id');
		// show the view and pass the nerd to it
		return view ( 'admin.new.edit' )->with ( [
				'new' => $new, 'projects'=> $projects] );
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
			return Redirect::to('admin/new/'. $id .'/edit')
			->withErrors($validator)
			;
		} else {
			// store
			$new = News::find($id);
			$new->project_id  = Input::get ( 'project_id' );
			$new->title = Input::get ( 'title' );
			$new->slug = Input::get ( 'slug' );
			$new->content = Input::get ( 'content' );
			$new->page_title = Input::get ( 'page_title' );
			$new->meta_keyword = Input::get ( 'meta_keyword' );
			$new->meta_description = Input::get ( 'meta_description' );
			$new->published = Input::get('published');
			$new->save ();
			
			// redirect
			return Redirect::to ( 'admin/new' );
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
			$new = News::find($id);
			$new->delete();
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
// 	public function checkProject(Request $request){
// 		try {
			
// 			$new = News::where('project_id', '=', $request->input('projectId'))->first();
// 			if($new!= null){
				
// 				return response()->json(['code' => 1, 'newId' => $new->id]);
// 			}
// 		} catch (Exception $ex) {
// 			event(new ExceptionOccurred($ex));
			
// 			return response()->json([
// 					'error' => [
// 							'message' => $ex->getMessage(),
// 					]
// 			]);
// 		}
		
// 	}
// 	public function delete(Request $request){
// 		try {
			
// 			$new = News::where('project_id', '=', $request->input('projectId'))->first();
// 			$new->delete();
			
// 			return response()->json(['code' => 1]);
			
// 		} catch (Exception $ex) {
// 			event(new ExceptionOccurred($ex));
			
// 			return response()->json([
// 					'error' => [
// 							'message' => $ex->getMessage(),
// 					]
// 			]);
// 		}
		
// 	}
}
