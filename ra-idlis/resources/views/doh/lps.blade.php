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
            <table class="table table-hover" style="font-size:13px;" id="example">
                <thead>
                <tr>
                    <th scope="col" style="text-align: center; width:auto">Type</th>
                    <th scope="col" style="text-align: center; width:auto">Code</th>
                    <th scope="col" style="text-align: center; width:auto">Name of the Facility</th>
                    <th scope="col" style="text-align: center; width:auto">Type of Facility</th>
                    <th scope="col" style="text-align: center; width:auto">Type</th>
                    <th scope="col" style="text-align: center; width:auto">Date Applied</th>
                    {{-- <th scope="col" style="">Paid</th> --}}
                    <th scope="col" style="text-align:center">Evaluated</th>
                    {{-- <th scope="col" style="">Evaluated by</th> --}}
                    {{-- <th scope="col" style="">Region Evaluated</th> --}}
                    <th scope="col" style="text-align: center; width:auto">Inspected</th>
                    <th scope="col" style="text-align: center; width:auto">Approved</th>
                    <th scope="col" style="text-align: center; width:auto">Status</   th>
                    {{-- <th scope="col" style="">Current Status</th> --}}
                    <th scope="col" style="text-align: center; width:auto">Options</th>
                </tr>
                </thead>
                <tbody id="FilterdBody">
                 @if (isset($LotsOfDatas))
                  @foreach ($LotsOfDatas as $data)
                  @php
                    // $status = '';
                          // $paid = $data->appid_payment;
                          // $reco = $data->isrecommended;
                          // $color = '';
                          // if ($data->isrecommended == null) {
                          //     $status = 'For Evaluation';$color = 'black';
                          // }else if ($data->isrecommended == 1) {
                          //   $status = 'Application Approved';$color = 'green';
                          //     }
                          // if ($paid == null) {$status = 'For Evaluation (Not Paid)';$color = 'red';
                          //     }
                  @endphp
                   <tr>
                     <td style="text-align:center">{{$data->hfser_id}}</td>
                     <td style="text-align:center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                     <td style="text-align:center"><strong>{{$data->facilityname}}</strong></td>
                     <td style="text-align:center">{{$data->facname}}</td>
                     <td style="text-align:center">{{$data->aptdesc}}</td>
                      <td style="text-align:center">{{$data->formattedDate}}</td>
                     {{-- <td><center><h5>@if($data->appid_payment !== null) <span class="badge badge-success">Yes</span> @else <span class="badge badge-pill badge-warning">No</span> @endif</h5></center></td> --}}
                      {{-- <td>{{$data->formattedDateEval}}</td> --}}
                      {{-- <td>{{$data->recommendedbyName}}</td> --}}
                      {{-- <td>{{$data->RgnEvaluated}}</td> --}}
                      {{-- <td></td>
                      <td></td> --}}
                      <td><center> {{-- EVALUATION --}}
                        <h5>
                          @if($data->isrecommended == 1) 
                          <span class="badge  badge-success" title="Click for more info" style="cursor:pointer;" data-toggle="modal" data-target="#ShowEvalInfo" onclick="showEvalInfo('{{$data->formattedTimeEval}}', '{{$data->formattedDateEval}}', '{{$data->formattedTimePropEval}}', '{{$data->formattedDatePropEval}}', '{{$data->recommendedbyName}}', '{{$data->RgnEvaluated}}', '{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}', {{$data->appid}})">Yes</span> 
                          @elseif($data->isrecommended == null) 
                            <span class="badge badge-warning">Pending</span> 
                          @else 
                            <span class="badge badge-danger">No</span> 
                        @endif</h5>
                      </center></td>
                      <td><center> {{-- INSPECTION --}}
                        <h5>
                          @if ($data->isInspected != null)
                            <span class="badge badge-success">Yes</span>
                          @else 
                            <span class="badge badge-warning">Pending</span>
                          @endif
                        </h5>
                      </center></td>
                      <td><center> {{-- APPROVED --}}
                        <h5>
                          @if ($data->isApprove == '1')
                            <span class="badge badge-success">Yes</span>
                          @elseif($data->isApprove == '0')
                            <span class="badge badge-danger">No</span>
                          @else
                            <span class="badge badge-warning">Pending</span>
                          @endif
                        </h5>
                      </center></td>
                      <td style="color:black;font-weight:bolder;text-decoration: underline;">{{$data->trns_desc}}</td>
                      <td>
                        <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn-defaults" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->facname}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}','{{$data->ocdesc}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->streetname}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->status}}', '{{$data->uid}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
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
                      <button type="button" class="btn btn-outline-info form-control" id="PreAssessButton" style="border-radius:0;"><span class="fa fa-sign-up"></span>View Preassessment</button>
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
                      <button type="button" class="btn btn-outline-info form-control" style="border-radius:0;" id="ViewEvalButton"><span class="fa fa-sign-up"></span>View Evaluation</button>
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
   $(document).ready(function() {
         // $('#example').DataTable();
      } );
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
            $('#filterer').focus();
            ok = 0;
        } else if (facid == '') { // Not Found
            console.log('FACILITY/SERVICE NOT FOUND');
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
                console.log('REGION NOT FOUND');
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
              url: '{{asset('/lps/getLPS')}}',
              method: 'POST',
              data : {_token : $('#token').val(), hfser_ID : hfser_id, facID : facid, rgnID : rgnid},
              success : function(data){
                // console.log(data);
                  if (data != 'NONE') {
                    var test = data.data;
                    console.log(test);
                    // var lengthData = Object.keys(data).length;
                      $('#FilterdBody').empty();
                      for (var i = 0; i < test.length; i++) {
                          
                          $('#FilterdBody').append(
                                '<tr>'+
                                /// 'R'+data[i].rgnid+'
                                  '<td style="text-align:center">' + test[i].hfser_id +'</td>' + 
                                  '<td style="text-align:center">' + test[i].hfser_id + 'R'+test[i].rgnid+'-' + test[i].appid + '</td>' +
                                  '<td style="text-align:center"><strong>'+test[i].facilityname+'</strong></td>' +
                                  '<td style="text-align:center">'+test[i].facname+'</td>'+
                                  '<td style="text-align:center">'+test[i].formattedDate+'</td>'+
                                  '<td style="text-align:center">'+test[i].aptdesc+'</td>' +
                                  '<td></td>' + 
                                  '<td></td>' + 
                                  '<td></td>' + 
                                  '<td style="text-align:center">'+test[i].trns_desc+'</td>'+
                                  '<td>'+
                                        '<button type="button" title="View detailed information for '+test[i].facilityname+'" class="btn-defaults" onclick="showData('+test[i].appid+',\''+test[i].aptdesc+'\', \''+test[i].authorizedsignature+'\',\''+test[i].brgyname+'\', \''+test[i].classname+'\' ,\''+test[i].cmname+'\', \''+test[i].email+ '\', \''+test[i].facilityname+'\',\''+test[i].facname+'\', \''+test[i].formattedDate+'\', \''+test[i].formattedTime+'\', \''+test[i].hfser_desc+'\',\''+test[i].ocdesc+'\', \''+test[i].provname+'\',\''+test[i].rgn_desc+'\', \''+test[i].streetname+'\', \''+test[i].zipcode+'\', \''+test[i].isrecommended +'\', \''+test[i].hfser_id+'\', '+test[i].appid_payment+', \''+test[i].status+'\', \''+test[i].uid+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>'+
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
    function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, streetname, zipcode, isrecommended, hfser_id, statusX, uid, trns_status){
        var status = '';
        // var paid = appid_payment;
        // if (statusX == 'P') {
        //     status = '<span style="color:orange">Pending</span>';
        // } 
        $('#PreAssessButton').attr('onclick', '');
        $('#PreAssessButton').attr('onclick', "location.href='{{ asset('/employee/dashboard/lps/preassessment') }}/"+uid+"'");
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
                '<div class="col-sm-8">' +trns_status +
                '</div>' +
            '</div>'
          );
    } 
    // '{{$data->formattedTimeEval}}', '{{$data->formattedDateEval}}', '{{$data->formattedTimePropEval}}', '{{$data->formattedDatePropEval}}', '{{$data->recommendedbyName}}', '{{$data->RgnEvaluated}}', '{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}')"
    function showEvalInfo(EvalTime, EvalDate, PropTime, PropDate, RecommendedBy, RgnRecommended, code, idCode){
        $('#ViewEvalButton').attr('onclick','');
        $('#ViewEvalButton').attr('onclick',"location.href='{{ asset('/employee/dashboard/lps/evaluate') }}/"+idCode+"'");
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