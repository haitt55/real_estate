<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    $this->post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('/home', 'HomeController@index');
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home.index']);
        Route::resource('project', 'ProjectController', ['names' => [
            'index' => 'admin.project.index',
            'create' => 'admin.project.create',
            'store' => 'admin.project.store',
            'show' => 'admin.project.show',
            'edit' => 'admin.project.edit',
            'update' => 'admin.project.update',
            'destroy' => 'admin.project.destroy'
        ]]);
        Route::resource('position', 'PositionController', ['names' => [
            'index' => 'admin.position.index'
        ]]);
        Route::post('/position/store','PositionController@store');
        
        Route::resource('customer', 'CustomerController', ['names' => [
            'index' => 'admin.customer.index',
            'show' => 'admin.customer.show',
        ]]);
    });
});
// Web
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);
