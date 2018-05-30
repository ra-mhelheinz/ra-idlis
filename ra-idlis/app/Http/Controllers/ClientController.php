<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
class ClientController extends Controller
{
    public function clientlogin(Request $request){
  		if($request->isMethod('get')){
            $regions = DB::table('region')->get();
   			return view('client.login',['regions' => $regions]);
   		} 
        if($request->isMethod('post')){
            // $uname=$request->input('uname');
            // $pass= $request->input('pass');
            // $pass = Hash::check('pass', $pass);
            // $data = DB::select('select * from accounts where username=? and password=? limit 1', [$uname, $pass])->first();
            // if (count($data)){
            //     session()->put('current_user',$data);
            //     return redirect('/home');
            // }
            //  else{
            //     session()->flash('client_login','Invalid Username/Password');
            //     return back();
            //  }
            return view('client.login');
        }
    }
    public function registerclient(Request $request){
    	if($request->isMethod('get')){
    		return view('client.register');
    	}
        if($request->isMethod('post')){
            return view('client.login');
        }    }
    public function home(Request $request){
    	if($request->isMethod('get')){
    		return view('client.index');
    	}
    }
    public function apply(Request $request){
    	if($request->isMethod('get')){
    		return view('client.apply');
    	}
    }
     public function evaluate(Request $request){
    	if($request->isMethod('get')){
    		return view('client.evaluate');
    	}
    }
    public function inspection(Request $request){
    	if($request->isMethod('get')){
    		return view('client.inspection');
    	}
    }
      public function inspection2(Request $request){
    	if($request->isMethod('get')){
    		return view('client.inspection2');
    	}
    }
      public function inspection3(Request $request){
    	if($request->isMethod('get')){
    		return view('client.inspection3');
    	}
    }
     public function issuance(Request $request){
    	if($request->isMethod('get')){
    		return view('client.issuance');
    	}
    }
    public function orderofpaymentc(Request $request){
        if($request->isMethod('get')){
            return view('client.orderofpaymentc');
        }
    }

}
