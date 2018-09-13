@extends('main')
@section('content')
@include('client.nav')
@if (session()->exists('client_data') || session('client_data') != null)
   @php
     $clientData = session('client_data');
   @endphp
@else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif

@if(session('curr_tbl') != null)
 	@php
	   $curr_tbl = session('curr_tbl');
	@endphp
@endif
@php
	$sql = "SELECT seq_num, GROUP_CONCAT(hs.hfser_desc) AS h_desc, GROUP_CONCAT(hs.hfser_id) AS h_id, COALESCE(ap.appid, '0') AS don, COALESCE(ts.canapply, (CASE WHEN seq_num = '1' THEN 1 ELSE 0 END)) AS app_stat FROM hfaci_serv_type hs LEFT JOIN (SELECT * FROM appform WHERE CONCAT(hfser_id, t_date, t_time, uid) IN (SELECT CONCAT(hfser_id, MAX(t_date), MAX(t_time), uid) FROM appform WHERE uid = '$clientData->uid' GROUP BY hfser_id, uid)) ap ON ap.hfser_id = hs.hfser_id LEFT JOIN trans_status ts ON ts.trns_id = ap.status GROUP BY seq_num, ts.canapply, ap.appid ORDER BY seq_num ASC";
	$h_data = DB::select($sql);
@endphp
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
			.draftcontainer{
			  color: #1a1a1a;
			  text-align: center;
			  margin-bottom: 10px;
			}

			.draftcontent {
			  position: relative;
			  width: 90%;
			  max-width: 400px;
			  margin: auto;
			  overflow: hidden;
			}

			.draftcontent .content-overlay {
			  background: rgba(0,0,0,0.7);
			  position: absolute;
			  height: 99%;
			  width: 100%;
			  left: 0;
			  top: 0;
			  bottom: 0;
			  right: 0;
			  opacity: 0;
			  -webkit-transition: all 0.4s ease-in-out 0s;
			  -moz-transition: all 0.4s ease-in-out 0s;
			  transition: all 0.4s ease-in-out 0s;
			}

			.draftcontent:hover .content-overlay{
			  opacity: 1;
			}

			.content-details {
			  position: absolute;
			  text-align: center;
			  padding-left: 1em;
			  padding-right: 1em;
			  width: 100%;
			  top: 50%;
			  left: 50%;
			  opacity: 0;
			  -webkit-transform: translate(-50%, -50%);
			  -moz-transform: translate(-50%, -50%);
			  transform: translate(-50%, -50%);
			  -webkit-transition: all 0.3s ease-in-out 0s;
			  -moz-transition: all 0.3s ease-in-out 0s;
			  transition: all 0.3s ease-in-out 0s;
			}

			.draftcontent:hover .content-details{
			  top: 50%;
			  left: 50%;
			  opacity: 1;
			}

			.content-details span{
			  color: #fff;
			  font-weight: 500;
			  letter-spacing: 0.15em;
			  margin-bottom: 0.5em;
			  text-transform: uppercase;
			}

			.content-details p{
			  color: #fff;
			  font-size: 0.8em;
			}

			.fadeIn-bottom{
			  top: 80%;
			}
			input[type="date"]:not(.has-value):before{
			  color: lightgray;
			  content: attr(placeholder);
			}
			#regForm {
			  background-color: #ffffff;
			  margin: 100px auto;
			  padding: 40px;
			  width: 70%;
			  min-width: 300px;
			}

			/* Style the input fields */
			input {
			  padding: 10px;
			  width: 100%;
			  font-size: 17px;
			  border: 1px solid #aaaaaa;
			}

			/* Mark input boxes that gets an error on validation: */
			input.invalid {
			  background-color: #ffdddd;
			}

			/* Hide all steps by default: */
			.tab {
			  display: none;
			}

			/* Make circles that indicate the steps of the form: */
			.step {
			  height: 15px;
			  width: 15px;
			  margin: 0 2px;
			  background-color: #bbbbbb;
			  border: none; 
			  border-radius: 50%;
			  display: inline-block;
			  opacity: 0.5;
			}

			/* Mark the active step: */
			.step.active {
			  opacity: 1;
			}

			/* Mark the steps that are finished and valid: */
			.step.finish {
			  background-color: #4CAF50;
			}

