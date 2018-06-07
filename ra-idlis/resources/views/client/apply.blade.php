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
<style type="text/css">
	table.attachments > tr{
		width: 50%;
			}
			table.attachments > td {
				padding: 1em;
			}
</style>
		<div class="jumbotron container" style="background-color: #fff;border: 1px solid rgba(0,0,0,.2);margin-top: 2%;">
			<h4 style="border-bottom: 1px solid green;padding-bottom: 9px;position: relative;"><strong>Application Form</strong><span style=" background: lightgreen none repeat scroll 0 0;bottom: -2px;height: 3px;left: 0;position: absolute;width: 75px;"></span></h4>
	  <div class="row">
	  	<div class="col-xs-12 col-md-6 fname">
		  	<div class=" form-group">
		  		<label style="display:block;"><span >Name of Facility</span></label>

		  		<h2>{{$clientData->facilityname}}</h2>		
 		  	</div>
		</div>
		<div class="col-xs-12 col-md-12 fname" style="margin-top: -10px">
			<h5>​{{$clientData->streetname}}, {{$clientData->barangay}}, {{$clientData->city_muni}}, {{$clientData->zipcode}} {{$clientData->provname}} - {{$clientData->rgn_desc}} </h5>

		</div>
	  	<div class="col-xs-12 col-md-6 fname">
		  	<div class=" form-group">
		  		<label style="display:block;"><span >Type of Health Facility</span></label>
		  		<select id="HFacility" class="form-control" onchange="selectHealthFacility();">
		  			<option hidden></option>
		  			<option>Hospital</option>
		  			<option>Clinical Lab</option>
		  			<option>BSF</option>
		  			<option>LDWA</option>
		  			<option>DL</option>
		  			<option>Rural Health Unit</option>
		  			<option>Infirmary</option>
		  			<option>Barangay Health Station</option>
		  			<option>Dental Lab</option>
		  		</select>
		  	</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<span id="ServiceSpan" style="display: none">
			<div class="form-group"><label style="display:block;" ><span >Services</span><small style="font-weight:normal;" class="pull-right"></small></label>
				<select class="form-control">
					<option hidden></option>
					<option>Clinical Services for In-Patients</option>
					<option>Ancillary Services</option>
				</select>
			</div>
			</span>
		</div>
	<div class="col-xs-12 col-md-6 fname">
	  	<div class=" form-group">
	  		<label style="display:block;"><span>Classification as to Ownership</span></label>
	  		<select id="Class2Owner" class="form-control" onchange="ClassOwner()">
	  			<option hidden></option>
				<option id="Govern">Government</option>
	  			<option id="Private">Private</option>
	  		</select>
	  	</div>
	</div>
		<div class="col-xs-12 col-md-6 fname">
	  	<div class=" form-group"><label>Classification Type</label>
	  		<select id="anotherClassSelector" class="form-control" onchange="ClassType();">
	  			
	  		</select>
	  	</div>
	</div>
