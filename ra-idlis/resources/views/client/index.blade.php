@extends('main')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/service.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/engine1/style.css')}}" />
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/jquery.js')}}"></script>
@section('content')
@include('client.nav')
  <div class="modal" id="myModal" style="overflow: auto;">
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
              <button class="btn-primarys" data-toggle="modal" onclick="yes()">Yes</button>
              <button class="btn-defaults" data-dismiss="modal" aria-hidden="true">No</button>
            </div>
          </div>
<div id="wowslider-container1" style="display: none;">
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
</div>
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
         $('#myModal').modal('toggle');
  $('#yes').on('click', function(){
    $('#myModal').modal('toggle');
    $('#myModal2').modal('show').delay(3000);
  });
</script>
<div class="container-fluid"> 
    <div class="row">
      <div class="col-sm-12">
        <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-12 col-lg-3">
             <div class="card">
            <h5 class="card-header">Announcements</h5>
            <div class="cardb" style="max-height: 100%;padding: 1.25rem;flex: 1 1 auto;">
              <form>
                <div class="form-group">
                  <img src="http://d3mrff4h76anp4.cloudfront.net/wp-content/uploads/2018/01/04183401/DOH.jpg">
                  <p>sample text sample text</p>
                </div>
              </form>
            </div>
          </div>
          <div class="text-center">
              <img src="{{asset('ra-idlis/public/img/FAQ.png')}}">
          </div>
          </div>
          <div  class="col-sm-9 col-md-12 col-lg-9">
            <div class="row">
          <div class="col-lg-6">
            <div class="box wow fadeInLeft" id="textSample">
              <div class="icon"><i class="fa fa-edit"></i></div>
              <h4 class="title"><a href="{{asset('client/apply')}}">Step 1. Apply</a></h4>
              <p class="description">Fill-in application form and submit requirements online.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight">
              <div class="icon"><i class="fa fa-check"></i></div>
              <h4 class="title"><a href="{{asset('client/evaluate')}}">Step 2. Evaluate</a></h4>
              <p class="description">DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
              <p><a href="{{asset('evaluate')}}">View your evaluation status</a></p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-search"></i></div>
              <h4 class="title"><a href="{{asset('client/inspection')}}">Step 3. Inspection</a></h4>
              <p class="description">DOH will conduct inspection and notify the status of your application.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-print"></i></div>
              <h4 class="title"><a href="{{asset('client/issuance')}}">Step 4. Issuance</a></h4>
              <p class="description">You can now print your application online.</p>
              <p>Issuance Status:<font style="color:orange;">PENDING</font> </p>
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
 <center><hr style="width:75%;"></center>
    <table class="text-center tableimg">
        <td class="td"><img src="{{asset('ra-idlis/public/img/nosmoking.png')}}" width="50" height="60"></td>

        <td class="td"><img src="{{asset('ra-idlis/public/img/nogift.PNG')}}"  width="50" height="60"></td> 

        <td class="td"><img src="{{asset('ra-idlis/public/img/fix.PNG')}}"  width="50" height="60"></td>

        <td class="td"><img src="{{asset('ra-idlis/public/img/nobreak.jpg')}}"  width="125" height="60"></td> 
    </table>
  </div>
  
@endsection