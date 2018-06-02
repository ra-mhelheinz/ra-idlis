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
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" style="box-shadow: 0px 2px 4px rgba(0,0,0,0.2);" >
      <div class="container">
        <div class="navbar-brand" href="#">OLORS</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{asset('client/home')}}"><span class="fa fa-home"></span>&nbsp;Home
              </a>
            </li>
               <li class="nav-item">
              <a class="nav-link" href="#"><span class="fa fa-question-circle"></span>&nbsp;Help</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="#"><span class="fa fa-info"></span>&nbsp;About</a>
            </li>
          </ul>
        <ul class="navbar-nav ">
          <button class="btn btn-outline-success"><span class="fa fa-bell"></span>&nbsp;<span class="badge badge-primary">1</span></button>
               <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="fa fa-user-circle"></span>&nbsp;Account
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown">
         <div class="navbar-login">
            <div class="row">
               <div class="col-lg-4">
                  <p class="text-center">
                    <span class="fa fa-user icon-size"></span>
                  </p>
                </div>
                <div class="col-lg-8">
                  <p class="text-left"><strong>{{$clientData->cm_auth}}</strong></p>
                  <p class="text-left small">{{$clientData->cm_email}}</p>
                  <p class="text-left">
                  <button href="#" class="btn-primarys btn-block btn-sm">View Profile</button>
                  </p>
                </div>
              </div>
          </div>
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
    </nav> -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 5px 5px 5px 5px;box-shadow: 0px 2px 4px rgba(0,0,0,0.2);" >
      <div class="container">
        <div class="navbar-nav" href="#">
          <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img4">
          &nbsp;
                  <div class="republic1">
                    <p><small>Republic of the Philippines</small></p>    
                    <p  style="margin-top: -10px;font-size: 18px">DEPARTMENT OF HEALTH</p>
                    <p  style="margin-top: -10px;">Kagawaran ng Kalusugan</p>
                    <p  style="margin-top: -10px;">ISO 9001:2008 CERTIFIED</p>
                  </div>
        </div>
        <button style="color: #fff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars" style="color: #fff;"></i> Menu
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
          <ul class="navbar-nav mr-auto">
          </ul>
        <ul class="navbar-nav">

            <div href="" class="navbar btn btn-outline-success" style="font-size: 25px;border-color: #fff;color: #fff;">OLORS</div>
            <a href="{{asset('client/home')}}" class="navbar" style="color: #fff;text-decoration:  none;" ><i class="fa fa-home"></i>&nbsp;Home</a>
          <a style="color: #fff;" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>&nbsp;<i class="badge badge-primary">1</i>
             <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
         <div class="navbar-login">
           <p>Application Form Denied!</p>
          </div>
        </div>
          </a>
               <li class="nav-item dropdown">
        <a style="color: #fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-user-circle" style="font-size:  30px;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown">
         <div class="navbar-login">
            <div class="row">
               <div class="col-lg-4">
                  <p class="text-center">
                    <i class="fa fa-user icon-size"></i>
                  </p>
                </div>
                <div class="col-lg-8">
                  <p class="text-left" style="font-size: 13px;"><strong>{{$clientData->cm_auth}}</strong></p>
                  <p class="text-left" style="font-size: 10px;">{{$clientData->cm_email}}</p>
                  <p class="text-left "></p>
                  <p class="text-left">
                  <button href="#" class="btn-primarys btn-block btn-sm">View Profile</button>
                  <button href="#" class="btn-primarys btn-block btn-sm">About</button>
                  <button href="#" class="btn-primarys btn-block btn-sm">Help</button>
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
<!-- <nav aria-label="breadcrumb ">

  <ol class="breadcrumb arr-right bg-dark">

    <li class="breadcrumb-item "><a href="#" class="text-light">Apply</a></li>

    <li class="breadcrumb-item "><a href="#" class="text-light">Evaluate</a></li>

    <li class="breadcrumb-item text-light active" aria-current="page">Inpsection</li>
 <li class="breadcrumb-item text-light active" aria-current="page">Issuance</li>


  </ol>

</nav>
<style type="text/css">
  .arr-right .breadcrumb-item+.breadcrumb-item::before {
 
  content: "›";
 
  vertical-align:top;
 
  color: #408080;
 
  font-size:35px;
 
  line-height:18px;
 
}
</style> -->
<style type="text/css">
.navbar{
    font-size: 0.765625rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding:  5px;
}
.img4{
    height: 75px;width: auto;float: left;
}
.republic1 > p{
  margin: 0;
}
    .navbar-login
{
    width: 300px;
    padding: 10px;
    padding-bottom: 0px;
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
/*.navbar{
    font-size: 0.765625rem;
    text-transform: uppercase;
    padding: 1.5rem 1rem;
    letter-spacing: 2px;
}
.navbar-brand{
  margin-right: 2rem;
}
.nav-item{
  margin-right: 2rem;
}*/
a {
  position: relative;
  color: #000;
  text-decoration: none;
}

a:hover {
  color: #000;
}
a:before {
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
a:hover:before {
  visibility: visible;
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}
</style>