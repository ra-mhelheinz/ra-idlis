@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA05" hidden>
  <script type="text/javascript">Right_GG();</script>
  {{-- @foreach ($hfstypes as $hfstype)
   <datalist id="{{$hfstype->hfser_id}}_list">
     @foreach ($fatypes as $fatype)
       @if ($hfstype->hfser_id == $fatype->hfser_id)
          <option id="{{$fatype->facid}}_pro" value="{{$fatype->facid}}">{{$fatype->facname}}</option>
       @endif
     @endforeach
   </datalist>
  @endforeach --}}
   {{-- $('#new_rgnid').val() --}}
 <datalist id="rgn_list">
   @if (isset($fatypes))
     @foreach ($fatypes as $fatype)
      <option id="{{$fatype->facid}}_pro" value="{{$fatype->facid}}">{{$fatype->facname}}</option>
    @endforeach
   @endif
 </datalist>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Health Facility/Service <a href="#" title="Add New Health Facility/Service" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <input type="" id="token" value="{{ Session::token() }}" hidden>
            {{-- <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Health Facility/Service Type ...</option>
                @foreach ($hfstypes as $hfstype)
                  <option value="{{$hfstype->hfser_id}}">{{$hfstype->hfser_desc}}</option>
                @endforeach
              </select>
              
              </form> --}}
           </div>
        </div>
        <div class="card-body">
               <table class="table display" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">ID</th>
                  <th style="width: 35%">Name</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                @if($fatypes)
                @foreach ($fatypes as $fatype)
                  <tr>
                          <td>{{$fatype->facid}}</td>
                          <td>{{$fatype->facname}}</td>
                          <td><center>
                          <span class="MA05_update">
                          <button type="button" class="btn-defaults" onclick="showData('{{$fatype->facid}}','{{$fatype->facname}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                          </span>
                          <span class="MA05_cancel">
                          <button type="button" class="btn-defaults" onclick="showDelete('{{$fatype->facid}}', '{{$fatype->facname}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                       </span>
                          </center></td>
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
                <h5 class="modal-title text-center"><strong>Add New Health Facility/Service</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" id="addCls" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ csrf_field() }}
                    {{-- <div class="col-sm-4">Facility/Service Type:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="hfser_id" data-parsley-required-message="*<strong>Facility/Service</strong> required" class="form-control" required>  
                          <option value="">Select Facility/Service Type ...</option>
                          @foreach ($hfstypes as $hfstype)
                            <option value="{{$hfstype->hfser_id}}">{{$hfstype->hfser_desc}}</option>
                          @endforeach
                      </select>
                    </div> --}}
                    <div class="col-sm-4">ID:</div>
                    <div class="col-sm-8"  style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
                    </div>
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
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Health Faclity/Service</strong></h5>
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
              <h5 class="modal-title text-center"><strong>Delete Health Facility/Service</strong></h5>
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
              dom: 'Bfrtip',
              buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
          });
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
                '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
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
                          '<span class="MA05_update">'+
                          '<button type="button" class="btn-defaults" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
                          '</span>'+
                          '<span class="MA05_cancel">' +
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
                // console.log($('#hfser_id').val());
                if (test == -1) { // Not in Array
                    $.ajax({
                      url: "{{asset('employee/dashboard/mf/faciserv')}}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        id: $('#new_rgnid').val(),
                        name : $('#new_rgn_desc').val(),
                        // hfser_id : $('#hfser_id').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Facility/Service');
                            window.location.href = "{{ asset('employee/dashboard/mf/faciserv') }}";
                        } else if (data == 'ERROR'){
                            $('#AddErrorAlert').show(100);
                        }
                      }, error : function(XMLHttpRequest, textStatus, errorThrown){
                          console.log(errorThrown);
                          $('#AddErrorAlert');
                      }
                  });
                } else {
                  alert('Health Facility/Service ID is already been taken');
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
                  url: "{{ asset('/mf/save_faaptype') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Facility/Service');
                          window.location.href = "{{ asset('/employee/dashboard/mf/faciserv') }}";
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
            url : "{{ asset('/mf/del_FaType') }}",
            method: 'POST',
            data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
            success: function(data){
               if (data == 'DONE') {
                   alert('Successfully deleted '+name);
                  window.location.href = "{{ asset('/employee/dashboard/mf/faciserv') }}";
               } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
               }
            }, error : function(XMLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
                $('#DelErrorAlert').show(100);
            }
          });
        }
    </script>
@endsection