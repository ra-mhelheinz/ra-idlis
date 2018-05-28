<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class layoutController extends Controller
{
   public function home(){
   	return view('template.landingpage');
   }
   public function apply(){
   	return view('template.apply');
   }
   public function verification(){
   	return view('template.verification');
   }
   public function inspection(){
   	return view('template.inspection');
   }
    public function issuance(){
   	return view('template.issuance');
   }
}
