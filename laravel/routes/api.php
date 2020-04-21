<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});

Route::middleware('auth:api')->prefix('customers')->group(function(){

    Route::get('/', 'CustomersController@get');

    Route::post('/', 'CustomersController@add');

    Route::delete('/{id}','CustomersController@remove');

});

Route::post('/register', 'LoginRegisterController@register');

Route::post('/login', 'LoginRegisterController@login');


Route::middleware('auth:api')->prefix('dashboard')->group(function(){

    Route::get('','DashboardController@get');

    Route::get('/search','DashboardController@search');

    Route::get('/jobs','DashboardController@jobs');

});

Route::post('/csrfToken',function(){
    return csrf_token();
});



