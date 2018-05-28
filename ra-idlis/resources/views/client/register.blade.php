@extends('main')
@section('style')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/login.css')}}">
@endsection
@section('content')	
	<div class="form-wrapss" style="width: 650px !important;">
		<div class="tabss-content">
	 			<div class="text-center" style="background-color: #e6e7e8;">
					<h3 style="padding: 20px;">Register</h3>
				</div>
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
					<button type="submit" class="button" value="Sign Up">Sign Up</button>
					</form>
									
				<div class="help-text">
					<p><a href="{{asset('/')}}">Have an account?</a></p>
					<p>By signing up, you agree to our</p>
					<p><a href="#" data-toggle="modal" data-target="#exampleModalLong">Terms of service</a></p>
				</div><!--.help-text-->	
				</div>

		</div>	
				<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms of service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.

Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.

Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.

Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.

Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.

Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.

Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Agree</button>
        <button type="button" class="btn btn-danger"  data-dismiss="modal">Decline</button>
      </div>
    </div>
  </div>
</div>
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
@endsection