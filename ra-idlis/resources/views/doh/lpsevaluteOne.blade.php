@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
  @isset($Holidays)
    <datalist id="HolidaysList">
        @foreach ($Holidays as $day)
          <option id="{{$day->hdy_date}}_dt" typ="{{$day->hdy_typ}}">{{$day->hdy_desc}}</option>
        @endforeach
    </datalist>
  @endisset
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          <input type="text" id="NumberOfRejected" value="@isset ($numOfX) {{$numOfX}} @endisset" hidden>
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Evaluation
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
          <thead>
            <tr>
              <td width="80%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                <h6>@isset($AppData) Status: @if ($AppData->isrecommended === null) <span style="color:blue">For Evaluation</span> @elseif($AppData->isrecommended == 1)  <span style="color:green">Accepted Evaluation</span> @else <span style="color:red">Rejected Evaluation</span> @endif @endisset</h6>
              </td>
              <td width="5%"></td>
              <td width="15%">
                <center><h4>DOH</h4>
                  <h4>Evaluation</h4></center>
              </td>
            </tr>
          </thead>
          <tbody>
      <form id="EvalForm" data-parsley-validate>
            <input type="text" name="TotalNumber" value="@isset($UploadData){{count($UploadData)}}@endisset" hidden>
            @if (isset($UploadData))
              @foreach ($UploadData as $UpData) 
                <tr>
                <td >
                  <font>
                    {{$UpData->updesc}}
                  </font>
                </td>
                <td>
                  <center>
                    <a href="{{ route('DownloadFile', $UpData->filepath) }}">
                    <button type="button" class="btn-primarys">
                      <i class="fa fa-download" aria-hidden="true"></i>
                    </button>
                    </a>
                  </center>
                </td>
                <td>
                  <center>
                    <button type="button" id="appdow_{{$UpData->apup_id}}_yes" @if($UpData->evaluation === NULL) data-toggle="modal" data-target="#TestModal" @endif class="btn btn-success app_id_{{$UpData->appid}}" onclick="showModalForEvaluate(1,{{$UpData->apup_id}})" @if($UpData->evaluation == 0 && $UpData->evaluation !== NULL)) disabled @endif>
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                    {{-- {{$UpData->evaluation}} --}}
                    <button type="button" id="appdow_{{$UpData->apup_id}}_no" @if($UpData->evaluation === NULL) data-toggle="modal" data-target="#TestModal" @endif class="btn btn-danger" onclick="showModalForEvaluate(0,{{$UpData->apup_id}})" @if($UpData->evaluation == 1 && $UpData->evaluation !== NULL) disabled @endif>
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    @if($UpData->evaluation !== NULL)
                          <button type="button"  data-toggle="modal" data-target="#ShowDetailsModal" class="btn btn-primary" onclick="ShowDetails({{$UpData->evaluation}}, {{$UpData->apup_id}}, '{{$UpData->updesc}}')">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                    @endif
                  </center>
                </td>
              </tr>
              @endforeach
            @endif
          </tbody>  
        </table>
        <div class="row">
          <div class="col-sm-6" >
              <label>Recommended for Inspection?</label>
                    <!-- data-toggle="modal" data-target="#exampleModalCenter" -->
              @isset($AppData)
                @if ($AppData->isrecommended === null)
                <button type="button"  class="btn-primarys" style="background-color:#82d202" onclick="Recommended4Inspection(1);">Yes</button>
                <button type="button" class="btn-defaults" onclick="Recommended4Inspection(0);">No</button>
                @elseif($AppData->isrecommended == '0')
                <span style="color: red;font-weight: bolder">NO </span>
                @else
                <span style="color: green;font-weight: bolder">YES </span>
                @endif
              @endisset
              &nbsp;
              @isset($OPPok)
                @if ($OPPok === null AND $AppData->isrecommended == 1)
                  <button type="button" class="btn btn-info" title="Order of Payment" data-target="#ShowList" data-toggle="modal"  {{-- onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$OOPs->oop_id}}/add'" --}}><i class="fa fa-plus" aria-hidden="true"></i></button>
                @elseif($OPPok !== null AND $AppData->isrecommended == 1)
                  <button type="button" class="btn btn-info" title="Order of Payment" onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$OPPok->oop_id}}/view'"><i class="fa fa-eye" aria-hidden="true"></i></button>
                @endif
              @endisset
          </div>  
          <div class="col-sm-6">
            <span>
              <label class="form-inline">Date of Inspection:&nbsp;
              @isset($AppData)
                @if ($AppData->isrecommended === null)
                  <input type="date" id="propDate" data-toggle="tooltip" title="Recommended Date : @isset($DateString){{$DateString}}@endisset" class="form-control" onchange="chckDate();" value="@isset($ActualString){{$ActualString}}@endisset" required>&nbsp;</label>
                @elseif($AppData->isrecommended == '0')
                <span style="color: red;font-weight: bolder">None </span>
                @else 
                <span style="color: green;font-weight: bolder">{{$AppData->formattedPropDate}}</span>
                @endif
              @endisset
            </span>
            <span>
              <label class="form-inline">Time of Inspection:&nbsp;
              @isset($AppData)
                @if ($AppData->isrecommended === null)
                <input type="time" class="form-control" data-toggle="tooltip" title="Recommended time is between 8:00 AM to 5:00 PM" data-parsley-required-message="Required" id="propTime" onchange="chckTime();" value="08:00" required>
                @elseif($AppData->isrecommended == '0')
                <span style="color: red;font-weight: bolder">None </span>
                @else
                <span style="color: green;font-weight: bolder">{{$AppData->formattedPropTime}} </span>
                @endif
              @endisset
            </span>
          </form>    
          </div>    
        </div>
        </div>
    </div>
        </div>
    </div>
    {{-- TestModal --}}
     <div class="modal fade" id="TestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h4 class="modal-title text-center"><strong>Evaluate</strong></h4>
                <hr>
                <form id="EvalFormConfirm" action="{{ asset('employee/dashboard/lps/evaluate') }}/@isset($appID){{$appID}}@else # @endisset" method="POST" data-parsley-validate>
                  @csrf
                  <input type="hidden" name="appUp_ID" value="">
                  <input type="hidden" name="evalYesNo" value="">
                <div class="container">
                  <div class="col-sm-12" id="TestModalBody">
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-5" style="font-weight: bold">
                      Remarks (255 max):
                    </div>
                    <div class="col-sm-7" id="TestModaRemarks">
                    </div>
                  </div>
                  <br>
                </div>
                <hr>
                  <div class="row">
                      <div class="col-sm-2">
                      </div>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;" ><span class="fa fa-sign-up"></span>Confirm</button>
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
<div class="modal fade" id="ShowList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <div class="showHospit"><h5>Please select the type of Order of Payment</h5>
        <ul>
       {{--    <ol><a href="{{asset('headorderofpayment')}}">Hospital Based Private</a></ol>
          <ol><a href="{{asset('headorderofpayment2')}}">Hospital Based Government</a></ol>
          <ol><a href="{{asset('headorderofpayment3')}}">Non-Hospital based other Health Facilities</a></ol>
          <ol><a href="{{asset('headorderofpayment4')}}">Certificate of Need/Permit to Construct </a></ol>
          <ol><a href="{{asset('headorderofpayment5')}}">Dental Laboratory</a></ol>
          <ol><a href="{{asset('headorderofpayment6')}}">Non-Hospital Based with Ancillary</a></ol> --}}
          @isset ($OOPS)
            @foreach ($OOPS as $oop)
              <ol><a href="{{ asset('/employee/dashboard/lps/evaluate/')}}/{{$AppData->appid}}/{{$oop->oop_id}}/add">{{$oop->oop_desc}}</a></ol>
            @endforeach
          @endisset
       </ul>
       <div class="text-center"><button type="button" class="btn btn-warning showHospit" data-dismiss="modal" style="display:none" onclick="showNow2()">Cancel</button></div>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
                <table  class="showConfirm">
                <td><h5><span id="ConfirmMessage"></span></h5></td>
                <td><button type="button" class="btn-primarys" id="ModalYesButton">Yes</button></td>
                {{-- onclick="showNow()" --}}
                <td><button type="button" class="btn-defaults" id="ModalNoButton">No</button></td>
               </table>
       <div class="showHospit" style="display: none"><h5>Since YES you will proceed to Order of Payment.</h5>
        <ul>
          <ol><a href="{{asset('headorderofpayment')}}">Hospital Based Private</a></ol>
          <ol><a href="{{asset('headorderofpayment2')}}">Hospital Based Government</a></ol>
          <ol><a href="{{asset('headorderofpayment3')}}">Non-Hospital based other Health Facilities</a></ol>
          <ol><a href="{{asset('headorderofpayment4')}}">Certificate of Need/Permit to Construct </a></ol>
          <ol><a href="{{asset('headorderofpayment5')}}">Dental Laboratory</a></ol>
          <ol><a href="{{asset('headorderofpayment6')}}">Non-Hospital Based with Ancillary</a></ol>
       </ul>
       <div class="text-center"><button type="button" class="btn btn-warning showHospit" data-dismiss="modal" style="display:none" onclick="showNow2()">Cancel</button></div>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ShowDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
        <div class="modal-body">
          <h4 class="modal-title text-center"><strong>Details</strong></h4>
            <hr>
            <span id="ShowDetailsModalBody"></span>
            <hr>            
              <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                </div> 
                <div class="col-sm-4">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                </div>
              </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        var numOfUploads = @isset($numOfApp){{$numOfApp}}@else 0 @endisset, numOfRejected = @isset($numOfX){{$numOfX}}@else 0 @endisset, numofAprv = @isset($numOfAprv){{$numOfAprv}}@else 0 @endisset, numOfNull = @isset($numOfNull){{$numOfNull}}@else 0 @endisset, apid = @isset($appID){{$appID}}@else 0 @endisset, DateError = 0, DateErrorMsg ='',TimeError = 0;
        function showNow(){
          $('.showHospit').show();
          $('.showConfirm').hide();
        }
        function showNow2(){
          $('.showConfirm').show();
          $('.showHospit').hide();
        }
        function showModalForEvaluate(YesNo, app_up_id){
          var msg = "";
          $('input[name="appUp_ID"]').val(app_up_id);
          $('input[name="evalYesNo"]').val(YesNo);
          $('#TestModalBody').empty();
          $('#TestModaRemarks').empty();
          $('#TestModaRemarks').append('<textarea id="EvalRemarkTxtArea" name="remark" data-parsley-maxlength="255" class="form-control" rows="4" style="width: 100%;height: 100%;"></textarea>');
          $('#EvalRemarkTxtArea').attr('data-parsley-maxlength-message','Remarks should have <strong>255</strong> characters or fewer.');
          // maxlength='140'
          $('#EvalRemarkTxtArea').attr('maxlength','255');
          if (YesNo == 0) { // NO
              msg = 'This is to confirm that the uploaded document you evaluated has a <span style="color:red">problem</span>, please state the problem in the remarks area.';
              $('#EvalRemarkTxtArea').attr('required','');
              $('#EvalRemarkTxtArea').attr('data-parsley-required-message','*<strong>Remark</strong> required.');
          } else { // YES
            msg = 'This is to confirm that the uploaded document you evaluated is <span style="color:green">correct</span>, add additional remark if neccessary. ';
          }
          $('#TestModalBody').append('<h5 style="text-align:justify;text-justify: inter-word">&nbsp;&nbsp;&nbsp;'+msg+'</h5>');
        }
        function ShowDetails (evaluation,apup_id,desc){
          $.ajax({
            url : '{{asset('/lps/getEvalDetails')}}',
            method : 'POST',
            data : {_token:$('#token').val(), apup_id: apup_id},
            success : function(data){
               if (data == 'NONE') { // Error
                  $('#ShowDetailsModal').modal('toggle');
               } else {
                  var name = "", status = "";
                  var remark = (data.remarks == null) ? '' : data.remarks;
                  // data.remarks
                  if (data.grpid == 'NA') {name="Administrator";}
                  else {
                        var mname = data.mname;
                        mname = mname.charAt(0);
                        name = data.fname + ' ' + mname.toLowerCase() + ' ' + data.lname;
                   }
                   if (data.evaluation === null) {status = "Not yet Evaluated";}
                   else if (data.evaluation == "0") {status = '<span style="color:red;font-weight:bold">Document Rejected</span>';}
                   else if (data.evaluation == "1") {status = '<span style="color:green;font-weight:bold">Document Approved</span>';}
                  $('#ShowDetailsModalBody').empty();
                  $('#ShowDetailsModalBody').append(
                        '<div class="container">' +
                          '<div class="row"><div class="col-sm-5" style="font-weight: bold">Description:</div><div class="col-sm-7"><justify>'+desc+'</justify></div></div><br>' +
                          '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluated By:</div><div class="col-sm-7">'+name+'</div></div>' +
                          '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluation Time/Date:</div><div class="col-sm-7">'+data.formattedEvalTime+' - '+data.formatteEvalDate+'</div></div>' + 
                          // '<div class="row"><div class="col-sm-5" style="font-weight: bold">Evaluated By:</div><div class="col-sm-7">'+name+'</div></div>' +                        
                          '<div class="row"><div class="col-sm-5" style="font-weight: bold">Status:</div><div class="col-sm-7">'+status+'</div></div>' +
                          '<div class="row"><div class="col-sm-5" style="font-weight: bold">Remarks:</div><div class="col-sm-7">'+remark+'</div></div>' +                          
                        '</div>'
                    );
               }
            },
          });
        }
        function Recommended4Inspection(YesNo){
          var total =  numOfRejected + numofAprv;
          var PropDate = $('#propDate').val();
          var PropTime = $('#propTime').val();
          if (total != numOfUploads) {
            alert('Not all upload is evaluated. Please evaluate the uploaded files before proceeding.');
          } else {
            $('#ConfirmMessage').empty();
            $('#ModalYesButton').attr('onclick','');
            $('#ModalNoButton').attr('onclick','');
            $('#ModalNoButton').attr('onclick',"$('#modalins').modal('toggle');");
            if (YesNo == 1) { // Yes Selected
                if (numofAprv != 0) { // Proceed
                  if (PropDate == "" && PropTime == "") {
                      $('#propDate').focus();
                      alert("Please propose date and time for inspection.");
                  } else if (PropDate == "") {
                    $('#propDate').focus();
                    alert("Please propose date for inspection.");
                  } else if (DateError == 1) {
                    alert(DateErrorMsg);
                    $('#propDate').focus();
                  } else if (PropTime == ""){
                    $('#propTime').focus();
                    alert("Please propose time for inspection.");
                  } else if (TimeError == 1){
                    $('#propTime').focus();
                    alert("The recommended inspection time is between 8:00 AM to 5:00 PM");
                  } else{
                    $('#ConfirmMessage').append('&nbsp;&nbsp;&nbsp;&nbsp;Are sure you want to <span style="color:green">accept</span> this application?');
                    $('#ModalYesButton').attr('onclick','ApproveApplication()');
                    //showNow
                    $('#modalins').modal('toggle');
                  }
                } else {
                  alert('An upload has been rejected. Cannot proceed recommending for inspection.');
                }
            } else { // No Selected
                if (numOfRejected != 0) { // Proceed
                  $('#ConfirmMessage').append('&nbsp;&nbsp;&nbsp;&nbsp;Are sure you want to <span style="color:red">reject</span> this application?');
                  $('#ModalYesButton').attr('onclick','RejectApplication()');
                  $('#modalins').modal('toggle');
                } else {
                  alert('All upload has been approved. Cannot proceed on rejecting the evaluation for inspection.');
                }
            }
          }
      }
        // $('#EvalForm').on('submit',function(e){
        //   e.preventDefault();
        //   var form = $(this);
        //   form.parsley().validate();
        // });
      function RejectApplication(){
          // apid
          $.ajax({
                url : '{{ asset('/lsp/reject_app') }}',
                method : 'POST',
                data : {_token:$('#token').val(), apid :apid},
                success : function(data){
                  if (data == 'DONE') {
                    alert('Successfully Rejected Application');
                    location.reload();
                  } else if (data == 'ERROR'){
                      $('#ERROR_MSG2').show(100);
                  }
                }, error : function (XMLHttpRequest, textStatus, errorThrown){
                   console.log(errorThrown);
                   $('#ERROR_MSG2').show(100);
                }

            });
      }
      function ApproveApplication(){
        $.ajax({
            url : '{{ asset('/lsp/accept_app') }}',
            method : 'POST',
            data : {_token:$('#token').val(), apid :apid, propdate : $('#propDate').val(), proptime : $('#propTime').val()},
            success : function(data){
                if (data == 'DONE') {
                    alert('Successfully Accepted Application');
                    location.reload();
                  } else if (data == 'ERROR') {
                    $('#ERROR_MSG2').show(100);
                  }
            }, error : function (XMLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
                $('#ERROR_MSG2').show(100);
            }
        });
      }
      function chckDate(){
        var dateVal = $('#propDate').val();
        var recoDate = "@isset($AfterDay){{$AfterDay}}@else # @endisset";
        var DateNow = "@isset($DateNow){{$DateNow}}@else # @endisset"
        if(new Date(dateVal) > new Date(recoDate)){ // Check if its within 30 days 
          alert('The inspection date should be within 30 days the evaluation date.');
          DateError = 1;
          DateErrorMsg = 'The inspection date should be within 30 days the evaluation date.';
          $('#propDate').focus();
        } else if(new Date(dateVal) < new Date(DateNow)) {
            alert('The inspection date should not be before the evaluation date.');
            DateError = 1;
            DateErrorMsg = 'The inspection date should not be before the evaluation date.';
            $('#propDate').focus();
        }else { 
            var ChckIfWeekend = new Date(dateVal);
            DateError = 0;
            DateErrorMsg = '';
            if(ChckIfWeekend.getDay() == 6 || ChckIfWeekend.getDay() == 0) { // Check if its a weekend or not
                alert('The inspection date should be on weekdays.');
                DateError = 1;
                DateErrorMsg = 'The inspection date should be 30 days after the evaluation date.';
                $('#propDate').focus();
              } else {
                   DateError = 0;
                   DateErrorMsg = '';
                   var x = $('#'+dateVal+'_dt').text();
                   if (x) {
                      var y = $('#'+dateVal+'_dt').attr('typ');
                      var msg = 'The selected date is a '+y+' holiday : '+x+'.';
                      alert(msg);
                      DateError = 1;
                      DateErrorMsg = msg;
                   } else {
                      DateError = 0;
                      DateErrorMsg = '';
                   }
              } 
        }
      }
      function chckTime(){
          var format = 'hh:mm';
          // var time = moment() gives you current time. no format required.
          var time = moment($('#propTime').val(),format),
            beforeTime = moment('07:59',format),
            afterTime = moment('17:01',format);
          if (time.isBetween(beforeTime, afterTime)) {
            TimeError = 0;
          } else {
            TimeError = 1;
          }
      }
      </script>
@endsection