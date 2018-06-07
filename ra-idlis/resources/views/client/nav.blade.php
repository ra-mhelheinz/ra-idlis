@include('session.clientSession')
@if (session()->exists('client_data'))
   @php
     $clientData = session('client_data');
   @endphp
@else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif
   {{--  <nav class="navbar navbar-expand-lg" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 10px 10px 10px 10px;box-shadow: 0px 2px 4px rgba(0,0,0,0.2);" >
      <div class="container">
        <div class="navbar-nav" href="#">
          <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img4">
          &nbsp;&nbsp;
                  <div class="republic1">
                    <p><small>Republic of the Philippines</small></p>    
                    <p  style="margin-top: -10px;font-size: 18px;font-weight: 600">DEPARTMENT OF HEALTH</p>
                    <p  style="margin-top: -10px;">Kagawaran ng Kalusugan</p>
                    <p  style="margin-top: -10px;">ISO 9001:2008 CERTIFIED</p>
                  </div>
        </div>
        <button style="color: #fff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars" style="color:   #fff;"></i> Menu
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
          <ul class="navbar-nav mr-auto">
          </ul>
        <ul class="navbar-nav">

            <div href="" class="navbar btn btn-outline-success" style="font-size: 25px;border-color: #fff;color: #fff;">OLORS</div>
            <a href="{{asset('client/home')}}" class="navbar" style="color:   #fff;text-decoration:  none;" ><i class="fa fa-home"></i>&nbsp;Home</a>
            
          <a style="color:  #fff;" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>&nbsp;<i class="badge badge-primary">1</i>
             <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
         <div class="navbar-login">
           <p>Welcome to DOH OLORS.</p>
          </div>
        </div>
          </a>
      <li class="nav-item dropdown">
        <a style="color:  #fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-user-circle" style="font-size:  30px;"></i>
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
    </nav> --}}
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 10px 10px 10px 10px;box-shadow: 0px 2px 4px rgba(0,0,0,0.2);padding: 1px 1px 1px 1px;">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img4">
            <div class="republic1">
                    <p  style="font-size: 11px;"><small>Republic of the Philippines</small></p>    
                    <p  style="margin-top: -10px;font-size: 18px;font-weight: 600">DEPARTMENT OF HEALTH</p>
                    <p  style="margin-top: -10px;font-size: 13px;">Kagawaran ng Kalusugan</p>
                    <p  style="margin-top: -10px;font-size: 13px;">ISO 9001:2008 CERTIFIED</p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>Menu
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{asset('client/home')}}"><span class="fa fa-home"></span>Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown"><span class="fa fa-bell" style="font-size:  20px;"></span><i class="badge badge-primary">1</i>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
                  <div class="navbar-login">
                    <p>Welcome to DOH OLORS.</p>
                  </div>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown">
             <a style="color:  #fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<nav class="navbar navbar-expand-sm sticky-top" id="timeline" style="justify-content: center;background-color:  #fff;z-index: 2;">
  <ul class="navbar-nav">
      <a class="navbar active" href="#" style="font-weight: 600;color: #228B22">Apply</a>
      <a class="navbar" href="#"><i class="fa fa-hand-o-right" style="color: #228B22"></i></a>
      <a class="navbar" href="#" style="font-weight: 600;color: #228B22">Evaluation</a>
      <a class="navbar" href="#"><i class="fa fa-hand-o-right" style="color: #228B22"></i></a>
      <a class="navbar" href="#" style="font-weight: 600;color: #228B22">Inspection</a>
      <a class="navbar" href="#"><i class="fa fa-hand-o-right" style="color: #228B22"></i></a>
      <a class="navbar" href="#" style="font-weight: 600;color: #228B22">Issuance</a>
  </ul>
</nav>
<style type="text/css">
.navbar{
    font-size: 0.765625rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}
.img4{
    height: 75px;width: auto;float: left;
}
.republic1{
  margin-left: 80px;
}
.republic1 > p{
  margin: 0;
  color: #000;
}
    .navbar-login
{
    padding: 10px;
    padding-bottom: 0px;
    text-transform: none;
    text-align: center;
}

.navbar-login-session
{
    padding: 10px;
    padding-bottom: 0px;
    padding-top: 0px;
}

.icon-size
{
    font-size: 87px;
}
.navbar-nav>a {
  position: relative;
  color: #000;
  text-decoration: none;
}

.navbar-nav>a:hover {
  color: #000;
}
.navbar-nav>a:before {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #84bd82;
  visibility: hidden;
  -webkit-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transition: all 0.3s ease-in-out 0s;
  transition: all 0.3s ease-in-out 0s;
}
.navbar-nav>a:hover:before {
  visibility: visible;
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}
#acc{
  width: 300px;
}
@media only screen and (max-width: 990px){
  #acc{
    width: 100%;
  }
}
@media only screen and (max-width: 575px){
  #timeline{
    display: none;
  }
}
</style>