@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="" hidden>
  <script type="text/javascript">Right_GG();</script>
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <datalist id="grp_list">
      @if (isset($Mods))
        @foreach ($Mods as $Mod)
          <option value="{{$Mod->mod_id}}">{{$Mod->mod_desc}}</option>
        @endforeach
      @endif
    </datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Manage Modules <span class="MA07_add"><a href="#" title="Add New Group" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

        </div>
        <div class="card-body table-responsive">
               <table class="table display" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto">ID</th>
                  <th style="width: auto">Description</th>
                  <th style="width: auto"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
                @if (isset($Mods))
                @foreach ($Mods as $Mod)
                  <tr>
                    <td scope="row"> {{$Mod->mod_id}}</td>
                    <td>{{$Mod->mod_desc}}</td>
                    <td>
                      <center>
                        <span class="">
                          <button type="button" class="btn-defaults" onclick="showData('{{$Mod->mod_id}}', '{{$Mod->mod_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                        </span>
                        <span class="">
                          <button type="button" class="btn-defaults" onclick="showDelete('{{$Mod->mod_id}}', '{{$Mod->mod_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                        </span>
                      </center>
                    </td>
                  </tr>
                @endforeach
                @endif
              </tbody>
            </table>
        </div>
    </div>
        </div>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="border-radius: 0px;border: none;">
                <div class="modal-body" style=" background-color: #272b30;color: white;">
                  <h5 class="modal-title text-center"><strong>Add New Module</strong></h5>
                  <hr>
                  <form id="NewRight" action="#" class="container" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                     <div class="row">
                        <div class="col-sm-4">Module ID :</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                          <input type="text" id="new_modid" class="form-control" data-parsley-required-message="*<strong>Right ID</strong> required" required>
                        </div>
                     </div>
                      <div class="row">
                        <div class="col-sm-4">Module Name :</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                          <input type="text" id="new_rightdesc" class="form-control" data-parsley-required-message="*<strong>Right name</strong> required" required>
                        </div>
                        </div>
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Module</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Module</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
                      <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Module</strong></h5>
              <hr>
              <div class="container">
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
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
      $(document).ready(function() {
          $('#example').DataTable({
              // dom: 'Bfrtip',
              buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
          });
      } );
        function showData(id,desc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-8">Module ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +
              '<div class="col-sm-8">Module Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              '</div>' 
            );
        } 
       $('#NewRight').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
          var CurrentRights =  $('#grp_list option[value]').map(function () {
              return this.value}).get();
          var newId = $('#new_modid').val();
          var testNow = $.inArray(newId,CurrentRights);
          if (testNow == -1) {
            $.ajax({
                // url: " {{asset('employee/grprights/check')}}",
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: $('#new_modid').val(),
                  name : $('#new_rightdesc').val(),
                },
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New Module');
                      window.location.href = "{{ asset('employee/dashboard/grouprights/mng_mods') }}";
                  } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100)             
                  }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                   $('#AddErrorAlert').show(100)
                }
            });
          } else {
            alert('Module ID is already been taken');
            $('#new_modid').focus();
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
                  url: "{{ asset('/employee/dashboard/grouprights/mng_mods/update') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Module');
                          window.location.href = "{{ asset('employee/dashboard/grouprights/mng_mods') }}";
                      } else if (data == 'ERROR') {
                          $('#EditErrorAlert').show(100);
                      }
                  }, error : function (XMLHttpRequest, textStatus, errorThrown){
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
            url : "{{ asset('/employee/dashboard/grouprights/mng_mods/delete') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
            success: function(data){
              if (data == 'DONE') {
                alert('Successfully deleted '+name);
                window.location.href = "{{ asset('/employee/dashboard/grouprights/mng_mods') }}";
              } else if (data == 'ERROR') {
                $('#DelErrorAlert').show(100);
              }
            }, error : function (XMLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
                $('#DelErrorAlert').show(100);
            }
          });
        }
    </script>
@endsection