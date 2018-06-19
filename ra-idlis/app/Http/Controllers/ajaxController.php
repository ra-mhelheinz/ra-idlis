<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	class ajaxController extends Controller
	{
		// -------------------- SELECT --------------------
		public function selectProvince(Request $request){
			$provinces = DB::table('province')->where('rgnid',$request->reg_id)->get();
	    	return response()->json(['provinces'=>$provinces]);
		}
		public function selectBrgy(Request $request){
			$brgy = DB::table('barangay')->where('cmid',$request->id)->get();
			// return $request->id;
			return response()->json($brgy);
		}
		public function getRights(Request $request){
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
		public function getClass(Request $request){
			$class = DB::table('class')->where('ocid',$request->ocid)->get();
	    	return response()->json(['classes'=>$class]);
		}
		public function selectUploads(Request $request){
			$upload = DB::table('upload')->where('facid',$request->id)->first();
			if ($upload) {
				$upload = DB::table('upload')->where('facid',$request->id)->get();
				return response()->json($upload);
			} else {return 'NO';}
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
		public function isActive(Request $request){
			$currentState = ($request->isActive == 1 ? 0 : 1);
			$updateData = array('isActive'=> $currentState);
			DB::table('x08')
				->where('uid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveRights(Request $request){ // Add New Rights
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
		public function saveAppType(Request $request){
			$updateData = array('aptdesc' => $request->name);
			DB::table('apptype')
				->where('aptid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveClass(Request $request){
			$updateData = array('classname' => $request->name);
			DB::table('class')
				->where('classid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveFaType(Request $request){
			$updateData = array('facname' => $request->name);
			DB::table('facilitytyp')
				->where('facid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveOShip(Request $request){
			$updateData = array('ocdesc'=>$request->name);
			DB::table('ownership')
				->where('ocid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePLicense(Request $request){
			$updateData = array('pldesc'=>$request->name);
			DB::table('plicensetype')
				->where('plid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePTrain(Request $request){
			$updateData = array('ptdesc'=>$request->name);
			DB::table('ptrainings_trainingtype')
				->where('ptid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveUpload(Request $request){
			$updateData = array('updesc'=>$request->name);
			DB::table('upload')
				->where('upid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveDept(Request $request){
			$updateData = array('depname'=>$request->name);
			DB::table('department')
				->where('depid',$request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveSect(Request $request){
			$updateData = array('secname'=>$request->name);
			DB::table('section')
				->where('secid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveWorkStats(Request $request){
			$updateData = array('pworksname'=>$request->name);
			DB::table('pwork_status')
				->where('pworksid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveWork(Request $request){
			$updateData = array('pworkname'=>$request->name);
			DB::table('pwork')
				->where('pworkid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function savePart(Request $request){
			$updateData = array('partdesc'=>$request->name);
			DB::table('part')
				->where('partid', $request->id)
				->update($updateData);
			return 'DONE';
		}
		public function saveAsMt(Request $request){
			$updateData = array('asmt_name'=>$request->name);
			DB::table('assessment')
				->where('asmt_id', $request->id)
				->update($updateData);
			return 'DONE';
		}
		// -------------------- EDIT -------------------- 
		// -------------------- DELETE --------------------
		public function delAppType(Request $request){
			DB::table('apptype')->where('aptid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delClass(Request $request){
			DB::table('class')->where('classid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delFaType(Request $request){
			DB::table('facilitytyp')->where('facid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delOShip(Request $request){
			DB::table('ownership')->where('ocid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delPLicense(Request $request){
			DB::table('plicensetype')->where('plid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delTrain(Request $request){
			DB::table('ptrainings_trainingtype')->where('ptid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delUpload(Request $request){
			DB::table('upload')->where('upid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delDept(Request $request){
			DB::table('department')->where('depid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delSect(Request $request){
			DB::table('section')->where('secid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delWorkStats(Request $request){
			DB::table('pwork_status')->where('pworksid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delWork(Request $request){
			DB::table('pwork')->where('pworkid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delPart(Request $request){
			DB::table('part')->where('partid', '=', $request->id)->delete();
			return 'DONE';
		}
		public function delAsMt(Request $request){
			DB::table('assessment')->where('asmt_id', '=', $request->id)->delete();
			return 'DONE';
		}
		// -------------------- DELETE --------------------
	}
?>