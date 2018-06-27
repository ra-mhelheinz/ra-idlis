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
        <div class="card-body table-responsive">

            <table class="table table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th scope="col">Application No.</th>
                    <th scope="col">Name of Facility</th>
                    <th scope="col">Status of Applicant</th>
                    <th scope="col">Evaluate</th>
                    <th scope="col">Uploaded OR Copy</th>
                    <th scope="col">Recommended for Inspection</th>
                    <th scope="col">Date of Inspection</th>
                    <th scope="col">Issuance Status: Approval/Disapproval</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="#">00000077</a></td>
                    <td>Hospital</td>
                    <td></td>
                    <td><a href="{{asset('/employee/dashboard/lps/evalute')}}"><span class="badge badge-info">Evaluate</span></a></td>
                     <td><a href="#"></a></td>
                      <td><a href="{{asset('/employee/dashboard/lps/evalute/ins/1')}}"><span class="badge badge-pill badge-success">Yes</span></a></td>
                       <td><a href="#">00000077</a></td>
                       <script type="text/javascript">
                       </script>
                  <td><span class="badge badge-success">Approved</span></td>
                </tr>
                <tr>
                    <td><a href="#">00000078</a></td>
                    <td>Ambulatory Surgical Center</td>
                    <td></td>
                    <td><a href="{{asset('/employee/dashboard/lps/evalute')}}"><span class="badge badge-info">Evaluate</span></a></td>
                     <td><a href="#"></a></td>
                      <td><a href="#"><span class="badge badge-pill badge-warning">No</span></a></td>
                       <td><a href="#">00000077</a></td>
                       <td><span class="badge badge-danger">Dissapproved</span></td>
                </tr>
                <tr>
                    <td><a href="#">00000079</a></td>
                    <td>Doctor’s Office</td>
                    <td></td>
                    <td><a href="{{asset('/employee/dashboard/lps/evalute')}}"><span class="badge badge-info">Evaluate</span></a></td>
                     <td><a href="#"></a></td>
                      <td><a href="#"><span class="badge badge-pill badge-warning">No</span></a></td>
                       <td><a href="#">00000077</a></td>
                     <td><span class="badge badge-danger">Dissapproved</span></td>
                </tr>
                <tr>
                    <td><a href="#">00000080</a></td>
                    <td>Urgent Care Clinic</td>
                    <td></td>
                    <td><a href="{{asset('/employee/dashboard/lps/evalute')}}"><span class="badge badge-info">Evaluate</span></a></td>
                     <td><a href="#"></a></td>
                      <td><a href="#"><span class="badge badge-pill badge-warning">No</span></a></td>
                       <td><a href="#">00000077</a></td>
                        <td><span class="badge badge-danger">Dissapproved</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
@endsection