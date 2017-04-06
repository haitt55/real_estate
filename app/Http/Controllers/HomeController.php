<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Psy\Util\Json;
use Illuminate\Support\Facades\DB;

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
        return view('home.index');
    }
    public function getCurrentProject()
    {
    	try {
    		$project = DB::table('projects')->where('is_current', '=', 1)
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
}
