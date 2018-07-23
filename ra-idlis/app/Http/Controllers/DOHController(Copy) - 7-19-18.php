<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Carbon\Carbon;
	use Exception;
	use Hash;
	
	class DOHController extends Controller
	{
		public function InsertActLog($mod_id,$action){
			$Cur_useData = $this->getCurrentUserAllData();
			DB::table('activitylogs')->insert(
		                [
		                	'mod_id' => $mod_id,
		                	'acttime' => $Cur_useData['time'],
		                	'actdate' => $Cur_useData['date'],
		                	'ipaddress' => $Cur_useData['ip'],
		                	'act' => $action,
		                    'uid' => $Cur_useData['cur_user']
		                ]
		            );
			return 'DONE';
		}
		public function getCurrentUserAllData(){
			$dt = Carbon::now();
	        $dateNow = $dt->toDateString();
	        $timeNow = $dt->toTimeString();
	        $ip =  request()->ip();
	        $employeeData = session('employee_login');
			$uname  = $employeeData->uid;
			$data['time'] = $timeNow;
			$data['date'] = $dateNow;
			$data['ip'] = $ip;
			$data['cur_user'] = $uname;
			return $data;
		}
		public function getSettings(){
			$grpid = session()->get('employee_login');
			$rights = DB::table('x06')
                    			->where('grp_id', '=', $grpid->grpid)
                    			->select('mod_id','allow','ad_d','upd','cancel', 'print','view')
                    			->get();
			return $rights;
		}
		public function getSettings2(){
			$grpid = session()->get('employee_login');
			$rights = DB::table('x06')
                    			->where('grp_id', '=', $grpid->grpid)
                    			->select('mod_id','allow','ad_d','upd','cancel', 'print','view')
                    			->get();
			return response()->json($rights);
		}
		public function login(Request $request){
			if($request->isMethod('get')){
	   			return view('doh.login');
	   		}
	   		if ($request->isMethod('post')) {
	   			$uname = strtoupper($request->uname);
	   			$pass= $request->pass;
	   			$data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['grpid', '!=', 'C'] ])
                    ->select('*')
                    ->first();
                if ($data) {
                	$chck = Hash::check($pass, $data->pwd);
                	if ($chck == true) {
	                		if ($data->isActive == 1) {
	                		$employeeData =	DB::table('x08')
		                                ->join('region', 'x08.rgnid', '=', 'region.rgnid')
		                                ->select('x08.*', 'region.rgn_desc')
		                                ->where('x08.uid', '=', $data->uid)
		                                ->first()
		                                ;
		                    $x = $employeeData->mname;
		                    if ($x != "") {
		                    	$mid = strtoupper($x[0]);
		                    	$mid = $mid.'. ';
		                    } else {
		                    	$mid = ' ';
		                    }
		                    $rights = DB::table('x06')
		                    			->where('grp_id', '=', $employeeData->grpid)
		                    			->get();
		                    $name = $employeeData->fname.' '.$mid.''.$employeeData->lname;
		                    $employeeData->name = $name;
		                	session()->put('employee_login',$employeeData);
		                	
		                	// return json_encode($rights);
		                	$test = $this->getSettings();
		                	session()->put('arr', $test);

		                	return redirect()->route('eDashboard');
	                	} else {
	                		session()->flash('dohUser_login','Account Deactivate, Contact nearest Regional Administrator/National Administrator.');
	                	return back();
	                	}
                	} else {
                		session()->flash('dohUser_login','Invalid Username/Password');
                		return back();
                	}
                } else {
                	session()->flash('dohUser_login','Invalid Username/Password');
                	return back();
                }
	   			
	   		}
		}
		public function logout(Request $request){
			session()->forget('employee_login');
      		session()->flash('dohUser_logout','Successfully Logout');
			return redirect()->route('employee');
		}
		public function dashboard(){
			return view('doh.dashboard');
		}
		public function regionalAdmins(Request $request){ // Personnel/Regional Admin Page
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				$users = DB::table('x08')
						->where('grpid', '=', 'RA')
						->select('*')
						->first()
						;
				if ($users) {
					$users = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->where('grpid', '=', 'RA')
						->select('x08.*','region.*')
						->get()
						;
						// $name = $employeeData->fname.' '.$mid.'. '.$employeeData->lname;
				}
				return view('doh.persoreg',['region'=>$regions,'users'=>$users]);
			}
			if ($request->isMethod('post')) {
				$dt = Carbon::now();
	          	$dateNow = $dt->toDateString();
	          	$timeNow = $dt->toTimeString();
				$data['fname'] = $request->fname;
				$data['mname'] = $request->mname;
				$data['lname'] = $request->lname;
				$data['rgnid'] = $request->rgn;
				$data['email'] = $request->email;
				$data['cntno'] = $request->cntno;
				$data['uname'] = strtoupper($request->uname);
				$data['pass'] = Hash::make($request->pass);
				$data['ip'] = request()->ip();
				// checkUser
				$checkUser = DB::table('x08')
                    ->where([ ['uid', '=', $data['uname']], ['pwd', '=', $data['pass']] ])
                    ->select('*')
                    ->first();
				if ($checkUser) {
					return 'SAME';
				} else {
					$addedby = session()->get('employee_login');
					DB::table('x08')->insert(
		                [
		                    'uid' => $data['uname'],
		                    'pwd' => $data['pass'],
		                    'rgnid' => $data['rgnid'],
		                    'contact' => $data['cntno'],
		                    'email' => $data['email'],
		                    'fname' => $data['fname'],
		                    'mname' => $data['mname'],
		                    'lname' => $data['lname'],
		                    'ipaddress' => $data['ip'],
		                    't_date' => $dateNow,
		                    't_time' =>$timeNow,
		                    'grpid' => 'RA',
		                    'isActive' => 1,
		                    'isAddedBy' => $addedby->uid,
		                ]
		            );
					return 'DONE';
				}
			}			
		}
		public function TypeFacility (Request $request){
			if ($request->isMethod('get')) {
				// $d = "";
				// INSERT INTO facility_requirements (`typ_id`,`upid`,`fr_alw`) 
				// SELECT (SELECT tyf_id FROM type_facility WHERE tyf_id = '21'), upid, COALESCE(0) 
				// FROM upload;
				
				///////////////////////// DO NOT DELETE PLEASE!!! - MHEL
				// $test = DB::table('type_facility')->select('tyf_id')->get();
				// for ($i=0; $i < count($test); $i++) { 
				// 	$d = $test[$i]->tyf_id;
				// 	DB::insert('INSERT INTO facility_requirements (`typ_id`,`upid`,`fr_alw`) 
				// 				SELECT (SELECT tyf_id FROM type_facility WHERE tyf_id = ?), upid, COALESCE(0)
				// 				FROM upload', [$d]);
				// }
				// return 'DONE';
				///////////////////////// DO NOT DELETE PLEASE!!!! - MHEL

				$type = DB::table('hfaci_serv_type')->get();
				$facility = DB::table('facilitytyp')->get();
				$uploads = DB::table('upload')->get();
				$oops = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
				// return dd($oops);
				//,['rights'=>$groupRights, 'groups'=>$group, 'modules'=>$module]
				return view('doh.mftypefa',['types'=>$type,'facilitys'=>$facility,'uploads'=>$uploads, 'oops' => $oops]); 
			}
			if ($request->isMethod('post')) {
				$chckSameData = DB::table('type_facility')
									->where('hfser_id','=',$request->hfser_id)
									->where('facid','=',$request->facid)
									->first();
				if (!$chckSameData) {
						DB::table('type_facility')->insert(
										[
											'hfser_id'=>$request->hfser_id,
											'facid'=>$request->facid,
											'oop_id' => 'N',
										]
									);
						return "DONE";
				} else{
					return "SAME";
				}
			}
		}
		public function groupRights(Request $request){ // GROUP RIGHTS PAGE
			if ($request->isMethod('get')) {
				$group = DB::table('x07')->select('*')->get();
				$module = DB::table('x05')->select('*')->get();
				$groupRights = DB::table('x06')
				// ->join('orders', 'users.id', '=', 'orders.user_id')
								->join('x05', 'x06.mod_id','=','x05.mod_id')
								->join('x07', 'x06.grp_id', '=', 'x07.grp_id')
								->select('x06.*', 'x05.*', 'x07.*')
								->get()
								;
				// return response()->json(['rights'=>$groupRights]);
				return view('doh.grprights',['rights'=>$groupRights, 'groups'=>$group, 'modules'=>$module]); 
					// ['groups'=>$group], ['modules'=>$module]);
			}
		}
		public function regions(Request $request){ // Places/Regions Page
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				return view('doh.phregion',['region'=>$regions]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('region')->insert(
					[
						'rgnid' => $request->id,
						'rgn_desc' => $request->name,
					]
				);
				return 'DONE';
			}
		}
		public function provinces(Request $request){ // Places/Provinces Page
			if ($request->isMethod('get')) {
				$province = DB::table('province')->get();
				$regions = DB::table('region')->get();
				return view('doh.phprovince',['province'=>$province],['region'=>$regions]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('province')->insert(
					[
						'rgnid' => $request->id,
						'provname' => $request->name,
					]
				);
				return 'DONE';
			}
		}
		public function LOfficers(Request $request){ // Personnel/Licensing Officer Page
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				$testX = session('employee_login');
				if ($testX->grpid == "NA") {
					$users = DB::table('x08')
						->where('grpid', '=', 'LO')
						->select('*')
						->first()
						;
					if ($users) {
						$users = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->where('grpid', '=', 'LO')
						->select('x08.*','region.*')
						->get()
						;
						return view('doh.persolo',['region'=>$regions,'users'=>$users]);
				} 
			}else {
					$users = DB::table('x08')
						->where('grpid', '=', 'LO')
						->where('rgnid', '=', $testX->rgnid)
						->select('*')
						->first()
						;
					if ($users) {
						$users = DB::table('x08')
							->join('region', 'x08.rgnid', '=', 'region.rgnid')
							->where('x08.grpid', '=', 'LO')
							->where('region.rgnid', '=', $testX->rgnid)
							->select('x08.*','region.*')
							->get()
							;
				}
			return view('doh.persolo',['region'=>$regions,'users'=>$users]);
			}
		}
			if($request->isMethod('post')){
				$dt = Carbon::now();
	          	$dateNow = $dt->toDateString();
	          	$timeNow = $dt->toTimeString();
				$data['fname'] = $request->fname;
				$data['mname'] = $request->mname;
				$data['lname'] = $request->lname;
				$data['rgnid'] = $request->rgn;
				$data['email'] = $request->email;
				$data['cntno'] = $request->cntno;
				$data['uname'] = strtoupper($request->uname);
				$data['pass'] = Hash::make($request->pass);
				$data['ip'] = request()->ip();
				// checkUser
				$checkUser = DB::table('x08')
                    ->where([ ['uid', '=', $data['uname']], ['pwd', '=', $data['pass']] ])
                    ->select('*')
                    ->first();
				if ($checkUser) {
					return 'SAME';
				} else {
					$addedby = session()->get('employee_login');
					DB::table('x08')->insert(
		                [
		                    'uid' => $data['uname'],
		                    'pwd' => $data['pass'],
		                    'rgnid' => $data['rgnid'],
		                    'contact' => $data['cntno'],
		                    'email' => $data['email'],
		                    'fname' => $data['fname'],
		                    'mname' => $data['mname'],
		                    'lname' => $data['lname'],
		                    'ipaddress' => $data['ip'],
		                    't_date' => $dateNow,
		                    't_time' =>$timeNow,
		                    'grpid' => 'LO',
		                    'isActive' => 1,
		                    'isAddedBy' => $addedby->uid,
		                ]
		            );
					return 'DONE';
				}
			
			}
		}
		public function chckgr(Request $request){
			DB::table('x07')->insert(
				[
					'grp_id' => $request->id,
					'grp_desc' => $request->name, 
				]
			);
			// DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
			DB::insert('INSERT INTO x06 (`grp_id`, `mod_id`, `allow`, `ad_d`, `upd`, `cancel`, `print`, `view`) 
						SELECT COALESCE(?), mod_id, COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1)
						FROM x05', [$request->id]);
			return "DONE";			
		}
		public function lps(){ // Licensing Status Page
			// $bigChunkOfData = DB::table('appform')->get();
			$employeeData = session('employee_login');

			// if ($employeeData->grpid == 'NA') {
			// 	$region 
			// }
			$region = DB::table('region')->get();
			$type = DB::table('hfaci_serv_type')->get();
			$facility = DB::table('facilitytyp')->get();
			return view('doh.lps',['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
		}
		public function evalute(Request $request){
			if ($request->isMethod('get')) {
				$employeeData = session('employee_login');
				$region = DB::table('region')->get();
				$type = DB::table('hfaci_serv_type')->get();
				$facility = DB::table('facilitytyp')->get();
				return view('doh.lpsevaluate', ['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
			}
		}
		public function  EvalOne(Request $request, $appid){
			if ($request->isMethod('get')) {
				$data0 = DB::table('appform')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id') 
										->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
										->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'orderofpayment.*')
										->where('appform.appid', '=', $appid)
										// , 'type_facility.*', 'orderofpayment.*'
										// ->where('type_facility.facid', '=', 'appform.facid')
										->first();
				if ($data0->recommendedtime !== null && $data0->recommendeddate !== null) {
					$newT = Carbon::parse($data0->recommendedtime);
					$data0->formattedPropTime = $newT->format('g:i A');
					$newD = Carbon::parse($data0->recommendeddate);
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
				$data6 = DB::table('appform')
										->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id')
										->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
										->where('type_facility.facid', '=', $data1[0]->facid)
										->where('appform.appid', '=', $appid)
										//,['appform.facid', '=', 'type_facility.facid']
										->first();
				$data7 = DB::table('appform_orderofpayment')
										->where('appid', '=', $appid)
										->first();						
				// return dd($data6);
				return view('doh.lpsevaluteOne', ['AppData'=> $data0, 'UploadData' => $data1, 'appID' => $appid, 'numOfX' => count($data2), 'numOfApp' => count($data3), 'numOfAprv'=> count($data4), 'numOfNull' => count($data5), 'OOPs' => $data6, 'OPPok' => $data7]);
			}
			if ($request->isMethod('post')) {
				$addedby = session()->get('employee_login');
				$dt = Carbon::now();
	          	$dateNow = $dt->toDateString();
	          	$timeNow = $dt->toTimeString();
				// appUp_ID = appup_id
				// evalYesNo = evaluation
				// remark = remarks
				$updateData = array(
						'evaluation'=>$request->evalYesNo,
						'evaluatedBy' => $addedby->uid,
						'evaltime' => $timeNow, 
						'evaldate' => $dateNow,
						'remarks' => $request->remark,
					);
				DB::table('app_upload')->where('apup_id', '=', $request->appUp_ID)->update($updateData);
				return back();
			}
		}
		public function ins1(){
			return view('doh.ins1');
		}
		public function ins2(){
			return view('doh.ins2');
		}
		public function ins3(){
			return view('doh.ins3');
		}
		public function ClassType(Request $request){ // Master File/Class Type Page
			if ($request->isMethod('get')) {
				$own = DB::table('ownership')->get();
				$class = DB::table('class')->get();
				return view('doh.mfcls',['own'=>$own, 'class'=> $class]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('class')->insert([
					'classid' => $request->id,
					'classname'=> $request->name,
					'ocid' => $request->ocid,
				]);
				return 'DONE';
			}
		}
		public function AppStatus(Request $request) { // Master File/Application Type Page
			if ($request->isMethod('get')) {
				$apptype = DB::table('apptype')->get();
				return view('doh.mfapptype',['apptype'=>$apptype]);
			}
			if ($request->isMethod('post')) { 
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('apptype')->insert(
				[
					'aptid' => $request->id,
					'aptdesc' => $request->name, 
				]
			);
				return "DONE";
			}
		}
		public function AppType(Request $request){ // Master File/Facility Type Page
			if ($request->isMethod('get')) {
				$fatype = DB::table('facilitytyp')->get();
				return view('doh.mffatype',['fa'=>$fatype]);
			}
			if ($request->isMethod('post')) {
				try {
					DB::table('facilitytyp')->insert([
						'facid' => $request->id,
						'facname' => $request->name,
					]);
					return 'DONE';
				} catch (Exception $e) {
					return $e->getMessage();
				}
			}
		}
		public function OwnShip(Request $request){ // Master File/Ownership Page
			if ($request->isMethod('get')) {
				$oShip = DB::table('ownership')->get();
				return view('doh.mfoship',['oShip'=>$oShip]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('ownership')->insert([
						'ocid' => $request->id,
						'ocdesc' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function CityMuni(Request $request) { // Places/City/Municipality Page
			if ($request->isMethod('get')) {
				$region = DB::table('region')->get();
				$province = DB::table('province')->get();
				$CiMu = DB::table('city_muni')->get();
				return view('doh.phcm',['region'=>$region,'province'=>$province,'cm'=>$CiMu]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('city_muni')->insert([
					'provid' => $request->id,
					'cmname' => $request->name,
				]);
				return 'DONE';
			}
		}
		public function Brgy(Request $request){ // Places/Barangay Page
			if ($request->isMethod('get')) {
				$region = DB::table('region')->get();
				$province = DB::table('province')->get();
				$CiMu = DB::table('city_muni')->get();
				$brgy = DB::table('barangay')->get();
				return view('doh.phbrgy',['region'=>$region, 'province'=>$province, 'cm'=>$CiMu, 'brgy' => $brgy]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('barangay')->insert([
						'cmid' => $request->id,
						'brgyname' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function FDAs(Request $request){ // Master File/Food and Drug Page
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				$testX = session('employee_login');
				if ($testX->grpid == "NA") {
					$users = DB::table('x08')
						->where('grpid', '=', 'FDA')
						->select('*')
						->first()
						;
					if ($users) {
						$users = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->where('grpid', '=', 'FDA')
						->select('x08.*','region.*')
						->get()
						;
					return view('doh.fda',['region'=>$regions,'users'=>$users]);
				} 
				return view('doh.fda',['region'=>$regions,'users'=>$users]);
			}else {
					$users = DB::table('x08')
						->where('grpid', '=', 'FDA')
						->where('rgnid', '=', $testX->rgnid)
						->select('*')
						->first()
						;
					if ($users) {
						$users = DB::table('x08')
							->join('region', 'x08.rgnid', '=', 'region.rgnid')
							->where('x08.grpid', '=', 'FDA')
							->where('region.rgnid', '=', $testX->rgnid)
							->select('x08.*','region.*')
							->get()
							;
				}
			return view('doh.fda',['region'=>$regions,'users'=>$users]);
			}
		}
			if($request->isMethod('post')){
				$dt = Carbon::now();
	          	$dateNow = $dt->toDateString();
	          	$timeNow = $dt->toTimeString();
				$data['fname'] = $request->fname;
				$data['mname'] = $request->mname;
				$data['lname'] = $request->lname;
				$data['rgnid'] = $request->rgn;
				$data['email'] = $request->email;
				$data['cntno'] = $request->cntno;
				$data['uname'] = strtoupper($request->uname);
				$data['pass'] = Hash::make($request->pass);
				$data['ip'] = request()->ip();
				// checkUser
				$checkUser = DB::table('x08')
                    ->where([ ['uid', '=', $data['uname']], ['pwd', '=', $data['pass']] ])
                    ->select('*')
                    ->first();
				if ($checkUser) {
					return 'SAME';
				} else {
					$addedby = session()->get('employee_login');
					DB::table('x08')->insert(
		                [
		                    'uid' => $data['uname'],
		                    'pwd' => $data['pass'],
		                    'rgnid' => $data['rgnid'],
		                    'contact' => $data['cntno'],
		                    'email' => $data['email'],
		                    'fname' => $data['fname'],
		                    'mname' => $data['mname'],
		                    'lname' => $data['lname'],
		                    'ipaddress' => $data['ip'],
		                    't_date' => $dateNow,
		                    't_time' =>$timeNow,
		                    'grpid' => 'FDA',
		                    'isActive' => 1,
		                    'isAddedBy' => $addedby->uid,
		                ]
		            );
					return 'DONE';
				}
			
			}
		}
		public function Litype(Request $request){ // Master File/License Type Page
			if ($request->isMethod('get')) {
				$pltype = DB::table('plicensetype')->get();
				return view('doh.mflitype',['plitype'=>$pltype]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('plicensetype')->insert([
					'plid' => $request->id,
					'pldesc' => $request->name,
				]);
				return 'DONE';
			}
		}
		public function Train(Request $request){ // Personnel Training
			if ($request->isMethod('get')) {
				$train = DB::table('ptrainings_trainingtype')->get();
				return view('doh.mftrain',['train'=>$train]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('ptrainings_trainingtype')->insert(['ptid'=>$request->id,'ptdesc'=>$request->name]);
				return 'DONE';
			}
		}
		public function Upload(Request $request){ // Master File/Upload Page
			if ($request->isMethod('get')) {
				// $fatype = DB::table('facilitytyp')->get();
				// $hfsts = DB::table('hfaci_serv_type')->get();
				$ups = DB::table('upload')->orderBy('updesc', 'asc')->get();
				// 'facilitys'=>$fatype,'hfsts'=>$hfsts
				return view('doh.mfupload',['uploads'=>$ups]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('upload')->insert(['updesc'=>$request->name,'isRequired'=>$request->required]);
				return 'DONE';
			}
		}
		public function Dept(Request $request){ // Deaprtment
			if ($request->isMethod('get')) {
				$depts = DB::table('department')->get();
				return view('doh.mfdept',['depts'=>$depts]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('department')->insert([
					'depid' => $request->id,
					'depname' => $request->name,
				]);
				return 'DONE';
			}
		}
		public function Sec(Request $request){ // Section
			if ($request->isMethod('get')) {
				$depts = DB::table('department')->get();
				$sec = DB::table('section')->get();
				return view('doh.mfsec',['depts'=>$depts, 'secs'=>$sec]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('section')->insert([
					'secid' => $request->id,
					'secname' => $request->name,
					'depid' => $request->depid,	
				]);
				return 'DONE';
			}
		}
		public function WorkStatus(Request $request){ // Personnel Work Status
			if ($request->isMethod('get')) {
				$pworkstatus = DB::table('pwork_status')->get();
				return view('doh.mfpworkStatus', ['pwStats'=>$pworkstatus]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('pwork_status')->insert([
						'pworksid' => $request->id,
						'pworksname' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function Work(Request $request){ // Personnel Work 
			if ($request->isMethod('get')) {
				$work = DB::table('pwork')->get();
				return view('doh.mfpwork', ['works'=>$work]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('pwork')->insert([
						'pworkid' => $request->id,
						'pworkname' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function Part(Request $request){
			if ($request->isMethod('get')) {
				$part = DB::table('part')->get();
				return view('doh.mfpart', ['parts'=>$part]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('part')->insert([
						'partid' => $request->id,
						'partdesc' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function AsMent(Request $request){
			if ($request->isMethod('get')) {
				$asMent = DB::table('assessment')->get();
				$part = DB::table('part')->get();
				return view('doh.mfasment', ['asments'=>$asMent, 'parts'=>$part]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('assessment')->insert([
						'asmt_id' => $request->id,
						'asmt_name' => $request->name,
						'partid' => $request->partid,
					]);
				return 'DONE';
			}
		}
		public function PfView(Request $request){ // Process Flow/View
			if ($request->isMethod('get')) {
				$appForm = DB::table('appform')->get();
			}
		}
		public function PerSoNel(Request $request){ // Master File/Personnel/Personnel
			if ($request->isMethod('get')) {
				return view('doh.mfperso');
			}
		}
		public function FaServType(Request $request){
			if ($request->isMethod('get')) {
				$hfstype = DB::table('hfaci_serv_type')->get();
				return view('doh.mfFaServType', ['hfstypes'=>$hfstype]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('hfaci_serv_type')->insert([
						'hfser_id' => $request->id,
						'hfser_desc' => $request->name,
					]);
				return 'DONE';
			}
		}
		public function FaServ(Request $request){
			if ($request->isMethod('get')) {
				$hfstype = DB::table('hfaci_serv_type')->get();
				$fatype = DB::table('facilitytyp')->get();
				return view('doh.mfFaServ', ['hfstypes'=>$hfstype, 'fatypes'=>$fatype]);
			}
			if ($request->isMethod('post')) {
				$data = $this->InsertActLog($request->mod_id,"ad_d");
				DB::table('facilitytyp')->insert([
					'facid' => $request->id,
					'facname'=> $request->name,
					// 'hfser_id' => $request->hfser_id,
				]);
				return 'DONE';
			}
		}
		public function ActLogs(Request $request){
			if ($request->isMethod('get')) {
				// $employeeData = session('employee_login');
				// $uname  = $employeeData->uid;					
				// $actlogs = DB::table('activitylogs')
				// 			->join('x05','activitylogs.mod_id','=','x05.mod_id')
				// 			->select('activitylogs.*', 'x05.mod_desc')
				// 			->where('activitylogs.uid','=',$uname)
				// 			->get();

				// for ($i=0; $i < count($actlogs); $i++) {
				// 	$time = $actlogs[$i]->acttime;
				// 	$newT = Carbon::parse($time);
				// 	$actlogs[$i]->formattedTime = $newT->format('g:i A');

				// 	$date = $actlogs[$i]->actdate;
				// 	$newD = Carbon::parse($date);
				// 	$actlogs[$i]->formattedDate = $newD->toFormattedDateString();
				// 	// ->diffForHumans()
				// }
				// return response()->json($actlogs);
				return view('doh.actlogs');
			}
		}
		public function OrderOfPayment(Request $request){
			$data = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
			return view('doh.mfoop', ['oops'=>$data] );
		}
		public function EvalAddOOP(Request $request, $appid, $oop_id){
			if ($request->isMethod('get')) {
				$data0 = DB::table('appform')
									->join('x08', 'appform.uid', '=', 'x08.uid')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id') 
									->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
									->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'orderofpayment.*', 'region.rgn_desc')
									->where('appform.appid', '=', $appid)
											// , 'type_facility.*', 'orderofpayment.*'
											// ->where('type_facility.facid', '=', 'appform.facid')
									->first();
				$employeeData = session('employee_login');
				switch ($oop_id) {
					case 'CONPTC':
							return view('doh.oopCONPTCadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
						break;
					case 'OSSGHPN':
							return view('doh.oopOSSGHPNadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
						break;
					case 'DL':
							return view('doh.oopDLadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
						break;
					default:
							return back();
						break;
				}
			} /// END
			if ($request->isMethod('post')) {
				$Cur_useData = $this->getCurrentUserAllData();
				switch ($oop_id) {
					case 'CONPTC':
							DB::table('appform_orderofpayment')->insert([
									'appid' => $appid,
									'oop_id' => $oop_id,
									'data1' => $request->data1,
									'data1r' => $request->data1r,
									'data2' => $request->data2,
									'data2r' => $request->data2r,
									'data3' => $request->data3,
									'data3r' => $request->data3r,
									'data4' => $request->data4,
									'data4r' => $request->data4r,
									'data5' => $request->data5,
									'data5r' => $request->data5r,
									'data6' => $request->data6,
									'data6r' => $request->data6r,
									'data7' => $request->data7,
									'data7r' => $request->data7r,
									'data8' => $request->data8,
									'data8r' => $request->data8r,
									'data9' => $request->data9,
									'data9r' => $request->data9r,
									'data10' => $request->data10,
									'data10r' => $request->data10r,
									'data11' => $request->data11,
									'data11r' => $request->data11r,
									'data12' => $request->data12,
									'data12r' => $request->data12r,
									'data13' => $request->data13,
									'data13r' => $request->data13r,
									'data14' => $request->data14,
									'data14r' => $request->data14r,
									'oop_total' => $request->total,
									'oop_totalword' => $request->totalword,
									'oop_time' => $Cur_useData['time'],
									'oop_date' => $Cur_useData['date'],
									'oop_ip' => $Cur_useData['ip'],
									'uid' => $Cur_useData['cur_user'],
								]);
							return 'DONE';
						break;
					case 'OSSGHPN':
							DB::table('appform_orderofpayment')->insert([
									'appid' => $appid,
									'oop_id' => $oop_id,
									'data1' => $request->data1,
									'data2' => $request->data2,
									'data3' => $request->data3,
									'data4' => $request->data4,
									'data5' => $request->data5,
									'data6' => $request->data6,
									'data7' => $request->data7,
									'data8' => $request->data8,
									'data9' => $request->data9,
									'data10' => $request->data10,
									'data11' => $request->data11,
									'data12' => $request->data12,
									'data13' => $request->data13,
									'data14' => $request->data14,
									'data15' => $request->data15,
									'data16' => $request->data16,
									'data17' => $request->data17,
									'data18' => $request->data18,
									'data19' => $request->data19,
									'data20' => $request->data20,
									'data21' => $request->data21,
									'data22' => $request->data22,
									'data23' => $request->data23,
									'data24' => $request->data24,
									'data25' => $request->data25,
									'data26' => $request->data26,
									'data27' => $request->data27,
									'data28' => $request->data28,
									'data29' => $request->data29,
									'data30' => $request->data30,
									'data31' => $request->data31,
									'data32' => $request->data32,
									'data33' => $request->data33,
									'data34' => $request->data34,
									'data35' => $request->data35,
									'data36' => $request->data36,
									'data37' => $request->data37,
									'data38' => $request->data38,
									'data39' => $request->data39,
									'data40' => $request->data40,
									'data41' => $request->data41,
									'data42' => $request->data42,
									'data43' => $request->data43,
									'data44' => $request->data44,
									'data45' => $request->data45,
									'data46' => $request->data46,
									'data47' => $request->data47,
									'data48' => $request->data48,
									'data49' => $request->data49,
									'data50' => $request->data50,
									'data51' => $request->data51,
									'data52' => $request->data52,
									'data53' => $request->data53,
									'data54' => $request->data54,
									'data55' => $request->data55,
									'data56' => $request->data56,
									'oop_subtotal' => $request->subtotal,
									'oop_total' => $request->grandtotal,
									'oop_totalword' => $request->totalword,
									'oop_time' => $Cur_useData['time'],
									'oop_date' => $Cur_useData['date'],
									'oop_ip' => $Cur_useData['ip'],
									'uid' => $Cur_useData['cur_user'],
								]);
							return 'DONE';
						break;
					default:
						# code...
						break;
				}
			}
		}
		public function EvalViewOOP(Request $request, $appid, $oop_id){
			if ($request->isMethod('get')) {
				$data0 = DB::table('appform')
									->join('x08', 'appform.uid', '=', 'x08.uid')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id') 
									->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
									->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'orderofpayment.*', 'region.rgn_desc')
									->where('appform.appid', '=', $appid)
									->first();
				$data1 = DB::table('appform_orderofpayment')
									->where('appid', '=', $appid)
									->first();
				$newD = Carbon::parse($data1->oop_date);
				$data1->formattedPropDate = $newD->toFormattedDateString();
				$data2 = DB::table('x08')->select()->where('uid', '=', $data1->uid)->first();
				$x = $data2->mname;
		            if ($x != "") {
		                $mid = strtoupper($x[0]);
		                    $mid = $mid.'. ';
		                } else {
		                   	$mid = ' ';
		                }
		             $name = $data2->fname.' '.$mid.''.$data2->lname;
		             $data2->name = $name;
				// return dd($data2);
				switch ($oop_id) {
					case 'CONPTC':
							return view('doh.oopCONPTCview', ['AppData'=>$data0, 'EmployeeData' =>$data2, 'OOPDATA' => $data1, 'appid' => $appid, 'oop_id' => $oop_id]);
						break;
					case 'OSSGHPN':
							return view('doh.oopOSSGHPNview', ['AppData'=>$data0, 'EmployeeData' =>$data2, 'OOPDATA' => $data1, 'appid' => $appid, 'oop_id' => $oop_id]);
						break;	
					default:
						# code...
						break;
				}
			}
			if ($request->isMethod('post')) {
				
			}
		}
		public function Charges(Request $request){
			if ($request->isMethod('get')) {
				$data1 = DB::table('charges')->get();
				// return dd($data1);
				return view('doh.mfcharges',['Chrges'=>$data1]);
			}
			if ($request->isMethod('post')) {
				DB::table('charges')->insert(
					['chg_code'=> strtoupper($request->id),
					 'chg_desc'=> $request->name]	
					);
				return 'DONE';
			}
		}
		public function ChgOop(Request $request){
			if ($request->isMethod('get')) {
				$data1 = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
				$data2 = DB::table('charges')->get();
				// return dd($data1);
				return view('doh.mfChgOop',['OOPs'=>$data1, 'Chrgs' => $data2]);
			}
			if ($request->isMethod('post')) {
				/// oop_id
				/// chg_code
				$data1 = DB::table('chg_oop')->where([['chg_code','=',$request->chg_code],['oop_id', '=', $request->oop_id]])->first();
				if (!$data1) {
					DB::table('chg_app')->insert(['chg_code'=>$request->chg_code,'amt'=>0]);
					$last = DB::getPdo()->lastInsertId();
					$data2 = DB::table('chg_oop')
							->select('chgopp_seq')							
							->where('oop_id', '=', $request->oop_id)
							->orderBy('chgopp_seq','desc')->first();
					if (!$data2) {
						$data3 = 1;
					} else {
						$data3 = $data2->chgopp_seq  + 1;
					}
					// $data3 = (!$data2) ? 1 : $data2 +1;
					// return dd($data3);
					DB::table('chg_oop')->insert(['chg_code'=>$request->chg_code,'oop_id'=>$request->oop_id,'chgopp_seq'=>$data3,'chgapp_id'=>$last]);
					return 'DONE';
				} else {
					return 'SAME';
				}
				// return response()->json($data1);
				// return 'Hello';
			}
		}
	}
?>