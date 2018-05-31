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
    public function headorderofpayment(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment');
        }
    }
    public function headorderofpayment2(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment2');
        }
    }
    public function headorderofpayment3(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment3');
        }
    }
    public function headorderofpayment4(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment4');
        }
    }
    public function headorderofpayment5(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment5');
        }
    }
    public function headorderofpayment6(Request $request){
        if ($request->isMethod('get')) {
            return view('head.headorderofpayment6');
        }
    }
}
