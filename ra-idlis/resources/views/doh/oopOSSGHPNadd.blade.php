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
								<h4><strong>ONE STOP-SHOP GOVERNMENT HOSPITAL (NON-DOH RETAINED)</strong></h4>
							</th>
              <th style="width:10%"></th>
                    	</tr>
                    </table>
                    <br>
              <table style="width: 100%;">
                <thead>
                <td style="width: 8%"></td>
                <td style="width: 42%"></td>
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
										<td style="font-size:13px;"> <input type="checkbox"  id="RegisFee" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">&nbsp;</td>
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
										<td style="font-size:13px;">&nbsp;</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Level 1 Hospital</td>
										<td style="font-size:13px;"><input type="checkbox" level="1" hospi="1" class="Hospi Hospi1 HospiLevel1" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" hospi="1" class="Hospi Hospi1 HospiLevel2"  name="" style="	width: 2rem;height: 1rem;"></td>
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
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">&nbsp;</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Level 2 Hospital</td>
										<td style="font-size:13px;"><input type="checkbox" level="1" hospi="2" class="Hospi Hospi2 HospiLevel1" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" hospi="2" class="Hospi Hospi2 HospiLevel2"  name="" style="	width: 2rem;height: 1rem;"></td>
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
    									<td style="font-size:13px;">&nbsp;</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Level 3 Hospital</td>
										<td style="font-size:13px;"><input type="checkbox" level="1" hospi="3" class="Hospi Hospi3 HospiLevel1" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" hospi="3" class="Hospi Hospi3 HospiLevel2" name="" style="	width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"><input type="checkbox" level="1" price="2000" clinilab="1" class="CliniLab CliniLab1 CliniLabSub1" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="2500" clinilab="1" class="CliniLab CliniLab1 CliniLabSub2"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="1350" clinilab="1" class="CliniLab CliniLab1 CliniLabSub3"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,350.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Secondary</td>
										<td style="font-size:13px;"><input type="checkbox" level="1" price="2500" clinilab="2" class="CliniLab CliniLab2 CliniLabSub1"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="2000" clinilab="2" class="CliniLab CliniLab2 CliniLabSub2" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="1800" clinilab="2" class="CliniLab CliniLab2 CliniLabSub3" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,800.00</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Tertiary</td>
										<td style="font-size:13px;"><input type="checkbox" level="1" price="3000" clinilab="3" class="CliniLab CliniLab3 CliniLabSub1"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="2500" clinilab="3" class="CliniLab CliniLab3 CliniLabSub2" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,500.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" level="2" price="2250" clinilab="3" class="CliniLab CliniLab3 CliniLabSub3"  name="" style=" width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">&nbsp;</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">Limited Service Capability</td>
										<td style="font-size:13px;"><input type="checkbox" price="2000" class="LimSerCap LimSerCap1"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="1500" class="LimSerCap LimSerCap2" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
  								</tr>
  									<tr>
										<td style="font-size:13px;"></td>
										<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="1350" class="LimSerCap LimSerCap3" name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,350.00</td>
  								</tr>
  								<tr>
										<td colspan="3" style="font-size:13px;">* Clinical Laboratory includes HIV testing and water-testing services as well as blood service facilities.</td>
										<td style="font-size:13px;">&nbsp;</td>
										<td style="font-size:13px;">&nbsp;</td>
  								</tr>
  								<tr>
										<td style="font-size:13px;">* Clinical Laboratory (Special)</td>
										<td style="font-size:13px;"><input type="checkbox" id="CliLabSpec" onchange="Checksubtotal(200,'CliLabSpec');"  name="" style=" width: 2rem;height: 1rem;"></td>
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
										<td style="font-size:13px;">Pharmacy**</td>
										<td style="font-size:13px;"><input type="checkbox" price="1000" class="Pharma Pharma1" name="" style=" width: 2rem;height: 1rem;"></td>
										<td style="font-size:13px;">1,000.00</td>
										<td style="font-size:13px;"><input type="checkbox" price="1000" class="Pharma Pharma2" name="" style=" width: 2rem;height: 1rem;"></td>
										<td style="font-size:13px;">1,000.00</td>
  								</tr>
  								<tr>
										<td colspan="4" class="text-left" style="font-size:13px;">Additional pharmacy @ Php 1,000.00</td>
										<td style="font-size:13px;"></td>
  								</tr>
                  <tr>
                    <td colspan="4" class="text-center" style="font-size:9px;">** Exempted in pharmacy fee if  DOH-retained hospitals</td>
                    <td style="font-size:13px;"></td>
                  </tr>
                  <tr>
										<td colspan="5" class="text-left" style="font-size:13px;">&nbsp;</td>
										{{-- <td style="font-size:13px;"></td> --}}
  								</tr>
  								<tr>
										<td style="font-size:13px;text-align: right;">Sub- Total&nbsp;</td>
  										<td style="font-size:13px;text-align: right;"><small>Php</small>&nbsp;</td>
  										<td style="font-size:13px;padding: 2px;" colspan="3" id="SubTotal">0</td>
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
										<td style="font-size:13px;"> <input type="checkbox" price="4000" class="AmbuSurgCli AmbuSurgCli1"  name="" style=" width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">4,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="4000"  class="AmbuSurgCli AmbuSurgCli2" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">4,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="3600"  class="AmbuSurgCli AmbuSurgCli3" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,600.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;">BLOOD BANK</td>
    									<td style="font-size:13px;"><input type="checkbox" id="BloBak" onchange="Subtotal2(5000,'BloBak')"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;">BCU</td>
    									<td style="font-size:13px;"><input type="checkbox" id="BcU" onchange="Subtotal2(1500,'BcU')" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">BS</td>
    									<td style="font-size:13px;"><input type="checkbox" id="Bs" onchange="Subtotal2(1400,'Bs')" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,400.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">BCU/BS</td>
    									<td style="font-size:13px;"><input type="checkbox" id="BcUBS" onchange="Subtotal2(5000,'BcUBS')" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">1,500.00</td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">DIALYSIS CLINIC</td>
    									<td style="font-size:13px;"><input type="checkbox" price="3000" class="DialClin DialClin1"  name="" style="width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="3000" class="DialClin DialClin2" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">3,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
									
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="2700" class="DialClin DialClin3" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">2,700.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
								
    									<td style="font-size:13px;">DRUG Testing Laboratory (screening)</td>
    									<td style="font-size:13px;"><input type="checkbox" price="5000" class="DrugTesLabScre DrugTesLabScre1	"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="5000" class="DrugTesLabScre DrugTesLabScre2"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">5,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
							
    									<td style="font-size:13px;">DRUG TESTING LABORATORY (confirmatory)</td>
    									<td style="font-size:13px;"><input type="checkbox" price="10000" class="DrugTesLabConfir DrugTesLabConfir1" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">10,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="10000" class="DrugTesLabConfir DrugTesLabConfir2" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">10,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
									
    									<td style="font-size:11px;">HUMAN STEMCELL & CELL-BASED OR CELLULAR THERAPY</td>
    									<td style="font-size:13px;"><input type="checkbox" price="38000" class="HumanStemCel HumanStemCel1"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="38000" class="HumanStemCel HumanStemCel2" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:10px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="34200" class="HumanStemCel HumanStemCel3" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">34,200.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
				
    									<td style="font-size:13px;">KIDNEY TRANSPLANT FACILITY</td>
    									<td style="font-size:13px;"><input type="checkbox" price="38000" class="KidTraFaci KidTraFaci1"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="38000" class="KidTraFaci KidTraFaci2"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">38,000.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="34200" class="KidTraFaci KidTraFaci3"  name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">34,200.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
				
    									<td style="font-size:13px;">LABORATORY FOR DRINKING WATER ANALYSIS </td>
    									<td style="font-size:13px;"><input type="checkbox" id="LabForDrikWatAna" onchange="Subtotal2(5000,'LabForDrikWatAna')" name="" style="	width: 2rem;height: 1rem;"></td>
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
    									<td style="font-size:13px;"><input type="checkbox" price="13500" class="MediFaciForOverC MediFaciForOverC1" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">13,500.00</td>
    									<td style="font-size:13px;"><input type="checkbox" price="13500" class="MediFaciForOverC MediFaciForOverC2" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">13,500.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;"></td>
    									<td style="font-size:13px;">w/ 10% disc.</td>
    									<td style="font-size:13px;"><input type="checkbox" price="12150" class="MediFaciForOverC MediFaciForOverC3" name="" style="	width: 2rem;height: 1rem;"></td>
    									<td style="font-size:13px;">12,150.00</td>
    									<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right">CASH BOUND</td>
  										<td style="font-size:13px;"><input type="checkbox" id="CashBound" onchange="Subtotal2(5000,'CashBound')"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">100,000.00</td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right">NEWBORN SCREENING CENTER</td>
  										<td style="font-size:13px;"><input type="checkbox" price="8500" class="NewBornScreen NewBornScreen1" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">8,500.00</td>
  										<td style="font-size:13px;"><input type="checkbox" price="8500" class="NewBornScreen NewBornScreen2" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">8,500.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align:right"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;">w/ 10% disc.</td>
  										<td style="font-size:13px;"><input type="checkbox" price="7650" class="NewBornScreen NewBornScreen3" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">7,650.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
  								</tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Ambulance Service Provider</td>
  										<td style="font-size:13px;"><input type="checkbox" price="5000" class="AmbuSerPro AmbuSerPro1"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">5,000.00</td>
  										<td style="font-size:13px;"><input type="checkbox" price="5000" class="AmbuSerPro AmbuSerPro2" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;">5,000.00</td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Ambulance 1,000 per unit</td>
  										<td style="font-size:13px;"><input type="checkbox" price="1000" class="AmbuPerUnit AmbuPerUnit1" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"><input type="checkbox" price="1000" class="AmbuPerUnit AmbuPerUnit2" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
  								</tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Other Fees, specifiy </td>
  										<td style="font-size:13px;" colspan="3"></td>
  										<td style="font-size:13px;" colspan="2"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Re-inspection Fee = 100%  of the initial license fee</td>
  										<td style="font-size:13px;"><input type="checkbox" id="ReInspect"  name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
  								<tr>
  										<td style="font-size:13px;text-align: left;">Surcharge Fee = 100% of the renewal license fee if LTO expired and not renewed less than 1 yr. after expiration date</td>
  										<td style="font-size:13px;"><input type="checkbox" id="SurchargeFee" name="" style="	width: 2rem;height: 1rem;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  										<td style="font-size:13px;"></td>
  								</tr>
                  <tr>
                      <td colspan="6" class="text-center" style="font-size:13px;">&nbsp;</td>
                  </tr>
  								<tr>
  										<td style="font-size:13px;text-align: right;" rowspan="2">GRAND TOTAL&nbsp;</td>
  										<td style="font-size:13px;text-align: right;" rowspan="2" colspan="2"><small>Php</small>&nbsp;</td>
  										<td style="font-size:13px;font-weight: bold" rowspan="2" colspan="3" id="GrandTotal">0</td>
  								</tr>
  								<tr>
  								</tr>		
							</tbody>
							</table>
						</div>
            <br>
            <div class="col-lg-12">
              <table  style="width: 100%;font-size:13px;" border="0">
                <thead>
                    <tr>
                      <th width="10%"></th>
                      <th width="30%"></th>
                      <th width="20%"></th>
                      <th width="40%"></th>
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
      </div>
	</div>	
