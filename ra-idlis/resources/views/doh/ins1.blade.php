@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Inspection
        </div>
        <div class="card-body">
          <h2>ABC Hospital. Rizal St., Manila</h2>
      <hr>
      <div class="container align-items-center">
        <font size="24px">Assessment Tool</font>
        <span style="float:right">
          <div class="btn-group">
            <a href="#"><button type="button"  class="btn-primarys active">Part I</button></a>
            <a href="{{asset('/employee/dashboard/lps/evalute/ins/2')}}"><button type="button"  class="btn-primarys">Part II</button></a>
            <a href="{{asset('/employee/dashboard/lps/evalute/ins/3')}}"><button type="button"  class="btn-primarys">Part III</button></a>
          </div>
        </span>
      </div>
      <hr>
      <hr>
      <hr>
      <div class="container">
        <h3>
          I. The hospital appoints and allocates personnel who are suitably qualified, skilled and/or experienced to provide service and meet patient needs. 
        </h3>
      </div>
      <hr>
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;All personnel are qualified, skilled and/or experienced to assume the responsibility, authority, accountability, and functions of their respective positions. 
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
                2.&nbsp;Professional qualifications are validated,  including evidence of professional registration/ license, where applicable, prior to employment. 
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
                3.&nbsp;All doctors, nurses and pharmacists have updated licenses.
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
                4.&nbsp;The chief of hospital has a master's degree in hospital administration or related course and at least five (5) years experience in supervisory/managerial position.
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
                5.&nbsp;The administrative officer has a master's degree in hospital administration or related course and at least five (5) years experience in supervisory/managerial position.
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
                6.&nbsp;The chief of clinics is a diplomate/fellow of a specialty/subspecialty society and has at least five (5) years experience in supervisory/managerial position.
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
                7.&nbsp;The chief nurse has a master's degree in nursing and at least five (5) years of experience in a nursing supervisory/managerial position.
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
                8.&nbsp;New personnel receive and orientation program that covers the essential components of the service being provided.
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
                9.&nbsp;The performance of each personnel is evaluated.
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
                10.&nbsp;The hospital implements a human resource development program that identifies plans, facilities, and records training and evaluation of all personnel.
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
                11.&nbsp;An appraissal system identifies and reviews effectiveness and appropriateness of the training/s provided.
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
                12.&nbsp;An exit interview is conducted for personnel who resigns or retires from the service.
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
                13.&nbsp;An organized medical and nursing staff shall be reponsible for the quality of patient care and for the ethical conduct and professional practices of its members.
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
                14.&nbsp;The facility has a list of total number of licensed physicians, nurses, midwives and nursing attendants, based on human resource records.
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
            II.A. The hospital provides and maintains a safe environment for patients, personnel and the public.
          </h3>
        </div>
      <hr>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;The buildings pose no hazard to the life and safety of patient, personnel and the public.
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
                2.&nbsp;There are entrance and exit signs. Entrances and exites are readily accessible and free from obstruction. Exits are restricted to the following types: door leading directly outside the building, interior stair, ramp and exterior stair.
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
                3.&nbsp;A minimum of two (2) exits, remote from each other, are provided for each floor of the building.
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
                4.&nbsp;Exits terminate directly at an open space to the outside of the building.
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
                5.&nbsp;There are alternative passageways that are prominently marked and free from obstruction for patients with special needs.
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
                6.&nbsp;There are directional signage that are prominently posted to lacate different service areas.
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
                7.&nbsp;There are visual aids and devices for information and orientation, direction, identification, official notices, prohibitation, and warning.
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
                8.&nbsp;There is adequate space, lighting and ventilation for the hospital. The areas used by patiends and personnel are adequately lighted and ventilated.
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
                9.&nbsp;Adequate space is provided to allow patient and personel to move safely around patient bed areas.
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
                10.&nbsp;Patients who use mobility aids are able to safely maneuver with the assistance of their aid within their bed area.
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
                11.&nbsp;There are screen wires on doors, windows and other openings.
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
                12.&nbsp;Corridors in areas not commonly use for bed, stretcher and equipment transport are at least 1.83 meters or 6 feet in clear width.
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
                13.&nbsp;Corridors for access for patient using bed or stretcher are at least 2.44 meters or 8 feet in clear width.
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
                14.&nbsp;An eleveator capable of accommodating at least a patient bed is provided in case there is no provision for multi-level ramp.
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
                15.&nbsp;A multi-level ramp is provided for ancillary, clinical, nursing services located on the upper floor of the health facility. It shall have a minimum clear width of 1.22 meters or 4 feet in one direction. The slope of the ramp is not steeper than 1:12.
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
                16.&nbsp;A ramp provided as access to the entrance of the health facility that is not on the same level of the site.
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
                17.&nbsp;The hospital provides adequate privacy for patient such that sensitive or private discussion, examination and/or procedure are conducted in a manner or environment where these cannot be observed or the risk of being overheard by others is minimized.
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
                18.&nbsp;The hospital has facility through which segregation of sexes in the wards shall be observed.
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
                19.&nbsp;Separate toilets are provided for male and female patient and personnel.
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
                20.&nbsp;There is separate hand washing and holding area for infectious cases.
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
                21.&nbsp;The hospital ensures the security of person and property within the facility.
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
                22.&nbsp;There is presence of appointed personnel in charge of security.
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
                23.&nbsp;The hospital is readily accessible to the communit and complies with all local zoning ordinances.
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
                24.&nbsp;The hospital is free from undue noise, smoke, dust, foul odor and flood.
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
                25.&nbsp;The health facility implements R.A. 9211 otherwise known as "Tobacco Regulation Act of 2003." Patient and personnel are not put at risk by exposure to environmental tobacco smoke.
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
            II.B. The hospital provides provides adequate and proper maintenance of all of its basic utilities.
          </h3>
        </div>
      <hr>
      <hr>
        <div class="row">
          <div class="col-8">
              <h5 style="text-align: justify;">
                1.&nbsp;The hospital has an approved power supply system. Panel boards and feeders are properly coded and labeled.
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
                2.&nbsp;The hospital has an approved water supply system. Its water is potable and safe for drinking. Records of water analysis (bacteriological examination) are available and updated every six months.
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
                3.&nbsp;The water tank/water reservoir is flushed, cleaned and disinfected at least annually.
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
                4.&nbsp;The hospital as established a system for both proper solid and liquid waste management which is in accordance with the 2012 3rd edition of Health Care Waste Management Manual of the DOH and EMB/DENR environmental laws.
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                a.&nbsp;There is a proper management of temporary and areas prior to hauling for disposal.
              </font>
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                b.&nbsp;The hospital practises pre-treatment of solid waste prior to disposal.
              </font>
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                c.&nbsp;The hospital practises pre-treatment of solid wastes prior to disposal.
              </font>
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                d.&nbsp;The hospital practises treatment of hazardous chemical and pharmaceutical wastes.
              </font>
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                e.&nbsp;There is a safe area within the hospital premises for the disposal of infectious and pathologic waste.
              </font>
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
        <div class="row">
          <div class="col-8">
              <font style="font-size:1.15rem;text-align: justify; margin-left:20px">
                f.&nbsp;There is provision of septic/concrete vault for disposal of sharps.
              </font>
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
                5.&nbsp;The hospital has established a system for the proper disposal of toxic and hazardous substances in accordance with R.A 6969, otherwise known as "Toxic and Hazardous Substance and Nuclear Wastes Act," and other related guidelines and/or issuances.
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
                6.&nbsp;There are policies and procedures for safe reuse of items which comply with relevant statutory requirements. (Annex B of DOH A.O. 2012-0012).
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
                7.&nbsp;There is proof of implementation of policies and procedure on waste disposal.
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
                8.&nbsp;The hospital has recyclable waste staging areas.
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
                9.&nbsp;There are protective equipment and clothing appropriate to the risks associated with handling, storage and disposal of waste, and is provided to be used by hospital personnel.
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
                10.&nbsp;There is presence of management plan addressing safety, security, disposal and control of hazardous material and biological waste, emergency amd disaster preparedness, fire safety, radiation safety, and utility system.
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
                11.&nbsp;There is presence of policies and procedures on risk identification, assessment and control, security risk, use of personal protective equipment, etc.
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
                12.&nbsp;The hospital has policies and procedures for the proper maintenance and monitoring of physical facilities to ensure that is kept in a state of good repair.
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
                13.&nbsp;Its floor, walls and ceillings are made of sturdy materials that allow durability, ease of cleaning and fire resistance.
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
                14.&nbsp;The hospital has provision of appropriate generator, emergency light, water system, and adequate ventilation or air conditioning.
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
                15.&nbsp;There is presence of licenses/permits/clearances from pertinent regulatory agencies implementing among others the following: R.A. 9003 (Solid Waste).
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
                16.&nbsp;There is proof of implementation of the policies, procedures and safety programs on: electrical safety, medical device safety, chemical safety, radiation safety, mechanical safety, water safety, combustible material safety, waste management and hospital safety program. Please refer to <strong>Checklist of Requirements - X. POLICIES/PROCEDURES/SAFETY PROGRAMS</strong>.
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