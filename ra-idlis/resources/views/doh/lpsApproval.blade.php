@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Approval/Issuance Certificate
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
                @if (isset($types))
                  @foreach ($types as $type)
                    <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                  @endforeach
                @endif
              </datalist>
              &nbsp;
			  @isset($employeeGRP)
	              @if ($employeeGRP == "NA")
	              <input type="text" class="form-control" id="filtererReg" list="rgn_list" onchange="" placeholder="Select Region">
	              @endif
			  @endisset
              <datalist id="rgn_list">
                @if (isset($regions))
                  @foreach ($regions as $region)
                    <option value="{{$region->rgn_desc}}">{{$region->rgnid}}</option>
                  @endforeach
                @endif
              </datalist>
              &nbsp;
              <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="FilterData('@isset($employeeGRP){{$employeeGRP}}@else{{'#'}}@endisset',@isset($employeeREGION){{$employeeREGION}}@else{{'#'}}@endisset);">Filter</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
            <table class="table table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">Application Code</th>
                    <th scope="col" class="text-center">Name of Health Facility</th>
                    <th scope="col" class="text-center">Type of Health Facility</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">&nbsp;</th>
                    <th scope="col" class="text-center">Current Status</th>
                    <th scope="col" class="text-center">Options</th>
                </tr>
                </thead>
                <tbody id="FilterdBody">
                    @if (isset($BigData))
                      @foreach ($BigData as $data)
                      @php
                        $status = '';
                        $paid = $data->appid_payment;
                        $reco = $data->isrecommended;
                        $ifdisabled = '';$color = '';
                        
                        if($data->status == 'P' || $data->status == 'RA' || $data->status == 'RE' || $data->status == 'RI' ){
                          $ifdisabled = 'disabled';
                        }

                      @endphp
                      <tr>
                        <td class="text-center">{{$data->hfser_id}}</td>
                        <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                        <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                        <td class="text-center">{{$data->facname}}</td>
                        <td class="text-center">{{$data->formattedDate}}</td>
                        <td class="text-center">{{$data->aptdesc}}</td>
                        <td class="text-center" style="font-weight:bold;">{{$data->trns_desc}}</td>
                          <td><center>
                              <button type="button" title="Evaluate Payment for {{$data->facilityname}}" class="btn-defaults" onclick="showData({{$data->appid}});"  {{$ifdisabled}}><i class="fa fa-fw fa-clipboard-check" {{$ifdisabled}}></i></button>
                          </center></td>
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
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Evaluate Uploaded Application</strong></h5>
              <hr>
              <div class="container">
                    <form id="ViewNow" data-parsley-validate>
                    <span id="ViewBody">
                    </span>
                    <hr>
                    <div class="row">
                      <div class="col-sm-8">
                      {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
                    </div> 
                    <div class="col-sm-4">
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
            rgnid = '@isset($employeeREGION){{$employeeREGION}}@else{{0}}@endisset';
          } 
        }

        if (ok == 1) {
          $.ajax({
              url: '{{asset('/lps/getLPS')}}',
              method: 'POST',
              data : {_token : $('#token').val(), hfser_ID : hfser_id, facID : facid, rgnID : rgnid, grpid : grpID},
              success : function(data){
                // console.log(data);
                  if (data != 'NONE') {
                      $('#FilterdBody').empty();
                      for (var i = 0; i < data.length; i++) {
                          var status = '';
                          var paid = data[i].appid_payment;
                          var reco = data[i].isrecommended;
                          var ifdisabled = '';
                          // if (data[i].isrecommended === null) {
                          //     status = '<span style="color:blue;font-weight:bold;">For Evaluation</span>';
                          // } else if (data[i].isrecommended == 0){
                          //   status = '<span style="color:red;font-weight:bold;">Application Rejected</span>';
                          // }
                          // else {
                          //     status = '<span style="color:green;font-weight:bold;">Application Approved</span>';
                          // }

                          // if (paid == null || paid == 0) {
                          //     status = '<span style="color:red;font-weight:bold;">For Evaluation (Not Paid)</span>';
                          //     ifdisabled = 'disabled';
                          // }
                          
                          // var app = data[i].approved
                          $('#FilterdBody').append(
                                '<tr>'+
                                /// 'R'+data[i].rgnid+'
                                  '<td class="text-center">' + data[i].hfser_id + '</td>' +
                                  '<td class="text-center">' + data[i].hfser_id + 'R'+data[i].rgnid+'-' + data[i].appid + '</td>' +
                                  '<td class="text-center"><strong>'+data[i].facilityname+'</strong></td>' +
                                  '<td class="text-center">'+data[i].facname+'</td>'+
                                  '<td class="text-center">'+data[i].formattedDate+'</td>'+
                                  '<td class="text-center">'+data[i].aptdesc+'</td>' +
                                  '<td class="text-center"><strong>'+data[i].trns_desc+'</strong></td>'+
                                  '<td><center>'+
                                        '<button type="button" title="Evaluate '+data[i].facilityname+'" class="btn-defaults" onclick="showData('+data[i].appid+');"  '+ifdisabled+'><i class="fa fa-fw fa-clipboard-check"></i></button>'+
                                  '</center></td>'+
                                  // data-toggle="modal" data-target="#GodModal"
                                '</tr>'
                            );
                      }
                  } else{
                    alert('Currently No Applications in this type.');
                  }
              }
          });

        }        
    }
    function showData(appid){
        window.location.href = "{{ asset('/employee/dashboard/lps/approval') }}/" + appid;
    } 
</script>
@endsection