<?php 
	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use Mail;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;
   use Carbon\Carbon;
   use Illuminate\Support\Str;
   use Hash;
   use DB;
      
	class MailController extends Controller
	{
   public function auto_mailer(Request $request){
      if($request->isMethod('get')){
         return view('client.register');
      }
      if($request->isMethod('post')){
          $dt = Carbon::now();
          $dateNow = $dt->toDateString();
          $timeNow = $dt->toTimeString();
          $data['facility_name'] = $request->facility_name;
          $data['region'] = $request->region;
          $data['province'] = $request->province;
          $data['brgy'] = $request->brgy;
          $data['street'] = $request->street;
          $data['city_muni'] = $request->city_muni;
          $data['zip'] = $request->zipcode;
          $data['authorized'] = $request->auth_name;
          $data['tel'] = $request->tel;
          $data['cel'] = $request->cel;
          $data['uname'] = strtoupper($request->uname);
          $data['pass'] = Hash::make($request->pass2);
          $data['email'] = $request->email;
          $data['contact_p'] = $request->contact_p;
          $data['contact_pno'] = $request->contact_pno;
          $data['ip'] = request()->ip();
          $data['token'] = Str::random(40);
          // Check Username
          $checkUser = DB::table('x08')
                        ->where('uid', '=' ,$data['uname'])
                        ->where('grpid' , '=' , 'C')
                        ->exists();
          // Check Facility Name
          $checkFacility = DB::table('x08')
                        ->where('facilityname', '=' , $data['facility_name'])
                        ->exists();
          if ($checkUser == true) {
              return 'same';
          } else if ($checkFacility == true) {
              return 'sameFacility';
          }
          else {
            $data1 = array('name'=>$request->facility_name, 'token'=>$data['token']);
            Mail::send('mail', $data1, function($message) use ($request) {
               $message->to($request->email, $request->facility_name)->subject
                  ('Verify Email Account');
               $message->from('doholrs@gmail.com','DOH Support');
            });

              DB::table('x08')->insert(
                [
                    'uid' => $data['uname'],
                    'pwd' => $data['pass'],
                    'facilityname' => $data['facility_name'],
                    // 'rgnid_address' => $data['regionadd'],
                    'rgnid' => $data['region'],
                    'province' => $data['province'],
                    'barangay' => $data['brgy'],
                    'streetname' => $data['street'],
                    'city_muni' => $data['city_muni'],
                    'zipcode' => $data['zip'],
                    'contactperson' => $data['contact_p'],
                    'contactpersonno' => $data['contact_pno'],
                    'rgnid_address' => $data['tel'],
                    'email' => $data['email'],
                    'authorizedsignature' => $data['authorized'],
                    'contact' => $data['cel'],
                    'ipaddress' => $data['ip'],
                    't_date' => $dateNow,
                    't_time' =>$timeNow,
                    'grpid' => 'C',
                    'token' => $data['token']
                ]
            );


            // return response()->json(['test'=>$data]);
            // return "Check";
            return 'DONE';
          }
        }  
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('sydpalacio@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('ra-idlis/public/img/doh2.png');
         $message->from('rasydbalbidas@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }

    public function resend_ver(Request $req, $id) {
      $data = DB::table('x08')->where('uid', '=', $id)->first();
      $data1 = array('name'=>$data->facilityname, 'token'=>$data->token);
   
      Mail::send('mail', $data1, function($message) use ($data) {
         $message->to($data->email, $data->facilityname)->subject
            ('Verify your Account in DOH OLRS');
         $message->from('doholrs@gmail.com', 'DOH OLRS Support');
      });
      return redirect()->route('client');
    } 
    public function SaveSystemUser(Request $request) {
        if ($request->isMethod('post')) {
          # code...
        }
    }     
}