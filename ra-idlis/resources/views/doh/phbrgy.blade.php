@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<script type="text/javascript">Right_GG();</script>
  <input type="text" id="CurrentPage" value="MA04" hidden>
  <script type="text/javascript">Right_GG();</script>
<div hidden>
    @if (isset($region) && isset($province))
      @foreach ($region as $regions)
        <datalist id="{{$regions->rgnid}}_list">
          @foreach ($province as $provinces)
            @if ($regions->rgnid == $provinces->rgnid)
              <option id="{{$provinces->provid}}_pro" value="{{$provinces->provid}}">{{$provinces->provname}}</option>
            @endif
          @endforeach
        </datalist> 
      @endforeach
    @endif
  @if (isset($province) && isset($cm))
    @foreach ($province as $provinces)
      <datalist id="{{$provinces->provid}}_provlist">
        @foreach ($cm as $cms)
         @if ($cms->provid == $provinces->provid)
           <option id="{{$cms->cmid}}_cm" value="{{$cms->cmid}}">{{$cms->cmname}}</option>
         @endif
        @endforeach
      </datalist> 
    @endforeach
  @endif
  {{-- @foreach ($cm as $cms)
    <datalist id="{{$cms->cmid}}_cmlist">
      @foreach ($brgy as $brgys)
        @if ($cms->cmid == $brgys->cmid)
           <option id="{{$brgys->brgyid}}_brgy" value="{{$brgys->brgyid}}">{{$brgys->brgyname}}</option>
       @endif
      @endforeach
    </datalist>
  @endforeach --}}
