<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Str;
	use Carbon\Carbon;
	use Mail;
	use Exception;
	use Hash;
	use Storage;
	use Session;
	use DateTime;
	use DateTimeZone;

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
			$data['grpid'] = $employeeData->grpid;
			$data['rgnid'] = $employeeData->rgnid;
			return $data;
		}
		public function SystemLogs($message){
			$Cur_useData = $this->getCurrentUserAllData();
			$timedate = Carbon::now()->format('YmdHs');
			$name = $timedate.$Cur_useData['cur_user'].'RGN'.$Cur_useData['rgnid'];
			Storage::put('/system/logs/'.$name.'.txt', $message);
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
		public function verify_account(Request $request, $id){
     		try {
     			 $updateData = array('token'=>NULL);
			      $table = DB::table("x08")->where("token", "=", $id)->update($updateData);
			      if($table) {
			        session()->flash('dohUser_logout','Successfully verified account');
			        return redirect()->route('employee');
			      } else {
			      	$data = $this->SystemLogs('No data has been updated in x08 table upon verifying its account.');
			        session()->flash('dohUser_login','Account not verified! Error on verifying account. Account may have been verified or email doesnt exists');
			        return redirect()->route('employee');
			      }
     		} catch (Exception $e) {
     			$data = $this->SystemLogs($e->getMessage());
     			session()->flash('dohUser_login','Account not verified! Error on verifying account. Account may have been verified or email doesnt exists');
			    return redirect()->route('employee');
     		}
    	}
    	public function resend_ver(Request $request, $id) {
	      	try {
	      		$data = DB::table('x08')->where('uid', '=', $id)->first();
	   			$x = $data->mname;
		      	if ($x != "") {
			    	$mid = strtoupper($x[0]);
			    	$mid = $mid.'. ';
	       		 } else {
			    	$mid = ' ';
			 		}
				$name = $data->fname.' '.$mid.''.$data->lname;

		        $dataToBeSend = array('name'=>$name, 'token'=>$data->token);
				try {
					Mail::send('mail4SystemUsers', $dataToBeSend, function($message) use ($data) {
						$message->to($data->email, $data->facilityname)->subject('Verify Email Account');
						$message->from('doholrs@gmail.com','DOH Support');
					});

					  session()->flash('dohUser_logout','Successfully resend email, please check your email to verify your account.');
				      return redirect()->route('employee');

				} catch (Exception $e) {
					$data = $this->SystemLogs($e->getMessage());
     				session()->flash('dohUser_login','An error occured during resending the email, please contact the system administrator.');
			    	return redirect()->route('employee');		
				}
	      	} catch (Exception $e) {
	      		$data = $this->SystemLogs($e->getMessage());
     			session()->flash('dohUser_login','An error occured during resending the email, please contact the system administrator.');
			    return redirect()->route('employee');	
	      	}
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
	                		if ($data->token == '') {
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
			                		session()->flash('dohUser_login','Account Deactivated, Contact nearest Regional Administrator/National Administrator.');
			                	return back();
			                	}
	                		} else {
	                			session()->flash('unverified',$data->uid);
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
				try {
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
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.persoreg');
				}
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
				$data['posti'] = $request->posti;
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
		                    'position' => $data['posti'],
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
		public function SystemUsers (Request $request){
			if ($request->isMethod('get')) {
				try {
					$data1 = DB::table('x08')
									->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C']])
									->get();
					$data2 = DB::table('region')->get();
					$data3 = DB::table('x07')	
									->where([['grp_id', '<>', 'C'],['grp_id', '<>', 'NA']])
									->orderBy('grp_id','desc')
									->get();
					// return dd($data3);
					return view('doh.mngsystemusers', ['users'=>$data1,'region'=>$data2, 'types'=>$data3]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					// return 'ERROR';
					return view('doh.mngsystemusers');
				}
			}
			if ($request->isMethod('post')) {
				try {
						$dt = Carbon::now();
			          	$dateNow = $dt->toDateString();
			          	$timeNow = $dt->toTimeString();
						$data['fname'] = $request->fname;
						$data['mname'] = $request->mname;
						$data['lname'] = $request->lname;
						$data['rgnid'] = $request->rgn;
						$data['email'] = $request->email;
						$data['cntno'] = $request->cntno;
						$data['posti'] = $request->posti;
						$data['type'] = $request->typ;
						$data['uname'] = strtoupper($request->uname);
						$data['pass'] = Hash::make($request->pass);
						$data['ip'] = request()->ip();
						$data['token'] = Str::random(40);

						$checkUser = DB::table('x08')
	                    ->where([ ['uid', '=', $data['uname']], ['pwd', '=', $data['pass']] ])
	                    ->select('*')
	                    ->first();

	                    if ($checkUser) {
	                    	return 'SAME';
	                    } else {
	                    	$addedby = session()->get('employee_login');
	                    	$x = $request->mname;
	                    	if ($x != "") {
		                    	$mid = strtoupper($x[0]);
		                    	$mid = $mid.'. ';
		                    } else {
		                    	$mid = ' ';
		                    }
							$name = $request->fname.' '.$mid.''.$request->lname;

	                    	$dataToBeSend = array('name'=>$name, 'token'=>$data['token']);
				            Mail::send('mail4SystemUsers', $dataToBeSend, function($message) use ($request) {
				               $message->to($request->email, $request->facility_name)->subject
				                  ('Verify Email Account');
				               $message->from('doholrs@gmail.com','DOH Support');
				            });
							DB::table('x08')->insert(
				                [
				                    'uid' => $data['uname'],
				                    'pwd' => $data['pass'],
				                    'rgnid' => $data['rgnid'],
				                    'contact' => $data['cntno'],
				                    'position' => $data['posti'],
				                    'email' => $data['email'],
				                    'fname' => $data['fname'],
				                    'mname' => $data['mname'],
				                    'lname' => $data['lname'],
				                    'ipaddress' => $data['ip'],
				                    't_date' => $dateNow,
				                    't_time' =>$timeNow,
				                    'grpid' => $data['type'],
				                    'isActive' => 1,
				                    'isAddedBy' => $addedby->uid,
				                    'token' => $data['token'],
				                ]
				            );
							return 'DONE';
	                    }
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function Applicants (Request $request){
			if ($request->isMethod('get')) {
				try {
					$Cur_useData = $this->getCurrentUserAllData(); // 

					if ($Cur_useData['grpid'] == 'NA') {
						$data1 = DB::table('x08')->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->where('x08.grpid', '=', 'C')
									->get();					
								}
					else {
						$data1 = DB::table('x08')->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->where('x08.grpid', '=', 'C')
									->where('x08.rgnid', '=', $Cur_useData['rgnid'])
									->get();
					}
					// dd($data1);
					return view('doh.mngapplicants', ['users'=>$data1]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mngapplicants');
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
				try {
					$type = DB::table('hfaci_serv_type')->get();
					$facility = DB::table('facilitytyp')->get();
					$uploads = DB::table('upload')->get();
					$oops = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
					// return dd($oops);
					//,['rights'=>$groupRights, 'groups'=>$group, 'modules'=>$module]
					return view('doh.mftypefa',['types'=>$type,'facilitys'=>$facility,'uploads'=>$uploads, 'oops' => $oops]); 
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mftypefa');					
				}
			}
			if ($request->isMethod('post')) {
				try {
					$chckSameData = DB::table('type_facility')
									->where('hfser_id','=',$request->hfser_id)
									->where('facid','=',$request->facid)
									->first();
					if (!$chckSameData) {
							DB::table('type_facility')->insert(
											[
												'hfser_id'=>$request->hfser_id,
												'facid'=>$request->facid,
												// 'oop_id' => 'N',
											]
										);
							return "DONE";
					} else{
						return "SAME";
					}		
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
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
				try {
					$regions = DB::table('region')->get();
					return view('doh.phregion',['region'=>$regions]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.phregion');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('region')->insert(
						[
							'rgnid' => $request->id,
							'rgn_desc' => $request->name,
						]
					);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function provinces(Request $request){ // Places/Provinces Page
			if ($request->isMethod('get')) {
				try {
					$province = DB::table('province')->get();
					$regions = DB::table('region')->get();
					return view('doh.phprovince',['province'=>$province],['region'=>$regions]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.phprovince');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('province')->insert(
						[
							'rgnid' => $request->id,
							'provname' => $request->name,
						]
					);
					return 'DONE';	
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
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
			try {
					DB::table('x07')->insert(
				[
						'grp_id' => $request->id,
						'grp_desc' => $request->name, 
					]
				);
				// DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
				$test = DB::insert('INSERT INTO x06 (`grp_id`, `mod_id`, `allow`, `ad_d`, `upd`, `cancel`, `print`, `view`) 
							SELECT COALESCE(?), mod_id, COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1)
							FROM x05', [$request->id]);
				if ($test) {
						return "DONE";	
					} else {
						$TestError = $this->SystemLogs($e->getMessage());
						return 'ERROR';
					}
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
			}		
		}
		public function lps(){ // Licensing Status Page
			try {
					$Cur_useData = $this->getCurrentUserAllData();
					$employeeData = session('employee_login');
					$region = DB::table('region')->get();
					$type = DB::table('hfaci_serv_type')->get();
					$facility = DB::table('facilitytyp')->get();
					$getData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'x08.uid' )
										->where('appform.draft', '=', 0)
										->first();
					if (!$getData) {
						return view('doh.lpsevaluate', ['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
					} else {

						if ($Cur_useData['grpid'] == 'NA') {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid')
										->where('appform.draft', '=', 0)
										->get();
						} else if ($Cur_useData['grpid'] == 'FDA' && $Cur_useData['grpid'] == 'LO') {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid')
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
										->where('appform.draft', '=', 0)
										->get();
						} else {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid')
										->where('appform.assignedRgn', '=', $Cur_useData['rgnid'])
										->where('appform.draft', '=', 0)
										->get();
						}
							for ($i=0; $i < count($anotherData); $i++) {
								/////  Applied
								$time = $anotherData[$i]->t_time;
								$newT = Carbon::parse($time);
								$anotherData[$i]->formattedTime = $newT->format('g:i A');

								$date = $anotherData[$i]->t_date;
								$newD = Carbon::parse($date);
								$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
								/////  Applied
								
								/////  Evaluated
								$time = $anotherData[$i]->recommendedtime;
								$newT = Carbon::parse($time);
								$anotherData[$i]->formattedTimeEval = ($anotherData[$i]->recommendedtime === null)? null : $newT->format('g:i A');

								$date = $anotherData[$i]->recommendeddate;
								$newD = Carbon::parse($date);
								$anotherData[$i]->formattedDateEval = ($anotherData[$i]->recommendeddate === null)? null : $newD->toFormattedDateString();
								////////
								$time = $anotherData[$i]->proposedInspectiontime;
								$newT = Carbon::parse($time);
								$anotherData[$i]->formattedTimePropEval = ($anotherData[$i]->proposedInspectiontime === null)? null : $newT->format('g:i A');

								$date = $anotherData[$i]->proposedInspectiondate;
								$newD = Carbon::parse($date);
								$anotherData[$i]->formattedDatePropEval = ($anotherData[$i]->proposedInspectiondate === null)? null : $newD->toFormattedDateString();
								///////
								$EvaluateBy = DB::table('x08')->where('uid', '=', $anotherData[$i]->recommendedby)->first();
								if ($EvaluateBy) { // Has recommended By
									if ($EvaluateBy->grpid == 'NA') {
										$anotherData[$i]->recommendedbyName = 'System Administrator';
									} else {
										$x = $EvaluateBy->mname;
								      	if ($x != "") {
									    	$mid = strtoupper($x[0]);
									    	$mid = $mid.'. ';
							       		 } else {
									    	$mid = ' ';
									 		}
										$anotherData[$i]->recommendedbyName = $EvaluateBy->fname.' '.$mid.''.$EvaluateBy->lname;
									}
								} else {
									$anotherData[$i]->recommendedbyName = null;
								}

								$Rgn = DB::table('region')->where('rgnid', '=', $anotherData[$i]->assignedRgn)->first();
								$anotherData[$i]->RgnEvaluated = ($anotherData[$i]->assignedRgn !== null) ? $Rgn->rgn_desc : null;
								/////  Evaluated

								/////  Inspection
								// $time = $anotherData[$i]->recommendedtime;
								// $newT = Carbon::parse($time);
								// $anotherData[$i]->formattedTimeEval = ($anotherData[$i]->recommendedtime === null)? null : $newT->format('g:i A');

								// $date = $anotherData[$i]->recommendeddate;
								// $newD = Carbon::parse($date);
								// $anotherData[$i]->formattedDateEval = ($anotherData[$i]->recommendeddate === null)? null : $newD->toFormattedDateString();
								/////  Inspection


							}
						
					}
					// return dd($anotherData);
					return view('doh.lps',['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region, 'LotsOfDatas' => $anotherData]);
			} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.lps');	
			}
		}
		public function evalute(Request $request){
			if ($request->isMethod('get')) {
				try {
						$Cur_useData = $this->getCurrentUserAllData();
						$employeeData = session('employee_login');
						$region = DB::table('region')->get();
						$type = DB::table('hfaci_serv_type')->get();
						$facility = DB::table('facilitytyp')->get();
						$getData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname' )
										->where('appform.draft', '=', 0)
										->first();
						if (!$getData) {
							return view('doh.lpsevaluate', ['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
						} else {

							if ($Cur_useData['grpid'] == 'NA') {
								$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.draft', '=', 0)
										->get();
							} else if ($Cur_useData['grpid'] == 'FDA' && $Cur_useData['grpid'] == 'LO') {
								$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
										->where('appform.draft', '=', 0)
										->get();
							} else {
								$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.assignedRgn', '=', $Cur_useData['rgnid'])
										->where('appform.draft', '=', 0)
										->get();
							}
								for ($i=0; $i < count($anotherData); $i++) {
									$time = $anotherData[$i]->t_time;
									$newT = Carbon::parse($time);
									$anotherData[$i]->formattedTime = $newT->format('g:i A');

									$date = $anotherData[$i]->t_date;
									$newD = Carbon::parse($date);
									$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
									// ->diffForHumans()
								}
						
					}
						return view('doh.lpsevaluate', ['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region, 'BigData'=>$anotherData]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.lpsevaluate');	
				}
			}
		}
		public function EvalOne(Request $request, $appid){
			if ($request->isMethod('get')) {
				try {
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
						// $data6 = DB::table('appform')
												// ->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id')
												// ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
												// ->where('type_facility.facid', '=', $data1[0]->facid)
												// ->where('appform.appid', '=', $appid)
												//,['appform.facid', '=', 'type_facility.facid']
												// ->first();
												// , 'OOPs' => $data6
												// 
						$data6 = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
						$data7 = DB::table('appform_orderofpayment')
												->where('appid', '=', $appid)
												->first();						
					// return dd($data1);
						return view('doh.lpsevaluteOne', ['AppData'=> $data0, 'UploadData' => $data1, 'appID' => $appid, 'numOfX' => count($data2), 'numOfApp' => count($data3), 'numOfAprv'=> count($data4), 'numOfNull' => count($data5), 'OOPS'=>$data6, 'OPPok' => $data7]);
				} catch (\Exception $e) {
						$TestError = $this->SystemLogs($e->getMessage());
						session()->flash('system_error','ERROR');
						return view('doh.lpsevaluteOne');	
				}
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
				try {
					$own = DB::table('ownership')->get();
					$class = DB::table('class')->get();
					return view('doh.mfcls',['own'=>$own, 'class'=> $class]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfcls');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('class')->insert([
						'classid' => $request->id,
						'classname'=> $request->name,
						'ocid' => $request->ocid,
					]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';		
				}
			}
		}
		public function AppStatus(Request $request) { // Master File/Application Type Page
			if ($request->isMethod('get')) {
				try {
					$apptype = DB::table('apptype')->get();
					return view('doh.mfapptype',['apptype'=>$apptype]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfapptype');
				}
			}
			if ($request->isMethod('post')) { 
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('apptype')->insert([
						'aptid' => $request->id,
						'aptdesc' => $request->name, 
						]
					);
					return "DONE";
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function AppType(Request $request){ // Master File/Facility Type Page
			if ($request->isMethod('get')) {
				$fatype = DB::table('facilitytyp')->get();
				return view('doh.mffatype',['fa'=>$fatype]);
			}
			if ($request->isMethod('post')) {
					DB::table('facilitytyp')->insert([
						'facid' => $request->id,
						'facname' => $request->name,
					]);
					return 'DONE';
				
			}
		}
		public function OwnShip(Request $request){ // Master File/Ownership Page
			if ($request->isMethod('get')) {
				try {
					$oShip = DB::table('ownership')->get();
					return view('doh.mfoship',['oShip'=>$oShip]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfoship');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('ownership')->insert([
							'ocid' => $request->id,
							'ocdesc' => $request->name,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function CityMuni(Request $request) { // Places/City/Municipality Page
			if ($request->isMethod('get')) {
				try {
					$region = DB::table('region')->get();
					$province = DB::table('province')->get();
					$CiMu = DB::table('city_muni')->get();
					return view('doh.phcm',['region'=>$region,'province'=>$province,'cm'=>$CiMu]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.phcm');					
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('city_muni')->insert([
						'provid' => $request->id,
						'cmname' => $request->name,
					]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function Brgy(Request $request){ // Places/Barangay Page
			if ($request->isMethod('get')) {
				try {
					$region = DB::table('region')->get();
					$province = DB::table('province')->get();
					$CiMu = DB::table('city_muni')->get();
					$brgy = DB::table('barangay')->get();
					return view('doh.phbrgy',['region'=>$region, 'province'=>$province, 'cm'=>$CiMu, 'brgy' => $brgy]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.phbrgy');			
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('barangay')->insert([
							'cmid' => $request->id,
							'brgyname' => $request->name,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';		
				}
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
				try {
					$pltype = DB::table('plicensetype')->get();
					return view('doh.mflitype',['plitype'=>$pltype]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mflitype');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('plicensetype')->insert([
						'plid' => $request->id,
						'pldesc' => $request->name,
					]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function Train(Request $request){ // Personnel Training
			if ($request->isMethod('get')) {
				try {
					$train = DB::table('ptrainings_trainingtype')->get();
					return view('doh.mftrain',['train'=>$train]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mftrain');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('ptrainings_trainingtype')->insert(['ptid'=>$request->id,'ptdesc'=>$request->name]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR'	;
				}
			}
		}
		public function Upload(Request $request){ // Master File/Upload Page
			if ($request->isMethod('get')) {
				try {
					// $fatype = DB::table('facilitytyp')->get();
					// $hfsts = DB::table('hfaci_serv_type')->get();
					$ups = DB::table('upload')->orderBy('updesc', 'asc')->get();
					// 'facilitys'=>$fatype,'hfsts'=>$hfsts
					return view('doh.mfupload',['uploads'=>$ups]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfupload');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('upload')->insert(['updesc'=>$request->name,'isRequired'=>$request->required]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function Dept(Request $request){ // Deaprtment
			if ($request->isMethod('get')) {
				try {
					$depts = DB::table('department')->get();
					return view('doh.mfdept',['depts'=>$depts]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfdept');		
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('department')->insert([
						'depid' => $request->id,
						'depname' => $request->name,
					]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function Sec(Request $request){ // Section
			if ($request->isMethod('get')) {
				try {
					$depts = DB::table('department')->get();
					$sec = DB::table('section')->get();
					return view('doh.mfsec',['depts'=>$depts, 'secs'=>$sec]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfsec');				
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('section')->insert([
						'secid' => $request->id,
						'secname' => $request->name,
						'depid' => $request->depid,	
					]);
					return 'DONE';
				} catch (Exception $e) {
				  $TestError = $this->SystemLogs($e->getMessage());
				  return 'ERROR';		
				}	
			}
		}
		public function WorkStatus(Request $request){ // Personnel Work Status
			if ($request->isMethod('get')) {
				try {
					$pworkstatus = DB::table('pwork_status')->get();
					return view('doh.mfpworkStatus', ['pwStats'=>$pworkstatus]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfpworkStatus');
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('pwork_status')->insert([
						'pworksid' => $request->id,
						'pworksname' => $request->name,
					]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
				  	return 'ERROR';	
				}
			}
		}
		public function Work(Request $request){ // Personnel Work 
			if ($request->isMethod('get')) {
				try {
					$work = DB::table('pwork')->get();
					return view('doh.mfpwork', ['works'=>$work]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfpwork');		
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('pwork')->insert([
							'pworkid' => $request->id,
							'pworkname' => $request->name,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function Part(Request $request){
			if ($request->isMethod('get')) {
				try {
					$part = DB::table('part')->get();
					return view('doh.mfpart', ['parts'=>$part]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfpart');		
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('part')->insert([
							// 'partid' => $request->id,
							'partdesc' => $request->name,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function AsMent(Request $request){
			if ($request->isMethod('get')) {
				try {
					$asMent = DB::table('assessment')->get();
					$part = DB::table('part')->get();
					return view('doh.mfasment', ['asments'=>$asMent, 'parts'=>$part]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfasment');	
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('assessment')->insert([
							// 'asmt_id' => $request->id,
							'asmt_name' => $request->name,
							'partid' => $request->partid,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
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
				try {

					$data1 = DB::table('chg_app')->get();




					// return dd($data1);
					$hfstype = DB::table('hfaci_serv_type')->get();
					return view('doh.mfFaServType', ['hfstypes'=>$hfstype]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfFaServType');					
				}
			}
			if ($request->isMethod('post')) {
				try {
					$data = $this->InsertActLog($request->mod_id,"ad_d");
					DB::table('hfaci_serv_type')->insert([
							'hfser_id' => $request->id,
							'hfser_desc' => $request->name,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function FaServ(Request $request){
			if ($request->isMethod('get')) {
				try {
					$hfstype = DB::table('hfaci_serv_type')->get();
					$fatype = DB::table('facilitytyp')->get();
					return view('doh.mfFaServ', ['hfstypes'=>$hfstype, 'fatypes'=>$fatype]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfFaServ');		
				}
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
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
					return view('doh.mfoop', ['oops'=>$data]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfoop');		
				}
			}
		}
		public function EvalAddOOP(Request $request, $appid, $oop_id){
			if ($request->isMethod('get')) {
				try {
					$data0 = DB::table('appform')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('region', 'x08.rgnid', '=', 'region.rgnid')
										->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid') 
										// ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
										// , 'orderofpayment.*'
										->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'region.rgn_desc','apptype.aptdesc', 'apptype.aptid', 'appform.status')
										->where('appform.appid', '=', $appid)
												// , 'type_facility.*', 'orderofpayment.*'
												// ->where('type_facility.facid', '=', 'appform.facid')
										->first();
					$data1 = DB::table('orderofpayment')->where('oop_id', '=', $oop_id)->first();
					$data2 = DB::table('chg_oop')
									->join('charges', 'chg_oop.chg_code', '=', 'charges.chg_code')
									->join('chg_app', 'chg_oop.chgapp_id', '=', 'chg_app.chgapp_id')
									->join('category', 'charges.cat_id', '=', 'category.cat_id')
									// ->where('chg_oop.oop_id', '=', $oop_id)
									->where([['chg_oop.oop_id', '=', $oop_id], ['chg_app.aptid', '=', $data0->aptid]])
									->orderBy('chg_oop.chgopp_seq','asc')
									->get();
					// return dd($data2);
					$employeeData = session('employee_login');
					return view('doh.oopADD',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id,'oop_data'=>$data1, 'Bills'=>$data2]);
					// switch ($oop_id) {
					// 	case 'CONPTC':
					// 			return view('doh.oopCONPTCadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
					// 		break;
					// 	case 'OSSGHPN':
					// 			return view('doh.oopOSSGHPNadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
					// 		break;
					// 	case 'DL':
					// 			return view('doh.oopDLadd',['AppData'=>$data0, 'EmployeeData' => $employeeData, 'appid' => $appid, 'oop_id' => $oop_id]);
					// 		break;
					// 	default:
					// 			return back();
					// 		break;
					// }
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.oopADD');	
				}
			} /// END
			if ($request->isMethod('post')) {
				$Cur_useData = $this->getCurrentUserAllData();
				DB::table('appform_orderofpayment')->insert([
									'appid' => $appid,
									'oop_id' => $oop_id,
									'oop_total' => $request->grandtotal,
									'oop_totalword' => $request->totalword,
									'oop_time' => $Cur_useData['time'],
									'oop_date' => $Cur_useData['date'],
									'oop_ip' => $Cur_useData['ip'],
									'uid' => $Cur_useData['cur_user'],
								]);
				$last = DB::getPdo()->lastInsertId();
				for ($i=0; $i < count($request->data); $i++) { 
					DB::table('appform_oopdata')->insert([
									'appop_id' => $last,
									'chgopp_id' => $request->data[$i],
								]);
				}
				return 'DONE';
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
									// ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
									// , 'orderofpayment.*'
									->select('appform.uid', 'appform.appid', 'appform.isrecommended', 'x08.*', 'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'type_facility.*', 'region.rgn_desc')
									->where('appform.appid', '=', $appid)
									->first();
				$data1 = DB::table('appform_orderofpayment')
									->where('appid', '=', $appid)
									->first();
				$newD = Carbon::parse($data1->oop_date);
				$data1->formattedPropDate = $newD->toFormattedDateString();
				$data2 = DB::table('x08')->select()->where('uid', '=', $data1->uid)->first();
				$data3 = DB::table('orderofpayment')->where('oop_id', '=', $oop_id)->first();
				$data4 = DB::table('appform_oopdata')
									->join('appform_orderofpayment', 'appform_oopdata.appop_id', '=', 'appform_orderofpayment.appop_id')
									->join('chg_oop', 'appform_oopdata.chgopp_id', '=', 'chg_oop.chgopp_id')
									->join('charges', 'chg_oop.chg_code', '=', 'charges.chg_code')
									->join('chg_app', 'chg_oop.chgapp_id', '=', 'chg_app.chgapp_id')
									->orderBy('chg_oop.chgopp_seq', 'asc')
									->get();
				$x = $data2->mname;
		            if ($x != "") {
		                $mid = strtoupper($x[0]);
		                    $mid = $mid.'. ';
		                } else {
		                   	$mid = ' ';
		                }
		             $name = $data2->fname.' '.$mid.''.$data2->lname;
		             $data2->name = $name;
				// return dd($data4);
				return view('doh.oopVIEW', ['AppData'=>$data0, 'EmployeeData' =>$data2, 'OOPDATA' => $data1, 'appid' => $appid, 'oop_id' => $oop_id, 'oop_data' => $data3,'Bills'=>$data4]);
				// switch ($oop_id) {
				// 	case 'CONPTC':
				// 			return view('doh.oopCONPTCview', ['AppData'=>$data0, 'EmployeeData' =>$data2, 'OOPDATA' => $data1, 'appid' => $appid, 'oop_id' => $oop_id]);
				// 		break;
				// 	case 'OSSGHPN':
				// 			return view('doh.oopOSSGHPNview', ['AppData'=>$data0, 'EmployeeData' =>$data2, 'OOPDATA' => $data1, 'appid' => $appid, 'oop_id' => $oop_id]);
				// 		break;	
				// 	default:
				// 		# code...
				// 		break;
				// }
			}
			if ($request->isMethod('post')) {
				
			}
		}
		public function Charges(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data1 = DB::table('charges')
										->join('category', 'charges.cat_id', '=', 'category.cat_id')
										->get();
					$data2 = DB::table('category')->get();
					// return dd($data1);
					return view('doh.mfcharges',['Chrges'=>$data1,'Categorys'=>$data2]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfcharges');		
				}
			}
			if ($request->isMethod('post')) {
				try {
					DB::table('charges')->insert(
						['chg_code'=> strtoupper($request->id),
						  'cat_id' => $request->cat_id, 
						 'chg_desc'=> $request->name,
						 'chg_exp' => $request->exp,
						 'chg_rmks' => $request->rmk,
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function ChgOop(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('chg_oop')
								->join('charges', 'chg_oop.chg_code', '=', 'charges.chg_code')
								->join('orderofpayment', 'chg_oop.oop_id', '=', 'orderofpayment.oop_id')
								->join('chg_app', 'chg_oop.chgapp_id', '=', 'chg_app.chgapp_id')
								// ->where('chg_oop.oop_id', '=', $request->id)
								->orderBy('chg_oop.oop_id','asc')
								->get();
					$data1 = DB::table('orderofpayment')->where('oop_id', '<>', 'N')->get();
					$data2 = DB::table('charges')->get();
					$data3 = DB::table('apptype')->get();
					$data4 = DB::table('category')->get();
					// $data4 = DB::table('')
					// return dd($data4);
					return view('doh.mfChgOop',['OOPs'=>$data1, 'Chrgs' => $data2, 'BigData' => $data, 'TotalNumber' => count($data), 'IniRen' => $data3,'Cats' => $data4]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.chg_oop');			
				}
			}
			if ($request->isMethod('post')) {
				/// oop_id
				/// chg_code
				// $data1 = DB::table('chg_oop')->where([['chg_code','=',$request->chg_code],['oop_id', '=', $request->oop_id]])->first();
				// if (!$data1) {
					try {
							DB::table('chg_app')->insert(['chg_code'=>$request->chg_code,'amt'=>0,'aptid'=>$request->aptid,'remarks'=>$request->rmk]);
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
					} catch (Exception $e) {
						$TestError = $this->SystemLogs($e->getMessage());
						return 'ERROR';					
					}
				// } else {
				// 	return 'SAME';
				// }
				// return response()->json($data1);
				// return 'Hello';
			}
		}
		public function assignNow(Request $request){
			try {
					$Cur_useData = $this->getCurrentUserAllData();
					$employeeData = session('employee_login');
					$region = DB::table('region')->get();
					$type = DB::table('hfaci_serv_type')->get();
					$facility = DB::table('facilitytyp')->get();
					$getData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname' )
										->where('appform.draft', '=', 0)
										->first();
					if (!$getData) {
						return view('doh.lpsAssign',['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
					} else {
						if ($Cur_useData['grpid'] == 'NA') {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname')
										->where('appform.draft', '=', 0)
										->get();
						} else if ($Cur_useData['grpid'] == 'FDA' && $Cur_useData['grpid'] == 'LO') {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname')
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
										->where('appform.draft', '=', 0)
										->get();
						} else {
							$anotherData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->join('class', 'appform.classid', '=', 'class.classid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname')
										->where('appform.assignedRgn', '=', $Cur_useData['rgnid'])
										->where('appform.draft', '=', 0)
										->get();
						}
							for ($i=0; $i < count($anotherData); $i++) {
								$time = $anotherData[$i]->t_time;
								$newT = Carbon::parse($time);
								$anotherData[$i]->formattedTime = $newT->format('g:i A');

								$date = $anotherData[$i]->t_date;
								$newD = Carbon::parse($date);
								$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
								
								if ($anotherData[$i]->assignedLO === null) {
									$anotherData[$i]->formattedLOName = "NONE";
								} else {
									$temp = DB::table('x08')->where('uid', '=', $anotherData[$i]->assignedLO)->first();
									$x = $temp->mname;
				                    if ($x != "") {
				                    	$mid = strtoupper($x[0]);
				                    	$mid = $mid.'. ';
				                    } else {
				                    	$mid = ' ';
				                    }
								$anotherData[$i]->formattedLOName = $temp->fname.' '.$mid.$temp->lname;
								} 
								
							}
					}
					// return dd($anotherData);
					return view('doh.lpsAssign',['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region, 'BigData' => $anotherData]);
			} catch (Exception $e) {
				$TestError = $this->SystemLogs($e->getMessage());
				session()->flash('system_error','ERROR');
				return view('doh.lpsAssign');
			}
;		}
		public function PreAsMent(Request $request){
			if ($request->isMethod('get')) {
				$asMent = DB::table('assessment')->get();
				$part = DB::table('prepart')->get();
				return view('doh.mfpreasment', ['asments'=>$asMent, 'parts'=>$part]);
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
		public function Assess(Request $request){
			if ($request->isMethod('get')) {
				try {
					$Cur_useData = $this->getCurrentUserAllData();
					$employeeData = session('employee_login');
					$region = DB::table('region')->get();
					$type = DB::table('hfaci_serv_type')->get();
					$facility = DB::table('facilitytyp')->get();
					return view('doh.lpsAssess', ['employeeGRP'=>$employeeData->grpid,'employeeREGION'=>$employeeData->rgnid ,'types' => $type, 'facilitys'=>$facility, 'regions'=>$region]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.lpsAssess');			
				}
			}
		}
		public function AssessOne(Request $request, $appid){
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('appform')
									->join('x08', 'appform.uid', '=', 'x08.uid')
									->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
									->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
									->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->where('appform.appid', '=', $appid)
									->first();
					$data1 = DB::table('part')->get();
					$data2 = DB::table('assessment')->get();					

					// return dd($data2);
					return view('doh.lpsAssessOne',['AppData'=>$data, 'Parts'=>$data1, 'Assments'=>$data2]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.lpsAssessOne');
				}
			}
		}
		public function Holidays(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('holidays')->orderBy('hdy_date', 'asc')->get();
					
					if ($data) {
						for ($i=0; $i < count($data) ; $i++) { 
							$date = $data[$i]->hdy_date;
							$newD = Carbon::parse($date);
							$data[$i]->formattedDate = $newD->toFormattedDateString();
						}
					}
					// return dd($data);
					$data1 = DB::table('region')->get();
					return view('doh.mfholiday', ['holidays'=>$data]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfholiday');	
				}
			}
			if ($request->isMethod('post')) {
				$Cur_useData = $this->getCurrentUserAllData();
				$rgn = ($Cur_useData['grpid'] == 'NA') ?  null : $Cur_useData['rgnid']  ;
				try {
					$test = DB::table('holidays')->insert([
							'hdy_id' => $request->code,
							'hdy_date' => $request->dat,
							'hdy_typ' => $request->typ,
							'hdy_desc' => $request->desc,
							'rgnid' => $rgn,
							't_time' => $Cur_useData['time'],
							't_date' => $Cur_useData['date'],
							't_ip' => $Cur_useData['ip'],
							't_added' => $Cur_useData['cur_user'],
						]);
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';	
				}
			}
		}
		public function Category(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('category')->get();
					return view('doh.mfcategory',['category'=>$data]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfcategory');
				}
			}
			if ($request->isMethod('post')) {
				try {
						DB::table('category')->insert([
							'cat_id' => $request->id,
							'cat_desc' => $request->name,
						]);	
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}
		public function TransStatus(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data = DB::table('trans_status')->get();
					return view('doh.mfTransStatus', ['trans'=>$data]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfTransStatus');
				}
			}
			if ($request->isMethod('post')) {
				try {
					DB::table('trans_status')->insert([
							'trns_id' => $request->id,
							'trns_desc' => $request->name,
						]);	
					return 'DONE';
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		} /// Storage::allFiles($directory_name);
		public function Settings(Request $request){
			if ($request->isMethod('get')) {
				try {
					# Data here for m99
					return view('doh.mfSettings');
				} catch (Exception $e){
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mfSettings');
				}
			}
			if ($request->isMethod('post')) {
				# code...
			}
		}
		public function System_Logs(Request $request){
			if ($request->isMethod('get')) {
				try {
					$data = Storage::allFiles('/system/logs');
					$result = array();
					for ($i=0; $i < count($data) ; $i++) { 
						// $data[$i];
						$lastmodified = Storage::lastModified($data[$i]);
						$lastmodified = DateTime::createFromFormat("U", $lastmodified);
						$lastmodified->setTimezone(new DateTimeZone('Asia/Manila'));
						$lastmodifiedString = $lastmodified->format('Y-m-d H:i:s');
						$lastmodifiedDate = $lastmodified->format('Y-m-d');
						$lastmodifiedTime = $lastmodified->format('H:i:s'); 

						$newT = Carbon::parse($lastmodifiedTime);
					 	$formattedTime = $newT->format('g:i A');
						
						$newD = Carbon::parse($lastmodifiedDate);
						$formattedDate = $newD->toFormattedDateString();

						$count = strlen($data[$i]);
						$filename = substr($data[$i],12, $count);

						$count2 = strlen($filename);
						$uid = substr($filename,12, -9);

						$code = substr($filename,0, 12);
						
						$UserFile = DB::table('x08')
										->join('region', 'x08.rgnid', '=', 'region.rgnid')
										->where('uid', '=', $uid)
										->first();

						if ($UserFile) {
							if ($UserFile->grpid == 'NA') {
								$name = 'System Administrator';
							} else {
								$x = $UserFile->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
								$name = $UserFile->fname.' '.$mid.''.$UserFile->lname;
							}
							$rgn = $UserFile->rgn_desc;
						} else {
							$name = 'Not Available';
							$rgn = 'Not Available';
						}

						/////
						$result[] = array(
								'filepath'=> $data[$i],
								// 'size'=> Storage::size($data[$i]),
								'content' => Storage::get($data[$i]),
								'datetime' => $lastmodifiedString,
								// 'date' =>  $lastmodifiedDate, ///Storage::lastModified($data[$i]),
								// 'time' => $lastmodifiedTime,
								'formmatedDate' =>  $formattedDate,
								'formattedTime' => $formattedTime,
								'filename'=>$filename,
								'uid' => $uid,
								'name'=> $name,
								'region'=> $rgn,
								'code' => $code,
							);
					}
					// dd($result);
					return view('doh.mngsystemlogs', ['results'=>$result]);
				} catch (Exception $e) {
					$TestError = $this->SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('doh.mngsystemlogs');
				}
			}
		}
		public function ModeOfPayment(Request $request){

		}
		public function PreAssessment(Request $request, $id){
			try {
				
				$data = DB::table('x08')
							->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
							->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
							->join('province', 'x08.province', '=', 'province.provid')
							->where('x08.uid', '=', $id)->first();
				$data1 = DB::table('part')->get();
				$data2 = DB::table('app_assessment')
							->join('assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')
							->where([['app_assessment.draft', '=', '0'], ['app_assessment.uid', '=', $id]])
							->get();
				// $data2 = DB::table('assessment')->get();

				// return dd($data2);
				return view('doh.lpsPreAssment',['AppData'=>$data ,'parts'=>$data1, 'asments'=>$data2]);
			} catch (Exception $e) {
				$TestError = $this->SystemLogs($e->getMessage());
				session()->flash('system_error','ERROR');
				return view('doh.mngsystemlogs');
			}
		}
	}
?>