@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="" hidden>
  <script type="text/javascript">Right_GG();</script>
  @if (isset($parts) && isset($asments))
    @foreach ($parts as $part)
     <datalist id="{{$part->partid}}_list">
       @foreach ($asments as $asment)
         @if ($part->partid == $asment->partid)
            <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}" complied="{{$asment->complied}}" fileSelected="" remarks="{{$asment->remarks}}">{{$asment->asmt_name}}</option>
         @endif
       @endforeach
     </datalist>
    @endforeach
  @endif
   {{-- $('#new_rgnid').val() =--}}
 {{-- <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
   @endforeach
 </datalist> --}}
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment {{-- <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a> --}}
           {{-- <div style="float:right;display: inline-block;">
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
           </div> --}}
        </div>
        <div class="card-body">
          <div class="container"> 
            @if(isset($AppData))
                <h3>{{$AppData->facilityname}}</h3>
                <h6>{{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} {{$AppData->zipcode}}</h6>
            @else
            @endif
          </div>
          <hr>
          <div class="container">
          	<div class="row"></div>
          </div>
          <div class="container">
            

			<form id="TESTING" data-parsley-validate>				
               	@if (isset($Parts) && isset($Assments))
                {{-- $i = 0; $i < 10; $i++ --}}
               	    @for ($i = 0; $i < count($Parts); $i++)
               	    <div class="container text-center"><h3>{{$Parts[$i]->partdesc}}</h3></div>
               	    <hr>
               	    	@for ($j = 0; $j < count($Assments); $j++)
               	    		@if ($Parts[$i]->partid == $Assments[$j]->partid)
               	    			<div class="row" id="app_{{$j}}_div" selectedId="{{$Assments[$j]->asmt_id}}">
               	    				<div class="col-sm-5 text-justify" ><h5>&nbsp;&nbsp;&nbsp;&nbsp;{{$Assments[$j]->asmt_name}}</h5></div>
               	    				<div class="col-sm-4">
               	    					 <center>
               	    					 	<button type="button" id="app_{{$j}}_yes" class="btn btn-outline-success" onclick="btnClicked(1, {{$j}})"><i class="fa fa-check" aria-hidden="true"></i></button>
               	    					 	<button type="button" id="app_{{$j}}_no" class="btn btn-outline-danger" onclick="btnClicked(0, {{$j}})"><i class="fa fa-times" aria-hidden="true"></i></button>
               	    					 </center>
               	    				</div>
               	    				<div class="col-sm-3">
               	    					<center>
               	    						<textarea id="app_{{$j}}_rmk" rows="3" class="form-control" placeholder="Remarks"></textarea>
               	    					</center>
               	    				</div>
               	    			</div>
               	    			<br>
               	    		@endif
               	    	@endfor
               	    @endfor
               	@endif
               	<center><button type="button" style="background-color:#0ed639" onclick="SubmitNow()" class="btn btn-primarys">Submit</button></center>
			</form>
          </div>
          <hr>
          <div class="container">
            <center>
              <button class="btn btn-primarys" onclick="window.history.back();">Back</button>
              </button>
            </center> 
          </div>
              {{-- <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">ID</th>
                  <th style="width: 35%">Name</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table> --}}
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
                    {{ csrf_field() }}
                    <div class="col-sm-4">Part:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="partid" data-parsley-required-message="*<strong>Part</strong> required" class="form-control" required>  
                          <option value="">Select Part ...</option>
                          {{-- @foreach ($parts as $part)
                            <option value="{{$part->partid}}">{{$part->partid}}</option>
                          @endforeach --}}
                      </select>
                    </div>
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
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Assessment</strong></h5>
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
              <h5 class="modal-title text-center"><strong>Delete Assessment</strong></h5>
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
      var CheckedOrNot = [], Remarks = [], GetAsMentId=[];
      var numOfAssMents = {{$numOfAssMents}}, test =0;
      $(document).ready(function(){
          for (var i = 0; i < numOfAssMents; i++) {
          CheckedOrNot[i] = null;
          Remarks[i] = "";
          GetAsMentId[i] = $('#app_'+i+'_div').attr('selectedId');
        }
      });
      // console.log(CheckedOrNot);
		function btnClicked(YesNo, AssMentID){
			if(YesNo == 1){
				var name1 = '#app_'+AssMentID+'_yes';
				var name2 = '#app_'+AssMentID+'_no';
        var name3 = '#app_'+AssMentID+'_rmk';
        $(name3).removeAttr('required');
        $(name3).removeAttr('data-parsley-required-message');
			} else {
				var name1 = '#app_'+AssMentID+'_no';
				var name2 = '#app_'+AssMentID+'_yes';
        var name3 = '#app_'+AssMentID+'_rmk';
        $(name3).removeAttr('required');
        $(name3).attr('required', '');
        $(name3).removeAttr('data-parsley-required-message');
        $(name3).attr('data-parsley-required-message', "<strong>Remark</strong> required");
			}
      CheckedOrNot[AssMentID] = YesNo;
      // console.log(CheckedOrNot);
			$(name1).addClass('active')
			$(name2).removeClass('active');

		}
    function SubmitNow(){
      // console.log(CheckedOrNot);
      // console.log(Remarks);
      
      for (var i = 0; i < numOfAssMents; i++) {
        Remarks[i] = $('#app_'+i+'_rmk').val();
      }

      for (var i = 0; i < numOfAssMents; i++) {
        if(CheckedOrNot[i] == null) {
          $('#app_'+i+'_yes').focus();
          test = 1;
          break;
        } else {
          test = 0;
        }

        if (CheckedOrNot[i] == 0 && Remarks[i] == ""){
          $('#app_'+i+'_rmk').focus();
          test = 1;
          break;
        } 

      }

        if(test == 0){
            $.ajax({
              // url : 
              method: 'POST',
              data: {
                _token : '{{Session::token()}}',
                chckOrNot : CheckedOrNot,
                num : numOfAssMents,
                rmks : Remarks,
                AsId : GetAsMentId,
              },
              success : function (data){
                if(data == 'DONE'){

                } else if(data == 'ERROR'){
                    $('#ERROR_MSG2').show(100);
                }
              },
              error : function(XMLHttpRequest, textStatus, errorThrown){
                  $('#ERROR_MSG2').show(100);
              },
            });
        }       
      }
		

  //       function showData(id,desc){
  //         $('#EditBody').empty();
  //         $('#EditBody').append(
  //             '<div class="col-sm-4">ID:</div>' +
  //             '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  //               '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
  //             '</div>' +
  //             '<div class="col-sm-4">Description:</div>' +
  //             '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  //               '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
  //             '</div>' 
  //           );
  //       }
  //       function filterGroup(){
  //       var id = $('#filterer').val();
  //       var title = $('#filterer :selected').text();
  //       if(id != ''){$('#PartTitle').text(title);}
  //       else{$('#PartTitle').text('Please select a part..');}
  //       var token = $('#token').val();
  //       var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
  //       $('#FilterdBody').empty();
  //       // $('#FilterdBody').append('<option value="">Select Province ...</option>');
  //         for (var i = 0; i < x.length; i++) {
  //           var d = $('#'+x[i]+'_pro').text();
  //           var e = $('#'+x[i]+'_pro').attr('value');
  //           var f = $('#'+x[i]+'_pro').attr('complied');
  //           var g = $('#'+x[i]+'_pro').attr('remarks');
  //           var Compliant = (f == 1) ? '<span style="color:green;font-weight:bold">Yes</span>' : '<span style="color:red;font-weight:bold">No</span>';
  //           $('#FilterdBody').append(
  //                       '<tr>'+
  //                         // '<td>'+e+'</td>' +
  //                         '<td>'+d+'</td>' +
  //                         '<td><center>'+Compliant+'</center></td>' +
  //                         '<td><textarea row="2" class="form-control" disabled>'+g+'</textarea></td>' +
  //                       //   '<td><center>'+
  //                       //   '<span class="MA18_update">'+
  //                       //   '<button type="button" class="btn-defaults" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
  //                       //   '</span>'+
  //                       //   '<span class="MA18_cancel">' +
  //                       //   '<button type="button" class="btn-defaults" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
  //                       // '</span>' +
  //                       //   '</center></td>' +
  //                       '</tr>'
  //                       );
  //         }
  //     }
  //     function getData(provname){
  //         $('#edit_name').attr("value",provname);
  //     } 
  //     $('#addCls').on('submit',function(event){
  //           event.preventDefault();
  //           var form = $(this);
  //           form.parsley().validate();
  //           if (form.parsley().isValid()) {
  //               var id = $('#new_rgnid').val();
  //               var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
  //               // console.log(arr);
  //               var test = $.inArray(id,arr);
  //               // console.log($('#partid').val());
  //               if (test == -1) { // Not in Array
  //                   $.ajax({
  //                     // url: "{{asset('employee/dashboard/ph/regions')}}",
  //                     method: 'POST',
  //                     data: {
  //                       _token : $('#token').val(),
  //                       id: $('#new_rgnid').val(),
  //                       name : $('#new_rgn_desc').val(),
  //                       partid : $('#partid').val(),
  //                       mod_id : $('#CurrentPage').val(),
  //                     },
  //                     success: function(data) {
  //                       if (data == 'DONE') {
  //                           alert('Successfully Added New Assessment');
  //                           window.location.href = "{{ asset('employee/dashboard/mf/assessment') }}";
  //                       }
  //                     }
  //                 });
  //               } else {
  //                 alert('Assessment ID is already been taken');
  //                 $('#new_rgnid').focus();
  //               }
  //           }
  //       });
  //     $('#EditNow').on('submit',function(event){
  //         event.preventDefault();
  //           var form = $(this);
  //           form.parsley().validate();
  //            if (form.parsley().isValid()) {
  //              var x = $('#edit_name').val();
  //              var y = $('#edit_desc').val();
  //              $.ajax({
  //                 url: "{{ asset('/mf/save_asmt') }}",
  //                 method: 'POST',
  //                 data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
  //                 success: function(data){
  //                     if (data == "DONE") {
  //                         alert('Successfully Edited Class');
  //                         window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
  //                     }
  //                 }
  //              });
  //            }
  //       });
  //     function showDelete (id,desc){
  //           $('#DelModSpan').empty();
  //           $('#DelModSpan').append(
  //               '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
  //                 // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
  //               '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
  //               '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
  //               '</div>'
  //             );
  //       }
  //       function deleteNow(){
  //         var id = $("#toBeDeletedID").val();
  //         var name = $("#toBeDeletedname").val();
  //         $.ajax({
  //           url : "{{ asset('/mf/del_asmt') }}",
  //           method: 'POST',
  //           data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
  //           success: function(data){
  //             alert('Successfully deleted '+name);
  //             window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
  //           }
  //         });
  //       }
    </script>
@endsection