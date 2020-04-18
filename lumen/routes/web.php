<?php
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'auth'], function () use ($router){
    Route::post('login', function () {
        return 'login';
    });
    Route::post('logout', function () {
        return 'logout';
    });
});

Route::post('register', 'loginRegisterController@register');

$router->get('/post', ['middleware' => 'auth:api', function (Request $request){

    $user = Auth::user();

    $user = $request->user();

    return $user;

}]);



