@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="MA16" hidden>
  <script type="text/javascript">Right_GG();</script>
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <datalist id="rgn_list">
      @if (isset($hfstypes))
        @foreach ($hfstypes as $hfstype)
          <option value="{{$hfstype->hfser_id}}">{{$hfstype->hfser_desc}}</option>
        @endforeach
      @endif
    </datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           System Settings 
           <div style="float:right;display: inline-block;">
            <form class="form-inline">
                  <button type="button" onclick="$('#SaveForm').submit()" style="background-color: #27e02c" class="btn btn-primarys">Save</button>
              </form>
           </div>

        </div>
        <div class="card-body">
          <div class="col-sm-12">
            <form id="SaveForm" data-parsley-validate>
            <div class="row">
              <div class="col-sm-6" style="font-weight: bolder">Secretary of Health</div>
              <div class="col-sm-6" style="margin:0 0 .8em 0;">
                <input type="text" id="sec_name" class="form-control" value="@isset($BigData->sec_name) {{$BigData->sec_name}} @endisset">
              </div>
            </div>
            
            <div class="row">
              @php
                $text = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                $setMonth = '';
                if(isset($BigData->mtny)){
                  $x = $BigData->mtny - 1;
                  $setMonth = $text[$x];
                }
              @endphp
              <div class="col-sm-6"><span style="font-weight: bolder">Start of Validity :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$setMonth}}</span></div>
              <div class="col-sm-6" style="margin:0 0 .8em 0;">
                <select class="form-control" id="mtny">
                  <option value="@isset($BigData->mtny){{$BigData->mtny}}@endisset"></option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
            </div>

          </div>
        </div>
    </div>
  </div>
    <script type="text/javascript">
      $('#SaveForm').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
          $.ajax({
              method : 'post',
              data : {
                    _token : $('#token').val(),
                    sec_name : $('#sec_name').val(),
                    mtny : $('#mtny').val(),
                  },
              success : function (data){
                  if (data == 'DONE') {
                    alert('Successfully save settings');
                    location.reload();
                  } else if (data == 'ERROR'){
                      $('#ERROR_MSG2').show(100);
                  }
              },
              error : function(a,b,c){
                console.log(c);
                $('#ERROR_MSG2').show(100);
              }
          });
        }
      });
    </script>
@endsection