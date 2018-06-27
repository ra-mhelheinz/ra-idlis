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
@include('client.breadcrumb')
{{-- @foreach ($ownshs as $ownsh)
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
<div class="container">
	<div class="card" style="margin-top: 5%;margin-bottom: 10%;">
		<div class="card-header text-center">Application Type</div>
		<div class="card-body">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><a href="{{ asset('/client/apply/form/con') }}" style="text-decoration: none;"><button class="btn btn-lg btn-block btn-primary">Certificate of Need (CON)</button></a></div>
		<div class="col-sm-4"></div>
	</div> 
	<center><div style="width: 1px;height: 100px;top: 0;background-color: rgba(0,0,0,.2);"></div></center>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<a href="{{ asset('/client/apply/form/ptc') }}" style="text-decoration: none;"><button class="btn btn-lg btn-block btn-primary">Permit to Construct (PTC)</button></a>
		</div>
		<div class="col-sm-4"></div>
	</div>
	<center><div style="width: 1px;height: 50px;top: 0;background-color: rgba(0,0,0,.2);"></div></center>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-4" style="border-top: 1px solid rgba(0,0,0,.2);border-right: 1px solid rgba(0,0,0,.2);border-left: 1px solid rgba(0,0,0,.2);height: 50px;"></div>
		<div class="col-sm-4" style="border-top: 1px solid rgba(0,0,0,.2);border-right: 1px solid rgba(0,0,0,.2);"></div>
		<div class="col-sm-2"></div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<a href="{{ asset('/client/apply/form/lto') }}" style="text-decoration: none;"><button class="btn btn-lg btn-block btn-primary">License to Operate (LTO)</button></a>
		</div>
		<div class="col-sm-4">
			<a href="{{ asset('/client/apply/form/coa') }}" style="text-decoration: none;"><button class="btn btn-lg btn-block btn-primary">Certificate of Accreditation (COA)</button></a>
		</div>
	<div class="col-sm-4">
		<a href="{{ asset('/client/apply/form/ato') }}" style="text-decoration: none;"><button class="btn btn-lg btn-block btn-primary">Authority to Operate (ATO)</button></a>
	</div>
	</div>
	</div>
	</div>
</div>
<hr>
@include('client.sitemap')
@endsection