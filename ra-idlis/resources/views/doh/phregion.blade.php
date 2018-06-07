@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Regions <a href="" data-toggle="modal" data-target="#myModal" ><span data-toggle="tooltip" title="Add New Regional Admin" class="fa fa-plus-circle"></a></span>
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">Name</th>
                  <th style="width: 35%">Description</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($region as $regions)
                  <tr>
                    <td scope="row"> {{$regions->rgnid}}</td>
                    <td>{{$regions->rgn_desc}}</td>
                    <td>
                      <center>
                        <button type="button" class="btn-defaults" onclick="showData('{{$regions->rgnid}}', '{{$regions->rgn_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                      </center>
                    </td>
                  </tr>
                @endforeach
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
                <h5 class="modal-title text-center"><strong>Add New Region</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" action="{{-- {{asset('headashboard/addLO')}} --}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-sm-4">Name:</div>
                    <div class="col-sm-8">
                    <input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;" required>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8">
                    <input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;" required>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Region</button>
                    </div> 
                  </form>
               </div>
              </div>
            </div>
          </div>
    </div>
    </div>
    <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Edit Region</strong></h5>
              <div class="container">
                <div class="col-sm-4">Name:</div>
                    <div class="col-sm-12">
                    <input type="text" id="edit_name" class="form-control"  style="margin:0 0 .8em 0;" required>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-12">
                    <input type="text" id="edit_desc" class="form-control"  style="margin:0 0 .8em 0;" required>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="type" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <script type="text/javascript">
        function showData(id,desc){
          $('#edit_name').attr('value',id);
          $('#edit_desc').attr('value',desc);
        } 
    </script>
@endsection