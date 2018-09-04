@extends('main')
@section('content')
@include('client.nav')
@if (session()->exists('client_data'))
   @php
     $clientData = session('client_data');
   @endphp
@else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif
@include('client.breadcrumb')
	<div class="container"  style="padding-top: 2%;padding-bottom: 7%;">
		<div class="card">
			<div class="card-header" style="text-align: center;border-bottom: none;">
			<div class="title"> 
			<h3>HFS Application Form</h3>
			</div>
			</div>
			<div class="card-body">
			<form>
				<div class="row">
					<div class="col-sm-12"><div class="input-group">
							Date:&nbsp;
						<div class="input-group-prepend" id="date" style="border-bottom: 1px solid #b5c1c9;"></div>
						</div></div>
					<script type="text/javascript">
						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						if(dd<10) {
						    dd = '0'+dd
						} 
						if(mm<10) {
						    mm = '0'+mm
						} 
						today = mm + '/' + dd + '/' + yyyy;
						document.getElementById('date').innerHTML = today;
					</script>
					<div class="col-sm-12">
						<div class="input-group">Name of Health Facility/Service:&nbsp;
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="input-group">Address:&nbsp;
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;"> </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="input-group">Latest LTO/COA/ATO/COR No.&nbsp;
						<div class="input-group-prepend"><input type="text" name="" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;"></div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">Validity Period from &nbsp;
						<div class="input-group-prepend"><input type="date" name="" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;"></div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">to &nbsp;
						<div class="input-group-prepend"><input type="date" name="" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;"></div>
						</div></div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="input-group" style="font-size: 14px; ">Tel. Number (HF landline):&nbsp;
						<div class="input-group-prepend" ></div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group" style="font-size: 14px;margin-top: 2px;">Cellphone No:&nbsp;
						<div class="input-group-prepend"></div>
						</div></div>
					<div class="col-sm-4">
						<div class="input-group" style="font-size: 14px;margin-top: 2px;">Email Address:&nbsp;
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">Owner: &nbsp;
							<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="input-group">Permit to Construct No. (if applicable):&nbsp;
							<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">asd</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">Presenting/Existing ABC:&nbsp;
							<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">asd</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">validity period:&nbsp;
							<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">asd</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">Type of Health Facility/Service: &nbsp;
							<div class="input-group-prepend">
									<select id="HFacility" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectHealthFacility();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;" required>
							  			<option disabled selected hidden></option>
								  				<option value=""></option>
							  		</select>
				  			</div>
						</div>
					</div>
				</div>
				<div id="LTOcontent" class="row">
				</div>
			</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function selectHealthFacility(){
			var selected = $('#HFacility').children(":selected").text();
			var selectedVal = $('#HFacility').children(":selected").val();
			var token = $('#global-token').val();
			if (selected == "License to Operate") {
				$('#LTOcontent').empty();
					$('#LTOcontent').append(
					'<div class="col-sm-6">' +
						'<div class="form-group">' + 'License to Operate:' + '<select id="LTO" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectLTO();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 50%;" required>' +
				  			'<option disabled selected hidden></option>' + '<option>Hospital</option>' +
				  		'</select>' +
				  		'</div>' +
		  			'</div>' +
		  			'<div class="col-sm-3">' +
						'<div id="hospitalextend">' +
				  		'</div>' +
		  			'</div>' + 
		  			'<div class="col-sm-3">' +
						'<div id="hospitalextends">' +
				  		'</div>' +
		  			'</div>' 
						);
			} 
			else if (selected == "Certificate of Accreditation") {
				$('#LTOcontent').empty();
					$('#LTOcontent').append(
					'<div class="col-sm-6">' +
						'<div class="form-group">' + 'Certificate of Accreditation:' + '<select id="LTO" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectLTO();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 50%;" required>' +
				  			'<option disabled selected hidden></option>' + 
				  		'</select>' +
				  		'</div>' +
		  			'</div>'
						);
			} 
			else if (selected == "Certificate of Registration") {
				$('#LTOcontent').empty();
					$('#LTOcontent').append(
					'<div class="col-sm-6">' +
						'<div class="form-group">' + 'Certificate of Registration:' + '<select id="LTO" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectLTO();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 50%;" required>' +
				  			'<option disabled selected hidden></option>' + 
				  		'</select>' +
				  		'</div>' +
		  			'</div>'
						);
			} 
			else if (selected == "Authority to Operate") {
				$('#LTOcontent').empty();
					$('#LTOcontent').append(
					'<div class="col-sm-6">' +
						'<div class="form-group">' + 'Authority to Operate:' + '<select id="LTO" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectLTO();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 50%;" required>' +
				  			'<option disabled selected hidden></option>' + 
				  		'</select>' +
				  		'</div>' +
		  			'</div>'
						);
			} 

		}
		function selectLTO(){
			var selected = $('#LTO').children(":selected").text();
			var selectedVal = $('#LTO').children(":selected").val();
			var token = $('#global-token').val();
			if (selected == "Hospital") {
					$('#hospitalextend').append(
							'<div class="form-group">' +
								'<select id="facilitylev" onchange="facilitylevel()" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .66rem .75rem;width: 100%;" required>' +
									'<option  disabled selected hidden>Services</option>' +
									'<option>General</option>' +
									'<option>Specially, Specify</option>' +
								'</select>' +
							'</div>'
						);
			} else {
				$('#hospitalextend').empty();
			}
		}
		function facilitylevel(){
			var selected = $('#facilitylev').children(":selected").text();
			var selectedVal = $('#facilitylev').children(":selected").val();
			var token = $('#global-token').val();
			if (selected == "General") {
					$('#hospitalextends').empty();
					$('#hospitalextends').append(
							'<div class="form-group">' +
								'<select style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .7rem .75rem;width: 100%;" required>' +
									'<option  disabled selected hidden>Levels</option>' +
									'<option>Level 1</option>' +
									'<option>Level 2</option>' + '<option>Level 3</option>' +
								'</select>' +
							'</div>'
						);
			} 
			else if(selected == "Specially, Specify"){
				$('#hospitalextends').empty();
				$('#hospitalextends').append(
							'<div class="form-group">' +
								'<input type="text" name="" placeholder="Others" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">' +
							'</div>'
						);
			}
		}
	</script>

@endsection