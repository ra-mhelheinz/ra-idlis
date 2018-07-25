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
class ClientController extends Controller
{
    public function clientlogin(Request $request){
  		if($request->isMethod('get')){
        $regions = DB::table('region')->get();
        $province = DB::table('province')->get();
        $city_muni = DB::table('city_muni')->get();
         $brgy = DB::table('barangay')->get();
   			return view('client.login',['regions' => $regions, 'province' => $province, 'citymuni' => $city_muni, 'brgy' => $brgy]);
   		} 
        if($request->isMethod('post')){
            session()->flush();
            $uname=strtoupper($request->input('log_uname'));
            $pass= $request->input('log_pass');
            $pass = Hash::check('pass', $pass);
            $data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['pwd', '=', $pass], ['grpid', '=', 'C'] ])
                    ->select('*')
                    ->first();
            if ($data == null){
              
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
                    return redirect('/client/home');
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
    	if($request->isMethod('get')){
    		return view('client.index');
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
     public function evaluate(Request $request){
    	if($request->isMethod('get')){
    		return view('client.evaluate');
    	}
    }
    public function apply2(Request $request){
      if($request->isMethod('get')){
         $hfaci = DB::table('hfaci_serv_type')->get();
        return view('client.apply2', ['hfaci'=>$hfaci]);
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
    
    public function FORM(Request $request, $id_type){
      if ($request->isMethod('get')) {
          // ->join('region', 'x08.rgnid', '=', 'region.rgnid')
          //                           ->join('province', 'x08.province', '=', 'province.provid')
          //                           ->select('x08.*', 'region.rgn_desc', 'province.provname')
          //                           ->where('x08.uid', '=', $uname)
          //                           ->first()
            session()->flash('taeform', $id_type);
            $personnel =DB::table('personnel')->get();
            $selectedType = strtoupper($id_type);
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
               // return dd($upld);               
            // $upld = DB::table('upload')->where('hfser_id','=',$id_type)->get();
            return view('client.appform', ['appform'=>$appform, 'fatypes'=>$fatype,'ownshs'=>$ownsh,'aptyps'=>$aptyp,'clss'=>$clss, 'hfaci'=>$hfaci->hfser_desc,'id_type'=>$id_type,'uploads'=>$upld, 'position'=>$position, 'section'=>$section, 'department'=>$department, 'traintype'=>$traintype, 'plicensetype'=>$plicensetype, 'appidinc'=>$appidinc->appid+1]);
      }
        if ($request->isMethod('post')) {
              $employeeData = session('client_data');
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
                session()->flash('apply_succes',"Draft name already taken.");
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
    public function del_form(Request $req, $id) {
      $table = DB::table("appform")->where("appid", "=", $id)->delete();
      if($table) {
        $data1 = DB::table("app_upload")->where("app_id", "=", $id)->get();
        foreach($data1 as $data) {
          if(Storage::delete('public/uploaded/'.$data->filepath)) {
            $sqw = DB::table("app_upload")->where("app_id", "=", $id)->delete();
            if($sqw) {
              session()->flash('apply_succes','Successfully deleted file and form');
            } else {
              session()->flash('apply_succes','Successfully deleted file and form, but error on deleting file record of upload');
            }
          } else {
            session()->flash('apply_succes','Error on deleting file but successfully deleted form');
          }
        }
        return back();
      } else {
        session()->flash('apply_succes','Error on deleting form');
        return back();
      }
    }
    public function preassessment(Request $request){
        $assessment = DB::table('assessment')->get();
        $countass = DB::table('part')->get();
      if($request->isMethod('get')){
        return view('client.preassessment', ['assessment'=>$assessment, 'countass'=>$countass]);
      }
      if ($request->isMethod('post')) {
        // if (count($request->radio) > 0) {
        //   for ($i=0; $i < count($request->radio); $i++) { 
        //     dd($i);
        //   }
        // }
        // dd($request->all());
        $NewId = DB::getPdo()->lastInsertId();
        $employeeData = session('client_data');
        for ($i=0; $i < count($request->upID); $i++) {
            $dt = Carbon::now();
            $complied = $request->complied[$request->upID[$i]];
            $fileup = $request->file[$i];
            $remarks = $request->remarks[$i];
            $dateNow = $dt->toDateString(); /// Date
            $timeNow = $dt->toTimeString(); /// Time

            DB::table('app_assessment')->insert([
                    'uid' => $employeeData->uid,
                    'sa_remarks' => $remarks,
                    'sa_tdate' => $dateNow,
                    'sa_ttime' => $timeNow,
            ]);
             try { $filename = $fileup->getClientOriginalName(); } catch(Exception $e) {}
                                // $FileUploaded->store('public/uploaded');
                                // FILENAME
            try { $filenameOnly = pathinfo($filename,PATHINFO_FILENAME ); } catch(Exception $e) {} // FILE NAME ONLY
            // EXTENSION
            try { $fileExtension = $fileup->getClientOriginalExtension(); } catch(Exception $e) {}
                                // FILENAME TO STORE
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension; 
                                // UPLOAD FILE
            try { $path = $fileup->storeAs('public/uploaded', $fileNameToStore); } catch(Exception $e) {} // UPLOAD FILE
                                // FILE SIZE
            try { $fileSize = $fileup->getClientSize();   } catch(Exception $e) {}
                                /////////////////////////////////////////////////////// UPLOAD FILE
            $InsertUpload = array(
                'app_id' => $NewId,
                'filepath'=> $fileNameToStore,
                'fileExten' => $fileExtension,
                'fileSize' => $fileSize,
                't_date' => $dateNow,
                't_time' => $timeNow,
                'ipaddress' =>request()->ip(),
              );
            DB::table('app_upload')->insert($InsertUpload);

          }
        return view('client.index');
      }
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
}
