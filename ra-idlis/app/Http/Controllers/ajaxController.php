<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Storage;
	use Carbon\Carbon;
	class ajaxController extends Controller
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
		public function getCurrentUserAllData(){ // GET DATA FOR DOH
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
		public function getCalendarEvents(Request $request){
			try {
					$data = DB::table('holidays')->where('hdy_typ', '=', 'Regular')->get();
					if ($data) {
						for ($i=0; $i < count($data); $i++) { 
							$data[$i]->title = $data[$i]->hdy_desc;
							$data[$i]->start = $data[$i]->hdy_date;
						}
						return $data;
					}
			} catch (Exception $e) {
				$data = $hos->SystemLogs($e->message());
				return 'ERROR';
			}
		}
		public function getCalendarEvents2(Request $request){
			try {
					$data = DB::table('holidays')->where('hdy_typ', '=', 'Special')->get();
					if ($data) {
						for ($i=0; $i < count($data); $i++) { 
							$data[$i]->title = $data[$i]->hdy_desc;
							$data[$i]->start = $data[$i]->hdy_date;
						}
						return $data;
					}
			} catch (Exception $e) {
				$data = $hos->SystemLogs($e->message());
				return 'ERROR';
			}
		}
		// -------------------- SELECT --------------------
		public function selectProvince(Request $request){ // Get Provinces
			$provinces = DB::table('province')->where('rgnid',$request->reg_id)->get();
	    	return response()->json(['provinces'=>$provinces]);
		}
		public function selectBrgy(Request $request){ // Get Barangays
			$brgy = DB::table('barangay')->where('cmid',$request->id)->get();
			// return $request->id;
			return response()->json($brgy);
		}
		public function getRights(Request $request){ // Get Rights
			try {
				$groupRights = DB::table('x06')
				// ->join('orders', 'users.id', '=', 'orders.user_id')
								->join('x05', 'x06.mod_id','=','x05.mod_id')
								->join('x07', 'x06.grp_id', '=', 'x07.grp_id')
								->select('x06.*', 'x05.*', 'x07.*')
								->where('x06.grp_id', '=', $request->grp_id)
								->get()
								;
				if ($groupRights) {
					return $groupRights;
					// return response()->json(['GrpRights'=>$groupRights]);
				} else {
					return "NONE";
				}
			} catch (Exception $e) {
				$data = $hos->SystemLogs($e->message());
				return 'ERROR';
			}
		}
		public function getClass(Request $request){ // Get Classes
			$class = DB::table('class')->where('ocid',$request->ocid)->get();
	    	return response()->json(['classes'=>$class]);
		}
		public function selectUploads(Request $request){ // Get Uploads
			$upload = DB::table('upload')->where('facid',$request->id)->first();
			if ($upload) {
				$upload = DB::table('upload')->where('facid',$request->id)->get();
				return response()->json($upload);
			} else {return 'NO';}
		}
		public function getActLogs(Request $request){
			$employeeData = session('employee_login');
			$uname  = $employeeData->uid;
			$check = DB::table('activitylogs')
						->where('uid','=',$uname)
						->where('actdate','=',$request->FilterDate)
						->first();
			if ($check) {
				$actlogs = DB::table('activitylogs')
								->join('x05','activitylogs.mod_id','=','x05.mod_id')
								->select('activitylogs.*', 'x05.mod_desc')
								->where('activitylogs.uid','=',$uname)
								->where('activitylogs.actdate','=',$request->FilterDate)
								->get();
				for ($i=0; $i < count($actlogs); $i++) {
						$time = $actlogs[$i]->acttime;
						$newT = Carbon::parse($time);
						$actlogs[$i]->formattedTime = $newT->format('g:i A');

						$date = $actlogs[$i]->actdate;
						$newD = Carbon::parse($date);
						$actlogs[$i]->formattedDate = $newD->toFormattedDateString();
						// ->diffForHumans()
					}
				return response()->json($actlogs);
			} else {
				return 'NO';
			}
		}
		public function getTypeFaci(Request $request){
			$TypeFace = DB::table('type_facility')
								->join('hfaci_serv_type', 'type_facility.hfser_id','=','hfaci_serv_type.hfser_id')
								->join('facilitytyp', 'type_facility.facid', '=', 'facilitytyp.facid')
								// ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
								// , 'orderofpayment.*'
								->select('type_facility.*', 'hfaci_serv_type.*', 'facilitytyp.*')
								->where('type_facility.hfser_id', '=', $request->hfser_id)
								->first();
			if ($TypeFace) {
				$getAllData = DB::table('type_facility')
								->join('hfaci_serv_type', 'type_facility.hfser_id','=','hfaci_serv_type.hfser_id')
								->join('facilitytyp', 'type_facility.facid', '=', 'facilitytyp.facid')
								// ->join('orderofpayment', 'type_facility.oop_id', '=', 'orderofpayment.oop_id')
								// , 'orderofpayment.*'
								->select('type_facility.*', 'hfaci_serv_type.*', 'facilitytyp.*')
								->where('type_facility.hfser_id', '=', $request->hfser_id)
								->get();
				return $getAllData;
			} else {
				return "NONE";
			}
		}
		public function getRequirements(Request $request){
			try {
					$Requirements = DB::table('facility_requirements')
								->join('upload','facility_requirements.upid','=','upload.upid')
								->select('facility_requirements.*','upload.*')
								->where('facility_requirements.typ_id', '=', $request->tyf_id)
								->first();
					if ($Requirements) {
						$getAllData = DB::table('facility_requirements')
										->join('upload','facility_requirements.upid','=','upload.upid')
										->select('facility_requirements.*','upload.*')
										->where('facility_requirements.typ_id', '=', $request->tyf_id)
										->get();
						return $getAllData;
					} else {
						return "NONE";
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function getLPS(Request $request){
			try {
					$Cur_useData = $this->getCurrentUserAllData();
					$getData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'x08.uid' )
										->where('appform.hfser_id', '=', $request->hfser_ID)
										->where('appform.facid', '=', $request->facID)
										->where('appform.assignedRgn', '=', $request->rgnID)
										->where('appform.draft', '=', 0)
										->first();
					if (!$getData) {
						return 'NONE';
					} else {

						if ($Cur_useData['grpid'] != 'LO' && $Cur_useData['grpid'] != 'FDA') {
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
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'appform.status', 'x08.uid', 'trans_status.trns_desc')
										->where('appform.hfser_id', '=', $request->hfser_ID)
										->where('appform.facid', '=', $request->facID)
										->where('appform.assignedRgn', '=', $request->rgnID)
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
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'appform.status', 'x08.uid', 'trans_status.trns_desc')
										->where('appform.hfser_id', '=', $request->hfser_ID)
										->where('appform.facid', '=', $request->facID)
										->where('appform.assignedRgn', '=', $request->rgnID)
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
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
							// return response()->json(['item_image ' => $item_image, 'item_something' => $item_something, 'item_more' => $item_more  ]);
						// return dd($anotherData);
						return response()->json(['data'=>$anotherData]);
					}
			} catch (\Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';			
			}
			
		}
		public function getLPS4Assigned (Request $request){
			try {
					$getData = DB::table('appform')
										->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
										->join('x08', 'appform.uid', '=', 'x08.uid')
										->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->join('province', 'x08.province', '=', 'province.provid')
										->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'appform.assignedRgn', 'facilitytyp.facname', 'city_muni.cmname', 'trans_status.trns_desc')
										->where('appform.hfser_id', '=', $request->hfser_ID)
										->where('appform.facid', '=', $request->facID)
										->where('appform.assignedRgn', '=', $request->rgnID)
										->where('appform.draft', '=', 0)
										->first();
					if (!$getData) {
						return 'NONE';
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
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'appform.assignedRgn', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.hfser_id', '=', $request->hfser_ID)
										->where('appform.facid', '=', $request->facID)
										->where('appform.assignedRgn', '=', $request->rgnID)
										->where('appform.draft', '=', 0)
										->get();
							for ($i=0; $i < count($anotherData); $i++) {
								$time = $anotherData[$i]->t_time;
								$newT = Carbon::parse($time);
								$anotherData[$i]->formattedTime = $newT->format('g:i A');

								$date = $anotherData[$i]->t_date;
								$newD = Carbon::parse($date);
								$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
								// ->diffForHumans()
								
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
						return $anotherData;
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';		
			}
		}
		public function getLPSUploads(Request $request){
			$data = DB::table('appform')
							   ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							   ->where('appform.appid', '=', $request->appid)
							   ->first();
			if (!$data) {
				return 'NONE';
			} else {
				$data2 =DB::table('appform')
							   ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							   ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							   ->select('appform.appid', 'upload.*')
							   ->where('appform.appid', '=', $request->appid)
							   ->get();
				return $data2;
			}
			// return $request->appid;
		}

		public function DownloadFile($id){
			// $dl = File::find($id);
			return Storage::download('public/uploaded/'.$id);
		}
		public function EvalDetails(Request $request){
			$data = DB::table('app_upload')
									->join('x08', 'app_upload.evaluatedby', '=', 'x08.uid' )
									->select('app_upload.*', 'x08.fname', 'x08.mname', 'x08.lname', 'x08.grpid')
									->where('app_upload.apup_id', '=', $request->apup_id)
									->first();
			if (!$data) {
				return 'NONE';
			} else {
				$newT = Carbon::parse($data->evaltime);
				$data->formattedEvalTime = $newT->format('g:i A');
				$newD = Carbon::parse($data->evaldate);
				$data->formatteEvalDate = $newD->toFormattedDateString();
				
				return response()->json($data);
			}
		}
		public function getChgOOP(Request $request){
			try {	$data = DB::table('chg_app')
									->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
									->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
									// ->join('chg_app', 'chg_app.chgapp_id', '=', 'chg_app.chgapp_id')
									->join('category', 'charges.cat_id', '=', 'category.cat_id')
									->join('apptype', 'chg_app.aptid', '=', 'apptype.aptid')
									->where('chg_app.oop_id', '=', $request->id)
									->orderBy('chg_app.chgopp_seq','asc')
									->get();
				// return dd($data);
					if ($data) {
						return response()->json(['data'=>$data,'TotalNumber'=>count($data)]);
					} else {
						$data = $this->SystemLogs('No data has been fetch from chg_app table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function getLO(Request $request){
			$data = DB::table('x08')->select('uid', 'fname', 'mname', 'lname', 'isActive')
									->where([['rgnid', '=', $request->rgnid],['grpid', '=', 'LO'], ['isActive', '<>', "0"] ])
									// ->where('grpid', '=', 'LO')
									// ->where('isActive', '<>', "0")
									->first();
			if ($data) {
				$data2 = DB::table('x08')->select('uid', 'fname', 'mname', 'lname', 'isActive')
									->where([['rgnid', '=', $request->rgnid],['grpid', '=', 'LO'], ['isActive', '<>', "0"] ])
									// ->where('grpid', '=', 'LO')
									// ->where('isActive', '<>', "0")
									->orderBy('lname', 'asc')
									->get();
				return response()->json($data2);
			} else {
				return 'NONE';
			}
			
		}
		public function getChangeHistory(Request $request){
			$data = DB::table('appform_hist')->where('appid', '=', $request->appid)->orderBy('appformhist', 'desc')->first();
			if ($data) {
				$data2 = DB::table('appform_hist')->where('appid', '=', $request->appid)->orderBy('appformhist', 'desc')->get();
				for ($i=0; $i < count($data2) ; $i++) { 
					/////// Assigned Region By
					$tempName = ($data2[$i]->assignedLOBy != null ) ? $data2[$i]->assignedLOBy  : $data2[$i]->assignedRgnBy;
					$temp = DB::table('x08')->where('uid', '=', $tempName)->first();
					if ($temp->grpid == 'NA') { // Assigned By
						$data2[$i]->name = 'Administrator';
					} else {
							$x = $temp->mname;
		                    if ($x != "") {
		                    	$mid = strtoupper($x[0]);
		                    	$mid = $mid.'. ';
		                    } else {
		                    	$mid = ' ';
		                    }
						$data2[$i]->AssignedByName = $temp->fname.' '.$mid.$temp->lname;
					}
					/////// Assigned Region By
					/////// Assigned TO
					if ($data2[$i]->assignedLO != null) {
						$temp3 = DB::table('x08')->where('uid', '=', $data2[$i]->assignedLO)->first();
							$y = $temp3->mname;
		                    if ($y != "") {
		                    	$mid2 = strtoupper($y[0]);
		                    	$mid2 = $mid2.'. ';
		                    } else {
		                    	$mid2 = ' ';
		                    }
		                $data2[$i]->assignedTo = $temp3->fname.' '.$mid2.$temp3->lname;
					} else {
						$data2[$i]->assignedTo = "None";
					}
					/////// Assigned TO
					/////// Get Region
					$temp2 = DB::table('region')->where('rgnid', '=', $data2[$i]->assignedRgn)->first();
					$data2[$i]->rgn_desc = $temp2->rgn_desc;
					/////// Get Region
					/////// Time and Date Format
					$selectedTime = ($data2[$i]->assignedLOTime === null) ? $data2[$i]->assignedRgnTime : $data2[$i]->assignedLOTime;
					$selectedDate = ($data2[$i]->assignedLoDate === null) ? $data2[$i]->assignedRgnDate : $data2[$i]->assignedLoDate ;
					
					$newT = Carbon::parse($selectedTime);
					$data2[$i]->formattedTime = $newT->format('g:i A');

					$newD = Carbon::parse($selectedDate);
					$data2[$i]->formattedDate = $newD->toFormattedDateString();

					///////
				}
				return $data2;
			} else {
				return 'NONE';
			}
		}
		public function getAssess(Request $request) {
			$data = DB::table('app_assessment')->get();
			if ($data) {
				return $data;
			}
		}
		public function getPaymentData(Request $request){
			try {
				$data1 = DB::table('chgfil')
						->join('chg_app', 'chgfil.chgapp_id', '=', 'chg_app.chgapp_id')
						->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
						->where('chgfil.appform_id', '=', $request->appid)
						->orderBy('chg_app.oop_id','asc')
						->get();
				for ($i=0; $i < count($data1); $i++) { 
								$data1[$i]->formattedAmt = 'PHP '.number_format($data1[$i]->amount,2);
							}
				$data2 = DB::table('chgfil')->where('appform_id', '=', $request->appid)->sum('amount');
				$data3 = 'PHP '.number_format($data2,2);
				return response()->json(['payments'=>$data1, 'sum' =>$data2, 'formmatedSum' => $data3]);
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function getTeamsData(Request $request){
			try {
					$data = DB::table('team')->where('rgnid', '=', $request->rgn)->get();
					return $data;
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		// -------------------- SELECT --------------------
		// -------------------- ADD --------------------
		public function addCM(Request $request){ // Add New City/ Municipality
          	$data['pro_id'] = $request->input('provinceCM');
          	$data['cm_name'] = $request->input('new_cm');
          	DB::table('city_muni')->insert([
            'pro_id' => $data['pro_id'],
            'cm_name' => $data['cm_name']
            ]);
          	return back();
		}
		public function addTypeFa(Request $request){
			try {
					$ChckData = DB::table('facility_requirements')
							->where('typ_id','=',$request->typeID)
							->where('upid','=', $request->id)
							->first();
					if (!$ChckData) {
						DB::table('facility_requirements')->insert([
				            'typ_id' =>$request->typeID,
				            'upid' =>$request->id
				            		]);
			            return "DONE";
					} else {
						return 'SAME';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		// -------------------- ADD --------------------
		// -------------------- EDIT -------------------
		public function savePhBarangay(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('brgyname'=>$request->name);
				$test = DB::table('barangay')->where('brgyid',$request->id)->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in barangay table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';
			}
		}
		public function savePhCmB(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('cmname'=>$request->name);
				$test = DB::table('city_muni')->where('cmid',$request->id)->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in city_muni table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function savePhProvince(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('provname' => $request->name);
				$test = DB::table('province')->where('provid',$request->id)->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in province table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function savePhRegion(Request $request){ // Update Ph Region
			try {
				$updateData = array('rgn_desc' => $request->name);
				$data = $this->InsertActLog($request->mod_id,"upd");
				$test = DB::table('region')->where('rgnid',$request->id)->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in region table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function isActive(Request $request){ // Update User Stat
			try {
				$currentState = ($request->isActive == 1 ? 0 : 1);
				$updateData = array('isActive'=> $currentState);
				$test = DB::table('x08')
					->where('uid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in x08 table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function isEnabled(Request $request){
			$currentState = ($request->isEnabled == 1 ? 0 :1);
			$updatedata = array('tyf_alw'=>$currentState);
			DB::table('type_facility')
				->where('tyf_id',$request->id)
				->update($updatedata);
			return 'DONE';
		}
		public function saveRights(Request $request){ // Update User Rights
			try {
				$updateData = array(
						'allow' 	=> 	$request->alwChk,
						'ad_d'		=>	$request->addChk,
						'upd'		=>	$request->updChk,
						'cancel'	=>	$request->cnlChk,
						'print' 	=>	$request->prtChk,
						'view' 		=>	$request->vwChk
					);
				$test = DB::table('x06')
			            ->where('x06_id', $request->id)
			            ->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in x06 table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveAppType(Request $request){ // Update Application Type
			try {
				    $updateData = array('aptdesc' => $request->name);
					$data = $this->InsertActLog($request->mod_id,"upd");
					$test = DB::table('apptype')
						->where('aptid',$request->id)
						->update($updateData);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in apptype table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveClass(Request $request){ // Update Class
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('classname' => $request->name);
				$test = DB::table('class')
					->where('classid',$request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in class table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveFaType(Request $request){ // Update Facility Type
			try {
					$data = $this->InsertActLog($request->mod_id,"upd");
					$updateData = array('facname' => $request->name);
					$test = DB::table('facilitytyp')
						->where('facid',$request->id)
						->update($updateData);
					if ($test) {
								return 'DONE';
						} else {
							$data = $this->SystemLogs('No data has been updated in facilitytyp table.');
							return 'ERROR';
						}		
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveOShip(Request $request){ // Update Ownership
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('ocdesc'=>$request->name);
				$test = DB::table('ownership')
					->where('ocid',$request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been ownership in class table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function savePLicense(Request $request){ // Update Personnel License
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('pldesc'=>$request->name);
				$test = DB::table('plicensetype')
					->where('plid',$request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been ownership in plicensetype table.');
					return 'ERROR';
				}
				
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function savePTrain(Request $request){ // Update Personnel Training
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('ptdesc'=>$request->name);
				$test = DB::table('ptrainings_trainingtype')
					->where('ptid',$request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been ownership in ptrainings_trainingtype table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveUpload(Request $request){ // Update Uploads
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('updesc'=>$request->name, 'isRequired' => $request->isRequiredNow);
				$test = DB::table('upload')
					->where('upid',$request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in upload table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function saveDept(Request $request){ // Update Department
			try {
					$data = $this->InsertActLog($request->mod_id,"upd");
					$updateData = array('depname'=>$request->name);
					$test = DB::table('department')
						->where('depid',$request->id)
						->update($updateData);
					if ($test) {
							return 'DONE';	
						} else {
							$data = $this->SystemLogs('No data has been updated in department table.');
							return 'ERROR';
					}			
				} catch (Exception $e) {
					$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';				
			}					
		}
		public function saveSect(Request $request){ // Update Section 
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('secname'=>$request->name);
				$test = DB::table('section')
					->where('secid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in section table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';			
			}
		}
		public function saveWorkStats(Request $request){ // Update Work Status
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('pworksname'=>$request->name);
				$test = DB::table('pwork_status')
					->where('pworksid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in pwork_status table.');
					return 'ERROR'; 
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR'; 
			}
		}
		public function saveWork(Request $request){ // Update Work
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('pworkname'=>$request->name);
				$test = DB::table('pwork')
					->where('pworkid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in pwork table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function savePart(Request $request){ // Update Part
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('partdesc'=>$request->name);
				$test = DB::table('part')
					->where('partid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in part table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveAsMt(Request $request){ // Update Assessment
			try {
				$data = $this->InsertActLog($request->mod_id,"upd");
				$updateData = array('asmt_name'=>$request->name);
				if (isset($request->faci)) {
					$updateData['facid'] = $request->faci;
				} 
				if (isset($request->cat)) {
					$updateData['caid'] = $request->cat;
				} 
				if (isset($request->part)){
					$updateData['partid'] = $request->part;
				}
				// return $updateData;
				$test = DB::table('assessment')
					->where('asmt_id', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been updated in assessment table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveHfst(Request $request){ // Update Health Facility/Service Type
			try {
					$data = $this->InsertActLog($request->mod_id,"upd");
					$updateData = array('hfser_desc'=>$request->name, 'seq_num' => $request->seq);
					$test = DB::table('hfaci_serv_type')
						->where('hfser_id', $request->id)
						->update($updateData);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in hfaci_serv_type table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
					$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';
			}
		}
		public function chngPass(Request $request){
			 $employeeData = session('employee_login');
			 $uname  = $employeeData->uid;
			 $pass= $request->nPass;
	   		$newpass = Hash::make($request->nPass);
	   		// $pass = Hash::check('pass', $data['pass']);
	   		$data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['grpid', '!=', 'C'] ])
                    ->select('*')
                    ->first();
   			if ($data) {
   				$chck = Hash::check($pass, $data->pwd);
   				if ($chck == true) {
   					return 'SAMEPASS';
   				} else {
   					$updateData = array('pwd'=>$newpass);
					DB::table('x08')
						->where('uid', $uname)
						->update($updateData);
					return 'DONE';
   				}
   			} 
		}
		public function reject_app(Request $request){
			try {
					$Cur_useData = $this->getCurrentUserAllData();
					// return $Cur_useData;
					$updateData = array(
										'isrecommended'=>0,
										'recommendedby' => $Cur_useData['cur_user'],
										'recommendedtime' => $Cur_useData['time'],
										'recommendeddate' =>  $Cur_useData['date'],
										'recommendedippaddr' =>$Cur_useData['ip'],
										'status' => 'RE',
									);
					$test = DB::table('appform')->where('appid', '=', $request->apid)->update($updateData);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been modified in appform table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function accept_app(Request $request){
			try {
					$Cur_useData = $this->getCurrentUserAllData();
					$updateData = array(
										'isrecommended'=>1,
										'recommendedby' => $Cur_useData['cur_user'],
										'recommendedtime' => $Cur_useData['time'],
										'recommendeddate' =>  $Cur_useData['date'],
										'recommendedippaddr' =>$Cur_useData['ip'],
										'proposedInspectiontime' => $request->proptime,
										'proposedInspectiondate' =>  $request->propdate,
										'status'=> 'FI',
									);
					$test = DB::table('appform')->where('appid', '=', $request->apid)->update($updateData);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been modified in appform table.');
						return 'ERROR';
					}					
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function saveOop(Request $request) {
			$updateData = array('oop_id'=>$request->OopID);
			DB::table('type_facility')->where('tyf_id', '=', $request->appID)->update($updateData);
			return 'DONE';
		}
		public function saveChrg(Request $request){
			try {
				$updateData = array('chg_desc'=>$request->desc,'chg_exp'=>$request->exp,'chg_rmks'=>$request->rmk);
				$test = DB::table('charges')->where('chg_code', $request->code)->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been modified in charges table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function rearrange_oop(Request $request){
			$newSeq = null;
			if ($request->type == 'up') {
				$newSeq = $request->seq_num - 1;
			} else if ($request->type == 'down' ) {
				$newSeq = $request->seq_num + 1;
			}

			try {
				$oldSeq = $request->seq_num;
				$data = DB::table('chg_app')->where([['oop_id','=', $request->oop_id],['chgopp_seq', '=', $newSeq]])->first();
				// return dd($data);
				$update = array('chgopp_seq'=>$oldSeq);
				$test1 = DB::table('chg_app')->where('chgapp_id','=',$data->chgapp_id)->update($update);

				$update2 = array('chgopp_seq'=>$newSeq);
				$test2 = DB::table('chg_app')->where('chgapp_id','=',$request->chgopp_id)->update($update2);

				if ($test1 && $test2) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been modfied in chg_app table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function SaveAmt(Request $request){
			try {
				// $test0 = (isset($request->rmk)) ? $request->rmk : ' ' ;
				// return $test0; 
				$data = array('amt'=>$request->amt,'remarks'=> $request->rmk);
				$test = DB::table('chg_app')->where('chgapp_id','=', $request->id)->update($data);
				// if ($test) {
				// 	return 'DONE';
				// } else {
				// 	$data = $this->SystemLogs('No data has been updated ownership in chg_app table.');
				// 	return 'ERROR';
				// }
				return 'DONE';
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveRgnLO(Request $request){
			$Cur_useData = $this->getCurrentUserAllData();
			if ($request->lo == null) { // Without LO
				$data = array (
								'assignedRgn' => $request->rgnid,
								'assignedRgnTime' => $Cur_useData['time'],
								'assignedRgnDate' => $Cur_useData['date'],
								'assignedRgnIP' => $Cur_useData['ip'],
								'assignedRgnBy' =>$Cur_useData['cur_user']
							);
			} else {
				$data = array (
								'assignedRgn' => $request->rgnid,
								'assignedRgnTime' => $Cur_useData['time'],
								'assignedRgnDate' => $Cur_useData['date'],
								'assignedRgnIP' => $Cur_useData['ip'],
								'assignedRgnBy' =>$Cur_useData['cur_user'],
								'assignedLO' => $request->lo,
								'assignedLOTime' => $Cur_useData['time'],
								'assignedLoDate' => $Cur_useData['date'],
								'assignedLOIP' => $Cur_useData['ip'],
								'assignedLOBy' => $Cur_useData['cur_user']
							);
			}
			DB::table('appform')->where('appid', '=', $request->appid)->update($data);
			DB::table('appform_hist')->insert($data);
			$last = DB::getPdo()->lastInsertId();
			$data2 = array('appid'=>$request->appid);
			DB::table('appform_hist')->where('appformhist', '=', $last)->update($data2);
			

			return 'DONE';
		}
		public function saveNewLO(Request $request){
			$Cur_useData = $this->getCurrentUserAllData();
			$data = DB::table('appform')->where([['appid', '=', $request->appid],['assignedLO', '=', $request->lo]])->first();
			// return $request->lo;
			if ($data) {
				return 'SAME';
			} else {
				$updateData = array(
								'assignedLO' => $request->lo,
								'assignedLOTime' => $Cur_useData['time'],
								'assignedLoDate' => $Cur_useData['date'],
								'assignedLOIP' => $Cur_useData['ip'],
								'assignedLOBy' => $Cur_useData['cur_user']
						);
				DB::table('appform')->where('appid', '=', $request->appid)->update($updateData);
				$insertData = array (
								'assignedRgn' => $request->rgnid,
								'assignedRgnTime' => $Cur_useData['time'],
								'assignedRgnDate' => $Cur_useData['date'],
								'assignedRgnIP' => $Cur_useData['ip'],
								'assignedRgnBy' =>$Cur_useData['cur_user'],
								'assignedLO' => $request->lo,
								'assignedLOTime' => $Cur_useData['time'],
								'assignedLoDate' => $Cur_useData['date'],
								'assignedLOIP' => $Cur_useData['ip'],
								'assignedLOBy' => $Cur_useData['cur_user']
							);
				DB::table('appform_hist')->insert($insertData);
				return 'DONE';			
			}
		}
		public function saveHoliday(Request $request){
			try {
					$data = array(
							'hdy_desc'=>$request->desc,
							'hdy_date'=>$request->dt,
							'hdy_typ'=>$request->typ
						);
					$test = DB::table('holidays')->where('hdy_id', '=', $request->code)->update($data);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in holidays table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveCategory(Request $request){
			try {
					$data = array('cat_desc'=>$request->name,'cat_type'=>$request->type);
					$test = DB::table('category')->where('cat_id', '=', $request->id)->update($data);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in category table.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveTStatus(Request $request){
			try {
				    $data = array('trns_desc'=>$request->name,'allowedpayment'=>$request->allow, 'canapply' => $request->apply);
				    $test = DB::table('trans_status')->where('trns_id', '=', $request->id)->update($data);
				    if ($test) {
				    	return 'DONE';
				    } else {
				    	$data = $this->SystemLogs('No data has been updated in trans_status table.');
				    	return 'ERROR';
				    }
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function saveMoP(Request $request){
			try {
					$data = array('chg_desc'=>$request->name);
					$test = DB::table('charges')->where('chg_code', '=', $request->id)->update($data);
					if ($test) {
				    	return 'DONE';
				    } else {
				    	$data = $this->SystemLogs('No data has been updated in charges table.');
				    	return 'ERROR';
				    }
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function acceptPayEval(Request $request){
				try {
						$Cur_useData = $this->getCurrentUserAllData();
						$data = array(
								   'isPayEval' => 1,
								   'payEvaldate' => $Cur_useData['date'],
								   'payEvaltime' => $Cur_useData['time'],
								   'payEvalip' => $Cur_useData['ip'],
								   'payEvalby' => $Cur_useData['cur_user'],
								   'status' => 'FA',
								);
						$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
						if ($test) {
							return 'DONE';
						} else {
							$data = $this->SystemLogs('No data has been updated in appform table.');
					    	return 'ERROR';
						}
				} catch (Exception $e) {
					$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
		}
		public function saveTeam(Request $request){
			try {
					$data = array('teamdesc' => $request->name, 'rgnid' => $request->seq);

					$test = DB::table('team')->where('teamid', '=', $request->id)->update($data);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in team table.');
				    	return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function save_AsmtCat(Request $request){
			try {
					$data = array('categorydesc' => $request->name);
					$test = DB::table('cat_assess')->where('caid', '=', $request->id)->update($data);
					if ($test) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been updated in cat_assess table.');
				    	return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		// -------------------- EDIT -------------------- 
		// -------------------- DELETE --------------------
		public function delAppType(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('apptype')->where('aptid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in apptype table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';					
			}
		}
		public function delClass(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('class')->where('classid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in class table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delFaType(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('facilitytyp')->where('facid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in facilitytyp table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delOShip(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('ownership')->where('ocid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in ownership table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delPLicense(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('plicensetype')->where('plid', '=', $request->id)->delete();
				if ($test) {
						return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in plicensetype table.');
					return 'ERROR';
				}			
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delTrain(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('ptrainings_trainingtype')->where('ptid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in ptrainings_trainingtype table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delUpload(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('upload')->where('upid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in upload table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function delDept(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('department')->where('depid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in department table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function delSect(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('section')->where('secid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in section table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function delWorkStats(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('pwork_status')->where('pworksid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in pwork_status table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}

		}
		public function delWork(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('pwork')->where('pworkid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in pwork table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delPart(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('part')->where('partid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in part table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public function delAsMt(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('assessment')->where('asmt_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					return 'ERROR';
				}
			} catch (Exception $e) {
				return 'ERROR';		
			}
		}
		public function delHfst(Request $request){
			try {
				$data = $this->InsertActLog($request->mod_id,"del");
				$test = DB::table('hfaci_serv_type')->where('hfser_id', '=', $request->id)->delete();
				if ($test) {
					$data = $this->SystemLogs('No data has been deleted in hfaci_serv_type table.');
					return 'DONE';
				} else {
					$data = $this->SystemLogs($e->getMessage());
					return 'ERROR';
				}
			} catch (Exception $e) {
				return 'ERROR';	
			}
		}
		public function delChrg(Request $request){
			try {
				$test = DB::table('charges')->where('chg_code', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in charges table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';		
			}
		}
		public function delChrgOop(Request $request){
			try {
				$data = DB::table('chg_app')
								// ->join('chg_app', 'chg_oop.chgapp_id', '=', 'chg_app.chgapp_id')
								->where('chgapp_id', '=', $request->id)->first();
				// return dd($data->chgapp_id);
				$test1 = DB::table('chg_app')->where('chgapp_id','=', $request->id)->delete();
				// $test2 = DB::table('chg_app')->where('chgapp_id','=', $data->chgapp_id)->delete();
				$data2 = DB::table('chg_app')->where('oop_id', '=', $request->oop_id)->orderBy('chgopp_seq', 'asc')->get();
				// return dd($data2);
				// $total = count($data2);
				for ($i=0,$s=1; $i < count($data2); $i++,$s++) { 
					DB::table('chg_app')->where('chgapp_id', '=', $data2[$i]->chgapp_id)->update(['chgopp_seq'=>$s]);
				}
				if ($test1) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in chg_oop and chg_app tables.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delHolidays(Request $request){
			try {
				$test = DB::table('holidays')->where('hdy_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in holidays table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delCategory(Request $request){
			try {
				$test = DB::table('category')->where('cat_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in category table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delTStatus(Request $request){
			try {
				$test = DB::table('trans_status')->where('trns_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in trans_status table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function delMoP(Request $request){
			try {
				$test = DB::table('charges')->where('chg_code', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					$data = $this->SystemLogs('No data has been deleted in charges table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function del_payment(Request $request){
			try {
					$getData = DB::table('chgfil')->where('id', '=', $request->id)->first();
					$test = DB::table('chgfil')->where('id', '=', $request->id)->delete();
					$updateData = array('chg_num'=>$getData->chg_num);
					$test2 = DB::table('chg_app')->where('chgapp_id', '=', $getData->chgapp_id)->update($updateData);
					if ($test && $test2) {
						return 'DONE';
					} else {
						$data = $this->SystemLogs('No data has been deleted in chgfil and chg_app tables.');
						return 'ERROR';
					}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function del_test(Request $request){
			try {
				$test = DB::table('team')->where('teamid', '=', $request->id)->delete();
				if($test){
					return 'DONE';
				} else {	
					$data = $this->SystemLogs('No data has been deleted in team table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				$data = $this->SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public function del_AsmtCat(Request $request){
			try {
				$test = DB::table('cat_assess')->where('caid', '=', $request->id)->delete();
				if($test){
					return 'DONE';
				} else {	
					$data = $this->SystemLogs('No data has been deleted in cat_assess table.');
					return 'ERROR';
				}
			} catch (Exception $e) {
				
			}
		}
		// -------------------- DELETE --------------------
	}
?>