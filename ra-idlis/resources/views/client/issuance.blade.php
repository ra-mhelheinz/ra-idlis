@extends('main')
@section('content')
@include('client.nav')
		<div class="container">
			<div class="modal-dialog modal-lg">
		      <div class="modal-content container">   
		      	<div class="modal-heading">
		      		<div class="container" style="padding: 2% 2% 2% 2%;">
						<div class="row">
							<div class="col-lg-12" style="position:absolute;">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="height: auto; width:100px;">
							</div>
							<div class="col-lg-12 text-center">
								
								<h6>Republic of the Philippines</h6>
								<h6>DEPARTMENT OF HEALTH</h6>
								<h1>LICENSE TO OPERATE</h1>
							</div>
						</div>
					</div>
		      	</div>
		        <!-- Modal body -->
		        <div class="modal-body">
		          <div class="row" style="margin-right: 10%;margin-left:10%;">
		          	<div class="col-md-6">Name of Facility:</div>
		          	<div class="col-md-6">ABC Hospital</div>
		          	<hr>
		          	<div class="col-md-6">Type of Facility:</div>
		          	<div class="col-md-6">Hospital</div>
		          	<hr>
		          	<div class="col-md-6">Location:</div>
		          	<div class="col-md-6">Rizal St., Manila</div>
		          	<hr>
		          	<div class="col-md-6">Classification:</div>
		          	<div class="col-md-6">Level 1</div>
		          	<hr>
		          	<div class="col-md-6">License No:</div>
		          	<div class="col-md-6">04A-0080-HP-2</div>
		          	<hr>
		          	<div class="col-md-6">Validity:</div>
		          	<div class="col-md-6">1 January – 31 December 2018 </div>
		          	<hr>
		          	<div class="col-md-6">Service:</div>
		          	<div class="col-md-6">Primary</div>
		          </div>
		          <br>
		          	<div class="row container">
		          		<div class="col-md-2">Signed:</div>
		          	<div class="col-md-4">Francisco T. Duque III
							Secretary of Health
					</div>
		          	<div class="col-md-6"> <img class="float-right" src="{{asset('ra-idlis/public/img/qr.png')}}" style="width:120px" alt="QR Code"></div>
		          	</div>
		        </div> 
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-print"></span>&nbsp;Print</button>
		        </div>
		        
		      </div>
    		</div>
		</div>
@endsection