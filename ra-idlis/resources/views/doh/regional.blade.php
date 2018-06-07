@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Regional Administrator Accounts <a href="" data-toggle="modal" data-target="#myModal" ><span data-toggle="tooltip" title="Add New Regional Admin" class="fa fa-plus-circle"></a></span>
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
          <form class="row" action="{{asset('headashboard/addLO')}}" method="POST">
            {{ csrf_field() }}
            <div class="col-sm-4">First Name:</div>
            <div class="col-sm-8">
            <input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4" >Middle Name:</div>
            <div class="col-sm-8">
            <input type="text" name="mname" class="form-control" style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4"">Last Name:</div>
            <div class="col-sm-8">
            <input type="text" name="lname" class="form-control"  style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4"">Position:</div>
            <div class="col-sm-8">
            <select class="form-control" name="pos" id="pos_val" style="margin:0 0 .8em 0;" onchange="getOthers();">
            <option hidden></option>  
            <option>Licensing Officer I</option>  
            <option>Licensing Officer II</option>  
            <option>Licesing Officer III</option> 
            <option>Medical Officer V</option> 
            <option>Medical Officer IV</option> 
            <option>Medical Officer III</option> 
            <option>Dentist IV</option> 
            <option>Dentist IV</option> 
            <option>Dentist III</option> 
            <option>Dentist II</option> 
            <option>Others</option>
            </select>
            </div>
            <div class="col-sm-4 SH_Others"  style="display:none;"></div>  
            <div class="col-sm-8 SH_Others" style="display: none">
                <input type="name" name="OthersInput" id="OthersInputted" placeholder="Others" class="form-control" style="margin:0 0 .8em 0;" >
            </div>
            <div class="col-sm-4"">Email Address:</div>
            <div class="col-sm-8">
            <input type="email" name="email" class="form-control"  style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4"">Contact No:</div>
            <div class="col-sm-4">
            <input type="text" name="t_num" class="form-control" placeholder="Tel No." style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4">
            <input type="text" name="c_num" class="form-control" placeholder="Cel No." style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4">
              Username:
            </div>
            <div class="col-sm-8">
              <input type="text" name="uname" class="form-control" style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-4">
              Password:
            </div>
            <div class="col-sm-8">
              <input type="password" name="pass" class="form-control" style="margin:0 0 .8em 0;" required>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Licensing Officer</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    </div>
@endsection