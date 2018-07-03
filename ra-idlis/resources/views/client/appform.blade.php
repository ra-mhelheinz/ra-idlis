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
<span hidden>
	@foreach ($ownshs as $ownsh)
		<datalist id="{{$ownsh->ocid}}_oShip">
			@foreach ($clss as $cls)
				@if ($cls->ocid == $ownsh->ocid)
					<option value="{{$cls->classname}}">{{$cls->classid}}</option>
				@endif
			@endforeach
		</datalist>
	@endforeach
	@foreach ($fatypes as $fatype)
		<datalist id="{{$fatype->facid}}_facid">
			@foreach ($uploads as $upload)
				@if($upload->facid == $fatype->facid)
				<option value="{{$upload->updesc}}" isRequired="{{$upload->isRequired}}">{{$upload->upid}}</option>
				@endif
			@endforeach
		</datalist>
	@endforeach
</span>
<style type="text/css">
	table.attachments > tr{
		width: 50%;
			}
			table.attachments > td {
				padding: 1em;
			}
</style>
<input type="text" id="CurrentAppTypeSelected" hidden="" value="{{$id_type}}">
<script type="text/javascript">
	  	document.getElementById('first').style = "color: blue;";
	  	loader(true);
</script>
@include('client.breadcrumb')
@if (session()->has('apply_succes'))
		<div id="asdf" class="alert alert-info alert-dismissible fade show" role="alert">
		  <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('apply_succes')}}</center>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
