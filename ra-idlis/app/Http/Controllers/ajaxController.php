<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Facades\Hash;
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
		// -------------------- ADD --------------------
		// -------------------- EDIT --------------------
		public function isActive(Request $request){ // Update User Stat
			$currentState = ($request->isActive == 1 ? 0 : 1);
			$updateData = array('isActive'=> $currentState);
			DB::table('x08')
				->where('uid', $request->id)
				->update($updateData);
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
			$updateData = array('updesc'=>$request->name);
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