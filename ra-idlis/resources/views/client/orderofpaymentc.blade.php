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
@php 
	$paymentstart = 1; $paymentend = 5;
	$sqlPayment = "SELECT apo.appop_id, apo.oop_id, oop_desc, oop_total, apf.status, apf.aptid, ts.trns_desc FROM appform_oopdata appo LEFT JOIN appform_orderofpayment apo ON apo.appop_id = appo.appop_id LEFT JOIN appform apf ON apf.appid = apo.appid LEFT JOIN trans_status ts ON ts.trns_id = apf.status LEFT JOIN orderofpayment opo ON opo.oop_id = apo.oop_id WHERE apf.uid = '$clientData->uid' AND (apf.status != 'A') AND ts.allowedpayment != 0";
	$getAppPayment = DB::select($sqlPayment);
	$appform = DB::select("SELECT ap.appid, ap.aptid, x8.facilityname, hf.hfser_desc, aat.aptdesc, ts.trns_desc, ap.hfser_id FROM appform ap INNER JOIN x08 x8 ON x8.uid = ap.uid INNER JOIN hfaci_serv_type hf ON hf.hfser_id = ap.hfser_id INNER JOIN apptype aat ON aat.aptid = ap.aptid LEFT JOIN trans_status ts ON ts.trns_id = ap.status WHERE ap.uid = '$clientData->uid' AND ap.status != 'A' AND ts.allowedpayment != 0");
	$oop = DB::select('SELECT * FROM orderofpayment ORDER BY oop_desc ASC');
	$category = DB::select('SELECT oc.*, co.aptid, ap.aptdesc, (SELECT GROUP_CONCAT(cat_id) AS cat_id1 FROM category WHERE cat_id IN (SELECT cat_id FROM charges WHERE chg_code IN (SELECT chg_code FROM chg_app WHERE oop_id = oc.oop_id))) AS cat_id1, (SELECT GROUP_CONCAT(cat_desc) AS cat_desc1 FROM category WHERE cat_id IN (SELECT cat_id FROM charges WHERE chg_code IN (SELECT chg_code FROM chg_app WHERE oop_id = oc.oop_id))) AS cat_desc1 FROM orderofpayment oc LEFT JOIN (SELECT GROUP_CONCAT(ca.cat_id) AS cat_id, GROUP_CONCAT(ca.chg_code) AS chg_code, GROUP_CONCAT(ca.chg_desc) AS chg_desc, GROUP_CONCAT(ca.amt) AS amt, ca.aptid, co.oop_id FROM chg_app co LEFT JOIN (SELECT ch.*, ca.amt, ca.aptid FROM charges ch INNER JOIN chg_app ca ON ca.chg_code = ch.chg_code ORDER BY cat_id, chg_code) ca ON co.chg_code = ca.chg_code GROUP BY co.oop_id, ca.aptid) co ON co.oop_id = oc.oop_id LEFT JOIN apptype ap ON ap.aptid = co.aptid');
	$charges = DB::select("SELECT DISTINCT ch.*, ca.amt, ca.aptid, ca.chgapp_id FROM chg_app ca LEFT JOIN charges ch ON ca.chg_code = ch.chg_code LEFT JOIN category ct ON ct.cat_id = ch.cat_id WHERE ct.cat_type = 'C'");
	$chg_app = array();
@endphp
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
	  	document.getElementById('second').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>

