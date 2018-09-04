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
<div class="jumbotron container">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12" style="position:absolute;">
					<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="height: auto; width:100px;">
				</div>
				<div class="col-lg-12 text-center">
					
					<h6>Republic of the Philippines</h6>
					<h6>DEPARTMENT OF HEALTH</h6>
					<h3>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</h3>
				</div>
			</div>
			<div class="container" style="margin-top: 5%;">
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-3"><label>Date:</label></div>
						<div class="col-sm-7"></div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-4"><label>Name of HealthFacility/Service:</label></div>
						<div class="col-sm-6"></div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-3"><label>Address:</label></div>
						<div class="col-sm-7"></div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-4"><label>Latest LTO/COA/ATO/COR No.</label></div>
						<div class="col-sm-3"><label>Validity Period from</label></div>
						<div class="col-sm-3"><label>To</label></div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-4"><label>Tel. Number (HF landline)</label></div>
						<div class="col-sm-3"><label>Cellphone No.</label></div>
						<div class="col-sm-3"><label>Email Address:</label></div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-3"><label>Owner:</label></div>
						<div class="col-sm-7"></div>
						<div class="col-sm-1"></div>
					</div>
				</div>
		</div>
	</div>
</div>
@include('client.sitemap')
@endsection