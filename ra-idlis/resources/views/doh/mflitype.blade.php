@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA09" hidden>
  <script type="text/javascript">Right_GG();</script>
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <datalist id="rgn_list">
      @if (isset($plitype))
        @foreach ($plitype as $plitypes)
          <option value="{{$plitypes->plid}}">{{$plitypes->pldesc}}</option>
        @endforeach
      @endif
    </datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Personnel License <span class="MA09_add"><a href="#" title="Add New Application Type" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">ID</th>
                  <th style="width: 35%">Description</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
                @if (isset($plitype))
                @foreach ($plitype as $plitypes)
                  <tr>
                    <td scope="row"> {{$plitypes->plid}}</td>
                    <td>{{$plitypes->pldesc}}</td>
                    <td>
                      <center>
                        <span class="MA09_update">
                          <button type="button" class="btn-defaults" onclick="showData('{{$plitypes->plid}}', '{{$plitypes->pldesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                        </span>
                        <span class="MA09_cancel">
                          <button type="button" class="btn-defaults" onclick="showDelete('{{$plitypes->plid}}', '{{$plitypes->pldesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                        </span>
                      </center>
                    </td>
                  </tr>
                @endforeach
                @else
                @endif
              </tbody>
            </table>
        </div>
    </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New Personnel License</strong></h5>
                <hr>
                <div class="container">
                  <form id="addRgn"  data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <div class="row">
                        
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>  
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-4">ID:</div>
                       <div class="col-sm-8" style="margin:0 0 .8em 0;">
                       <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Description:</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                        </div>    
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Personnel License</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
                      <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                      <div class="row">
                        
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>  
                    <span id="EditBody"></span>
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Personnel License</strong></h5>
              <hr>
              <div class="container">
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                      <div class="row">
                        
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
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
              '<div class="col-sm-4">ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +
              '<div class="col-sm-4">Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              '</div>' 
            );
        } 
        $('#addRgn').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                var id = $('#new_rgnid').val();
                var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                var test = $.inArray(id,arr);
                if (test == -1) { // Not in Array
                    $.ajax({
                      url: "{{ asset('/employee/dashboard/mf/litype') }}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        id: $('#new_rgnid').val().toUpperCase(),
                        name : $('#new_rgn_desc').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Personnel License');
                            window.location.href = "{{ asset('/employee/dashboard/mf/litype') }}";
                        } else if(data == 'ERROR'){
                          $('#AddErrorAlert').show(100);
                        }
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                         console.log(errorThrown);
                         $('#AddErrorAlert').show(100);
                      }
                  });
                } else {
                  alert('Personnel License ID is already been taken');
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
                  url: "{{ asset('/mf/save_plicense') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Application Type');
                          window.location.href = "{{ asset('/employee/dashboard/mf/litype') }}";
                      } else if (data == 'ERROR') {
                        $('#EditErrorAlert').show(100);
                      }
                  },
                  error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#EditErrorAlert').show(100);
                  }

               });
             }
        });
        function showDelete (id,desc){
            $('#DelModSpan').empty();
            $('#DelModSpan').append(
                '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
                '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
                '</div>'
              );
        }
        function deleteNow(){
          var id = $("#toBeDeletedID").val();
          var name = $("#toBeDeletedname").val();
          $.ajax({
            url : "{{ asset('/mf/del_plicense') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
            success: function(data){
             if (data == 'DONE') {
                 alert('Successfully deleted '+name);
                window.location.href = "{{ asset('/employee/dashboard/mf/litype') }}";
             } else if (data == 'ERROR') {
                $('#DelErrorAlert').show(100);
             }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#DelErrorAlert').show(100);
                  }
          });
        }
    </script>
@endsection