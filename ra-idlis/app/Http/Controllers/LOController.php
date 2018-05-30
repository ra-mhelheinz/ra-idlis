<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LOController extends Controller
{
   public function employeelogin(Request $request){
   	if($request->isMethod('get')){
   			return view('LO.employeelogin');
   		}
   }
    public function LOdashboard(Request $request){
   	if($request->isMethod('get')){
   			return view('LO.dashboard');
   		}
   }
   public function LOprocess(Request $request){
      if($request->isMethod('get')){
            return view('LO.loprocess');
         }
   }
   public function LOevaluate(Request $request){
      if($request->isMethod('get')){
            return view('LO.loevaluate');
         }
   }
   public function LOinspection(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOinspection');
         }
   }
   public function LOinspection2(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOinspection2');
         }
   }
   public function LOinspection3(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOinspection3');
         }
   }
   public function LOorderofpayment(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment');
         }
   }
   public function LOorderofpayment2(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment2');
         }
   }
   public function LOorderofpayment3(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment3');
         }
   }
   public function LOorderofpayment4(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment4');
         }
   }
   public function LOorderofpayment5(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment5');
         }
   }
   public function LOorderofpayment6(Request $request){
      if($request->isMethod('get')){
            return view('LO.LOorderofpayment6');
         }
   }
}
