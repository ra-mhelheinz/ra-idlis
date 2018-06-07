@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Licesing Officers Accounts <a href="" data-toggle="modal" data-target="#myModal" ><span data-toggle="tooltip" title="Add Licensing Officer" class="fa fa-plus-circle"></a></span>
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
          <span id="success_add">
            
          </span>
          <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 50%">Name</th>
                  <th style="width: 15%"><center>Region</center></th>
                  <th style="width: 10%"><center>Status</center></th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
              @if ($users)
                @foreach ($users as $user)
                <tr>
                  <td>{{$user->fname}} @if ($user->mname != "") {{substr($user->mname,0,1)}}. @endif {{$user->lname}}
                  </td>
                  <td><center>{{$user->rgnid}}</center></td>
                  <td>
                    <center>
                      @if ($user->isActive == 1)
                        <font style="color:green">Active</font>
                      @else
                        <font style="color:red">Deactived</font>
                      @endif
                    </center>
                  </td>
                  <td>
                     
                        <center>
                        <a href="#"><button class="btn btn-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>&nbsp;
                        @if ($user->isActive == 1)
                          <a href=""><button class="btn btn-danger" title="Deactivate Account">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                        @else
                          <a href="#"><button class="btn btn-success" title="Reactivate Account">&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                      @endif
                      </center>
                    
                  </td>
                </tr>
              @endforeach
              @endif
                      {{-- <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td>
                          <font style="color:green">Active</font>
                          <font style="color:red">Deactived</font>
                        </td>
                        <td>
                          <div class="row">
                            <a href="" ><button class="btn btn-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>&nbsp;
                              <form>
                              <a href=""><button class="btn btn-danger" title="Deactivate Account">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                            </form> 
                            <form>
                            <a href=""><button class="btn btn-success" title="Reactivate Account">&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                          </form>                               
                          </div>
                        </td>
                      </tr> --}}
              </tbody>
            </table>
            @if (!$users)
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong> No <strong>Licensing Officers</strong> are currently registered!
            </div>
            @endif
        </div>

    </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>Licensing Officer Registration</strong></h5>
        <hr>
        <div class="container">
          <form id="RAdmin" class="row" data-parsley-validate>
            {{ csrf_field() }}
            <div class="col-sm-12" id="Error">
                
            </div>
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
            
            @if (session('employee_login')->grpid == 'NA')
            <div class="col-sm-4" >Region:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <select class="form-control" name="rgn" id="pos_val" data-parsley-required-message="*<strong>Region</strong> required" required="">
                <option value=""></option>  
                    @foreach ($region as $regions)
                      <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                    @endforeach
                </select>
                </div>
            @else
              <select class="form-control" name="rgn" id="pos_val" data-parsley-required-message="*<strong>Region</strong> required" required="" hidden>
              <option value="{{session('employee_login')->rgnid}}">{{session('employee_login')->rgnid}}</option>
              </select> 
            @endif
            
            <div class="col-sm-4">Email Address:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="email" name="email" class="form-control" data-parsley-required-message="*<strong>Email</strong> required" required>
            </div>
            <div class="col-sm-4">Contact No:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <input type="text" name="cntno" class="form-control" data-parsley-required-message="*<strong>Contact no.</strong> required" required>
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
              <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Licensing Officer</button>
              {{-- action="{{ asset('employee/dashboard/personnel/regional') }}" method="POST"  --}}
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    </div>
    <script type="text/javascript">
        $('#RAdmin').on('submit', function(e){
          e.preventDefault();
              var form = $(this);
              form.parsley().validate();
              if (form.parsley().isValid()){
                // $('input[name="fname"]').val()
                  $.ajax({
                  url: " {{asset('employee/dashboard/personnel/lo')}}",
                  method: 'POST',
                  data: {
                    _token : $('input[name="_token"]').val(),
                    fname : $('input[name="fname"]').val(),
                    mname : $('input[name="mname"]').val(),
                    lname : $('input[name="lname"]').val(),
                    rgn : $('select[name="rgn"]').val(),
                    email : $('input[name="email"]').val(),
                    cntno : $('input[name="cntno"]').val(),
                    uname : $('input[name="uname"]').val(),
                    pass : $('input[name="pass"]').val(),
                  },
                  success: function(data) {
                    if (data === 'DONE') {
                        // $("#RAdmin").trigger( "reset" );
                        // $('#myModal').modal('toggle');
                        alert('Successfully Added New Licensing Officer');
                       window.location.href = "{{asset('employee/dashboard/personnel/lo')}}";
                    } else {
                      $('input[name="uname"]').focus();
                      showEr();
                    }
                  }
              });
              }
        });
        function showEr(){
          $('#Error').empty();
          $('#Error').append(
          '<center>'+
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                  '<strong><i class="fas fa-times"></i></strong> <strong>  Username</strong> is already been taken.'+
                '</div>'+
              '</center>'
          );
        }
        function SuccessAdd(){
          // <div class="alert alert-success alert-dismissible fade show" role="alert">
          //     <strong><i class="fas fa-check"></i></strong> Successfully added new Regional Administrator
          //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          //       <span aria-hidden="true">&times;</span>
          //     </button>
          //   </div>
        }
    </script>
@endsection