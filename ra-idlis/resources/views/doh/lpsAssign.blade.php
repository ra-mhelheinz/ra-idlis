@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
@php
   $employeeData = session('employee_login');
@endphp
<input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assign Applicants
        </div>
        <div class="card-body table-responsive">
            <div style="float:left;margin-bottom: 5px">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Application Type">
              &nbsp;
              <select  class="form-control"  id="fa_list" onchange="" placeholder="Health Facility/Service">
                        <option value="">Select Application Type.. </option>
               </select>
               <datalist id="grp_list">
                @foreach ($types as $type)
                  <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                @endforeach
              </datalist>
              &nbsp;
              @if ($employeeGRP == "NA")
              <input type="text" class="form-control" id="filtererReg" list="rgn_list" onchange="" placeholder="Select Region">
              @else
              <input type="text" id="filtererReg" name="" value="{{$employeeREGION}}" hidden> 
              @endif
              <datalist id="rgn_list">
                @foreach ($regions as $region)
                  <option value="{{$region->rgn_desc}}">{{$region->rgnid}}</option>
                @endforeach
              </datalist>
              &nbsp;
              <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="FilterData('{{$employeeGRP}}',{{$employeeREGION}});">Filter</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
            <table class="table table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th scope="col" width="10%" style="text-align:center">Type</th>
                    <th scope="col" width="10%" style="text-align:center">Application Code</th>
                    <th scope="col" width="20%" style="text-align:center">Name of Health Facility</th>
                    <th scope="col" width="20%" style="text-align:center">Current Assigned Region - LO/FDA</th>
                    {{-- <th scope="col" style="text-align:center">Current Assigned </th> --}}
                    <th scope="col" width="10%" style="text-align:center">Current Status</th>
                    <th scope="col" width="30%" style="text-align:center">Options</th>
                </tr>
                </thead>
                <tbody id="FilterdBody">
                @if (isset($BigData))
                  @foreach ($BigData as $data)
                  @php
                    $status = ''; $color = '';
                    $paid = $data->appid_payment;
                    $reco = $data->status;
                    if ($reco == 'P') {
                      $status = 'Pending';
                    }
                          // if ($data->isrecommended == null) {
                          //     $status = 'For Evaluation';
                          //     $color = 'black';
                          // }else if ($data->isrecommended == 1) {
                          //   $status = 'Application Approved';
                          //   $color = 'green';
                          // }
                          // if ($paid == null) {
                          //     $status = 'For Evaluation (Not Paid)';
                          //     $color = 'red';
                          // }
                  @endphp
                    <tr>
                      <td style="text-align:center">{{$data->hfser_id}}</td>
                      <td style="text-align:center">{{$data->hfser_id}}R{{$data->assignedRgn}}-{{$data->appid}}</td>
                      <td style="text-align:center"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:center">{{$data->rgn_desc}} - <strong>{{$data->formattedLOName}}</strong></td>
                      <td style="text-align:center;font-weight:bold;">{{$data->trns_desc}}</td>
                      <td style="text-align:center">
                        @if($employeeData->grpid == 'NA'))
                        <button style="background-color: #ffbc00f7" title="Change Assigned Region" type="button" class="btn-defaults" data-toggle="modal" data-target="#GoddessModal" onclick="showChangeRgnLO({{$data->appid}}, '{{$employeeGRP}}', {{$employeeREGION}});"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                        @endif
                          @if ($employeeData->grpid == 'RA')
                            <button style="background-color: #00ff1ff7" title="Assign LO" data-target="#GoderModal" data-toggle="modal" type="button" class="btn-defaults" onclick="PutAppID({{$data->appid}}, '{{$data->assignedRgn}}', '{{$employeeGRP}}')"><i class="fa fa-fw fa-plus" ></i></button>&nbsp;
                          @endif
                        <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn-defaults" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->facname}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}', '{{$data->ocdesc}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->streetname}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->appid_payment}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;
                      <button style="background-color: #00f9f9" title="View Change Region and LO History" type="button" class="btn-defaults" data-toggle="modal" data-target="#ShowHistory" onclick="ShowHistoryDetailsNow('{{$data->facilityname}}', {{$data->appid}})"><i class="fa fa-fw fa-history"></i></button>&nbsp;
                      </td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog {{-- modal-lg --}}" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>View Application</strong></h5>
              <hr>
              <div class="container">
                    <form id="ViewNow" data-parsley-validate>
                    <span id="ViewBody">
                    </span>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="modal fade" id="ShowHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong> Change History - <span id="ChangeHistoryFaciname"></span></strong></h5>
              <hr>
              <div class="container">
                    
                      <table class="table table-hover" style="color:white">
                        <thead>
                          <tr>
                            <th scope="col" width="25%" class="text-center">Date/Time</th>
                            <th scope="col" width="25%" class="text-center">Assigned at</th>
                            <th scope="col" width="25%" class="text-center">Assigned to</th>
                            <th scope="col" width="25%" class="text-center">Assigned by</th>
                          </tr>
                        </thead>
                        <tbody id="HistoryTableBody"></tbody>
                      </table>
                    
                    <div class="row">
                      <div class="col-sm-10">
                      {{-- <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;" onclick="SubmitChangeRgnLO()"><span class="fa fa-sign-up"></span>Save</button> --}}
                    </div> 
                    <div class="col-sm-2">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="modal fade" id="GoddessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog {{-- modal-lg --}}" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Changed Assigned Region @if ($employeeData->grpid != 'RA') and LO @endif</strong></h5>
              <hr>
              <div class="container">
                    <form id="ChangeRegLO" data-parsley-validate>
                    <div class="col-sm-12">
                      <div class="row">
                          <div class="col-sm-5"> Region<span style="color:red">*</span> :
                          </div>
                          <input type="text" id="SelectedAppFormID" value="" hidden>
                          <input type="text" id="SelectedEmployeeGrpID" value="" hidden>
                          <input type="text" id="SelectedEmployeeRgnID" value="" hidden>
                          <div class="col-sm-7" id="RgnInputHrere">
                              
                          </div>
                      </div>
                    </div>
                    @if ($employeeData->grpid != 'RA')<br>@endif
                    <div class="col-sm-12" @if ($employeeData->grpid == 'RA') hidden="" @endif>
                        <div class="row">
                          <div class="col-sm-5">Licensing Officer:
                          </div>
                          <div class="col-sm-7" id="LOInputHere">
                          </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;" onclick="SubmitChangeRgnLO()"><span class="fa fa-sign-up"></span>Save</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="modal fade" id="GoderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog {{-- modal-lg --}}" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Assign/Change Licensing Officer</strong></h5>
              <hr>
              <div class="container">
                    <div class="col-sm-12">
                      <form id="AssChageLO" data-parsley-validate>
                      <div class="row">
                          <input type="text"  id="GetAppIdHere" hidden>
                          <input type="text"  id="GetRgnIdHere" hidden>
                          <input type="text"  id="GetGrpIdHere" hidden>
                          <div class="col-sm-5">Licensing Officer:<span style="color:red">*</span> :
                          </div>
                          <div class="col-sm-7" id="LOHere"></div>
                      </div>
                    </form>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;" onclick="SubmitLO()"><span class="fa fa-sign-up"></span>Save</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
  function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        $.ajax({
                url: " {{asset('mf/getTypeFaci')}}",
                method: 'POST',
                data: {
                  _token : token,
                  hfser_id : id,
                },
                success: function(data) {
                  if (data == 'NONE') {
                      $('#fa_list').empty();
                      $('#fa_list').append('<option value="">No Health Facility/Service Registered.</option>');
                  } else {
                      $('#fa_list').empty();
                      $('#fa_list').append('<option value="">Select Health Facilty/Service</option>');
                    for (var i = 0; i < data.length; i++) {
                        $('#fa_list').append(
                              '<option value="'+data[i].facid+'">'+data[i].facname+'</option>'
                            );
                    }
                  }
                }
            });
      }
    function FilterData(grpID,rgnID){
        $('#FilterdBody').empty();
        var hfser_id = '';
        var facid = $('#fa_list').val();
        var rgnid = '';
        var ok = 1;
        var selectedAppType = $('#filterer').val();
        var appTypeNames = $('#grp_list option[value]').map(function () {return this.text}).get();  // Application Type Names
        var appTypeID = $('#grp_list option[value]').map(function () {return this.value}).get();  // Application Type IDs
        var testAppType = $.inArray(selectedAppType.toUpperCase(),appTypeID); // Check

        if (testAppType < 0 ) { // Not Found
            alert('PLEASE SELECT APPLICATION TYPE.');
            $('#filterer').focus();
            ok = 0;
        } else if (facid == '') { // Not Found
            alert('PLEASE SELECT FACILITY FACILITY/SERVICE');
            $('#fa_list').focus();
            ok = 0;
        }else {

            hfser_id = appTypeID[testAppType];
            if (grpID == 'NA') {
              var selected = $('#filtererReg').val(); // Selected
              var names = $('#rgn_list option[value]').map(function () {return this.value}).get(); // Array for Names
              var id = $('#rgn_list option[value]').map(function () {return this.text}).get(); // Array for IDs
              var test = $.inArray(selected,names); // Check 
              if (test < 0) {
                alert('PLEASE SELECT A REGION');
                $('#filtererReg').focus();
                ok = 0;
              } else {
                rgnid = id[test];
              }
          } else {
            rgnid = '{{$employeeREGION}}';
          } 
        }

        if (ok == 1) {
          $.ajax({
              url: '{{asset('/lps/getLPS4Assigned')}}',
              method: 'POST',
              data : {_token : $('#token').val(), hfser_ID : hfser_id, facID : facid, rgnID : rgnid},
              success : function(data){
                // console.log(data);
                  if (data != 'NONE') {
                      $('#FilterdBody').empty();
                      for (var i = 0; i < data.length; i++) {
                          var status = '';
                          var paid = data[i].appid_payment;
                          var reco = data[i].isrecommended;
                          if (data[i].isrecommended == null) {
                              status = '<span style="font-weight:bold;">For Evaluation</span>';
                          }else if (data[i].isrecommended == 1) {
                            status = '<span style="color:green;font-weight:bold;">Application Approved</span>';
                          }
                          if (paid == null) {
                              status = '<span style="color:red;font-weight:bold;">For Evaluation (Not Paid)</span>';
                          }
                          // var app = data[i].approved
                          $('#FilterdBody').append(
                                '<tr>'+
                                /// 'R'+data[i].rgnid+'
                                  '<td style="text-align:center">' + data[i].hfser_id + '</td>' +
                                  '<td style="text-align:center">' + data[i].hfser_id + 'R'+data[i].assignedRgn+'-' + data[i].appid + '</td>' +
                                  '<td style="text-align:center"><strong>'+data[i].facilityname+'</strong></td>' +
                                  // '<td style="text-align:center">'+data[i].rgn_desc+'</td>'+
                                  '<td style="text-align:center">'+data[i].rgn_desc+' - <strong>'+data[i].formattedLOName+'</strong></td>'+
                                  // '<td>'+data[i].aptdesc+'</td>' +
                                  '<td style="text-align:center;font-weight:bold">'+data[i].trns_desc+'</td>'+
                                  '<td style="text-align:center">'+
                                        '<button style="background-color: #ffbc00f7" title="Change Assigned Region" type="button" class="btn-defaults" data-toggle="modal" data-target="#GoddessModal" onclick="showChangeRgnLO('+data[i].appid+', \''+grpID+'\', '+rgnID+');"><i class="fa fa-fw fa-edit"></i></button>&nbsp;' +
                                        @if ($employeeData->grpid == 'RA')
                                          '<button style="background-color: #00ff1ff7" title="Assign LO" data-target="#GoderModal" data-toggle="modal" type="button" class="btn-defaults" onclick="PutAppID('+data[i].appid+', \''+data[i].assignedRgn+'\', \''+grpID+'\')"><i class="fa fa-fw fa-plus" ></i></button>&nbsp;' + 
                                        @endif
                                        '<button type="button" title="View detailed information for '+data[i].facilityname+'" class="btn-defaults" onclick="showData('+data[i].appid+',\''+data[i].aptdesc+'\', \''+data[i].authorizedsignature+'\',\''+data[i].brgyname+'\', \''+data[i].classname+'\' ,\''+data[i].cmname+'\', \''+data[i].email+ '\', \''+data[i].facilityname+'\',\''+data[i].facname+'\', \''+data[i].formattedDate+'\', \''+data[i].formattedTime+'\', \''+data[i].hfser_desc+'\',\''+data[i].ocdesc+'\', \''+data[i].provname+'\',\''+data[i].rgn_desc+'\', \''+data[i].streetname+'\', \''+data[i].zipcode+'\', \''+data[i].isrecommended +'\', \''+data[i].hfser_id+'\', '+data[i].appid_payment+', \''+data[i].trns_desc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;'+
                                        '<button style="background-color: #00f9f9" title="View Change Region and LO History" type="button" class="btn-defaults" data-toggle="modal" data-target="#ShowHistory" onclick="ShowHistoryDetailsNow(\''+data[i].facilityname+'\', '+data[i].appid+')"><i class="fa fa-fw fa-history"></i></button>&nbsp;' +
                                  '</td>'+
                                '</tr>'
                            );
                      }
                  } else if (data== 'NONE'){
                    alert('Currently No Applications in this type.');
                  } else if (data == 'ERROR'){
                    $('#ERROR_MSG2').show(100);
                  }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#ERROR_MSG2').show(100);
              },
          });

        }        
    }

    function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, streetname, zipcode, isrecommended, hfser_id, appid_payment, transStatus){
        var status = '';
        var paid = appid_payment;
        // if (isrecommended == null) {
        //     status = "For Evaluation";
        //   }else if (isrecommended == 1) {
        //     status = '<span style="color:green;font-weight:bold;">Application Approved</span>';
        //   }
        // if (paid == null) {
        //      status = '<span style="color:red;font-weight:bold;">For Evaluation (Not Paid)</span>';
        //   } 
        $('#ViewBody').empty();
        $('#ViewBody').append(
            '<div class="row">'+
                '<div class="col-sm-4">Facility Name:' +
                '</div>' +
                '<div class="col-sm-8">' + facilityname +
                '</div>' +
            '</div>' +
            // '<br>' + 
            '<div class="row">'+
                '<div class="col-sm-4">Address:' +
                '</div>' +
                '<div class="col-sm-8">' + streetname + ', ' + brgyname + ', ' + cmname + ', ' + provname + ' - ' + zipcode +
                '</div>' +
            '</div>' +
            '<div class="row">'+
                '<div class="col-sm-4">Owner:' +
                '</div>' +
                '<div class="col-sm-8">' + authorizedsignature + 
                '</div>' +
            '</div>' +
            '<div class="row">'+
                '<div class="col-sm-4">Applying for:' +
                '</div>' +
                '<div class="col-sm-8">' + hfser_id + ' ('+hfser_desc+') - ' + aptdesc +
                '</div>' +
            '</div>' +
            '<div class="row">'+
                '<div class="col-sm-4">Time and Date:' +
                '</div>' +
                '<div class="col-sm-8">' + formattedTime + ' - ' + formattedDate +
                '</div>' +
            '</div>' +
            '<div class="row">'+
                '<div class="col-sm-4">Status:' +
                '</div>' +
                '<div class="col-sm-8">' +transStatus +
                '</div>' +
            '</div>'
          );
    } 
    function showChangeRgnLO(apid,EmployeeGrp,EmployeeRgn){
       //RgnInputHrere   LOInputHere
       $('#RgnInputHrere').empty();
       $('#RgnInputHrere').append('<input type="text" id="SelectedRgnS" class="form-control" list="rgn_list" data-parsley-required-message="*<strong>Region</strong> required." onchange="SelectedRgn();" required>');
       $('#LOInputHere').empty();
       $('#LOInputHere').append('<select class="form-control" id="ShowLO" ></select>');
       $('#SelectedAppFormID').attr('value','');
       $('#SelectedAppFormID').attr('value',apid);
       // SelectedEmployeeGrpID SelectedEmployeeRgnID
       $('#SelectedEmployeeGrpID').attr('value', '');
       $('#SelectedEmployeeGrpID').attr('value', EmployeeGrp);

       $('#SelectedEmployeeRgnID').attr('value', EmployeeRgn);
    }
    function SelectedRgn(){
       var id = $('#SelectedRgnS').val();
                var arr2 = $('#rgn_list option[value]').map(function () {return this.text}).get();
                var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                // console.log(arr);
                var test = $.inArray(id,arr);
                if (test != -1) {
                   var selectedID = arr2[test];
                   $.ajax({
                        url : '{{ asset('mf/getGetLO') }}',
                        method : 'POST',
                        data : {_token : $('#token').val(), rgnid : selectedID},
                        success : function(data){
                          $('#ShowLO').empty();
                          if (data != 'NONE') {
                                $('#ShowLO').append('<option value=""></option>');
                                for (var i = 0; i < data.length; i++) {
                                  var d =  data[i], middle = '';
                                  if (d.mname != "") {
                                    middle = d.mname;
                                    middle = middle.charAt(0) + '.'
                                  }
                                  var name = d.lname + ', ' + d.fname + ' ' + middle;
                                  $('#ShowLO').append('<option value="'+d.uid+'">'+name+'</option>');
                                }
                          } else {
                            $('#ShowLO').append('<option value="">Currently no registered Licensing Officer</option>');
                          }
                        },
                   });
                } else {
                  alert("Error : Region didn't exists.");
                }
    }
    function SubmitChangeRgnLO(){
      var form = $('#ChangeRegLO');
      form.parsley().validate();
      if (form.parsley().isValid()) {
        var id = $('#SelectedRgnS').val();
                var arr2 = $('#rgn_list option[value]').map(function () {return this.text}).get();
                var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                // console.log(arr);
                var test = $.inArray(id,arr);
                var selectedID = arr2[test];
          $.ajax({
            url : '{{ asset('mf/save_rgnLo') }}',
            method : 'POST',
            data : {_token : $('#token').val(), lo : $('#ShowLO').val(), rgnid : selectedID, appid : $('#SelectedAppFormID').val()},
            success : function(data){
                if (data == 'DONE') {
                  var GrpID =  $('#SelectedEmployeeGrpID').attr('value');
                  var RgnID = $('#SelectedEmployeeRgnID').attr('value');
                  alert('Successfully Changed Application');
                  // FilterData(GrpID, RgnID);
                  // $('#GoddessModal').modal('toggle');
                  location.reload();
                }
            },
          });
      }
    }
    function ShowHistoryDetailsNow(facilityname,appid){
        $('#ChangeHistoryFaciname').empty();
        $('#ChangeHistoryFaciname').append(facilityname);

        $.ajax({
          url : '{{ asset('mf/getGetChangeHistory') }}',
          method : 'POST',
          data : {_token : $('#token').val(), appid : appid},
          success : function (data){
            $('#HistoryTableBody').empty();
              if (data != 'NONE') {
                  for (var i = 0; i < data.length; i++) {
                      var d = data[i];
                      $('#HistoryTableBody').append(
                          '<tr>'+
                              '<td class="text-center font-weight-bold">'+d.formattedDate+' '+d.formattedTime+'</td>'+
                              '<td class="text-center">'+d.rgn_desc+'</td>'+
                              '<td class="text-center">'+d.assignedTo+'</td>'+
                              '<td class="text-center">'+d.name+'</td>'+
                          '</tr>'
                        );
                  }
              }
          }
        });
    }
    function PutAppID(appid,rgnid,grp){
      //   
      $('#GetAppIdHere').attr('value','');
      $('#GetRgnIdHere').attr('value','');
      $('#GetGrpIdHere').attr('value','');
      $('#GetAppIdHere').attr('value',appid);
      $('#GetRgnIdHere').attr('value',rgnid);
      $('#GetGrpIdHere').attr('value',grp);

      $('#LOHere').empty();
      $('#LOHere').append('<select class="form-control" id="GETLOHere" data-parsley-required-message="*<strong>LO</strong> required." required></select>');

      $.ajax({
        url : '{{ asset('mf/getGetLO') }}',
        method : 'POST',
        data : {_token : $('#token').val(), rgnid : rgnid},
        success : function(data){
          $('#GETLOHere').empty();
          if (data !== "NONE") {
            $('#GETLOHere').append('<option value=""></option>');
            for (var i = 0; i < data.length; i++) {
              var d =  data[i], middle = '';
                if (d.mname != "") {
                     middle = d.mname;
                     middle = middle.charAt(0) + '.'
                   }
                var name = d.lname + ', ' + d.fname + ' ' + middle;
                $('#GETLOHere').append('<option value="'+d.uid+'">'+name+'</option>');
            }
          } else {
            $('#GETLOHere').append('<option value=""></option>');
          }
        }

      });
    }
    function SubmitLO (){
      var form = $('#AssChageLO');
      form.parsley().validate();
      if (form.parsley().isValid()) {
        $.ajax({
          url : '{{ asset('mf/save_newLO') }}',
          method : 'POST',
          data : {_token : $('#token').val(), appid :  $('#GetAppIdHere').val(), rgnid : $('#GetRgnIdHere').val(), lo : $('#GETLOHere').val() },
          success : function (data){
                if (data!= "SAME") {
                  var RgnID = $('#GetRgnIdHere').attr('value');
                  var GrpID =  $('#GetGrpIdHere').attr('value');
                  alert('Successfully Assigned/Changed LO');
                  FilterData(GrpID, RgnID);
                  $('#GoderModal').modal('toggle');
                } else {
                  alert('Selected Licensing Officer is already assigned in this application.');
                }
          },
      });
      }
    }
    function AddLONow(){}
</script>
@endsection