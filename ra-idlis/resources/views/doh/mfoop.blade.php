@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA00" hidden>
  <script type="text/javascript">Right_GG();</script>
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <datalist id="rgn_list">
      @if (isset($oops))
        @foreach ($oops as $oop)
        <option value="{{$oop->oop_id}}">{{$oop->oop_desc}}</option>
        @endforeach
      @endif
    </datalist> 
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Order of Payment {{-- <span class="MA00_add"><a href="#" title="Add New Application Status" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span> --}}
        </div>
        <div class="card-body">
               <table class="table" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 20%">ID</th>
                  <th style="width: 80%">Description</th>
                  {{-- <th style="width: 25%"><center>Options</center></th> --}}
                </tr>
              </thead>
              <tbody>
                @if(isset($oops))
                @foreach ($oops as $oop)
                  <tr>
                    <td scope="row"> {{$oop->oop_id}}</td>
                    <td>{{$oop->oop_desc}}</td>
                    {{-- <td>
                      <center>
                        <span class="MA00_update">
                          <button type="button" class="btn-defaults" onclick="showData('{{$oop->oop_id}}', '{{$oop->oop_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                        </span>
                        <span class="MA00_cancel">
                          <button type="button" class="btn-defaults" onclick="showDelete('{{$oop->oop_id}}', '{{$oop->oop_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                        </span>
                        <span class="MA00_cancel">
                          <button type="button" class="btn-defaults" onclick="location.href='{{asset('/')}}{{$oop->oop_link}}'"><i class="fa fa-fw fa-eye"></i></button>
                        </span>
                      </center>
                    </td> --}}
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
              <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New Order of Payment</strong></h5>
                <hr>
                <div class="container">
                  <form id="addRgn" class="row"  data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="col-sm-4">ID:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
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
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Order of Payment</strong></h5>
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
              <h5 class="modal-title text-center"><strong>Delete Order of Payment</strong></h5>
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
      $(document).ready(function() {
          $('#example').DataTable();
      } );
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
        // $('#addRgn').on('submit',function(event){
        //     event.preventDefault();
        //     var form = $(this);
        //     form.parsley().validate();
        //     if (form.parsley().isValid()) {
        //         var id = $('#new_rgnid').val();
        //         var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
        //         var test = $.inArray(id,arr);
        //         if (test == -1) { // Not in Array
        //             $.ajax({
        //               url: "{{ asset('/employee/dashboard/mf/orderofpayment') }}",
        //               method: 'POST',
        //               data: {
        //                 _token : $('#token').val(),
        //                 id: $('#new_rgnid').val(),
        //                 name : $('#new_rgn_desc').val(),
        //                 mod_id : $('#CurrentPage').val(),
        //                 act: 'add',
        //               },
        //               success: function(data) {
        //                 if (data == 'DONE') {
        //                     alert('Successfully Added New Application Type');
        //                     window.location.href = "{{ asset('/employee/dashboard/mf/orderofpayment') }}";
        //                 } else {
        //                   alert(data);
        //                 }
        //               }
        //           });
        //         } else {
        //           alert('Application ID is already been taken');
        //           $('#new_rgnid').focus();
        //         }
        //     }
        // });
        // $('#EditNow').on('submit',function(event){
        //   event.preventDefault();
        //     var form = $(this);
        //     form.parsley().validate();
        //      if (form.parsley().isValid()) {
        //        var x = $('#edit_name').val();
        //        var y = $('#edit_desc').val();
        //        $.ajax({
        //           url: "{{ asset('/mf/save_aptype') }}",
        //           method: 'POST',
        //           data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
        //           success: function(data){
        //               if (data == "DONE") {
        //                   alert('Successfully Edited Application Type');
        //                   window.location.href = "{{ asset('/employee/dashboard/mf/apptype') }}";
        //               }
        //           }
        //        });
        //      }
        // });
        // function showDelete (id,desc){
        //     $('#DelModSpan').empty();
        //     $('#DelModSpan').append(
        //         '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
        //           // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
        //         '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
        //         '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
        //         '</div>'
        //       );
        // }
        // function deleteNow(){
        //   var id = $("#toBeDeletedID").val();
        //   var name = $("#toBeDeletedname").val();
        //   $.ajax({
        //     url : "{{ asset('/mf/del_aptype') }}",
        //     method: 'POST',
        //     data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        //     success: function(data){
        //       alert('Successfully deleted '+name);
        //       window.location.href = "{{ asset('/employee/dashboard/mf/apptype') }}";
        //     }
        //   });
        // }
    </script>
@endsection