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
            $uname=$request->input('log_uname');
            $pass= $request->input('log_pass');
            $pass = Hash::check('pass', $pass);
            $data = DB::table('x08')
                    ->where([ ['u_uname', '=', $uname], ['u_pass', '=', $pass], ['grp_id', '=', '5'] ])
                    ->first();
            if ($data){
                $clientUser  = DB::table('x08')
                                ->join('client_meta', 'x08.u_id', '=', 'client_meta.u_id')
                                ->join('region', 'client_meta.reg_id', '=', 'region.reg_id')
                                ->join('province', 'client_meta.pro_id', '=', 'province.pro_id')
                                ->select('x08.u_id', 'client_meta.*', 'region.reg_name', 'province.pro_name')
                                ->first()
                                ;
                session()->put('client_data',$data);
                return redirect('/client/home');
            }
             else{
                session()->flash('client_login','Invalid Username/Password');
                return back();
             }
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
                'cm_email' => $data['email'],
                'cm_auth' => $data['authorized'],
              ]
            );
            // return response()->json(['test'=>$data]);
            // return "Check";
            return 'done';
          }
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
    public function logout(){
      session()->forget('client_data');
      session()->flash('logout_notif','Successfully Logout');
      return redirect()->route('client');
    }

}
