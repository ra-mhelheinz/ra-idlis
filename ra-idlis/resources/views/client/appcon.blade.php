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
{{-- @include('client.breadcrumb')
@foreach ($ownshs as $ownsh)
	<datalist id="{{$ownsh->ocid}}_owlist">
		@foreach ($clss as $cls)
			@if ($cls->ocid == $ownsh->ocid)
				<option data-id="{{$cls->classid}}" value="{{$cls->classname}}"></option>
			@endif
		@endforeach
	</datalist>
@endforeach
@foreach ($hfaci as $hfacis)
	<datalist  id="{{$hfacis->hfser_id}}_hfst">
		@foreach ($fatypes as $fatype)
			@if ($fatype->hfser_id == $hfacis->hfser_id)
				<option value="{{$fatype->facname}}">{{$fatype->facid}}</option>
			@endif
		@endforeach
	</datalist>
@endforeach --}}
<script type="text/javascript">
	  	document.getElementById('first').style = "color: blue;";
</script>
@include('client.breadcrumb')
		<div class="jumbotron container" style="background-color: #fff;border: 1px solid rgba(0,0,0,.2);border-radius: 0;padding: 2rem 2rem;margin-top: 1%;padding-bottom: 7%;">
			<div class="title"  style="text-align: center;border-bottom: 1px solid green;padding-bottom: 9px;position: relative;margin-bottom: 2%;"> 
			{{-- <h2>APPLICATION FORM</h2>
			<div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
			  <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o"></i>Application for change</button>
			  <button type="button" class="btn btn-secondary"><i class="fa fa-history"></i>Revision of History</button>
			</div> --}}
			<div class="row">
				<div class="col-sm-4">
					  <button type="button" class="btn-defaults"><i class="fa fa-pencil-square-o"></i></button>
					  <button type="button" class="btn-defaults"><i class="fa fa-history"></i></button>
				</div>
				<div class="col-sm-4"><h3>APPLICATION FORM</h3></div>
				<div class="col-sm-4">
					  <a href="{{ asset('/client/apply/con') }}"><button type="button" class="btn btn-primary">CON</button></a>
					  <a href="{{ asset('/client/apply/ptc') }}"><button type="button" class="btn btn-primary">PTC</button></a>
					  <a href="{{ asset('/client/apply/coa') }}"><button type="button" class="btn btn-primary">COA</button></a>
					  <a href="{{ asset('/client/apply/ato') }}"><button type="button" class="btn btn-primary">ATO</button></a>
				</div>
			</div>
			</div>

	<form id="ApplyFoRm" data-parsley-validate>
		<div class="col-sm-"><center><h2>CERTIFICATE OF NEED FOR NEW GENERAL HOSPITALS</h2></center></div>
		<br
