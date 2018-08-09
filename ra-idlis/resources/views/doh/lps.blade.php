@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Application Status
        </div>
        <div class="card-body table-responsive">
            <div style="float:left;margin-bottom: 5px;width: 100%">
            <form class="container row form-inline">
              <label>Filter : &nbsp;</label>
              <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Application Type">
              &nbsp;
              <select  class="form-control"  id="fa_list" onchange="" placeholder="Health Facility/Service">
                        <option value="">Select Application Type.. </option>
               </select>
               <datalist id="grp_list">
                @if(isset($types))
                  @foreach ($types as $type)
                    <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                  @endforeach
                @endif
              </datalist>
              &nbsp;
              @if ($employeeGRP == "NA")
              <input type="text" class="form-control" id="filtererReg" list="rgn_list" onchange="" placeholder="Select Region">
              @else
              <input type="text" id="filtererReg" name="" value="{{$employeeREGION}}" hidden> 
              @endif
              <datalist id="rgn_list">
                @if(isset($regions))
                  @foreach ($regions as $region)
                    <option value="{{$region->rgn_desc}}">{{$region->rgnid}}</option>
                  @endforeach
                @endif
              </datalist>
              &nbsp;
              <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="FilterData('{{$employeeGRP}}',{{$employeeREGION}});">Filter</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
            <table class="table table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th scope="col" style="">Type</th>
                    <th scope="col" style="">Code</th>
                    <th scope="col" style="">Name of the Facility</th>
                    <th scope="col" style="">Type of Facility</th>
                    <th scope="col" style="">Type</th>
                    <th scope="col" style="">Date Applied</th>
                    <th scope="col" style="">Paid</th>
                    <th scope="col" style="">Evaluated</th>
                    {{-- <th scope="col" style="">Evaluated by</th> --}}
                    {{-- <th scope="col" style="">Region Evaluated</th> --}}
                    <th scope="col" style="">Inspected</th>
                    <th scope="col" style="">Approved</th>
                    <th scope="col" style="">Status</th>
                    {{-- <th scope="col" style="">Current Status</th> --}}
                    <th scope="col" style="">Options</th>
                </tr>
                </thead>
                <tbody id="FilterdBody">
                 @if (isset($LotsOfDatas))
                  @foreach ($LotsOfDatas as $data)
                  @php
                    $status = '';
                          $paid = $data->appid_payment;
                          $reco = $data->isrecommended;
                          $color = '';
                          if ($data->isrecommended == null) {
                              $status = 'For Evaluation';$color = 'black';
                          }else if ($data->isrecommended == 1) {
                            $status = 'Application Approved';$color = 'green';
                              }
                          if ($paid == null) {$status = 'For Evaluation (Not Paid)';$color = 'red';
                              }
                  @endphp
                   <tr>
                     <td>{{$data->hfser_id}}</td>
                     <td>{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                     <td><strong>{{$data->facilityname}}</strong></td>
                     <td>{{$data->facname}}</td>
                     <td>{{$data->aptdesc}}</td>
                      <td>{{$data->formattedDate}}</td>
                     <td><center><h5>@if($data->appid_payment !== null) <span class="badge badge-success">Yes</span> @else <span class="badge badge-pill badge-warning">No</span> @endif</h5></center></td>
                      {{-- <td>{{$data->formattedDateEval}}</td> --}}
                      {{-- <td>{{$data->recommendedbyName}}</td> --}}
                      {{-- <td>{{$data->RgnEvaluated}}</td> --}}
                      {{-- <td></td>
                      <td></td> --}}
                      <td><center><h5>@if($data->isrecommended == 1) <span class="badge badge-success" title="Click for more info" data-toggle="modal" data-target="#ShowEvalInfo" onclick="showEvalInfo('{{$data->formattedTimeEval}}', '{{$data->formattedDateEval}}', '{{$data->formattedTimePropEval}}', '{{$data->formattedDatePropEval}}', '{{$data->recommendedbyName}}', '{{$data->RgnEvaluated}}', '{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}')">Yes</span> @elseif($data->isrecommended == null) <span class="badge badge-pill badge-warning">Pending</span> @else <span class="badge badge-pill badge-danger">No</span> @endif</center></h5></td>
                      <td><center>
                        <h5>
                          @if ($data->agreedInspectiondate != null)
                            <span class="badge badge-success">Yes</span>
                          @else 
                            <span class="badge badge-warning">Pending</span>
                          @endif
                        </h5>
                      </center></td>
                      <td><center>
                        <h5>
                          @if ($data->approvedBy == '1')
                            <span class="badge badge-success">Yes</span>
                          @elseif($data->approvedBy == '0')
                            <span class="badge badge-danger">No</span>
                          @else
                            <span class="badge badge-warning">Pending</span>
                          @endif
                        </h5>
                      </center></td>
                      <td style="color:{{$color}};font-weight:bold;">{{-- {{$status}} --}}</td>
                      <td>
                        <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn-defaults" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->facname}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}','{{$data->ocdesc}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->streetname}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', {{$data->appid_payment}});" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
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
      <div class="modal fade" id="ShowEvalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog {{-- modal-lg --}}" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong><span id="EvalTitle"></span> Evaluation</strong></h5>
              <hr>
              <div class="container">
                    <form id="" data-parsley-validate>
                    <span id="EvalBody">
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

        var hfser_id = '';
        var facid = $('#fa_list').val();
        var rgnid = '';
        var ok = 1;
        var selectedAppType = $('#filterer').val();
        var appTypeNames = $('#grp_list option[value]').map(function () {return this.text}).get();  // Application Type Names
        var appTypeID = $('#grp_list option[value]').map(function () {return this.value}).get();  // Application Type IDs
        var testAppType = $.inArray(selectedAppType.toUpperCase(),appTypeID); // Check

        if (testAppType < 0 ) { // Not Found
            console.log('APPLICATION TYPE NOT FOUND');
            ok = 0;
        } else if (facid == '') { // Not Found
            console.log('FACILITY/SERVICE NOT FOUND');
            ok = 0;
        }else {

            hfser_id = appTypeID[testAppType];
            if (grpID == 'NA') {
              var selected = $('#filtererReg').val(); // Selected
              var names = $('#rgn_list option[value]').map(function () {return this.value}).get(); // Array for Names
              var id = $('#rgn_list option[value]').map(function () {return this.text}).get(); // Array for IDs
              var test = $.inArray(selected,names); // Check 
              if (test < 0) {
                console.log('REGION NOT FOUND');
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
              url: '{{asset('/lps/getLPS')}}',
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
                                  '<td>' + data[i].hfser_id +'</td>' + 
                                  '<td>' + data[i].hfser_id + 'R'+data[i].rgnid+'-' + data[i].appid + '</td>' +
                                  '<td><strong>'+data[i].facilityname+'</strong></td>' +
                                  '<td>'+data[i].facname+'</td>'+
                                  '<td>'+data[i].formattedDate+'</td>'+
                                  '<td>'+data[i].aptdesc+'</td>' +
                                  '<td>'+status+'</td>'+
                                  '<td>'+
                                        '<button type="button" title="View detailed information for '+data[i].facilityname+'" class="btn-defaults" onclick="showData('+data[i].appid+',\''+data[i].aptdesc+'\', \''+data[i].authorizedsignature+'\',\''+data[i].brgyname+'\', \''+data[i].classname+'\' ,\''+data[i].cmname+'\', \''+data[i].email+ '\', \''+data[i].facilityname+'\',\''+data[i].facname+'\', \''+data[i].formattedDate+'\', \''+data[i].formattedTime+'\', \''+data[i].hfser_desc+'\',\''+data[i].ocdesc+'\', \''+data[i].provname+'\',\''+data[i].rgn_desc+'\', \''+data[i].streetname+'\', \''+data[i].zipcode+'\', \''+data[i].isrecommended +'\', \''+data[i].hfser_id+'\', '+data[i].appid_payment+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>'+
                                  '</td>'+
                                '</tr>'
                            );
                      }
                  } else{
                    alert('ERROR');
                  }
              }
          });

        }        
    }
    function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, streetname, zipcode, isrecommended, hfser_id, appid_payment){
        var status = '';
        var paid = appid_payment;
        if (isrecommended == null) {
            status = "For Evaluation";
          }else if (isrecommended == 1) {
            status = '<span style="color:green;font-weight:bold;">Application Approved</span>';
          }
        if (paid == null) {
             status = '<span style="color:red;font-weight:bold;">For Evaluation (Not Paid)</span>';
          } 
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
                '<div class="col-sm-8">' +status +
                '</div>' +
            '</div>'
          );
    } 
    // '{{$data->formattedTimeEval}}', '{{$data->formattedDateEval}}', '{{$data->formattedTimePropEval}}', '{{$data->formattedDatePropEval}}', '{{$data->recommendedbyName}}', '{{$data->RgnEvaluated}}', '{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}')"
    function showEvalInfo(EvalTime, EvalDate, PropTime, PropDate, RecommendedBy, RgnRecommended, code){
        $('#EvalTitle').empty();
        $('#EvalTitle').text(code);
        $('#EvalBody').empty();
        $('#EvalBody').append(
              '<div class="row">'+
                  '<div class="col-sm-5">Evaluated On:</div>' +
                  '<div class="cols-sm-7" style="font-weight:bold">' + EvalDate + ' ' + EvalTime +
                  '</div>' + 
              '</div>'  +
              '<div class="row">'+
                  '<div class="col-sm-5">Recommended By:</div>' +
                  '<div class="cols-sm-7" style="font-weight:bold">' + RecommendedBy +
                  '</div>' + 
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-5">Region Evaluated:</div>' +
                  '<div class="cols-sm-7" style="font-weight:bold">' + RgnRecommended +
                  '</div>' + 
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-5">Proposed Inspection:</div>' +
                  '<div class="cols-sm-7" style="font-weight:bold">' + PropDate + ' ' + PropTime +
                  '</div>' + 
              '</div>'
          );
    }
</script>
@endsection