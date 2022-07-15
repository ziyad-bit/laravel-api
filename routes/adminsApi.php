<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

###################      login         ####################################################

Route::group(['prefix' => 'admins', 'namespace' => 'Admins'], function () {
    Route::post('login'   , 'AdminsController@login');
    
});

###################         admins          ###################################################  a
Route::group(['prefix' => 'admins', 'namespace' => 'Admins' , 'middleware'=>['jwt.auth','adminsRoutes'] ], function () {
    Route::post  ('logout'        , 'AdminsController@logout');
    Route::get   ('get/auth'      , 'AdminsController@getAuthenticated');
    Route::post  ('add'           , 'AdminsController@add');
    Route::get   ('get'           , 'AdminsController@get');
    Route::put   ('update/{admin}', 'AdminsController@update');
    Route::delete('delete/{admin}', 'AdminsController@delete');
    Route::get   ('get/count'     , 'AdminsController@getCount');
});

###################       items         ##############################################
Route::group(['prefix' => 'admins/items', 'namespace' => 'Admins' , 'middleware'=>['jwt.auth','adminsRoutes'] ], function () {
    Route::get   ('get'              , 'ItemsController@get');
    Route::post  ('add'              , 'ItemsController@add');
    Route::get   ('edit/{item}'      , 'ItemsController@edit');
    Route::put   ('update/{item}'    , 'ItemsController@update');
    Route::get   ('get/count'        , 'ItemsController@getCount');
    Route::delete('delete/{item}'    , 'ItemsController@delete');
});

###################       users         #############################################
Route::group(['prefix' => 'admins/users', 'namespace' => 'Admins' , 'middleware'=>['adminsRoutes' , 'jwt.auth'] ], function () {
    Route::get   ('get'              , 'UsersController@get');
    Route::post  ('add'              , 'UsersController@add');
    Route::get   ('edit/{user}'      , 'UsersController@edit');
    Route::put   ('update/{user}'    , 'UsersController@update');
    Route::get   ('get/count'        , 'UsersController@getCount');
    Route::delete('delete/{user}'    , 'UsersController@delete');
});

###################       category        #############################################
Route::group(['prefix' => 'admins/category', 'namespace' => 'Admins' , 'middleware'=>['adminsRoutes' , 'jwt.auth'] ], function () {
    Route::get   ('get'              , 'CategoryController@get');
    Route::post  ('add'              , 'CategoryController@add');
    Route::get   ('edit/{category}'  , 'CategoryController@edit');
    Route::put   ('update/{category}', 'CategoryController@update');
    Route::delete('delete/{category}', 'CategoryController@delete');
});

