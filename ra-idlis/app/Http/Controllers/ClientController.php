<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Carbon\Carbon;
class ClientController extends Controller
{
    public function clientlogin(Request $request){
  		if($request->isMethod('get')){
        $regions = DB::table('region')->get();
        $province = DB::table('province')->get();
        $city_muni = DB::table('city_muni')->get();
   			return view('client.login',['regions' => $regions, 'province' => $province, 'citymuni' => $city_muni]);
   		} 
        if($request->isMethod('post')){
            $uname=strtoupper($request->input('log_uname'));
            $pass= $request->input('log_pass');
            $pass = Hash::check('pass', $pass);
            $data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['pwd', '=', $pass], ['grpid', '=', 'C'] ])
                    ->select('*')
                    ->first();
            if ($data){
                $clientUser  = DB::table('x08')
                                ->join('region', 'x08.rgnid', '=', 'region.rgnid')
                                ->join('province', 'x08.province', '=', 'province.provid')
                                ->select('x08.*', 'region.rgn_desc', 'province.provname')
                                ->first()
                                ;
                session()->put('client_data',$clientUser);
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
          $dt = Carbon::now();
          $dateNow = $dt->toDateString();
          $timeNow = $dt->toTimeString();
          $data['facility_name'] = $request->facility_name;
          $data['region'] = $request->region;
          $data['province'] = $request->province;
          $data['brgy'] = $request->brgy;
          $data['street'] = $request->street;
          $data['city_muni'] = $request->city_muni;
          $data['zip'] = $request->zipcode;
          $data['authorized'] = $request->auth_name;
          $data['uname'] = strtoupper($request->uname);
          $data['pass'] = Hash::make($request->pass2);
          $data['email'] = $request->email;
          $data['contact_p'] = $request->contact_p;
          $data['contact_pno'] = $request->contact_pno;
          $data['ip'] = request()->ip();
          // Check Username
          $checkUser = DB::table('x08')
                        ->where('uid', '=' ,$data['uname'])
                        ->where('grpid' , '=' , 'C')
                        ->exists();
          // Check Facility Name
          $checkFacility = DB::table('x08')
                        ->where('facilityname', '=' , $data['facility_name'])
                        ->exists();
          if ($checkUser == true) {
              return 'same';
          } else if ($checkFacility == true) {
              return 'sameFacility';
          }
          else {
            DB::table('x08')->insert(
                [
                    'uid' => $data['uname'],
                    'pwd' => $data['pass'],
                    'facilityname' => $data['facility_name'],
                    'rgnid' => $data['region'],
                    'province' => $data['province'],
                    'barangay' => $data['brgy'],
                    'streetname' => $data['street'],
                    'city_muni' => $data['city_muni'],
                    'zipcode' => $data['zip'],
                    'contactperson' => $data['contact_p'],
                    'contactpersonno' => $data['contact_pno'],
                    'email' => $data['email'],
                    'authorizedsignature' => $data['authorized'],
                    'ipaddress' => $data['ip'],
                    't_date' => $dateNow,
                    't_time' =>$timeNow,
                    'grpid' => 'C',
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
    public function LOP(){
      return view('client.lop');
    }
    public function SA(){
      return view('client.sa');
    }

    public function loadAllRPMB(Request $req) {
      $data = [];
      $sql = "";
      $data = explode(",", $req->data);

      $rgn = $data[count($data) - 1];
      $prov = $data[count($data) - 2];
      $cty = $data[count($data) - 3];
      $brgy = $data[count($data) - 4];

      $sqlBrgy = "SELECT * FROM (SELECT DISTINCT brgyid, brgyname, cmid FROM (SELECT DISTINCT * FROM barangay WHERE cmid IN (SELECT cmid FROM (SELECT DISTINCT * FROM (SELECT cmid, cmname FROM city_muni WHERE provid IN (SELECT provid FROM (SELECT DISTINCT * FROM (SELECT provid, provname FROM province WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv) prv WHERE UPPER(provname) LIKE '%$prov%')) cmn) cmn WHERE UPPER(cmname) LIKE '%$cty%')) brgy) brgy WHERE UPPER(brgyname) LIKE '%$brgy%'";
      $sqlCty = "SELECT DISTINCT * FROM (SELECT cmid, cmname, provid FROM (SELECT DISTINCT cmid, cmname, provid FROM city_muni WHERE cmid IN (SELECT cmid FROM (SELECT DISTINCT brgyid, brgyname, cmid FROM (SELECT DISTINCT * FROM barangay WHERE cmid IN (SELECT cmid FROM (SELECT DISTINCT * FROM (SELECT cmid, cmname FROM city_muni WHERE provid IN (SELECT provid FROM (SELECT DISTINCT * FROM (SELECT provid, provname FROM province WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv) prv WHERE UPPER(provname) LIKE '%$prov%')) cmn) cmn WHERE UPPER(cmname) LIKE '%$cty%')) brgy) brgy WHERE UPPER(brgyname) LIKE '%$brgy%')) cmn WHERE provid IN (SELECT provid FROM (SELECT DISTINCT * FROM (SELECT provid, provname FROM province WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv) prv WHERE UPPER(provname) LIKE '%$prov%')) cmn WHERE UPPER(cmname) LIKE '%$cty%'";
      $sqlProv = "SELECT DISTINCT * FROM (SELECT provid, provname, rgnid FROM (SELECT DISTINCT provid, provname, rgnid FROM province WHERE provid IN (SELECT DISTINCT provid FROM (SELECT provid, cmname, cmid FROM city_muni WHERE provid IN (SELECT provid FROM (SELECT DISTINCT * FROM (SELECT provid, provname FROM province WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv) prv WHERE UPPER(provname) LIKE '%$prov%')) cmn WHERE UPPER(cmname) LIKE '%$cty%' AND cmid IN (SELECT cmid FROM barangay WHERE UPPER(brgyname) LIKE '%$brgy%'))) prv WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv WHERE UPPER(provname) LIKE '%$prov%'";
      $sqlRgn = "SELECT * FROM (SELECT DISTINCT * FROM (SELECT rgnid, rgn_desc FROM region WHERE rgnid IN (SELECT DISTINCT rgnid FROM (SELECT provid, provname, rgnid FROM (SELECT DISTINCT provid, provname, rgnid FROM province WHERE provid IN (SELECT DISTINCT provid FROM (SELECT provid, cmname, cmid FROM city_muni WHERE provid IN (SELECT provid FROM (SELECT DISTINCT * FROM (SELECT provid, provname FROM province WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv) prv WHERE UPPER(provname) LIKE '%$prov%')) cmn WHERE UPPER(cmname) LIKE '%$cty%' AND cmid IN (SELECT cmid FROM barangay WHERE brgyname LIKE '%$brgy%'))) prv WHERE rgnid IN (SELECT rgnid FROM region WHERE UPPER(rgn_desc) LIKE '%$rgn%')) prv WHERE UPPER(provname) LIKE '%$prov%')) rgn) rgn WHERE UPPER(rgn_desc) LIKE '%$rgn%'";

      $tblBrgy = DB::select($sqlBrgy);
      $tblCty = DB::select($sqlCty);
      $tblProv = DB::select($sqlProv);
      $tblRgn = DB::select($sqlRgn);

      return [$tblBrgy, $tblCty, $tblProv, $tblRgn];
    }

    public function loadCurrTbl(Request $req, $tbl, $col, $id) {
      $cur_tbl = [];

      if($col == 1 && $id == 1) {
        $cur_tbl = DB::table($tbl)->get();
      } else {
        $cur_tbl = DB::table($tbl)->where($col, $id)->get();
      }


      return $cur_tbl;
    }

}
