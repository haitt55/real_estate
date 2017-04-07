<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Psy\Util\Json;
use Illuminate\Support\Facades\DB;
use App\Position;
use App\Grounds;
use App\Utilities;
use App\PricesPolicies;
use App\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$project = DB::table('projects')->where('is_current', '=', 1)
    	->first();
    	
    	return view('home.index')->with ( [
    			'project' => $project]);
    }
    public function position($slug)
    {
    	$position = Position::where('slug', $slug)->firstOrFail();
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.position' )->with ( [
    			'position' => $position
    	] );
    }
    public function ground($slug)
    {
    	$ground= Grounds::where('slug', $slug)->firstOrFail();
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.ground' )->with ( [
    			'ground' => $ground
    	] );
    }
    public function utility($slug)
    {
    	$utility= Utilities::where('slug', $slug)->firstOrFail();
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.utility' )->with ( [
    			'utility' => $utility
    	] );
    }
    public function pricePolicy($slug)
    {
    	$pricePolicy= PricesPolicies::where('slug', $slug)->firstOrFail();
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.pricePolicy' )->with ( [
    			'pricePolicy' => $pricePolicy
    	] );
    }
    public function newpost($slug)
    {
    	$news= News::where('slug', $slug)->firstOrFail();;
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.new' )->with ( [
    			'news' => $news
    	] );
    }
    public function newlist()
    {
    	$news= $project = DB::table('news')
    	->join('projects', 'projects.id' ,'=','news.project_id')
    	->where('news.published', 1 )
    	->where('projects.is_current' , 1)
    	->get();;
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.news' )->with ( [
    			'news' => $news
    	] );
    }
    public function getCurrentProject()
    {
    	try {
    		
    		$project = DB::table('projects')
    		->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    		->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    		->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    		->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    		->select('projects.id as projectId', 'projects.project_name', 'projects.project_image_header', 'positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    		->where('is_current', '=', 1)
    		->get()
    		->first();
    		
    		$news = DB::table('news')
    		->where('project_id','=' , $project->projectId,'and', 'published = 1')
    		->orderBy('created_at', 'desc')
    		->limit(3)
    		->get();
    		
    			if($project!= null){
    				return response()->json(['code' => 1, 'project' => $project, 'news' => $news
    				]);
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
}
