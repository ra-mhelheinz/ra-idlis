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

</style>
<input type="text" id="CurrentAppTypeSelected" hidden="" value="{{$id_type}}">

<script type="text/javascript">
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

	<form action="{{ asset('/client/apply/form/') }}/{{$id_type}}"  data-parsley-validate enctype="multipart/form-data"  method="post" data-parsley-validate id="ApplyFoRm">
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
							<select class="form-control" id="HFATYPE" name="facid" onchange="{{--getFacilityType();--}}getUploads()" data-parsley-required-message="<strong>Health Facility</strong> required." required>
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
							<select class="form-control" id="OWNSHP" name="OWNSHP" data-parsley-required-message="<strong>Ownership</strong> required." onchange="getOwnship();" required>>
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
						<button type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="background-color: #5bc0de !important" class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add Personnel</button>
					</div>
					<div class="collapse" id="collapseExample">
					  <div class="card card-body">
					             <ul id="tabsJustified" class="nav nav-tabs">
                    <li class="nav-item"><a href="" data-target="#profile" data-toggle="tab" class="nav-link small text-uppercase active">Profile</a></li>
                    <li class="nav-item"><a href="" data-target="#work" data-toggle="tab" class="nav-link small text-uppercase ">Work</a></li>
                    <li class="nav-item"><a href="" data-target="#eligibility" data-toggle="tab" class="nav-link small text-uppercase">Eligibility</a></li>
                    <li class="nav-item"><a href="" data-target="#trainings" data-toggle="tab" class="nav-link small text-uppercase">Trainings</a></li>
                </ul>
                <br>
                <div id="tabsJustifiedContent" class="tab-content">
                    <div id="profile" class="tab-pane fade active show">
                         <form id="contact-form" method="post" role="form">
                         	<div class="container">
				            <div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Last Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Middle Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="First Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-sm-6">
				                       <input type="date" name="" placeholder="Birthday" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                    </div>
				            	<div class="col-sm-6">
				                        <select style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Gender</option>
				                        	<option>Female</option>
				                        	<option>Male</option>
				                        </select>
				            </div>
				        </div>
				        </div>
   						 </form>
                    </div>
                    <div id="work" class="tab-pane fade">
                    	<div class="container">
                       		<div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Position" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Department" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Section" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				             <div class="row">
				            	<div class="col-sm-6"><input type="date" name="" placeholder="Assigned Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
								<div class="col-sm-6"><input type="date" name="" placeholder="End Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
				        </div>
				        </div>
                    </div>
                    <div id="eligibility" class="tab-pane fade">
                    	<div class="container">
                    		<div class="row">
                    			<div class="col-sm-3"></div>
                    			<div class="col-sm-6">
                    				<input type="text" name="" placeholder="PRC ID" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                    <input type="date" name="" placeholder="Expiration/Validity Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div style="margin-top: 5%;margin-bottom: 5%;"></div>
				                        <div class="text-center"><button style="background-color:#28a745 ; " class="btn-primarys" onclick="add()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button class="btn-primarys" onclick="removeClone()"><i class="fa fa-undo"></i>Reset</button></div>
				                        <br>	
				                        <div id="other">
				                        	<div id="cloneOther">
							                    <input type="text" name="" placeholder="Other Licensed ID" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							                    <input type="date" name="" placeholder="Licensed ID Expiration Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							                    <hr>
							                </div>
				                        </div>
                    			</div>
                    			<div class="col-sm-3"></div>
                    		</div>
                    	</div>
                    </div>
                    <div id="trainings" class="tab-pane fade">
                         	<div class="container">
                       		<div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="School Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Year Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Course" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				             <div class="row">
				            	<div class="col-sm-12"><input type="text" name="" placeholder="Masteral School" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
								<div class="col-sm-12"><input type="text" name="" placeholder="Masteral Course" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
				               <div class="col-sm-12"><input type="text" name="" placeholder="Year Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div> 

				        </div>
				        <br>
				        <div class="text-center"><button style="background-color:#28a745 ; " class="btn-primarys" onclick="add1()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button class="btn-primarys" onclick="removeClone1()"><i class="fa fa-undo"></i>Reset</button></div>
				        <br>
				        <div id="other1">
				          	<div id="cloneOther1">
							     <input type="text" name="" placeholder="School" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <input type="text" name="" placeholder="Training" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <input type="date" name="" placeholder="Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <hr>
							 </div>
				        </div>
				        </div>
                    </div>
                </div>
                <button type="button" class="btn-defaults" style="color: #fff;background-color: #28a745;margin-top: 20px;"><i class="fa fa-plus"></i> Add</button>
                <div class="card" style="margin-top: 5%;">
                	<div class="card-header" style="background-color: #5bc0de;color: #fff;"><i class="fa fa-list"></i> List of Personnel</div>
		                <table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Position</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td><button class="btn btn-info"><i class="fa fa-eye"></i></button><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
								</tr>
							</tbody>
						</table>
				</div>
					  </div>
					</div>
					<hr>
					{{-- <div class="row"><div class="col-sm-12">Attachment: (incomplete attachment shall be a ground for the denial of this application)</div></div> --}}
					<div id="flip" class="form-control text-center btn-primary" style="cursor:pointer">Click to show CHECKLIST OF DOCUMENTS:</div>
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
		<div class="container">
			<center>
				<button onmouseover="document.getElementsByName('draft')[0].value = ((document.getElementsByName('draft')[0].value == '0') ? '1': document.getElementsByName('draft')[0].value);" style="background-color: #ff9600 !important" type="button" class="btn-primarys" data-toggle="modal" data-target="#savedrafts"><i class="fa fa-save"></i>&nbsp;Save as Draft</button>
				<button onmouseover="document.getElementsByName('draft')[0].value = '0';" style="background-color: #228B22 !important" type="submit" class="btn-primarys"><i class="fa fa-send-o"></i>&nbsp;Submit</button>
			</center>
		</div>
		</div>
		<input type="text" name="numberOfUploads" hidden>
		</form>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
				<button style="margin-top: 10px;" data-toggle="modal" data-target="#draftmodal" class="btn-primarys btn-block"><i class="fa fa-file"></i>&nbsp;Open recent Drafts</button>
					</div>
					<div class="col-sm-4"></div>
				</div>
				</div>
		{{--Notice--}}
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
										        <a href="" ><i class="fa fa-eye" style="font-size: 30px;color: #fff;"></i></a>
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
@include('client.sitemap')
@endsection