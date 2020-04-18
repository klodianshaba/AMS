<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

use Firebase\JWT\JWT;

class LoginRegisterController extends Controller{

    public function __construct()
    {
        //
//        $this->middleware('auth');
    }

    public function register(Request $request){

        if($request->has('email') && $request->has('password') && $request->has('firstName') && $request->has('lastName') ){

            if( !User::where('email', $request->get('email'))->first() ) {

                return User::forceCreate([
                    'firstName' => $request->input('firstName'),
                    'lastName' => $request->input('lastName'),
                    'email' =>$request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'api_token' => Str::random(80),
                ]);
            }

            return response()->json(['error' => 'miss required data'], 403);

        }else{

            return response()->json(['error'=>'miss required data'], 400);
        }
    }

    public function login(Request $request){

        if($request->has('email') && $request->has('password')){

            $user = User::where('email', $request->input('email'))->first();

        }else {
            return response()->json(['error' => 'miss required data'], 400);
        }

    }
}

?>
