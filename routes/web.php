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
            'index' => 'admin.position.index',
        	'checkProject' => 'admin.position.checkProject',
        	'create' => 'admin.position.create',
        	'store' => 'admin.position.store',
        	'show' => 'admin.position.show',
        	'edit' => 'admin.position.edit',
        	'update' => 'admin.position.update',
        	'destroy' => 'admin.position.destroy'
        ]]);
        
        Route::resource('customer', 'CustomerController', ['names' => [
            'index' => 'admin.customer.index'
        ]]);
        Route::post('/customer/changeStatus',['uses' => 'CustomerController@changeStatus', 'as' => 'admin.customer.changeStatus']);
        
        Route::post('/position/store','PositionController@store');
        Route::post('/position/checkProject','PositionController@checkProject');
        Route::resource('ground', 'GroundController', ['names' => [
        		'index' => 'admin.ground.index',
        		'checkProject' => 'admin.ground.checkProject',
        		'create' => 'admin.ground.create',
        		'store' => 'admin.ground.store',
        		'show' => 'admin.ground.show',
        		'edit' => 'admin.ground.edit',
        		'update' => 'admin.ground.update',
        		'destroy' => 'admin.ground.destroy'
        ]]);
        Route::post('/ground/store','GroundController@store');
        Route::post('/ground/checkProject','GroundController@checkProject');
        Route::resource('utility', 'UtilitiesController', ['names' => [
        		'index' => 'admin.utility.index',
        		'checkProject' => 'admin.utility.checkProject',
        		'create' => 'admin.utility.create',
        		'store' => 'admin.utility.store',
        		'show' => 'admin.utility.show',
        		'edit' => 'admin.utility.edit',
        		'update' => 'admin.utility.update',
        		'destroy' => 'admin.utility.destroy'
        		
        ]]);
        Route::post('/utility/store','UtilitiesController@store');
        Route::post('/utility/checkProject','PricePoliciesController@checkProject');
        Route::resource('pricePolicy', 'PricePoliciesController', ['names' => [
        		'index' => 'admin.pricePolicy.index',
        		'checkProject' => 'admin.pricePolicy.checkProject',
        		'create' => 'admin.pricePolicy.create',
        		'store' => 'admin.pricePolicy.store',
        		'show' => 'admin.pricePolicy.show',
        		'edit' => 'admin.pricePolicy.edit',
        		'update' => 'admin.pricePolicy.update',
        		'destroy' => 'admin.pricePolicy.destroy'
        		
        ]]);
        Route::post('/pricePolicy/store','PricePoliciesController@store');
        Route::post('/pricePolicy/checkProject','PricePoliciesController@checkProject');
        Route::resource('new', 'NewsController', ['names' => [
        		'index' => 'admin.new.index',
        		'checkProject' => 'admin.new.checkProject',
        		'create' => 'admin.new.create',
        		'store' => 'admin.new.store',
        		'show' => 'admin.new.show',
        		'edit' => 'admin.new.edit',
        		'update' => 'admin.new.update',
        		'destroy' => 'admin.new.destroy'
        		
        ]]);
        Route::post('/new/store','NewsController@store');
        Route::post('/new/checkProject','NewsController@checkProject');
        
    });
});
// Web
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);
