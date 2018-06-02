<?php 
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	class DOHController extends Controller
	{
		public function dashboard(){
			return view('doh.dashboard');
		}
	}
?>