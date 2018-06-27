@include('session.clientSession')
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/nav.css')}}">
@if (session()->exists('client_data'))
   @php
     $clientData = session('client_data');
   @endphp

      <input type="hidden" id="global-token" value="{{ Session::token() }}" />
       <nav id="paraTagoNav" class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 10px 10px 10px 10px;box-shadow: 0px 2px 4px rgba(0,0,0,0.2);padding: 1px 1px 1px 1px;">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img4">
            <div class="republic1">
                    <p class="text-contentr"><small>Republic of the Philippines</small></p>    
                    <p class="text-contentd">DEPARTMENT OF HEALTH</p>
                    <p class="text-content">Kagawaran ng Kalusugan</p>
                    <p class="text-content">ISO 9001:2008 CERTIFIED</p>
            </div>
        </a>
        <div style="text-align:center;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span> 
        </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarResponsive" style="z-index: 1039; position: relative;">
          <ul class="navbar-nav ml-auto" style="text-align: center;">
            <li class="nav-item">
              <a class="nav-link" href="{{asset('client/home')}}" data-toggle="tooltip" title="HOME"><i class="fa fa-home" style="font-size:  20px;" ></i>
              </a>
            </li>
             <li class="nav-item dropdown"> 
              <a class="nav-link introjs-showElement introjs-relativePosition" href="#" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" data-intro="Application Types <br><small>Click this to toggle/choose your Application Type</small>" data-step="1"><span class="fa fa-edit" style="font-size:  20px;"></span></a>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
                     <a class="dropdown-item" href="{{ asset('/client/apply/form/con') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Certificate of Need (CON)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/ptc') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Permit to Construct (PTC)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/lto') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>License to Operate (LTO)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/coa') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Certificate of Accreditation (COA)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/ato') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Authority to Operate (ATO)</small></a>
                </div>
            </li>
            <li class="nav-item dropdown"> 
              <a class="nav-link introjs-showElement introjs-relativePosition" href="#" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" data-intro="Notifications <br><small>Click here to view your notifications such as updates or changes.</small>" data-step="2"><span class="fa fa-bell" style="font-size:  18px;"></span>1</a>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
                  <div class="navbar-login">
                    <p>Welcome to DOH OLORS.</p>
                  </div>
                </div>
            </li>
            <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle introjs-showElement introjs-relativePosition"  data-intro="Account Button <br><small>In this button you can find some options that might help you while browsing (About, Help, Logout)</small>" data-step="3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-user-circle" style="font-size:  20px;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-light" id="acc" aria-labelledby="navbarDropdown">
         <div class="navbar-login">
            <div class="row">
               <div class="col-lg-4">
                  <p class="text-center">
                    <i class="fa fa-user icon-size"></i>
                  </p>
                </div>
                <div class="col-lg-8">
                  <p class="text-left" style="font-size: 13px;"><strong>{{$clientData->authorizedsignature}}</strong></p>
                  <p class="text-left" style="font-size: 10px;">{{$clientData->email}}</p>
                  <p class="text-left "></p>
                  <p class="text-left">
                  <button href="#" class="btn-primarys btn-block btn-sm" style="background-color: #28a745;">About</button>
                  <button href="#" class="btn-primarys btn-block btn-sm" style="background-color: #28a745;">Help</button>
                  </p>
                </div>
              </div>
          </div>
          <hr>
          <div class="navbar-login navbar-login-session">
              <div class="row">
                <div class="col-lg-12">
                   <p>
                      <button href="#" onclick="event.preventDefault();document.getElementById('clientLogout').submit();" class="btn-defaults btn-block btn-sm">Logout</button>
                      <form id="clientLogout" action="{{asset('/client/logout')}}" method="POST" hidden>
                        @csrf
                      </form>
                   </p>
                </div>
              </div>
          </div>
        </div>
            </li>
          </ul>
        </div>
      </div>
</nav>
  @else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif