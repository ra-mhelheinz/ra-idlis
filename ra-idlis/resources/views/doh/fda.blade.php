
@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<input type="text" id="CurrentPage" value="UG03" hidden>
  <script type="text/javascript">Right_GG();</script>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           FDA Officers <a href="#" title="Add New Region" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
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
          <table class="table" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">Name</th>
                  <th style="width: 25%"><center>Region</center></th>
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
                  <td><center>{{$user->rgn_desc}}</center></td>
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
                        <a href="#ViewAccount" ><button data-toggle="modal" data-target="#ViewModal" onclick="showData('{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}','{{$user->contact}}','{{$user->rgn_desc}}', '{{$user->email}}')" class="btn btn-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>&nbsp;
                        @if ($user->isActive == 1)
                          <a href="#DeactivateAccount"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-danger" title="Deactivate Account">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                        @else
                          <a href="#ReactovateAccount"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-success" title="Reactivate Account">&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                      @endif
                        <a href="#EditAccount"><button class="btn btn-warning" title="Edit Account">&nbsp;<i class="fa fa-edit"></i>&nbsp;</button></a>&nbsp;
                      </center>
                    
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
            @if (!$users)
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong> No <strong>FDA Officers</strong> are currently registered!
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
        <h5 class="modal-title text-center"><strong>FDA Officer Registration</strong></h5>
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
                      <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
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
              <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New FDA Officer</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>Licensing Officer Information</strong></h5>
        <hr>
        <div class="container">
          <form  class="row" >
            <div class="col-sm-12" id="Error">
            </div>
            <div class="col-sm-4">First Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewFname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Middle Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewMname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Last Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewLname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Region:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewRegion" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Email Address:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewEmail" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Contact No:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewCntNo" style="font-weight: bold"</span>
            </div>
            <div class="col-sm-12">
              <hr>
              <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong><span id="ifActiveTitle"></span></strong></h5>
        <hr>
        <div class="container">
          <form  class="row" >
            <div class="col-sm-12" id="Error">
            <div class="col-sm-12" id="IfActiveModalBody">
            </div>
            <div class="col-sm-12">
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <button type="button" onclick="ChangeActiveStateNow()" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                </div>
                <div class="col-sm-6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                </div>
              </div>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
      $(document).ready(function() {
         $('#example').DataTable();
      } );
        $('#RAdmin').on('submit', function(e){
          e.preventDefault();
              var form = $(this);
              form.parsley().validate();
              if (form.parsley().isValid()){
                // $('input[name="fname"]').val()
                  $.ajax({
                  url: " {{asset('employee/dashboard/personnel/fda')}}",
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
                        alert('Successfully Added New FDA Officer');
                       window.location.href = "{{asset('employee/dashboard/personnel/fda')}}";
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
        function showData(id,fname,mname,lname,cntno,rgn,email){
          $('#ViewFname').text(fname.toUpperCase());
          $('#ViewMname').text(mname.toUpperCase());
          $('#ViewLname').text(lname.toUpperCase());
          $('#ViewRegion').text(rgn.toUpperCase());
          $('#ViewEmail').text(email);
          $('#ViewCntNo').text(cntno);
        }
        function showIfActive(state,id,fname,mname,lname){
          var title,name,message;
          if (mname != "" || mname != null) {
              mname = mname.charAt(0)+'.';
          }
          name = fname + ' ' + mname + ' ' + lname;
          if (state == 1) {
            title = "Deactivate Account";
            message = "Are you sure you want to deactivate <strong>" + name.toUpperCase() + "</strong> account?";
          } else {
            title = "Reactivate Account";
            message = "Are you sure you want to reactivate <strong>" + name.toUpperCase() + "</strong> account?";
          }
          $('#ifActiveTitle').text(title);
          $('#IfActiveModalBody').empty();
          $('#IfActiveModalBody').append(message+'<span id="ifActiveState" hidden>'+state+'</span><span id="ifActiveID" hidden>'+id+'</span>');
        }
        function ChangeActiveStateNow(){
          var state = $('#ifActiveState').text();
          var id = $('#ifActiveID').text();
          $.ajax({
            url: "{{ asset('/personnel/isActive') }}",
            method: "POST",
            data: {_token:$('input[name="_token"]').val(),isActive:state,id:id},
            success: function(data){
                if (data == 'DONE') {
                    alert('Successfully change state of a FDA Officer');
                    window.location.href = "{{asset('employee/dashboard/personnel/fda')}}";
                }
              }
          });
        }
    </script>
@endsection