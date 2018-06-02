@include('session.clientSession')
<?php
      $clientData = session('client_data');
    ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" style="box-shadow: 0px 2px 4px rgba(0,0,0,0.2);" >
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
.navbar{
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
}
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