<div class="container">
  	<div class="jumbotron" style="background-color: #fff;box-shadow: -5px 5px 10px rgba(0,0,0,0.25);border:1px solid rgba(0,0,0,.1)">
		<div class="tab-content" id="myTabContent">
			<div name="sorrybread" class="tab-pane fade show active" id="oop0" role="tabpanel" aria-labelledby="oop0-tab" >
				<h3>Select Application Type</h3>
			    <div class="list-group">
			    	@if(count($appform) > 0)
			  			@for($i = 0; $i < count($appform); $i++)
						  	<label for="apptype{{$i}}" class="list-group-item list-group-item-action list-group-item-success" style="cursor: pointer;"><input id="apptype{{$i}}" type="radio" name="apptype" value="{{$appform[$i]->aptid}}" class="{{$appform[$i]->hfser_id}} {{$appform[$i]->appid}}"><span name="appname">&nbsp;{{$appform[$i]->facilityname}} - {{$appform[$i]->hfser_desc}} ({{$appform[$i]->aptdesc}})</span><span style="float: right;">Status: {{$appform[$i]->trns_desc}}</span></label>
						@endfor
					@else
						<br>
						<center><p id="noRecord" style="color: black;">Applications are either rejected or deleted, or not yet applied to an application.</p></center>
						<script type="text/javascript">
							setInterval(function() {
								if(document.getElementById('noRecord').style.color == "black") {
									document.getElementById('noRecord').style.color = "red";
								} else {
									document.getElementById('noRecord').style.color = "black";
								}
							}, 500);
						</script>
					@endif
				</div>
			</div>
			<div name="sorrybread" class="tab-pane fade" id="oop1" role="tabpanel" aria-labelledby="oop1-tab">
				<h3>Select Order of Payment</h3>
			    <div class="list-group">
			    	@if(count($oop) > 0)
						@for($i = 0; $i < count($oop); $i++)
							<label name="oopname" for="oooop{{$i}}" class="list-group-item list-group-item-action list-group-item-primary" style="cursor: pointer;"><input id="oooop{{$i}}" type="radio" name="oooop" value="{{$oop[$i]->oop_id}}">&nbsp;{{$oop[$i]->oop_desc}}</label>
						@endfor
					@else
						<p>No record(s) for Order of Payment yet.</p>
					@endif
				</div>
			</div>
			<div name="sorrybread" class="tab-pane fade" id="oop2" role="tabpanel" aria-labelledby="oop2-tab">
				<div class="row">
					<div id="getId" class="col-sm-7">
						<h4>Select Add-ons</h4>
						<div class="row">
							<div class="col-md-12">Application Type: <span id="editapp"></span></div>
							<div class="col-md-12">Order Of Payment: <span id="editoop"></span></div>
						</div>
						<div id="accordion">
							@for($i = 0; $i < count($category); $i++)
							  <?php $cat_id1 = explode(",", $category[$i]->cat_id1); $cat_desc1 = explode(",", $category[$i]->cat_desc1); ?>
							  <div style="box-shadow: -5px 5px 10px rgba(0,0,0,0.25);border-radius: 5px;" id="imongmama{{$i}}" name="{{$category[$i]->aptid}}" class="card fighting {{$category[$i]->oop_id}}">
							    <a style="border-radius: 5px;" class="card-link bg-success text-white" data-toggle="collapse" href="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}" onclick="change_aft('collapseOne{{$i}}')"><div class="card-header" id="headingOne{{$i}}">
							          {{$category[$i]->oop_desc}}
							    </div></a>

							    <div id="collapseOne{{$i}}" class="collapse show" aria-labelledby="headingOne{{$i}}" data-parent="#accordion">
							      <div class="card-body">
							      	<div id="accordion{{$i}}">
							      		@for($o = 0; $o < count($cat_id1); $o++)
										  <div class="card" >
										    <a class="card-link" data-toggle="collapse" href="#collapseOneTwo{{$i}}{{$o}}" aria-expanded="true" aria-controls="collapseOneTwo{{$i}}{{$o}}" onclick="change_aft('collapseOneTwo{{$i}}{{$o}}')"><div class="card-header" id="headingOne{{$i}}{{$o}}">
												{{$cat_desc1[$o]}}
										    </div></a>

										    <div id="collapseOneTwo{{$i}}{{$o}}" class="collapse" aria-labelledby="headingOne{{$i}}{{$o}}" data-parent="#accordion1">
										      <div class="card-body">
										      	<table class="table table-hover">
										      		<tr>
										      			<th>Charges</th>
										      			<th>Description</th>
										      			<th class="text-center">Amount</th>
										      			<th class="text-center">Option</th>
										      		</tr>
										      		<?php $code = array(); ?>
											        @for($j = 0; $j < count($charges); $j++)
											        	@if($charges[$j]->cat_id == $cat_id1[$o])
											        	<?php $cheat = array_search($charges[$j]->chg_code, $code); ?>
											        		@if($cheat == false)
											        			<?php $cheat = array_push($code, $charges[$j]->chg_code); ?>
												        		<tr>
												        			<td>{{$charges[$j]->chg_desc}} </td>
												        			<td>{{$charges[$j]->chg_exp}}</td>
												        			<td class="text-center">&#8369;{{$charges[$j]->amt}}</td>
												        			<td id="{{$i}}{{$o}}{{$j}}" class="text-center"><i class="fa fa-plus-circle" style="cursor: pointer;color: #28a745;" onclick="addSummary(['{{$charges[$j]->chg_code}}', '{{$cat_desc1[$o]}}', '{{$charges[$j]->chg_desc}} {{$charges[$j]->chg_rmks}}', '{{$charges[$j]->amt}}', '{{$charges[$j]->chgapp_id}}'], '{{$i}}{{$o}}{{$j}}')"></i></td>
												        		</tr>
												        	@endif
											        	@endif
											        @endfor
										      	</table>
										      </div>
										    </div>
										  </div>
								  		@endfor
									</div>
							      </div>
							    </div>
							  </div>
							@endfor
						</div>
					</div>
					<div class="col-sm-5">
						<div id="forStick" style="max-height: 100%;">
							<div class="card" style="box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
								<div class="card-header bg-success text-uppercase text-center" style="color:white;"><h5 style="margin:0;"><strong>Payment Summary</strong></h5></div>
								<div class="card-body" style="overflow-y: scroll;">
									<form id="formSubmit" name="formSubmit" method="POST" action="{{asset('client/payment')}}">
										{{csrf_field()}}
										<input type="hidden" name="hfser_id" id="hfser_id" value="">
										<input type="hidden" name="appform_id" id="appform_id" value="">
										@if(count($getAppPayment) > 0)
											@for($i = 0; $i < count($getAppPayment); $i++)
											<small><div id="paramatangtangimongmama{{$getAppPayment[$i]->aptid}}" name="{{$getAppPayment[$i]->aptid}}" class="fighting {{$getAppPayment[$i]->oop_id}}">
												<p>PAYMENT<span style="float: right; color: red;">{{$getAppPayment[$i]->trns_desc}}</span></p>
												<p>&#8369;{{$getAppPayment[$i]->oop_total}}</p>
												<input type="hidden" name="desc[]" value="PAYMENT: {{$getAppPayment[$i]->oop_desc}}">
												<input type="hidden" name="amount[]" value="{{$getAppPayment[$i]->oop_total}}">
												<input type="hidden" name="chgapp_id[]" value="">
											</div></small>
											@endfor
										@else
											<small>Application form is either payed or not yet evaluated by the LO.</small>
										@endif
										<table class="table text-success">
											<thead>
												<tr>
													<th>Description</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="paymentrecord">
												<tr><td colspan="3">None</td></tr>
											</tbody>
										</table>
									</form>
								</div>
								<div class="card-footer">
									<label>Total: &#8369;<span id="tlpymnt">0</span></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<button id="forprev" class="btn btn-info" style="float: left;" onclick="nst(-1)"><i class="fa fa-angle-left"></i> Prev</button>
		<button id="fornext" class="btn btn-info" style="float: right;" onclick="nst(1)">Next <i class="fa fa-angle-right"></i></button>
		<button data-toggle="modal" data-target="#myModal" id="forpaymentbtn" class="btn btn-warning" style="float: right;">Continue <i class="fa fa-credit-card"></i></button>
		<div class="modal fade" id="myModal">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="text-center">Payment Summary</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	        <div class="modal-body">
	          <hr>
	          <div class="row">
	          	<div class="col-sm-1 text-right"><input type="checkbox" name=""></div>
	          	<div class="col-sm-11">
	          		
	          		 <p style="line-height: 1;"><b>I HAVE REVIEWED MY PAYMENT SUMMARY.</b><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</small></p>
	          	</div>
	          </div>
	        </div>
	        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	        	<button data-dismiss="modal" class="btn btn-secondary btn-block"><i class="fa fa-angle-left"></i> Back</button>
	          	<button class="btn btn-warning btn-block"  form="formSubmit" style="margin-top: 0;">Continue <i class="fa fa-credit-card"></i></button>
	        </div>
	        
	      </div>
	    </div>
	  </div>
	</div>
				{{-- <div id="accordion">
					<div class="card" style="box-shadow: -5px 5px 10px rgba(0,0,0,0.25);">
					    <div class="card-header" id="headingOne">
					      <h5 class="mb-0">
					        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Walk In Payment
					        </button>
					      </h5>
					    </div>

					    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					      <div class="card-body">
					      	<div class="container">
					     	<div class="row">
					     		<div class="col-sm-2"></div>
					     		<div class="col-sm-4">Upload Official Receipt:</div>
					     		<div class="col-sm-4"><input type="file" name=""></div>
					     		<div class="col-sm-2"></div>
					     	</div>
					     	<div class="row">
					     		<div class="col-sm-2"></div>
					     		<div class="col-sm-4"><label>Date of Payment:</label></div>
					     		<div class="col-sm-4"><input type="text" class="form-control" name=""></div>
					     		<div class="col-sm-2"></div>
					     	</div>
					     	<div class="row">
					     		<div class="col-sm-2"></div>
					     		<div class="col-sm-4"><label>Reference Number</label></div>
					     		<div class="col-sm-4"><input type="text" class="form-control" name=""></div>
					     		<div class="col-sm-2"></div>
					     	</div>
					     	<div class="row">
					     		<div class="col-sm-2"></div>
					     		<div class="col-sm-4"><label>Amount:</label></div>
					     		<div class="col-sm-4"><input type="text" class="form-control" name=""></div>
					     		<div class="col-sm-2"></div>
					     	</div>
					       </div>
					      </div>
					      <div class="card-footer text-right">
					      	<button id="forpaymentbtn" class="btn btn-success" form="formSubmit">Submit <i class="fa fa-send-o"></i></button>
					      </div>
					    </div>
					  </div>
				</div> --}}
