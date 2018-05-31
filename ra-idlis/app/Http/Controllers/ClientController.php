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
          $data['facility_name'] = $request->facility_name;
          $data['region'] = $request->region;
          $data['province'] = $request->province;
          $data['brgy'] = $request->brgy;
          $data['street'] = $request->street;
          $data['city_muni'] = $request->city_muni;
          $data['zip'] = $request->zipcode;
          $data['authorized'] = $request->auth_name;
          $data['uname'] = $request->uname;
          $data['pass'] = Hash::make($request->pass2);
          $data['email'] = $request->email;
          $data['contact_p'] = $request->contact_p;
          $checkUser = DB::table('x08')
                        ->where('u_uname', '=' ,$data['uname'])
                        ->where('grp_id' , '=' , '5')
                        ->exists();
          if ($checkUser == true) {
              return 'same';
          } else {
            DB::table('x08')->insert(
                [
                    'u_uname' => $data['uname'],
                    'u_pass' => $data['pass'],
                    'grp_id' => 5,
                ]
            );
            $lastID = DB::getPdo()->lastInsertId();
            DB::table('client_meta')->insert(
              [
                'u_id' => $lastID,
                'cm_faname' => $data['facility_name'],
                'reg_id' => $data['region'],
                'pro_id' => $data['province'],
                'cm_brgy' => $data['brgy'],
                'cm_str' => $data['street'],
                'cm_ctmuni' => $data['city_muni'],
                'cm_zip' => $data['zip'],
                'cm_contp' => $data['contact_p'],
                'cm_auth' => $data['authorized'],
              ]
            );
            // return response()->json(['test'=>$data]);
            // return "Check";
            return 'done';
          }
            //DB::getPdo()->lastInsertId();
            //   DB::table('accounts')->insert(
            //     ['facility_name' => $data['facility_name'],
            //     'region' => $data['region'],
            //     'province' => $data['province'],
            //     'brgy' => $data['brgy'],
            //     'street' => $data['street'],
            //     'city_mun' => $data['city_muni'],
            //     'zip' => $data['zip'],
            //     'authorized' => $data['authorized'],
            //     'username' => $data['uname'],
            //     'password' => $data['pass'],
            //     'email' => $data['email'],
            //     'contact_p' => $data['contact_p'],
            //     ]
            // );
          // DB::table('x08')->insert(
          //       [
          //           'u_uname' => $data['uname'],
          //           'u_pass' => $data['pass']
          //       ]
          //   );
          // $lastInserted = DB::getPdo()->lastInsertId();
          
          // return print_r($checkUser);
          // return 'test';
          // return print_r($data);
            // return view('client.login');
        }    
    }
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
