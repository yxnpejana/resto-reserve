<?php

use Illuminate\Http\Request;

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
// Default API Homepage
Route::get('/', 'HomeController');

Route::middleware('auth:api')
    ->get('/profile', function (Request $request) {
        return response()->json($request->user());
    });

// user logout
Route::delete('oauth/token', 'Auth\TokenController@delete')->middleware('auth:api');

Route::post('register', 'UserController@register');

Route::post('activate', 'UserController@activate');

// Routes for Forget and Reset Password
Route::post('password/forgot', 'Auth\PasswordController@forgot');
Route::post('password/reset', 'Auth\PasswordController@reset');

// users route
Route::prefix('users')
    ->group(function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@create');
        Route::get('{id}', 'UserController@read');
        Route::put('{id}', 'UserController@update');
        Route::delete('{id}', 'UserController@delete');
    });
