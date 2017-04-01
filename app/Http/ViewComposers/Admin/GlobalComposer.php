<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;

class GlobalComposer
{
    /**
     * The authenticator instance.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new global composer.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('currentUser', $this->auth->user());
    }
}