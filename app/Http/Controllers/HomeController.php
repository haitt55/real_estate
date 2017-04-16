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
use App\AppSetting;
use App\Customer;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public $cookie;
	public $appSetting;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->currentProject = DB::table('main_projects')->where('is_current', '=', 1)
            ->first();
        $this->appSetting = AppSetting::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mainIndex(){
    	$mainProject = DB::table('main_projects')->get()->first();
    	$projects =DB::table('projects')->where('main_project_id', $mainProject->id)->get();
    	return view('home.mainIndex')->with([
    	    'appSetting' => $this->appSetting,
    	    'mainProject'=> $mainProject,
            'projects'=>$projects
        ]);
    }
    
    
    public function index($id)
    {
    	$project = DB::table('projects')
    	->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    	->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    	->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    	->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    	->select('projects.id as projectId', 'projects.project_name','projects.description','projects.project_image_ads',
    			'projects.project_image_ads1','projects.page_title','projects.meta_keyword','projects.meta_description',
    			'projects.project_image_header', 'positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    	->where('is_current', '=', 1)
    	->where('projects.id','=',$id)
    	->get()
    	->first();
    	
    	return view('home.index')->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'project' => $project]);
    }
    public function position($id, $slug)
    {
    	if($slug == 'default'){
    		$position = new Position();
    	}else {
    		$position = Position::where('slug', $slug)->where('project_id', $id)->firstOrFail();
    	}
    	$project = DB::table('projects')
    	->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    	->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    	->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    	->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    	->select('projects.id as projectId', 'positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    			->where('is_current', '=', 1)
    			->where('projects.id','=',$id)
    			->get()
    			->first();
    	// show the view and pass the nerd to it
    	return view ( 'home.position' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'position' => $position,
                'project' => $project
    	] );
    }
    public function ground($id, $slug)
    {
    	if($slug == 'default'){
    		$ground= new Grounds();
    	}else {
    		$ground= Grounds::where('slug', $slug)->where('project_id', $id)->firstOrFail();
    	}
    	$project = DB::table('projects')
    	->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    	->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    	->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    	->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    	->select('projects.id as projectId', 'projects.project_name','positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    			->where('is_current', '=', 1)
    			->where('projects.id','=',$id)
    			->get()
    			->first();
    	// show the view and pass the nerd to it
    	return view ( 'home.ground' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'ground' => $ground,
            'project' => $project
    	] );
    }
    public function utility($id, $slug)
    {
    	if($slug == 'default'){
    		$utility= new Utilities();
    	}else {
    		$utility= Utilities::where('slug', $slug)->where('project_id', $id)->firstOrFail();
    	}
    	$project = DB::table('projects')
    	->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    	->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    	->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    	->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    	->select('projects.id as projectId', 'projects.project_name','positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    			->where('projects.id','=',$id)
    			->get()
    			->first();
    	// show the view and pass the nerd to it
    	return view ( 'home.utility' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'utility' => $utility,
            'project' => $project
    	] );
    }
    public function pricePolicy($id, $slug)
    {
    	if($slug == 'default'){
    		$pricePolicy= new PricesPolicies();
    	}else {
    		$pricePolicy= PricesPolicies::where('slug', $slug)->where('project_id', $id)->firstOrFail();
    	}
    	$project = DB::table('projects')
    	->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    	->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    	->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    	->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    	->select('projects.id as projectId', 'projects.project_name','positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    			->where('is_current', '=', 1)
    			->where('projects.id','=',$id)
    			->get()
    			->first();
    	// show the view and pass the nerd to it
    	return view ( 'home.pricePolicy' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'pricePolicy' => $pricePolicy,
            'project' => $project
    	] );
    }
    public function newpost($slug)
    {
    	$news= News::where('slug', $slug)->firstOrFail();;
    	$anotherNew = News::where('slug','!=', $slug)->get();
    	// show the view and pass the nerd to it
    	return view ( 'home.new' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'news' => $news, 'anotherNew' => $anotherNew,
            'project' => $this->currentProject
    	] );
    }
    public function newlist()
    {
    	$news= $project = DB::table('news')
    	->join('main_projects', 'main_projects.id' ,'=','news.project_id')
    	->where('news.published', 1 )
    	->where('main_projects.is_current' , 1)
    	->get();;
    	
    	// show the view and pass the nerd to it
    	return view ( 'home.news' )->with ( [
            'appSetting' => $this->appSetting,
            'mainProject'=> $this->currentProject,
    			'news' => $news,
            'project' => $this->currentProject
    	] );
    }
    public function getCurrentProject(Request $request)
    {
    	try {
    		
    		$project = DB::table('projects')
    		->leftjoin('positions', 'positions.project_id', '=', 'projects.id')
    		->leftjoin('grounds', 'grounds.project_id', '=', 'projects.id')
    		->leftjoin('utilities', 'utilities.project_id', '=', 'projects.id')
    		->leftjoin('prices_policies', 'prices_policies.project_id', '=', 'projects.id')
    		->select('projects.id as projectId', 'projects.project_name', 'projects.project_image_header', 'positions.slug as position_slug', 'grounds.slug as ground_slug', 'utilities.slug as utility_slug', 'prices_policies.slug as pricePolicy_slug')
    		->where('is_current', '=', 1)
    		->where('projects.id','=',$request->input('id'))
    		->get()
    		->first();
    		
    		
    			if($project!= null){
    				return response()->json(['code' => 1, 'project' => $project
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
    
    public function addCustomer( Request $request){
    	try{
    	$customer = new Customer();
    	$customer->full_name  = $request->input('full_name');
    	$customer->email = $request->input('email');
    	$customer->phone_number = $request->input('phone_number');
    	$customer->message = $request->input('message');
    	$customer->project_id = $request->input('project_id');
    	
    	
    	$customer->save ();
    	return response()-> json(['code' => 1]);
    	}catch (Exception $ex) {
    		event(new ExceptionOccurred($ex));
    		
    		return response()->json([
    				'error' => [
    						'message' => $ex->getMessage(),
    				]
    		]);
    	}
    }
    
    public function getMainProject()
    {
    	try {
    		
    		$main_project = DB::table('main_projects')
    		->where('is_current', '=', 1)
    		->get()
    		->first();
    		$id  = $main_project->id;
    		$project = DB::table('projects')->where('main_project_id', $main_project->id)->get();
    		$news = DB::table('news')
    		->where('project_id','=' , $id,'and', 'published = 1')
    		->orderBy('created_at', 'desc')
    		->limit(3)
    		->get();
    		$appSetting = AppSetting::all();
    		if($project!= null){
    			return response()->json(['code' => 1, 'mainProject' => $main_project, 'project' => $project, 'news' => $news, 'appSetting' => $appSetting
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
    public function progress(){
    	
    	$progress = DB::table('progress')->get()->first();
    	return view('home.progress')->with ( [
            'appSetting' => $this->appSetting,
    			'progress' => $progress,
            'mainProject'=> $this->currentProject
    	] );
    }
    public function contact(){
    	
    	return view('home.contact')->with([
            'mainProject'=> $this->currentProject,
            'appSetting' => $this->appSetting,
        ]);
    }
    public function store(Request $request){
	    	$main_project = DB::table('main_projects')
	    	->where('is_current', '=', 1)
	    	->get()
	    	->first();
    		$customer = new Customer();
    		$customer->full_name  = $request->input('full_name');
    		$customer->email = $request->input('email');
    		$customer->phone_number = $request->input('phone_number');
    		$customer->message = $request->input('message');
    		$customer->project_id = $main_project->id;
    		$customer->save ();
    	return Redirect::to('/');
    }
    
}
