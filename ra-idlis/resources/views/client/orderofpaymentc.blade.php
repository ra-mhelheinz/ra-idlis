@extends('main')
@section('content')
@include('client.nav')
<div class="container-fluid">
  <div class="card" style="margin: 0 0 5em 0;">
          <div class="card-header bg-white font-weight-bold">
            <table style="width:100%;">
              <tr>
                <th style="width:10%"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="height: auto; width:100px;"></th>
                <th class="text-center" style="width:80%">
                  <h6>Republic of the Philippines</h6>
                  <h6>DEPARTMENT OF HEALTH</h6>
                  <h5>Order of Payment</h5>
                  <h4><strong>ONE STOP-SHOP PRIVATE HOSPITAL</strong></h4>
                </th>
                  <th style="width:10%"></th>
              </tr>
            </table>
                      <br>
            <table style="width: 100%;">
                    <thead>
                    <tr>
                        <td>Date:</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Name of Hospital:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>To CASHIER: Please charge the amount of</td>
                        <td>(Php_______)for</td>
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
                    <div class="row">
                      <div class="col-lg-5">
              <table border="1" class="text-center" style="width: 100%;">
                <tbody>
                  <tr>
                    <th style="width:16%;font-size:16px;"></th>
                      <th style="width:2%;"></th>
                      <th style="width:10%;">Initial</th>
                      <th style="width:2%;"></th>
                      <th style="width:10%;">Renewal</th>            
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Registration Fee (New)</td>
                    <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">200.00</td>
                      <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Level 1 Hospital</td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">6,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">6,000.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,400.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Level 2 Hospital</td>
                    <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">8,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">7,500.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">6,750.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Level 3 Hospital</td>
                    <td style="font-size:13px;"><</td>
                      <td style="font-size:13px;">10,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">7,500.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">7,650.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">&nbsp;</td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <th style="font-size:13px;">* Clinical Laboratory (General)</th>
                    <th style="font-size:13px;"></th>
                      <th style="font-size:13px;">Initial</th>
                      <th style="font-size:13px;"></td>
                      <th style="font-size:13px;">Renewal</th>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Primary</td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">2,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,500.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,350.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Secondary</td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">2,500.00</td>
                      <td style="font-size:13px;">></td>
                      <td style="font-size:13px;">2,000.00</td>
                  </tr>
                    <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,800.00</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Tertiary</td>
                    <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">3,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">2,500.00</td>
                  </tr>
                    <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">2,250.00</td>
                  </tr>
                    <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Limited Service Capability</td>
                    <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">2,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,500.00</td>
                  </tr>
                    <tr>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,350.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="font-size:13px;">* Clinical Laboratory includes HIV testing and water-testing services as well as blood service facilities.</td>
                    <td style="font-size:13px;">&nbsp;</td>
                    <td style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">* Clinical Laboratory (Special)</td>
                    <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                    <td style="font-size:13px;">200.00</td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-left" style="font-size:13px;">Special type of lab service/s:</td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">&nbsp;</td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">&nbsp;</td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;">Pharmacy</td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;">1,000.00</td>
                    <td style="font-size:13px;"></td>
                    <td style="font-size:13px;">1,000.00</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-left" style="font-size:13px;">Additional pharmacy @ Php 1,000.00</td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td style="font-size:13px;text-align: right;">Sub- Total&nbsp;</td>
                      <td style="font-size:13px;text-align: right;"><small>Php</small>&nbsp; </td>
                      <td style="font-size:13px;padding: 2pxfont-weight: bold" colspan="3" id="SubTotal">13,900</td>
                  </tr>
              </tbody>
            </table>
            </div>
            <div class="col-lg-7 ">
              <div class="table-responsive">
              <table border="1" class="text-center">
                <tbody>
                  <tr>
                      <th style="width:25%;"></th>
                      <th style="width:2%;"></th>
                      <th style="width:10%;">Initial</th>
                      <th style="width:2%;"></th>
                      <th style="width:10%;">Renewal</th>
                      <th style="width:10%;">Remarks</th>              
                  </tr>
                  <tr>
                    <td style="font-size:10px;">AMBULATORY SURGICAL CLINIC</td>
                    <td style="font-size:13px;">  </td>
                      <td style="font-size:13px;">4,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">4,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">3,600.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;">BLOOD BANK</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;">BCU</td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">1,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                
                      <td style="font-size:13px;">BS</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">1,400.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                
                      <td style="font-size:13px;">BCU/BS</td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">1,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                
                      <td style="font-size:13px;">DIALYSIS CLINIC</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">3,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">3,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                  
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">2,700.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                
                      <td style="font-size:13px;">DRUG Testing Laboratory (screening)</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
              
                      <td style="font-size:13px;">DRUG TESTING LABORATORY (confirmatory)</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">10,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">10,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
              
                      <td style="font-size:13px;">CASH BOND</td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">20,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                  
                      <td style="font-size:11px;">HUMAN STEMCELL & CELL-BASED OR CELLULAR THERAPY</td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">38,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">38,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
              
                      <td style="font-size:10px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">34,200.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
        
                      <td style="font-size:13px;">KIDNEY TRANSPLANT FACILITY</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">38,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">38,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">34,200.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
        
                      <td style="font-size:13px;">LABORATORY FOR DRINKING WATER ANALYSIS </td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                    <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
        
                      <td style="font-size:13px;">MEDICAL FACILITY FOR OVERSEAS WORKERS AND SEAFARERS</td>
                      
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">13,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">13,500.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">12,150.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align:right">CASH BOUND</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">100,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align:right">NEWBORN SCREENING CENTER</td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">8,500.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">8,500.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align:right"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">w/ 10% disc.</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">7,650.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">Ambulance Service Provider</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;">5,000.00</td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">Ambulance 1,000 per unit</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">Other Fees, specifiy </td>
                      <td style="font-size:13px;" colspan="5"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">CERTIFICATION <small>as Registered Hospital</small></td>
                      <td style="font-size:13px;"><span class="fa fa-check"></span></td>
                      <td style="font-size:13px;">50.00</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">Re-inspection Fee = 100%  of the initial license fee</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: left;">Surcharge Fee = 100% of the renewal license fee if LTO expired and not renewed less than 1 yr. after expiration date</td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                      <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
                      <td style="font-size:13px;text-align: right;" rowspan="2">GRAND TOTAL&nbsp;</td>
                      <td style="font-size:13px;text-align: right;" rowspan="2" colspan="2"><small>Php</small>&nbsp;</td>
                      <td style="font-size:13px;font-weight: bold" rowspan="2" colspan="3" id="GrandTotal">76,950</td>
                  </tr>
                  <tr>
                  </tr>  
              </tbody>
              </table>
            </div>
            <br>
            <div class="col-lg-12">
              <table  style="width: 100%;">
                <tbody>
                  <tr>
                    <td style="width: 50%;font-size:13px;" >Prepared by: <label>Juan de la Cruz</label></td>
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
              <a href="{{asset('client/payment')}}"><button class="btn-primarys"><i class="fa fa-credit-card"></i> Payment</button></a>
             </div>
            </div>
          </div>  
	        </div>
	      </div>
      </div>
      <script type="text/javascript">
   /// Overall Total
    var subtotal = 0;
    var subtotal2 = 0;
    var grandtotal = 0;
    ///
    var TempArr2  = [0,0,0,0,0,0,0,0,0];
    var CountArr2 = [0,0,0,0,0,0,0,0,0];
    /// Hospital
    var HospitalTemp = 0;
    var HostpitalCount = 0;
    /// Clinic Laboratory (General)
    var CliLabGenTemp = 0;
    var CliLabGenCount = 0;
    ///
    var LimSerCapTemp = 0;
    var LimSerCapCount = 0;
    ///
    var PharTemp = 0;
    var PharCount = 0;
    ///
    var AmbuSurgCliTemp = 0;
    var AmbuSurgCliCount = 0;
    //////////////////////////////////////////    
    function Subtotal(price,id){
      if ($('#'+id).is(':checked')) {
        var tobeAdd = price;
        subtotal = subtotal + tobeAdd; 
      } else {
        var tobeSubtract = price;
        subtotal = subtotal - tobeSubtract; 
      }
      showSubtotal();
    }
    function Subtotal2(price,id){
      if ($('#'+id).is(':checked')) {
        var tobeAdd = price;
        subtotal2 = subtotal2 + tobeAdd; 
      } else {
        var tobeSubtract = price;
        subtotal2 = subtotal2 - tobeSubtract; 
      }
      showGrandtotal();
    }
    function showSubtotal(){
        var formatedSubTotal = subtotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        $('#SubTotal').empty();
        $('#SubTotal').append(formatedSubTotal);
        showGrandtotal();
    }
    function showGrandtotal(){
      grandtotal = subtotal + subtotal2;
      var formatedGrandTotal = grandtotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        $('#GrandTotal').empty();
        $('#GrandTotal').append(formatedGrandTotal);
    }
    /////// Test
    function CheckSub2(className,price){
      if ($('.'+className).is(':checked')) {
        alert();
          // if (HostpitalCount == 0) {
          //     HostpitalCount = 1;
          //     HospitalTemp = parseInt(price);
          // } else {
          //   subtotal = subtotal - HospitalTemp;
          //   HospitalTemp = parseInt(price);
          // }
          // subtotal = subtotal + parseInt(price);
        } else {
          // HospitalTemp = 0, HostpitalCount = 0;
          // var price = $(this).attr('price');
          // subtotal = subtotal - parseInt(price);
        }
        $('input.'+className).not('input.'+className).prop('checked', false);  
        // showSubtotal();
    }
    $('input.AmSePro').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[8] == 0) {
              CountArr2[8] = 1;
              TempArr2[8] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[8];
            TempArr2[8] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[8] = 0, CountArr2[8] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.AmSePro').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.NeBoScCe').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[7] == 0) {
              CountArr2[7] = 1;
              TempArr2[7] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[7];
            TempArr2[7] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[7] = 0, CountArr2[7] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.NeBoScCe').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.MedFaci4WoSea').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[6] == 0) {
              CountArr2[6] = 1;
              TempArr2[6] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[6];
            TempArr2[6] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[6] = 0, CountArr2[6] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.MedFaci4WoSea').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.KidTranFaci').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[5] == 0) {
              CountArr2[5] = 1;
              TempArr2[5] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[5];
            TempArr2[5] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[5] = 0, CountArr2[5] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.KidTranFaci').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.HuStemCell').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[4] == 0) {
              CountArr2[4] = 1;
              TempArr2[4] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[4];
            TempArr2[4] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[4] = 0, CountArr2[4] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.HuStemCell').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.DrTeLabCon').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[3] == 0) {
              CountArr2[3] = 1;
              TempArr2[3] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[3];
            TempArr2[3] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[3] = 0, CountArr2[3] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.DrTeLabCon').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.DrTeLabScr').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[2] == 0) {
              CountArr2[2] = 1;
              TempArr2[2] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[2];
            TempArr2[2] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[2] = 0, CountArr2[2] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.DrTeLabScr').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.DialClin').on('change',function(){
        if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[1] == 0) {
              CountArr2[1] = 1;
              TempArr2[1] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[1];
            TempArr2[1] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[1] = 0, CountArr2[1] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.DialClin').not(this).prop('checked', false);  
        showGrandtotal();
    });
    $('input.AmbuSurgCli').on('change',function(){
        if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CountArr2[0] == 0) {
              CountArr2[0] = 1;
              TempArr2[0] = parseInt(price);
          } else {
            subtotal2 = subtotal2 - TempArr2[0];
            TempArr2[0] = parseInt(price);
          }
          subtotal2 = subtotal2 + parseInt(price);
        } else {
          TempArr2[0] = 0, CountArr2[0] = 0;
          var price = $(this).attr('price');
          subtotal2 = subtotal2 - parseInt(price);
        }
        $('input.AmbuSurgCli').not(this).prop('checked', false);  
        showGrandtotal();
    });
    /////// Hospital 
    $('input.HospLevel').on('change', function() {
      var level = $(this).attr('level');
      var CName = "HospLevel" + level;
      if (level == "1") {
        $('.HospLevel2').prop('checked', false); 
        $('.HospLevel3').prop('checked', false);  
      } else if (level == "2") {
        $('.HospLevel1').prop('checked', false); 
        $('.HospLevel3').prop('checked', false);  
      } else if (level == "3") {
        $('.HospLevel2').prop('checked', false); 
        $('.HospLevel1').prop('checked', false);  
      }
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (HostpitalCount == 0) {
              HostpitalCount = 1;
              HospitalTemp = parseInt(price);
          } else {
            subtotal = subtotal - HospitalTemp;
            HospitalTemp = parseInt(price);
          }
          subtotal = subtotal + parseInt(price);
        } else {
          HospitalTemp = 0, HostpitalCount = 0;
          var price = $(this).attr('price');
          subtotal = subtotal - parseInt(price);
        }
        $('input.HospLevel').not(this).prop('checked', false);  
        showSubtotal();
    });
    //// class="ClinLabGen ClinLabGen1" level="1" price="2000"
    $('input.ClinLabGen').on('change',function(){
      var level = $(this).attr('level');
        var CName = "ClinLabGen" + level;
        if (level == "1") {
        $('.ClinLabGen2').prop('checked', false); 
        $('.ClinLabGen3').prop('checked', false);  
      } else if (level == "2") {
        $('.ClinLabGen1').prop('checked', false); 
        $('.ClinLabGen3').prop('checked', false);  
      } else if (level == "3") {
        $('.ClinLabGen2').prop('checked', false); 
        $('.ClinLabGen2').prop('checked', false);  
      }
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (CliLabGenCount == 0) {
              CliLabGenCount = 1;
              CliLabGenTemp = parseInt(price);
          } else {
            subtotal = subtotal - CliLabGenTemp;
            CliLabGenTemp = parseInt(price);
          }
          subtotal = subtotal + parseInt(price);
        } else {
          CliLabGenTemp = 0, CliLabGenCount = 0;
          var price = $(this).attr('price');
          subtotal = subtotal - parseInt(price);
        }
        $('input.ClinLabGen').not(this).prop('checked', false);  
        showSubtotal();
    });
    //// class="LimSerCap" price="1000"
    $('input.LimSerCap').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (LimSerCapCount == 0) {
              LimSerCapCount = 1;
              LimSerCapTemp = parseInt(price);
          } else {
            subtotal = subtotal - LimSerCapTemp;
            LimSerCapTemp = parseInt(price);
          }
          subtotal = subtotal + parseInt(price);
        } else {
          LimSerCapTemp = 0, LimSerCapCount = 0;
          var price = $(this).attr('price');
          subtotal = subtotal - parseInt(price);
        }
        $('input.LimSerCap').not(this).prop('checked', false);  
        showSubtotal();
    });
    //// class="Phar" price="1000"
    $('input.Phar').on('change',function(){
      if ($(this).is(':checked')) {
          var price = $(this).attr('price');
          if (PharCount == 0) {
              PharCount = 1;
              PharTemp = parseInt(price);
          } else {
            subtotal = subtotal - PharTemp;
            PharTemp = parseInt(price);
          }
          subtotal = subtotal + parseInt(price);
        } else {
          PharTemp = 0, PharCount = 0;
          var price = $(this).attr('price');
          subtotal = subtotal - parseInt(price);
        }
        $('input.Phar').not(this).prop('checked', false);  
        showSubtotal();
    });

</script>
@include('client.sitemap')
 @endsection
