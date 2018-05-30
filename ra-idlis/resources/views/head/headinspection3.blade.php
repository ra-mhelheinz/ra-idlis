@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Licensing Process Status
        </div>
        <div class="card-body">
          <h2>ABC Hospital. Rizal St., Manila</h2>
      <hr>
      <div class="container align-items-center">
        <font size="24px">Assessment Tool</font>
        <span style="float:right">
          <div class="btn-group">
            <a href="{{asset('/headinspection')}}"><button type="button"  class="btn-primarys">Part I</button></a>
            <a href="{{asset('/headinspection2')}}"><button type="button"  class="btn-primarys">Part II</button></a>
            <a href="#"><button type="button"  class="btn-primarys active">Part III</button></a>
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
      <div class="container table-responsive">
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                Medical Records Clerk
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
            <tr>
              <th scope="row">Administrative Officer/Hospital Administrator</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Medical Records Officer/Statistician
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Training Officer</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Supply Officer
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Accountant</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Storekeeper/Linen Custodian
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Bookkeeper</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Laundry Worker
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Budget Officer</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Nutritionist/Dietitian
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Billing Officer</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Food Service Supervisor
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cashier</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Cook/Food Service Worker
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cash Clerk</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Maintenance Personnel
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Accounting Clerk</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Engineer/Medical Equipment Technician
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Clerk (pool)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Utility Worker
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Human Resource Officer/Personnel Officer</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Driver
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Medical Social Worker</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Security Guard
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <tr>
              <th colspan="3">B. <strong>Nursing Service Personnel</strong></th>
              <th colspan="3">C. <strong>Clinical Service</strong></th>
            </tr>
            <!--  -->
           <tr>
              <th scope="row">Chief Nurser</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Chief of Clinics/Chief of the Medical Professional Staff
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Assistant Chief Nurse</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Department Head
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Supervising Nurse</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Physicians
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Head Nurse</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Dentist
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Critical Care Area Nurse</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Dental Aid
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Critical Care Area Nursing Aid/Midwife</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Physical Therapist
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Staff Nurse</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Mefenamic acid 500mg/tab
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Admiodarone 150 mg/amp</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Meperidine 100 mg/vial
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Anti-tetanus serum</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Methylprednisolone 4 mg/tab
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Aspirin USP grade 325</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Metoclopramid 10
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <tr><th colspan="6" class="table-warning">III. <strong>BASIC E R EQUIPMENT/INSTRUMENTS/SUPPLIES</strong></th></tr>
           <!--  -->
           <tr>
              <th scope="row">Airway adjuncts (oropharyngeal and Nasopharyngeal airways)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  ET tube (different sizes)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Airway/Intubation kit</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Fire extinguishers
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Alcohol disinfectant</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Floor lamps (drop light and gooseneck)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Arm sling (or sling and swathe bandages)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Foot stools
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Aseptic bulb syringe</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Gloves (examination and sterile gloves)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Bag-valve-mask device (adult, child, infant sets)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Hydrogen peroxide solution
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Biomedical Refregerator for storage of biological and other heat-sensitive drugs</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  IV stand
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Calculator for dose computation</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Laryngoscope (adult and pediatric sets)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cardiac board</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Mayo table and tray
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cardiac EKG</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Minor Surgical Set
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cervical collars of different sizes</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Nasal cannula
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Clinical Weighing scale</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Nasogastric tube
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Closed Tube Thoracostomy Set</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Oxygen tank w/ holder/ chain/ trolley
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Defibrillator (with cardiac monitor and/ or pacemaker functions)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Oxygen tubing
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Diagnostic (opthalmoscope/ otoscope) set</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Penlights or flashlights
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Different sets of bins (to include a puncture- proof sharp container)</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Portable suction device (suction catheters included)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Elastic bandages of different sizes</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Provide iodine wound and cleaning solutions
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Protective face shield and mask</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Stretchers and Gurneys (Wheel- type and the fixed- typed stretchers)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Pulse oximeter</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Sutures
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Pulmonary Function Test (PFT) or Peak Expiratory Flow Rate (PEFR) tube</th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Surgical airway
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Random blood sugar meter
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Syringes
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">
                <font size="2px">Sphygmomanometer  , non-mercurial - adult and pedia cuff</font>
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Thermometers, non mercurial
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Spine board with straps
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Tracheostomy set
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Splinting/ immobilization devices
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Urethal cathether
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Standard face mask
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Standard face mask
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Stethoscope
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Water-proof aprons
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Sterile gauze
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  X-ray reading lamp or negatoscope
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Air-conditioning Unit
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Anesthesia Machine
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Bed with guard rail
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">D/C set
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Sphygmomano meter (non-mercurial) with adult and pedia cuff
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Delivery set
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Stethoscope
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">DR table with stirrup
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Emergency light
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Emergency light
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Oxygen unit
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
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
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Air-conditioning unit
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Bassinet
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Ambu bag (pediatric and adult)
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Bili light
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Bed with guard rail
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Cardiac monitor
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Cardiac monitor
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Emergency cart
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Defibrillator
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Emergency light
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  ECG machine
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Examining light
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Emergency cart
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Infant ambu bag
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Emergency light
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Incubator
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Endotracheal tubes
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Oxygen unit
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Laryngoscope with blade
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Respirator
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Oxygen unit
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Stethoscope (pediatric)
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Sphygmomano meter (non-mercurial) with pedia and adult cuff
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Suction apparatus
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Stethoscope
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Weighing scale (infant)
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Tracheostomy set
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">
          </th>
              <td>
              </td>
              <td>
              </td>
              <th>
                  Suction apparatus
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
              <th scope="row">Weighing scale (infant)
          </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <textarea></textarea>
              </td>
              <th>
                  Tracheostomy set
              </th>
              <td>
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
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
                <button class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button> &nbsp;
                <button class="btn btn-danger">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td><textarea></textarea></td>
            </tr>
           <!--  -->
           <!--  -->
           <tr>
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
            </tr>
           <!--  -->
          </tbody>
        </table>
      </div>
        </div>
    </div>
        </div>
    </div>
@endsection