@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA18" hidden>
  <script type="text/javascript">Right_GG();</script>
  @if (isset($parts) && isset($asments))
    @foreach ($parts as $part)
   <datalist id="{{$part->partid}}_list">
     @foreach ($asments as $asment)
       @if ($part->partid == $asment->partid)
          <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
       @endif
     @endforeach
   </datalist>
  @endforeach
  @endif
   {{-- $('#new_rgnid').val() --}}
 @if (isset($asments))
   <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
   @endforeach
 </datalist>
 @endif
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Part ...</option>
                @if (isset($parts))
                  @foreach ($parts as $part)
                    <option value="{{$part->partid}}">{{$part->partdesc}}</option>
                  @endforeach
                @endif
              </select>
              <input type="" id="token" value="{{Session::token()}}" hidden>
              </form>
           </div>
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 5%">ID</th>
                  <th style="width: 75%">Name</th>
                  <th style="width: 20%"><center>Options</center></th>
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
                <h5 class="modal-title text-center"><strong>Add New Assessment</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" id="addCls" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-sm-4">Facility:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="faci" class="form-control" data-parsley-required-message="*<strong>Facility</strong> required" required>
                        <option value=""></option>
                        @isset ($faci)
                          @foreach ($faci as $t)
                            <option value="{{$t->facid}}">{{$t->facname}}</option>
                          @endforeach                            
                        @endisset                        
                      </select>
                    </div>
                    <div class="col-sm-4">Category</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="caid" class="form-control" data-parsley-required-message="*<strong>Category</strong> required" required>
                        <option value=""></option>
                        @isset($cat)
                            @foreach ($cat as $c)
                              <option value="{{$c->caid}}">{{$c->categorydesc}}</option>
                            @endforeach
                        @endisset                        
                      </select>
                    </div>
                    <div class="col-sm-4">Part:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="partid" data-parsley-required-message="*<strong>Part</strong> required" class="form-control" required>  
                          <option value="">Select Part ...</option>
                          @if (isset($parts))
                            @foreach ($parts as $part)
                              <option value="{{$part->partid}}">{{$part->partdesc}}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                    {{-- <div class="col-sm-4">ID:</div> --}}
                    {{-- <div class="col-sm-8"  style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required> --}}
                    {{-- </div> --}}
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <textarea  id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required></textarea>                    
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Assessment</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
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
              <h5 class="modal-title text-center"><strong>Delete Assessment</strong></h5>
              <hr>
              <div class="container">
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <span id="DelModSpan"></span>
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
                '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              '</div>' 
            );
        }
        function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
        $('#FilterdBody').empty();
        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
          for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_pro').text();
            var e = $('#'+x[i]+'_pro').attr('value');
            $('#FilterdBody').append(
                        '<tr>'+
                          '<td>'+e+'</td>' +
                          '<td>'+d+'</td>' +
                          '<td><center>'+
                          '<span class="MA18_update">'+
                          '<button type="button" class="btn-defaults" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
                          '</span>'+
                          '<span class="MA18_cancel">' +
                          '<button type="button" class="btn-defaults" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
                        '</span>' +
                          '</center></td>' +
                        '</tr>'
                        );
          }
      }
      function getData(provname){
          $('#edit_name').attr("value",provname);
      } 
      $('#addCls').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                var id = $('#new_rgnid').val();
                var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                // console.log(arr);
                var test = $.inArray(id,arr);
                // console.log($('#partid').val());
                if (test == -1) { // Not in Array
                    $.ajax({
                      // url: "{{asset('employee/dashboard/ph/regions')}}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        id: $('#new_rgnid').val(),
                        name : $('#new_rgn_desc').val(),
                        partid : $('#partid').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Assessment');
                            window.location.href = "{{ asset('employee/dashboard/mf/assessment') }}";
                        } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);
                        } 
                      }, error: function(XMLHttpRequest, textStatus, errorThrown){
                          $('#AddErrorAlert').show(100);
                      }
                  });
                } else {
                  alert('Assessment ID is already been taken');
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
                  url: "{{ asset('/mf/save_asmt') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Assessment');
                          window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
                      } else if (data == 'ERROR') {
                          $('#EditErrorAlert').show(100);
                      }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
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
            url : "{{ asset('/mf/del_asmt') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
            success: function(data){
             if (data == 'DONE') {
              alert('Successfully deleted '+name);
              window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
            } else if (data == 'ERROR') {
                $('#DelErrorAlert').show(100);
            }
            }, error : function(){
              $('#DelErrorAlert').show(100);
            }
          });
        }
    </script>
@endsection