@include('template.head')
@include('template.dashnav')
<div class="row container-fluid" style="margin-top: 10px;">
	<div class="col-sm-2"></div>
	<div class="col-sm-10">
		   <div class="card" style="margin: 0 0 5em 0;">
                <div class="card-header bg-white font-weight-bold">
                    <table style="width:100%;">
                    	<tr>
                    		<th style="width:10%"><img src="{{asset('ra-idlis/public/img/DOH.png')}}" style="height: auto; width:100px;"></th>
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
                        <td  class="text-right" style="width:15%;"><small  style="font-size: 10px;"><p>CON A.O 2006-2004 dtd 1/15/2007 AO 2012-0012 dtd 7/18/2012 <i>Section 6 Board Regulation No.5 s.2013 (DATRC_NA)</i></p></small></td>
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
                    			<th style="width: 60%;"></th>
                    			<th style="width: 2%;"></th>
                    			<th style="width: 10%;"></th>
                    			<th class="text-center" style="width: 28%;">Renewal</th>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">Certificate of Need</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">2,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">PERMIT TO CONSTRUCT:</td>
                    			
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">HOSPITAL</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"> Level 1</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">2,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"> Level 2</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">2,500.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"> Level 3</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">3,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">PSYCHIATRIC CARE FACILITY</td>
                    			
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"> Custodial Psychiatric Care Facility </td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,500.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"> Acute Chronic Psychiatric Care Facility</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,500.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">DIALYSIS CLINIC</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,400.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">AMBULATORY SURGICAL CLINIC</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,400.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">MEDICAL FACILITY FOR OVERSEAS WORKERS AND SEAFARERS</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,500.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">DRUG ABUSE TREATMENT AND REHABILITATION CENTER</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;">Residential</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;">Non-Residential</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">DRUG TESTING LABORATORY (FS)</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,000.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">PRIMARY CARE FACILITY-INFIRMARY</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,500.00</td>
                    			<td style="font-size: 13px;"></td>
                    		</tr>
                    		<tr>
                    			<td colspan="4" style="font-size: 13px;">&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td style="font-size: 13px;">PRIMARY CARE FACILITY-BIRTHING HOME</td>
                    			<td style="font-size: 13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
                    			<td style="font-size: 13px;">1,400.00</td>
                    			<td style="font-size: 13px;"></td>
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

								

