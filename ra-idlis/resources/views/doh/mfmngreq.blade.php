@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
<datalist id="test_list">
  @if (isset($uploads))
    @foreach ($uploads as $upload)
     <option  value="{{$upload->updesc}}" data-id="{{$upload->upid}}"></option>
    @endforeach
  @endif
</datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Manage Requirements <a href="" title="Add New" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>  
        </div>
        <div class="card-body">
          <div style="float:left;margin-bottom: 5px">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Application Type">
              <datalist id="grp_list">
                @if (isset($types))
                  @foreach ($types as $type)
                    <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                  @endforeach
                @endif
              </datalist>
              <datalist id="mod_list">
               {{--  @foreach ($modules as $module)
                  <option value="{{$module->mod_id}}">{{$module->mod_desc}}</option>
                @endforeach --}}
              </datalist>
              &nbsp;
              {{-- <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="chckIn()">Save</button> --}}
              <select class="form-control">
              	<option value="">Please Select Health Facility... </option>
              	{{-- @isset ($facilitys)
              	    @foreach ($facilitys as $f)
              	    	<option value="{{$f->facid}}">{{$f->facname}}</option>
              	    @endforeach
              	@endisset --}}
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
          <span id="showSucc">
          
          </span>
          <div class="table-responsive">
            <table class="table table-hover" {{-- id="example" --}} style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 55%">Requirements</th>
                  <th style="width: 20%"><center>Required</center></th>
                  <th style="width: 25%"><center>Option</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table>
            </div>
        </div>
    </div>
      </div>
      <div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong><span id="ifActiveTitle">Add Order of Payment</span></strong></h5>
              <hr>
              <div class="container">
                <form  id="AddOOP" class="row" data-parsley-validate>
                  <div class="col-sm-12" id="Error"></div>
                  <div class="col-sm-4">
                    Order of Payment:
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="PutTypeIDhere" name="" hidden>
                      <select class="form-control" id="selectedOOP" data-parsley-required-message="*<strong>Order of Payment</strong> required." required>
                        <option value=""></option>
                        @if(isset($oops))
                          @foreach ($oops as $oop)
                            <option value="{{$oop->oop_id}}">{{$oop->oop_desc}}</option>
                          @endforeach
                        @endif
                      </select>
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add</button>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                    </div>
                  </div> 
                </form>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade bd-example-modal-lg" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong><span id="GodModalTitle"></span></strong></h5>
              <input type="text" id="TransfereedID" style="display:none;">
              <hr>
              <div class="container">
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="GetErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#GetErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="row">
                  <div class="col-sm-10" id="AddNewRequirementDIV"></div>
                  <div class="col-sm-1" id="CancelBtn"></div>                    
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-outline-info form-control" onclick="AddNewRequirement();" title="Add New Requirement" style="border-radius:0;"><span class="fa fa-plus"></span></button>
                  </div>
                </div>
                <br>
                <form  class="row" >
                  <div class="col-sm-12" id="GodModal_error"></div>
                  <div class="col-sm-12" id="GodModalBody">
                      <table class="table table-hover" style="overflow-x: scroll;" >
                        <thead>
                          <tr>
                            <th style="width: 50%">Requirements</th>
                            {{-- <th style="width: 20%"><center>Allow</center></th> --}}
                            <th style="width: 25%"><center>Required</center></th>
                            <th style="width: 25%"><center>Option</center></th>
                          </tr>
                        </thead>
                        <tbody id="GodModalTableBody">
                        </tbody>
                      </table>
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <div class="row">
                      <div class="col-sm-6"></div>
                      <div class="col-sm-3">
                        {{-- <button type="button" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button> --}}
                      </div>
                      <div class="col-sm-3">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                      </div>
                    </div>
                  </div> 
                </form>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body container" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add Requirement</strong></h5>
              <hr>
              <form id="NewFacServIn" class="container" action="#" class="row" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <div class="row">
                    <div class="col-sm-4">Application :</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                     <select id="appID" data-parsley-required-message="*<strong>Application</strong> required" class="form-control" required>  
                            <option value="">Select Application ...</option>
                            @if(isset($types))
                              @foreach ($types as $type)
                                <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Facility/Service :</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                     <select id="FacServID" data-parsley-required-message="*<strong>Facility/Service</strong> required" class="form-control" required>  
                            <option value="">Select Facility/Service ...</option>
                            @if (isset($facilitys))
                              @foreach ($facilitys as $facility)
                                <option value="{{$facility->facid}}">{{$facility->facname}}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                  <div class="row">
                  	<div class="col-sm-4">Uploads :</div>
                  	<div class="col-sm-8"></div>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add Facility/Service</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    <script type="text/javascript">
      // $(document).ready(function() {
      //     $('#example').DataTable();
      // } );
      var AddMenu = 0;
      function CancelRequirement (){
        $('#AddNewRequirementDIV').empty();
        $('#CancelBtn').empty();
        AddMenu = 0;
      }
      function AddNewRequirement(){
        if (AddMenu == 0) {
            $('#AddNewRequirementDIV').empty();
            $('#AddNewRequirementDIV').append(
                  '<form id="AddNewRequirementForm"><input type="text" data-parsley-required-message="*<strong>Upload</strong> required"  class="form-control" id="requirementData" list="test_list" onchange="" placeholder="Select Uploads ..." required=""></form>'
                );
            $('#CancelBtn').empty();
            $('#CancelBtn').append(
              '<button type="button" class="btn btn-outline-warning form-control" onclick="CancelRequirement();" title="Cancel adding requirement" style="border-radius:0;"><span class="fa fa-times"></span></button>'
              );
          AddMenu = 1;
        } else if (AddMenu == 1) {
         // .parsley().validate();
         var form =  $('#AddNewRequirementForm');
          form.parsley().validate();
          if (form.parsley().isValid()) {
            var getdata = $('#requirementData').val();
            var selectedID = $('option[value="'+getdata+'"]').attr("data-id");
              $.ajax({
                  // url: "{{ asset('/mf/add_typefa') }}",
                  method: "POST",
                  data: {_token:$('input[name="_token"]').val(),id:selectedID,typeID:$('#TransfereedID').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully added Upload as a Requirement');
                          $('#AddNewRequirementDIV').empty();
                          $('#CancelBtn').empty();
                          $('#GodModal').modal('toggle');
                          AddMenu=0;
                      } else if (data == "SAME") {
                          alert('Selected upload is already listed as a Requirement.');
                          $('#requirementData').focus();
                      } else if (data == 'ERROR') {
                        $('#GetErrorAlert').show(100);
                      }
                  }
              });
          }
        }
      }
      function DelRequirement (id){ //////////////// MISSING
        
      }
      function  showData(id,facname,hfser_id,hfser_name){
          $('#GodModalTitle').text('Requirements for '+hfser_name+' ('+hfser_id+') in '+facname);
          $('#TransfereedID').val(id);
          $.ajax({
                // url : "{{ asset('/mf/facility/getRequirements') }}",
                method : "POST",
                data :{_token:$('input[name="_token"]').val(),tyf_id:id},
                success: function(data){
                      $('#GodModalTableBody').empty();
                      if (data!= "NONE") {
                        for (var i = 0; i < data.length; i++) {
                            var d = data[i];
                            var allow = (data[i].fr_alw == 1) ? 'checked=""' : '';
                            var required = (data[i].isRequired == 1) ? '<span style="color:green">YES</span>' : '<span style="color:red">NO</span>';
                            $('#GodModalTableBody').append(
                                  '<tr>' +
                                    '<td>'+data[i].updesc+'</td>'+
                                    '<td><center><strong>'+required+'</strong></center></td>' +
                                    '<td><center><button type="button" class="btn-defaults" onclick="DelRequirement('+data[i].fr_id+');"><i class="fa fa-fw fa-trash"></i></button></center></td>' +
                                  '</tr>'
                              );
                        }
                      } else if (data == 'NONE'){
                          $('#GodModalTableBody').empty();
                      }  else if (data == 'ERROR'){
                          $('#GetErrorAlert').show(100);
                      }
                }, error : function (XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#GetErrorAlert').show(100);
                }
            }
          );
      }
      // function ChangeStateNow (ifActiveState){
      //   var state = $('#ifActiveState').text();
      //   var id = $('#ifActiveID').text();
      //   $.ajax({
      //       url: "{{ asset('/m2f/facility/isEnabled') }}",
      //       method: "POST",
      //       data: {_token:$('input[name="_token"]').val(),isEnabled:state,id:id},
      //       success: function(data){
      //           if (data == 'DONE') {
      //               alert('Successfully change status of a Facility/Service');
      //               $('#IfActiveModal').modal('toggle');
      //               filterGroup();
      //           }
      //         }
      //     });
      // }
      function showIfActive(state,id,facname,hfser_id,hfser_name){
        var title, message;
        if (state == 1) {
            title = "Disable Facility/Service in "+hfser_name+"("+hfser_id+")";
            message = "Are you sure you want to disable <strong>" + facname + "</strong>?";
          } else {
            title = "Enabled Facility/Service in "+hfser_name+"("+hfser_id+")";
            message = "Are you sure you want to enable <strong>" + facname + "</strong>?";
          }
          $('#ifActiveTitle').text(title);
          $('#IfActiveModalBody').empty();
          $('#IfActiveModalBody').append(message+'<span id="ifActiveState" hidden>'+state+'</span><span id="ifActiveID" hidden>'+id+'</span>');
      }
      // function filterGroup(){
      //   var id = $('#filterer').val();
      //   var token = $('#token').val();
      //   $.ajax({
      //           // url: " {{asset('mf/getTypeFaci')}}",
      //           method: 'POST',
      //           data: {
      //             _token : token,
      //             hfser_id : id,
      //           },
      //           success: function(data) {
      //             if (data == 'NONE') {
      //               $('#FilterdBody').empty();
      //             } else {
      //               $('#FilterdBody').empty();
      //               for (var i = 0; i < data.length; i++) {
      //                 var option = "", settings = "", addOOP = "";
      //                  // option = '<a href="#"><button data-toggle="modal" onclick="showIfActive('+data[i].tyf_alw+','+data[i].tyf_id+',\''+data[i].facname+'\',\''+data[i].hfser_id+'\',\''+data[i].hfser_desc+'\');" data-target="#IfActiveModal" class="btn btn-danger" title="Disable Facility/Service">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>';
      //                  settings = '<a href="#" ><button data-toggle="modal" data-target="#GodModal" onclick="showData('+data[i].tyf_id+',\''+data[i].facname+'\',\''+data[i].hfser_id+'\',\''+data[i].hfser_desc+'\')" class="btn btn-primary" title="Manage Requirements">&nbsp;<i class="fa fa-cog"></i>&nbsp;</button></a>';
      //                  if (data[i].oop_id == "N" || data[i].oop_id === null ) {
      //                     addOOP = '<a href="#"><button data-toggle="modal" data-target="#IfActiveModal" onclick="AddOOP('+data[i].tyf_id+',\'Add\')" class="btn btn-success" title="Add Order of Payment">&nbsp;<i class="fa fa-plus"></i></button></a>';
      //                  }  else {
      //                     addOOP = '<a href="#"><button data-toggle="modal" data-target="#IfActiveModal" onclick="AddOOP('+data[i].tyf_id+',\'Edit\')" class="btn btn-warning" title="Change Order of Payment">&nbsp;<i class="fa fa-edit" aria-hidden="true"></i></button></a>';
      //                  }
                     
      //                 $('#FilterdBody').append(
      //                     '<tr>'+
      //                         '<td>'+data[i].facname+'</td>' +
      //                         // '<td><center><strong>'+data[i].oop_desc +'</strong></center></td>' +
      //                         // '+addOOP+ '&nbsp;' +
      //                         '<td><center>'+
      //                             option+ '&nbsp;'+
      //                             settings+
      //                         '</center></td>'+
      //                         // '<td><center><button type="button" class="btn-defaults" onclick="getData();" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button></center></td>' +
      //                     '<tr>'
      //                   );
      //               }
      //             }
      //           }, error : function(XMLHttpRequest, textStatus, errorThrown){
      //             console.log(errorThrown);
      //           }
      //       });
      // }
      $('#NewFacServIn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              // $.ajax({
              //     url: '{{ asset('employee/dashboard/mf/typefa') }}',
              //     method: 'POST',
              //     data: {_token:$('input[name="_token"]').val(),hfser_id:$('#appID').val(),facid:FacServID},
              //     success: function(data){
              //         alert(data);
              //     }
              // });
              $.ajax({
                      // url: "{{asset('employee/dashboard/mf/typefa')}}",
                      method: 'POST',
                      data: {_token:$('input[name="_token"]').val(),hfser_id:$('#appID').val(),facid:$('#FacServID').val()},
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Facility/Service in an Application');
                            window.location.href = "{{ asset('employee/dashboard/mf/typefa') }}";
                        } else if (data == 'SAME') {
                            alert('Facility/Service is already in the selected Application');
                            $('#FacServID').focus();
                        } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);
                        }
                      }, error : function (XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert');
                      }
                  });
          }
      });
      function AddOOP(typ_id, type){
        $('#ifActiveTitle').empty();
          $('#PutTypeIDhere').attr('value',typ_id);
          if (type == 'Add') {
              $('#ifActiveTitle').append('Add Order of Payment');
          } else { $('#ifActiveTitle').append('Change Order of Payment');}
      }
      $('#AddOOP').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
          $.ajax({
            // url : '{{ asset('/mf/save_oop') }}',
            method : 'POST',
            data : {_token:$('input[name="_token"]').val(), appID : $('#PutTypeIDhere').val(), OopID : $("#selectedOOP").val() },
            success : function(data){
              if (data == 'DONE') {
                alert('Successfully Added Order of Payment');
                filterGroup();
                $('#IfActiveModal').modal('toggle');

              }
            }
          });
        }
      });
    </script>
@endsection