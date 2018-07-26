@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
<datalist id="test_list">
  {{-- @foreach ($uploads as $upload)
   <option  value="{{$upload->updesc}}" data-id="{{$upload->upid}}"></option>
  @endforeach --}}
</datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Manage Charges <a href="" title="Add New" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>  
        </div>
        <div class="card-body">
          <div style="float:left;margin-bottom: 5px">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Order of Payment">
              <datalist id="grp_list">
                @foreach ($OOPs as $OOP)
                  <option value="{{$OOP->oop_id}}">{{$OOP->oop_desc}}</option>
                @endforeach
              </datalist>
              <datalist id="mod_list">
               {{--  @foreach ($modules as $module)
                  <option value="{{$module->mod_id}}">{{$module->mod_desc}}</option>
                @endforeach --}}
              </datalist>
              &nbsp;
              {{-- <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="chckIn()">Save</button> --}}
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
          <span id="showSucc">
          
          </span>
          <div class="table-responsive">
            <table class="table table-hover display" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 10%">Type</th>
                  <th style="width: 10%">#</th>
                  <th style="width: 30%">Charge</th>
                  <th style="width: 15%"><center>Amount</center></th>
                  <th style="width: 35%"><center>Option</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                {{-- @if ($BigData)
                  @foreach ($BigData as $d)
                  @php
                    $sq = "";
                      if ($TotalNumber > 1) {
                        if ($d->chgopp_seq == 1) {$sq='&nbsp;<a href="#"><button onclick="Rearranged(\'down\', '.$d->oop_id.', '.$d->chgopp_seq.','.$d->chgopp_id.')" class="btn btn-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                        else if ($d->chgopp_seq > 1 && $d->chgopp_seq < $TotalNumber) {$sq = '&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''.$d->oop_id.'\','.$d->chgopp_seq.','.$d->chgopp_id.')" class="btn btn-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>&nbsp;<a href="#"><button  onclick="Rearranged(\'down\',\''.$d->oop_id.'\','.$d->chgopp_seq.','.$d->chgopp_id.')" class="btn btn-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                        else {$sq='&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''.$d->oop_id.'\','.$d->chgopp_seq.','.$d->chgopp_id.')" class="btn btn-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>';}

                      }
                  @endphp
                    <tr>
                      <td>{{$d->oop_id}}</td>
                      <td>{{$d->chg_desc}}</td>
                      <td><center>{{$d->amt}}</center></td>
                      <td><center>
                        <a href="#"><button data-toggle="modal" data-target="#ShowMeTheMoney" onclick="AddAmt({{$d->amt}}, {{$d->chgapp_id}}, '{{$d->chg_desc}}')" class="btn btn-success" title="Modify Amount"><i class="fa fa-edit"></i></button></a>&nbsp;
                        <a href="#"><button  onclick="DelUploaded({{$d->chgopp_id}}, '{{$d->chg_desc}}', {{$d->oop_desc}}, '{{$d->oop_id}}')" class="btn btn-danger" title="Remove Charge"><i class="fa fa-trash"></i></button></a>{{$sq}}
                      </center></td>
                    </tr>
                  @endforeach
                @endif --}}
              </tbody>
            </table>
            </div>
        </div>
    </div>
      </div>
      <div class="modal fade" id="ShowMeTheMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Modify Amount for <span id="ifActiveTitle"></span></strong></h5>
              <hr>
              <div class="container">
                <form  id="AddAmount" class="row" data-parsley-validate>
                  <div class="col-sm-12" id="Error"></div>
                  <input type="text" id="PutTypeIDhere" name="" hidden>
                  <div class="col-sm-4">
                    Enter Amount:
                  </div>
                  <div class="col-sm-8" id="ShowTheMoneyBox">
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Modify</button>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                    </div>
                  </div> 
                </form>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="ShowDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Delete Charge</span></strong></h5>
              <hr>
              <div class="container">
                <form  id="DelCharge" class="row" data-parsley-validate>
                  <div class="col-sm-12" id="Error"></div>
                  <input type="text" id="PutTypeIDhere4Delete" name="" hidden>
                  <input type="text" id="PutTypeOOP_IDhere4Delete" name="" hidden>
                  <div class="col-sm-12" id="DelMessage">
                    {{-- Enter Amount: --}}
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                    </div>
                  </div> 
                </form>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add Charge in Order of Payment</strong></h5>
              <hr>
              <form id="NewFacServIn" action="#" class="row" data-parsley-validate>
                  <div class="col-sm-4">Order of Payment :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                   <select id="appID" data-parsley-required-message="*<strong>Order of Payment</strong> required" class="form-control" required>  
                          <option value="">Select Order of Payment ...</option>
                          @foreach ($OOPs as $OOP)
                            <option value="{{$OOP->oop_id}}">{{$OOP->oop_desc}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-sm-4">Charge :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                  	<input type="text" id="FacServID" data-parsley-required-message="*<strong>Charge</strong> required" class="form-control" list="chrges_list" required>
                   {{-- <select id="FacServID" data-parsley-required-message="*<strong>Charge</strong> required" class="form-control" required>   --}}
                          <datalist id="chrges_list">
                          @foreach ($Chrgs as $Chrg)
                            <option value="{{$Chrg->chg_code}}">{{$Chrg->chg_desc}}</option>
                          @endforeach
                          </datalist>
                      {{-- </select> --}}
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add Charge</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    <script type="text/javascript">
     $(document).ready(function() {
         $('#example').DataTable();
      } );
    	function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        $.ajax({
                url: " {{asset('mf/getChgOOP')}}",
                method: 'POST',
                data: {
                  _token : token,
                  id : id,
                },
                success: function(data) {
                  if (data == 'NONE') {
                    $('#FilterdBody').empty();
                  } else {
                    $('#FilterdBody').empty();
                    var table = $('#example').DataTable();
                    table.clear().draw();
                    var x = data.data;
                    for (var i = 0; i < x.length; i++) {
                    	var d = data.data[i];
                    	var sq = "";
                    	if (data.TotalNumber > 1) {
                    		if (d.chgopp_seq == 1) {sq='&nbsp;<a href="#"><button onclick="Rearranged(\'down\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgopp_id+')" class="btn btn-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                    		else if (d.chgopp_seq > 1 && d.chgopp_seq < data.TotalNumber) {sq = '&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgopp_id+')" class="btn btn-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>&nbsp;<a href="#"><button  onclick="Rearranged(\'down\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgopp_id+')" class="btn btn-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                    		else {sq='&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgopp_id+')" class="btn btn-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>';}

                    	}
                    	$('#example').DataTable()
                           .row
                           .add([d.oop_id, d.chgopp_seq,d.chg_desc,
                                  '<center>' + d.amt + '</center>',
                                  '<center>'+
                              '<a href="#"><button data-toggle="modal" data-target="#ShowMeTheMoney" onclick="AddAmt('+d.amt+','+d.chgapp_id+',\''+d.chg_desc+'\')" class="btn btn-success" title="Modify Amount"><i class="fa fa-edit"></i></button></a>&nbsp;'+
                              '<a href="#"><button  onclick="DelUploaded('+d.chgopp_id+',\''+d.chg_desc+'\', \''+d.oop_desc+'\',\''+d.oop_id+'\')" class="btn btn-danger" title="Remove Charge"><i class="fa fa-trash"></i></button></a>'+sq +
                            '</center>'
                              ])
                           .draw();
                    	// $('#FilterdBody').append(
                    	// 		'<tr>' +
                     //      '<td>'+d.oop_id+'</td>'+
                    	// 			'<td>'+d.chg_desc+'</td>'+
                    	// 			'<td><center>'+d.amt+'</center></td>'+
                    	// 			'<td><center>'+
                    	// 				'<a href="#"><button data-toggle="modal" data-target="#ShowMeTheMoney" onclick="AddAmt('+d.amt+','+d.chgapp_id+',\''+d.chg_desc+'\')" class="btn btn-success" title="Modify Amount"><i class="fa fa-edit"></i></button></a>&nbsp;'+
                    	// 				'<a href="#"><button  onclick="DelUploaded('+d.chgopp_id+',\''+d.chg_desc+'\', \''+d.oop_desc+'\',\''+d.oop_id+'\')" class="btn btn-danger" title="Remove Charge"><i class="fa fa-trash"></i></button></a>'+sq +
                    	// 			'</center></td>'+
                    	// 		'</tr>'
                    	// 	);
                    }
                  }
                }
            });
      }
      $('#NewFacServIn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              $.ajax({
                      // url: "{{asset('employee/dashboard/mf/typefa')}}",
                      method: 'POST',
                      data: {_token:$('input[name="_token"]').val(),oop_id:$('#appID').val(),chg_code:$('#FacServID').val()},
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Charge in an Application');
                            window.location.href = "{{ asset('employee/dashboard/mf/chg_oop') }}";
                        } else if (data == 'SAME') {
                            alert('Charge is already in the selected Order of Payment');
                            $('#FacServID').focus();
                        }
                      }
                  });
          }
      });
      
      function Rearranged(type,oop_id,seq_num,chgopp_id){
      	$.ajax({
      		url : '{{ asset('/mf/rearrange_oop') }}',
      		method : 'POST',
      		data : {_token:$('input[name="_token"]').val(), type:type,oop_id:oop_id,seq_num:seq_num,chgopp_id:chgopp_id},
      		success : function(data){
      			if (data == 'DONE') {
                alert('Successfully Rearranged');
                filterGroup();

              }
      		},
      	});
      }
      function AddAmt(amt, chgapp_id, chg_desc){
      	$('#ifActiveTitle').empty();
      	$('#ifActiveTitle').append(chg_desc);

      	$('#ShowTheMoneyBox').empty();
      	$('#ShowTheMoneyBox').append(
      		'<input type="test" class="form-control" id="selectedAMOUNT" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-required-message="*<strong>Amount</strong> required." required>'
      		);

      	$('#selectedAMOUNT').removeAttr('placeholder');
      	$('#selectedAMOUNT').attr('placeholder', amt);

      	$('#PutTypeIDhere').attr('value','');
      	$('#PutTypeIDhere').attr('value',chgapp_id);
      }
      $('#AddAmount').on('submit',function(event){    
      	event.preventDefault();
      	var form = $(this);
      	form.parsley().validate();
        if (form.parsley().isValid()) {
        	$.ajax({
        		url: '{{ asset('/mf/save_amt') }}' ,
        		method : 'POST',
        		data : {_token:$('input[name="_token"]').val(),amt : $('#selectedAMOUNT').val(),id : $('#PutTypeIDhere').val()},
        		success : function(data){
        				if (data == 'DONE') {
        					alert('Successfully Updated Amount');
               	 			filterGroup();
               	 			$('#ShowMeTheMoney').modal('toggle');
        				}
        		},
        	});
        }
      });
      function DelUploaded(chgopp_id, chg_desc, oop_desc,oop_id){
        $('#DelMessage').empty();
        $('#DelMessage').append('Are you sure want to delete <span style="color:red;font-weight:bold">'+chg_desc+'</span> in ' + oop_desc + '?');

        // $('#PutTypeIDhere4Delete').attr('value','');
        $('#PutTypeIDhere4Delete').attr('value',chgopp_id);

        // $('#PutTypeOOP_IDhere4Delete').attr('value','');
        $('#PutTypeOOP_IDhere4Delete').attr('value',oop_id);

        $('#ShowDelete').modal('toggle');
      }
      $('#DelCharge').on('submit',function(event){
      	event.preventDefault();
      	$.ajax({
      		url : '{{ asset('/mf/del_chrg_oop') }}',
      		method : 'POST',
      		data : {_token:$('input[name="_token"]').val(), id : $('#PutTypeIDhere4Delete').val(), oop_id : $('#PutTypeOOP_IDhere4Delete').val()},
      		success : function(data){
      			if (data == 'DONE') {
      				alert('Successfully deleted a Charge');
      				filterGroup();
      				$('#ShowDelete').modal('toggle');
      			}
      		},
      	});
      });
    </script>
@endsection