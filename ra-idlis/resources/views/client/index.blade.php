@extends('main')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/service.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/engine1/style.css')}}" />
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/jquery.js')}}"></script>
@section('content')
@php
  $uid = session('client_data')->uid;
  $check_assess = DB::table('app_assessment')->where('draft', '=', '0')->where('uid', '=', session('client_data')->uid)->get();
  $check_assess1 = DB::table('app_assessment')->where('draft', '=', '0')->where('complied', '=', '1')->where('uid', '=', session('client_data')->uid)->get();
  $check_asspp = DB::table('assessment')->get();
  $newSql = "SELECT draft , uid FROM app_assessment WHERE draft != '0' AND uid = '$uid' GROUP BY draft, uid";
  $check_drafts = DB::select($newSql);
  $check_counter = -1;
  if (count($check_assess) < 1) {$check_counter = -1; } else {$check_counter = 0; foreach ($check_assess as $check) {if ($check->complied == '0') {$check_counter++; } } } 
  $status = "complied";
@endphp
<style type="text/css">
  td{
    font-size: 13px;
    text-overflow: ellipsis; 
    overflow: hidden; 
    white-space:nowrap;
  }
  .fa-recycle {
    -webkit-animation: rotation 2s infinite linear;
}

@-webkit-keyframes rotation {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(359deg);
    }
}

  #syd { @if(count($check_assess1) != count($check_asspp) && ($check_counter > 0 || $check_counter < 0))  pointer-events: none; @endif } 

</style>
@include('client.nav')
  <div class="modal" id="myModal" style="overflow: auto; z-index: 1041;">
<div class="modal-dialog row content" style="max-width: 100% ! important;margin-bottom: 0;">
  <div class="col-sm-5 slideInLeft animated ord">
    <img src="{{asset('ra-idlis/public/img/loimg.png')}}" id="aniImg">
  </div>
  <div class="col-sm-5 bounceInDown animated ord2">     
   <div class="modal-content visitor">        
        <div class="modal-body" ">
          <div id="guide" class="text-center">
            Need a guide for first-time visitors?
            <div>
              <button class="btn-primarys" data-dismiss="modal" aria-hidden="true" onclick="introJs().start();">Yes</button>
              <button class="btn-defaults" data-dismiss="modal" aria-hidden="true">No</button>
            </div>
          </div>
{{-- <div id="wowslider-container1" style="display: none;">
<div class="ws_images"><ul>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_1.png')}}" alt="Step 1. Apply " title="Step 1. Apply" id="wows1_0"/><p id="wows1_0"/>If you are using this for the first time, click on the Apply and fill out the form. </p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_2.png')}}" alt="Step 1. Apply " title=" " id="wows1_1"/><p id="wows1_1"/>After clicking apply this form will appear, you must fill up this form yourself.</p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_3.png')}}" alt="Step 1. Apply " title="" id="wows1_2"/><p id="wows1_1" />After filling up those form, Upload your attachments or the required requirements by clicking the UPLOAD button.</p></li>
    <li><p id="wows1_1"/ >After Uploading attachments. <br> Click on SUBMIT button <br> to submit information.</p><img src="{{asset('ra-idlis/public/img/steps/client/Steps_4.png')}}" alt="Step 1. Apply " title="" id="wows1_3"/></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_5.png')}}" alt="Step 1. Apply " title="" id="wows1_4"/><p id="wows1_1"/>By submitting. Message will appear.</p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_6.png')}}" alt="Steps 2. Evaluate" title="Steps 2. Evaluate" id="wows1_5"/><p id="wows1_1">You may view your evaluation status.</p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_7.png')}}" alt="Step 2. Evaluate" title="" id="wows1_6"/><p id="wows1_1">You may check your evaluation status if it is recommended for inspection and view your payment</p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_8.png')}}" alt="Step 3. Inspection" title="Step 3. Inspection" id="wows1_7"/><p id="wow">View your inspection status</p></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_9.png')}}" alt="Step 3. Inspection" title="" id="wows1_8"/></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_10.png')}}" alt="Step 3. Inspection" title="" id="wows1_9"/></li>
    <li><a href="#"><img src="{{asset('ra-idlis/public/img/steps/client/Steps_11.png')}}" alt="css image gallery" title="Step 4. Issuance" id="wows1_10"/></a></li>
    <li><img src="{{asset('ra-idlis/public/img/steps/client/Steps_12.png')}}" alt="Step 4. Issuance" title="Step 4. Issuance" id="wows1_11"/></li>
  </ul></div>
  <div class="ws_bullets"><div>
    <a href="#" title="Step 1. Apply "><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_1.png')}}" alt="Step 1. Apply "/>1</span></a>
    <a href="#" title="Step 1. Apply "><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_2.png')}}" alt="Step 1. Apply "/>2</span></a>
    <a href="#" title="Step 1. Apply "><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_3.png')}}" alt="Step 1. Apply "/>3</span></a>
    <a href="#" title="Step 1. Apply "><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_4.png')}}" alt="Step 1. Apply "/>4</span></a>
    <a href="#" title="Step 1. Apply "><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_5.png')}}" alt="Step 1. Apply "/>5</span></a>
    <a href="#" title="Steps 2. Evaluate"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_6.png')}}" alt="Steps 2. Evaluate"/>6</span></a>
    <a href="#" title="Step 2. Evaluate"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_7.png')}}" alt="Step 2. Evaluate"/>7</span></a>
    <a href="#" title="Step 3. Inspection"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_8.png')}}" alt="Step 3. Inspection"/>8</span></a>
    <a href="#" title="Step 3. Inspection"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_9.png')}}" alt="Step 3. Inspection"/>9</span></a>
    <a href="#" title="Step 3. Inspection"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_10.png')}}" alt="Step 3. Inspection"/>10</span></a>
    <a href="#" title="Step 4. Issuance"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_11.png')}}" alt="Step 4. Issuance"/>11</span></a>
    <a href="#" title="Step 4. Issuance"><span><img src="{{asset('ra-idlis/public/img/steps/client/Steps_12.png')}}" alt="Step 4. Issuance"/>12</span></a>
  </div></div>
