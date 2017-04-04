<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use App\Project;
use App\PricesPolicies;
use Illuminate\Support\Facades\DB;

class PricePoliciesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$pricePolicyList= DB::table('prices_policies')
		->join('projects', 'prices_policies.project_id', '=', 'projects.id')
		->select('prices_policies.id', 'prices_policies.title', 'prices_policies.project_id','prices_policies.updated_at', 'projects.project_name' )
		->get();
		return view ( 'admin.pricePolicy.index' )->with ( [
				'pricePolicyList' => $pricePolicyList
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
		return view ( 'admin.pricePolicy.create' )->with('projects', $projects);
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
			return Redirect::to('admin/pricePolicy/create')
			->withErrors($validator)
			;
		} else {
			// store
			$pricePolicy = new PricesPolicies();
			$pricePolicy->project_id  = Input::get ( 'project_id' );
			$pricePolicy->title = Input::get ( 'title' );
			$pricePolicy->slug = Input::get ( 'slug' );
			$pricePolicy->content = Input::get ( 'content' );
			$pricePolicy->page_title = Input::get ( 'page_title' );
			$pricePolicy->meta_keyword = Input::get ( 'meta_keyword' );
			$pricePolicy->meta_description = Input::get ( 'meta_description' );
			$pricePolicy->save ();
			
			// redirect
			return Redirect::to ( 'admin/pricePolicy' );
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
		$pricePolicy = PricesPolicies::find($id);
		
		// show the view and pass the nerd to it
		return view ( 'admin.pricePolicy.show' )->with ( [
				'pricePolicy' => $pricePolicy
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
		$pricePolicy = PricesPolicies::find($id);
		$projects = Project::pluck('project_name', 'id');
		// show the view and pass the nerd to it
		return view ( 'admin.pricePolicy.edit' )->with ( [
				'pricePolicy' => $pricePolicy, 'projects'=> $projects] );
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
			return Redirect::to('admin/pricePolicy/'. $id .'/edit')
			->withErrors($validator)
			;
		} else {
			// store
			$pricePolicy = PricesPolicies::find($id);
			$pricePolicy->project_id  = Input::get ( 'project_id' );
			$pricePolicy->title = Input::get ( 'title' );
			$pricePolicy->slug = Input::get ( 'slug' );
			$pricePolicy->content = Input::get ( 'content' );
			$pricePolicy->page_title = Input::get ( 'page_title' );
			$pricePolicy->meta_keyword = Input::get ( 'meta_keyword' );
			$pricePolicy->meta_description = Input::get ( 'meta_description' );
			$pricePolicy->save ();
			
			// redirect
			return Redirect::to ( 'admin/pricePolicy' );
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
			$pricePolicy = PricesPolicies::find($id);
			$pricePolicy->delete();
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
				$pricePolicy= PricesPolicies::where('project_id', '=', $request->input('projectId') , 'and id !=', $request->input('id'))->first();}
				else{
					$pricePolicy = PricesPolicies::where('project_id', '=', $request->input('projectId'))->first();
				}
			
			if($pricePolicy!= null){
				
				return response()->json(['code' => 1, 'pricePolicyId' => $pricePolicy->id]);
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
			
			$pricePolicy = PricesPolicies::where('project_id', '=', $request->input('projectId'))->first();
			$pricePolicy->delete();
			
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
