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
                  <h4><strong></strong></h4>
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
                    <td colspan="3">To CASHIER: Please charge the amount of&nbsp;&nbsp;<span id="WTotalHere" style="font-weight: bold;text-decoration: underline;"></span></td>
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
                          <td><center><input type="checkbox" price="2000" class="form-check CON" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>2, 000.00</td>
                          <td><input type="text" style="" class="form-control" name="" id="conrem"></td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">PERMIT TO CONSTRUCT:</td>
                          
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">HOSPITAL</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="2000"  class="form-check PTC HOSPITAL HospLevel1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td><label class="form-check-label">Level 1</label></td>
                          <td><center><input type="checkbox" level="1" price="2000" class="form-check PTC HOSPITAL HospLevel1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>2, 000.00</td>
                          <td><input type="text" class="form-control" name="" id="hospi1rem"></td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2"  price="2500" class="form-check PTC HOSPITAL HospLevel2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>Level 2</td>
                          <td><center><input type="checkbox" level="2"  price="2500" class="form-check PTC HOSPITAL HospLevel2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>2, 500.00</td>
                          <td><input type="text" style="" class="form-control" id="hospi2rem" name=""></td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="3" price="3000" class="form-check PTC HOSPITAL HospLevel3" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td> Level 3</td>
                          <td><center><input type="checkbox" level="3" price="3000" class="form-check PTC HOSPITAL HospLevel3" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>3, 000.00</td>
                          <td><input type="text" style="" class="form-control" id="hospi3rem" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5">PSYCHIATRIC CARE FACILITY</td>
                          
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="1500" class="form-check PTC PSYCAREFA PsycLevel1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>Custodial Psychiatric Care Facility</td>
                          <td><center><input type="checkbox" level="1"  price="1500" class="form-check PTC PSYCAREFA PsycLevel1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 500.00</td>
                          <td><input type="text" style="" id="psyci1rem" class="form-control" name=""></td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2"  price="1500" class="form-check PTC PSYCAREFA PsycLevel2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>Acute Chronic Psychiatric Care Facility</td>
                          <td><center><input type="checkbox" level="2" price="1500" class="form-check PTC PSYCAREFA PsycLevel2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 500.00</td>
                          <td><input type="text" style="" id="psyci2rem" class="form-control" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="2">DIALYSIS CLINIC</td>
                          <td><center><input type="checkbox" price= "1400" class="form-check PTC DIALYSIS" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 400.00</td>
                          <td><input type="text" style="" id="dialyr" class="form-control" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">AMBULATORY SURGICAL CLINIC</td>
                          <td><center><input type="checkbox" price="1400" class="form-check PTC AMBUSURCLI" name="" style=" width: 2rem;height: 1rem;"><center></td>
                          <td>1, 400.00</td>
                          <td><input type="text" style=""  class="form-control" id="ambusurR" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">MEDICAL FACILITY FOR OVERSEAS WORKERS AND SEAFARERS</td>
                          <td><center><input type="checkbox" price="1500" class="form-check PTC MEFAOVER" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 500.00</td>
                          <td><input type="text" style="" class="form-control" name="" id="medfar"></td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">DRUG ABUSE TREATMENT AND REHABILITATION CENTER</td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="1" price="1000" class="form-check PTC DRUGABTREREHAB DATRC1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>Residential</td>
                          <td><center><input type="checkbox" level="1" price="1000" class="form-check PTC DRUGABTREREHAB DATRC1" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 000.00</td>
                          <td><input type="text" style="" class="form-control" id="druab1r" name=""></td>
                        </tr>
                        <tr>
                          <td><center><input type="checkbox" level="2" price="1000"  class="form-check PTC DRUGABTREREHAB DATRC2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>Non-Residential</td>
                          <td><center><input type="checkbox" level="2" price="1000"  class="form-check PTC DRUGABTREREHAB DATRC2" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 000.00</td>
                          <td><input type="text" style="" class="form-control" id="druab2r" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">DRUG TESTING LABORATORY (FS)</td>
                          <td><center><input type="checkbox" price="1000" class="form-check PTC DRTESLAB" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 000.00</td>
                          <td><input type="text" style="" class="form-control" id="drugtestr" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">PRIMARY CARE FACILITY-INFIRMARY</td>
                          <td><center><input type="checkbox" price="1500" class="form-check PTC PRICAREFAI" name="" style=" width: 2rem;height: 1rem;"></center></td>
                          <td>1, 500.00</td>
                          <td><input type="text" style="" class="form-control" id="pricarefacir" name=""></td>
                        </tr>
                        <tr>
                          <td colspan="5" style="font-size: 13px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">PRIMARY CARE FACILITY-BIRTHING HOME</td>
                          <td><input type="checkbox"  price= "1400" class="form-check PTC PRICAREFABH" name="" style=" width: 2rem;height: 1rem;"></td>
                          <td>1, 400.00</td>
                          <td><input type="text" style="" class="form-control" id="pricarefacbhr" name=""></td>
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
          <div class="container"><center><button style="background-color: #82d202" class="btn btn-primarys" onclick="SubmitOOP();">Submit</button>&nbsp;
            <button class="btn btn-primarys" onclick="location.href='{{ asset('/employee/dashboard/lps/evaluate') }}/{{$appid}}'">Back</button></center></div>
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
  $('input.CON').on('change', function() {
        $('input.PTC').prop('checked', false); 
        var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
    });
  $('input.PTC').on('change', function() {
        $('input.CON').prop('checked', false);  
    });
  $('input.PTC.HOSPITAL').on('change', function(){
    var level = $(this).attr('level');
    var CName = "HospLevel" + level;
    var price = $(this).attr('price');
    
    if ($(this).is(':checked')) {
      $('input.PTC').not(this).prop('checked', false); // Uncheck all
      $('input.HOSPITAL.'+CName).prop('checked', true);
      total = price;
    } else {
       $('input.'+CName).prop('checked', false);
       total = total -  price;
    }
    getTheWords();
  });

  $('input.PTC.PSYCAREFA').on('change',function(){
      var level = $(this).attr('level');
      var CName = 'PsycLevel'+level;
      var price = $(this).attr('price');

      if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false); // Uncheck all
        $('input.PSYCAREFA.'+CName).prop('checked', true);
        total = price;
      } else {
        $('input.PSYCAREFA.'+CName).prop('checked', false);
        total = total -  price;
      }
      getTheWords();
  });
  $('input.PTC.DIALYSIS').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
  $('input.PTC.AMBUSURCLI').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
  $('input.PTC.MEFAOVER').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
  // DRUGABTREREHAB DATRC2
  $('input.PTC.DRUGABTREREHAB').on('change',function(){
      var level = $(this).attr('level');
      var CName = 'DATRC'+level;
      var price = $(this).attr('price');

      if ($(this).is(':checked')) {
      $('input.PTC').not(this).prop('checked', false); // Uncheck all
        $('input.DRUGABTREREHAB.'+CName).prop('checked', true);
        total = price;
      } else {
        $('input.DRUGABTREREHAB.'+CName).prop('checked', false);
        total = total -  price;
      }
      getTheWords();
  });
   $('input.PTC.DRTESLAB').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
   $('input.PTC.PRICAREFAI').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
   $('input.PTC.PRICAREFABH').on('change', function(){
    var price = $(this).attr('price');
       if ($(this).is(':checked')) {
        $('input.PTC').not(this).prop('checked', false);
        total = price;
       } else {
        total = total -  price;
       }
       getTheWords();
  });
   function getTheWords(){
    // WTotalHEre  TotalHERE
    var Words =  numberToWords.toWords(total), TotalPhp = "";
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
  function SubmitOOP(){
    var con = $('input.CON').is(':checked') ? 1 : 0; //1
    var conr = $('#conrem').val();
    var hosp1 = $('input.HospLevel1').is(':checked') ? 1 : 0; // 2
    var hosp1r = $('#hospi1rem').val();
    var hosp2 = $('input.HospLevel2').is(':checked') ? 1 : 0; // 3
    var hosp2r = $('#hospi2rem').val();
    var hosp3 = $('input.HospLevel3').is(':checked') ? 1 : 0; // 4
    var hosp3r = $('#hospi3rem').val();
    var psycare1 = $('input.PsycLevel1').is(':checked') ? 1 : 0; // 5
    var psycare1r = $('#psyci1rem').val();
    var psycare2 = $('input.PsycLevel2').is(':checked') ? 1 : 0; // 6
    var psycare2r = $('#psyci2rem').val();
    var dialy = $('input.DIALYSIS').is(':checked') ? 1 : 0;
    var dialyr = $('#dialyr').val();
    var ambusur = $('input.AMBUSURCLI').is(':checked') ? 1 : 0; // 7
    var ambusurR = $('#ambusurR').val();
    var medfa = $('input.MEFAOVER').is(':checked') ? 1 : 0; // 8
    var medfar = $('#medfar').val();
    var druab1 = $('input.DATRC1').is(':checked') ? 1 : 0; // 9 
    var druab1r = $('#druab1r').val();
    var druab2 = $('input.DATRC2').is(':checked') ? 1 : 0; // 10
    var druab2r = $('#druab2r').val();
    var drugtest = $('input.DRTESLAB').is(':checked') ? 1 : 0; // 11
    var drugtestr = $('#drugtestr').val();
    var pricarefaci = $('input.PRICAREFAI').is(':checked') ? 1 : 0; // 12
    var pricarefacir = $('#pricarefacir').val();
    var pricarefacbh = $('input.PRICAREFABH').is(':checked') ? 1 : 0; // 13
    var pricarefacbhr = $('#pricarefacbhr').val();
    var TotalInWords = $('#WTotalHere').text();
    if (total == 0) {
      alert('Error: Cannot Proceed.');
    } else {
      $.ajax({
        url : '{{ asset('/employee/dashboard/lps/evaluate/') }}/{{$appid}}/{{$oop_id}}/add',
        method : 'POST',
        data : {_token:$('#token').val(),
                  data1 : con,
                  data1r : conr,
                  data2 : hosp1,
                  data2r : hosp1r,
                  data3 : hosp2,
                  data3r : hosp2r,
                  data4 : hosp3,
                  data4r : hosp3r,
                  data5 : psycare1,
                  data5r : psycare1r,
                  data6 : psycare2,
                  data6r : psycare2r,
                  data7: dialy,
                  data7r : dialyr,
                  data8 : ambusur,
                  data8r : ambusurR,
                  data9 : medfa,
                  data9r : medfar,
                  data10 : druab1,
                  data10r : druab1r,
                  data11 : druab2,
                  data11r : druab2r,
                  data12 : drugtest,
                  data12r : drugtestr,
                  data13 : pricarefaci,
                  data13r : pricarefacir,
                  data14 : pricarefacbh,
                  data14r : pricarefacbhr,
                  total : total,
                  totalword : TotalInWords,
                  },
        success : function(data){
              if (data == 'DONE') {
                  alert('Successfully added Order of Payment.');
                  location.href = '{{ asset('/employee/dashboard/lps/evaluate/') }}/{{$appid}}';
              }
        },
      });
    }
  }
</script>
@endsection