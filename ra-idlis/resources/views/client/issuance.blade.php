@extends('main')
@section('content')
@include('client.nav')
<div class="container">@include('client.breadcrumb')</div>
<style type="text/css">
	@media print {
		body > div {
			display: none;
		}
		#remDis {
			display: block;
		}
	}
</style>
<script type="text/javascript">
	  	document.getElementById('fifth').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>
<div id="remDis" class="container">
	@if(count($issuance) > 0)
		@foreach($issuance AS $issuances)
			<div class="modal-dialog modal-lg" style="box-shadow: -5px 5px 10px rgba(0,0,0,0.25);border-radius: 5px;">
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
								<h1>{{strtoupper($issuances->hfser_desc)}}</h1>
							</div>
						</div>
					</div>
		      	</div>
		        <!-- Modal body -->
		        <div class="modal-body">
		          <div class="row" style="margin-right: 10%;margin-left:10%;">
		          	<div class="col-md-6">Name of Facility:</div>
		          	<div class="col-md-6">{{$issuances->facilityname}}</div>
		          	<hr>
		          	<div class="col-md-6">Type of Facility:</div>
		          	<div class="col-md-6">{{$issuances->facname}}</div>
		          	<hr>
		          	<div class="col-md-6">Location:</div>
		          	<div class="col-md-6">{{$issuances->loc}}</div>
		          	<hr>
		          	<div class="col-md-6">Classification:</div>
		          	<div class="col-md-6">{{$issuances->classname}}</div>
		          	<hr>
		          	<div class="col-md-6">License No:</div>
		          	<div class="col-md-6">{{$issuances->license}}</div>
		          	<hr>
		          	<div class="col-md-6">Validity:</div>
		          	<div class="col-md-6">{{$issuances->validity}}</div>
		          	<hr>
		          	<div class="col-md-6">Service:</div>
		          	<div class="col-md-6">Primary</div>
		          </div>
		          <br>
		          	<div class="row container">
		          		<div class="col-md-2">Signed:</div>
		          	<div class="col-md-4">{{$issuances->sec_name}}
							Secretary of Health
					</div>
		          	<div class="col-md-6"> <img class="float-right" src="{{asset('ra-idlis/public/img/qr.png')}}" style="width:120px" alt="QR Code"></div>
		          	</div>
		        </div> 
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <a id="btnprint" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-print"></span>&nbsp;Print</a>
		        </div>
		        
		      </div>
			</div>
		@endforeach
		@else
		<div class="container">
			<div class="jumbtron" style="margin-top: 10%;">
				<h5 class="text-center">NO application Issued to print</h5>
			</div>
		</div>
	@endif
</div>
<hr>
<script type="text/javascript">
	$(document).ready(function{
		$('#btnprint').printPage();
	});
</script>
@include('client.sitemap')
@endsection