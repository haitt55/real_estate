<?php

namespace App\Http\ViewComposers\Admin;

use App\Customer;
use App\Position;
use App\Project;
use Illuminate\Contracts\View\View;

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
    }
}