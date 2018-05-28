@extends('main')
@section('content')
@include('client.nav')
	<div class="jumbotron container" style="margin-top: 2em;box-shadow: 0px 2px 20px rgba(0,0,0,0.2);background-color: #fff">
		<div class="container">
			<h2>ABC Hospital. Rizal St., Manila</h2>
			<hr>
			<div class="container align-items-center">
				<font size="24px">Assessment Tool</font>
				<span style="float:right">
					<div class="btn-group">
					  <a href="{{asset('inspection')}}"><button type="button"  class="btn btn-primary">Part I</button></a>
					  <a href="{{asset('inspection2')}}"><button type="button"  class="btn btn-primary">Part II</button></a>
					  <a href="#"><button type="button"  class="btn btn-primary active">Part III</button></a>
					</div>
				</span>
			</div>
			<hr>
			<hr>
			<hr>
			<div class="container">
				<center>
					<h2>CHECKLIST OF REQUIREMENTS FOR HOSPITAL</h2>
				</center>
			</div>
			<hr>
			<hr>
			<div class="container">
				<table class="table" style="width: 100%;">
				  <thead>
				    <tr>
				      <th scope="col" width="20%"></th>
				      <th scope="col" width="15%"></th>
				      <th scope="col" width="15%" style="text-align: center;">Remarks</th>
				      <th scope="col" width="20%"></th>
				       <th scope="col" width="15%"></th>
				      <th scope="col" width="15%" style="text-align: center;">Remarks</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<tr><th colspan="6" class="table-warning">I. <strong>PERSONNEL</strong></th></tr>
				  	<tr><th colspan="6">A. <strong>Administrative Personnel</strong></th></tr>
				   <!--  -->
				    <tr>
				      <th scope="row">Chief of Hospital/Medical Director</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>				      
				      <th>
				      	Medical Records Clerk
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				    <tr>
				      <th scope="row">Administrative Officer/Hospital Administrator</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Medical Records Officer/Statistician
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Training Officer</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Supply Officer
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Accountant</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Storekeeper/Linen Custodian
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Bookkeeper</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Laundry Worker
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Budget Officer</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Nutritionist/Dietitian
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Billing Officer</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Food Service Supervisor
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cashier</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Cook/Food Service Worker
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cash Clerk</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Maintenance Personnel
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Accounting Clerk</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Engineer/Medical Equipment Technician
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Clerk (pool)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Utility Worker
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Human Resource Officer/Personnel Officer</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Driver
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Medical Social Worker</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Security Guard
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <tr>
				   		<th colspan="3">B. <strong>Nursing Service Personnel</strong></th>
				   		<th colspan="3">C. <strong>Clinical Service</strong></th>
				   	</tr>
				   	<!--  -->
				   <tr>
				      <th scope="row">Chief Nurser</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Chief of Clinics/Chief of the Medical Professional Staff
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Assistant Chief Nurse</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Department Head
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Supervising Nurse</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Physicians
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Head Nurse</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Dentist
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Critical Care Area Nurse</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Dental Aid
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Critical Care Area Nursing Aid/Midwife</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Physical Therapist
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Staff Nurse</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th >Nursing Attendant/ Midwife</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <tr><th colspan="6" class="table-warning">II. <strong>CONTENTS OF E-CART</strong></th></tr>
				   <!--  -->
				   <tr>
				      <th scope="row">Activated Charcoal Sachet</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Mefenamic acid 500mg/tab
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Admiodarone 150 mg/amp</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Meperidine 100 mg/vial
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Anti-tetanus serum</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Methylprednisolone 4 mg/tab
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Aspirin USP grade 325</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Metoclopramid 10
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <tr><th colspan="6" class="table-warning">III. <strong>BASIC E R EQUIPMENT/INSTRUMENTS/SUPPLIES</strong></th></tr>
				   <!--  -->
				   <tr>
				      <th scope="row">Airway adjuncts (oropharyngeal and Nasopharyngeal airways)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		ET tube (different sizes)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Airway/Intubation kit</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Fire extinguishers
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Alcohol disinfectant</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Floor lamps (drop light and gooseneck)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Arm sling (or sling and swathe bandages)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Foot stools
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Aseptic bulb syringe</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Gloves (examination and sterile gloves)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Bag-valve-mask device (adult, child, infant sets)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Hydrogen peroxide solution
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Biomedical Refregerator for storage of biological and other heat-sensitive drugs</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		IV stand
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Calculator for dose computation</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Laryngoscope (adult and pediatric sets)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cardiac board</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Mayo table and tray
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cardiac EKG</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Minor Surgical Set
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cervical collars of different sizes</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Nasal cannula
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Clinical Weighing scale</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Nasogastric tube
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Closed Tube Thoracostomy Set</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cut Down set</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Oxygen tank w/ holder/ chain/ trolley
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Defibrillator (with cardiac monitor and/ or pacemaker functions)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Oxygen tubing
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Diagnostic (opthalmoscope/ otoscope) set</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Penlights or flashlights
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Different sets of bins (to include a puncture- proof sharp container)</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Portable suction device (suction catheters included)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Elastic bandages of different sizes</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Provide iodine wound and cleaning solutions
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Protective face shield and mask</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Stretchers and Gurneys (Wheel- type and the fixed- typed stretchers)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Pulse oximeter</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Sutures
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Pulmonary Function Test (PFT) or Peak Expiratory Flow Rate (PEFR) tube</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Surgical airway
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Random blood sugar meter
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Syringes
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">
				      	<font size="2px">Sphygmomanometer  , non-mercurial - adult and pedia cuff</font>
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Thermometers, non mercurial
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Spine board with straps
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Tracheostomy set
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Splinting/ immobilization devices
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Urethal cathether
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Standard face mask
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Standard face mask
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Stethoscope
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Water-proof aprons
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Sterile gauze
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		X-ray reading lamp or negatoscope
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <tr><th colspan="6" class="table-warning">IV. <strong>EQUIPMENT BY SERVICE</strong></th></tr>
				   <!--  -->
				   <tr>
				      <th scope="row">A. Obstetrical Service
					</th>
				      <td>
				      	
				      </td>
				      <td>
				      	
				      </td>
				      <th>
				      		B. Recovery Room
				      </th>
				      <td>
				      	
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Air-conditioning Unit
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Air-conditioning Unit
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Anesthesia Machine
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Bed with guard rail
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">D/C set
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Sphygmomano meter (non-mercurial) with adult and pedia cuff
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Delivery set
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Stethoscope
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">DR table with stirrup
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Emergency light
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Emergency light
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Oxygen unit
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Instrument table
					</th>
				      <td>
				      </td>
				      <td>
				      </td>
				      <th>
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Kelly pad
					</th>
				      <td>
				      </td>
				      <td>
				      </td>
				      <th>
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Oxygen unit
					</th>
				      <td>
				      </td>
				      <td>
				      </td>
				      <th>
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Wheeled stretcher
					</th>
				      <td>
				      </td>
				      <td>
				      </td>
				      <th>
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">C. Pathologic/ Premature Nursery
					</th>
				      <td>
				      	
				      </td>
				      <td>
				      	
				      </td>
				      <th>
				      		D. Intesive Care Unit
				      </th>
				      <td>
				      	
				      </td>
				      <td></td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Air-conditioning unit
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Air-conditioning unit
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Bassinet
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Ambu bag (pediatric and adult)
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Bili light
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Bed with guard rail
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Cardiac monitor
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Cardiac monitor
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Emergency cart
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Defibrillator
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Emergency light
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		ECG machine
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Examining light
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Emergency cart
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Infant ambu bag
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Emergency light
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Incubator
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Endotracheal tubes
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Oxygen unit
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Laryngoscope with blade
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Respirator
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Oxygen unit
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Stethoscope (pediatric)
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Sphygmomano meter (non-mercurial) with pedia and adult cuff
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th scope="row">Suction apparatus
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Stethoscope
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   
				   <!--  -->
				   <tr>
				      <th scope="row">Weighing scale (infant)
					</th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				      <th>
				      		Tracheostomy set
				      </th>
				      <td colspan="2">
						<center><strong><font style="color: green;" size="4px"><i class="fa fa-check" aria-hidden="true"></i> Compliant</font></strong></center>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <tr>
				      <th>
					</th>
				      <td>
				      	
				      </td>
				      <td>
				      	
				      </td>
				      <th>
				      		Suction apparatus
				      </th>
				      <td>
						<center><strong><font style="color: red;" size="4px"><i class="fa fa-times" aria-hidden="true"></i> Not Compliant</font></strong></center>
				      </td>
				      <td>
				      	<strong><font style="color: red;" size="4px"> Lacking of suction apparatus </font></strong>
				      </td>
				    </tr>
				   <!--  -->
				   <!--  -->
				   <<!-- tr>
				      <th scope="row">E. Nursing Unit
					</th>
				      <td>
				      	
				      </td>
				      <td>
				      </td>
				      <th>
				      		G. Physical Therapy  Unit
				      </th>
				      <td>
				      </td>
				      <td></td>
				    </tr> -->
				   <!--  -->
				  </tbody>
				</table>
				<hr>
				<hr>
				<div>
					<center>
						<button class="btn btn-primary">
							<i class="fa fa-print" aria-hidden="true"></i> Print
						</button>
					</center>
				</div>
			</div>
	</div>
</div>
@endsection
