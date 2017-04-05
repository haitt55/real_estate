<?php

namespace App\Http\ViewComposers;

use App\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;

class GlobalComposer
{
    /**
     * The authenticator instance.
     *
     * @var Guard
     */
    protected $currentProject;

    /**
     * Create a new global composer.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {
        $this->currentProject = Project::where('is_current', 1)->get()->first();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('currentProject', $this->currentProject);
    }
}