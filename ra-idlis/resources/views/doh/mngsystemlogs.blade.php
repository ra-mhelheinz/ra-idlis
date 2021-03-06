@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="" hidden>
  <script type="text/javascript">Right_GG();</script>
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    {{-- <datalist id="rgn_list">
      @if (isset($Chrges))
        @foreach ($Chrges as $Chrge)
        <option value="{{$Chrge->chg_code}}">{{$Chrge->chg_desc}}</option>
      @endforeach
      @endif
    </datalist> --}}
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           System Logs {{-- <span class="MA"><a href="#" title="Add New Charges" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span> --}}
            
        </div>
        <div class="card-body">
               <table class="table display" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 15%">Code</th>
                  <th style="width: 25%">User</th>
                  <th style="width: 25%">Region</th>
                  <th style="width: 25%">Date and Time</th>
                  <th style="width: 10%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($results))
                @foreach ($results as $result)
                  <tr>
                    <td scope="row" style="font-weight: bold"> {{$result['code']}}</td>
                    <td>{{$result['name']}}</td>
                    <td>{{$result['region']}}</td>
                    <td data-order="{{$result['datetime']}}">{{$result['formmatedDate']}} {{$result['formattedTime']}}</td>
                    <td>
                      <center>
                        <span >
                          <button type="button" class="btn-defaults" onclick='showData("{{$result['content']}}", "{{$result['code']}}");' data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
                        </span>
                        {{-- <span>
                          <button type="button" class="btn-defaults" onclick="showDelete('{{$Chrge->chg_code}}', '{{$Chrge->chg_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                        </span> --}}
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
              <div class="modal-body" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New Charge</strong></h5>
                <hr>
                <div class="container">
                  <form id="addRgn" class="row"  data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <div class="row">
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-sm-4">Code:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>Code</strong> required"  class="form-control"  required>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                    </div>
                    <div class="col-sm-4">Explanation:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <textarea type="text" rows="5" id="new_explanation" class="form-control" data-parsley-required-message="*<strong>Explanation</strong> required" required></textarea>
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
              <h5 class="modal-title text-center"><strong id="ErrName"></strong></h5>
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
                      {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
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
              <h5 class="modal-title text-center"><strong>Delete Charge</strong></h5>
              <hr>
              <div class="container">
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                      <div class="row">
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
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
      $(document).ready(function() {
          $('#example').DataTable({"order": [[ 3, "desc" ]]});
      } );
        function showData(message,code){
          $('#ErrName').empty();
          $('#ErrName').append(code);
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-4">Error Message:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<textarea rows="6" type="text" id="edit_name"  class="form-control disabled" disabled>'+message+'</textarea>' +
              '</div>'
              // '<div class="col-sm-4">Description:</div>' +
              // '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              //   '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              // '</div>' +
              // '<div class="col-sm-4">Explanation:</div>' +
              // '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              //   '<textarea rows="5  " id="edit_exp" value="'+expl+'" data-parsley-required-message="<strong>*</strong>Explanation <strong>Required</strong>" placeholder="'+expl+'" class="form-control" required></textarea>' +
              // '</div>' 
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
                      url: "{{ asset('/employee/dashboard/mf/charges') }}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        id: $('#new_rgnid').val(),
                        name : $('#new_rgn_desc').val(),
                        exp : $('#new_explanation').val(),
                        // mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Charge');
                            window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
                        } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);      
                        }
                      }, error : function (XMLHttpRequest, textStatus, errorThrown){
                           $('#AddErrorAlert').show(100);     
                      }
                  });
                } else {
                  alert('Charge code is already been taken');
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
                  url: "{{ asset('/mf/save_chrg') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),code:x,desc:y,exp : $('#edit_exp').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Charge');
                          window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
                      } else {
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
            url : "{{ asset('/mf/del_chrg') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val()},
            success: function(data){
              if (data == 'DONE') {
                alert('Successfully deleted '+name);
                window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
              } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
              } 
            }, // 
            error : function(XMLHttpRequest, textStatus, errorThrown){
              $('#DelErrorAlert').show(100);
            }
          });
        }
    </script>
@endsection