</div>
 
<script type="text/javascript">
	var inOf2 = 0;
	var curOop = "", cur_fac = "", cur_apid = "";
	var forArr = [];
	var forCode = [];
	var forBtn = [];
	var stickHeight_mn = 0;
	var stickHeight_aft = 0;
	var stickHeight_curr = 0;
	var reuse = 0;

	function nst(inOf) {
		inOf2 = inOf2 + inOf;
		for(var i = 0; i < document.getElementsByName('sorrybread').length; i++) {
			document.getElementsByName('sorrybread')[i].classList.remove('show');
			document.getElementsByName('sorrybread')[i].classList.remove('active');
		}
		if(inOf2 == 0) {
			document.getElementById('forprev').setAttribute("hidden", true);
			document.getElementById('forpaymentbtn').setAttribute("hidden", true);
		} else {
			document.getElementById('forprev').removeAttribute("hidden");
			document.getElementById('forpaymentbtn').setAttribute("hidden", true);
		}
		if(inOf2 == (document.getElementsByName('sorrybread').length - 1)) {
			document.getElementById('fornext').setAttribute("hidden", true);
			document.getElementById('forpaymentbtn').removeAttribute("hidden");
		} else {
			document.getElementById('fornext').removeAttribute("hidden");
			document.getElementById('forpaymentbtn').setAttribute("hidden", true);
		}
		if(inOf2 > 0) {
			laterbread();
		}

		document.getElementsByName('sorrybread')[inOf2].classList.add('show');
		document.getElementsByName('sorrybread')[inOf2].classList.add('active');
	}
	function laterbread() {
		var aptid = "";
		var oop_id = "";
		var appname = "";
		var oopname = "";
		if(curOop != "") {
			if(curOop == oop_id) {

			} else {
				document.getElementById('paymentrecord').innerHTML = '<tr><td colspan="3">None</td></tr>';
				document.getElementById('tlpymnt').innerHTML = '0';
				forArr = []; forCode = []; forBtn = [];
				curOop = oop_id;
			}
		} else {
			forArr = []; forCode = []; forBtn = [];
			curOop = oop_id;
		}
 		for(var i = 0; i < document.getElementsByClassName('fighting').length; i++) {
 			document.getElementsByClassName('fighting')[i].setAttribute('hidden', true);
 		}
		for(var i = 0; i < document.getElementsByName('oooop').length; i++) {
			if(document.getElementsByName('oooop')[i].checked == true) {
				oop_id = document.getElementsByName('oooop')[i].value;
				oopname = document.getElementsByName('oopname')[i].textContent;
			}
		}
		for(var i = 0; i < document.getElementsByName('apptype').length; i++) {
			if(document.getElementsByName('apptype')[i].checked == true) {
				aptid = document.getElementsByName('apptype')[i].value;
				appname = document.getElementsByName('appname')[i].textContent;
				cur_fac = document.getElementsByName('apptype')[i].classList[0];
				cur_apid = document.getElementsByName('apptype')[i].classList[1];
				localStorage.setItem('cur_fac', document.getElementsByName('apptype')[i].classList[0]);
				localStorage.setItem('cur_apid', document.getElementsByName('apptype')[i].classList[1]);
				document.getElementById('hfser_id').value = document.getElementsByName('apptype')[i].classList[0];
				document.getElementById('appform_id').value = document.getElementsByName('apptype')[i].classList[1];
			}
		}

	 	if(aptid == "") { nst(-1); }
	 	if(oop_id == "" && inOf2 > 1) { nst(-1); }
		if(aptid != "" && oop_id != "") {
			localStorage.setItem('curOop', curOop);
	 		for(var i = 0; i < document.getElementsByName(aptid).length; i++) {
	 			var id = document.getElementsByName(aptid)[i].id;
 				if(document.getElementById('paramatangtangimongmama'+aptid) != null) {
 					document.getElementById('paramatangtangimongmama'+aptid).getElementsByTagName('input')[0].setAttribute('name', '');
					document.getElementById('paramatangtangimongmama'+aptid).getElementsByTagName('input')[1].setAttribute('name', '');
 				}
	 			for(var j = 0; j < document.getElementsByClassName(oop_id).length; j++) {
		 			if(id == document.getElementsByClassName(oop_id)[j].id) {
		 				document.getElementById(id).removeAttribute('hidden');
		 				if(document.getElementById('paramatangtangimongmama'+aptid) != null) {
		 					document.getElementById('paramatangtangimongmama'+aptid).getElementsByTagName('input')[0].setAttribute('name', 'desc[]');
		 					document.getElementById('paramatangtangimongmama'+aptid).getElementsByTagName('input')[1].setAttribute('name', 'amount[]');
		 				}
		 				document.getElementById('editapp').innerHTML = appname;
		 				document.getElementById('editoop').innerHTML = oopname;

						stickHeight_mn = document.getElementById('getId').offsetHeight;
		 			}
		 		}
	 		}
	 	}
	}
	function sticktop() {
	    var y = parseFloat((parseFloat(document.body.offsetHeight) - parseFloat(document.getElementById('forStick').offsetHeight)) - parseFloat(document.getElementById('forStick').offsetHeight)) - 35;
		var x = parseFloat(parseFloat(window.innerHeight) + parseFloat(window.scrollY)) - parseFloat(document.getElementById('forStick').offsetHeight);
		stickHeight_mn = ((stickHeight_mn < 1) ? document.getElementById('getId').offsetHeight : stickHeight_mn);
		stickHeight_curr = document.getElementById('getId').offsetHeight;
		var stickHeight = ((stickHeight_aft < 1) ? stickHeight_mn : stickHeight_aft);
		if(window.scrollY > 149) {
		    if(y <= x) {
		        document.getElementById('forStick').setAttribute("style", 'max-height: 100%;');
		        document.getElementById('forStick').getElementsByClassName('card')[0].style.height = ''+stickHeight+'px';
		    } else {
		    	//position: fixed; top: 0; margin-top: 28px; 
		      	document.getElementById('forStick').setAttribute('style', 'max-height: 100%;');
		        document.getElementById('forStick').getElementsByClassName('card')[0].style.height = ''+stickHeight+'px';
		    }
		}
		else {
		    document.getElementById('forStick').setAttribute("style", 'max-height: 100%;');
		    document.getElementById('forStick').getElementsByClassName('card')[0].style.height = ''+stickHeight+'px';
		}
		setTimeout(function() {if(reuse > 0 && stickHeight_curr != stickHeight_aft) {suwayandaw(stickHeight_curr); }}, 430);
	}
	function addSummary(arr, btnid) {
		var searchCode = forBtn.indexOf(btnid);
		if(searchCode < 0) {
			forArr.push(arr);
			forBtn.push(btnid);
			forCode.push(arr[0]);
		}
		disp_dt();
	}
	function disp_dt() {
		var total = 0;
		document.getElementById('paymentrecord').innerHTML = '';
		localStorage.setItem('forArr', JSON.stringify(forArr));
		localStorage.setItem('forBtn', JSON.stringify(forBtn));
		localStorage.setItem('forCode', JSON.stringify(forCode));
		for(var i = 0; i < forArr.length; i++) {
			document.getElementById(forBtn[i]).getElementsByTagName('i')[0].setAttribute('class', 'fa fa-check');
			document.getElementById(forBtn[i]).getElementsByTagName('i')[0].setAttribute('style', 'color: #28a745;');

			document.getElementById('paymentrecord').innerHTML += '<tr><td>'+forArr[i][2]+'<input type="hidden" name="chgapp_id[]" value="'+forArr[i][4]+'"><input type="hidden" name="desc[]" value="'+forArr[i][2]+'"></td><td>&#8369;'+forArr[i][3]+'<input type="hidden" name="amount[]" value="'+forArr[i][3]+'"></td><td class="text-center"><i class="fa fa-times-circle" style="cursor: pointer;color: #C60000;" onclick="delSummary('+i+')"></i></td></tr>';
			total=total+parseInt(forArr[i][3]);
		}
		document.getElementById('tlpymnt').innerHTML = total;
	}
	function delSummary(inf) {
		document.getElementById(forBtn[inf]).getElementsByTagName('i')[0].setAttribute('class', 'fa fa-plus-circle');
		document.getElementById(forBtn[inf]).getElementsByTagName('i')[0].setAttribute('style', 'cursor: pointer; color: #28a745;');

		forArr.splice(inf, 1);
		forBtn.splice(inf, 1);
		forCode.splice(inf, 1);
		disp_dt();
	}
	function onLoadCheck() {
		if(localStorage.getItem('forArr') != null || localStorage.getItem('forArr') != undefined) {
			forArr = JSON.parse(localStorage.getItem('forArr'));
			forBtn = JSON.parse(localStorage.getItem('forBtn'));
			forCode = JSON.parse(localStorage.getItem('forCode'));
			curOop = localStorage.getItem('curOop');
			cur_fac = localStorage.getItem('cur_fac');
		}
	}
	function change_aft(div_cl) {
		var forInterval_cl;
		var bool_stat;
		clearTimeout(forInterval_cl);
		forInterval_cl = setInterval(function() {
			stickHeight_curr = document.getElementById('getId').offsetHeight;
			bool_stat = document.getElementById(div_cl).classList.contains('show');
			if(bool_stat == true) {
				reuse++;
				stickHeight_aft = document.getElementById('getId').offsetHeight;
				clearTimeout(forInterval_cl);
				sticktop();
			} else {
				if(reuse > 0) { reuse--; }
				stickHeight_aft = stickHeight_mn;
				clearTimeout(forInterval_cl);
				// suwayandaw(document.getElementById('getId').offsetHeight);
			}
		}, 430);
	}
	function suwayandaw(stHeight) {
		stickHeight_aft = stHeight;
	}
	// function stickTopGroup() {
	// 	var downDiv = document.getElementById('myTabContent').offsetTop + document.getElementById('formSubmit').offsetTop;
	// 	if(window.scrollY < downDiv) {

	// 	} else {
	// 		document.getElementById('forStick').getElementsByClassName('card')[0].getElementsByClassName('card-body')[0].style.marginTop = document.getElementsByClassName('sticky-top')[0].offsetHeight + (window.scrollY - downDiv)+'px';
	// 	}
	// }
	window.addEventListener('load', function() {
		onLoadCheck();
	});
	setInterval(sticktop, -1);
	nst(0);
</script>
<hr>
@include('client.sitemap')
@endsection