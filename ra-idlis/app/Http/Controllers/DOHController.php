<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DOHController extends Controller
{
    public function dashboard(Request $request){
        if ($request->isMethod('get')) {
            return view('doh.dashboard');
        }
    }
}
