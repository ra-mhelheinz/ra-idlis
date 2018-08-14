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

@include('client.breadcrumb')

<script type="text/javascript">
	document.getElementById('third').style = "color: blue;";
</script>
<div class="jumbotron container" style="margin-top: 2%;border: 1px solid rgba(0,0,0,.2);margin-top: 2%;;background-color: #fff">
	<div class="text-center" hidden><h3>Your Application is not yet evaluated.</h3></div>
		<div class="container" >
			<div class="table-responsive">
				<table class="table" style="width: 100%;">
					<thead>
						<tr>
							<td style="width: 50%;">
								<h4>{{$clientData->facilityname}},{{$clientData->streetname}}</h4>

							</td>
							<td style="width: 50%;" class="text-center">
								<h4>DOH Evaluation Status</h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td >
								<font>
									1. Acknowledgement (Notarized)
								</font>
							</td>
							<td>
								<center>
									<i class="fa fa-times" style="color: red;"></i>
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr>
				<div class="container row">
					<div class="col-sm-6" >
							<label>Recommended for Inspection:</label>
							<!-- data-toggle="modal" data-target="#exampleModalCenter" -->
							<strong><label style="color:green;">&nbsp;</label></strong>
					</div>	
					<div class="col-sm-6">
						<span>
							<label class="form-inline">Proposed Date of Inspection:
							<strong><label style="color:green;">&nbsp;</label></strong>
						</span>
					</div>		
				</div>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center"><button class="btn-primarys"></button></div>
					<div class="col-sm-4"></div>
				</div>
		</div>	
	</div>
	<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" style="border-radius: 0px;border: none;">
	      <div class="modal-body">
	        <div>
	        	<h6 class="modal-title text-center" id="exampleModalLongTitle"><strong>Republic of the Philippines</strong></h6>
	        </div>
	        <hr>
	        <center><h6>Order of Payment</h6></center>
	        <div class="modal-footer">
		    	<button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</button>
		    	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Close</button>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>
	@include('client.sitemap')
@endsection