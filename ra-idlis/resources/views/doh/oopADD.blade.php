@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="row container-fluid" style="margin-top: 10px;">
  <div class="col-sm-12">
       <div class="card" style="margin: 0 0 5em 0;">
          <div class="card-header bg-white">
            <table style="width:100%;">
              <tr>
                <th style="width:10%"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="height: auto; width:100px;"></th>
                <th class="text-center" style="width:80%">
                  <h6>Republic of the Philippines</h6>
                  <h6>DEPARTMENT OF HEALTH</h6>
                  <h5>Order of Payment</h5>
                  <h4><strong>@isset($oop_data){{$oop_data->oop_desc}}@endisset</strong></h4>
                </th>
                <th style="width:10%"></th>
              </tr>
            </table>
            <br>
            <table style="width: 100%;" style="table">
              <thead>
                <td style="width: 25%"></td>
                <td style="width: 25%"></td>
                <td style="width: 20%"></td>
                <td style="width: 30%"></td>
              </thead>
              <tbody>
                <tr>
                  <td colspan="4">Date: <span id="DateToday" class="font-weight-bold"></span></td>
                </tr>
                <tr>
                  <td colspan="4">Name of Hospital: <span class="font-weight-bold">@isset($AppData){{$AppData->facilityname}}@endisset</span></td>
                </tr>
                <tr>
                    <td colspan="4">Address: <span class="font-weight-bold">@isset($AppData){{$AppData->streetname}}, {{$AppData->brgyname}}, {{$AppData->cmname}}, {{$AppData->provname}} - {{$AppData->zipcode}} {{$AppData->rgn_desc}}@endisset</span></td>
                </tr>
                <tr>
                    <td colspan="3">To CASHIER: Please charge the amount of&nbsp;&nbsp;<span id="WTotalHere" style="font-weight: bold;text-decoration: underline;"></span></td>
                    <td>(Php&nbsp;<span id="TotalHere" style="font-weight: bold;text-decoration: underline;"></span>)&nbsp;for:&nbsp;<span style="font-weight: bold">{{-- {{$AppData->contactperson}} --}}</span></td>
                </tr>
                </tbody>
            </table>

                </div>
                <div class="card-body">
                  {{-- <table style="width: 100%;">
                    <tbody>
                       <tr>
                        <td style="width: 85%;">&nbsp;</td>
                        <td  class="text-right" style="width:15%;"><small  style="font-size: 10px;"><p>CON A.O 2006-2004 dtd 1/15/2007 AO 2012-0012 dtd 7/18/2012 <i>Section 6 Board Regulation No.5 s.2013 (DATRC_NA)</i></p></small></td>
                      </tr>
                      <tr>
                        <td style="width: 85%;"><p>(Please check the apprpriate box)</p></td>
                        <td  class="text-right" style="width:15%;"></td>
                      </tr>
                    </tbody>
                    </table> --}}
                    <br>
                    <div class="container"> 
                    <table class="table table-hover" style="width: 100%;">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Code</th>
                          <th>Description</th>
                          <th style="text-align: center">Amount</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody> 
                        {{-- Bills --}}
                       @if (isset($Bills))
                         @foreach ($Bills as $bill)
                           <tr>
                                <td><center><input type="checkbox" name="selected[]" price="{{$bill->amt}}" class="form-check Charge" value="{{$bill->chgapp_id}}" {{-- onchange="Checked({{$bill->amt}})" --}} style=" width: 2rem;height: 1rem;"></center></td>
                                <td style="font-weight: bold">{{$bill->chg_code}}</td>
                                <td>{{$bill->chg_desc}}</td>
                                <td style="text-align: center">{{number_format($bill->amt,2,'.',', ')}}</td> 
                                <td>@if($bill->remarks != null) {{$bill->remarks}} @else &nbsp; @endif</td>
                           </tr>
                         @endforeach
                       @endif
                       @if (isset($Bills))
                         <tr>
                            <td></td>
                           <td style="font-weight: bolder;">TOTAL</td>
                           <td style="text-align: center;font-weight: bold" id="GRANDTOTALHERE">0</td>
                         </tr>
                       @endif
                      </tbody>
                    </table>
                    </div>
                    <br>
                    <hr>
              <table  style="width: 100%;font-size:13px;" border="0">
                <thead>
                    <tr>
                      <th width="10%"></th>
                      <th width="40%"></th>
                      <th width="20%"></th>
                      <th width="30%"></th>
                    </tr>
                  </thead>
                <tbody>
                  <tr>
                    <td >Prepared by:</td>
                    <td class="text-center" style="font-weight: bolder;text-transform: uppercase;">@isset($EmployeeData) @if($EmployeeData->grpid == "NA") Administrator @else {{$EmployeeData->name}} @endif @endisset</td>
                    <td>Recieved the above payment/s:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-center">Licensing Officer/Designate Staff</td>
                    <td>Name/Signature:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Amount:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Cash/PMO/Check. No. Issued</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>OR No. Issued:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Date Issued:</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <br>
              <hr>
          <div class="container"><center><button style="background-color: #82d202" class="btn btn-primarys" onclick="SubmitOOP();">Submit</button>&nbsp;
            <button class="btn btn-primarys" onclick="window.history.back();">Back</button></center></div>
        </div>
      </div>
  </div>
  <input type="" id="token" value="{{ Session::token() }}" hidden>  
</div>
<script type="text/javascript">
  var total = 0;
  $(document).ready(function(){
    loadDateToday();
  });
  function loadDateToday(){
    var n = moment().format('LL');
    $('#DateToday').append(n);
  }
   function getTheWords(){
    // WTotalHEre  TotalHERE
    var Words =  numberToWords.toWords(total), TotalPhp = '';
    if (total != 0) {
     var Words =  numberToWords.toWords(total);
     Words = Words.toUpperCase();
     Words = Words  + ' PESOS';
     TotalPhp = numberWithCommas(total) + '.00';
    } else {
        Words = "";
        TotalPhp ="";
    }
    $('#WTotalHere').empty();
    $('#TotalHere').empty();
    $('#WTotalHere').append(Words);
    $('#TotalHere').append(TotalPhp);
   }
   function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
  $('input.Charge').on('change',function(){
    if ($(this).is(':checked')) {
        total = total + parseInt($(this).attr('price'));

    } else {
        total = total - parseInt($(this).attr('price'));
    }
    var test = numberWithCommas(total);
    $('#GRANDTOTALHERE').empty();
    if (test != 0) {$('#GRANDTOTALHERE').append(test + '.00');}
    else {$('#GRANDTOTALHERE').append(test);}
    getTheWords();
  });
  function SubmitOOP(){
    // $('input.Charge:checkbox:checked').map(function() {return $(this).val();}).get()
    var Test = $('input.Charge:checkbox:checked').map(function() {return $(this).val();}).get()
    if (Test.length == 0) {
      alert('Error: Cannot Proceed'); 
    } else {
      $.ajax({
        url : '{{ asset('/employee/dashboard/lps/evaluate/') }}/@isset($appid){{$appid}}@endisset/@isset($oop_id){{$oop_id}}@endisset/add',
        method : 'POST',
        data : {_token:$('#token').val(), data : Test,grandtotal : total,
                  totalword : $('#WTotalHere').text()},
        success : function(data){
            if (data == 'DONE') {
                  alert('Successfully added Order of Payment.');
                  location.href = '{{ asset('/employee/dashboard/lps/evaluate/') }}/@isset($appid){{$appid}}@endisset';
              }
        }
      });
    }
  }
</script>
@endsection