</div>
<input type="" id="token" value="{{ Session::token() }}" hidden>  
<script type="text/javascript">
	var subtotal = 0, subtotal2 = 0, grandtotal = 0;
	var CliniLab = [0,0]; // count, temp
	var LimSerCap = [0,0]; // count, temp
	var Pharma = [0,0]; // count, temp
	var AmbuSurgCli = [0,0]; // count, temp
	var DialClin = [0,0]; // count, temp
	var DrugTesLabScre = [0,0];
	var DrugTesLabConfir = [0,0];
	var HumanStemCel = [0,0];
	var KidTraFaci = [0,0];
	var MediFaciForOverC = [0,0];
	var AmbuSerPro = [0,0];
	var AmbuPerUnit = [0,0];
	var NewBornScreen = [0,0];
	 $(document).ready(function(){
	    loadDateToday();
	  });
	 function loadDateToday(){
	   var n = moment().format('LL');
	   $('#DateToday').append(n);
	 }
	 //////////////////////////////////////////////////////////////
	 function Checksubtotal(price,id){
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
        getTheWords();
    }
       function getTheWords(){
	    // WTotalHEre  TotalHERE
	    var Words =  numberToWords.toWords(grandtotal), TotalPhp = "";
	    if (grandtotal != 0) {
	     var Words =  numberToWords.toWords(grandtotal);
	     Words = Words.toUpperCase();
	     Words = Words  + ' PESOS';
	     TotalPhp = numberWithCommas(grandtotal) + '.00';
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
	 //////////////////////////////////////////////////////////////
	 $('input.Hospi').on('change',function(){ // 
	 	$('input.Hospi').not(this).prop('checked', false);
	 });
	 $('input.CliniLab').on('change', function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (CliniLab[0] == 0) {
	 			CliniLab[0] = 1;
	 			CliniLab[1] = parseInt(price);
	 		} else {
	            subtotal = subtotal - CliniLab[1];
	            CliniLab[1] = parseInt(price);
          	}
	 			subtotal = subtotal + parseInt(price);
          
	 	} else {
	 		CliniLab[0] = 0, CliniLab[1] = 0;
	        subtotal = subtotal - parseInt(price);
	 	}
	 	$('input.CliniLab').not(this).prop('checked', false);
	 	showSubtotal();
	 });
	 $('input.LimSerCap').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (LimSerCap[0] == 0) {
	 			LimSerCap[0] = 1;
	 			LimSerCap[1] = parseInt(price);
	 		} else {
	            subtotal = subtotal - CliniLab[1];
	            LimSerCap[1] = parseInt(price);
          	}
	 			subtotal = subtotal + parseInt(price);
          
	 	} else {
	 		LimSerCap[0] = 0, LimSerCap[1] = 0;
	        subtotal = subtotal - parseInt(price);
	 	}
	 	$('input.LimSerCap').not(this).prop('checked', false);
	 	showSubtotal();
	 });
	 $('input.Pharma').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (Pharma[0] == 0) {
	 			Pharma[0] = 1;
	 			Pharma[1] = parseInt(price);
	 		} else {
	            subtotal = subtotal - Pharma[1];
	            Pharma[1] = parseInt(price);
          	}
	 			subtotal = subtotal + parseInt(price);
          
	 	} else {
	 		Pharma[0] = 0, Pharma[1] = 0;
	        subtotal = subtotal - parseInt(price);
	 	}
	 	$('input.Pharma').not(this).prop('checked', false);
	 	showSubtotal();
	 });
	 $('input.AmbuSurgCli').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (AmbuSurgCli[0] == 0) {
	 			AmbuSurgCli[0] = 1;
	 			AmbuSurgCli[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - AmbuSurgCli[1];
	            AmbuSurgCli[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		AmbuSurgCli[0] = 0, AmbuSurgCli[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.AmbuSurgCli').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.DialClin').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (DialClin[0] == 0) {
	 			DialClin[0] = 1;
	 			DialClin[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - DialClin[1];
	            DialClin[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		DialClin[0] = 0, DialClin[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.DialClin').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.DrugTesLabScre').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (DrugTesLabScre[0] == 0) {
	 			DrugTesLabScre[0] = 1;
	 			DrugTesLabScre[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - DrugTesLabScre[1];
	            DrugTesLabScre[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		DrugTesLabScre[0] = 0, DrugTesLabScre[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.DrugTesLabScre').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.DrugTesLabConfir').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (DrugTesLabConfir[0] == 0) {
	 			DrugTesLabConfir[0] = 1;
	 			DrugTesLabConfir[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - DrugTesLabConfir[1];
	            DrugTesLabConfir[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		DrugTesLabConfir[0] = 0, DrugTesLabConfir[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.DrugTesLabConfir').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.HumanStemCel').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (HumanStemCel[0] == 0) {
	 			HumanStemCel[0] = 1;
	 			HumanStemCel[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - HumanStemCel[1];
	            HumanStemCel[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		HumanStemCel[0] = 0, HumanStemCel[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.HumanStemCel').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.KidTraFaci').on('change', function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (KidTraFaci[0] == 0) {
	 			KidTraFaci[0] = 1;
	 			KidTraFaci[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - KidTraFaci[1];
	            KidTraFaci[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		KidTraFaci[0] = 0, KidTraFaci[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.KidTraFaci').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.MediFaciForOverC').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (MediFaciForOverC[0] == 0) {
	 			MediFaciForOverC[0] = 1;
	 			MediFaciForOverC[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - MediFaciForOverC[1];
	            MediFaciForOverC[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		MediFaciForOverC[0] = 0, MediFaciForOverC[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.MediFaciForOverC').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.AmbuSerPro').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (AmbuSerPro[0] == 0) {
	 			AmbuSerPro[0] = 1;
	 			AmbuSerPro[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - AmbuSerPro[1];
	            AmbuSerPro[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		AmbuSerPro[0] = 0, AmbuSerPro[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.AmbuSerPro').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.AmbuPerUnit').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (AmbuPerUnit[0] == 0) {
	 			AmbuPerUnit[0] = 1;
	 			AmbuPerUnit[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - AmbuPerUnit[1];
	            AmbuPerUnit[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		AmbuPerUnit[0] = 0, AmbuPerUnit[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.AmbuPerUnit').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 $('input.NewBornScreen').on('change',function(){
	 	var price = $(this).attr('price');
	 	if ($(this).is(':checked')){
	 		if (NewBornScreen[0] == 0) {
	 			NewBornScreen[0] = 1;
	 			NewBornScreen[1] = parseInt(price);
	 		} else {
	            subtotal2 = subtotal2 - NewBornScreen[1];
	            NewBornScreen[1] = parseInt(price);
          	}
	 			subtotal2 = subtotal2 + parseInt(price);
          
	 	} else {
	 		NewBornScreen[0] = 0, NewBornScreen[1] = 0;
	        subtotal2 = subtotal2 - parseInt(price);
	 	}
	 	$('input.NewBornScreen').not(this).prop('checked', false);
	 	showGrandtotal();
	 });
	 function SubmitOOP(){
	 	// var RegiFee = $('#RegisFee').is(':checked') ?  1 : 0;
	 	// var Hospi1Lvl1 = $('.Hospi.Hospi1.HospiLevel1').is(':checked') ? 1 : 0;
	 	// var Hospi1Lvl2 = $('.Hospi.Hospi1.HospiLevel2').is(':checked') ? 1 : 0;
	 	// var Hospi2Lvl1 = $('.Hospi.Hospi2.HospiLevel1').is(':checked') ? 1 : 0;
	 	// var Hospi2Lvl2 = $('.Hospi.Hospi2.HospiLevel2').is(':checked') ? 1 : 0;
	 	// var Hospi3Lvl1 = $('.Hospi.Hospi3.HospiLevel1').is(':checked') ? 1 : 0;
	 	// var Hospi3Lvl1 = $('.Hospi.Hospi3.HospiLevel2').is(':checked') ? 1 : 0;
	 	// var Clini1lvl1 = $('.CliniLab.CliniLab1.CliniLabSub1').is(':checked') ? 1 :0;
	 	// var Clini1lvl2 = $('.CliniLab.CliniLab1.CliniLabSub2').is(':checked') ? 1 :0;
	 	// var Clini1lvl3 = $('.CliniLab.CliniLab1.CliniLabSub3').is(':checked') ? 1 :0;
	 	// var Clini2lvl1 = $('.CliniLab.CliniLab2.CliniLabSub1').is(':checked') ? 1 :0;
	 	// var Clini2lvl2 = $('.CliniLab.CliniLab2.CliniLabSub2').is(':checked') ? 1 :0;
	 	// var Clini2lvl3 = $('.CliniLab.CliniLab2.CliniLabSub3').is(':checked') ? 1 :0;
	 	// var Clini3lvl1 = $('.CliniLab.CliniLab3.CliniLabSub1').is(':checked') ? 1 :0;
	 	// var Clini3lvl2 = $('.CliniLab.CliniLab3.CliniLabSub2').is(':checked') ? 1 :0;
	 	// var Clini3lvl3 = $('.CliniLab.CliniLab3.CliniLabSub3').is(':checked') ? 1 :0;
	 	// var LimserCap1 = $('.LimSerCap.LimSerCap1').is(':checked') ? 1 : 0;
	 	// var LimserCap2 = $('.LimSerCap.LimSerCap2').is(':checked') ? 1 : 0;
	 	// var LimserCap3 = $('.LimSerCap.LimSerCap3').is(':checked') ? 1 : 0;
	 	// var CliLabSpec = $('#CliLabSpec').is(':checked') ? 1 : 0;
	 	// var Pharma1 = $('.Pharma.Pharma1').is(':checked') ? 1 : 0;
	 	// var Pharma2 = $('.Pharma.Pharma2').is(':checked') ? 1 : 0;
	 	// var AmbuSurgCli1 = $('.AmbuSurgCli.AmbuSurgCli1').is(':checked') ? 1 : 0;
	 	// var AmbuSurgCli2 = $('.AmbuSurgCli.AmbuSurgCli2').is(':checked') ? 1 : 0;
	 	// var AmbuSurgCli3 = $('.AmbuSurgCli.AmbuSurgCli3').is(':checked') ? 1 : 0;
	 	// var BloBak = $('#BloBak').is(':checked') ? 1 : 0;
	 	// var BcU = $('#BcU').is(':checked') ? 1 : 0 ;
	 	// var Bs = $('#Bs').is(':checked') ? 1 : 0;
	 	// var BcUBS = $('#BcUBS').is(':checked');
	 	// var DialClin1 = $('.DialClin.DialClin1').is('checked') ? 1 : 0 ;
	 	// var DialClin2 = $('.DialClin.DialClin2').is('checked') ? 1 : 0 ;
	 	// var DialClin3 = $('.DialClin.DialClin3').is('checked') ? 1 : 0 ;
	 	// var DrugTesLabScre1 = $('.DrugTesLabScre.DrugTesLabScre1').is(':checked') ? 1 : 0;
	 	// var DrugTesLabScre2 = $('.DrugTesLabScre.DrugTesLabScre2').is(':checked') ? 1 : 0;
	 	// var DrugTesLabConfir1 = $('.DrugTesLabConfir.DrugTesLabConfir1').is(':checked') ? 1 : 0;
	 	// var DrugTesLabConfir2 = $('.DrugTesLabConfir.DrugTesLabConfir2').is(':checked') ? 1 : 0; 
	 	// var HumanStemCel1 = $('.HumanStemCel.HumanStemCel1').is(':checked') ? 1 : 0;
	 	// var HumanStemCel2 = $('.HumanStemCel.HumanStemCel2').is(':checked') ? 1 : 0;
	 	// var HumanStemCel3 = $('.HumanStemCel.HumanStemCel3').is(':checked') ? 1 : 0;
	 	// var KidTraFaci1 = $('.KidTraFaci.KidTraFaci1').is(':checked') ? 1 : 0 ;
	 	// var KidTraFaci2 = $('.KidTraFaci.KidTraFaci2').is(':checked') ? 1 : 0 ;
	 	// var KidTraFaci3 = $('.KidTraFaci.KidTraFaci3').is(':checked')? 1 : 0 ;
	 	// var LabForDrikWatAna = $('#LabForDrikWatAna').is(':checked')? 1 : 0;
	 	// var MediFaciForOverC1 = $('.MediFaciForOverC.MediFaciForOverC1').is(':checked') ? 1 : 0;
	 	// var MediFaciForOverC2 = $('.MediFaciForOverC.MediFaciForOverC2').is(':checked') ? 1 : 0;
	 	// var MediFaciForOverC3 = $('.MediFaciForOverC.MediFaciForOverC3').is(':checked') ? 1 : 0;
	 	// var CashBound = $('#CashBound').is(':checked') ? 1 : 0;
	 	// var NewBornScreen1 = $('.NewBornScreen.NewBornScreen1').is(':checked') ? 1 : 0;
	 	// var NewBornScreen2 = $('.NewBornScreen.NewBornScreen2').is(':checked') ? 1 : 0;
	 	// var NewBornScreen3 = $('.NewBornScreen.NewBornScreen3').is(':checked') ? 1 : 0;
	 	// var AmbuSerPro1 = $('.AmbuSerPro.AmbuSerPro1').is(':checked') ? 1 : 0;
	 	// var AmbuSerPro2 = $('.AmbuSerPro.AmbuSerPro2').is(':checked') ? 1 : 0;
	 	// var AmbuPerUnit1 = $('.AmbuPerUnit.AmbuPerUnit1').is('checked') ? 1 : 0;
	 	// var AmbuPerUnit2 = $('.AmbuPerUnit.AmbuPerUnit2').is('checked') ? 1 : 0; 
	 	// var ReInspect = $('#ReInspect').is(':checked') ? 1 : 0;
	 	// var SurchargeFee = $('#SurchargeFee').is(':checked') ? 1 : 0;

	 	if (grandtotal==0) {alert('Error: Cannot Proceed.');}
	 	else {
	 		$.ajax({
	 			url : '{{ asset('/employee/dashboard/lps/evaluate/') }}/{{$appid}}/{{$oop_id}}/add',
	 			method : 'POST',
	 			data : {
	 				_token : $('#token').val(),
	 				data1 : $('#RegisFee').is(':checked') ?  1 : 0,
	 				data2 : $('.Hospi.Hospi1.HospiLevel1').is(':checked') ? 1 : 0,
	 				data3 : $('.Hospi.Hospi1.HospiLevel2').is(':checked') ? 1 : 0,
	 				data4 : $('.Hospi.Hospi2.HospiLevel1').is(':checked') ? 1 : 0,
	 				data5 : $('.Hospi.Hospi2.HospiLevel2').is(':checked') ? 1 : 0,
	 				data6 : $('.Hospi.Hospi3.HospiLevel1').is(':checked') ? 1 : 0,
	 				data7 : $('.Hospi.Hospi3.HospiLevel2').is(':checked') ? 1 : 0,
	 				data8 : $('.CliniLab.CliniLab1.CliniLabSub1').is(':checked') ? 1 :0,
	 				data9 : $('.CliniLab.CliniLab1.CliniLabSub2').is(':checked') ? 1 :0,
	 				data10 : $('.CliniLab.CliniLab1.CliniLabSub3').is(':checked') ? 1 :0,
	 				data11 : $('.CliniLab.CliniLab2.CliniLabSub1').is(':checked') ? 1 :0,
	 				data12 : $('.CliniLab.CliniLab2.CliniLabSub2').is(':checked') ? 1 :0,
	 				data13 : $('.CliniLab.CliniLab2.CliniLabSub3').is(':checked') ? 1 :0,
	 				data14 : $('.CliniLab.CliniLab3.CliniLabSub1').is(':checked') ? 1 :0,
	 				data15 : $('.CliniLab.CliniLab3.CliniLabSub2').is(':checked') ? 1 :0,
	 				data16 : $('.CliniLab.CliniLab3.CliniLabSub3').is(':checked') ? 1 :0,
	 				data17 : $('.LimSerCap.LimSerCap1').is(':checked') ? 1 : 0,
	 				data18 : $('.LimSerCap.LimSerCap2').is(':checked') ? 1 : 0,
	 				data19 : $('.LimSerCap.LimSerCap3').is(':checked') ? 1 : 0,
	 				data20 : $('#CliLabSpec').is(':checked') ? 1 : 0,
	 				data21 : $('.Pharma.Pharma1').is(':checked') ? 1 : 0,
	 				data22 : $('.Pharma.Pharma2').is(':checked') ? 1 : 0,
	 				data23 : $('.AmbuSurgCli.AmbuSurgCli1').is(':checked') ? 1 : 0,
	 				data24 : $('.AmbuSurgCli.AmbuSurgCli2').is(':checked') ? 1 : 0,
	 				data25 : $('.AmbuSurgCli.AmbuSurgCli3').is(':checked') ? 1 : 0,
	 				data26 : $('#BloBak').is(':checked') ? 1 : 0,
	 				data27 : $('#BcU').is(':checked') ? 1 : 0 ,
	 				data28 : $('#Bs').is(':checked') ? 1 : 0,
	 				data29 : $('#BcUBS').is(':checked') ? 1 : 0,
	 				data30 : $('.DialClin.DialClin1').is('checked') ? 1 : 0,
	 				data31 : $('.DialClin.DialClin2').is('checked') ? 1 : 0 ,
	 				data32 : $('.DialClin.DialClin3').is('checked') ? 1 : 0,
	 				data33 : $('.DrugTesLabScre.DrugTesLabScre1').is(':checked') ? 1 : 0,
	 				data34 : $('.DrugTesLabScre.DrugTesLabScre2').is(':checked') ? 1 : 0,
	 				data35 : $('.DrugTesLabConfir.DrugTesLabConfir1').is(':checked') ? 1 : 0,
	 				data36 : $('.DrugTesLabConfir.DrugTesLabConfir2').is(':checked') ? 1 : 0,
	 				data37 : $('.HumanStemCel.HumanStemCel1').is(':checked') ? 1 : 0,
	 				data38 : $('.HumanStemCel.HumanStemCel2').is(':checked') ? 1 : 0,
	 				data39 : $('.HumanStemCel.HumanStemCel3').is(':checked') ? 1 : 0,
	 				data40 : $('.KidTraFaci.KidTraFaci1').is(':checked') ? 1 : 0 ,
	 				data41 : $('.KidTraFaci.KidTraFaci2').is(':checked') ? 1 : 0 ,
	 				data42 : $('.KidTraFaci.KidTraFaci3').is(':checked')? 1 : 0,
	 				data43 : $('#LabForDrikWatAna').is(':checked')? 1 : 0,
	 				data44 : $('.MediFaciForOverC.MediFaciForOverC1').is(':checked') ? 1 : 0,
	 				data45 : $('.MediFaciForOverC.MediFaciForOverC2').is(':checked') ? 1 : 0,
	 				data46 : $('.MediFaciForOverC.MediFaciForOverC3').is(':checked') ? 1 : 0,
	 				data47 : $('#CashBound').is(':checked') ? 1 : 0,
	 				data48 : $('.NewBornScreen.NewBornScreen1').is(':checked') ? 1 : 0,
	 				data49 : $('.NewBornScreen.NewBornScreen2').is(':checked') ? 1 : 0,
	 				data50 : $('.NewBornScreen.NewBornScreen3').is(':checked') ? 1 : 0,
	 				data51 : $('.AmbuSerPro.AmbuSerPro1').is(':checked') ? 1 : 0,
	 				data52 : $('.AmbuSerPro.AmbuSerPro2').is(':checked') ? 1 : 0,
	 				data53 : $('.AmbuPerUnit.AmbuPerUnit1').is('checked') ? 1 : 0,
	 				data54 : $('.AmbuPerUnit.AmbuPerUnit2').is('checked') ? 1 : 0,
	 				data55 : $('#ReInspect').is(':checked') ? 1 : 0,
	 				data56 : $('#SurchargeFee').is(':checked') ? 1 : 0,
	 				subtotal : subtotal,
	 				grandtotal : grandtotal,
	 				totalword : $('#WTotalHere').text(),
	 			},
	 			success: function(data){
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
								

