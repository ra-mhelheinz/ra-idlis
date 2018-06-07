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
		public function regionalAdmins(Request $request){
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				$users = DB::table('x08')
						->where('grpid', '=', 'RA')
						->select('*')
						->first()
						;
				if ($users) {
					$users = DB::table('x08')
						->where('grpid', '=', 'RA')
						->select('*')
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
		public function groupRights(Request $request){
			if ($request->isMethod('get')) {
				$group = DB::table('x07')->select('*')->get();
				$groupRights = DB::table('x06')
				// ->join('orders', 'users.id', '=', 'orders.user_id')
								->join('x05', 'x06.mod_id','=','x05.mod_id')
								->join('x07', 'x06.grp_id', '=', 'x07.grp_id')
								->select('x06.*', 'x05.*', 'x07.*')
								->get()
								;
				// return response()->json(['rights'=>$groupRights]);
				return view('doh.grprights',['rights'=>$groupRights], ['groups'=>$group]);
			}
		}
		public function regions(Request $request){
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				return view('doh.phregion',['region'=>$regions]);
			}
		}
		public function LOfficers(Request $request){
			if ($request->isMethod('get')) {
				$regions = DB::table('region')->get();
				return view('doh.lo',['region'=>$regions]);
			}
		}
	}
?>