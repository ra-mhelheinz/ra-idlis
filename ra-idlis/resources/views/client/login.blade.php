@if (session()->exists('client_data'))
	<script type="text/javascript">
		window.location.href = "{{asset('/client/home')}}";
	</script>
@endif
@extends('main')
@section('style')
 <link rel="stylesheet" type="text/css" href="ra-idlis/public/css/login.css">

@endsection
<style type="text/css">
		#canvasMap{
			height: 400px;
		}
@media only screen and (max-width: 992px){
	.col-lg-7{
		order: 13;
	}
	.col-lg-5{
		order: -1;
	}
}
	@media only screen and (max-width: 770px){
		.col-lg-7{
			display: none;
		}
	}

	.loading {    
	    background-color: #ffffff;
	    background-image: url("{{ asset('ra-idlis/public/img/load.gif') }}");
	    background-size: 15px 15px;
	    background-position:right center;
	    background-repeat: no-repeat;
	}
</style>
@section('content')
{{-- <div hidden>
<datalist id="rgn_list">
	@foreach($regions as $region)
		<option id="{{$region->rgnid}}_rid" value="{{$region->rgn_desc}}"></option>
	@endforeach
</datalist>
	 @foreach ($regions as $region)
    <datalist id="{{$region->rgnid}}_list">
      @foreach ($province as $provinces)
        @if ($region->rgnid == $provinces->rgnid)
          <option id="{{$provinces->provid}}_pro" value="{{$provinces->provid}}">{{$provinces->provname}}</option>
        @endif
      @endforeach
    </datalist>
  @endforeach
</div>
<div hidden>
	 @foreach ($province as $provinces)
    <datalist id="{{$provinces->provid}}_lists">
      @foreach ($citymuni as $citymunici)
        @if ($provinces->provid == $citymunici->provid)
          <option id="{{$citymunici->provid}}_cm" value="{{$citymunici->provid}}">{{$citymunici->cmname}}</option>
        @endif
      @endforeach
    </datalist>
  @endforeach
</div> --}}
<header>
	<div class="jumbotron" style="padding: 0 !important;border-radius:0;background-color: #fff !important;margin-bottom: 0;">
		<div class="container">
		<div class="row">
			<div class="col-lg-7" style="margin: 3em auto">
				<h3>DOH Licensing Process</h3>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<h4><i class="fa fa-registered"></i>&nbsp;<strong>Step 1.</strong> Registration</h4>
						<p>Sign-up for your health facility. Get your username and password.</p>
						<br>
						<h4><i class="fa fa-check"></i>&nbsp;<strong>Step 3.</strong> Evaluation</h4>
						<p>DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
						<br>
						<h4><i class="fa fa-print"></i>&nbsp;<strong>Step 5.</strong> Issuance</h4>
						<p>You can now print your application online.</p>
					</div>
					<div class="col-sm-6">
						<h4><i class="fa fa-address-book"></i>&nbsp;<strong>Step 2.</strong> Apply</h4>
						<p>Fill-in application form and submit requirements online.</p>
						<br>
						<h4><i class="fa fa-search"></i>&nbsp;<strong>Step 4.</strong> Inspection</h4>
						<p>DOH will conduct inspection and notify the status of your application.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
	<div class="form-wrapss">
		<div class="tabss">
			<h3 class="login-tab"><a class="active" href="#login-tab-content">Login</a></h3>
			<h3 class="signup-tab"><a  href="#signup-tab-content">Sign Up</a></h3>
		</div><!--.tabs-->
		<div class="tabss-content" >
			<div id="login-tab-content" class="active">
				<form class="login-form" action="{{asset('/')}}" method="post" data-parsley-validate>
					
					{{ csrf_field()}}
					@if (session()->has('client_login'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('client_login')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					@if (session()->has('logout_notif'))
					<div class="alert alert-info alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('logout_notif')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					<input type="text" style="margin: 0 0 .8em 0;" class="input form-control" name="log_uname" autocomplete="off" placeholder="Username" data-parsley-required-message="<strong>*</strong>Username <strong>Required</strong>" value="{{ old('log_uname')}}" required="">
					<input type="password" style="margin: 0 0 .8em 0;" class="input form-control" name="log_pass" autocomplete="off" placeholder="Password" data-parsley-required-message="<strong>*</strong>Password <strong>Required</strong>" required="">
					<input type="checkbox" class="checkbox" id="remember_me">
					<label for="remember_me">Remember me</label>
					
					<button type="submit" name="button" class="button" value="Login">Login</button>
				</form>
				<div class="help-text text-center" style="margin-top: 10px;">
					<small><a href="{{asset('employee')}}">DOH employee login</a></small>
				</div>
			</div><!--.login-tab-content-->
			<div id="signup-tab-content" >

			<!-- REGISTRATION FORM -->

		<form id="rform" class="signup-form" data-parsley-validate>
			<!-- action="{{asset('/register')}}" method="post"  -->
				<input type="hidden" name="_token" id="reg_csrf-token" value="{{ Session::token() }}" />
				<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none" id="Samelert">
					  <strong><i class="fas fa-exclamation"></i></strong> Username is already been taken
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
			<div class="col-sm-12" style="display :none">
				@if (session()->has('reg_notif_success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-check"></i></strong> {{ session()->get('reg_notif_success') }}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				@endif
				@if (session()->has('reg_notif_error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{ session()->get('reg_notif_error') }}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				@endif
				@if ($errors->any())
				    <div class="alert alert-danger alert-dismissible fade show" role="alert">
				    	<strong><i class="fas fa-exclamation"></i></strong>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

				
			</div>
					<div class="col-sm-12" id="passwordAlertMatch" style="display:none">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong><i class="fas fa-exclamation"></i></strong> Password Mismatch
						</div>
					</div>	
					<div class="row">
						<div class="col-sm-12" style="margin: 0 0 .8em 0;">
							<input type="text" class="input form-control" autocomplete="off" name="facility_name" placeholder="Name of Facility (Complete Name)" data-parsley-required-message="<strong>*</strong>Facility name <strong>Required</strong>"  value="{{ old('facility_name') }}" required="">

						</div>

					<hr>
					
					<div class="col-sm-12" style="margin: 0 0 .8em 0;">
						<h5>Address</h5>
					</div>
					<div class="col-sm-12" style="margin: 0 0 .8em 0;">
						<div class="input-group">
						<input type="text" id="gsearch" class="form-control" placeholder="Address">

						<div class="input-group-prepend" style="cursor: pointer;"  data-toggle="modal" data-target="#exampleModal">
							<div id="appLd" class="input-group-text" style="max-height: 38px;"><i class="fa fa-map-marker"></i></div>
						</div>
						<div class="modal slideInRight animated" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="		exampleModalCenterTitle" aria-hidden="true" style="overflow: hidden;">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content text-center" >
						      <div class="modal-header" style="border: 0;background-color: #5cb85c">
						        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff;">Map</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body" style="padding: 0;">
						        <div id="canvasMap"></div>
						      </div>
					    </div>
					  </div>
					</div>
						</div>
					</div>		
					<div class="col-sm-6" style="margin: 0 0 .8em 0;">
					<input id="rgnID" type="text" class="form-control" placeholder="Region">
					{{-- <select id="selectRegion4CM" name="region" class="form-control"  data-parsley-required-message="<strong>*</strong>Region <strong>Required</strong>" required="">
						<option disabled selected hidden>Select Region</option>
						@foreach ($regions as $region)
							<option value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>
						@endforeach
					</select> --}}
					</div>
					<div class="col-sm-6" style="margin: 0 0 .8em 0;">
					{{-- <select id="selectProvince4Cm" data-parsley-required-message="<strong>*</strong>Province <strong>Required</strong>" class="form-control" name="province"  required="">
						<option disabled selected hidden>Province</option>
					</select> --}}
					<input id="provID" type="text" class="form-control" placeholder="Province">
					</div>
				<div class="col-sm-6" style="margin: 0 0 .8em 0;">
					{{-- <select id="selectCM4Cm" name="region" class="form-control"  data-parsley-required-message="<strong>*</strong>City/Municipality <strong>Required</strong>" required="">
						<option disabled selected hidden>City/Municipality</option>
					</select> --}}
					<input id="ctyID" type="text" class="form-control" placeholder="City/Municipality">
				</div>
				<div class="col-sm-6" style="margin: 0 0 .8em 0;">
					{{-- <select id="selectbrgy4CM" name="region" class="form-control"  data-parsley-required-message="<strong>*</strong>Brgy. <strong>Required</strong>" required="">
						<option disabled selected hidden>Brgy. Name</option>
					</select> --}}
					<input id="brgyID" type="text" class="form-control" placeholder="Brgy. Name">
				</div>
				<div class="col-sm-8" style="margin: 0 0 .8em 0;">
					<input type="text" class="input form-control" name="street" autocomplete="off" placeholder="Street Name"   data-parsley-required-message="<strong>*</strong>Street Name <strong>Required</strong>" required="">
				</div>
				<div class="col-sm-4" style="margin: 0 0 .8em 0;">
					<input type="text" class="input form-control" name="zipcode" autocomplete="off" placeholder="Zip Code"  required=""  data-parsley-type="digits" data-parsley-maxlength="4" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>">
				</div>
  				<script type="text/javascript">
  					var map, place, arr, marker;
  					var arr2 = [];
      				function initMap() {
        				map = new google.maps.Map(document.getElementById('canvasMap'), {
				          center: {lat: 12.8797, lng: 121.7740},
				          zoom: 6
				        });

				        marker = new google.maps.Marker({map: map});

				        var geocoder = new google.maps.Geocoder();
				    
				        var input = document.getElementById('gsearch');
				    	var autocomplete = new google.maps.places.Autocomplete(input);
        				autocomplete.bindTo('bounds', map);


			          	place = autocomplete.getPlace();
  						google.maps.event.addDomListener(document.getElementById('gsearch'), 'blur', route);

					    function route() {
					    	chgLd('gsearch', true);
					    	autocomplete.addListener('place_changed', function() {
						        place = autocomplete.getPlace();
						        // if (!place.geometry) {
						        //   return;
						        // }

						        if (place.geometry) {
						       	//		.viewport
						        //   	map.fitBounds(place.geometry.viewport);
						        //   	chgLd();
						        // } else {
						          	map.setCenter(place.geometry.location);
						          	map.setZoom(17);
						            chgLd('gsearch', false);
						        }
						        marker.setPlace({
						          placeId: place.place_id,
						          location: place.geometry.location
						        });
						        marker.setVisible(true);

							    geocoder.geocode({'placeId': place.place_id}, function(results, status) {
						            if (status === 'OK') 
						            {
						            	arr = [];
						            	arr2 = [];
						            	chgLd('gsearch', false);
						            	arr = results[0]["address_components"];
						            	if((results[0]["address_components"]).length > 5) {
						            		if(isNaN(parseInt(arr[arr.length - 1]["short_name"])) == false) {
						            			arr.pop();
						            			if(arr[arr.length - 1]["short_name"] == "PH") {
						            				arr.pop();
						            				for(var x = 0; x < arr.length; x++) {
						            					arr2.push((arr[x]['short_name']).toUpperCase());
							            			}
							            			console.log(arr2);
							            			callBack(arr2);
						            			} else {
						            				for(var x = 0; x < arr.length; x++) {
						            					arr2.push((arr[x]['short_name']).toUpperCase());
							            			}
							            			console.log(arr2);
							            			callBack(arr2);
						            			}
						            			
						            		}
						            	} else {
						            		if(arr[arr.length - 1]["short_name"] == "PH") {
						            			arr.pop();
						            			for(var x = 0; x < arr.length; x++) {
						            				arr2.push((arr[x]['short_name']).toUpperCase());
							            		}
							            		console.log(arr2);
							            		callBack(arr2);
						            		} else {
						            			for(var x = 0; x < arr.length; x++) {
						            				arr2.push((arr[x]['short_name']).toUpperCase());
							            		}
							            		console.log(arr2);
							            		callBack(arr2);
						            		}
						            	}
						            } 
						            else {

						            }
						        });
					        });
					    }
					    function chgLd(element, cond) {
					    	if(cond == false) {
					    		document.getElementById(element).classList.remove('loading');
					    	} else {
					    		document.getElementById(element).classList.add('loading');
					    	}
					    }
					    function callBack(data) {
					    	chgLd('gsearch', true);
					    	chgLd('brgyID', true);
					    	chgLd('ctyID', true);
					    	chgLd('provID', true);
					    	chgLd('rgnID', true);
					    	document.getElementById('brgyID').value = "";
							document.getElementById('ctyID').value = "";
							document.getElementById('provID').value = "";
							document.getElementById('rgnID').value = "";
					    	var xhttp = new XMLHttpRequest();
					    	// if(data != null) {
					    		xhttp.onprogress = function() {

					    		};
					    		xhttp.onreadystatechange = function() {
								    if (this.readyState == 4 && this.status == 200) {
								       chgLd('gsearch', false);

								       var extract = JSON.parse(this.responseText);
								       document.getElementById('brgyID').value = extract[0][0]["brgyname"];
								       document.getElementById('ctyID').value = extract[1][0]["cmname"];
								       document.getElementById('provID').value = extract[2][0]["provname"];
								       document.getElementById('rgnID').value = extract[3][0]["rgn_desc"];
								       if(document.getElementById('brgyID').value != "" && document.getElementById('ctyID').value != "" || document.getElementById('provID').value != "" || document.getElementById('rgnID').value != "") {
								    	chgLd('brgyID', false);
								    	chgLd('ctyID', false);
								    	chgLd('provID', false);
								    	chgLd('rgnID', false);
								       }

								    }
								};
								xhttp.open("POST", "{{ asset('/getRPMB') }}", true);
								xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								xhttp.send('data='+data+'&_token={{ Session::token() }}');
					    	// }
					    }
				    }
				    
  				</script>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="text" class="input form-control" name="auth_name" autocomplete="off" placeholder="Authorized Signature" data-parsley-required-message="<strong>*</strong>Authorized Signature <strong>Required</strong>"  required="">
				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="text" class="input form-control" name="reg_uname" autocomplete="off" placeholder="Username" data-parsley-required-message="<strong>*</strong>Username <strong>Required</strong>" required="">

				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="password" data-parsley-trigger="change" class="input form-control" id="pass1" data-parsley-equalto="#pass1" name="pass2" autocomplete="off" data-parsley-required-message="<strong>*</strong>Required <strong>Password</strong>" placeholder="Password"  required="">
				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input  type="password" data-parsley-trigger="change" class="input form-control" id="pass2" name="pass2" autocomplete="off"   placeholder="Retype Password" data-parsley-equalto="#pass1" data-parsley-required-message="<strong>*</strong>Retype Password <strong>Required</strong>" required="">
				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="email" data-parsley-required-message="<strong>*</strong>Email Address <strong>Required</strong>" class="input form-control" name="email" autocomplete="off" placeholder="Email Address"  required="">
				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="text" data-parsley-required-message="<strong>*</strong>Contact Person <strong>Required</strong>" class="input form-control" name="contact_p" autocomplete="off" placeholder="Contact Person"  required="">
				</div>
				<div class="col-sm-12" style="margin: 0 0 .8em 0;">
					<input type="text" data-parsley-required-message="<strong>*</strong>Contact Person No.<strong>Required</strong>" class="input form-control" name="contact_pno" autocomplete="off" placeholder="Contact Person No."  required="">
				</div>
					</div>
				<div class="help-text">
					<p>By signing up, you agree to our</p>
					<p><a href="#" data-toggle="modal" data-target="#exampleModalLong">Terms of service</a></p>
				</div><!--.help-text-->	
					<button  type="submit" class="button" value="Sign Up">Sign Up</button>
					</form>
			</div><!--.signup-tab-content-->
		</div><!--.tabs-content-->
	</div><!--.form-wrap-->
			</div>
		</div>
	</div>
</div>
</header>
<script type="text/javascript">
		 $(document).ready(function() {
	        $("#rform").on('submit', function(e){
	            e.preventDefault();
	            var form = $(this);
	            form.parsley().validate();
	            if (form.parsley().isValid()){
	                var token = $("#reg_csrf-token").val();
	                var facility_name = $('input[name="facility_name"]').val();
	                var region = $('select[name="region"').val();
	                var province = $('select[name="province"]').val();
	                var brgy = $('input[name="brgy"]').val();
	                var strt = $('input[name="street"]').val();
	                var ctmuni = $('input[name="city_muni"]').val();
	                var zipcode = $('input[name="zipcode"]').val();
	                var auth_name = $('input[name="auth_name"]').val();
	                var uname = $('input[name="reg_uname"]').val();
	                var pass2 = $('input[name="pass2"]').val();
	                var email = $('input[name="email"]').val();
	                var contact_p = $('input[name="contact_p"]').val();
	                var contact_pno = $('input[name="contact_pno"]').val();
	               $.ajax({
			          url: " {{asset('/register')}}",
			          method: 'POST',
			          data: {
			          	_token : token,
			          	facility_name : facility_name,
			          	region : region,
			          	province : province,
			          	brgy : brgy,
			          	street : strt,
			          	city_muni : ctmuni,
			          	zipcode : zipcode,
			          	auth_name : auth_name,
			          	uname : uname,
			          	pass2 : pass2,
			          	email : email,
			          	contact_p : contact_p,
			          	contact_pno : contact_pno,
			          },
			          success: function(data) {
			          	if (data == 'same') {
			          		$('input[name="reg_uname"]').removeClass('parsley-success');
			          		$('input[name="reg_uname"]').addClass('parsley-error');
			          		// var test = $('input[name="reg_uname"]').attr("data-parsley-id");
			          		$('#Samelert').show();
			          		$('#Samelert').focus();
			          		// $('input[name="reg_uname"]').focus();
			          		// alert(test);	
			          	} else if (data == 'sameFacility'){
			          		$('input[name="facility_name"').removeClass('parsley-success');
			          		$('input[name="facility_name"]').addClass('parsley-error');
			          	} else {
			          		window.location.href = "{{asset('/')}}";
			          	}
			          }
			      });
	            }
	        });
	    });
	  function register(){
	  	alert();
	  	return false;
	  }
	  $("#selectRegion4CM").change(function(){
      	var region_id = $(this).val();
      	var token = $("#reg_csrf-token").val();
      	// alert(token);
      $.ajax({
          url: " {{asset('/ph/get_province')}}",
          method: 'POST',
          data: {reg_id:region_id, _token:token},
          success: function(data) {
          	var x = data.provinces;
          	$('#selectProvince4Cm').empty();
          	$('#selectProvince4Cm').append('<option disabled selected hidden>Province</option>');          	
          	var valX = $('#selectProvince4Cm').val();
          	if (valX == "0") {
          		$('#selectProvince4Cm').addClass('parsley-error');
          	} else {
          		$('#selectProvince4Cm').removeClass('parsley-success');
          	}
          	for (var i = 0; i < x.length; i++) {
          		$('#selectProvince4Cm').append(
          				'<option value="'+x[i].provid+'">'+x[i].provname +'</option>'
          			);
          	}
          }
      });
  });
	  $("#selectRegion4CM").change(function(){
      	var region_id = $(this).val();
      	var token = $("#reg_csrf-token").val();
      	// alert(token);
      $.ajax({
          url: " {{asset('/ph/get_province')}}",
          method: 'POST',
          data: {reg_id:region_id, _token:token},
          success: function(data) {
          	var x = data.provinces;
          	$('#selectProvince4Cm').empty();
          	$('#selectProvince4Cm').append('<option disabled selected hidden>Province</option>');          	
          	var valX = $('#selectProvince4Cm').val();
          	if (valX == "0") {
          		$('#selectProvince4Cm').addClass('parsley-error');
          	} else {
          		$('#selectProvince4Cm').removeClass('parsley-success');
          	}
          	for (var i = 0; i < x.length; i++) {
          		$('#selectProvince4Cm').append(
          				'<option value="'+x[i].provid+'">'+x[i].provname +'</option>'
          			);
          	}
          }
      });
  });
	function checkPass(){
		var pass1 = $("#pass1").val();
		var pass2 = $("#pass2").val();
		if (pass1 == "" || pass2 == "") {
			$('#passwordAlertMatch').show();
		}
		else if (pass1 == pass2) {
			$('#passwordAlertMatch').hide();
			console.log('OK');
		} else {
			$('#passwordAlertMatch').show();
		}
	}
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	tab = $('.tabss h3 a');

	tab.on('click', function(event) {
		event.preventDefault();
		tab.removeClass('active');
		$(this).addClass('active');

		tab_content = $(this).attr('href');
		$('div[id$="tab-content"]').removeClass('active');
		$(tab_content).addClass('active');
	});
});
</script>
@endsection