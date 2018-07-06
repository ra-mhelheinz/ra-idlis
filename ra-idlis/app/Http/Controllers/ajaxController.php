3<?php 
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
			return $data;
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
								->select('type_facility.*', 'hfaci_serv_type.*', 'facilitytyp.*')
								->where('type_facility.hfser_id', '=', $request->hfser_id)
								->first();
			if ($TypeFace) {
				$getAllData = DB::table('type_facility')
								->join('hfaci_serv_type', 'type_facility.hfser_id','=','hfaci_serv_type.hfser_id')
								->join('facilitytyp', 'type_facility.facid', '=', 'facilitytyp.facid')
								->select('type_facility.*', 'hfaci_serv_type.*', 'facilitytyp.*')
								->where('type_facility.hfser_id', '=', $request->hfser_id)
								->get();
				return $getAllData;
			} else {
				return "NONE";
			}
		}
		public function getRequirements(Request $request){
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
		}
		public function getLPS(Request $request){
			$getData = DB::table('appform')
								->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
								->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
								->join('x08', 'appform.uid', '=', 'x08.uid')
								->join('region', 'x08.rgnid', '=', 'region.rgnid')
								->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
								->join('province', 'x08.province', '=', 'province.provid')
								->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname' )
								->where('appform.hfser_id', '=', $request->hfser_ID)
								->where('appform.facid', '=', $request->facID)
								->where('x08.rgnid', '=', $request->rgnID)
								->where('appform.draft', '=', 0)
								->first();
			if (!$getData) {
				return 'NONE';
			} else {
				$anotherData = DB::table('appform')
								->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
								->join('facilitytyp', 'appform.facid', '=', 'facilitytyp.facid')
								->join('x08', 'appform.uid', '=', 'x08.uid')
								->join('region', 'x08.rgnid', '=', 'region.rgnid')
								->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
								->join('province', 'x08.province', '=', 'province.provid')
								->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
								->join('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
								->join('ownership', 'appform.ocid', '=', 'ownership.ocid')
								->join('class', 'appform.classid', '=', 'class.classid')
								->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'facilitytyp.facname', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname')
								->where('appform.hfser_id', '=', $request->hfser_ID)
								->where('appform.facid', '=', $request->facID)
								->where('x08.rgnid', '=', $request->rgnID)
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
					}
				return $anotherData;
			}
			
			// return 'TEST';
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
		// -------------------- SELECT --------------------
		// -------------------- ADD --------------------
		public function addCM(Request $request){ // Add New City/ Municipality
          	$data['pro_id'] = $request->input('provinceCM');
          	$data['cm_name'] = $request->input('new_cm');
          	DB::table('city_muni')->insert([
            'pro_id' => $data['pro_id'],
            'cm_name' => $data['cm_name']
            ]
        );
          	return back();
		}
		public function addTypeFa(Request $request){
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
		}
		// -------------------- ADD --------------------
		// -------------------- EDIT -------------------
		public function savePhBarangay(Request $request){
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('brgyname'=>$request->name);
			DB::table('barangay')->where('brgyid',$request->id)->update($updateData);
			return 'DONE';
		}
		public function savePhCmB(Request $request){
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('cmname'=>$request->name);
			DB::table('city_muni')->where('cmid',$request->id)->update($updateData);
			return 'DONE';
		}
		public function savePhProvince(Request $request){
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('provname' => $request->name);
			DB::table('province')->where('provid',$request->id)->update($updateData);
			return 'DONE';
		}
		public function savePhRegion(Request $request){ // Update Ph Region
			$updateData = array('rgn_desc' => $request->name);
			$data = $this->InsertActLog($request->mod_id,"upd");
			DB::table('region')->where('rgnid',$request->id)->update($updateData);
			return 'DONE';
		}
		public function isActive(Request $request){ // Update User Stat
			$currentState = ($request->isActive == 1 ? 0 : 1);
			$updateData = array('isActive'=> $currentState);
			DB::table('x08')
				->where('uid', $request->id)
				->update($updateData);
			return 'DONE';
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
			$updateData = array(
						'allow' 	=> 	$request->alwChk,
						'ad_d'		=>	$request->addChk,
						'upd'		=>	$request->updChk,
						'cancel'	=>	$request->cnlChk,
						'print' 	=>	$request->prtChk,
						'view' 		=>	$request->vwChk
					);
			DB::table('x06')
            ->where('x06_id', $request->id)
            ->update($updateData);
			return 'DONE';
		}
		public function saveAppType(Request $request){ // Update Application Type
			$updateData = array('aptdesc' => $request->name);
			$data = $this->InsertActLog($request->mod_id,"upd");
			DB::table('apptype')
				->where('aptid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveClass(Request $request){ // Update Class
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('classname' => $request->name);
			DB::table('class')
				->where('classid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveFaType(Request $request){ // Update Facility Type
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('facname' => $request->name);
			DB::table('facilitytyp')
				->where('facid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveOShip(Request $request){ // Update Ownership
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('ocdesc'=>$request->name);
			DB::table('ownership')
				->where('ocid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePLicense(Request $request){ // Update Personnel License
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('pldesc'=>$request->name);
			DB::table('plicensetype')
				->where('plid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePTrain(Request $request){ // Update Personnel Training
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('ptdesc'=>$request->name);
			DB::table('ptrainings_trainingtype')
				->where('ptid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveUpload(Request $request){ // Update Uploads
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('updesc'=>$request->name, 'isRequired' => $request->isRequiredNow);
			DB::table('upload')
				->where('upid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveDept(Request $request){ // Update Department
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('depname'=>$request->name);
			DB::table('department')
				->where('depid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveSect(Request $request){ // Update Section 
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('secname'=>$request->name);
			DB::table('section')
				->where('secid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveWorkStats(Request $request){ // Update Work Status
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('pworksname'=>$request->name);
			DB::table('pwork_status')
				->where('pworksid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveWork(Request $request){ // Update Work
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('pworkname'=>$request->name);
			DB::table('pwork')
				->where('pworkid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePart(Request $request){ // Update Part
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('partdesc'=>$request->name);
			DB::table('part')
				->where('partid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveAsMt(Request $request){ // Update Assessment
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('asmt_name'=>$request->name);
			DB::table('assessment')
				->where('asmt_id', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveHfst(Request $request){ // Update Health Facility/Service Type
			$data = $this->InsertActLog($request->mod_id,"upd");
			$updateData = array('hfser_desc'=>$request->name);
			DB::table('hfaci_serv_type')
				->where('hfser_id', $request->id)
				->update($updateData);
			return 'DONE';
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
		// -------------------- EDIT -------------------- 
		// -------------------- DELETE --------------------
		public function delAppType(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('apptype')->where('aptid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delClass(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('class')->where('classid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delFaType(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('facilitytyp')->where('facid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delOShip(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('ownership')->where('ocid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delPLicense(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('plicensetype')->where('plid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delTrain(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('ptrainings_trainingtype')->where('ptid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delUpload(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('upload')->where('upid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delDept(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('department')->where('depid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delSect(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('section')->where('secid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delWorkStats(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('pwork_status')->where('pworksid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delWork(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('pwork')->where('pworkid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delPart(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('part')->where('partid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delAsMt(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('assessment')->where('asmt_id', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delHfst(Request $request){
			$data = $this->InsertActLog($request->mod_id,"del");
			DB::table('hfaci_serv_type')->where('hfser_id', '=', $request->id)->delete();
			return 'DONE';
		}
		// -------------------- DELETE --------------------
	}
?>