@endif
<script type="text/javascript">
		function remLd() { setTimeout(function(){$('#asdf').fadeOut(500);}, 5000) };
		remLd();
	</script>
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
					 <div class="dropdown ">
					  <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-list"></i>&nbsp;Application Type
					  </button>
					  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="{{ asset('/client/apply/form/con') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Certificate of Need (CON)</small></a>
					    <a class="dropdown-item" href="{{ asset('/client/apply/form/ptc') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>Permit to Construct (PTC)</small></a>
					    <a class="dropdown-item" href="{{ asset('/client/apply/form/lto') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>License to Operate (LTO)</small></a>
					    <a class="dropdown-item" href="{{ asset('/client/apply/form/coa') }}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Certificate of Accreditation (COA)</small></a>
					    <a class="dropdown-item" href="{{ asset('/client/apply/form/ato') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Authority to Operate (ATO)</small></a>
					  </div>
					</div>
				</div>
			</div>
			</div>

	<form id="ApplyFoRm" action="{{ asset('/client/apply/form/') }}/{{$id_type}}"  data-parsley-validate enctype="multipart/form-data"  method="post" data-parsley-validate>
		<input type="" name="_token" value="{{csrf_token()}}" hidden>
		<div class="col-sm-"><center><h2>{{$hfaci}}</h2></center></div>
		<br>
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							Name of Health Facility:
						</div>
						<div class="col-sm-9">
							<strong>{{$clientData->facilityname}}</strong>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3">
							Complete Address:
						</div>
						<div class="col-sm-9">
							{{-- {{$clientData->streetname}}, {{$clientData->barangay}}, {{$clientData->city_muni}} -  {{$clientData->rgn_desc}} --}}
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-2">
							Street : 
						</div>
						<div class="col-sm-3">
							<strong>{{$clientData->streetname}}</strong>
						</div>
						<div class="col-sm-2">
							Barangay : 
						</div>
						<div class="col-sm-2">
							<strong>{{$clientData->barangay}}</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-2">
							City/Municipality : 
						</div>
						<div class="col-sm-3">
							<strong>{{$clientData->city_muni}}</strong>
						</div>
						<div class="col-sm-2">
							Region : 
						</div>
						<div class="col-sm-2">
							<strong>{{$clientData->rgn_desc}}</strong>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							Owner:
						</div>
						<div class="col-sm-9">
							<strong>{{$clientData->authorizedsignature}}</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							Contact Number:
						</div>
						<div class="col-sm-9">
							{{$clientData->contact}}
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							Email Address: 
						</div>
						<div class="col-sm-9">
						{{$clientData->email}}
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3">
							Classification According to: 
						</div>
						<div class="col-sm-9" >
							<div class="row">
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3" >
							Health Facility:<span style="color:red">*</span>
						</div>
						<div class="col-sm-3" >
							<select class="form-control" id="HFATYPE" name="facid" onchange="{{--getFacilityType();--}}getUploads()" data-parsley-required-message="<strong>Health Facility</strong> required." required>
								<option value=""></option>
								@foreach ($fatypes as $fatype)
									<option value="{{$fatype->facid}}">{{$fatype->facname}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-3" >
							Ownership:<span style="color:red">*</span>
						</div>
						<div class="col-sm-3" >
							<select class="form-control" id="OWNSHP" name="OWNSHP" data-parsley-required-message="<strong>Ownership</strong> required." onchange="getOwnship();" required>>
								<option value=""></option>
								@foreach ($ownshs as $ownsh)
									<option value="{{$ownsh->ocid}}">{{$ownsh->ocdesc}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<span id="HideLevel1" style="display:none;">
						<div class="row">
							<div class="col-sm-3" id="Main1Sub1Name">
								{{-- Services:<span style="color:red">*</span> --}}
							</div>
							<div class="col-sm-3" id="Main1Sub1DrpDown">
								{{-- <select class="form-control">
									<option value=""></option>
									<option>Colorectal Surgery</option>
									<option>General Surgery</option>
									<option>Pediatric Surgery</option>
									<option>Opthalmolgic Surgery</option>
									<option>Oral and Maxillo-facial Surgery</option>
									<option>Orthodopedic Surgery</option>
									<option>Otolaryngologic Surgery</option>
									<option>Pediatric Surgery</option>
									<option>Plastic and Reconstructive Surgery</option>
									<option>Reproductive Health Surgery</option>
									<option>Thoracic Surgery</option>
									<option>Urologic Surgery</option>
								</select> --}}
							</div>
							<div class="col-sm-3" id="Main1Sub2Name" style="display: none">
								Class:<span style="color:red">*</span>
							</div>
							<div class="col-sm-3" id="Main1Sub2DrpDown" style="display: none">
								<select class="form-control" id="CLS" name="CLS" onchange="chckOwnOther();">
								</select>
							</div>
						</div>
						<br>
					</span>
					<span id="HideLevel2" style="display:none;">
						<div class="row">
							<div class="col-sm-3" id="Main2Sub1Name">
								{{-- Services:<span style="color:red">*</span> --}}
							</div>
							<div class="col-sm-3" id="Main2Sub1DrpDown">
								{{-- <select class="form-control">
									<option value=""></option>
									<option>Colorectal Surgery</option>
									<option>General Surgery</option>
									<option>Pediatric Surgery</option>
									<option>Opthalmolgic Surgery</option>
									<option>Oral and Maxillo-facial Surgery</option>
									<option>Orthodopedic Surgery</option>
									<option>Otolaryngologic Surgery</option>
									<option>Pediatric Surgery</option>
									<option>Plastic and Reconstructive Surgery</option>
									<option>Reproductive Health Surgery</option>
									<option>Thoracic Surgery</option>
									<option>Urologic Surgery</option>
								</select> --}}
							</div>
							<div class="col-sm-3" id="Main2Sub2Name" style="display: none">
								Others (Ownership), Specify<span style="color:red">*</span>
							</div>
							<div class="col-sm-3" id="Main2Sub2DrpDown" style="display: none">
								<input type="text" id="SelectedisOthers" data-parsley-required-message="<strong>Others</strong> required." class="form-control" name="OthersSelected">
							</div>
						</div>
						<br>
					</span>
					<div class="row">
						<div class="col-sm-3" >
							
						</div>
						<div class="col-sm-3" >
							
						</div>
						<div class="col-sm-3" >
							Status of Application:<span style="color:red">*</span>
						</div>
						<div class="col-sm-3" >
							<select class="form-control" id="STATS_APP" name="strateMap" data-parsley-required-message="<strong>Status of Application</strong> required." required >
								<option value=""></option>
								@foreach ($aptyps as $aptyp)
									<option value="{{$aptyp->aptid}}">{{$aptyp->aptdesc}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4" style="margin-left:2px">
							<span>
								{{-- @foreach ($ownshs as $ownsh)
									<input class="" type="radio" name="Ownership" value="{{$ownsh->ocid}}" data-parsley-required-message="<strong>Ownership</strong> required." required> {{$ownsh->ocdesc}}
								&nbsp;&nbsp; 
								@endforeach --}}
								{{-- <input class="" type="radio" name="Ownership" value="Government" data-parsley-required-message="<strong>Ownership</strong> required." required> Government
								&nbsp;&nbsp; 
								<input class="" type="radio" name="Ownership" value="Private"> Private
								&nbsp;&nbsp;  --}}
							</span>
						</div>
						<div class="col-sm-6" >
							{{-- <span>
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel1" data-parsley-required-message="<strong>Service Capability</strong> required." value="L1" required> Level 1
									&nbsp;&nbsp; 
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel2" value="L2"> Level 2
									&nbsp;&nbsp;
									<input class="" type="radio" name="HospitalLevel" id="HospitalLevel3" value="L3"> Level 3
							</span> --}}
						</div>
					</div>
					<br>
					{{-- <div class="row">
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
						<div class="col-sm-5"  style="border-width: 2px;border-bottom-color:black; border-bottom-style: solid;" >
							<input type="text" class="form-control" data-parsley-required-message="<strong>Proposed Total Bed Capacity</strong> required." name="propTotalBedCap" required>
						</div>
					</div> --}}
					<div class="text-center">
						<a href="{{asset('client/apply/lop')}}"><button type="button" style="background-color: #228B22 !important" class="btn-primarys"><i class="fa fa-list-alt"></i>&nbsp;List of Personnel</button>
							</a>
					</div>
					<hr>
					{{-- <div class="row"><div class="col-sm-12">Attachment: (incomplete attachment shall be a ground for the denial of this application)</div></div> --}}
					<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer">Click to show CHECKLIST OF DOCUMENTS:</div>
						<div id="panel" class="container" style="display: none;background: #fff;padding: 1em;border-radius: 10px;overflow: auto;">
							<table class="attachments table table-hover" style="width: 100%;">
								<tbody id="ApplyTable">
									
									{{-- @foreach ($uplds as $upld)
										<tr>
											<td width="50%">{{$upld->updesc}}</td>
											<td>
												<input name="" class="form-control-file" id="{{$upld->upid}}" data-parsley-required-message="File required for assessment." data-parsley-max-file-size="2.5" data-parsley-trigger="change" class="form-control" type="file">
											</td>				
										</tr>
									@endforeach --}}
								</tbody>													
							</table>
						</div>
						<br>
		{{-- <div class="col-sm-12">&nbsp;&nbsp;&nbsp;I hereby declare  that this Application  has been accomplished  by me, and that the foregoing  information  and attached documents required for the permit to construct are true and correct.</div> --}}
		{{-- data-toggle="modal" data-target="#exampleModalCenter" --}}
		<div class="container">
			<center>
				<button style="background-color: #ff9600 !important" type="button" class="btn-primarys"><i class="fa fa-save"></i>&nbsp;Save as Draft</button>
				<button style="background-color: #228B22 !important" type="submit" class="btn-primarys"><i class="fa fa-send-o"></i>&nbsp;Submit</button>
			</center>
		</div>
		</div>
		<input type="text" name="numberOfUploads" hidden>
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
	loader(false);
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>
	<script type="text/javascript">
		var Number_of_Files = 0;
		function getUploads(){
			var selectedFaType = $('#HFATYPE').val();
			var GetNames = $('#'+selectedFaType+'_facid option').map(function() {return $(this).val();}).get();
			var Get_Ids = $('#'+selectedFaType+'_facid option').map(function() {return $(this).text();}).get();
			var GetRequired = $('#'+selectedFaType+'_facid option').map(function() {return $(this).attr('isrequired');}).get();
			$('#ApplyTable').empty();
			$('#ApplyTable').append('<tr><td colspan="2"><center><p><strong>Note: </strong>File should be not larger than <strong>5 MB</strong></p></td><center></tr>');
			for (var i = 0; i < Get_Ids.length; i++) {
					var id = Get_Ids[i],selectedText = GetNames[i],requirement = GetRequired[i];
					requiredOrNot = (requirement == 1) ? 'required=""' : "";
					$('#ApplyTable').append(
							'<tr>'+
								'<td width="50%">'+selectedText+'</td>'+
											'<td>'+
												'<input class="form-control-file" data-id="'+id+'" id="input'+i+'" name="upLoad[]" data-parsley-required-message="File <strong>required</strong> for assessment." data-parsley-max-file-size="5" data-parsley-trigger="change" class="form-control" type="file" '+requiredOrNot+'>'+
												'<input name="UpID[]" value="'+id+'" hidden>'+
											'</td>'	+		
							'</tr>'
						);
					Number_of_Files++;
				}
			$('input[name="numberOfUploads"]').val(Number_of_Files);
				
		}
		var Main1 = 0, Sub1 = 0, Sub2 = 0;
		var Main2 = 0, Main2Sub1 = 0, MainSub2 = 0;
		function chckOwnOther(){
			if ($('#CLS').val() == "OTHER") {
				if (MainSub2 == 0) {
					$('#Main2Sub2Name').show();
					$('#Main2Sub2DrpDown').show();
					MainSub2 = 1;
					if (Main2 == 0) {
						$('#HideLevel2').show();
						Main2 = 1;
					}
					$('#SelectedisOthers').attr("required",'');
				}
			} else {
				if (MainSub2 == 1) {
					$('#Main2Sub2Name').hide();
					$('#Main2Sub2DrpDown').hide();
					MainSub2 = 0;
				}
				if (Main2Sub1 == 0) {
					$('#HideLevel2').hide();
						Main2 = 0;
				}
				$('#SelectedisOthers').removeAttr('required');
			}
		}
		function getOwnship(){
			var selectedOwnship = $('#OWNSHP').val();
			if (selectedOwnship != "") {
				var GetNames = $('#'+selectedOwnship+'_oShip option').map(function() {return $(this).val();}).get();
				var Get_Ids = $('#'+selectedOwnship+'_oShip option').map(function() {return $(this).text();}).get();
				$('#CLS').empty();
				$('#CLS').attr("required","");
				$('#CLS').attr("data-parsley-required-message","<strong>Class</strong> required.");
				$('#CLS').append('<option value=""></option>');
				for (var i = 0; i < Get_Ids.length; i++) {
					var id = Get_Ids[i],selectedText = GetNames[i];
					$('#CLS').append(
							'<option value="'+id+'">'+selectedText+'</option>'
						);
				}
				$('#CLS').append(
							'<option value="OTHER">Others</option>'
						);
				if (Sub2 == 0) {
					$('#Main1Sub2Name').show();
					$('#Main1Sub2DrpDown').show();
					Sub2 =1;
					if (Main1 == 0) { // Show Table
						$('#HideLevel1').show();
						Main1 = 1;
					}
				}
			} else {

				if (Sub1 != 1) {
					$('#HideLevel1').hide();
					Main1 = 0;
				}
				if (Sub2 == 1) {
					$('#Main1Sub2Name').hide();
					$('#Main1Sub2DrpDown').hide();
					Sub2 = 0;
				}
				if (MainSub2 == 1) {
					$('#Main2Sub2Name').hide();
					$('#Main2Sub2DrpDown').hide();
					MainSub2 = 0;
				}
				if (Main2Sub1 == 0) {
					$('#HideLevel2').hide();
						Main2 = 0;
				}
			}

		}
		function getHospitaType(){
			// Main2Sub1Name
			// MainSub1DrpDown
		}
		function selectedHospital(){
			if (Main1 == 0) {
				$('#HideLevel1').show();
						Main1 = 1;
			}
			if (Sub1 == 0) {
				$('#Main1Sub1Name').empty();
				$('#Main1Sub1DrpDown').empty();
				$('#Main1Sub1Name').append('Type:<span style="color:red">*</span>');
				$('#Main1Sub1DrpDown').append(
						'<select class="form-control" onchange="getHospitaType()" required>' +
							'<option value=""></option>' +
							'<option value="G">General</option>' +
							'<option value="S">Specialty</option>' +
						'</select>'
					);
				Sub1 = 1;
			}
			
		}
		function getFacilityType(){
			var selectedFaType = $('#HFATYPE').val();
			var CurrentAppType = $('#CurrentAppTypeSelected').val();
			switch(selectedFaType){
				case "H":
						selectedHospital();
					break;
				case "":
					break;
				default :
						$('#Main1Sub1Name').empty();
						$('#Main1Sub1DrpDown').empty();
						Sub1 = 0;
						if (Sub2 == 0) {
							$('#HideLevel1').hide();
							Main1 = 0;
						}
					break;
			}
		}
		// $('#ApplyFoRm').on('submit',function(e){ // FOR SUBMIT
		// 	e.preventDefault();
		// 	var token = $('#global-token').val();
		// 	var form = $(this);
			
		// 	// console.log(Test);
  //           form.parsley().validate();
  //           if (form.parsley().isValid()){
  //           	var formData = new FormData();
  //           	formData.append('heatype',$('#HFATYPE').val()); // Health Facilty
  //           	formData.append('OWNSHP',$('#OWNSHP').val()); // Ownership
  //           	formData.append('CLS',$('#CLS').val()); // Class
  //           	formData.append('strateMap', $('#STATS_APP').val()); // Status of Application
  //           	formData.append('_token',$('#global-token').val()); // Token
  //           	formData.append('numOfFiles',Number_of_Files); // Number of Files
  //           	for (var i = 0; i < Number_of_Files; i++) {
  //           		formData.append('file_no_'+i, document.getElementById("input"+i).files[0]); // files
  //           		formData.append('file_no'+i+'_id',$('#input'+i).attr('data-id'));
  //           	}
  //           	$.ajax({
  //           		url: '{{ asset('/client/apply/form/') }}/{{$id_type}}',
  //           		method: 'POST',
  //           		data : formData,
  //           		enctype: 'multipart/form-data',
  //           		cache: false,
		// 	        contentType: false,
		// 	        processData: false,
		// 	        success : function(event){

		// 	        }
  //           	});
  //            } else {

  //            }
		// });
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
		    en: '<span style="color:red">This file should not be larger than <strong>5 MB</strong></span>',
		  }
		});
	</script>
@include('client.sitemap')
@endsection