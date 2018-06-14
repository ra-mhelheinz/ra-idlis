@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<script type="text/javascript">Right_GG();</script>
  <input type="text" id="CurrentPage" value="MA02" hidden>
  <script type="text/javascript">Right_GG();</script>
  @foreach ($region as $regions)
    <datalist id="{{$regions->rgnid}}_list">
      @foreach ($province as $provinces)
        @if ($regions->rgnid == $provinces->rgnid)
          <option id="{{$provinces->provid}}_pro" value="{{$provinces->provid}}">{{$provinces->provname}}</option>
        @endif
      @endforeach
    </datalist>
  @endforeach
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Provinces <a href="#" title="Add New Province" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Region ...</option>
                @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                @endforeach
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 75%">Name</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                {{-- @foreach ($region as $regions)
                  <tr>
                    <td scope="row"> {{$regions->rgnid}}</td>
                    <td>{{$regions->rgn_desc}}</td>
                    <td>
                      <center>
                        <button type="button" class="btn-defaults" onclick="showData('{{$regions->rgnid}}', '{{$regions->rgn_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                      </center>
                    </td>
                  </tr>
                @endforeach --}}
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
                <h5 class="modal-title text-center"><strong>Add New Province</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" action="{{-- {{asset('headashboard/addLO')}} --}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-sm-4">Region:</div>
                    <div class="col-sm-8">
                      <select class="form-control"  style="margin:0 0 .8em 0;" required="">  
                          <option value="">Select Region ...</option>
                         @foreach ($region as $regions)
                            <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8">
                    <input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;" required>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Province</button>
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
              <h5 class="modal-title text-center"><strong>Edit Province</strong></h5>
              <hr>
              <div class="container">
                <div class="col-sm-4">Name:</div>
                    <div class="col-sm-12">
                    <input type="text" id="edit_name" class="form-control"  style="margin:0 0 .8em 0;" required>
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
        function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
        $('#FilterdBody').empty();
        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
          for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_pro').text();
            var e = $('#'+x[i]+'_pro').attr('value');
            $('#FilterdBody').append(
                        '<tr>'+
                          '<td>'+d+'</td>' +
                          '<td><center><button type="button" class="btn-defaults" onclick="getData(\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button></center></td>' +
                        '</tr>'
                        );
          } 
      }
      function getData(provname){
          $('#edit_name').attr("value",provname);
      } 
    </script>
@endsection