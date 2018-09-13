<?php

namespace App\Http\Controllers;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;
use Session;
class ClientController extends Controller
{
    public function clientlogin(Request $request){
  		if($request->isMethod('get')){
        $regions = DB::table('region')->get();
        $province = DB::table('province')->get();
        $city_muni = DB::table('city_muni')->get();
         $brgy = DB::table('barangay')->get();
         $fatype = DB::table('facilitytyp')->get();
   			return view('client.login',['regions' => $regions, 'province' => $province, 'citymuni' => $city_muni, 'brgy' => $brgy, 'fatypes'=>$fatype]);
   		} 
        if($request->isMethod('post')){
            session()->flush();
            $uname=strtoupper($request->input('log_uname'));
            $pass= $request->input('log_pass');
            $data = DB::table('x08')->where('uid', '=', $uname)->where('grpid', '=', 'C')->select('*')->first();
            if($data == null){
              session()->flash('client_login','Invalid Username/Password');
               return back();
            }
            $chkpass = Hash::check($pass, $data->pwd);

            // dd([$data, $chkpass, $request->input('log_pass')]);
              if ($chkpass != true){
                  session()->flash('client_login','Invalid Username/Password');
                  return back();
              }
             else{
              $val_ver = DB::table('x08')->select('token', 'uid')->where('uid', '=', $uname)->first();
              if($val_ver->token != NULL) {
                session()->flash('client_login','Not yet verified. Please check your email account');
                session()->flash('acc_id',$val_ver->uid);
                return back();
              } else {
                  $clientUser  = DB::table('x08')
                                  ->join('region', 'x08.rgnid', '=', 'region.rgnid')
                                  ->join('province', 'x08.province', '=', 'province.provid')
                                  ->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
                                  ->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
                                  ->select('x08.*', 'region.rgn_desc', 'province.provname', 'city_muni.cmname', 'barangay.brgyname')
                                  ->where('x08.uid', '=', $uname)
                                  ->first();
                  if($clientUser == null) {
                    session()->flash('client_login','Invalid Username/Password');
                    return back();
                  } else {
                    session()->put('client_data',$clientUser);
                    return redirect()->route('client.home');
                  }
              }
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
          $data['tel'] = $request->tel;
          $data['cel'] = $request->cel;
          $data['uname'] = strtoupper($request->uname);
          $data['pass'] = Hash::make($request->pass2);
          $data['email'] = $request->email;
          $data['contact_p'] = $request->contact_p;
          $data['contact_pno'] = $request->contact_pno;
          $data['ip'] = request()->ip();
          $data['token'] = Str::random(40);
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
            // $data1 = array('name'=>$data['facility_name'], 'token'=>$data['token']);
            // Mail::send(['text'=>'mail'], $data1, function($message) use ($data) {
            //    $message->to($data['email'], $data['facility_name'])->subject
            //       ('Verify your Account in DOH OLRS');
            //    $message->from('dohsupport@gmail.com', 'DOH OLRS Support');
            // });

            DB::table('x08')->insert(
                [
                    'uid' => $data['uname'],
                    'pwd' => $data['pass'],
                    'facilityname' => $data['facility_name'],
                    // 'rgnid_address' => $data['regionadd'],
                    'rgnid' => $data['region'],
                    'province' => $data['province'],
                    'barangay' => $data['brgy'],
                    'streetname' => $data['street'],
                    'city_muni' => $data['city_muni'],
                    'zipcode' => $data['zip'],
                    'contactperson' => $data['contact_p'],
                    'contactpersonno' => $data['contact_pno'],
                    'rgnid_address' => $data['tel'],
                    'email' => $data['email'],
                    'authorizedsignature' => $data['authorized'],
                    'contact' => $data['cel'],
                    'ipaddress' => $data['ip'],
                    't_date' => $dateNow,
                    't_time' =>$timeNow,
                    'grpid' => 'C',
                    'token' => $data['token']
                ]
            );
            // return response()->json(['test'=>$data]);
            // return "Check";
            return 'DONE';
          }
        }    
    }
    public function home(Request $request){
      $employeeData = session('client_data');
      if($employeeData != null) {
        $result = [];
        $draft_ok = 0;
        $draft_not = 0;
      	if($request->isMethod('get')){
          $result = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '=', '0')->get();
          $clientAppyInformation = "SELECT hf.hfser_desc, ap.hfser_id, ap.t_date, ap.proposedInspectiondate, ap.proposedInspectiondate, ts.canapply FROM appform ap LEFT JOIN hfaci_serv_type hf ON ap.hfser_id = hf.hfser_id LEFT JOIN trans_status ts ON ts.trns_id = ap.status WHERE ap.uid = '$employeeData->uid'";
          $getApp = DB::select($clientAppyInformation);
          $draft_ok = 0;
          $draft_not = 0;
          if(count($result) > 0) {
            foreach ($result as $ind_res) {
              switch ($ind_res->complied) {
                case $ind_res=='0':
                  $draft_not++;
                  break;
                case $ind_res!='0':
                  $draft_ok++;
                  break;
                
                default:
                  $draft_not++;
                  break;
              }

            }
          } else {
            $result = [];
            $draft_ok = -1;
            $draft_not = -1;
          }
      		return view('client.index', compact(['result'],['draft_ok'],['draft_not'],['getApp']));
      	}
      } else {
        return redirect()->route('client');
      }
    }
    public function apply(Request $request){
    	if($request->isMethod('get')){
        $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
     		return view('client.apply', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci]);
    	}
    }
     public function evaluate(Request $request, $appid){
    	if($request->isMethod('get')){
        $data0 = DB::table('appform')
                        ->join('x08', 'appform.uid', '=', 'x08.uid')
                        ->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
                        ->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
                        ->join('province', 'x08.province', '=', 'province.provid')
                        ->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id') 
                        ->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
                        // ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
                        // , 'orderofpayment.*'
                        ->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'appform.proposedInspectiontime', 'appform.proposedInspectiondate', 'appform.status', 'trans_status.trns_desc')
                        ->where('appform.appid', '=', $appid)
                        // , 'type_facility.*', 'orderofpayment.*'
                        // ->where('type_facility.facid', '=', 'appform.facid')
                        ->first();
            if ($data0->recommendedtime !== null && $data0->recommendeddate !== null) {
              $newT = Carbon::parse($data0->proposedInspectiontime);
              $data0->formattedPropTime = $newT->format('g:i A');
              $newD = Carbon::parse($data0->proposedInspectiondate);
              $data0->formattedPropDate = $newD->toFormattedDateString();
            }
          $data1 = DB::table('appform')
                        ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
                        ->join('upload', 'app_upload.upid', '=', 'upload.upid')
                        ->select('appform.appid', 'appform.facid', 'app_upload.*', 'upload.updesc')
                        ->where('appform.appid', '=', $appid)
                        ->get();
            $data2 = DB::table('appform') // Rejected Applications
                        ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
                        ->join('upload', 'app_upload.upid', '=', 'upload.upid')
                        ->select('appform.appid', 'app_upload.*', 'upload.updesc')
                        ->where('appform.appid', '=', $appid)
                        ->where('app_upload.evaluation', '=', 0)
                        ->get();
            $data3 = DB::table('appform') // Applications
                        ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
                        ->join('upload', 'app_upload.upid', '=', 'upload.upid')
                        ->select('appform.appid', 'app_upload.*', 'upload.updesc')
                        ->where('appform.appid', '=', $appid)
                        // ->where('app_upload.evaluation', '=', 0)
                        ->get();
            $data4 = DB::table('appform') // Approved Applications
                        ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
                        ->join('upload', 'app_upload.upid', '=', 'upload.upid')
                        ->select('appform.appid', 'app_upload.*', 'upload.updesc')
                        ->where('appform.appid', '=', $appid)
                        ->where('app_upload.evaluation', '=', 1)
                        ->get();
            $data5 = DB::table('appform') // Approved Applications
                        ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
                        ->join('upload', 'app_upload.upid', '=', 'upload.upid')
                        ->select('appform.appid', 'app_upload.*', 'upload.updesc')
                        ->where('appform.appid', '=', $appid)
                        ->where('app_upload.evaluation', '=', null)
                        ->get();
    		return view('client.evaluate', ['AppData'=> $data0,     'UploadData' => $data1, 'numOfX' => count($data2), 'numOfApp' => count($data3), 'numOfAprv'=> count($data4), 'numOfNull' => count($data5)]);
    	}
    }
    public function apply2(Request $request){
      if($request->isMethod('get')){
         $hfaci = DB::table('hfaci_serv_type')->get();
        return view('client.apply2', ['hfaci'=>$hfaci]);
      }
    }
    public function inspection(Request $request){
      $employeeData = session('client_data');
      if ($employeeData != null) {
            if($request->isMethod('get')){
        $sql = "SELECT asmt.asmt_id, asmt.asmt_name, aa.isapproved, aa.remarks, pp.partid, pp.partdesc FROM assessment asmt INNER JOIN app_assessment aa ON asmt.asmt_id = aa.asmt_id LEFT JOIN part pp ON pp.partid = asmt.partid WHERE aa.uid = '$employeeData->uid'";
        $insql = DB::select($sql);
        $part = DB::table('part')->get();
        return view('client.inspection', ['inspect' => $insql, 'part'=>$part], compact(['insql']));
      }
      }
      else{
         return redirect()->route('client');
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
      $data = session('client_data');
      if ($data != null) {
        # code...
    
      $sql = "SELECT x8.facilityname, ft.facname, CONCAT(x8.streetname, ', ', bg.brgyname, ', ', cm.cmname, ', ', rg.rgn_desc) AS loc, cl.classname, CONCAT(UPPER(x8.rgnid), '-', UPPER(LPAD(ap.appid, 4, '0')), '-', UPPER(ap.facid), '-', UPPER(ap.ocid)) AS license, CONCAT('1 January – 31 December ', (CASE WHEN EXTRACT(MONTH FROM x8.t_date) < (SELECT mtny FROM m99 LIMIT 1) THEN EXTRACT(YEAR FROM x8.t_date) ELSE (EXTRACT(YEAR FROM x8.t_date) - 1) END)) AS validity, x8.t_date, (SELECT sec_name FROM m99) AS sec_name, hs.hfser_desc FROM appform ap LEFT JOIN x08 x8 ON ap.uid = x8.uid LEFT JOIN facilitytyp ft ON ft.facid = ap.facid LEFT JOIN region rg ON rg.rgnid = x8.rgnid LEFT JOIN city_muni cm ON cm.cmid = x8.city_muni LEFT JOIN barangay bg ON bg.brgyid = x8.barangay LEFT JOIN class cl ON cl.classid = ap.classid LEFT JOIN hfaci_serv_type hs ON hs.hfser_id = ap.hfser_id WHERE ap.uid = '$data->uid' AND ap.status = 'A'";
      $issuance = DB::select($sql);
    	if($request->isMethod('get')){
    		return view('client.issuance', ['issuance'=>$issuance]);
    	}
        }else{
          return redirect()->route('client');
        }
      if($request->isMethod('post')) {
        dd($request->all());
      }
    }
    public function orderofpaymentc(Request $request){
        if($request->isMethod('get')){
           $employeeData = session('client_data');
            $charges = DB::table('charges')->orderBy('chg_desc', 'asc')->get();
            // return dd($employeeData);
            return view('client.orderofpaymentc', ['charges'=> $charges]);
        }
        if ($request->isMethod('post')) {

        }
    }
    public function logout(){
      session()->flush();
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
    public function PTC(Request $request){
      $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
      return view('client.ptc', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci]);
    }
    public function CON (Request $request){
      $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
        $upld = DB::table('upload')->where([['hfser_id','=','CON'],['facid','=','H']])->get();
        // return dd($upld);
      return view('client.appcon', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci, 'uplds'=> $upld]);
    }
    public function COA (REquest $request){
      $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
      return view('client.coa', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci]);
    }
    public function ATO (Request $request){
      $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
      return view('client.ato', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci]);
    }
     public function LTO (REquest $request){
      $fatype = DB::table('facilitytyp')->get();
        $ownsh = DB::table('ownership')->get();
        $aptyp = DB::table('apptype')->get();
        $clss = DB::table('class')->get();
        $hfaci = DB::table('hfaci_serv_type')->get();
      return view('client.lto', ['fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci]);
    }
    
    public function FORM(Request $request, $id_type, $aptid, $notdraft){
      if ($request->isMethod('get')) {
            session()->flash('taeform', $id_type);
            $personnel =DB::table('personnel')->get();
            $selectedType = strtoupper($id_type);
            $selectedType1 = strtoupper($aptid);
            $position = DB::table('position')->get();
            $plicensetype = DB::table('plicensetype')->get();
            $section = DB::table('section')->get();
            $department = DB::table('department')->get();
            $traintype = DB::table('ptrainings_trainingtype')->get();
            $asd = session('client_data');
            $appform = DB::table('appform')->where("uid", "=", $asd->uid)->where([["draft", "!=", "0"], ["hfser_id", "=", $selectedType]])->get();
            $fatype = DB::table('type_facility')
                              ->join('facilitytyp','type_facility.facid', '=', 'facilitytyp.facid')
                              ->select('type_facility.*','facilitytyp.*')
                              ->where('type_facility.hfser_id','=', $selectedType)
                              ->get(); // Facility Type
            $ownsh = DB::table('ownership')->get(); // Ownership Type
            $aptyp = DB::table('apptype')->get(); // Application Stype
            $clss = DB::table('class')->get(); // Class
            
            $hfaci = DB::table('hfaci_serv_type')->where('hfser_id','=',$selectedType)->first();
            $upld = DB::table('facility_requirements')
                              ->join('upload','facility_requirements.upid','=','upload.upid')
                              ->join('type_facility','facility_requirements.typ_id', '=', 'type_facility.tyf_id')
                              ->select('facility_requirements.*','upload.*','type_facility.*')
                              ->where('type_facility.hfser_id','=', $selectedType)
                              ->get();
            $appidinc = DB::table("appform")->orderBy('appid', 'desc')->limit(1)->select("appid")->first();            
            // $upld = DB::table('upload')->where('hfser_id','=',$id_type)->get();
            $imongmama = "SELECT ap.uid FROM (SELECT * FROM appform WHERE uid = '$asd->uid' AND hfser_id = '$selectedType' ORDER BY t_date DESC LIMIT 1) ap INNER JOIN trans_status ts ON ap.status = ts.trns_id WHERE ts.canapply IN (2, 0)";
            $tothemagical = DB::select($imongmama);
          if(count($tothemagical) > 0) {
            return redirect()->route('client.home');
          } else {
            return view('client.appform', ['appform'=>$appform, 'fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci->hfser_desc,'id_type'=>$id_type,'aptid'=>$aptid,'notdraft'=>$notdraft,'uploads'=>$upld, 'position'=>$position, 'section'=>$section, 'department'=>$department, 'traintype'=>$traintype, 'plicensetype'=>$plicensetype, 'appidinc'=>$appidinc->appid+1, 'isview'=>false]);
          }
          // , 'appidinc'=>$appidinc->appid+1
      }
        if ($request->isMethod('post')) {
              $employeeData = session('client_data');
              // return dd();assignedRgn
              $msg_dr = (($request->draft != "0") ? 'Successfully saved as draft' : 'Success! Application Submitted.');
              //OthersSelected
              $Cls = ($request->CLS == "OTHER") ? $request->OthersSelected : $request->CLS;
              $test1  = $employeeData->uid; /// UID
              $dt = Carbon::now();
              $dateNow = $dt->toDateString(); /// Date
              $timeNow = $dt->toTimeString(); /// Time
              // Tested
              $ddd = DB::table("appform")->where("draft", "=", $request->draft)->exists();
              if($ddd == true && $request->draft != '0') {
                session()->flash('draft_error',"Draft name already taken.");
                return back();
              } else {
                $insertData = array(  
                                    'appid'=>   $request->appid,
                                    'uid'=>   $test1,
                                    'hfser_id' => strtoupper($id_type),
                                    'facid'=> $request->facid,
                                    'ocid'=>  $request->OWNSHP,
                                    'aptid'=> $request->strateMap,
                                    'classid'=> $Cls,
                                    'draft'=> $request->draft,
                                    't_time'=> $timeNow,
                                    't_date' => $dateNow,
                                    'ipaddress'=> request()->ip(),
                                    'assignedRgn' => $employeeData->rgnid,
                                    'status' => 'P',
                                  );
                // Tested
                DB::table('appform')->insert($insertData);
                $NewId = DB::getPdo()->lastInsertId();
                if (count($request->UpID) > 0) {
                          for ($i=0; $i < count($request->UpID); $i++) { 
                          if (isset($request->upLoad[$i])) {
                              $FileUploaded = $request->upLoad[$i];
                              $SelectedUPID = $request->UpID[$i];
                              try { $filename = $FileUploaded->getClientOriginalName(); } catch(Exception $e) {}
                                // $FileUploaded->store('public/uploaded');
                                // FILENAME
                                try { $filenameOnly = pathinfo($filename,PATHINFO_FILENAME ); } catch(Exception $e) {} // FILE NAME ONLY
                                // EXTENSION
                                try { $fileExtension = $FileUploaded->getClientOriginalExtension(); } catch(Exception $e) {}
                                // FILENAME TO STORE
                                $fileNameToStore = $filename.'_'.time().'.'.$fileExtension; 
                                // UPLOAD FILE
                                try { $path = $FileUploaded->storeAs('public/uploaded', $fileNameToStore); } catch(Exception $e) {} // UPLOAD FILE
                                // FILE SIZE
                                try { $fileSize = $FileUploaded->getClientSize();   } catch(Exception $e) {}
                                /////////////////////////////////////////////////////// UPLOAD FILE
                                $InsertUpload = array(
                                                        'app_id' => $NewId,
                                                        'upid'=>   $SelectedUPID,
                                                        'filepath'=> $fileNameToStore,
                                                        'fileExten' => $fileExtension,
                                                        'fileSize' => $fileSize,
                                                        't_date' => $dateNow,
                                                        't_time' => $timeNow,
                                                        'ipaddress' =>request()->ip(),
                                                      );
                                DB::table('app_upload')->insert($InsertUpload);
                          }
                        }
                        session()->flash('apply_succes',$msg_dr);
                        return back();
                  }
                }
              }
              
    } 

    public function verify_account(Request $request, $id){
      $updateData = array('token'=>NULL);
      $table = DB::table("x08")->where("token", "=", $id)->update($updateData);
      if($table) {
        session()->flash('logout_notif','Successfully verified account');
        return redirect()->route('client');
      } else {
        session()->flash('client_login','Account not verified! Error on verifying account. Account may have been verified or email doesnt exists');
        return redirect()->route('client');
      }
    }
    public function del_draft(Request $request){
      DB::table('app_assessment')->where('draft', '=', $request->delmod )->delete();
      return back();
    }
    public function del_form(Request $req, $id) {
      $table = DB::table("appform")->where("appid", "=", $id)->delete();
      if($table) {
        $data1 = DB::table("app_upload")->where("app_id", "=", $id)->get();
        foreach($data1 as $data) {
          if(Storage::delete('public/uploaded/'.$data->filepath)) {
            $sqw = DB::table("app_upload")->where("app_id", "=", $id)->delete();
            if($sqw) {
              session()->flash('del_succes','Successfully deleted file and form');
            } else {
              session()->flash('del_succes','Successfully deleted file and form, but error on deleting file record of upload');
            }
          } else {
            session()->flash('del_succes','Error on deleting file but successfully deleted form');
          }
        }
        return back();
      } else {
        session()->flash('del_succes','Error on deleting form');
        return back();
      }
    }
    public function preassessment(Request $request){
      $employeeData = session('client_data');
      $assessment = DB::table('assessment')->get();
      $assessment_user = DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('draft', '=', '0')->get();
      $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);
      $countass = DB::table('part')->get();
      $dt = Carbon::now();
      $dateNow = $dt->toDateString();
      $timeNow = $dt->toTimeString();
      if($request->isMethod('get')){
        if(count($assessment_user) > 0) {
          return redirect()->route('client.home');
        } else {
          return view('client.preassessment', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment, 'countass'=>$countass, 'userAssessment'=>[], 'iscomplied'=>false, 'isview'=>false]);
        }
      }
      if ($request->isMethod('post')) {
        // if($request->isstatus == null || $request->isstatus == "") {
          for($i = 0; $i < count($request->upID); $i++) {
            if($request->complied[$request->upID[$i]] != null) {
              $newAsmt = $request->upID[$i];
              $newDraft = $request->isdraft;
              $sqlCheck = "SELECT app_assess_id, fileName FROM app_assessment WHERE uid = '$employeeData->uid' AND asmt_id = '$newAsmt' AND draft = '$newDraft'";
              $sqlCheckAss = DB::select($sqlCheck);
              $FileUploaded = $request->file[$request->upID[$i]];
              $fileNameToStore = null;

              if($FileUploaded != null && $FileUploaded != 'uploaded') {
                $filename = $FileUploaded->getClientOriginalName(); 
                $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
                $fileExtension = $FileUploaded->getClientOriginalExtension();
                $fileNameToStore = $employeeData->uid.'_'.$newAsmt.'.'.$fileExtension;
                $path = $FileUploaded->storeAs('public/uploaded', $fileNameToStore);
                $fileSize = $FileUploaded->getClientSize();
              } else {
                $fileNameToStore = ((count($sqlCheckAss) < 1) ? null : $sqlCheckAss[0]->fileName);
              }

              if(count($sqlCheckAss) > 0) {
                try { if($sqlCheckAss[0]->fileName != null && ($FileUploaded != null && $FileUploaded != "uploaded")) { Storage::delete('public/uploaded/'.$sqlCheckAss[0]->fileName); } } catch(Exception $e) { }
                DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('uid', '=', $employeeData->uid)->where('draft', '=', $newDraft)->update([
                  // 'appid'=>$appid[0]->appid,
                  'asmt_id'=>$request->upID[$i],
                  'sa_remarks'=>$request->remarks[$request->upID[$i]],
                  'sa_tdate'=>$dateNow,
                  'sa_ttime'=>$timeNow,
                  'fileName'=>$fileNameToStore,
                  'draft'=>$request->isdraft,
                  'complied'=>$request->complied[$request->upID[$i]],
                  'uid'=>$employeeData->uid
                ]);
              } else {
                DB::table('app_assessment')->insert([
                  // 'appid'=>$appid[0]->appid,
                  'asmt_id'=>$request->upID[$i],
                  'sa_remarks'=>$request->remarks[$request->upID[$i]],
                  'sa_tdate'=>$dateNow,
                  'sa_ttime'=>$timeNow,
                  'fileName'=>$fileNameToStore,
                  'draft'=>$request->isdraft,
                  'complied'=>$request->complied[$request->upID[$i]],
                  'uid'=>$employeeData->uid
                ]);
              }
            }
          }
          return redirect()->route('client.home');
        // }
      }
    }
    public function preassessment2(Request $request){
      $employeeData = session('client_data');
      if($request->isMethod('get')){
      $assessment = DB::table('assessment')->get();
      $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);
      $check_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '=', '0')->get();
      $check_counter = 0;
        foreach ($check_assessment as $check) {
           if ($check->complied == '1') {
             $check_counter++;
           }
         }
         if($check_counter>0) {
            return redirect()->route('client.home');
         }
        return view('client.preassessment2', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment]);
      }
      if ($request->isMethod('post')) {
          // dd($request->all());
          switch ($request['submitpre']) {
          case 1:
           $draftaken = DB::table('app_assessment')->where('draft', '=', $request->savetxt)->exists();
           $draftxt = $request['savetxt'];
           session()->flash('draft_success','Successfully save to draft');
           session()->flash('alert-type','info'); 
           $route = back();
           $compliedd = 0;
          if (empty($request->savetxt)) {
             session()->flash('draft_success','Draft name Required');
           session()->flash('alert-type','danger');
            return back();
          }
        else if ($draftaken == true) {
           session()->flash('draft_success','Draft name already been taken');
           session()->flash('alert-type','danger');
           return back();
        }

            break;
          case 0:
           $draftxt = 0;
           session()->flash('pre_success','Completed Assessment, you may now proceed to next step.');
           $route = redirect()->route('client.home');
            break;

          case 'update':
           $draftxt = 0;
           session()->flash('pre_success','Completed Assessment, you may now proceed to next step.');
           $route = redirect()->route('client.home');
            break;
          default:
            
            break;
        }
         for ($i=0; $i < count($request->upID); $i++) {
          $compliedd = 0;
          if ($request->complied[$request->upID[$i]]!= null) {
              $compliedd = $request->complied[$request->upID[$i]];
          }
          
          $dt = Carbon::now();
          $asmt_id = $request->upID[$i];
          $complied = $compliedd;
          $fileup = $request->file[$i];
          $remarks = $request->remarks[$i];
          $dateNow = $dt->toDateString(); /// Date
          $timeNow = $dt->toTimeString(); /// Time

          switch ($request['submitpre']) {
            case 'update':
              DB::table('app_assessment')->where('asmt_id', '=', $asmt_id)->update([
                  'uid' => $employeeData->uid,
                  'asmt_id' => $asmt_id,
                  'sa_remarks' => $remarks,
                  // 't_date' =>  $dateNow,
                  // 't_time' => $timeNow,
                  'sa_tdate' => $dateNow,
                  'sa_ttime' => $timeNow,
                  'draft' => $draftxt,
                  'complied' => $complied,
          ]);
              break;
            
            default:
              DB::table('app_assessment')->insert([
                  'uid' => $employeeData->uid,
                  'asmt_id' => $asmt_id,
                  'sa_remarks' => $remarks,
                  // 't_date' =>  $dateNow,
                  // 't_time' => $timeNow,
                  'sa_tdate' => $dateNow,
                  'sa_ttime' => $timeNow,
                  'draft' => $draftxt,
                  'complied' => $complied,
          ]);
              break;
          }
        }
          // session()->flash('save_success', 'Completed Assessment, you may now proceed to next step.');
          return $route;
      }
    }
    public function preassesscompletion(Request $request, $status){
      $employeeData = session('client_data');
      // $assessment = DB::table('assessment')->get();
      $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);

      $check_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '=', '0')->get();
      
      switch ($status) {
        case 'complied':
          $assessment = DB::table('assessment')->join('app_assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')->where('app_assessment.complied', '=', '1')->where('app_assessment.draft', '=', '0')->where('app_assessment.uid', '=', $employeeData->uid)->get();
          $result = '0';

          break;

        case 'notcomplied':
          $assessment = DB::table('assessment')->join('app_assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')->where('app_assessment.complied', '=', '0')->where('app_assessment.draft', '=', '0')->where('app_assessment.uid', '=', $employeeData->uid)->get();
          $result = '1';

          break;
        
        default:
          
          break;
      }
      return view('client.preassessment2', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment,'check_assessment'=>$check_assessment,'result'=>$result]);
    }
    public function preassessdraft(Request $request, $draft){
        if ($request->isMethod('get')) {
          $employeeData = session('client_data');
           $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);

      $check_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '=', $draft)->where('uid', '=', $employeeData->uid)->get();
          $assessment = DB::table('assessment')->join('app_assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')->where('app_assessment.draft', '=', $draft)->where('app_assessment.uid','=',$employeeData->uid)->get();
        }
        return view('client.preassessment2', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment,'check_assessment'=>$check_assessment]);
    }
     public function status(Request $request){
      if($request->isMethod('get')){
        return view('client.status');
      }
    }
    public function payment(Request $request){
      if($request->isMethod('get')){
        return view ('client.payment');
      }
      if($request->isMethod('post')){
        return view ('client.payment');
      }
    }
    public function op_form(Request $req, $col, $id){
      $table = DB::table("appform")->where("draft", "=", $id)->first();
      $table1 = DB::table("app_upload")->where("app_id", "=", $table->appid)->first();
      session()->flash('curr_tbl',[$table, $table1]);
      return back();
    }
    public function addpersonnel(Request $request, $id_type){
      if($request->isMethod('get')){
        $table = DB::table('personnel')->leftjoin('personnelwork', 'personnelwork.pid', '=', 'personnel.pid')->leftjoin('position', 'position.posid', '=', 'personnelwork.posid')->select('personnelwork.*', 'posname', 'personnel.*')->where('appid', '=', $id_type)->get();
        // return back();
        // dd($table);
        return json_encode($table);
      }
      if ($request->isMethod('post')) {
        if($id_type == "personnel") {
            $data['lastname'] = $request->lastname;
            $data['firstname'] = $request->firstname;
            $data['middlename'] = $request->middlename;
            $data['birthdate'] = $request->birthdate;
            $data['gender'] = $request->gender;
            $data['appid'] = $request->appid;
            $data['bod'] = $request->birthdate;
            if(DB::table('personnel')->insert([
              'lastname' => $data['lastname'],
              'firstname' => $data['firstname'],
              'middlename' => $data['middlename'],
              'bod' => $data['birthdate'],
              'gender' => $data['gender'],
              'bod' => $data['bod'],
              'appid' => $data['appid']
            ])) {
              $id_p = DB::table('personnel')->orderBy('pid', 'desc')->limit(1)->select('pid')->first();
              $data['position'] = $request->position;
              $data['department'] = $request->department;
              $data['section'] = $request->section;
              $data['assigneddate'] = $request->assigneddate;
              $data['enddate'] = $request->enddate;
              DB::table('personnelwork')->insert([
                'pid' => $id_p->pid,
                'posid' => $data['position'],
                'depid' => $data['department'],
                'secid' => $data['section'],
                'assigndate' => $data['assigneddate'],
                'enddate' => $data['enddate']
              ]);
            }
            return 'DONE';
        }
        if($id_type == "eligibility"){
          $id_p = DB::table('personnel')->orderBy('pid', 'desc')->limit(1)->select('pid')->first();
          $data['plid'] = $request->plid;
          $data['expiration'] = $request->expiration;
          DB::table('peligibility')->insert([
            'pid' => $id_p->pid,
            'plid' => $data['plid'],
            'expiration' => $data['expiration']
          ]);
          return 'DONE';
        }

        if($id_type == "trainings"){
          $id_p = DB::table('personnel')->orderBy('pid', 'desc')->limit(1)->select('pid')->first();
          $data['school'] = $request->school;
          $data['course'] = $request->course;
          $data['datestart'] = $request->datestart;
          $data['datefinish'] = $request->datefinish;
          $data['tt_id'] = $request->tt_id;
          DB::table('ptrainings')->insert([
            'pid' => $id_p->pid,
            'tt_id' => $data['tt_id'],
            'school' => $data['school'],
            'course' => $data['course'],
            'datestart' => $data['datestart'],
            'datefinish' => $data['datefinish']
          ]);
          return 'DONE';
        }
            
            // $data['position'] = $request->position;
            // $data['department'] = $request->department;
            // $data['section'] = $request->section;
            // $data['assigneddate'] = $request->assigneddate;
            // $data['enddate'] = $request->enddate;
            // $data['plid'] = $request->plid;
            // $data['expiration'] = $request->expiration;
            // $data['ptid'] = $request->ptid;
            // $data['school'] = $request->school;
            // $data['course'] = $request->course;
            // $data['datestart'] = $request->datestart;
            // $data['datefinish'] = $request->datefinish;
            // $personnel = DB::table('personnel')->insert([
            //   'lastname' => $data['lastname'],
            //   'firstname' => $data['firstname'],
            //   'middlename' => $data['middlename']
            // ]);
            // return 'DONE';
      }
    }

  public function goToken(Request $req, $token, $pmt) {
    $desc = Session::get('desc'); $amount = Session::get('amount'); $hfser_id = Session::get('hfser_id'); $chgapp_id = Session::get('chgapp_id'); $appform_id = Session::get('appform_id'); $hfser_desc = Session::get('hfser_desc'); $client_save = session('client_data'); $dt = Carbon::now(); $employeeData = session('client_data'); $FileUploaded = ""; $reqdate = "";
    if(($desc != null) && ($amount != null) && ($hfser_id != null) && ($chgapp_id != null) && ($appform_id != null) && ($hfser_desc != null)) {
      if($req->isMethod('post')) {
        if(isset($req->au_file)) {
          $FileUploaded = $req->au_file;
          if($FileUploaded != null) {
            $filename = $FileUploaded->getClientOriginalName(); 
            $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
            $fileExtension = $FileUploaded->getClientOriginalExtension();
            $fileNameToStore = $employeeData->uid.'_'.$appform_id.'_PAYMENT.'.$fileExtension;
            $path = $FileUploaded->storeAs('public/uploaded', $fileNameToStore);
            $fileSize = $FileUploaded->getClientSize();
          } else {
            $fileNameToStore = ((count($sqlCheckAss) < 1) ? null : $sqlCheckAss[0]->fileName);
          }
          $InsertUpload = array(
            'app_id' => $appform_id,
            'upid'=>   NULL,
            'filepath'=> $fileNameToStore,
            'fileExten' => $fileExtension,
            'fileSize' => $fileSize,
            't_date' => $dt->toDateString(),
            't_time' => $dt->toTimeString(),
            'ipaddress' =>request()->ip()
          );
          DB::table('app_upload')->insert($InsertUpload);
        }
        if(isset($req->au_ref)) {
          $desc[(count($desc) - 1)] = $req->au_ref;
        }
        if(isset($req->au_amount)) {
          $amount[(count($amount) - 1)] = ($req->au_amount * -1);
        }
        if(isset($req->au_date)) {
          $reqdate = $req->au_date;
        } 
      }
      if($req->isMethod('get')) {

      }
      $getLstAu = DB::table('app_upload')->orderBy('apup_id', 'desc')->select('apup_id')->limit(1)->first();
      for($i = 0; $i < count($amount); $i++) {
        $chg_num = DB::table('chg_app')->where('chgapp_id', '=', (($chgapp_id[$i] == "") ? $pmt : $chgapp_id[$i]))->select('chg_num')->first();
        DB::table('chgfil')->insert([
          'chgapp_id'=>(($chgapp_id[$i] == "") ? $pmt : $chgapp_id[$i]),
          'chg_num'=>($chg_num->chg_num ?? 0),
          'appform_id'=>$appform_id,
          'chgapp_id_pmt'=>$pmt,
          'au_id'=>((isset($req->au_file)) ? $getLstAu->apup_id : NULL),
          'au_date'=>((isset($req->au_date)) ? $reqdate : NULL),
          'reference'=>$desc[$i],
          'amount'=>$amount[$i],
          't_date'=>$dt->toDateString(),
          't_time'=>$dt->toTimeString(),
          't_ipaddress'=>request()->ip(),
          'uid'=>$client_save->uid,
          'sysdate'=>$dt->toDateString(),
          'systime'=>$dt->toTimeString()
        ]);
        if($chgapp_id[$i] != "") {
          $updChgnum = array('chg_num'=>(intval($chg_num->chg_num) + 1));
          DB::table('chg_app')->where('chgapp_id', '=', $chgapp_id[$i])->update($updChgnum);
        } else {
          if($pmt != "") {
            $updChgnum = array('chg_num'=>(intval($chg_num->chg_num) + 1));
            DB::table('chg_app')->where('chgapp_id', '=', $pmt)->update($updChgnum);
          }
        }
      }
      if($pmt != "") {
        $updAppstat = array('status'=>'PP');
        DB::table('appform')->where('appid', '=', $appform_id)->update($updAppstat);
      }
      Session::forget('desc'); Session::forget('amount'); Session::forget('hfser_id'); Session::forget('chgapp_id'); Session::forget('appform_id'); Session::forget('hfser_desc');
      session()->flash('succ_mess', 'Successfully updated payment information.');
      return redirect()->route('client.home');
    } else {
      session()->flash('succ_mess', 'No record selected.');
      return redirect()->route('client.home');
    }
  }

  public function delete_pform(Request $req, $pid) {
    if($req->isMethod('post')) {
      $tables = ['ptrainings', 'peligibility', 'personnelwork', 'personnel'];
      for($i = 0; $i < count($tables); $i++) {
        DB::table($tables[$i])->where('pid', '=', $pid)->delete();
      }
      return 'Successfully deleted personnel';
    }
    if($req->isMethod('get')) {
      $tables = ['ptrainings', 'peligibility', 'personnelwork', 'personnel'];
      for($i = 0; $i < count($tables); $i++) {
        DB::table($tables[$i])->where('pid', '=', $pid)->delete();
      }
      return 'Successfully deleted personnel';
    }
  }

  public function preassessmentstat(Request $req, $status) {
      $dt = Carbon::now();
      $dateNow = $dt->toDateString();
      $timeNow = $dt->toTimeString();
      $employeeData = session('client_data');
      $assessment = DB::table('assessment')->get();
      $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);
      $userSql = "SELECT asp.*, asm.asmt_name, asm.partid, asm.asmt_use FROM app_assessment asp LEFT JOIN assessment asm ON asp.asmt_id = asm.asmt_id WHERE uid = '$employeeData->uid' AND draft = '0'";
      $userSql_chk = "SELECT asp.*, asm.asmt_name, asm.partid, asm.asmt_use FROM app_assessment asp LEFT JOIN assessment asm ON asp.asmt_id = asm.asmt_id WHERE uid = '$employeeData->uid' AND draft = '0' AND complied = '1'";
      $userAssessment = DB::select($userSql);
      $userAssessment_chk = DB::select($userSql_chk);
      $countass = DB::table('part')->get();
    if($req->isMethod('get')) {
      if(count($userAssessment) < 1 || count($assessment) == count($userAssessment_chk)) {
        if(count($assessment) == count($userAssessment_chk) && $status == "view") {
          return view('client.preassessment', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment, 'status'=>'update', 'userAssessment'=>$userAssessment, 'countass'=>$countass, 'iscomplied'=>true, 'isview'=>true]);
        } else {
          return redirect()->route('client.home');
        }
      } else {
        return view('client.preassessment', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment, 'status'=>'update', 'userAssessment'=>$userAssessment, 'countass'=>$countass, 'iscomplied'=>true, 'isview'=>false]);
      }
    }
    if($req->isMethod('post')) {
      // dd($req->all());
      // if($req->isstatus == "update") {
        for($i = 0; $i < count($req->upID); $i++) {
          if($req->complied[$req->upID[$i]] != null) {
            $newAsmt = $req->upID[$i];
            $newDraft = $req->isdraft;
            $sqlCheck = "SELECT app_assess_id, fileName FROM app_assessment WHERE uid = '$employeeData->uid' AND asmt_id = '$newAsmt' AND draft = '$newDraft'";
            $sqlCheckAss = DB::select($sqlCheck);
            $FileUploaded = $req->file[$req->upID[$i]];
            $fileNameToStore = null;

            if($FileUploaded != null && $FileUploaded != "uploaded") {
              $filename = $FileUploaded->getClientOriginalName(); 
              $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
              $fileExtension = $FileUploaded->getClientOriginalExtension();
              $fileNameToStore = $employeeData->uid.'_'.$newAsmt.'.'.$fileExtension;
              $path = $FileUploaded->storeAs('public/uploaded', $fileNameToStore);
              $fileSize = $FileUploaded->getClientSize();
            } else {
              $fileNameToStore = ((count($sqlCheckAss) < 1) ? null : $sqlCheckAss[0]->fileName);
            }
            if(count($sqlCheckAss) > 0) {
                try { if($sqlCheckAss[0]->fileName != null && ($FileUploaded != null && $FileUploaded != "uploaded")) { Storage::delete('public/uploaded/'.$sqlCheckAss[0]->fileName); } } catch(Exception $e) { }
              DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('asmt_id', '=', $newAsmt)->where('draft', '=', $newDraft)->update([
                // 'appid'=>$appid[0]->appid,
                'asmt_id'=>$req->upID[$i],
                'sa_remarks'=>$req->remarks[$req->upID[$i]],
                'sa_tdate'=>$dateNow,
                'sa_ttime'=>$timeNow,
                'fileName'=>$fileNameToStore,
                'draft'=>$req->isdraft,
                'complied'=>$req->complied[$req->upID[$i]],
                'uid'=>$employeeData->uid
              ]);
            } else {
              // dd($sqlCheck);
              DB::table('app_assessment')->insert([
                // 'appid'=>$appid[0]->appid,
                'asmt_id'=>$req->upID[$i],
                'sa_remarks'=>$req->remarks[$req->upID[$i]],
                'sa_tdate'=>$dateNow,
                'sa_ttime'=>$timeNow,
                'fileName'=>$fileNameToStore,
                'draft'=>$req->isdraft,
                'complied'=>$req->complied[$req->upID[$i]],
                'uid'=>$employeeData->uid
              ]);
            }
          }
        }
        return redirect()->route('client.home');
      // }
    }
  }

  public function preassessmentdraft(Request $req, $draft) {
    $dt = Carbon::now();
    $dateNow = $dt->toDateString();
    $timeNow = $dt->toTimeString();
    $employeeData = session('client_data');
    $assessment = DB::table('assessment')->get();
    $app_assessment = DB::table('app_assessment')->where('uid', '=', $employeeData->uid )->where('draft', '!=', '0')->distinct()->get(['draft', 'sa_tdate']);
    $userSql = "SELECT asm.*, asp.appid, asp.sa_remarks, asp.draft, asp.complied, asp.uid FROM assessment asm LEFT JOIN (SELECT * FROM app_assessment WHERE uid = '$employeeData->uid' AND draft = '$draft') asp ON asp.asmt_id = asm.asmt_id";
    $userSql_chk = "SELECT asp.*, asm.asmt_name, asm.partid, asm.asmt_use FROM app_assessment asp LEFT JOIN assessment asm ON asp.asmt_id = asm.asmt_id WHERE uid = '$employeeData->uid' AND draft = '$draft' AND complied = '1'";
    $userAssessment = DB::select($userSql);
    $userAssessment_chk = DB::select($userSql_chk);
    $countass = DB::table('part')->get();
    if($req->isMethod('get')) {
      if($draft != "") {
        if(count($userAssessment) < 1) {
          return redirect()->route('client.home');
        } else {
          return view('client.preassessment', ['assessment'=>$assessment, 'app_assessment'=>$app_assessment, 'status'=>'update', 'userAssessment'=>$userAssessment, 'countass'=>$countass, 'drafts'=>$draft, 'iscomplied'=>false, 'isview'=>false]);
        }
      } else {
        return redirect()->route('client.home');
      }
    }
    if($req->isMethod('post')) {
      // if($req->isstatus == "update") {
        for($i = 0; $i < count($req->upID); $i++) {
          if($req->complied[$req->upID[$i]] != null) {
            $newAsmt = $req->upID[$i];
            $newDraft = $req->isdraft;
            $sqlCheck = "SELECT app_assess_id, fileName FROM app_assessment WHERE uid = '$employeeData->uid' AND asmt_id = '$newAsmt' AND draft = '$newDraft'";
            $sqlCheckAss = DB::select($sqlCheck);
            $FileUploaded = $req->file[$req->upID[$i]];
            $fileNameToStore = null;

            if($FileUploaded != null && $FileUploaded != 'uploaded') {
              $filename = $FileUploaded->getClientOriginalName(); 
              $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
              $fileExtension = $FileUploaded->getClientOriginalExtension();
              $fileNameToStore = $employeeData->uid.'_'.$newAsmt.'.'.$fileExtension;
              $path = $FileUploaded->storeAs('public/uploaded', $fileNameToStore);
              $fileSize = $FileUploaded->getClientSize();
            } else {
              $fileNameToStore = ((count($sqlCheckAss) < 1) ? null : $sqlCheckAss[0]->fileName);
            }
            if(count($sqlCheckAss) > 0) {
                try { if($sqlCheckAss[0]->fileName != null && ($FileUploaded != null && $FileUploaded != "uploaded")) { Storage::delete('public/uploaded/'.$sqlCheckAss[0]->fileName); } } catch(Exception $e) { }
              DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('asmt_id', '=', $newAsmt)->where('draft', '=', $newDraft)->update([
                // 'appid'=>$appid[0]->appid,
                'asmt_id'=>$req->upID[$i],
                'sa_remarks'=>$req->remarks[$req->upID[$i]],
                'sa_tdate'=>$dateNow,
                'sa_ttime'=>$timeNow,
                'fileName'=>$fileNameToStore,
                'draft'=>$req->isdraft,
                'complied'=>$req->complied[$req->upID[$i]],
                'uid'=>$employeeData->uid
              ]);
            } else {
              // dd($sqlCheck);
              DB::table('app_assessment')->insert([
                // 'appid'=>$appid[0]->appid,
                'asmt_id'=>$req->upID[$i],
                'sa_remarks'=>$req->remarks[$req->upID[$i]],
                'sa_tdate'=>$dateNow,
                'sa_ttime'=>$timeNow,
                'fileName'=>$fileNameToStore,
                'draft'=>$req->isdraft,
                'complied'=>$req->complied[$req->upID[$i]],
                'uid'=>$employeeData->uid
              ]);
            }
          }
        }
        return redirect()->route('client.home');
      // }
    }
  }
  public function evaluate1(Request $req) {
    $data = session('client_data');
    if ($data != null) {
    $uploadSql = "SELECT hf.* FROM hfaci_serv_type hf INNER JOIN appform ap ON hf.hfser_id = ap.hfser_id WHERE ap.uid = '$data->uid'";
    $upload = DB::select($uploadSql);
    $uploadSql1 = "SELECT hf.*, au.* FROM app_upload au LEFT JOIN appform ap ON au.app_id = ap.appid INNER JOIN hfaci_serv_type hf ON hf.hfser_id = ap.hfser_id WHERE ap.uid = '$data->uid'";
    $upload1 = DB::select($uploadSql1);
    if($req->isMethod('get')) {
      $sql = "SELECT af.appid, af.uid, af.hfser_id, af.recommendeddate AS proposedInspectiondate, af.recommendedtime AS proposedInspectiontime, af.isrecommended AS isInspected, GROUP_CONCAT(COALESCE(au.evaluation, 0)) AS evaluation, GROUP_CONCAT(REPLACE(up.upid, ',', '')) AS upid, GROUP_CONCAT(REPLACE(up.updesc, ',', '')) AS updesc, GROUP_CONCAT(REPLACE(COALESCE(au.remarks, '-'), ',', '')) AS remarks FROM app_upload au LEFT JOIN upload up ON au.upid = up.upid LEFT JOIN appform af ON au.app_id = af.appid WHERE af.uid = '$data->uid' GROUP BY af.appid, af.uid, af.hfser_id, af.recommendeddate, af.recommendedtime, af.isrecommended";
      $getSql = DB::select($sql);
      if(count($getSql) > 0) {
        return view('client.evaluate', ['evaluate'=>$getSql, 'upload'=>$upload]);
      } else {
        // return view('client.home', ['err_msg'=>'Error']);
        return view('client.evaluate', ['evaluate'=>[], 'upload'=>[]]);
      }
    } else { 

    }
        }else{
          return redirect()->route('client');
        }
  }
  public function modifiers(Request $request){
    if($request->isMethod('get')) {
      return view('client.modifiers');
    }
  }
  public function viewapply(Request $req, $appform1) {
    if($req->isMethod("get")) {
      // session()->flash('taeform', $appform);
      $personnel =DB::table('personnel')->get();
      $selectedType = strtoupper($appform1);
      $position = DB::table('position')->get();
      $plicensetype = DB::table('plicensetype')->get();
      $section = DB::table('section')->get();
      $department = DB::table('department')->get();
      $traintype = DB::table('ptrainings_trainingtype')->get();
      $asd = session('client_data');
      $appform = DB::table('appform')->where("uid", "=", $asd->uid)->where([["draft", "!=", "0"], ["hfser_id", "=", $selectedType]])->get();
      $fatype = DB::table('type_facility')
                        ->join('facilitytyp','type_facility.facid', '=', 'facilitytyp.facid')
                        ->select('type_facility.*','facilitytyp.*')
                        ->where('type_facility.hfser_id','=', $selectedType)
                        ->get(); // Facility Type
      $ownsh = DB::table('ownership')->get(); // Ownership Type
      $aptyp = DB::table('apptype')->get(); // Application Stype
      $clss = DB::table('class')->get(); // Class
      
      $hfaci = DB::table('hfaci_serv_type')->where('hfser_id','=',$selectedType)->first();
      $upld = DB::table('facility_requirements')
                        ->join('upload','facility_requirements.upid','=','upload.upid')
                        ->join('type_facility','facility_requirements.typ_id', '=', 'type_facility.tyf_id')
                        ->select('facility_requirements.*','upload.*','type_facility.*')
                        ->where('type_facility.hfser_id','=', $selectedType)
                        ->get();
      $appidinc = DB::table("appform")->orderBy('appid', 'desc')->limit(1)->select("appid")->first();            
      // $upld = DB::table('upload')->where('hfser_id','=',$id_type)->get();
      $sendform = DB::table('appform')->where('uid', '=', $asd->uid)->where('hfser_id', '=', $selectedType)->orderBy('t_date', 'desc')->limit(1)->select("*")->first();
      if($sendform == null || empty($sendform)) {
        $sendform1 = [];
      } else {
        $sendform1 = DB::table('app_upload')->where('app_id', '=', $sendform->appid)->select("*")->get();       
      }
      $imongmama = "SELECT ap.uid FROM (SELECT * FROM appform WHERE uid = '$asd->uid' AND hfser_id = '$selectedType' ORDER BY t_date DESC LIMIT 1) ap INNER JOIN trans_status ts ON ap.status = ts.trns_id WHERE ts.canapply IN (2)";
      $tothemagical = DB::select($imongmama);
      if(count($tothemagical) > 0) {
        return view('client.appform', ['appform'=>$appform, 'fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci->hfser_desc,'id_type'=>$appform1,'uploads'=>$upld, 'position'=>$position, 'section'=>$section, 'department'=>$department, 'traintype'=>$traintype, 'plicensetype'=>$plicensetype, 'appidinc'=>$appidinc->appid+1, 'isview'=>true, 'sendform'=>[$sendform, $sendform1]]);
      } else {
        return redirect()->route('client.home');
      }
    }
  } 
  public function getNotif(Request $req, $uid) {
    $data = session('client_data');
    if($req->isMethod('get')) {
      $sql = DB::table('notificiationlog')->where('uid', '=', $uid)->select('*')->orderBy('notfdate')->get();
      echo $sql;
    } else {

    }
  }
  public function chgNotif(Request $req, $uid, $nid) {
    $data = session('client_data');
    if($req->isMethod('get')) {
      $sql = DB::table('notificiationlog')->where('notfid', '=', $nid)->where('uid', '=', $uid)->select('*')->orderBy('notfdate')->get();
      if(DB::table('notificiationlog')->where('uid', '=', $uid)->update(['status'=>1])) {
        echo $sql;
      } else {
        echo $sql;
      }
    } else {

    }
  }
}
