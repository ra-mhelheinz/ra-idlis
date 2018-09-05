@include('session.clientSession')
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/nav.css')}}">
@if (session()->exists('client_data') || session('client_data') != null)
{{-- session()->exists('client_data') ||  --}}
   @php
     $clientData = session('client_data');
   @endphp

<script type="text/javascript">
        if(localStorage.getItem("doholrs") == null && localStorage.getItem("client_data") == null) {
          localStorage.setItem("doholrs", "true");
          localStorage.setItem("client_data", "{{$clientData->uid}}");
        } else {
          if(localStorage.getItem("client_data") == "{{$clientData->uid}}") {

          } else {
            localStorage.setItem("doholrs", "true");
            localStorage.setItem("client_data", "{{$clientData->uid}}");
          }
        }
</script>
<style type="text/css">
	.dropdown-item.dropdown-notification:active, .dropdown-item.dropdown-notification.active {color: #1d1e1f; text-decoration: none; background-color: #f7f7f9; } .dropdown-notification:hover .notification-read {color: #34495E; } .dropdown-notification-all {text-align: center; padding-top: 5px; padding-bottom: 5px; font-style: oblique; background-color: #34495E; color: white; } .dropdown-notification-all:hover {background-color: #34495E; color: white; } .notifications-container {max-height: 300px; overflow: auto; } .notification-dropdown-menu {padding-bottom: 0; min-width: 528px; } .notification-img {width: 48px; display: inline-block; vertical-align: top; } .notifications-body {display: inline-block; } .notification-texte {text-align: left; margin: 0; } .notification-read {margin: 0; height: 48px; vertical-align: top; line-height: 48px; padding-left: 15px; color: white; float: right; } .notification-date {text-align: left; color: #2980b9; margin: 0; } .notification-solo {margin-top: 1rem; } .notification-unread {text-decoration: none; background-color: #f7f7f9; }
</style>
      <input type="hidden" id="global-token" value="{{ Session::token() }}" />
       <nav id="paraTagoNav" class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 10px 10px 10px 10px;padding: 1px 1px 1px 1px;">
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
              <a class="nav-link text-uppercase" href="{{asset('client/home')}}" data-toggle="tooltip" title="HOME">Home</a>
            </li>
{{--              <li class="nav-item dropdown"> 
              <a class="nav-link introjs-showElement introjs-relativePosition" href="#" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" data-intro="Application Types <br><small>Click this to toggle/choose your Application Type</small>" data-step="1">Application</a>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2">
                     <a class="dropdown-item" href="{{ asset('/client/apply/form/con') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Certificate of Need (CON)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/ptc') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Permit to Construct (PTC)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/lto') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>License to Operate (LTO)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/coa') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Certificate of Accreditation (COA)</small></a>
                      <a class="dropdown-item" href="{{ asset('/client/apply/form/ato') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Authority to Operate (ATO)</small></a>
                </div>
            </li> --}}
            {{-- <li class="nav-item dropdown"> 
              <a class="nav-link introjs-showElement introjs-relativePosition" href="#" class="navbar dropdown dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" data-intro="Notifications <br><small>Click here to view your notifications such as updates or changes.</small>" data-step="1"><span class="fa fa-bell" style="font-size:  18px;"></span><i id="forCountNotif" class="text-danger font-weight-bold"></i></a>
                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown2" style="width: 500px;max-height: 300px;">
                	<h6 class="dropdown-header">Notifications</h6>
                		<div class="container" id="forNotif"></div>
                </div>
            </li> --}}
		    <div class="dropdown nav-button notifications-button hidden-sm-down">

		      <a class="btn btn-secondary dropdown-toggle" href="#" id="notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		        <i id="notificationsIcon" class="fa fa-bell" aria-hidden="true"></i>
		        <span id="forCountNotif" id="notificationsBadge" class="badge badge-danger" style="display: inline-block;"></span>
		      </a>

		      <!-- NOTIFICATIONS -->
		      <div class="dropdown-menu notification-dropdown-menu dropdown-menu-right" aria-labelledby="notifications-dropdown">
		        <h6 class="dropdown-header">Notifications</h6>
		        <a id="notificationsLoader" class="dropdown-item dropdown-notification" style="display: none;"> <p class="notification-solo text-center"><i id="notificationsIcon" class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i> ... </p> </a> 
		        <div id="forNotif">
		        	
		        </div>
		        <!-- TOUTES -->
		        <a class="dropdown-item dropdown-notification-all" href="#">
		          
		        </a>

		      </div>
		    </div>
            <script type="text/javascript">
            	var reqRet = 0;
            	var intValG;
            	var lastExt = [];
            	clearInterval(intValG);
            	function getNotif(nid) {
            		var loc = ((nid == null || nid == "") ? "{{asset('client/notif')}}/{{$clientData->uid}}" : "{{asset('client/notif/chg')}}/{{$clientData->uid}}/"+nid+"");
            		var xhttp = new XMLHttpRequest();
		    		xhttp.onreadystatechange = function() {
		    		    if (this.readyState == 4 && this.status == 200) {
		    		    	var forCountNotif = 0;
		    		    	document.getElementById('forNotif').innerHTML = "";
		    		    	var extract = JSON.parse(this.responseText);
		    				if(JSON.stringify(lastExt) != JSON.stringify(extract)) { 
		    					lastExt = extract;  
            					document.getElementById('notificationsLoader').style.display = 'block';
            					document.getElementById('forNotif').style.display = 'none';

            					setTimeout(function() {
	            					document.getElementById('notificationsLoader').style.display = 'none';
	            					document.getElementById('forNotif').style.display = 'block';
            					}, 2000);
		    				}
		    				if(extract.length == lastExt.length && extract.length > 0) {
			    		    	for(var i = 0; i < extract.length; i++) {
			    		    		if(extract[i]["status"] == "0") {
			    		    			forCountNotif++;
			    		    			document.getElementById('forNotif').innerHTML += '<div id="notificationsContainer" class="notifications-container"> <a class="dropdown-item dropdown-notification" onclick="getNotif('+extract[i]["notfid"]+')" href="'+extract[i]["loc"]+'"> <div class="notification-read"> <i class="fa fa-times" aria-hidden="true"></i> </div> <img class="notification-img" src="https://placehold.it/48x48" alt="Icone Notification"> <div class="notifications-body"> <p class="notification-texte">'+extract[i]["message"]+'</p> <p class="notification-date text-muted"> <i class="fa fa-clock-o" aria-hidden="true"></i> '+extract[i]["notfdate"]+'</p> </div> </a> </div>'; 
			    		    		} else {
			    		    			document.getElementById('forNotif').innerHTML += '<div id="notificationsContainer" class="notifications-container"> <a class="dropdown-item dropdown-notification"> <div class="notification-read"> <i class="fa fa-check" aria-hidden="true"></i> </div> <img class="notification-img" src="https://placehold.it/48x48" alt="Icone Notification"> <div class="notifications-body"> <p class="notification-texte">'+extract[i]["message"]+'</p> <p class="notification-date text-muted"> <i class="fa fa-clock-o" aria-hidden="true"></i> '+extract[i]["notfdate"]+'</p> </div> </a> </div>';
			    		    		}
			    		    	}
			    		    }
		    		    	document.getElementById('forCountNotif').innerHTML = forCountNotif;
		    		    	reqRet = 1;
		    		    }
		    		};
					xhttp.open("GET", loc, true);
		    		// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    		xhttp.send();
            	}
            	getNotif();
            	intValG = setInterval(function(){
            		if(reqRet == 1) {
            			reqRet = 0;
            			setTimeout(getNotif, 1000);
            		}
            	}, -1);
            </script>
            <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle introjs-showElement introjs-relativePosition"  data-intro="Account Button <br><small>In this button you can find some options that might help you while browsing (Help, Logout)</small>" data-step="2" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-user-circle" style="font-size:  20px;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-light" id="acc" aria-labelledby="navbarDropdown">
            <div class="container">
              <div style="padding: 0.75rem 0.035rem">
              <div class="row">
                <div class="col-sm-3 text-center"><i class="fa fa-user" style="font-size: 50px;"></i></div>
                <div class="col-sm-9">
                  <small>{{$clientData->authorizedsignature}}</small>
                  <small  class="text-lowercase">{{$clientData->email}}</small>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6"><button class="btn btn-default btn-block" style="background-color: #ebebeb;
    border-color: #adadad; font-size: 12px">Help</button></div>
                 <div class="col-sm-6"><button  onclick="event.preventDefault();document.getElementById('clientLogout').submit();" class="btn btn-default btn-block" style="background-color: #ebebeb;
    border-color: #adadad; font-size: 12px">Logout</button>
                     <form id="clientLogout" action="{{asset('/client/logout')}}" method="POST" hidden>
                        @csrf
                      </form>
                </div>
                
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
  <?php session()->flush(); session()->flash('client_login','Invalid Username/Password'); ?>
  <script type="text/javascript">
    window.location.href = "{{asset('/client/logout')}}";
  </script>
@endif