</div>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Barangay <a href="#" title="Add New Barangay" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <form  class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Region ...</option>
                @if (isset($region))
                  @foreach ($region as $regions)
                    <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                  @endforeach
                @endif
              </select>   
              &nbsp;
              <select style="width: auto;" class="form-control" id="filterer2" onchange="filterGroup2()">
                <option value="">Select Province ...</option>
                {{-- @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                @endforeach --}}
              </select>
              &nbsp;
              <select style="width: auto;" class="form-control" id="filterer3" onchange="filterGroup3()">
                <option value="">Select City/Municipality ...</option>
                {{-- @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                @endforeach --}}
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>

           </div>
        </div>
        <div class="card-body">
               <table class="table" id="example" style="overflow-x: scroll;" >
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
                <h5 class="modal-title text-center"><strong>Add New Barangay</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" id="addRgn" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <div class="row">
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-sm-4">Region:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="Reg4Add" onchange="filter4Add();" data-parsley-required-message="*<strong>Region</strong> required" required>  
                          <option value="">Select Region ...</option>
                        @if (isset($region))
                          @foreach ($region as $regions)
                            <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                          @endforeach
                        @endif
                      </select> 
                    </div>
                    <div class="col-sm-4">Province:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="InsertProvHere" onchange="filter24Add()" data-parsley-required-message="*<strong>Province</strong> required" required>  
                          <option value="">Select Province ...</option>
                      </select>
                    </div>
                    <div class="col-sm-4">City/Municipality:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="InsertCMHere" data-parsley-required-message="*<strong>City/Municipality</strong> required" required>  
                          <option value="">Select City/Municipality ...</option>
                      </select>
                    </div>
                    <div class="col-sm-4">Name:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="CM_name" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control" required>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
              <h5 class="modal-title text-center"><strong>Edit Barangay</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                      <div class="row">
                      </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <span id="EditBody">
                    </span>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
           $('#example').DataTable();
        } );
        function showData(id,desc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-4">ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+desc+'" class="form-control disabled" disabled>' +
              '</div>' +
              '<div class="col-sm-4">Name:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_desc" value="'+id+'" data-parsley-required-message="<strong>*</strong>Name  <strong>Required</strong>" placeholder="'+id+'" class="form-control" required>' +
              '</div>' 
            );
        }
        function filterGroup(){
        var id = $('#filterer').val();
        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
        $('#filterer2').empty();
        $('#filterer2').append('<option value="">Select Province ...</option>')
        $('#filterer3').empty();
        $('#FilterdBody').empty();
        $('#filterer3').append('<option value="">Select City/Municipality ...</option>');
          for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_pro').text();
            var e = $('#'+x[i]+'_pro').attr('value');
            $('#filterer2').append('<option value="'+e+'">'+d+'</option>');
          }
      }
      function filter4Add(){
        var id = $('#Reg4Add').val();
        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
        $('#InsertProvHere').empty();
        $('#InsertProvHere').append('<option value="">Select Province ...</option>');
        $('#InsertCMHere').empty();
        $('#InsertCMHere').append('<option value="">Select City/Municipality ...</option>');
        for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_pro').text();
            var e = $('#'+x[i]+'_pro').attr('value');
            $('#InsertProvHere').append('<option value="'+e+'">'+d+'</option>');
          }
      }
      function getData(provname){
          $('#edit_name').attr("value",provname);
      }
      function filterGroup2(){
         var id = $('#filterer2').val();
         var x = $('#'+id+'_provlist option').map(function() {return $(this).val();}).get();
         $('#filterer3').empty();
         $('#FilterdBody').empty();
         $('#filterer3').append('<option value="">Select City/Municipality ...</option>');
         for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_cm').text();
            var e = $('#'+x[i]+'_cm').attr('value');
             $('#filterer3').append(
                '<option value="'+e+'">'+d+'</option>'
              );
         }

      }
      function filter24Add(){
        var id = $('#InsertProvHere').val();
        var x = $('#'+id+'_provlist option').map(function() {return $(this).val();}).get();
        $('#InsertCMHere').empty();
        $('#InsertCMHere').append('<option value="">Select City/Municipality ...</option>');
        for (var i = 0; i < x.length; i++) {
            var d = $('#'+x[i]+'_cm').text();
            var e = $('#'+x[i]+'_cm').attr('value');
             $('#InsertCMHere').append(
                '<option value="'+e+'">'+d+'</option>'
              );
         }
      }
      function filterGroup3(){
        var id = $('#filterer3').val();
        $('#FilterdBody').empty();
        $.ajax({
          url : "{{ asset('/ph/get_brgy') }}",
          method: 'POST',
          data: {
              _token : $('#token').val(),
              id : $('#filterer3').val(),
            },
          success: function(data){
              if(data){
                var table = $('#example').DataTable();
                table.clear().draw();
                for (var i = 0; i < data.length; i++) {
                 var  x = data[i];
                 $('#example').DataTable()
                     .row
                     .add([x.brgyname, '<center><button type="button" class="btn-defaults" onclick="showData(\''+x.brgyname+'\', '+x.brgyid+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button></center>'
                      ])
                   .draw();
                 // $('#FilterdBody').append(
                 //      '<tr>'+
                 //          '<td>'+x.brgyname+'</td>' +
                 //          '<td>' +
                 //          '<center>' +
                 //            '<button type="button" class="btn-defaults" onclick="showData(\''+x.brgyname+'\', '+x.brgyid+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                 //          '</center>' +
                 //          '</td>' +
                 //      '</tr>'
                 //  );
                }
              }
          }
        });
      }
      $('#addRgn').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                var ProvId = $('#InsertProvHere').val();
                var CM_name = $('#CM_name').val();
                var arr = $('#'+ProvId+'_provlist option').map(function () {return this.text}).get();
                var test = $.inArray(CM_name,arr);
                if (test == -1) { // Not in Array
                    $.ajax({
                      url: "{{asset('/employee/dashboard/ph/barangay')}}",
                      method: 'POST',
                      data: {
                        _token : $('#token').val(),
                        id: $('#InsertCMHere').val(),
                        name : $('#CM_name').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Barangay');
                            window.location.href = "{{asset('/employee/dashboard/ph/barangay')}}";
                        } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100);
                        }
                      }, error : function (XMLHttpRequest, textStatus, errorThrown){
                          console.log(errorThrown);
                          $('#AddErrorAlert').show(100);
                      }
                  });
                } else {
                  alert('City/Municipality Name is already been taken');
                  $('#CM_name').focus();
                }
            }
        });
        $('#EditNow').on('submit',function(event){
          event.preventDefault();
            var form = $(this);
            form.parsley().validate();
             if (form.parsley().isValid()) {
               var x = $('#edit_name').val();
               var y = $('#edit_desc').val();
               $.ajax({
                  url: "{{ asset('/mf/save_phBarangay') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Barangay');
                          window.location.href = "{{ asset('/employee/dashboard/ph/barangay') }}";
                      } else if (data == 'ERROR') {
                          $('#EditErrorAlert').show(100);
                      }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#EditErrorAlert').show(100);
                  }
               });
             }
        }); 
    </script>
@endsection