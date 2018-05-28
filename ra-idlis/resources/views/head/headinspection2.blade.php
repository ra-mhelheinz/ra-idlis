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
            <a href="{{asset('/headinspection')}}"><button type="button"  class="btn btn-primary">Part I</button></a>
            <a href="#"><button type="button"  class="btn btn-primary active">Part II</button></a>
            <a href="{{asset('/headinspection3')}}"><button type="button"  class="btn btn-primary">Part III</button></a>
          </div>
        </span>
      </div>
      <hr>
      <hr>
      <hr>
      <div class="container">
        <h3>
          I. The hospital provides safe, effective, and efficient medical service.
        </h3>
      </div>
      <hr>
      <hr>
      <div class="container ">
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;There is presence of policies and procedures for credentialling and privileging of physicians. 
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                2.&nbsp;There are available equipment, medicines, and supplies necessary to provide emergency care . 
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                3.&nbsp;There are personnel available to deliver emergency care for 24 hours.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                4.&nbsp;Proper identification of newborns is ensured before they leave the delivery room and until discharge.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                5.&nbsp;Nursing care is provided at all times.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                6.&nbsp;The delivery of nursing care utilizes the nursing process.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                7.&nbsp;Nursing procedure manual and a properly utilized Kardex are available in all patient care units.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                8.&nbsp;Written policies for all nursing service areas within the hospital are available and reviewed annually.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                9.&nbsp;There is presence of Infection Control Committee with defined goals, objectives, strategies, and priorities.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <!-- //////////// -->
      </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                10.&nbsp;There is presence of infection control program ensuring prevention and control of infections on all services.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                11.&nbsp;There is presence of a coordinated system-wide procedure for isolation of healthcare associated infection.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                12.&nbsp;There is presence of a coordinated system-wide procedure for case containment of healthcare associated infection.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                13.&nbsp;There is presence of a coordinated system-wide procedure for asepsis.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                14.&nbsp;There is proof of creation of all committees within the organization which includes the terms of reference for membership.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                15.&nbsp;There is presence of incident reporting system/sentinel event monitoring system.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                16.&nbsp;There is presence of policies and procedures on the prevention and treatment of needle stick injuries and safe disposal of needles.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                17.&nbsp;There is presence of program on prevention of tranmission of airborn infections and risks from patients with signs and symptoms suggestive of tuberculosis or other communicable diseases.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                18.&nbsp;There is presence of policies nad procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                19.&nbsp;There is presence of policies and procedures on reporting of infections to personnel and public health agencies based on DOH A.O. 2008-2009.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
      <hr>
      <div class="container">
        <h3>
          II. The hospital has a system of proper documentation and management of patients' records.
        </h3>
      </div>
      <hr>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;All patients charts have signed consent.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                2.&nbsp;All patients charts have comprehensive history and physical examination within 24 hours from admission.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                3.&nbsp;All patients charts have progress notes by physicians.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                4.&nbsp;All patients for surgery have undergone pre-operative anesthetic assessment.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                5.&nbsp;All patients are correctly identified by their charts.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                6.&nbsp;All drugs are administered in a timely, safe, appropriate and controlled manner to the right patient.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                7.&nbsp;There is proof that prescriptions or orders are verified before medication are administered.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                8.&nbsp;There is proof that patients are correctly identified prior to administration of medications.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                9.&nbsp;All charts have proper documentation of drug administration.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                10.&nbsp;All charts have discharge plans.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                11.&nbsp;Patient charts are properly and completely filled out to contain up-to-date information. <strong>Checklist of Requirements-VI. CONTENTS OF MEDICAL CHART</strong>.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                12.&nbsp;Medical records contain patient information that is uniquely identifiable, accurately recorded, current, confidential, and readily accessible when required.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                13.&nbsp;Medical diagnoses, procedures and/or surgeries performed on patients are recorded using ICD-10 coding.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                14.&nbsp;ICD-10 reference books are available.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                15.&nbsp;The medical records officer is trained in ICD-10 coding and in basic medical records management/hospital health information management.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                16.&nbsp;Records of newborns are properly and completely filled out.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                17.&nbsp;Birth certificate forms are properly and completely filled out.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                18.&nbsp;Death certificate forms are properly and complety filled out.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                19.&nbsp;Records of medico-legal cases are properly and completely filled out.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                20.&nbsp;Confidentiality of patient information is maintained at all times.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                21.&nbsp;There is presence of policies on record storage, safekeeping, retention, and disposal.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                22.&nbsp;There is presence of policies and procedures on filing, borrowing, and retrieval of charts.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                23.&nbsp;There is presence of procedures to protect records and patient charts against loss, destruction, tampering, and unauthorized access or use.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <hr>
        <div class="container">
          <h3>
            III. The hospital has health promotion and disease program.
          </h3>
        </div>
        <hr>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;Breastfeeding.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                2.&nbsp;Rooming-in.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                3.&nbsp;Familty Planning.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                4.&nbsp;Immunization.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                5.&nbsp;Newborn Screening for congenital diseases.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                6.&nbsp;Newborn Screening for hearing.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                7.&nbsp;Others.
              </h5>
          </div>
          <div class="col-2">
            <center>
              <button type="button" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </center>
          </div>
          <div class="col-2">
            <font>Remarks</font>
            <textarea></textarea>
          </div>
        </div>
        </div>
    </div>
        </div>
    </div>
@endsection