<!-- 	<div class="col-xs-12 col-md-6">
		<div class="form-group"><label style="display:block;" ><span >Status of Application</span><small style="font-weight:normal;" class="pull-right"></small></label>
			<select class="form-control">
				<option>...</option>
			</select>
		</div>
	</div> -->

	<div class="col-xs-12 col-md-6">
		<div class="form-group"><label style="display:block;" ><span >Authorized Bed Capacity</span><small style="font-weight:normal;" class="pull-right"></small></label>
			<input type="number" name="" class="form-control">
		</div>
	</div>
	
			<div class="col-xs-12 col-md-6">
				<span id="OtherSpan" style="display: none">
					<div class="form-group"><label style="display:block;" ><span >Others :</span><small style="font-weight:normal;" class="pull-right"></small></label>
						<input type="text" name="" class="form-control">
					</div>
				</span>
			</div>

	<div class="col-xs-12 col-md-6 fname">
	  	<div class=" form-group"><label>Status of Application</label>
	  		<select class="form-control">
	  			<option hidden></option>
	  			<option>Initial</option>
	  			<option>Renewal</option>
	  		</select>
	  	</div>
	</div>
		</div>
		<div class="text-center">
			<a href="{{asset('client/apply/lop')}}"><button style="background-color: #228B22 !important" class="btn-primarys"><i class="fa fa-list-alt"></i>&nbsp;List of Personnel</button>
				</a>
		</div>
		<hr style="color:green;">
		<div class="container" >
		<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer">Click to show Attachments to be Uploaded</div>
		<div id="panel" class="container" style="display: none;background: #fff;padding: 1em;border-radius: 10px;">
			<!-- <ul class="list-group">
			  <li class="list-group-item all">Acknowledgement (Notarized) 
			  	<span style="float:right">
			  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
			  	</span>
			  </li>
			  <li class="list-group-item all">List of Personnel (with proof of qualification)
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  	</span>
			  </li>
			  <li class="list-group-item all">List of Equipments
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  <li class="list-group-item all">List of Ancillary Services (if applicable)
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  <li class="list-group-item all">Application Form (Medical X-ray)
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  <li class="list-group-item all">Application Form (Hospital Pharmacy)
				  <span style="float:right">
				  	<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  <li class="list-group-item all">Geographic Form (Location Map of the Facility)
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  <li class="list-group-item all">Photographs of exterior and interior of the Health Facility
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  </li>
			  

			</ul>
			<div class="text-center" style="margin:2em;">
			<button class="btn btn-outline-success"  data-toggle="modal" data-target="#exampleModalCenter">Submit</button>
			</div>
			<ul class="list-group">
				<li class="list-group-item">Copy of OR for Application fee
				  <span style="float:right">
				  		<button type="button" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;Upload</button>
				  </span>
			  	</li>
			</ul> -->
			<table class="attachments table" style="width: 100%;">
				<tr>
					<td>Acknowledgement (Notarized) </td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>List of Personnel (with proof of qualification)</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>List of Equipments</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>List of Ancillary Services (if applicable)</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>Application Form (Medical X-ray)</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>Application Form (Hospital Pharmacy)</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>Geographic Form (Location Map of the Facility)</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td>Photographs of exterior and interior of the Health Facility</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
				<tr>
					<td colspan="2" class="text-center"><button style="background-color: #228B22 !important" class="btn-primarys"  data-toggle="modal" data-target="#exampleModalCenter">Submit</button></td>
				</tr>
				<tr>
					<td>Copy of OR for Application fee</td>
					<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>
				</tr>
			</table>
		</div>
		</div>
				</div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #0f8845;
    color: white;">
        <h5 class="modal-title text-center" id="exampleModalLongTitle"><strong>Thank You for uploading your requirements.</strong></h5>
        <hr>
        <p>Our Licensing Officer (LO) is now reviewing and evaluating the completeness of the documents that you've submitted and please wait within the day (8:00 am - 5:00 pm working hour).</p>
	        <div class="alert alert-primary" role="alert">
				<p class="alert-heading"><i class="far fa-sticky-note"></i> Note:</p>
				<p>&nbsp;- Proceed to Cashier for payment and submit a photocopy of official receipt to the Licensing Officer;</p>
				<p>&nbsp;- Team Leader sets Schedule for Inspection (you may check through your online account)</p>
			</div>
      </div>
    </div>
  </div>
</div>
	<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>
	<script type="text/javascript">
		function selectHealthFacility(){
			var selected = $('#HFacility').children(":selected").val();
			if (selected == "Hospital") {
					$('#ServiceSpan').show();
			} else {
				$('#ServiceSpan').hide();
			}
		}
		function ClassOwner(){
			if(document.getElementById('Class2Owner').selectedIndex < 1) {

			} else {
				// document.getElementById('regionSelector').options[document.getElementById('regionSelector').selectedIndex].id
				hideUnhideClassType(document.getElementById('Class2Owner').selectedIndex);

			}
		}
		function hideUnhideClassType(ClassType){
			var arr = ["Select Classification ", "National, Local, Others", "Single Proprietorship, Corporation, Others"];
			if (ClassType === 0 || ClassType === null) {
				document.getElementById('anotherClassSelector').innerHTML = '<option>'+arr[ClassType]+'</option>'
			} else {
				var anotherArr = arr[ClassType].split(", ");
				document.getElementById('anotherClassSelector').innerHTML = '';
					for(var i = 0; i < anotherArr.length; i++) {
						document.getElementById('anotherClassSelector').innerHTML += '<option>'+anotherArr[i]+'</option>';
					}
			}
		}
		function ClassType(){
			var selected = $('#anotherClassSelector').children(":selected").val();
			if (selected == "Others") {
				$('#OtherSpan').show();
			} else {
				$('#OtherSpan').hide();
			}
		}
		// function region() {
			
		// }
			// function hideUnhideRegion(region) {
			// 	var arr = ["Choose Region...", 
			// 							"Metro Manila", // NCR
			// 							"Abra, Apayao, Benguet, Ifugao, Kalinga, Mountain Province", // CAR
			// 							"Ilocos Norte, Ilocos Sur, La Union, Pangasinan", // Region 1
			// 							"Batanes, Cagayan, Isabela, Nueva Vizcaya, Quirino", // Region 2
			// 							"Aurora, Bataan, Bulacan, Nueva Ecija, Pampanga, Tarlac, Zambales"];
			// 		if(region < 1 || region === null) {
			// 					document.getElementById('anotherRegionSelector').innerHTML = '<option>'+arr[0]+'</option>'
			// 				} else {
			// 					var anotherArr = arr[region].split(", ");
			// 					document.getElementById('anotherRegionSelector').innerHTML = '';
			// 					for(var i = 0; i < anotherArr.length; i++) {
			// 						document.getElementById('anotherRegionSelector').innerHTML += '<option>'+anotherArr[i]+'</option>';
			// 					}
			// 				}
			// 			}
	</script>
@endsection