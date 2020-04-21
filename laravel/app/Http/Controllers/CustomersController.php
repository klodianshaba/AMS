<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

use App\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class customersController extends Controller
{
    //

    private $forPage = 10;
    private $currentPage = 0;

    public function get(Request $request){

        ($request->has('currentPage')) ? $this->currentPage = $request->input('currentPage') :null;
        ($request->has('forPage')) ? $this->forPage = $request->input('forPage') :null;

        $customers = Customer::query()->skip($this->currentPage*$this->forPage )->take($this->forPage)->get();

        return $customers;
    }

    public function add(Request $request){

        if($request->has(['name','email'])){

            Customer::query()->create( array_merge($request->all() , [ 'user_id'=> Auth::id() ]));

        }else{
            return response()->json(['error'=>'require some data'],400);
        }
    }

    public function remove(Request $request ,$id){

        if( Customer::query()->where('user_id','=',Auth::id())->where('id','=',$id)->exists() ){
            Customer::destroy($id);
        }
        else{
            return response()->json('the customer may is not your customer or dose not exist',401);
        }
    }
}
