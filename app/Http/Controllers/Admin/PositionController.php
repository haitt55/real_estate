<?php

namespace App\Http\Controllers\Admin;

use App\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;

class PositionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$positions = Position::all ();
		return view ( 'admin.position.index' )->with ( [ 
				'positions' => $positions 
		] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		return view ( 'admin.position.create' );
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
		'slug' => 'required',
		'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
		return Redirect::to('position/create')
		->withErrors($validator)
		;
		} else {
		// store
		$position = new Position ();
		$position->project_id  = Input::get ( 'project_id' );
		$position->title = Input::get ( 'title' );
		$position->slug = Input::get ( 'slug' );
		$position->content = Input::get ( 'content' );
		$position->page_title = Input::get ( 'page_title' );
		$position->meta_keyword = Input::get ( 'meta_keyword' );
		$position->meta_description = Input::get ( 'meta_description' );
		$position->save ();
		
		// redirect
		return Redirect::to ( 'admin/position' );
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
		$position = Position::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.position.show' )->with ( [
				'position' => $position
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
		$position = Position::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.position.edit' )->with ( [
				'position' => $position
		] );
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
				'slug' => 'required',
				'content' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('position/create')
			->withErrors($validator)
			;
		} else {
			// store
			$position = Position::find($id);
			$position->project_id  = Input::get ( 'project_id' );
			$position->title = Input::get ( 'title' );
			$position->slug = Input::get ( 'slug' );
			$position->content = Input::get ( 'content' );
			$position->page_title = Input::get ( 'page_title' );
			$position->meta_keyword = Input::get ( 'meta_keyword' );
			$position->meta_description = Input::get ( 'meta_description' );
			$position->save ();
			
			// redirect
			return Redirect::to ( 'admin/position' );
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
        //
    	$position = Position::find($id);
    	$position->delete();
    	
    	// redirect
    	return Redirect::to('admin/position');
    }
}