<div class="ws_shadow"></div>
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/wowslider.js')}}"></script>
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/script.js')}}"></script>
</div> --}}
        </div>
        
      </div>
    </div>
    </div>
  </div>
<script type="text/javascript">
        function yes(){
          $('#wowslider-container1').show();
          $('.ord2').addClass('col-sm-7');
          $('.visitor').addClass('zoomIn');
          $('.visitor').addClass('animated');
          $('#guide').hide();
        }
        if(localStorage.getItem("doholrs") != null && localStorage.getItem("doholrs") == "true"){
         $('#myModal').modal('toggle');
         localStorage.setItem("doholrs", "false");
        }
  $('#yes').on('click', function(){
    $('#myModal').modal('toggle');
    $('#myModal2').modal('show').delay(3000);
  });
  if(screen.width < 481) {
    document.getElementById("navbarResponsive").classList.add("show");
  }
</script>
{{-- @if(session()->has('save_success'))
<div id="asdf" class="alert alert-{{session()->has('alert-type')}} alert-dismissible fade show" role="alert">
            <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('save_success')}}</center>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
@endif --}}
<script type="text/javascript">
    function remLd() { 
      $('#exampleModalCenter').modal('show', {backdrop: 'static', keyboard: false});
      setTimeout(function(){ $('#asdf').fadeOut(500); }, 3000);
     };
    remLd();
  </script>
