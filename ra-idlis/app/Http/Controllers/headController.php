<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class headController extends Controller
{
    public function headash(Request $request){
    	if ($request->isMethod('get')) {
    		return view('head.headashboard');
    	}
    }
    public function LOaccount(Request $request){
    	if ($request->isMethod('get')) {
    		return view('head.LOaccount');
    	}
    }
    public function headprocess(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headprocess');
        }
    }
    public function headevaluate(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headevaluate');
        }
    }
    public function headinspection(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headinspection');
        }
    }
    public function headinspection2(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headinspection2');
        }
    }
    public function headinspection3(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headinspection3');
        }
    }
}