>	  {{-- <div class="row">
	  	<div class="col-xs-12 col-md-6 fname">
		  	<div class=" form-group">
		  		<label style="display:block;"><span >Name of Facility</span></label>
		  		<p><strong>{{$clientData->facilityname}}</strong></p>		
 		  	</div>
		</div>
		<div class="col-xs-12 col-md-12 fname" style="margin-top: -10px">
			<p>​{{$clientData->streetname}}, {{$clientData->barangay}}, {{$clientData->city_muni}}, {{$clientData->zipcode}} {{$clientData->provname}} - {{$clientData->rgn_desc}} </p>
		</div>
	  	<div class="col-xs-12 col-md-6 fname">
		  	<div class=" form-group">
		  		<select id="HFacility" data-parsley-required-message="<strong>Health Facility</strong> required."  onchange="selectHealthFacility();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;" required>
		  			<option disabled value="" selected hidden>Type of Health Facility</option>
		  			@if ($fatypes)
		  				@foreach ($fatypes as $fatype)
			  				<option value="{{$fatype->facid}}">{{$fatype->facname}}</option>
			  			@endforeach
		  			@endif
		  			
		  		</select>
		  	</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<span id="ServiceSpan">
			</span>
		</div>
	<div class="col-xs-12 col-md-3 fname">
	  	<div class=" form-group">
	  		<select id="Class2Owner" onchange="ClassOwner()" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;" required>
	  			<option  disabled selected hidden>Classification as to Ownership</option>
				@foreach ($ownshs as $ownsh)
					<option value="{{$ownsh->ocid}}">{{$ownsh->ocdesc}}</option>
				@endforeach
	  		</select>
	  	</div>
	</div>
		<div class="col-xs-12 col-md-3 fname">
	  		<select id="anotherClassSelector" onchange="ClassType();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;" required>
	  			<option  disabled selected hidden>Classification Type</option>
	  		</select>
	  	</div>
				<div class="col-xs-12 col-md-6">
				<span id="OtherSpan" style="display: none">
					<div class="form-group">
						<input type="text" name="" placeholder="Others" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
					</div>
				</span>
			</div>
	<div class="col-xs-12 col-md-4 offset-md-2">
		<div class="form-group">
			<input type="text" data-parsley-type="number" placeholder="Authorized Bed Capacity" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;" required>
		</div>
	</div>
	<div class="col-xs-12 col-md-4 fname">
	  		<select style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;" required>
	  			<option disabled selected hidden>Status of Application</option>
	  			@foreach ($aptyps as $aptyp)
	  				<option value="{{$aptyp->aptid}}">{{$aptyp->aptdesc}}</option>
	  			@endforeach 
	  			<option>Initial</option>
	  			<option>Renewal</option>
	  		</select>
	</div>
				</div> --}}
{{-- 		<div class="text-center">
			<a href="{{asset('client/apply/lop')}}"><button type="button" style="background-color: #228B22 !important" class="btn-primarys"><i class="fa fa-list-alt"></i>&nbsp;List of Personnel</button>
				</a>
		</div>
		<hr style="color:green;">
		<div class="container" >
		<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer">Click to show Requirements</div>
		<div id="panel" class="container" style="display: none;background: #fff;padding: 1em;border-radius: 10px;overflow: auto;">
			<table class="attachments table table-hover" style="width: 100%;">
				<tbody id="ApplyTable">
				</tbody> --}}
				{{-- <tr>
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
				</tr> --}}
{{-- 				
			</table>
		</div>
		</div>
				</div> --}}
				<!-- <div class="row">
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
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">{{-- {{$clientData->facilityname} --}}</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="input-group">Address:&nbsp;
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">{{-- {{$clientData->streetname}}, {{$clientData->barangay}}, {{$clientData->city_muni}}, {{$clientData->zipcode}} {{$clientData->provname}} - {{$clientData->rgn_desc}} --}} </div>
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
						<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">{{-- {{$clientData->email}} --}}</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">Owner: &nbsp;
							<div class="input-group-prepend" style="border-bottom: 1px solid #b5c1c9;">{{-- {{$clientData->authorizedsignature}} --}}</div>
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
					<div class="col-sm-6">
						<div class="input-group">Type of Health Facility/Service: &nbsp;
							<div class="input-group-prepend">
									<select id="HFacility" data-parsley-required-message="<strong>Health Facility Type</strong> required."  onchange="selectHealthFacility();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;" required>
							  			<option disabled selected hidden></option>
									  	{{-- @if ($hfaci)
							  				@foreach ($hfaci as $hfacis)
								  				<option value="{{$hfacis->hfser_id}}">{{$hfacis->hfser_desc}}</option>
								  			@endforeach
							  			@endif --}}
							  		</select>
				  			</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group">Health Facility/Service: &nbsp;
							<div class="input-group-prepend">
									<select id="HealFaServ" data-parsley-required-message="<strong>Health Facility Type</strong> required."  onchange="CheckifHos();" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;width: 100%;" required>
							  			<option disabled selected hidden></option>
									  	
							  		</select>
				  			</div>
						</div>
					</div>
				</div>
				<div id="LTOcontent" class="row">
				</div> -->
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							Name of Proposed Hospital:
						</div>
						<div class="col-sm-8">
							<strong>{{$clientData->facilityname}}</strong>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							Complete Address of Proposed Hospital:
						</div>
						<div class="col-sm-8">
							{{$clientData->streetname}}, {{$clientData->barangay}}, {{$clientData->city_muni}} -  {{$clientData->rgn_desc}}
							{{--< div class="row">
								<div class="col-sm-4"><center>{{$clientData->streetname}}</center></div>
								<div class="col-sm-4"><center>{{$clientData->barangay}}</center></div>
							</div> --}}
						</div>
					</div>
					{{-- <div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-2"><center>Number</center></div>
								<div class="col-sm-2"><center>Street</center></div>
								<div class="col-sm-2"><center>Barangay</center></div>
							</div>
						</div>
					</div> --}}
					{{-- <div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-9" style="border-width: 2px;border-bottom-color:black; border-bottom-style: solid;">
							<div class="row">
								<div class="col-sm-6"><center>{{$clientData->city_muni}}</center></div>
								<div class="col-sm-4"><center>{{$clientData->rgn_desc}}</center></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-6"><center>City/Municipality</center></div>
								<div class="col-sm-4"><center>Region</center></div>
							</div>
						</div>
					</div> --}}
					<br>
					<div class="row">
						<div class="col-sm-4">
							Name of Proponent:
						</div>
						<div class="col-sm-8">
							{{$clientData->authorizedsignature}}
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							Address of Proponent: 
						</div>
						<div class="col-sm-8">
							{{$clientData->email}}
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							Contact Number: 
						</div>
						<div class="col-sm-8">
						{{$clientData->contact}}
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3">
							Classification According to: 
						</div>
						<div class="col-sm-9" >
							<div class="row">
								{{-- <div class="col-sm-3">Ownership:</div> --}}
								{{-- @foreach ($ownshs as $ownsh)
									<div class="col-sm-4"><input class="form-check-input" type="checkbox" name=""> {{$ownsh->ocdesc}}</div>
								@endforeach --}}
								{{-- 
								<div class="col-sm-4"><center>Barangay</center></div> --}}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							Ownership:<span style="color:red">*</span>
						</div>
						<div class="col-sm-8" >
							Service Capability:<span style="color:red">*</span>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4" style="margin-left:2px">
							<span>
								@foreach ($ownshs as $ownsh)
									<input class="" type="radio" name="Ownership" value="{{$ownsh->ocid}}" data-parsley-required-message="<strong>Ownership</strong> required." required> {{$ownsh->ocdesc}}
								&nbsp;&nbsp; 
								@endforeach
								{{-- <input class="" type="radio" name="Ownership" value="Government" data-parsley-required-message="<strong>Ownership</strong> required." required> Government
								&nbsp;&nbsp; 
								<input class="" type="radio" name="Ownership" value="Private"> Private
								&nbsp;&nbsp;  --}}
							</span>
						</div>
						<div class="col-sm-6" >
							<span>
								{{-- <div class="col-sm-2"> --}}
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel1" data-parsley-required-message="<strong>Service Capability</strong> required." value="L1" required> Level 1
									&nbsp;&nbsp; 
								{{-- </div> --}}
								{{-- <div class="col-sm-2"> --}}
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel2" value="L2"> Level 2
									&nbsp;&nbsp;
								{{-- </div> --}}
								{{-- <div class="col-sm-2"> --}}
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel3" value="L3"> Level 3
								{{-- </div> --}}
							</span>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6" style="margin-left:2px">
							Total Capital Investment for the Proposed Hospital:<span style="color:red">*</span>
						</div>
						&#8369;
						<div class="col-sm-5" >
							<input type="text" class="form-control" data-parsley-required-message="<strong>Total Capital Investment</strong> required." name="totalcap" required required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6" style="margin-left:2px">
							Total Lot Area of the Proposed Site:<span style="color:red">*</span>
						</div>
						&nbsp;&nbsp;&nbsp; 
						<div class="col-sm-5" >
							<input type="text" data-parsley-required-message="<strong>Total Lot Area</strong> required." class="form-control" name="lotArea" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">Proposed Total Bed Capacity:<span style="color:red">*</span>
						</div>
						&nbsp;&nbsp;&nbsp; 
						<div class="col-sm-5" {{-- style="border-width: 2px;border-bottom-color:black; border-bottom-style: solid;" --}}>
							<input type="text" class="form-control" data-parsley-required-message="<strong>Proposed Total Bed Capacity</strong> required." name="propTotalBedCap" required>
						</div>
					</div>
					<br>
					<br>
					<br>
					{{-- <div class="row"><div class="col-sm-12">Attachment: (incomplete attachment shall be a ground for the denial of this application)</div></div> --}}
					<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer">Click to show CHECKLIST OF DOCUMENTS:</div>
						<div id="panel" class="container" style="display: none;background: #fff;padding: 1em;border-radius: 10px;overflow: auto;">
							<table class="attachments table table-hover" style="width: 100%;">
								<tbody id="ApplyTable">
									<tr><td colspan="2"><center><p><strong>Note: </strong>File should be not larger than <strong>2 MB</strong></p></td><center></tr>
									@foreach ($uplds as $upld)
										<tr>
											<td width="50%">{{$upld->updesc}}</td>
											<td>
												<input name="" class="form-control-file" id="{{$upld->upid}}" data-parsley-required-message="File required for assessment." data-parsley-max-file-size="2.5" data-parsley-trigger="change" class="form-control" type="file">
											</td>				
										</tr>
									@endforeach
								</tbody>													
							</table>
						</div>
						<br>
		{{-- <div class="col-sm-12">&nbsp;&nbsp;&nbsp;I hereby declare  that this Application  has been accomplished  by me, and that the foregoing  information  and attached documents required for the permit to construct are true and correct.</div> --}}
		<div class="container">
			<center><button style="background-color: #228B22 !important" type="submit" class="btn-primarys"  {{-- data-toggle="modal" data-target="#exampleModalCenter" --}}>Submit</button></center>
		</div>
		</div>
				</div>
			</div>
		</form>
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
		$('#ApplyFoRm').on('submit',function(e){
			e.preventDefault();
			var token = $('#global-token').val();
			var form = $(this);
			
			// console.log(Test);
            form.parsley().validate();
            if (form.parsley().isValid()){
            	// var ownship = $("input[name='Ownership']:checked").val();
            	// var serv_cap = $('input[name="HospitalLevel"]:checked').val();
            	// var total_cap = $('input[name="totalcap"]').val();
            	// var total_lot = $('input[name="lotArea"]').val();
            	// var bedCap = $('input[name="propTotalBedCap"]').val();
             } else {

             }
		});
		function selectHealthFacility(){
			var selected = $('#HFacility').children(":selected").text();
			var selectedVal = $('#HFacility').children(":selected").val();
			var token = $('#global-token').val();
			var GetNames = $('#'+selectedVal+'_hfst option').map(function() {return $(this).val();}).get();
			var Get_Ids = $('#'+selectedVal+'_hfst option').map(function() {return $(this).text();}).get();
			$('#HealFaServ').empty();
			$('#HealFaServ').append('<option disabled selected hidden></option>');
			for (var i = 0; i < Get_Ids.length; i++) {
				var id = Get_Ids[i],selectedText = GetNames[i];
				$('#HealFaServ').append(
						'<option id="'+id+'_healServ">'+selectedText+'</option>'
					);
			}
			// if (selected == "Hospital") {
			// 		$('#ServiceSpan').append(
			// 				'<div class="form-group">' +
			// 					'<select style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;" required>' +
			// 						'<option  disabled selected hidden>Services</option>' +
			// 						'<option>Clinical Services for In-Patients</option>' +
			// 						'<option>Ancillary Services</option>' +
			// 					'</select>' +
			// 				'</div>'
			// 			);
			// } else {
			// 	$('#ServiceSpan').empty();
			// }
			// $.ajax({
			// 	url: '{{ asset('mf/getUploads') }}',
			// 	method: 'POST',
			// 	data: {_token:token,id:selectedVal},
			// 	success: function(data){
			// 		$('#ApplyTable').empty();
			// 		if (data!="NO") {
			// 			$('#ApplyTable').append('<tr><td colspan="2"><center><p><strong>Note: </strong>File should be not larger than 2 MB</p></td><center></tr>');
			// 			for (var i = 0; i < data.length; i++) {
			// 					var d = data[i];
			// 					$('#ApplyTable').append(
			// 							'<tr>' +
			// 								'<td>'+d.updesc+'<span style="color:red">*</span></td>' +
			// 								// '<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>' +
			// 								'<td><input name="'+d.upid+'" data-parsley-required-message="File required for assessment." data-parsley-max-file-size="22.5" data-parsley-trigger="change" class="form-control-file" type="file" required>' +
			// 								'</td>' +
			// 							'</tr>'
			// 						);
			// 			}
			// 			$('#ApplyTable').append(
			// 					'<tr>' +
			// 						'<td colspan="2" class="text-center"><button style="background-color: #228B22 !important" type="submit" class="btn-primarys"  {{-- data-toggle="modal" data-target="#exampleModalCenter" --}}>Submit</button></td>' +
			// 					'</tr>' +
			// 					'<tr>' +
			// 						'<td>Copy of OR for Application fee</td>' +
			// 						// '<td><button type="button" class="btn-primarys"><i class="fa fa-upload"></i>&nbsp;Upload</button></td>' +
			// 						'<td><input class="form-control-file" type="file"></td>' +
			// 					'</tr>'
			// 				);
			// 		} else {

			// 		}
			// 	}
			// });
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
	window.Parsley.addValidator('maxFileSize', {
		  validateString: function(_value, maxSize, parsleyInstance) {
		    if (!window.FormData) {
		      alert('You are making all developpers in the world cringe. Upgrade your browser!');
		      return true;
		    }
		    var files = parsleyInstance.$element[0].files;
		    return files.length != 1  || files[0].size <= (maxSize * 1024)*1024;
		  },
		  requirementType: 'integer',
		  messages: {
		  	// %s
		    en: '<span style="color:red">This file should not be larger than 2 MB</span>',
		  }
		});
	</script>
@include('client.sitemap')
@endsection