@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA11" hidden>
  <script type="text/javascript">Right_GG();</script>
  {{-- @foreach ($hfsts as $hfst)
   <datalist id="{{$hfst->hfser_id}}_hfst">
     @foreach ($facilitys as $facility)
        @if ($facility->hfser_id == $hfst->hfser_id)
          <option data-id="{{$facility->facid}}" id="{{$facility->facid}}_heafaserv">{{$facility->facname}}</option>
        @endif
     @endforeach
   </datalist>
  @endforeach --}}
  @foreach ($facilitys as $facility)
   <datalist id="{{$facility->facid}}_list">
     @foreach ($uploads as $upload)
       @if ($facility->facid == $upload->facid)
          <option class="{{$upload->hfser_id}}_cls" id="{{$upload->upid}}_pro_{{$upload->hfser_id}}" value="{{$upload->upid}}">{{$upload->updesc}}</option>
       @endif
     @endforeach
   </datalist>
  @endforeach
 <datalist id="rgn_list">
   @foreach ($uploads as $upload)
     <option id="{{$upload->upid}}_pro_{{$upload->hfser_id}}" value="{{$upload->upid}}">{{$upload->updesc}}</option>
   @endforeach
 </datalist>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Uploads <a href="#" title="Add New Uploads" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup2()">
                <option value="">Select Health Facility/Service Type ...</option>
                @foreach ($hfsts as $hfst)
                  <option value="{{$hfst->hfser_id}}">{{$hfst->hfser_desc}}</option>
                @endforeach
              </select>&nbsp;
                <select style="width: auto;" class="form-control" id="filterer2" onchange="filterGroup2()">
                <option value="">Select Health Facility/Service ...</option>
                @foreach ($facilitys as $facility)
                  <option value="{{$facility->facid}}">{{$facility->facname}}</option>
                @endforeach
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  {{-- <th style="width: 40%">ID</th> --}}
                  <th style="width: 35%">Name</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table>
        </div>
    </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New Upload</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" id="addCls" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="col-sm-4">Health Facility/Service Type:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="FATYPE" {{-- onchange="filterGroup3();" --}} data-parsley-required-message="*<strong>Health Facility/Servce Type</strong> required" class="form-control" required>
                          <option value="">Select Health Facility/Service Type ...</option>
                          @foreach ($hfsts as $hfst)
                            <option value="{{$hfst->hfser_id}}">{{$hfst->hfser_desc}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4">Facility/Service:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="FACID" data-parsley-required-message="*<strong>Facility/Service</strong> required" class="form-control" required>  
                          <option value="">Select Facility/Service ...</option>
                          @foreach ($facilitys as $facility)
                            <option value="{{$facility->facid}}">{{$facility->facname}}</option>
                          @endforeach
                          {{-- @foreach ($facility as $facilitys)
                            <option value="{{$facilitys->facid}}">{{$facilitys->facname}}</option>
                          @endforeach --}}
                      </select>
                    </div>
                    {{-- <div class="col-sm-4">ID:</div>
                    <div class="col-sm-8"  style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
                    </div> --}}
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                    </div> 
                  </form>
               </div>
              </div>
            </div>
          </div>
    </div>
    </div>
    <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Upload</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
                    <span id="EditBody">
                    </span>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
      <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Upload</strong></h5>
              <hr>
              <div class="container">
                <span id="DelModSpan">
                </span>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <script type="text/javascript">
        function showData(id,desc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-4" hidden>ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;" hidden>' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +
              '<div class="col-sm-4">Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              '</div>' 
            );
        }
        function filterGroup(){
          var id = $('#filterer').val();
          var x = $('#'+id+'_hfst option').map(function() {return $(this).attr('data-id');}).get();
          var d = $('#'+id+'_hfst option').map(function() {return $(this).val();}).get();
          $('#filterer2').empty();
          $('#filterer2').append('<option value="">Select Health Facility/Service ...</option>');
          for (var i = 0; i < x.length; i++) {
            var selectedID = x[i]; selectedText = d[i];
             $('#filterer2').append('<option value="'+selectedID+'">'+selectedText+'</option>');
          }
        }
        function filterGroup3(){
          var id = $('#FATYPE').val();
          var x = $('#'+id+'_hfst option').map(function() {return $(this).attr('data-id');}).get();
          var d = $('#'+id+'_hfst option').map(function() {return $(this).val();}).get();
          $('#FACID').empty();
          $('#FACID').append('<option value="">Select Health Facility/Service ...</option>');
          for (var i = 0; i < x.length; i++) {
            var selectedID = x[i]; selectedText = d[i];
             $('#FACID').append('<option value="'+selectedID+'">'+selectedText+'</option>');
          }
        }
        function filterGroup2(){
        var id2 = $('#filterer').val();
        var id = $('#filterer2').val();
        var token = $('#token').val();
        var x = $('#'+id+'_list option[class="'+id2+'_cls"]').map(function() {return $(this).val();}).get();
        // console.log(x);
        $('#FilterdBody').empty();
        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
          for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_pro_'+id2).text();
            var e = $('#'+x[i]+'_pro_'+id2).attr('value');
            $('#FilterdBody').append(
                        '<tr>'+
                          // '<td>'+e+'</td>' +
                          '<td>'+d+'</td>' +
                          '<td><center>'+
                          '<span class="MA11_update">'+
                          '<button type="button" class="btn-defaults" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
                          '</span>'+
                          '<span class="MA11_cancel">' +
                          '<button type="button" class="btn-defaults" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
                        '</span>' +
                          '</center></td>' +
                        '</tr>'
                        );
          }
      }
      // function getData(provname){
      //     $('#edit_name').attr("value",provname);
      // } 
      $('#addCls').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                var id = $('#new_rgnid').val();
                var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                // console.log(arr);
                var test = $.inArray(id,arr);
                // console.log($('#OCID').val());
                if (test == -1) { // Not in Array
                    $.ajax({
                      url: "{{asset('employee/dashboard/mf/uploads')}}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        // id: $('#new_rgnid').val(),
                        id : $('#FATYPE').val(),
                        name : $('#new_rgn_desc').val(),
                        facid : $('#FACID').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Upload');
                            window.location.href = "{{ asset('employee/dashboard/mf/uploads') }}";
                        }
                      }
                  });
                } else {
                  alert('Upload ID is already been taken');
                  $('#new_rgnid').focus();
                }
            }
        });
      $('#EditNow').on('submit',function(event){
          event.preventDefault();
            var form = $(this);
            form.parsley().validate();
             if (form.parsley().isValid()) {
               var x = $('#edit_name').val();
               var y = $('#edit_desc').val();
               $.ajax({
                  url: "{{ asset('/mf/save_upload') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Upload');
                          window.location.href = "{{ asset('/employee/dashboard/mf/uploads') }}";
                      }
                  }
               });
             }
        });
      function showDelete (id,desc){
            $('#DelModSpan').empty();
            $('#DelModSpan').append(
                '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
                  // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
                '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
                '</div>'
              );
        }
        function deleteNow(){
          var id = $("#toBeDeletedID").val();
          var name = $("#toBeDeletedname").val();
          $.ajax({
            url : "{{ asset('/mf/del_upload') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
            success: function(data){
              alert('Successfully deleted '+name);
              window.location.href = "{{ asset('/employee/dashboard/mf/uploads') }}";
            }
          });
        }
    </script>
@endsection