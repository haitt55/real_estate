<?php

namespace App\Http\ViewComposers\Admin;

use App\Customer;
use App\Position;
use App\Project;
use Illuminate\Contracts\View\View;
use App\Utilities;
use App\Grounds;
use App\PricesPolicies;
use App\News;

class HomeComposer
{

    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countProjects', Project::all()->count());
        $view->with('countPositions', Position::all()->count());
        $view->with('countCustomers', Customer::all()->count());
        $view->with('countUtilities', Utilities::all()->count());
        $view->with('countGrounds', Grounds::all()->count());
        $view->with('countPricePolicies', PricesPolicies::all()->count());
        $view->with('countNews', News::all()->count());
    }
}