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
	$sql = "SELECT hf.hfser_id, hf.hfser_desc, af.canapply, n_canapply, GROUP_CONCAT(CONCAT('a_', af.aptid)) AS aptid, COALESCE(n_aptid, (SELECT GROUP_CONCAT(CONCAT('n_', aptid)) FROM apptype)) AS n_aptid FROM hfaci_serv_type hf LEFT JOIN (SELECT af.*, (SELECT GROUP_CONCAT(CONCAT('n_', aptid)) FROM apptype WHERE aptid NOT IN ((SELECT aptid FROM appform WHERE hfser_id = af.hfser_id))) AS n_aptid, (SELECT GROUP_CONCAT(CONCAT('c_3_', apf.aptid)) FROM apptype apf WHERE aptid NOT IN (SELECT aptid FROM appform WHERE uid = af.uid)) AS n_canapply, (SELECT GROUP_CONCAT(CONCAT('c_', ts.canapply, '_', afp.aptid)) FROM appform afp LEFT JOIN trans_status ts ON afp.status = ts.trns_id WHERE CONCAT(afp.uid, afp.hfser_id, afp.t_date, afp.t_time, afp.aptid) IN (SELECT CONCAT(uid, hfser_id, MAX(t_date), MAX(t_time), aptid) FROM appform WHERE uid = af.uid GROUP BY uid, aptid, hfser_id)) AS canapply FROM (SELECT af.* FROM appform af WHERE CONCAT(uid, hfser_id, t_date, t_time, aptid) IN (SELECT CONCAT(uid, hfser_id, MAX(t_date), MAX(t_time), aptid) FROM appform WHERE uid = '$clientData->uid' GROUP BY uid, aptid, hfser_id)) af) af ON hf.hfser_id = af.hfser_id GROUP BY hf.hfser_id, hf.hfser_desc, af.canapply, hf.seq_num, n_aptid, n_canapply ORDER BY hf.seq_num ASC";
	$h_data = DB::select($sql);
	// $h_data = DB::connection()->getPdo()->exec($sql);
@endphp
<style type="text/css">
	table.attachments > tr{
		width: 50%;
			}
			table.attachments > td {
				padding: 1em;
			}
</style>
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	  	document.getElementById('first').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>

<div class="container">

	<div class="card" style="margin-top: 5%;margin-bottom: 10%;border-top: 2px solid #28a745;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
		<div class="card-header text-center text-uppercase text-success" style="letter-spacing: 3px;font-size: 20px;"><strong>Application Type</strong></div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<select class="form-control" id="r_chgp" onchange="r_ochg()">
						<option selected disabled>Select Application Type</option>
						@foreach($aptyps as $apptyp)
							<option value="{{$apptyp->aptid}}">{{$apptyp->aptdesc}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4"></div>
			</div>
			<br>
			<script type="text/javascript">
				var arrHref = [];
				function r_ochg() {
					var mhelf = document.getElementById('r_chgp').value;
					var arrClass = ['btn-success', 'btn-warning', 'btn-danger', 'btn-info'];
					for(var i = 0; i < document.getElementsByName('r_ch').length; i++) {
						for(var j = 0; j < arrClass.length; j++) {
							document.getElementsByName('r_ch')[i].classList.remove(arrClass[j]);
						}
					}
					for(var i = 0; i < document.getElementsByName('r_ch').length; i++) {
						if(document.getElementsByName('r_ch')[i].classList.contains('n_'+mhelf)) {
							document.getElementsByName('r_ch')[i].classList.add(arrClass[3]);
							document.getElementsByName('a_chgf')[i].setAttribute('href', '{{asset('client/apply/form')}}/'+arrHref[i]+'/'+mhelf+'/notdraft');
						}
						if(document.getElementsByName('r_ch')[i].classList.contains('a_'+mhelf)) {
							if(document.getElementsByName('r_ch')[i].classList.contains('c_3_'+mhelf)) {
								document.getElementsByName('r_ch')[i].classList.add(arrClass[3]);
								document.getElementsByName('a_chgf')[i].setAttribute('href', '{{asset('client/apply/form')}}/'+arrHref[i]+'/'+mhelf+'/notdraft');
							} else if(document.getElementsByName('r_ch')[i].classList.contains('c_2_'+mhelf)) {
								document.getElementsByName('r_ch')[i].classList.add(arrClass[0]);
								document.getElementsByName('a_chgf')[i].setAttribute('href', '{{asset('client/view/form')}}/'+arrHref[i]+'/'+mhelf+'/notdraft');
							} else if(document.getElementsByName('r_ch')[i].classList.contains('c_1_'+mhelf)) {
								document.getElementsByName('r_ch')[i].classList.add(arrClass[2]);
								document.getElementsByName('a_chgf')[i].setAttribute('href', '{{asset('client/apply/form')}}/'+arrHref[i]+'/'+mhelf+'/notdraft');
							} else if(document.getElementsByName('r_ch')[i].classList.contains('c_0_'+mhelf)) {
								document.getElementsByName('r_ch')[i].classList.add(arrClass[1]);
								document.getElementsByName('a_chgf')[i].setAttribute('href', '{{asset('client/view/form')}}/'+arrHref[i]+'/'+mhelf+'/notdraft');
							}
						}
					}
				}
			</script>
			@if(count($h_data) > 0)
				@foreach($h_data AS $h_datas)
					<?php $n_canapply = implode(' ', explode(',', $h_datas->n_canapply)); $canapply = implode(' ', explode(',', $h_datas->canapply)); $aptid = implode(' ', explode(',', $h_datas->aptid)); $newAptid = implode(' ', explode(',', $h_datas->n_aptid)); ?>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<a name="a_chgf" style="text-decoration: none;"><button name="r_ch" type="button" class="btn btn-block btn-lg btn-info {{$aptid}} {{$newAptid}} {{$n_canapply}} {{$canapply}}">{{$h_datas->hfser_desc}} ({{$h_datas->hfser_id}})</button></a><hr>
						</div>
						<div class="col-sm-2"></div>
					</div>
					<script type="text/javascript">
						arrHref.push('{{strtoupper($h_datas->hfser_id)}}');
					</script>
				@endforeach
			@else
			@endif
		</div>
	</div>
</div>
<hr>
@include('client.sitemap')
@endsection