@extends('main')
@section('style')
 <link rel="stylesheet" type="text/css" href="ra-idlis/public/css/login.css">
@endsection
@section('content')
<header>
	<div class="jumbotron" style="padding: 0 !important;border-radius:0;background-color: #fff !important;margin-bottom: 0;">
		<div class="container">
		<div class="row">
			<div class="col-md-7" style="margin: 3em auto">
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
			<div class="col-md-5">
 				<!-- <div class="form-wrapss" style="width: 420px !important;">
 				<div class="text-center" style="background-color: #e6e7e8;">
					<h3 style="padding: 20px;">Login</h3>
				</div>
 					<div class="tabss-content">
 

			<div id="login-tab-content" class="active">
				<form class="login-form needs-validation" action="{{asset('/')}}" method="post" novalidate>
					{{ csrf_field()}}
					@if (session()->has('client_login'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('client_login')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					<input type="text" class="input form-control" name="uname" autocomplete="on" placeholder="Username" value="{{ old('uname')}}">
					<div class="valid-feedback">
				        Looks good!
				     </div>
				     <div class="invalid-feedback">
			          Please choose a username.
			        </div>
					<input type="password" class="input form-control" name="pass" autocomplete="on" placeholder="Password">
					<input type="checkbox" class="checkbox 	" id="remember_me">
					<label for="remember_me">Remember me</label>

					<button type="submit" name="button" class="button" value="Login">Login</button>
				</form>.login-form
				<div class="help-text">
					<p>Not a member yet?<a href="{{asset('register')}}">&nbsp;Register now</a></p>
					<p><a href="{{asset('employeelogin')}}">DOH employee login</a></p>
				</div>.help-text
			</div>.login-tab-content
		</div>.tabs-content
	</div>.form-wrap -->
	<div class="form-wrapss">
		<div class="tabss">
			<h3 class="login-tab"><a class="active" href="#login-tab-content">Login</a></h3>
			<h3 class="signup-tab"><a  href="#signup-tab-content">Sign Up</a></h3>
		</div><!--.tabs-->

		<div class="tabss-content" >
			<div id="login-tab-content" class="active">
				<form class="login-form needs-validation" action="{{asset('/')}}" method="post" novalidate>
					{{ csrf_field()}}
					@if (session()->has('client_login'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('client_login')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					<input type="text" class="input form-control" name="uname" autocomplete="on" placeholder="Username" value="{{ old('uname')}}">
					<div class="valid-feedback">
				        Looks good!
				     </div>
				     <div class="invalid-feedback">
			          Please choose a username.
			        </div>
					<input type="password" class="input form-control" name="pass" autocomplete="on" placeholder="Password">
					<input type="checkbox" class="checkbox 	" id="remember_me">
					<label for="remember_me">Remember me</label>

					<button type="submit" name="button" class="button" value="Login">Login</button>
				</form>
				<div class="help-text text-center" style="margin-top: 10px;">
					<small><a href="{{asset('employeelogin')}}">DOH employee login</a></small>
				</div>
			</div><!--.login-tab-content-->
			<div id="signup-tab-content" >
				<form class="signup-form" action="{{asset('/register')}}" method="post">
			{{ csrf_field() }}
			<div class="col-sm-12" style="dispplay :none">
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
						<!--   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button> -->
						</div>
					</div>	
					<div class="row">
						<div class="col-sm-12">
							<input type="text" class="input form-control" autocomplete="off" name="facility_name" placeholder="Name of Facility (Complete Name)" required>
						</div>

					<hr>
					
					<div class="col-sm-12">
						<h5>Address</h5>
					</div>			
					<div class="col-sm-6" style="margin:0 0 .8em 0;">
					<select onchange="RegioN();" id="region" name="region" class="form-control">
						<option>Select Region</option>
						<option>NCR</option>
						<option>CAR</option>
						<option>Region I</option>
						<option>Region II</option>
						<option>Region III</option>
						<option>Region IV-A</option>
						<option>Region IV-B</option>
						<option>Region V</option>
						<option>Region VI</option>
						<option>Region VII</option>
						<option>Region VIII</option>
						<option>Region IX</option>
						<option>Region X</option>
						<option>Region XI</option>
						<option>Region XII</option>
						<option>Region XIII</option>
						<option>ARMM</option>
					</select>
					</div>
					<div class="col-sm-6" style="margin:0 0 .8em 0;">
					<select id="anotherClassSelector" class="form-control" name="province" onchange="ProvincE();">
						<option>Province</option>
					</select>
					</div>
				<div class="col-sm-6">
					<input type="text" class="input form-control" name="brgy" autocomplete="off" placeholder="Brgy. Name" required>
				</div>
					<div class="col-sm-6">
					<input type="text" class="input form-control" name="street" autocomplete="off" placeholder="Street Name" required>
				</div>
				<div class="col-sm-8">
					<!-- <select  id="CityMunicpalSelector" class="form-control">
						<option>City/Municipality Name</option>
					</select> -->
					<input type="text" class="input form-control" name="city_muni" autocomplete="off" placeholder="City/Municipality Name" required>
				</div>
					<div class="col-sm-4">
					<input type="text" class="input form-control" name="zipcode" autocomplete="off" placeholder="Zip Code" required>
				</div>
					<div class="col-sm-12">
					<input type="text" class="input form-control" name="auth_name" autocomplete="off" placeholder="Authorized Signature" required>
				</div>
				<div class="col-sm-12">
					<input type="text" class="input form-control" name="uname" autocomplete="off" placeholder="Username" required>
				</div>
				<div class="col-sm-12">
					<input onkeyup="checkPass();" type="password" class="input form-control" id="pass1" name="pass1" autocomplete="off" placeholder="Password"  required>
				</div>
				<div class="col-sm-12">
					<input onkeyup="checkPass();" type="password" class="input form-control" id="pass2" name="pass2" autocomplete="off"   placeholder="Retype Password" required>
				</div>
				<div class="col-sm-12">
					<input type="email" class="input form-control" name="email" autocomplete="off" placeholder="Email Address" required>
				</div>
				<div class="col-sm-12">
					<input type="text" class="input form-control" name="contact_p" autocomplete="off" placeholder="Contact Person" required>
				</div>
					</div>
				<div class="help-text">
					<p>By signing up, you agree to our</p>
					<p><a href="#" data-toggle="modal" data-target="#exampleModalLong">Terms of service</a></p>
				</div><!--.help-text-->	
					<button type="submit" class="button" value="Sign Up">Sign Up</button>
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
	function RegioN(){	
			// document.getElementById('regionSelector').options[document.getElementById('regionSelector').selectedIndex].id
			hideUnhideClassType(document.getElementById('region').selectedIndex);		
		}
		function hideUnhideClassType(region){
			var arr = {
						0: "Province",
						1: "Province, Metro Manila", // NCR
						2: "Province, Abra, Apayao, Benguet, Ifugao, Kalinga, Mountain Province", // CAR
						3: "Province, Ilocos Norte, Ilocos Sur, La Union, Pangasinan", // Region 1
						4: "Province, Batanes, Cagayan, Isabela, Nueva Vizcaya, Quirino", // Region 2
						5: "Province, Aurora, Bataan, Bulacan, Nueva Ecija, Pampanga, Tarlac, Zambales", // Region 3
						6: "Province, Batangas, Cavite, Laguna, Quezon, Rizal", // Region 4-A
						7: "Province, Marinduque, Occidental Mindoro, Oriental Mindoro, Palawan, Romblon", // Region 4-B
						8: "Province, Albay, Camarines Norte, Camarines Sur, Catanduanes, Masbate, Sorsogon", // Region 5
						9: "Province, Aklan, Antique, Capiz, Iloilo, Guimaras, Negros Occidental", // Region 6
						10: "Province, Bohol, Cebu, Negros Oriental, Siquijor", // Region 7
						11: "Province, Biliran, Eastern Samar, Leyte, Nothern Samar, Samar (Western Samar), Southern Leyte", // Region 8 
						12: "Province, Zamboanga del Norte, Zamboanga del Sur, Zamboanga Sibugay", // Region 9 
						13: "Province, Bukidnon, Camiguin, Lanao del Norte, Misamis Occidental, Misamis Oriental", // Region 10
						14: "Province, Compostela Valley, Davao del Norte, Davao del Sur, Davao Occidental, Davao Oriental", // Region 11
						15: "Province, Cotabato (North Cotabato), South Cotabato, Sultan Kudarat, Sarangani", // Region 12
						16: "Province, Agusan del Norte, Agusan del Sur, Surigao del Norte, Surigao del Sur, Dinagat Islands", // Region 13
						17: "Province, Basilan, Lanao del Sur, Maguindanao, Sulu, Tawi-Tawi" // ARMM
				};
			if (region === 0 || region === null) {
				document.getElementById('anotherClassSelector').innerHTML = '<option>'+arr[region]+'</option>'
			} else {
				var anotherArr = arr[region].split(", ");
				document.getElementById('anotherClassSelector').innerHTML = '';
					for(var i = 0; i < anotherArr.length; i++) {
						document.getElementById('anotherClassSelector').innerHTML += '<option>'+anotherArr[i]+'</option>';
					}
			}
		}
	function ProvincE(){
		var getProvince = $('#anotherClassSelector').children(":selected").val();
		getCityMunipal(getProvince);
	}
	function getCityMunipal(getProvince){
		var arr = {
					'Abra' : "City/Municipality Name, Bangued, Boliney, Bucay, Bucloc, Daguioman, Danglas, Dolores, La Paz, Lacub, Lagangilang, Lagayan, Langiden, Licuan, Luba, Malibcong"
				  };
		var anotherArr = arr[getProvince].split(", ");
		document.getElementById('CityMunicpalSelector').innerHTML = '';
					for(var i = 0; i < anotherArr.length; i++) {
						document.getElementById('CityMunicpalSelector').innerHTML += '<option>'+anotherArr[i]+'</option>';
					}
	}
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