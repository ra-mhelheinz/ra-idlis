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
           Assignment of Teams
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
              <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" {{-- onclick="FilterData('{{$employeeGRP}}',{{$employeeREGION}});" --}}>Filter</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
            <table class="table table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th scope="col" width="auto" style="text-align:center">Type</th>
                    <th scope="col" width="auto" style="text-align:center">Application Code</th>
                    <th scope="col" width="auto" style="text-align:center">Name of Health Facility</th>
                    <th scope="col" width="auto" style="text-align:center">Current Assigned Team</th>
                    {{-- <th scope="col" style="text-align:center">Current Assigned </th> --}}
                    <th scope="col" width="auto" style="text-align:center">Current Status</th>
                    <th scope="col" width="auto" style="text-align:center">Options</th>
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
                      <td style="text-align:center">
                        <strong>
                          @isset($data->hasAssessors) 
                            @if($data->hasAssessors == 'F') 
                              <span style="color:red;">Not Yet Assigned</span> 
                            @else
                               <button class="btn btn-info" data-toggle="modal" data-target="#GoddestModal" onclick="getAllMembers({{$data->appid}});"><i class="fa fa-fw fa-eye"></i> Show Team</button>
                            @endif 
                          @endisset
                        </strong></td>
                      <td style="text-align:center;font-weight:bold;">{{$data->trns_desc}}</td>
                      <td style="text-align:center">
                        @isset($data->hasAssessors) 
                          @if($data->hasAssessors == 'F')
                              @if($employeeData->grpid == 'NA')
                                <button style="background-color: #28a745;color: #FFFFFFFF" title="Add Assessors" type="button" class="btn-defaults" data-toggle="modal" data-target="#GoddessModal" onclick="showChangeRgnLO({{$data->appid}}, '{{$employeeGRP}}', {{$employeeREGION}});"><i class="fa fa-fw fa-plus"></i></button>&nbsp;
                              @endif
                              @if ($employeeData->grpid == 'RA')
                                <button style="background-color: #00ff1ff7" title="Assign LO" data-target="#GoderModal" data-toggle="modal" type="button" class="btn-defaults" onclick="PutAppID({{$data->appid}}, '{{$data->assignedRgn}}', '{{$employeeGRP}}')"><i class="fa fa-fw fa-plus" ></i></button>&nbsp;
                              @endif
                          @else
                          @endif 
                        @endisset
                        
                        <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn-defaults" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->facname}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}', '{{$data->ocdesc}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->streetname}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->appid_payment}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;
                      {{-- <button style="background-color: #00f9f9" title="View Change Region and LO History" type="button" class="btn-defaults" data-toggle="modal" data-target="#ShowHistory" onclick="ShowHistoryDetailsNow('{{$data->facilityname}}', {{$data->appid}})"><i class="fa fa-fw fa-history"></i></button>&nbsp; --}}
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Assign Assessors{{-- Changed Assigned Region @if ($employeeData->grpid != 'RA') and LO  @endif --}}</strong></h5>
              <hr>
              <div class="container">
                    <form id="ChangeRegLO" data-parsley-validate>
                      <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                    <input type="text" id="appIDHere" hidden="">
                    <div class="col-sm-12">
                      <div class="row">
                          <div class="col-sm-5">&nbsp;Region :
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
                          <div class="col-sm-5">Teams:
                          </div>
                          <div class="col-sm-7" id="LOInputHere">
                          </div>
                      </div>
                    </div>
                    <hr>
                    <hr>
                      <div class="col-sm-12">
                        <center>Members</center>
                      </div>
                      <hr>
                      <div class="col-sm-12" id="PutTableHERE">
                        
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
  <div class="modal fade" id="GoddestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog {{-- modal-lg --}}" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Assessors</strong></h5>
              <hr>
              {{-- <div class="container"> --}}
                    <div class="col-sm-12 table-responsive" >
                      <form id="" data-parsley-validate>
                        <input type="text" id="anotherSelectedID4Members" hidden>
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="TeamAsseErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#TeamAsseErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                       <table class="table">
                          <thead id="GoderModalTHead">
                            
                          </thead>
                          <tbody id="GoderModalTBody">
                            
                          </tbody>
                       </table> 
                      </form>
                    </div>
                    <hr>
                    <div class="row" id="GoderModalButtons">
                      
                    </div>
                  </form>
              {{-- </div> --}}
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
  var ToBeAddedMembers = [];
  $(function () {
    $('[data-toggle="popover"]').popover()
  })
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
       $('#RgnInputHrere').append('<input type="text" id="SelectedRgnS" class="form-control" list="rgn_list"  onchange="SelectedRgn();" >');
       // data-parsley-required-message="*<strong>Region</strong> required." required
       $('#LOInputHere').empty();
       $('#LOInputHere').append('<select class="form-control" id="ShowLO" onchange="getMembers()"></select>');
       $('#SelectedAppFormID').attr('value','');
       $('#SelectedAppFormID').attr('value',apid);
       $('#SelectedEmployeeGrpID').attr('value', '');
       $('#SelectedEmployeeGrpID').attr('value', EmployeeGrp);

       $('#SelectedEmployeeRgnID').attr('value', EmployeeRgn);

       $('#PutTableHERE').empty();
       $('#PutTableHERE').append(
          '<table class="table">' + 
            '<thead>' +
                '<tr>' + 
                  '<th style="width: 20%;text-align: center">&nbsp;</th>' +
                  '<th style="width: 40%;text-align: center">Name</th>' +
                  '<th style="width: 40%;text-align: center">Remarks</th>' +
                '</tr>' +
            '</thead>' +
            '<tbody id="MembersTable">' +
            '</tbody>' +
          '</table>'
        );

       $('#appIDHere').val(apid);
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
                        url : '{{ asset('mf/get_teams') }}',  // {{ asset('mf/getGetLO') }}
                        method : 'POST',
                        data : {_token : $('#token').val(), rgn : selectedID},
                        success : function(data){
                          $('#ShowLO').empty();
                          if (data != 'NONE') {
                                $('#ShowLO').append('<option value=""></option>');
                                for (var i = 0; i < data.length; i++) {
                                  var d = data[i];
                                //   var d =  data[i], middle = '';
                                //   if (d.mname != "") {
                                //     middle = d.mname;
                                //     middle = middle.charAt(0) + '.'
                                //   }
                                //   var name = d.lname + ', ' + d.fname + ' ' + middle;
                                  // $('#ShowLO').append('<option value="'+d.uid+'">'+name+'</option>');
                                    $('#ShowLO').append('<option value="'+d.teamid+'">'+d.teamdesc+'</option>');
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
      var rmks = []; 
      var form = $('#ChangeRegLO');
      var SelectedId = $('#appIDHere').val();
      form.parsley().validate();
      // $('#MembersTable  tr[id]').map(function () {return $(this).attr('member')}).get();
      // $('#MembersTable  tr[class="Checkling"]').map(function () {return this.id}).get();
      // $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('member')}).get();
      if (form.parsley().isValid()) {
        var getIds = $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('member')}).get();
        var teams = $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('team')}).get();
        if (getIds.length == 0) {
          alert('ERROR');
        } else {
          for(var i = 0; i < getIds.length; i++){
              rmks[i] = $('#rmk_'+getIds[i]).val() ;
            }

            $.ajax({
                url : '{{ asset('/mf/add_team') }}',
                method : 'POST',
                data : {_token:$('#token').val(),rmks:rmks,ids:getIds,SelectedID : SelectedId, teams: teams},
                success : function(data){
                    if (data == 'ERROR') {
                      $('#AddErrorAlert').show(100);
                    } else if (data == 'DONE'){
                      alert('Successfully added assessor/s.')
                        window.location.href = "{{ asset('employee/dashboard/lps/assign') }}";
                    }
                },
                error : function(a,b,c){
                  console.log(c);
                  $('#AddErrorAlert').show(100);

                },
            });


        }
                // var id = $('#SelectedRgnS').val();
                // var arr2 = $('#rgn_list option[value]').map(function () {return this.text}).get();
                // var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                // // console.log(arr);
                // var test = $.inArray(id,arr);
                // var selectedID = arr2[test];
          // $.ajax({
          //   url : '{{ asset('mf/save_rgnLo') }}',
          //   method : 'POST',
          //   data : {_token : $('#token').val(), lo : $('#ShowLO').val(), rgnid : selectedID, appid : $('#SelectedAppFormID').val()},
          //   success : function(data){
          //       if (data == 'DONE') {
          //         var GrpID =  $('#SelectedEmployeeGrpID').attr('value');
          //         var RgnID = $('#SelectedEmployeeRgnID').attr('value');
          //         alert('Successfully Changed Application');
          //         // FilterData(GrpID, RgnID);
          //         // $('#GoddessModal').modal('toggle');
          //         location.reload();
          //       }
          //   },
          // });
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
    function getMembers(){
      var selectedTeam = $('#ShowLO').val();
      // ToBeAddedMembers
      if (selectedTeam != '') {
          $.ajax({
              url : '{{ asset('/mf/getMember') }}',
              method : 'POST',
              data : {_token : $('#token').val(), teamid : selectedTeam},
              success : function(data){
                if (data != 'ERROR') {
                    for (var i = 0; i < data.length; i++) {
                      var d = data[i];
                      var rowCount =  $('#MembersTable tr').length;
                      if (rowCount == 0) {
                        ToBeAddedMembers = [];
                      }
                      var test = $.inArray(d.uid,ToBeAddedMembers);

                      if (test == -1) {
                        $('#MembersTable').append(
                          '<tr class="Checkling" id="mem_'+d.uid+'" member="'+d.uid+'" team="'+d.team+'">' +
                              '<td >'+
                                '<div class="btn-group" role="group" aria-label="Basic example">' +
                                    '<button onclick="removeMember(1, \''+d.uid+'\')" title="Add" type="button" class="btn btn-outline-success chk_mem_'+d.uid+'" style="width:36px;display:none"><i class="fa fa-check"></i></button>&nbsp;'+
                                    '<button onclick="removeMember(0, \''+d.uid+'\')" title="Remove" type="button" class="btn btn-outline-danger wrng_mem_'+d.uid+'" style="width:36px"><i class="fa fa-times"></i></button>&nbsp;'+
                                    '<button onclick=""  type="button" class="btn btn-outline-info" style="width:36px" data-toggle="popover" data-placement="top" data-content="Position: '+d.position+'"><i class="fa fa-info"></i></button>'+
                                  '</div>' +
                              '</td>'+
                              '<td id="text_'+d.uid+'" style="color:green;font-weight:bold;text-align:center;">'+d.wholename+'</td>' +
                              '<td><textarea id="rmk_'+d.uid+'" rows="2" class="form-control"></textarea></td>' +
                          '</tr>'
                        );
                        ToBeAddedMembers.push(d.uid);
                      }
                      
                    }
                } else {
                    $('#AddErrorAlert').show(100);
                }
              },
              error : function(a,b,c){
                  console.log(c);
                  $('#AddErrorAlert').show(100);
              },
          });
      }
    }
    function removeMember(stats, uid){
      if (stats == 0) { // REMOVED
            $('.wrng_mem_'+uid).hide();
            $('.chk_mem_'+uid).show();
            $('#mem_'+uid).removeClass('Checkling');
            $('#text_'+uid).css('color','red');
      } else { // ADDED
          $('.chk_mem_'+uid).hide();
          $('.wrng_mem_'+uid).show()
          $('#mem_'+uid).addClass('Checkling');
          $('#text_'+uid).css('color','green');
      }
    }
    function getAllMembers(appid){
      $('#GoderModalTBody').empty();
      $('#anotherSelectedID4Members').val(appid);

      $('#GoderModalTHead').empty();
      $('#GoderModalTHead').append(
            '<tr>' +
            '<th width="auto" class="text-center" scope="col">Name</th>' +
            '<th width="auto" class="text-center" scope="col">Remarks</th>' +
            '<th width="auto" class="text-center memberEditMode" style="display:none" scope="col">Options</th>' + 
          '</tr>'
        );

      $('#GoderModalButtons').empty();
        $('#GoderModalButtons').append(
           ' <div class="col-sm-6">'+ 
            '<button type="button" class="btn btn-outline-warning form-control memberEditModeNot" style="border-radius:0;" onclick="EditTeamMode(1);">Edit</button>' +
              '<button type="button" class="btn btn-outline-success memberEditMode form-control" style="border-radius:0;display: none" onclick="saveEditMode()">Save</button>' +
            '</div>' + 
            '<div class="col-sm-6">' +
              '<button type="button" class="btn btn-outline-warning memberEditMode form-control" style="border-radius:0;display: none" onclick="EditTeamMode(0);"><span class="fa fa-sign-up"></span>Cancel</button>' +
                '<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control memberEditModeNot" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>'+
              '</div>'
          ); 

      $.ajax({
          url : '{{ asset('mf/getTeamMember') }}',
          method : 'POST',
          data : {_token : $('#token').val(), appid : appid},
          success : function(data){
            if (data == 'ERROR'){
                $('#TeamAsseErrorAlert').show(100);
            } else if(data == 'NONE'){
              alert('No data to be viewed or to be updated. Page will reload after a few seconds.');
              window.location.reload();
            } else {
                for (var i = 0; i < data.length; i++) {
                  var rmk  = data[i].remarks;
                  if (data[i].remarks == null) {
                      rmk = ' ';
                  }
                  $('#GoderModalTBody').append(
                      '<tr id="editMode_'+data[i].apptid+'" selectedapptId="'+data[i].apptid+'">' +
                          '<td class="text-center">'+data[i].wholename+'</td>' +
                          '<td><textarea rows="2" class="form-control editModeTextArea" id="theRMK_'+data[i].apptid+'"  disabled="">'+rmk+'</textarea></td>' +
                          '<td class="memberEditMode" style="display:none"><center>'+
                            '<button type="button" class="btn btn-outline-danger" title="Remove" onclick="deleteMemberNow('+data[i].apptid+', \''+data[i].appid+'\', \''+data[i].wholename+'\')"><i class="fa fa-fw fa-trash"></i></button>' + 
                          '</center></td>' +
                      '</tr>'
                    );
                  
                }
            } 
          },
          error : function(a,b,c){
            console.log(c);
            $('#TeamAsseErrorAlert').show(100);
          }
      });
    }
    function EditTeamMode(YesNo){
      if (YesNo == 1) {
        $('.memberEditMode').show();
        $('.memberEditModeNot').hide();
        $('.editModeTextArea').removeAttr('disabled');
      } else {
        $('.memberEditMode').hide();
        $('.memberEditModeNot').show();
        $('.editModeTextArea').attr('disabled','');
      }
    }
    function deleteMemberNow(apptid, appid, name){
      if (window.confirm("Do you really want to delete "+name+" from the team?")) { 
          $.ajax({
             url : '{{ asset('mf/delTeamMember') }}',
             method : 'POST',
             data : {_token: $('#token').val(), id : apptid},
             success : function(data){
                if (data == 'DONE') {
                    alert('Successfully deleted ' + name + ' from the team.');
                    getAllMembers(appid);
                } else if (data == 'ERROR') {
                    $('#TeamAsseErrorAlert').show(100);
                }
             },
             error : function(a, b, c){
                console.log(c);
                $('#TeamAsseErrorAlert').show(100);
             },
          });
      }
    }
    function saveEditMode(){
      var getIds = $('#GoderModalTBody tr').map(function () {return $(this).attr('selectedapptId')}).get();
      var SelectedAppId = $('#anotherSelectedID4Members').val();
      var theGodRmk = [];
      if (getIds.length != 0) {
          for (var i = 0; i < getIds.length; i++) {
            theGodRmk[i] = $('#theRMK_'+getIds[i]).val();
          }

          $.ajax({
              url : '{{ asset('mf/save_TeamMember') }}',
              method : 'POST',
              data : {_token:$('#token').val(),rmk : theGodRmk, ids : getIds},
              success : function(data){
                  if (data == 'DONE') {
                      alert('Successfully edited');
                      getAllMembers(SelectedAppId);
                  } else if (data == 'ERROR'){
                    $('#TeamAsseErrorAlert').show(100);
                  }
              },
              error : function(a, b, c){
                  console.log(c);
                  $('#TeamAsseErrorAlert').show(100);
              },
          });
      } else {
        alert('No data to be updated. Page will reload after a few seconds.');
        window.location.reload();
      }
    }
</script>
@endsection