<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Carbon\Carbon;
	use Hash;
	
	class DOHController extends Controller
	{
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
	   			$data['pass'] = $request->pass;
	   			$pass = Hash::check('pass', $data['pass']);
	   			$data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['pwd', '=', $pass], ['grpid', '!=', 'C'] ])
                    ->select('*')
                    ->first();
                if ($data) {
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
      //               $users->name = $name;
				}
				return view('doh.regional',['region'=>$regions,'users'=>$users]);
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
							->where('grpid', '=', 'LO')
							->select('*')
							->get()
							;
					return view('doh.lo',['region'=>$regions,'users'=>$users]);
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
							->where('grpid', '=', 'LO')
							->where('rgnid', '=', $testX->rgnid)
							->select('*')
							->get()
							;
				}
			return view('doh.lo',['region'=>$regions,'users'=>$users]);
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
			return view('doh.lps');
		}
		public function evalute(){
			return view('doh.evalute');
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
				DB::table('class')->insert([
					'classid' => $request->id,
					'classname'=> $request->name,
					'ocid' => $request->ocid,
				]);
				return 'DONE';
			}
		}
		public function AppType(Request $request) { // Master File/Application Type Page
			if ($request->isMethod('get')) {
				$apptype = DB::table('apptype')->get();
				return view('doh.mfapptype',['apptype'=>$apptype]);
			}
			if ($request->isMethod('post')) {
				DB::table('apptype')->insert(
				[
					'aptid' => $request->id,
					'aptdesc' => $request->name, 
				]
			);
				return "DONE";
			}
		}
		public function FaType(Request $request){ // Master File/Facility Type Page
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
				$oShip = DB::table('ownership')->get();
				return view('doh.mfoship',['oShip'=>$oShip]);
			}
			if ($request->isMethod('post')) {
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
							->where('grpid', '=', 'FDA')
							->select('*')
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
							->where('grpid', '=', 'FDA')
							->where('rgnid', '=', $testX->rgnid)
							->select('*')
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
				DB::table('plicensetype')->insert([
					'plid' => $request->id,
					'pldesc' => $request->name,
				]);
				return 'DONE';
			}
		}
		public function Train(Request $request){
			if ($request->isMethod('get')) {
				$train = DB::table('ptrain')->get();
				return view('doh.mftrain',['train'=>$train]);
			}
			if ($request->isMethod('post')) {
				DB::table('ptrain')->insert(['ptid'=>$request->id,'ptdesc'=>$request->name]);
				return 'DONE';
			}
		}
		public function Upload(Request $request){ // Master File/Upload Page
			if ($request->isMethod('get')) {
				$fatype = DB::table('facilitytyp')->get();
				$ups = DB::table('upload')->get();
				return view('doh.mfupload',['facility'=>$fatype,'uploads'=>$ups]);
			}
			if ($request->isMethod('post')) {
				DB::table('upload')->insert(['updesc'=>$request->name,'facid'=>$request->facid]);
				return 'DONE';
			}
		}
	}
?>