</style>
<input type="text" id="CurrentAppTypeSelected" hidden="" value="{{$id_type}}">

<script type="text/javascript">
	  	loader(true);
</script>
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	  	document.getElementById('first').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>

@if(session()->has('del_succes'))
<div id="asdf" class="alert alert-info alert-dismissible fade show" role="alert">
					  <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('del_succes')}}</center>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
@endif
@if(session()->has('draft_error'))
<div id="asdf" class="alert alert-danger alert-dismissible fade show" role="alert">
					  <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('draft_error')}}</center>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
@endif

@if (session()->has('apply_succes'))
			{{--Notice--}}
			{{-- <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content" style="border-radius: 0px;border: none;">
			      <div class="modal-body text-justify" style=" background-color: #0f8845;
			    color: white;">
			    	<div id="asdf" class="alert alert-info alert-dismissible fade show" role="alert">
					  <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('apply_succes')}}</center>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
			         <h5 class="modal-title text-center" id="exampleModalLongTitle"><strong>Thank You for uploading your requirements.</strong></h5>
			        <hr>
			        <p>Our Licensing Officer (LO) is now reviewing and evaluating the completeness of the documents that you've submitted and please wait within the day (8:00 am - 5:00 pm working hour).</p>
				        <div class="alert alert-primary" role="alert">
							<p class="alert-heading"><i class="far fa-sticky-note"></i> Note:</p>
							<p>&nbsp;- Proceed to Cashier for payment and submit a photocopy of official receipt to the Licensing Officer;</p>
							<p>&nbsp;- Team Leader sets Schedule for Inspection (you may check through your online account)</p>
						</div>
						
						<div class="text-center">
						<a href="{{asset('client/orderofpaymentc')}}" style="text-decoration: none;"><button class="btn btn-outline-success btn-block">Ok</button></a>
						</div> 
			      </div>
			    </div>
			  </div>
			</div> --}}
@endif

