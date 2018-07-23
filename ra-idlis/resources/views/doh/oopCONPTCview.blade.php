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
                  <h4><strong>CERTIFICATE OF NEED/PERMIT TO CONSTRUCT</strong></h4>
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
                  <td colspan="4">Name of Hospital: <span class="font-weight-bold">{{$AppData->facilityname}}</span></td>
                </tr>
                <tr>
                    <td colspan="4">Address: <span class="font-weight-bold">{{$AppData->streetname}}, {{$AppData->brgyname}}, {{$AppData->cmname}}, {{$AppData->provname}} - {{$AppData->zipcode}} {{$AppData->rgn_desc}}</span></td>
                </tr>
                <tr>
                    <td colspan="3">To CASHIER: Please charge the amount of&nbsp;&nbsp;<span id="WTotalHere" style="font-weight: bold;text-decoration: underline;">{{$OOPDATA->oop_totalword}}</span></td>
                    <td>(Php&nbsp;<span id="TotalHere" style="font-weight: bold;text-decoration: underline;"></span>)&nbsp;for:&nbsp;<span style="font-weight: bold">{{-- {{$AppData->contactperson}} --}}</span></td>
                </tr>
                </tbody>
            </table>

                </div>
                <div class="card-body">
                  <table style="width: 100%;">
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
                    </table>
                    <br>
                    <table style="width: 100%;" border="1" style="font-size: 13px;">
                      <tbody>
                        <tr>
                          <th style="width: 2%;"></th>
                          <th style="width: 58%;"></th>
                          <th style="width: 2%;"></th>
                          <th style="width: 10%;"></th>
                          <th class="text-center" style="width: 28%;">REMARKS</th>
                        </tr>
                        <tr>
                          <td colspan="2">Certificate of Need</td>
                          <td><center><input type="checkbox" price="2000" class="form-check CON" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data1 == 1) checked @endif disabled></center></td>
                          <td>2, 000.00</td>
                          <td>{{$OOPDATA->data1r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">PERMIT TO CONSTRUCT:</td>
                          
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">HOSPITAL</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="2000"  class="form-check PTC HOSPITAL HospLevel1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data2 == 1) checked @endif disabled></center></td>
                          <td><label class="form-check-label">Level 1</label></td>
                          <td><center><input type="checkbox" level="1" price="2000" class="form-check PTC HOSPITAL HospLevel1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data2 == 1) checked @endif disabled></center></td>
                          <td>2, 000.00</td>
                          <td>{{$OOPDATA->data2r}}</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2"  price="2500" class="form-check PTC HOSPITAL HospLevel2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data3 == 1) checked @endif disabled></center></td>
                          <td>Level 2</td>
                          <td><center><input type="checkbox" level="2"  price="2500" class="form-check PTC HOSPITAL HospLevel2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data3 == 1) checked @endif disabled></center></td>
                          <td>2, 500.00</td>
                          <td>{{$OOPDATA->data3r}}</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="3" price="3000" class="form-check PTC HOSPITAL HospLevel3" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data4 == 1) checked @endif disabled></center></td>
                          <td> Level 3</td>
                          <td><center><input type="checkbox" level="3" price="3000" class="form-check PTC HOSPITAL HospLevel3" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data4 == 1) checked @endif disabled></center></td>
                          <td>3, 000.00</td>
                          <td>{{$OOPDATA->data4r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5">PSYCHIATRIC CARE FACILITY</td>
                          
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="1500" class="form-check PTC PSYCAREFA PsycLevel1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data5 == 1) checked @endif disabled></center></td>
                          <td>Custodial Psychiatric Care Facility</td>
                          <td><center><input type="checkbox" level="1"  price="1500" class="form-check PTC PSYCAREFA PsycLevel1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data5 == 1) checked @endif disabled></center></td>
                          <td>1, 500.00</td>
                          <td>{{$OOPDATA->data5r}}</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2"  price="1500" class="form-check PTC PSYCAREFA PsycLevel2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data6 == 1) checked @endif disabled></center></td>
                          <td>Acute Chronic Psychiatric Care Facility</td>
                          <td><center><input type="checkbox" level="2" price="1500" class="form-check PTC PSYCAREFA PsycLevel2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data6 == 1) checked @endif disabled></center></td>
                          <td>1, 500.00</td>
                          <td>{{$OOPDATA->data6r}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">DIALYSIS CLINIC</td>
                          <td><center><input type="checkbox" price= "1400" class="form-check PTC DIALYSIS" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data7 == 1) checked @endif disabled></center></td>
                          <td>1, 400.00</td>
                          <td>{{$OOPDATA->data7r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">AMBULATORY SURGICAL CLINIC</td>
                          <td><center><input type="checkbox" price="1400" class="form-check PTC AMBUSURCLI" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data8 == 1) checked @endif disabled><center></td>
                          <td>1, 400.00</td>
                          <td>{{$OOPDATA->data8r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">MEDICAL FACILITY FOR OVERSEAS WORKERS AND SEAFARERS</td>
                          <td><center><input type="checkbox" price="1500" class="form-check PTC MEFAOVER" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data9 == 1) checked @endif disabled></center></td>
                          <td>1, 500.00</td>
                          <td>{{$OOPDATA->data9r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">DRUG ABUSE TREATMENT AND REHABILITATION CENTER</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="1000" class="form-check PTC DRUGABTREREHAB DATRC1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data10 == 1) checked @endif disabled></center></td>
                          <td>Residential</td>
                          <td><center><input type="checkbox" level="1" price="1000" class="form-check PTC DRUGABTREREHAB DATRC1" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data10 == 1) checked @endif disabled></center></td>
                          <td>1, 000.00</td>
                          <td>{{$OOPDATA->data10r}}</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2" price="1000"  class="form-check PTC DRUGABTREREHAB DATRC2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data11 == 1) checked @endif disabled></center></td>
                          <td>Non-Residential</td>
                          <td><center><input type="checkbox" level="2" price="1000"  class="form-check PTC DRUGABTREREHAB DATRC2" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data11 == 1) checked @endif disabled></center></td>
                          <td>1, 000.00</td>
                          <td>{{$OOPDATA->data11r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">DRUG TESTING LABORATORY (FS)</td>
                          <td><center><input type="checkbox" price="1000" class="form-check PTC DRTESLAB" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data12 == 1) checked @endif disabled></center></td>
                          <td>1, 000.00</td>
                          <td>{{$OOPDATA->data12r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">PRIMARY CARE FACILITY-INFIRMARY</td>
                          <td><center><input type="checkbox" price="1500" class="form-check PTC PRICAREFAI" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data13 == 1) checked @endif disabled></center></td>
                          <td>1, 500.00</td>
                          <td>{{$OOPDATA->data13r}}</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">PRIMARY CARE FACILITY-BIRTHING HOME</td>
                          <td><input type="checkbox"  price= "1400" class="form-check PTC PRICAREFABH" name="" style=" width: 2rem;height: 1rem;" @if($OOPDATA->data14 == 1) checked @endif disabled></td>
                          <td>1, 400.00</td>
                          <td>{{$OOPDATA->data14r}}</td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
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
                    <td class="text-center" style="font-weight: bolder;text-transform: uppercase;">@if($EmployeeData->grpid == "NA") Administrator @else {{$EmployeeData->name}} @endif</td>
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
          <div class="container"><center>
            {{-- <button style="background-color: #82d202" class="btn btn-primarys" onclick="SubmitOOP();">Submit</button>&nbsp; --}}
            <button class="btn btn-primarys" onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate') }}/{{$appid}}'">Back</button></center></div>
        </div>
      </div>
  </div>
  <input type="" id="token" value="{{ Session::token() }}" hidden>  
</div>
<script type="text/javascript">
  $(document).ready(function(){
    loadDateToday();
  });
  function loadDateToday(){
    var n = moment('{{$OOPDATA->oop_date}}').format('LL');
    $('#DateToday').append(n);
    var TotalPhp = numberWithCommas({{$OOPDATA->oop_total}}) + '.00';
    $('#TotalHere').empty();
    $('#TotalHere').append(TotalPhp);
  }
  function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>
@endsection