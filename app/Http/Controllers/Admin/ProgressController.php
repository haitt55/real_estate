<?php

namespace App\Http\Controllers\Admin;

use App\Progress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use App\MainProject;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
// 		$progress = Progress::all ();
		$progress = DB::table('progress')
		->join('main_projects', 'progress.main_project_id', '=', 'main_projects.id')
		->select('progress.id', 'progress.title', 'progress.main_project_id','progress.updated_at', 'main_projects.project_name','progress.slug' )
		->get();
		return view ( 'admin.progress.index' )->with ( [
				'progress' => $progress
		] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$projects = MainProject::all()->sortByDesc('is_current')->pluck('project_name', 'id');
		return view ( 'admin.progress.create' )->with('projects', $projects);
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
		'main_project_id' => 'required|numeric',
		'title' => 'required',
		'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
		    dd($validator->messages());
		return Redirect::to('admin/progress/create')
		->withErrors($validator)
		;
		} else {
		// store
		$progress = new Progress ();
		$progress->main_project_id  = Input::get ( 'main_project_id' );
		$progress->title = Input::get ( 'title' );
		$progress->slug = Input::get ( 'slug' );
		$progress->content = Input::get ( 'content' );
		$progress->page_title = Input::get ( 'page_title' );
		$progress->meta_keyword = Input::get ( 'meta_keyword' );
		$progress->meta_description = Input::get ( 'meta_description' );
		$progress->save ();
		
		// redirect
		return Redirect::to ( 'admin/progress' );
 		 }
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		//
		$progress = Progress::where('slug', $slug)->firstOrFail();
		
		// show the view and pass the nerd to it
		return view ( 'admin.progress.show' )->with ( [
				'progress' => $progress
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
		$progress = Progress::find($id);
		$projects = MainProject::pluck('project_name', 'id');
		// show the view and pass the nerd to it
		return view ( 'admin.progress.edit' )->with ( [
				'progress' => $progress, 'projects'=> $projects] );
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
				'main_project_id' => 'required|numeric',
				'title' => 'required',
				'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('admin/progress/'. $id .'/edit')
			->withErrors($validator)
			;
		} else {
			// store
			$progress = Progress::find($id);
			$progress->main_project_id  = Input::get ( 'main_project_id' );
			$progress->title = Input::get ( 'title' );
			$progress->slug = Input::get ( 'slug' );
			$progress->content = Input::get ( 'content' );
			$progress->page_title = Input::get ( 'page_title' );
			$progress->meta_keyword = Input::get ( 'meta_keyword' );
			$progress->meta_description = Input::get ( 'meta_description' );
			$progress->save ();
			
			// redirect
			return Redirect::to ( 'admin/progress' );
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
    		$progress = Progress::find($id);
    		$progress->delete();
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
    		$progress = Progress::where('main_project_id', '=', $request->input('projectId') , 'and id !=', $request->input('id'))->first();}
    		else{
    			$progress = Progress::where('main_project_id', '=', $request->input('projectId'))->first();
    		}
    		if($progress!= null){
    			
    			return response()->json(['code' => 1, 'progressId' => $progress->id]);
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
    		
    		$progress = Progress::where('main_project_id', '=', $request->input('projectId'))->first();
    		$progress->delete();
    		
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
