<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'bindings'], function () 
{
    Route::group(['middleware' => 'web'], function () 
    {
        /*
        |--------------------------------------------------------------------------
        | Auth Routes
        |--------------------------------------------------------------------------
        */
        
        Route::group(['namespace' => '', 'prefix' => ''], function () {
            Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');
            Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
            Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
        });

        Route::group(['namespace' => '', 'prefix' => ''], function () {
            Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');
            Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
            Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
        });
        

        Route::group(['middleware' => 'auth'], function () 
        {
            Route::get('/', 'DashboardController@index');
            Route::get('home', 'DashboardController@index');
            Route::get('dashboard', 'DashboardController@index');

            Route::get('sidebar-mini', 'SidebarController@sidebarMini');
            
            Route::get('sessions/logout/{user_id}', 'SessionsController@logout');
               
            /*
            |--------------------------------------------------------------------------
            | User Routes
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'user'], function () 
            {
                Route::get('', 'UserController@index');
                Route::get('{user}/show', 'UserController@show');
                Route::get('picture/{picture}', 'UserController@picture');
                Route::get('{user}/edit', 'UserController@edit');   


                Route::post('update', 'UserController@update');
                Route::group(['middleware' => 'needsPermission:user.trash'], function () 
                {
                    Route::get('trash', 'UserController@trash');
                });    
                Route::group(['middleware' => 'needsPermission:user.create'], function () 
                {
                    Route::get('create', 'UserController@create');
                });     
                Route::group(['middleware' => 'needsPermission:user.create'], function () 
                {
                    Route::post('store', 'UserController@store');
                });     
                Route::group(['middleware' => 'needsPermission:user.destroy'], function () 
                {
                    Route::delete('{user}/destroy', 'UserController@destroy');
                });      
                Route::group(['middleware' => 'needsPermission:user.restore'], function () 
                {
                    Route::post('{id}/restore', 'UserController@restore');
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'role'], function () 
            {
                Route::get('','RoleController@index');

                Route::group(['middleware' => 'needsPermission:role.show'], function () {
                    Route::get('{role}/show', 'RoleController@show');
                });
                Route::group(['middleware' => 'needsPermission:role.create'], function () 
                {
                    Route::get('create','RoleController@create');
                });
                Route::group(['middleware' => 'needsPermission:role.create'], function () 
                {
                    Route::post('store','RoleController@store');
                });
                Route::group(['middleware' => 'needsPermission:role.edit'], function () 
                {
                    Route::get('{role}/edit', 'RoleController@edit');
                });
                Route::group(['middleware' => 'needsPermission:role.edit'], function () 
                {
                    Route::post('update', 'RoleController@update');
                });
                Route::group(['middleware' => 'needsPermission:role.destroy'], function () 
                {
                    Route::get('{role}/destroy', 'RoleController@destroy');
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Permissões
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'permission'], function () 
            {
                Route::get('','PermissionController@index');

                Route::group(['middleware' => 'needsPermission:permission.show'], function () {
                    Route::get('{permission}/show', 'PermissionController@show');
                });
                Route::group(['middleware' => 'needsPermission:permission.create'], function () 
                {
                    Route::get('create','PermissionController@create');
                });
                Route::group(['middleware' => 'needsPermission:permission.create'], function () 
                {
                    Route::post('store','PermissionController@store');
                });
                Route::group(['middleware' => 'needsPermission:permission.edit'], function () 
                {
                    Route::get('{permission}/edit', 'PermissionController@edit');
                });
                Route::group(['middleware' => 'needsPermission:permission.edit'], function () 
                {
                    Route::post('update', 'PermissionController@update');
                });
                Route::group(['middleware' => 'needsPermission:permission.destroy'], function () 
                {
                    Route::get('{permission}/destroy', 'PermissionController@destroy');
                });
            });

            Route::group(['prefix' => 'report'], function () {
              Route::get('sessions', 'SessionsController@index');
            });

            Route::get('notification', 'NotificationController@get');

            Route::get('resolution', 'SidebarController@resolution');
        });
    });
});