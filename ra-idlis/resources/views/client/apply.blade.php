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
@php
	$sql = "SELECT seq_num, GROUP_CONCAT(hs.hfser_desc) AS h_desc, GROUP_CONCAT(hs.hfser_id) AS h_id, COALESCE(ap.appid, '0') AS don, COALESCE(ts.canapply, (CASE WHEN seq_num = '1' THEN 1 ELSE 0 END)) AS app_stat FROM hfaci_serv_type hs LEFT JOIN (SELECT * FROM appform WHERE CONCAT(hfser_id, t_date, t_time, uid) IN (SELECT CONCAT(hfser_id, MAX(t_date), MAX(t_time), uid) FROM appform WHERE uid = '$clientData->uid' GROUP BY hfser_id, uid)) ap ON ap.hfser_id = hs.hfser_id LEFT JOIN trans_status ts ON ts.trns_id = ap.status GROUP BY seq_num, ts.canapply, ap.appid ORDER BY seq_num ASC";
	$h_data = DB::select($sql);
@endphp
<style type="text/css">
	table.attachments > tr{
		width: 50%;
			}
			table.attachments > td {
				padding: 1em;
			}
</style>
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
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	  	document.getElementById('first').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>

<div class="container">

	<div class="card" style="margin-top: 5%;margin-bottom: 10%;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
		<div class="card-header text-center text-uppercase text-success" style="letter-spacing: 3px;font-size: 20px;"><strong>Application Type</strong></div>
		<div class="card-body">
				<div class="col-sm-3" style="position: absolute;">
					<div class="card" style="box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
						<div class="card-body">
							<small>Legends:</small>
							<label class="badge d-block badge-success">Approved Application <i class="fa fa-check-circle-o"></i></label>
							<label class="badge d-block badge-danger">Rejected Application <i class="fa fa-times-circle-o"></i></label>
							<label class="badge d-block badge-warning">Pending Application <i class="fa fa-spinner"></i></label>
							<label class="badge d-block badge-dark">Disabled Application <i class="fa fa-exclamation-circle"></i></label>
						</div>
					</div>
				</div>
			@for($i = 0; $i < count($h_data); $i++)
				<?php $h_desc = explode(',', $h_data[$i]->h_desc); $h_id = explode(',', $h_data[$i]->h_id); $k = ((($i-1) < 0) ? $i : (($h_data[($i-1)]->don == '0') ? $i : ($i-1))); ?>
				@if(count($h_desc) > 0)
					@if(count($h_desc) < 2)
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-4"><a @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="{{ asset('/client/view/form') }}/{{strtolower($h_data[$i]->h_id)}}" @endif @else @if($h_data[$k]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="#" @endif @endif style="text-decoration: none;"><button @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 0) class="btn btn-block btn-warning" @elseif($h_data[$i]->app_stat == 1) class="btn btn-block btn-danger" @else class="btn btn-block btn-success" @endif @else @if($h_data[$k]->app_stat > 0) class="btn btn-block btn-outline-success" @else class="btn btn-block btn-outline-dark" @endif @endif>{{$h_data[$i]->h_desc}}  ({{$h_data[$i]->h_id}})<i @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 0) class="fa fa-spinner" @elseif($h_data[$i]->app_stat == 1) class="fa fa-times-circle-o" @else class="fa fa-check-circle-o" @endif @else @if($h_data[$k]->app_stat < 1) class="fa fa-exclamation-circle" @endif @endif style="float: right; font-size: 26px;"></i></button></a>
							</div>
							<div class="col-sm-4"></div>
						</div> 
						@if($i < count($h_data) - 1)
							<center><div style="width: 1px;height: 100px;top: 0;background-color: rgba(0,0,0,.2);"></div></center>
						@endif
					@elseif(count($h_desc) > 1) 
						<?php $div = 12/count($h_desc); $perDiv = floor($div)/2; $perDiv2 = 6 - $perDiv; $fDiv = 0; $sDiv = 0; ?>
						<div class="row"> 
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($fDiv < $perDiv) <?php $fDiv++; ?> @else style="border-top: 1px solid rgba(0,0,0,.2);" <?php $fDiv++; ?> @endif></div>

							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
							<div class="col-sm-1" @if($sDiv < $perDiv2) style="border-top: 1px solid rgba(0,0,0,.2);" <?php $sDiv++; ?> @else <?php $sDiv++; ?> @endif></div>
						</div>
						<div class="row">
							<?php $forFloat = (double)1; $forBool = false; $newDiv = 0; $newDad = 0; if(strpos($div, '.') != false) { $newDiv = ((($div - ((int)$div))*10)/2); $forBool = true; $newDad = ((int)$div); } else { $forBool = false; $newDiv = 0; $newDad = 0; } ?>
							@for($j = 0; $j < count($h_desc); $j++)
								<div @if(strpos($div, '.') != false) @if(sprintf('%.2f', $forFloat) === sprintf('%.2f', $newDiv)) class="col-sm-{{($newDad + 1)}}" <?php $forFloat = (double)1; ?> @else class="col-sm-{{($newDad)}}" <?php $forFloat++; ?> @endif @else class="col-sm-{{$div}}" @endif>
									<center><div style="width: 1px;height: 30px;top: 0;background-color: rgba(0,0,0,.2);"></div></center>
									<a @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="{{ asset('/client/view/form') }}/{{strtolower($h_data[$i]->h_id)}}" @endif @else @if($h_data[$k]->app_stat == 1) href="{{ asset('/client/apply/form') }}/{{strtolower($h_data[$i]->h_id)}}" @else href="#" @endif @endif style="text-decoration: none;"><button @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 0) class="btn btn-block btn-warning" @elseif($h_data[$i]->app_stat == 1) class="btn btn-block btn-warning" @else class="btn btn-block btn-success" @endif @else @if($h_data[$k]->app_stat > 0) class="btn btn-block btn-outline-success" @else class="btn btn-block btn-outline-dark" @endif @endif>{{$h_desc[$j]}} ({{$h_id[$j]}})<i @if($h_data[$i]->don != '0') @if($h_data[$i]->app_stat == 0) class="fa fa-spinner" @elseif($h_data[$i]->app_stat == 1) class="fa fa-times" @else class="fa fa-check" @endif @else @if($h_data[$k]->app_stat < 1) class="fa fa-exclamation-circle" @endif @endif style="float: right; font-size: 26px;"></i></button></a>
								</div>
							@endfor
						</div>
						@if($i < count($h_data) - 1)
							<center><div style="width: 1px;height: 100px;top: 0;background-color: rgba(0,0,0,.2);"></div></center>
						@endif
					@endif
				@else
				@endif
			@endfor
		</div>
	</div>
</div>
<hr>
@include('client.sitemap')
@endsection