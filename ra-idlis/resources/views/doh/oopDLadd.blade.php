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
								          <h4><strong>Dental Laboratory</strong></h4>
							         </th>
              <th style="width:10%"></th>
                    	</tr>
                    </table>
                    <br>
                     <table style="width: 100%;">
                <thead>
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
                        <td  class="text-right" style="width:15%;"><small  style="font-size: 10px;"><p>AO 2019-0029 AnnexE dtd 6/29/2016 Ambulance:AO 2014-0034 dtd. 11/31/2014 (Pharmacy) 7/18/2012 5/2//2008-BSF: AO 2007-0023 dtd 6/6/07</p></small></td>
                      </tr>
                      <tr>
                        <td style="width: 85%;"><p>(Please check the apprpriate box)</p></td>
                        <td  class="text-right" style="width:15%;"></td>
                      </tr>
                    </tbody>
                    </table>
                <br>
                <table style="width: 100%;" border="1">
                  <tbody>
                    <tr>
                      <th style="width: 1%;"></th>
                      <th style="width: 49%;"></th>
                      <th style="width: 2%;"></th>
                      <th class="text-center" style="width: 10%;">Initial</th>
                      <th style="width: 2%;"></th>
                      <th class="text-center" style="width: 10%;">Renewal</th>
                      <th class="text-center" style="width: 28%;">Remarks</th>
                    </tr>
                    <tr>
                      <td style="font-size:13px;" colspan="2">REGISTRATION FEE</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;" class="Regis Regis1"></td>
                      <td style="font-size:13px;">200.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;" class="Regis Regis2"></td>
                      <td></td>
                      <td></td>
                    </tr>
                     <tr>
                      <td rowspan="2" colspan="2"><strong>REMOVABLE PROSTHESES SERVICES</strong></td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;" class="RemovProfSer"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;" class="RemovProfSer"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                     <tr>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;" class="RemovProfSer"></td>
                      <td  style="font-size:13px;">900.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">
                        Complete Dentures
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">Overdentures</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">Orthodontic appliances</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">Temporo-mandibular joint appliances</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">Removable partial dentures without metal framework</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="font-size:13px;" colspan="6">- Conventional acrylic dentures</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="font-size:13px;" colspan="6">- Thermoplastic/ flexible dentures</td>
                    </tr>

                     <tr>
                      <td style="font-size:13px;" colspan="2"></td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,000.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,000.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td colspan="6">Removable partial dentures with metal framework (without casting)</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td colspan="6">Special removable appliances </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="6">- Maxilo-facial prostheses</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="6">- Implant retained removable appliances</td>
                    </tr>

                     {{-- <tr>
                      <td style="font-size:13px;" colspan="2">Special removable appliances <br> &nbsp;&nbsp;&nbsp;Maxilo facial prostheses <br> &nbsp;&nbsp;&nbsp;Implant retained removable appliances</td>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,800.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr> --}}
                      <tr>
                      <td rowspan="2" colspan="2"><strong>FIXED PROSTHESES SERVICES</strong></td>
                        <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">900.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                     <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" >Crown and Bridge without metal alloy substructure - metal free crowns and bridges with ceramics, composites or resins </td>
                      <td colspan="5"></td>
                    </tr>
                    <tr>
                      <td colspan="2"></td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,000.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,000.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td colspan="2"></td>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,800.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>

                    <tr>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td style="font-size:13px;" colspan="6">Crown and Bridge without metal alloy substructure fabrication - ceramics or resins fused to metal, or purely metal alloy (without casting) </td>
                    </tr>
                    <tr>
  
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,800.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td style="font-size:13px;" colspan="2">Special Fixed Prostheses <br> &nbsp;&nbsp;&nbsp;Dental attahcments<br> &nbsp;&nbsp;&nbsp;Implant retained fixed prostheses</td>
                      <td></td>
                      <td  style="font-size:13px;"></td>
                      <td></td>
                      <td  style="font-size:13px;"></td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                       <tr>
                      <td rowspan="2" colspan="2"><strong>REMOVABLE AND FIXED PROSTHESES SERVICES</strong></td>
                        <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,500.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,500.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">2,250.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                     <tr>
                      <td rowspan="2" colspan="2"><strong>LIMITED SERVICES</strong></td>
                        <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">1,000.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td  style="font-size:13px;">w/ 10% disc.</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td  style="font-size:13px;">900.00</td>
                      <td  style="font-size:13px;"></td>
                    </tr>
                     <tr>
                      <td style="font-size:13px;" colspan="2">Surcharage Fee = 50% of the renewal LTO if filled less than a year after expiration date</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td colspan="4" style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td style="font-size:13px;" colspan="2">Re-inspection Fee = 100% of the initial license fee</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td colspan="4" style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td style="font-size:13px;" colspan="2">Other Fees, specify</td>
                      <td><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                      <td colspan="4" style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td colspan="7" style="font-size:10px;">Note: 10% discount renewal fee if filled within 90 calendar days before the expiration date of LTO</td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <table  style="width: 100%;">
                <tbody>
                  <tr>
                    <td style="width: 50%;font-size:13px;">Prepared by:</td>
                    <td style="width: 50%;font-size:13px;">Recieved the above payment/s:</td>
                  </tr>
                  <tr>
                    <td  class="text-center" style="width: 50%;font-size:13px;">Licensing Officer/Designate Staff</td>
                    <td style="width: 50%;font-size:13px;">Name/Signature:</td>
                  </tr>
                  <tr>
                    <td  class="text-center" style="width: 50%;font-size:13px;"></td>
                    <td style="width: 50%;font-size:13px;">Amount:</td>
                  </tr>
                  <tr>
                    <td  class="text-center" style="width: 50%;font-size:13px;"></td>
                    <td style="width: 50%;font-size:13px;">Cash/PMO/Check. No. Issued</td>
                  </tr>
                  <tr>
                    <td  class="text-center" style="width: 50%;font-size:13px;"></td>
                    <td style="width: 50%;font-size:13px;">OR No. Issued:</td>
                  </tr>
                  <tr>
                    <td  class="text-center" style="width: 50%;font-size:13px;"></td>
                    <td style="width: 50%;font-size:13px;">Date Issued:</td>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
	</div>	
</div>
@endsection
								

