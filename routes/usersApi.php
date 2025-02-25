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

###################      login and sign up       ##################
Route::group(['prefix' => 'users', 'namespace' => 'users'], function () {
    Route::post('login'   , 'UsersController@login');
    Route::post('signup'  , 'UsersController@signup');
});

###################      users      ##################
Route::group(['prefix' => 'users', 'namespace' => 'users', 'middleware'=>['usersRoutes' , 'jwt.auth']], function () {
    Route::get ('get/auth/user'   , 'UsersController@getAuthenticatedUser');
    Route::post('logout'          , 'UsersController@logout');
});