<div class="container-fluid" style="z-index: 0; position:relative;"> 
    <div class="row">
      <div class="col-sm-12">
        <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-12 col-lg-3">
            <div class="card my-4" style="border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
            <h5 class="card-header">Search</h5>
            <div class="card-body" style="height: 80px;">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="button"><i class="fa fa-search"> </i></button>
                </span>
              </div>
            </div>
          </div>
             <div class="card my-4 introjs-showElement introjs-relativePosition"  data-intro="Announcements<br><small>Here is where new Announcements can be found.</small>" data-step="10" style="border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
            <h5 class="card-header">Announcements</h5>
            <div class="cardb" style="padding: 1.25rem;flex: 1 1 auto;">
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" >
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="https://www.vigorbuddy.com/wp-content/uploads/2016/06/doh.jpeg" alt="First slide" style="height: 140px;">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.vigorbuddy.com/wp-content/uploads/2016/06/doh.jpeg" alt="Second slide" style="height: 140px;">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.vigorbuddy.com/wp-content/uploads/2016/06/doh.jpeg" alt="Third slide" style="height: 140px;">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class="card my-4 introjs-showElement introjs-relativePosition" data-intro="Definition of Terms<br><small>Click this link to read our Definition of Terms</small>" data-step="11" style="border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
            <p class="card-header"><small>Click for our <i class="fa fa-hand-o-right"></i>&nbsp;<a href="">Definition of Terms</a></small>
            </p>
          </div>
          <div class="text-center introjs-showElement introjs-relativePosition" data-intro="FAQs<br><small></small>" data-step="13">
              <img src="{{asset('ra-idlis/public/img/FAQ.png')}}">
          </div>
          </div>
          <div  class="col-sm-9 col-md-12 col-lg-9">
            <div class="row">
              <div class="col-sm-12">
              <div class="card my-4 introjs-showElement introjs-relativePosition" data-intro="<b>Status Banner</b><br><small>In this banner is where you can see the status of your submitted Application/s.</small>" data-step="3" style="border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
              <div class="card-header" id="headingOne">
                  <a class="card-link" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   Application/s Status
                  </a>
             </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="border-radius: 3px 3px 0 0;">
                <div style="flex: 1 1 auto;padding: 1.25rem;" class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                         <tr class="text-center" style="border-bottom: 1px solid #ddd; ">
                         
                          <td>List of Application</td>
                          <td>Application Type</td>
                          <td>Date Applied</td>
                          <td>Date Evaluated</td>
                          <td>Date Inspected</td>
                          <td>Status</td>

                        </tr>
                      </thead>
                      <tbody>
                        @if(count($getApp) > 0)
                          @foreach($getApp AS $getApps)
                            <tr class="text-center">
                              <td>{{$getApps->hfser_desc}}</td>
                              <td>{{$getApps->hfser_id}}</td>
                              <td>{{$getApps->t_date}}</td>
                              <td>{{$getApps->proposedInspectiondate}}</td>
                              <td>{{$getApps->proposedInspectiondate}}</td>
                              <td><span @if($getApps->canapply == 0) class="badge badge-warning" @elseif($getApps->canapply == 1) class="badge badge-danger" @else class="badge badge-success" @endif>@if($getApps->canapply == 0) Pending @elseif($getApps->canapply == 1) Rejected @else Approved @endif</span></td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            </div>
            </div>
            <div class="row" >
              <div class="col-sm-12">
                <div class="box wow fadeInLeft" id="textSample" data-intro="Step 1 <br><b>Apply</b><br><small>The very first step is to apply</small>" data-step="4">
                  <div class="row">
                    <div class="col-sm-6" >
                      <div class="icon"><i class="fa fa-clipboard"></i></div>
                      <h4 class="title text-uppercase"><strong><a @if($check_counter == 0) href="{{asset('client/preassessment')}}/view" @elseif($check_counter > 0) href="{{asset('client/preassessment')}}/{{$status}}" @else href="{{asset('client/preassessment')}}" @endif>Self Assessment</a></strong></h4>
                      <p class="description">Guide for self-assessment of the Health Facility in preparation for inspection monitoring visits</p>
                    </div>
                    <div class="col-sm-6">
                      <div class="card" @if($check_counter > -1 && count($check_assess1) == count($check_asspp)) style="border-color: #28a745;" @else style="border-color: #ff0000;" @endif>
                           @if(count($check_assess1) == count($check_asspp)) <div class="card-header">Completed!</div> @elseif($check_counter < 0)  @else <div class="card-header">Incomplete!</div> @endif 
                          <div class="card-body" style="height: auto !important;color: #006400;">@if(count($result)<1)Please take the Pre-assessment first. @else @isset($draft_ok) Result: Complied({{$draft_ok}}), <label style="color: red;">Not Complied({{$draft_not}})</label> @else No Result @endisset @endif</div>
                      </div>                           
                      @if(count($check_drafts) > 0) <label style="float: right;">Drafts saved: {{count($check_drafts)}}</label> @endif
                       
                    </div>     
                  </div>
                </div>
              </div>
            </div>
            
            @if(count($check_assess1) != count($check_asspp) && ($check_counter > 0 || $check_counter < 0))
             <div class="alert alert-danger" id="alert" role="alert" style="display: none;">
                <strong>Oh snap!</strong> You must go first to Pre-assessment.
            </div>
            @endif
            <script type="text/javascript">
              function  disbool(){
                document.getElementById('alert').style.display = 'block';
                 setTimeout(function(){$('#alert').fadeOut(500) }, 2000);
                
              }
              @if(count($check_assess1) != count($check_asspp) && ($check_counter > 0 || $check_counter < 0)) document.getElementById('maykayey').setAttribute('onclick', 'disbool()'); @endif
            </script>
            <div id="maykayey" class="disbool" @if(count($check_assess1) != count($check_asspp) && ($check_counter > 0 || $check_counter < 0)) onclick="disbool()" @endif>
            <div class="row" id="syd" @if(count($check_assess1) != count($check_asspp) && ($check_counter > 0 || $check_counter < 0)) style="pointer-events: none;" @endif>
          <div class="col-lg-6 introjs-showElement introjs-relativePosition" >
            <div class="box wow fadeInLeft" id="textSample" data-intro="Step 1 <br><b>Apply</b><br><small>The very first step is to apply</small>" data-step="5">
              <div class="icon"><i class="fa fa-edit"></i></div>
              <h4 class="title text-uppercase"><a href="{{asset('client/apply')}}">Step 1. Apply</a></strong></h4>
              <p class="description">Fill-in application form and submit requirements online.</p>
            </div>
          </div>

          <div class="col-lg-6 introjs-showElement introjs-relativePosition">
            
            <div class="box wow fadeInRight" data-intro="Step 2 <br><b>Payment</b><br><small>You may pay through the internet with Paypal and DragOnPay or you can pay through MLhuillierPayment process for evaluation and inspection to be process.</small>" data-step="6">
              <div class="icon"><i class="fa fa-credit-card"></i></div>
              <h4 class="title text-uppercase"><strong><a href="{{asset('client/orderofpaymentc')}}">Step 2. Payment</a></strong></h4>
              <p class="description">You need to pay for the evaluation and inspection process.{{--  <br> You may pay through the internet with Paypal and DragOnPay or you can pay through MLhuillierPayment process for evaluation and inspection to be process --}}</p>
            </div>
          </div>
            <div class="col-lg-6 introjs-showElement introjs-relativePosition">
            
            <div class="box wow fadeInRight" data-intro="Step 2 <br><b>Evaluate</b><br><small>After submitting the application form, you'll have to wait for your application to be evaluated. Click the 'View your evaluation status' link to view your evaluation status</small>" data-step="7">
              <div class="icon"><i class="fa fa-check"></i></div>
              <h4 class="title text-uppercase"><strong><a href="{{asset('client/evaluate')}}">Step 3. Evaluate</a></strong></h4>
              <p class="description">DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
              <p><a href="{{asset('client/evaluate')}}">View your evaluation status</a></p>
            </div>
          </div>

          <div class="col-lg-6 introjs-showElement introjs-relativePosition">
            <div class="box wow fadeInLeft" data-intro="Step 4 <br><b>Inspection</b><br><small>After evaluating your application, DOH will then Inspect the application for approval to be issued</small>" data-step="8">
              <div class="icon"><i class="fa fa-search"></i></div>
              <h4 class="title text-uppercase"><strong><a href="{{asset('client/inspection')}}">Step 4. Inspection</a></strong></h4>
              <p class="description">DOH will conduct inspection and notify the status of your application.</p>
            </div>
          </div>
          <div class="col-lg-6 introjs-showElement introjs-relativePosition">
            <div class="box wow fadeInRight"  data-intro="Step 5 <br><b>Issuance</b><br><small>After evaluating and inspection, the application is good for Issuance</small>" data-step="9">
              <div class="icon"><i class="fa fa-print"></i></div>
              <h4 class="title text-uppercase"><strong><a href="{{asset('client/issuance')}}">Step 5. Issuance</a></strong></h4>
              <p class="description">You can now print your application online.</p>
              {{-- <p>Issuance Status:<font style="color:orange;">PENDING</font> </p> --}}
            </div>
          </div>
         <div class="col-lg-6">
            <div class="box wow fadeInRight"  data-intro="" data-step="">
              <div class="icon"><i class="fa fa-recycle"></i></div>
              <h4 class="title text-uppercase"><strong><a href="{{asset('client/modifiers')}}">Application for Change</a></strong></h4>
              <p class="description"></p>
            </div>
         </div>
           </div>
          </div>
          </div>
        </div>

      </div>
    </section>
   </div>
  </div>
  <div class="row">
             <div class="col-sm-3">
       
      </div>
      <div class="col-sm-9"></div>
  </div>
{{--  <center><hr style="width:75%;"></center>
    <table class="text-center tableimg">
        <td class="td"><img src="{{asset('ra-idlis/public/img/nosmoking.png')}}" width="50" height="60"></td>

        <td class="td"><img src="{{asset('ra-idlis/public/img/nogift.PNG')}}"  width="50" height="60"></td> 

        <td class="td"><img src="{{asset('ra-idlis/public/img/fix.PNG')}}"  width="50" height="60"></td>

        <td class="td"><img src="{{asset('ra-idlis/public/img/nobreak.jpg')}}"  width="125" height="60"></td> 
    </table> --}}
  </div>
  <hr>
  @include('client.sitemap')
@endsection