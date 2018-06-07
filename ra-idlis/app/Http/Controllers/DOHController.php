<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Carbon\Carbon;
	use Hash;
	class DOHController extends Controller
	{
		public function login(Request $request){
			if($request->isMethod('get')){
	   			return view('doh.login');
	   		}
	   		if ($request->isMethod('post')) {
	   			$uname = $request->uname;
	   			$data['pass'] = $request->pass;
	   			$pass = Hash::check('pass', $data['pass']);
	   			$data = DB::table('x08')
                    ->where([ ['uid', '=', $uname], ['pwd', '=', $pass], ['grpid', '!=', 'C'] ])
                    ->select('*')
                    ->first();
                if ($data) {
                	$employeeData =	DB::table('x08')
                                ->join('region', 'x08.rgnid', '=', 'region.rgnid')
                                ->join('province', 'x08.province', '=', 'province.provid')
                                ->select('x08.*', 'region.rgn_desc', 'province.provname')
                                ->where('x08.uid', '=', $data->uid)
                                ->first()
                                ;
                    $x = $employeeData->mname;
                    $mid = strtoupper($x[0]);
                    $name = $employeeData->fname.' '.$mid.'. '.$employeeData->lname;
                    echo $name;
                    $employeeData->name = $name;
                	session()->put('employee_login',$employeeData);
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
				return view('doh.regional',['region'=>$regions]);
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
	}
?>