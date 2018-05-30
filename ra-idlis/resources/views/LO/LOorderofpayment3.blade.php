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
								<h4><strong>NON-HOSPITAL BASED NON-OSS HEALTH FACILITIES AND SERVICES</strong></h4>
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
										<td style="font-size:13px;"> <input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">6,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">6,000.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">8,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">7,500.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">6,750.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Level 3 Hospital</td>
										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">10,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">7,500.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,800.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Tertiary</td>
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,500.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,250.00.00</td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,350.00.00</td>
  								</tr>
  								<tr>
										<td colspan="3" style="font-size:13px;">* Clinical Laboratory includes HIV testing and water-testing services as well as blood service facilities.</td>
										<td style="font-size:13px;">&nbsp;</td>
										<td style="font-size:13px;">&nbsp;</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">* Clinical Laboratory (Special)</td>
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
										<td style="font-size:13px;">1,000.00</td>
										<td style="font-size:13px;"><input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
										<td style="font-size:13px;">1,000.00</td>
  								</tr>
  								<tr>
										<td colspan="4" class="text-left" style="font-size:13px;">Additional pharmacy @ Php 1,000.00</td>
										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
										<td style="font-size:13px;text-align: right;">Sub- Total&nbsp;</td>
  										<td style="font-size:13px;text-align: right;"><small>Php</small>&nbsp;</td>
  										<td style="font-size:13px;padding: 2px" colspan="3"><input type="text" name="" disabled></td>
  								</tr>
							</tbody>
						</table>
						</div>
						<div class="col-lg-7">
							<table border="1" class="text-center" style="width: 100%;">
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
										<td style="font-size:13px;"> <input type="checkbox"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">4,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">4,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,600.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;">BLOOD BANK</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;">BCU</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">BS</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,400.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">BCU/BS</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">DIALYSIS CLINIC</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
									
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,700.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">DRUG Testing Laboratory (screening)</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
							
    									<td style="font-size:13px;">DRUG TESTING LABORATORY (confirmatory)</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">10,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">10,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
							
    									<td style="font-size:13px;">CASH BOND</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">20,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
									
    									<td style="font-size:11px;">HUMAN STEMCELL & CELL-BASED OR CELLULAR THERAPY</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
							
    									<td style="font-size:10px;"></td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">34,200.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
				
    									<td style="font-size:13px;">KIDNEY TRANSPLANT FACILITY</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">34,200.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
				
    									<td style="font-size:13px;">LABORATORY FOR DRINKING WATER ANALYSIS </td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
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
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">13,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">13,500.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">12,150.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right">CASH BOUND</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">100,000.00</td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right">NEWBORN SCREENING CENTER</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">8,500.00</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">8,500.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;">w/ 10% disc.</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">7,650.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Ambulance Service Provider</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">5,000.00</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">5,000.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Ambulance 1,000 per unit</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
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
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">50.00</td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Re-inspection Fee = 100%  of the initial license fee</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Surcharge Fee = 100% of the renewal license fee if LTO expired and not renewed less than 1 yr. after expiration date</td>
  										<td style="font-size:13px;"><input type="checkbox"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: right;" rowspan="2">GRAND TOTAL&nbsp;</td>
  										<td style="font-size:13px;text-align: right;" rowspan="2" colspan="2"><small>Php</small>&nbsp;</td>
  										<td style="font-size:13px;" rowspan="2" colspan="3"></td>
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
	</div>	
</div>

								