<script type="text/javascript">
		function remLd() { 
			$('#exampleModalCenter').modal('show', {backdrop: 'static', keyboard: false});
			setTimeout(function(){ $('#asdf').fadeOut(500); }, 3000);
		 };
		remLd();
	</script>
				<div class="row" style="margin-top: 20px;">
				<div class="col-sm-6"></div>
				<div class="col-sm-6 text-center">
					 <div class="dropdown ">
					  <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-list"></i>&nbsp;Application Type
					  </button>
					  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
					  	@if(count($h_data) > 0)
					  		@for($i = 0; $i < count($h_data); $i++)
					  			<?php $h_desc = explode(',', $h_data[$i]->h_desc); $h_id = explode(',', $h_data[$i]->h_id); $k = ((($i-1) < 0) ? $i : (($h_data[($i-1)]->don == '0') ? $i : ($i-1))); ?>
					  			@if(count($h_desc) > 1)
						  			@for($j = 0; $j < count($h_desc); $j++)
									    {{-- <a class="dropdown-item" @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="{{ asset('/client/view/form') }}/{{strtolower($h_data[$i]->h_id)}}" @endif @else @if($h_data[$k]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="#" @endif @endif style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{$h_desc[$j]}} ({{$h_id[$j]}})</small></a> --}}
									    <a class="dropdown-item" href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" style="border-bottom: 1px solid rgba(0,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{$h_desc[$j]}} ({{$h_id[$j]}})</small></a>
						  			@endfor
						  		@else 
						  			{{-- <a class="dropdown-item" @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="{{ asset('/client/view/form') }}/{{strtolower($h_data[$i]->h_id)}}" @endif @else @if($h_data[$k]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="#" @endif @endif style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>{{$h_data[$i]->h_desc}} ({{$h_data[$i]->h_id}})</small></a> --}}
						  			<a class="dropdown-item" href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" style="border-bottom: 1px solid rgba(0,0,0,.2);"><small>{{$h_data[$i]->h_desc}} ({{$h_data[$i]->h_id}})</small></a>
						  		@endif
					  		@endfor
						@else
						@endif
					  </div>
					</div>
				</div>
			</div>
		<div class="jumbotron container" style="background-color: #fff;border: 1px solid rgba(0,0,0,.2);border-top: 2px solid #28a745;padding: 2rem 2rem;margin-top: 1%;padding-bottom: 7%;box-shadow: -5px 5px 10px rgba(0,0,0,0.25)">
			<div class="title"  style="text-align: center;border-bottom: 1px solid green;padding-bottom: 9px;position: relative;margin-bottom: 2%;"> 
			<h3>APPLICATION FORM</h3>
			{{-- div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
			  <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o"></i>Application for change</button>
			  <button type="button" class="btn btn-secondary"><i class="fa fa-history"></i>Revision of History</button>
			</div> --}}
			</div>

	<form @if($isview == false) action="{{ asset('/client/apply/form/') }}/{{$id_type}}"  data-parsley-validate enctype="multipart/form-data"  method="post" data-parsley-validate id="ApplyFoRm" @endif>
		<input type="" name="_token" value="{{csrf_token()}}" hidden>
		<div class="col-sm-12"><center><h4>{{$hfaci}}</h4></center></div>
		<br>
		@if(session()->exists('curr_tbl') && session('curr_tbl') != null && $curr_tbl != null)
			<input type="hidden" name="appid" id="appidinc" value="{{ $curr_tbl[0]->appid }}">
		@else
			<input type="hidden" name="appid" id="appidinc" value="{{ $appidinc }}">
		@endif
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
							<strong>{{$clientData->brgyname}}</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-2">
							City/Municipality : 
						</div>
						<div class="col-sm-3">
							<strong>{{$clientData->cmname}}</strong>
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
							<select @if($isview == true) disabled @endif class="form-control" id="HFATYPE" name="facid" onchange="{{--getFacilityType();--}}getUploads()" data-parsley-required-message="<strong>Health Facility</strong> required." required>
								<option value="" hidden></option>
								@foreach ($fatypes as $fatype)
									<option value="{{$fatype->facid}}">{{$fatype->facname}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-3" >
							Ownership:<span style="color:red">*</span>
						</div>
						<div class="col-sm-3" >
							<select @if($isview == true) disabled @endif class="form-control" id="OWNSHP" name="OWNSHP" data-parsley-required-message="<strong>Ownership</strong> required." onchange="getOwnship();" required>>
								<option value="" hidden></option>
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
								<select @if($isview == true) disabled @endif class="form-control" id="CLS" name="CLS" onchange="chckOwnOther();">
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
							<select @if($isview == true) disabled @endif class="form-control" id="STATS_APP" name="strateMap" data-parsley-required-message="<strong>Status of Application</strong> required." required >
								<option value="" hidden></option>
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
						<div  data-toggle="collapse" data-target="#collapseExample" class="form-control bg-primary" aria-expanded="false" aria-controls="collapseExample" style="color: #fff;cursor:pointer;" class="btn btn-block"><i class="fa fa-plus"></i>&nbsp;Add Personnel</div>
					</div>
					<div class="collapse" id="collapseExample">
					  <div class="card card-body">
					  <form id="regForm">
					  	<input type="hidden" name="_token" id="reg_csrf-token" value="{{ Session::token() }}" />
						<div class="tab">
							
							<div class="container">
								<h3>Profile</h3>
				            <div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="lname" placeholder="Last Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="mname" placeholder="Middle Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="fname" placeholder="First Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-sm-6">
				                       <input type="date" name="bod" placeholder="Birthdate " style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;" onchange="this.className=(this.value!=''?'has-value':'')">
				                    </div>
				            	<div class="col-sm-6">
				                        <select id="gender" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Gender</option>
				                        	<option>Female</option>
				                        	<option>Male</option>
				                        </select>
				            </div>
				        </div>
				        </div>
						</div>
						<div class="tab">
							
							<div class="container">
								<h3>Work</h3>
                       		<div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                         <select name="posid" id="posid" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Position</option>
				                        	@foreach ($position as $positions)
												<option value="{{$positions->posid}}">{{$positions->posname}}</option>
											@endforeach
				                        </select>
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                         <select name="secid" id="secid"style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Section</option>
				                        	@foreach ($section as $sections)
												<option value="{{$sections->secid}}">{{$sections->secname}}</option>
											@endforeach
				                        </select>
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                         <select name="depid" id="depid" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Department</option>
				                        	@foreach ($department as $departments)
												<option value="{{$departments->depid}}">{{$departments->depname}}</option>
											@endforeach
				                        </select>
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                
				            </div>
				             <div class="row">
				            	<div class="col-sm-6"><input type="date" name="assigneddate" placeholder="Assigned Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;" onchange="this.className=(this.value!=''?'has-value':'')"></div>
								<div class="col-sm-6"><input type="date" name="enddate" placeholder="End Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;" onchange="this.className=(this.value!=''?'has-value':'')"></div>
				        </div>
				        </div>
						</div>

						<div class="tab">
							
							<div class="container">
								<h3>Eligibility</h3>
                    		<div class="row">
                    			<div class="col-sm-3"></div>
                    			<div class="col-sm-6">
				                        <div class="text-center"><button type="button" style="background-color:#28a745 ; " class="btn-primarys" onclick="add()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button type="button" class="btn-primarys" onclick="removeClone()"><i class="fa fa-undo"></i>Reset</button></div>
				                        <br>	
				                        <div id="other">
				                        	<div id="cloneOther" name = "eligibility">
							                    <select name="plid" id="plid" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
						                        	<option disabled selected hidden>PRC ID</option>
						                        	@foreach ($plicensetype as $plicensetypes)
														<option value="{{$plicensetypes->plid}}">{{$plicensetypes->pldesc}}</option>
													@endforeach
						                        </select>
							                    <input type="date" name="expiration" placeholder="Licensed ID Expiration Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							                    <hr>
							                </div>
				                        </div>
                    			</div>
                    			<div class="col-sm-3"></div>
                    		</div>
                    	</div>
						</div>

						<div class="tab">

							<div class="container">
								<h3>Trainings</h3>

				        <div class="text-center"><button style="background-color:#28a745 ; " type="button" class="btn-primarys" onclick="add1()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button type="button" class="btn-primarys" onclick="removeClone1()"><i class="fa fa-undo"></i>Reset</button></div>
				        <br>
				        <div id="other1">
				          	<div id="cloneOther1" name = "trainings">
				          		 <select name="ptid" id="ptid" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
						         	<option disabled selected hidden>Trainings</option>
						         	@foreach ($traintype as $traintypes)
										<option value="{{$traintypes->tt_id}}">{{$traintypes->ptdesc}}</option>
									@endforeach
						         </select>
							     <input type="text" name="school" placeholder="School" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							      <input type="text" name="course" placeholder="Course" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <input type="date" name="datestart" placeholder="Date started" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							      <input type="date" name="datefinish" placeholder="Date finished" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <hr>
							 </div>
				        </div>
				        </div>
						</div>
						<div style="margin-top: 4%;" class="text-center">
						    <button type="button" id="prevBtn" onclick="nextPrev(-1)" style="background-color: #228B22 !important" class="btn-primarys"><i class="fa fa-angle-double-left"></i> Previous</button>
						    <button type="button" id="nextBtn" onclick="nextPrev(1)" style="background-color: #228B22 !important" class="btn-primarys">Next <i class="fa fa-angle-double-right"></i></button>
						</div>

						<!-- Circles which indicates the steps of the form: -->
						<div style="text-align:center;margin-top:40px;">
						  <span class="step"></span>
						  <span class="step"></span>
						  <span class="step"></span>
						  <span class="step"></span>
						</div>

						</form>
						<div class="card" style="height: 500px;margin-bottom: 2%;">
				  			<div class="card-header text-center" style="background-color: #5bc0de !important;color: #fff;">
				  			List Of Personnel
				  			</div>
				  			<div class="card-body">
				  				<div class="table-responsive">
				  			<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody id="personnels">
									<tr><td colspan="3">No records yet.</td></tr>
									{{-- <tr>
										<td>Juan Dela Cruz</td>
										<td>Gynecologist</td>
										<td>
											<button class="btn btn-info"><i class="fa fa-eye"></i></button>
										</td>
									</tr> --}}
								</tbody>
							</table>
							</div>
				  		</div>
				  		</div>
						<script type="text/javascript">
							var currentTab = 0; // Current tab is set to be the first tab (0)
							showTab(currentTab); // Display the current tab

							function showTab(n) {
							  // This function will display the specified tab of the form ...
							  var x = document.getElementsByClassName("tab");
							  x[n].style.display = "block";
							  // ... and fix the Previous/Next buttons:
							  if (n == 0) {
							    document.getElementById("prevBtn").style.display = "none";
							  } else {
							    document.getElementById("prevBtn").style.display = "inline";
							  }
							  if (n == (x.length - 1)) {
							    document.getElementById("nextBtn").innerHTML = "<i class='fa fa-plus-circle'></i> Add";
							    document.getElementById("nextBtn").onclick = function(){ addpersonnel(this.event); };
							  } else {
							    document.getElementById("nextBtn").innerHTML = "Next <i class='fa fa-angle-double-right'></i>";
							    document.getElementById("nextBtn").onclick = function(){ nextPrev(1); };
							  }
							  // ... and run a function that displays the correct step indicator:
							  fixStepIndicator(n)
							}

							function nextPrev(n) {
							  // This function will figure out which tab to display
							  var x = document.getElementsByClassName("tab");
							  // Exit the function if any field in the current tab is invalid:
							  if (n == 1 && !validateForm()) return false;
							  // Hide the current tab:
							  x[currentTab].style.display = "none";
							  // Increase or decrease the current tab by 1:
							  currentTab = currentTab + n;
							  // if you have reached the end of the form... :
							  if (currentTab >= x.length) {
							    //...the form gets submitted:

							    return false;
							  }
							  // Otherwise, display the correct tab:
							  showTab(currentTab);
							}

							function validateForm() {
							  // This function deals with validation of the form fields
							  var x, y, i, valid = true;
							  x = document.getElementsByClassName("tab");
							  y = x[currentTab].getElementsByTagName("input");
							  // A loop that checks every input field in the current tab:
							  for (i = 0; i < y.length; i++) {
							    // If a field is empty...
							    if (y[i].value == "") {
							      // add an "invalid" class to the field:
							      y[i].className += " invalid";
							      // and set the current valid status to false:
							      valid = false;
							    }
							  }
							  // If the valid status is true, mark the step as finished and valid:
							  if (valid) {
							    document.getElementsByClassName("step")[currentTab].className += " finish";
							  }
							  return valid; // return the valid status
							}

							function fixStepIndicator(n) {
							  // This function removes the "active" class of all steps...
							  var i, x = document.getElementsByClassName("step");
							  for (i = 0; i < x.length; i++) {
							    x[i].className = x[i].className.replace(" active", "");
							  }
							  //... and adds the "active" class to the current step:
							  x[n].className += " active";
							}
						</script>
					</div>
					</div>
					<hr>
					{{-- <div class="row"><div class="col-sm-12">Attachment: (incomplete attachment shall be a ground for the denial of this application)</div></div> --}}
					<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer;">Click to show CHECKLIST OF DOCUMENTS:</div>
						<div id="panel" class="container" style="background: #fff;padding: 1em;border-radius: 10px;overflow: auto;">
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
						<input type="hidden" name="draft">
		{{-- <div class="col-sm-12">&nbsp;&nbsp;&nbsp;I hereby declare  that this Application  has been accomplished  by me, and that the foregoing  information  and attached documents required for the permit to construct are true and correct.</div> --}}
		{{-- data-toggle="modal" data-target="#exampleModalCenter" --}}
		@if($isview == false)
			<div class="container">
				<div class="row">
					<div class="col-sm-4"></div>
				<div class="col-sm-2">
					<button onmouseover="document.getElementsByName('draft')[0].value = ((document.getElementsByName('draft')[0].value == '0') ? '1': document.getElementsByName('draft')[0].value);" type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#savedrafts"><i class="fa fa-save"></i>&nbsp;Save as Draft</button>				
				</div>
				<div class="col-sm-2"><button  type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#confirmmodal"><i class="fa fa-send-o"></i>&nbsp;Submit</button></div>
				<div class="col-sm-4"></div>
				</div>
					<div class="modal fade" id="confirmmodal" role="dialog">
				    <div class="modal-dialog modal-sm">
				      <div class="modal-content">
				        <div class="modal-body text-center">
				        	Are you sure you want to submit?
				        	<button type="submit" class="btn btn-primary" onmouseover="document.getElementsByName('draft')[0].value = '0';" data-toggle="modal" data-target="#exampleModalCenter">Yes</button>
				          	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				        </div>
				      </div>
				    </div>
				  </div>
			</div>
		@endif
		</div>
		<input type="text" name="numberOfUploads" hidden>
		</form>
		@if($isview == false)
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
			<button style="margin-top: 10px;" data-toggle="modal" data-target="#draftmodal" class="btn btn-primary btn-block"><i class="fa fa-file"></i>&nbsp;Open recent Drafts</button>
				</div>
				<div class="col-sm-4"></div>
			</div>
		@endif
			</div>
		 @if($isview == false)
			  <div class="modal fade" id="draftmodal" role="dialog">
			    <div class="modal-dialog modal-lg">
			      <div class="modal-content">
			        <div class="modal-header">
			        	<h4 class="modal-title">Choose Saves Drafts</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			         	<div class="row">
			         		@foreach($appform as $appforms)
			         		<div class="col-sm-4">
				         				<div class="draftcontainer" >
				         					{{$appforms->draft}}.txt
										  <div class="draftcontent" style="border: 1px solid rgba(0,0,0,.2);">
										      <div class="content-overlay"></div>
										      <div class="content-body" >
										     	<img style="width: 100%;" src="{{asset('ra-idlis/public/img/draft.png')}}">
										  	  </div>
										      <div class="content-details fadeIn-bottom">
										        <a href="{{ asset('client/apply/form') }}/{{$id_type}}/{{ $appforms->draft }}" ><i class="fa fa-eye" style="font-size: 30px;color: #fff;"></i></a>
										        <a href="{{ asset('client/deleteform') }}/{{ $appforms->appid }}"><i class="fa fa-trash-o" style="font-size: 30px;color: #fff;"></i></a>
										        <p>Date: {{ $appforms->t_date }} {{ $appforms->t_time }}</p>
										      </div>
										  </div>
										</div>
			         		</div>
			         		@endforeach
			         	</div> 
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			    </div>
			  </div>
		@endif

@if($isview == false)
	<div id="savedrafts" class="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Save as</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <label>Save name as</label>
	        <input id="draftchg" type="text" onkeyup="keyyy()" class="form-control">
	        <script type="text/javascript">
	        	function keyyy() {
	        		var e = window.event || e;
	        		if(e.keyCode > 64 && e.keyCode <91) { document.getElementsByName('draft')[0].value = document.getElementById('draftchg').value; }
	        	}
	        </script>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" form="ApplyFoRm">Save changes as</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
@endif
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
				$('#CLS').append('<option value="" hidden></option>');
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
							'<option value="" hidden></option>' +
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
		<script>
			var i = 0;
			var i_last = 0;
			var original = document.getElementById('cloneOther');
			var cloneother = document.getElementById('other');
			var original1 = document.getElementById('cloneOther1');
			var cloneother1 = document.getElementById('other1');

			function add() {
				var clone = original.cloneNode(true); // "deep" clone
				clone.id = 'clone' + i;
				clone.name = "eligibility";
				clone.classList.add("removeClone");
															    // or clone.id = ""; if the divs don't need an ID
				cloneother.appendChild(clone);
				i++;
			}
			function removeClone(){
				for(j = i_last; j < i; j++){
					document.getElementById('other').removeChild(document.getElementById('clone' + j));
				}
				i_last = i;
			}
			function add1() {
				var clone = original1.cloneNode(true); // "deep" clone
				clone.id = 'clone' + i;
				clone.name = "trainings";
				clone.classList.add("removeClone");
															    // or clone.id = ""; if the divs don't need an ID
				cloneother1.appendChild(clone);
				i++;
			}
			function removeClone1(){
				for(j = i_last; j < i; j++){
					document.getElementById('other1').removeChild(document.getElementById('clone' + j));
				}
				i_last = i;
			}
			function addpersonnel(e){
				var id_type = document.getElementById('appidinc').value;
	        	document.getElementById('nextBtn').innerHTML = "Saving <img style='max-height: 48px;' src='{{ asset('ra-idlis/public/img/load.gif') }}'>";
	                var token = $("#reg_csrf-token").val();
	                var lastname = $('input[name="lname"]').val();
	                var firstname = $('input[name="fname"]').val();
	                var middlename = $('input[name="mname"]').val();
	                var birthdate = $('input[name="bod"]').val();
	                var gender = $('#gender').val();
	                var appid = id_type;
	                var position = $('#posid').val();
	                var department = $('#depid').val();
	                var section = $('#secid').val();
	                var assigneddate = $('input[name="assigneddate"]').val();
	                var enddate = $('input[name="enddate"]').val();
	               $.ajax({
			          url: "{{asset('/client/personnel/form')}}/personnel",
			          method: 'POST',
			          data: {
			          	_token : token,
			          	lastname : lastname,
			          	firstname : firstname,
			          	middlename : middlename,
			          	birthdate : birthdate,
			          	gender : gender,
			          	appid : appid,
			          	position : position,
			          	department : department,
			          	section : section,
			          	assigneddate : assigneddate,
			          	enddate : enddate
			          },
			          success: function(data) {
			       		maoba();
			          }
			      });
	               function maoba() {
	               		var sdf = ""; var sdfg = "";
			          for(var i = 0; i < document.getElementsByName('eligibility').length; i++) {     
			               $.ajax({
					          url: "{{asset('/client/personnel/form')}}/eligibility",
					          method: 'POST',
					          data: {
			          			 _token : token,
					          	 plid : document.getElementsByName('eligibility')[i].getElementsByTagName('select')[0].value,
					          	 expiration : document.getElementsByName('eligibility')[i].getElementsByTagName('input')[0].value,
					          },
					          success: function(data) {
					       		sdf = data;
					       		tsadf();
					          }
					      });
			          }
			          for(var i = 0; i < document.getElementsByName('trainings').length; i++) {   
			               $.ajax({
					          url: "{{asset('/client/personnel/form')}}/trainings",
					          method: 'POST',
					          data: {
					          	  _token : token,
					          	  tt_id : document.getElementsByName('trainings')[i].getElementsByTagName('select')[0].value,
					          	  school : document.getElementsByName('trainings')[i].getElementsByTagName('input')[0].value,
					          	  course : document.getElementsByName('trainings')[i].getElementsByTagName('input')[1].value,
					          	  datestart : document.getElementsByName('trainings')[i].getElementsByTagName('input')[2].value,
					          	  datefinish : document.getElementsByName('trainings')[i].getElementsByTagName('input')[3].value
					          },
					          success: function(data) {
					       		sdfg = data;
					       		tsadf();
					          }
					      });
			          }

			          function tsadf() {
			          	if(sdf != "" && sdfg != "") {
			          		get_pform(document.getElementById('appidinc').value);
			          		document.getElementById("nextBtn").innerHTML = "<i class='fa fa-plus-circle'></i> Add";
							document.getElementById("nextBtn").onclick = function(){ addpersonnel(this.event); };
			          	} else {
			          	}
			          }
			        }
	        }
	        function get_pform(id_type) {
	        	$.ajax({
			          url: "{{asset('/client/personnel/form')}}/"+id_type,
			          method: 'GET',
			          success: function(data) {
			          	var extract = JSON.parse(data);
			          	document.getElementById('personnels').innerHTML = "";
			          	if(extract.length > 0) {
				          	for(var i = 0; i < extract.length; i++) {
				          		document.getElementById('personnels').innerHTML += '<tr><td>'+extract[i]['firstname']+' '+extract[i]['middlename']+' '+extract[i]['lastname']+'</td><td>'+extract[i]['posname']+'</td><td><button type="button" class="btn btn-danger" onclick="delete_pfrom(\''+extract[i]['pid']+'\')"><i class="fa fa-times"></i></button></td></tr>';
				          	}
				        } else {
				        	document.getElementById('personnels').innerHTML = '<tr><td colspan="3">None</td></tr>';
				        }
			          }
			      });
	        }
	        function delete_pfrom(id_type) {
	        	$.ajax({
			          url: "{{asset('/client/personnel/delete')}}/"+id_type,
			          method: 'GET',
			          success: function(data) {
						get_pform(document.getElementById('appidinc').value);
			          }
			      });
	        }
			get_pform(document.getElementById('appidinc').value);			
													</script>
@if(session()->exists('curr_tbl') && session('curr_tbl') != null && $curr_tbl != null)
	<script>function tae(num) { var i = num; if(document.getElementById('HFATYPE').options[i].value == "{{$curr_tbl[0]->facid}}") { document.getElementById('HFATYPE').selectedIndex = i; } else { i++; tae(i); } } tae(0);</script>
	<script>function tae1(num) { var i = num; if(document.getElementById('OWNSHP').options[i].value == "{{$curr_tbl[0]->ocid}}") { document.getElementById('OWNSHP').selectedIndex = i; getOwnship(); } else { i++; tae1(i); } } tae1(0);</script>
	<script>function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$curr_tbl[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0);</script>
	<script>function tae3(num) { var i = num; if(document.getElementById('STATS_APP').options[i].value == "{{$curr_tbl[0]->aptid}}") { document.getElementById('STATS_APP').selectedIndex = i; } else { i++; tae3(i); } } tae3(0);</script>
@else
	@if($isview == true)
		<script>function tae(num) { var i = num; if(document.getElementById('HFATYPE').options[i].value == "{{$sendform[0]->facid}}") { document.getElementById('HFATYPE').selectedIndex = i; } else { i++; tae(i); } } tae(0);</script>
		<script>function tae1(num) { var i = num; if(document.getElementById('OWNSHP').options[i].value == "{{$sendform[0]->ocid}}") { document.getElementById('OWNSHP').selectedIndex = i; getOwnship(); } else { i++; tae1(i); } } tae1(0);</script>
		<script>function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$sendform[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0);</script>
		<script>function tae3(num) { var i = num; if(document.getElementById('STATS_APP').options[i].value == "{{$sendform[0]->aptid}}") { document.getElementById('STATS_APP').selectedIndex = i; } else { i++; tae3(i); } } tae3(0);</script>
	@endif
@endif
@if(session()->exists('curr_tbl') && session('curr_tbl') != null && $curr_tbl != null)
	@foreach($curr_tbl[1] AS $sentform)
		<script>getUploads(); getOwnship();function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$curr_tbl[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0); console.log("{{asset('ra-idlis/storage/app/public/uploaded')}}/{{$sentform->filepath}}"); get_pform(document.getElementById('appidinc').value)</script>
	@endforeach
@else
	@if($isview == true)
		@foreach($sendform[1] AS $sentform)
			<script>getUploads(); getOwnship();function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$sendform[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0); console.log("{{asset('ra-idlis/storage/app/public/uploaded')}}/{{$sentform->filepath}}"); get_pform(document.getElementById('appidinc').value)</script>
		@endforeach
	@endif
@endif
<script type="text/javascript">
@if(session()->exists('curr_tbl') && session('curr_tbl') != null && $curr_tbl != null)
	function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$curr_tbl[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0);
@else
	@if($isview == true)
		function tae2(num) { var i = num; if(document.getElementById('CLS').options[i].value == "{{$sendform[0]->classid}}") { document.getElementById('CLS').selectedIndex = i; } else { i++; tae2(i); } } tae2(0);
	@endif
@endif	
</script>					
<hr>
@include('client.sitemap')
@endsection