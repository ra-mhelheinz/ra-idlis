@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Licensing Process Status
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
                    <th scope="col">Type</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name of Health Facility</th>
                    <th scope="col">Type of Health Facility</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Current Status</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody id="FilterdBody">
                @if ($LotsOfDatas)
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
                                  <td>{{$data->formattedDate}}</td>
                                  <td>{{$data->aptdesc}}</td>
                                  <td style="color:{{$color}};font-weight:bold;">{{$status}}</td>
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
@endsection
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
                    /// ERROR
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
</script>