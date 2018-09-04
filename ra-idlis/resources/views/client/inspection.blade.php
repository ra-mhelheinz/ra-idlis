@extends('main')
@section('content')
@include('client.nav')
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	var arrEy = [];
	var cur = 0;
  	document.getElementById('fourth').style = "margin:0;border-bottom: 3px solid #f2e20c;";
	function nst(div_name, inc, btndiv) {
		for(var i = 0; i < document.getElementsByClassName('btn').length; i++) {
			document.getElementsByClassName('btn')[i].removeAttribute('hidden');
		}
		for(var i = 0; i < document.getElementsByClassName('parthide').length; i++) {
			document.getElementsByClassName('parthide')[i].setAttribute('hidden', true);
		}
		for(var i = 0; i < document.getElementsByName(div_name).length; i++) {
			document.getElementsByName(div_name)[i].removeAttribute('hidden');
		}
		cur = cur + (inc);
		if(cur < 1 || cur == arrEy.length - 1) {
			document.getElementById(btndiv).setAttribute('hidden', true);
		}
		window.scrollTo({
		    top: document.getElementsByClassName('jumbotron ')[0].offsetTop,
		    behavior: "smooth"
		});
	}
	@if(count($part) > 0)
		@foreach($part AS $instatus)
			arrEy.push("part_{{$instatus->partid}}");
		@endforeach
	@endif
</script>
<div class="jumbotron container" style="margin-top: 2em;box-shadow: 0px 2px 20px rgba(0,0,0,0.2);background-color: #fff">
	{{-- <div class="text-center"><h3>Your Application is not yet inspected.</h3></div> --}}
	<div class="container">
		<h2>ABC Hospital. Rizal St., Manila</h2>
		<hr>
		<div class="container align-items-center">
			<font size="24px">Assessment Tool</font>
		</div>
		<hr>
		@if(count($part) > 0)
			@foreach($part AS $instatus)
				<h3 name="part_{{$instatus->partid}}" class="parthide"><center>{{$instatus->partdesc}}</center></h3>
			@endforeach
		@endif
		<hr>
		<table class="table">
			<tr>
				<th style="width: 60%;"></th>
				<th style="width: 20%;" class="text-center">Inspection status</th>
				<th style="width: 20%;" class="text-center">Remarks</th>
			</tr>
			@if(count($inspect) > 0)
				@foreach($inspect as $instatus)
					<tbody name="part_{{$instatus->partid}}" class="parthide" hidden="true">
						<tr>
							<td>{{$instatus->asmt_name}}</td>
							<td class="text-center"><label @if($instatus->isapproved != null) @if($instatus->isapproved < 1) class="badge badge-danger" @else class="badge badge-success" @endif @else class="badge badge-warning" @endif>@if($instatus->isapproved != null) @if($instatus->isapproved < 1) Not Approved @else Approved @endif @else Approval Pending @endif</label></td>
							<td class="text-center">{{$instatus->remarks}}</td>
						</tr>
					</tbody>
				@endforeach
			@else
				<tbody>
					<tr>
						<td colspan="3">No record</td>
					</tr>
				</tbody>
			@endif
		</table>
		<button id="btn_prev" class="btn btn-info" style="float: left;" onclick="nst(((cur < 1) ? arrEy[cur] : arrEy[(cur - 1)]), ((cur < 1) ? 0 : -1), this.id)"><i class="fa fa-angle-left"></i> Prev</button>
		<button id="btn_next" class="btn btn-info" style="float: right;" onclick="nst(((cur < arrEy.length-1) ? arrEy[(cur + 1)] : arrEy[cur]), ((cur < arrEy.length-1) ? 1 : 0), this.id)">Next <i class="fa fa-angle-right"></i></button>
	</div>
</div>
<hr>
<script type="text/javascript">
	nst(arrEy[0], 0, "btn_prev");
</script>
@include('client.sitemap')
@endsection