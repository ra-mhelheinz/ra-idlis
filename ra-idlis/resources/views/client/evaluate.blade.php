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

<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	  	document.getElementById('third').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>

<div class="jumbotron container" style="margin-top: 2%;border: 1px solid rgba(0,0,0,.2);margin-top: 2%;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);border-radius: 5px;background-color: #fff">

	<div class="container" >
		<div class="tab-content" id="myTabContent">
			<div name="sorrybread" class="tab-pane fade show active" id="oop0" role="tabpanel" aria-labelledby="oop0-tab">
				@if(count($upload) > 0)
					@foreach($upload AS $uploads)
						<label for="apptype{{$uploads->hfser_id}}" class="list-group-item list-group-item-action list-group-item-info" style="cursor: pointer;" onclick="nst(1)"><input id="apptype{{$uploads->hfser_id}}" type="radio" name="apptype" value="{{$uploads->hfser_id}}"><span name="appname">{{$uploads->hfser_desc}}</span></label>
					@endforeach
				@else
				@endif
			</div>

			<div name="sorrybread" class="tab-pane fade" id="oop1" role="tabpanel" aria-labelledby="oop1-tab">
				<button id="forprev" class="btn btn-info" style="float: left;" onclick="nst(0)"><i class="fa fa-angle-left"></i> Back</button>

				<div class="table-responsive">
					<table class="table" style="width: 100%;">
						<thead>
							<tr>
								<td style="width: 50%;">
									<h4>{{$clientData->facilityname}},{{$clientData->streetname}}</h4>

								</td>
								<td style="width: 25%;" class="text-center">
									<h4>DOH Evaluation Status</h4>
								</td>
								<td style="width: 25%;" class="text-center">
									<h4>Remarks</h4>
								</td>
							</tr>
						</thead>

						@if(count($evaluate) > 0)
							@foreach($evaluate AS $uploadAf)
								<?php $newUpdate = explode(',', $uploadAf->upid); $newEvaluate = explode(',', $uploadAf->evaluation); $newDesc = explode(',', $uploadAf->updesc); $newRemarks = explode(',', $uploadAf->remarks); ?>
								<tbody id="up_{{$uploadAf->hfser_id}}" hidden="true" name="forevaluate">
									@if(count($newUpdate) > 1)
										@for($i = 0; $i < count($newUpdate); $i++)
											<tr>
												<td>
													{{$newDesc[$i]}}
												</td>
												<td>
													<center><i @if(count($newEvaluate) > $i) @if($newEvaluate[$i] != null) @if($newEvaluate[$i] == 0) class="text-danger fa fa-times" @else class="text-success fa fa-check" @endif  @else class="text-warning fa fa-spinner" @endif @endif style="font-size: 30px;"></i></center>
												</td>
												<td>
													@if(count($newRemarks) > $i) {{$newRemarks[$i]}} @endif
												</td>
											</tr>
										@endfor
									@else
										<tr>
											<td>
												{{$uploadAf->updesc}}					
											</td>
											<td>
												<center><i @if($uploadAf->evaluation != null) @if($uploadAf->evaluation == 0) class="text-danger fa fa-times" @else class="text-success fa fa-check" @endif  @else class="text-warning fa fa-spinner" @endif style="font-size: 30px;"></i></center>
											</td>
											<td>
												{{$uploadAf->remarks}}
											</td>
										</tr>
									@endif
								</tbody>
								<tfoot id="foot_{{$uploadAf->hfser_id}}" hidden="true" name="forevaluate">
									<td>
										<label>Recommended for Inspection:</label>
										<strong><span @if($uploadAf->isInspected != null) @if($uploadAf->isInspected == 0) class="badge badge-danger" @else class="badge badge-success" @endif @else class="badge badge-warning" @endif>@if($uploadAf->isInspected != null) @if($uploadAf->isInspected == 0) No @else Yes @endif @else Pending @endif</span></strong>
									</td>

									<td colspan="2">
										<label class="form-inline">Date of Inspection: {{$uploadAf->proposedInspectiondate}}/Time of Inspection: {{$uploadAf->proposedInspectiontime}}</label></strong>
									</td>
								</tfoot>
							@endforeach
						@else
						@endif
					</table>
				</div>
			</div>
		</div>
		<hr>
	</div>	
</div>
<hr>
<script type="text/javascript">
	var startI = 0;

	function nst(inc) {
		for(var i = 0; i < document.getElementsByName('sorrybread').length; i++) {
			document.getElementsByName('sorrybread')[i].classList.remove('show');
			document.getElementsByName('sorrybread')[i].classList.remove('active');
		}
		for(var i = 0; i < document.getElementsByName('forevaluate').length; i++) {
			document.getElementsByName('forevaluate')[i].setAttribute('hidden', true);
		}
		for(var i = 0; i < document.getElementsByName('apptype').length; i++) {
			if(document.getElementsByName('apptype')[i].checked == true) {
				document.getElementById('up_'+document.getElementsByName('apptype')[i].value).removeAttribute('hidden');
				document.getElementById('foot_'+document.getElementsByName('apptype')[i].value).removeAttribute('hidden');
			}
		}
		document.getElementsByName('sorrybread')[inc].classList.add('show');
		document.getElementsByName('sorrybread')[inc].classList.add('active');
	}
</script>
	@include('client.sitemap')
@endsection