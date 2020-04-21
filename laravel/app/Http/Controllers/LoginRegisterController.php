<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use http\Client\Response;

use Illuminate\Support\Str;

use App\User;

use Illuminate\Support\Facades\Route;

class LoginRegisterController extends Controller
{
    //
    public function register(Request $request){

        if( $request->has(['email','password','name']) ){

            if(!User::query()->where('email', '=', $request->email)->exists()){

                $userData = $request->all();

                $userData['password'] = bcrypt($userData['password']);

                User::query()->create($userData);

                return Route::dispatch(Request::create('api/login', 'POST'));

            }else{
                return Response()->json(['error'=>'user exists'],401);
            }

        }else{
            return Response()->json(['error'=>'required more data to register an user'],400);
        }
    }

    public function login(Request $request){

        $req = Request::create('oauth/token', 'POST',
            [
                'grant_type' => 'password',
                'client_id' => '16',
                'client_secret' => '9ids1t4QoermjpebfdPA2AWzCAKrprgyM9IvBJIN',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '',
            ]
        );
        return app()->handle($req);
    }

}
