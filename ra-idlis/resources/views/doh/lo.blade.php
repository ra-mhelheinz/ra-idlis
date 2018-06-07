@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Regional Administrator Accounts <a href="" data-toggle="modal" data-target="#myModal" ><span data-toggle="tooltip" title="Add New Regional Admin" class="fa fa-plus-circle"></a></span>
           {{-- <span style="float:right">Filter : 
              <select class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Region ...</option>
                <option value="All">All Region</option>
                @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                @endforeach
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
           </span> --}}
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 50%">Name</th>
                  <th style="width: 15%">Region</th>
                  <th style="width: 10%">Status</th>
                  <th style="width: 25%">Options</th>
                </tr>
              </thead>
              <tbody>
                     <tr>
                       <td></td>
                     </tr>
              </tbody>
            </table>
        </div>
    </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>Regional Administrator Registration</strong></h5>
        <hr>
        <div class="container">
          <form class="row" action="{{ asset('employee/dashboard/personnel/lo') }}" method="POST" data-parsley-validate>
            {{ csrf_field() }}
            <div class="col-sm-4">First Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="text" name="fname" class="form-control" data-parsley-required-message="*<strong>First name</strong> required"  required>
            </div>
            <div class="col-sm-4" >Middle Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="text" name="mname" class="form-control">
            </div>
            <div class="col-sm-4">Last Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="text" name="lname" class="form-control" data-parsley-required-message="*<strong>Last name</strong> required"  required>
            </div>
            <div class="col-sm-4" >Region:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <select class="form-control" name="rgn" id="pos_val" data-parsley-required-message="*<strong>Region</strong> required"  onchange="getOthers();" required="">
            <option value=""></option>  
                @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                @endforeach
            </select>
            </div>
            <div class="col-sm-4">Email Address:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="email" name="email" class="form-control" data-parsley-required-message="*<strong>Email</strong> required" required>
            </div>
            <div class="col-sm-4">Contact No:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="number" name="cntno" class="form-control" data-parsley-required-message="*<strong>Contact no.</strong> required" required>
            </div>
            <div class="col-sm-4">
              Username:
            </div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" name="uname" class="form-control" data-parsley-required-message="*<strong>Username</strong> required" required>
            </div>
            <div class="col-sm-4">
              Password:
            </div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="password" name="pass" class="form-control" data-parsley-required-message="*<strong>Password</strong> required" required>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Regional Adminstrator</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    </div>
@endsection