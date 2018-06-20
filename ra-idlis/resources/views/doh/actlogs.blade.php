@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA18" hidden>
  <script type="text/javascript">Right_GG();</script>
  {{-- @foreach ($parts as $part)
   <datalist id="{{$part->partid}}_list">
     @foreach ($asments as $asment)
       @if ($part->partid == $asment->partid)
          <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
       @endif
     @endforeach
   </datalist>
  @endforeach --}}
   {{-- $('#new_rgnid').val() --}}
 {{-- <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
   @endforeach
 </datalist> --}}
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Activity Logs {{-- <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a> --}}
           <div style="float:right;display: inline-block;">
            <form class="form-inline">
              <label>Filter : &nbsp;</label> 
              <input type="date" class="form-control" id="filterer" onchange="filterGroup()">
              <input type="" id="token" value="{{Session::token()}}" hidden>
              </form>
           </div>
        </div>
        <div class="card-body">
               <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">Time</th>
                  <th style="width: 30%">Module</th>
                  <th style="width: 30%"><center>Action</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table>
        </div>
    </div>
        </div>
    </div> 
    </div>
    <script type="text/javascript">
        function filterGroup(){
        var SelectedDate = $('#filterer').val();
        var token = $('#token').val();
        $.ajax({
            url: '{{ asset('/employee/get_date_actlogs') }}',
            method: 'POST',
            data: {_token:token,FilterDate:SelectedDate},
            success: function(data){
              if (data != 'NO') {
                  for (var i = 0; i < data.length; i++) {
                      var d = data[i], action = '';
                      if (d.act == 'ad_d') {
                        action = '<strong><span style="color:green">Added an entry</span></strong';
                      } else if (d.act == 'upd') {
                        action = '<strong><span style="color:orange">Updated an entry</span></strong>';
                      } else if (d.act == 'del') {
                        action = '<strong><span style="color:red">Deleted an entry</span></strong>';
                      }

                      $('#FilterdBody').append(
                          '<tr>' +
                              '<td>'+ d.formattedTime +'</td>' +
                              '<td><strong>'+ d.mod_id +' - '+ d.mod_desc+'</strong> Module</td>' +
                              '<td>'+ action +'</td>' +
                          '</tr>'
                        );
                  }
              } else {
                  $('#FilterdBody').empty();
                  alert('No Activities in the selected Date.');
              }
            }          
        });
      }
    </script>
@endsection