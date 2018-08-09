@extends('main')
@section('content')
@include('client.nav')
@if (session()->exists('client_data') || session('client_data') != null)
   @php
     $clientData = session('client_data');
   @endphp
@else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif
<style type="text/css">
  .label{
  padding: 10px;

}
     .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 99999;
    top: 0;
    right: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;

}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 2px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
@include('client.breadcrumb')
<div class="modal fade" id="confirmmodal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body text-center">
                Are you sure you want to delete?
                <form action="{{ route('client.deldraft') }}" method="get">
                <button type="submit" name="delmod" class="btn-primarys" id="yes" >Yes</button>
                <button type="button" class="btn-defaults" data-dismiss="modal">No</button>
                </form>          
              </div>
            </div>
          </div>
  </div>
   <div style="font-size:30px;cursor:pointer; position: fixed; right: 0; z-index: 999;color: #fff;background-color: #1540B2; padding: 3px;border-radius: 3px;" onclick="openNav()"><i class="fa fa-angle-double-left"></i></div>
<script type="text/javascript">
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    // document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    // document.getElementById("main").style.marginLeft= "0";
}
    function remLd() { 
      $('#exampleModalCenter').modal('show', {backdrop: 'static', keyboard: false});
      setTimeout(function(){ $('#asdf').fadeOut(500); }, 3000);
     };
    remLd();
</script>
@if(session()->has('draft_success'))
<div id="asdf" class="alert alert-{{session()->has('alert-type')}} alert-dismissible fade show" role="alert">
            <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('draft_success')}}</center>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
@endif
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="container">

    <input type="text" name="draftxt" id="draftxt" class="form-control form-control-sm" style="margin-bottom: 2px;border-radius: 0;outline:none !important;">
    <button form="preform" name="submitpre" class="btn btn-success btn-block" type="submit" value="1" style="border-radius: 0;">Save <i class="fa fa-save"></i></button>

    <ul class="list-group " style="margin-top: 5px;">
    <li class="list-group-item text-center" >Save List</li>
    @foreach($app_assessment as $app_assessments)

       <li class="list-group-item">
        <div class="row">
          <div class="col-sm-12 text-center">
          <a href="{{asset('client/preassessment2/draft')}}/{{$app_assessments->draft}}" style="font-size: 15px;margin-left: -20px;">{{$app_assessments->draft}} ({{$app_assessments->sa_tdate}})
          </a>
          </div>
        </div>
        <div class="row">
        <div class="col-sm-12">
          <a class="delbtn" id="{{$app_assessments->draft}}" style="cursor: pointer;padding: 0" data-toggle="modal" data-target="#confirmmodal" ><button class="btn btn-danger btn-block" style="padding: 0;">Delete</button></a>
        </div>
        </div>
        </li>
    @endforeach
  </ul>
  </div>
</div>
<div class="jumbotron container" style="margin-top: 2em;box-shadow: 0px 2px 20px rgba(0,0,0,0.2);background-color: #fff;border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;">
    <div class="container">
      <h2>{{$clientData->facilityname}}. {{$clientData->streetname}}, {{$clientData->cmname}}</h2>
      <hr>
       <div class="container">
        <font size="24px" >Assessment Tool</font>
        <span style="float:right">
          <div class="btn-group">
            @isset($check_assessment)
            @if($check_assessment->count()>0)
            <a href="{{asset('client/preassessment2/complied')}}"><button class="btn btn-success" ><i class="fa fa-check"></i> Complied</button></a>
            <a href="{{asset('client/preassessment2/notcomplied')}}"><button class="btn btn-danger"><i class="fa fa-times"></i> Not Complied</button></a>
            @endif
            @endisset
          </div>
        </span>
          <hr>
{{--       <form>
        {{ csrf_field() }}
         <div class="table-responsive">

          @foreach($assessment as $assessments)


            <table>
              <tr>
                <td class="col-sm-12">{{$assessments->asmt_name}}</td>
                <td class="col-sm-12 text-center"><div style="display: inline-flex;"><input type="radio" id="check" name="optradio" value="1" hidden><input id="wrong" type="radio" value="0" name="optradio" hidden><label onclick="check()" id="bgreen" style="padding: 5px;"><i class="fa fa-check" ></i></label>
                <label onclick="uncheck()" id="bgred"  style="padding: 5px;"><i class="fa fa-times"></i></label></div></td>
                <td class="text-center col-sm-12"><input type="file" class="file" name="file[]"></td>
                <td class="text-center col-sm-12"><textarea placeholder="Remarks" name="remarks[]" id="remrks"></textarea></td>
              </tr>
              <hr>
            </table>
          
          @endforeach
        </div>
      </form> --}}
      {{--   <div class="" style="margin-top: 5%; margin-left: 43%;">
         {{$assessment->links()}}
        </div>
        <div class="text-center"> <button onclick="valsub()" class="btn btn-success" id="submt" name="submitpre" type="submit" style="border-radius: 0;">Submit</button></div> --}}
        
      <form id="preform" enctype="multipart/form-data" action="{{asset('client/preassessment2')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="savetxt" id="savetxt">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="1-content" role="tabpanel" aria-labelledby="pills-home-tab">

            @php 
            $firstassess = $assessment->where('partid', '=', '1');
            $getlastnum = DB::table('assessment')->orderBy('partid', 'desc')->first();
            $numbstart = 2; $numend = intval($getlastnum->partid);
            $employeeData = session('client_data');

            @endphp
            @foreach($firstassess as $assessments)
              @isset($check_assessment)
                @php
                  $draft_name = $check_assessment[0]->draft;
                  $get_answers = DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('asmt_id', '=', $assessments->asmt_id)->where('draft', '=', $draft_name)->first();
                @endphp
              @endisset
             <div class="row">
              <div class="col-sm-4">{{$assessments->asmt_name}}</div>
              <div class="col-sm-2 text-center">
                 <input type="hidden" name="upID[]" value="{{$assessments->asmt_id}}">
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="complied_{{$assessments->asmt_id}}" type="radio" value="1" @isset($get_answers) @if($get_answers->complied=='1') checked="true"  @endif @endisset hidden>
                      <label id="radio_{{$assessments->asmt_id}}1" for="complied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 1, '{{$assessments->asmt_id}}')" @isset($get_answers) @if($get_answers->complied=='1') style="background-color:green;" @endif @endisset><i class="fa fa-check"></i></label>
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="notcomplied_{{$assessments->asmt_id}}" type="radio" value="0" @isset($get_answers) @if($get_answers->complied=='0') checked="true" @endif @endisset hidden>
                      <label id="radio_{{$assessments->asmt_id}}2" for="notcomplied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 2, '{{$assessments->asmt_id}}')" @isset($get_answers) @if($get_answers->complied=='0') style="background-color:red;" @endif @endisset><i class="fa fa-times"></i></label>
              </div>
              <div class="col-sm-3"><input type="file" class="file" name="file[]"></div>
              <div class="col-sm-3"><textarea placeholder="Remarks" name="remarks[]" id="remarks_{{$assessments->asmt_id}}">@isset($get_answers) {{$get_answers->sa_remarks}} @endisset</textarea></div>
            </div>
            @endforeach
          </div>
           @for($i=$numbstart;$i <= $numend;$i++)
           @php 
            $firstassess = $assessment->where('partid', '=', $i);
           @endphp
          <div class="tab-pane fade" id="{{$i}}-content" role="tabpanel" aria-labelledby="pills-profile-tab">
            @foreach($firstassess as $assessments)
              @isset($check_assessment)
                @php
                  $draft_name = $check_assessment[0]->draft;
                  $get_answers = DB::table('app_assessment')->where('uid', '=', $employeeData->uid)->where('asmt_id', '=', $assessments->asmt_id)->where('draft', '=', $draft_name)->first();
                @endphp
              @endisset
            <div class="row">
              <div class="col-sm-4">{{$assessments->asmt_name}}</div>
              <div class="col-sm-2 text-center">
                 <input type="hidden" name="upID[]" value="{{$assessments->asmt_id}}">
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="complied_{{$assessments->asmt_id}}" type="radio" value="1" @isset($get_answers) @if($get_answers->complied=='1') checked="true" @endif @endisset hidden>
                      <label id="radio_{{$assessments->asmt_id}}1" for="complied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 1, '{{$assessments->asmt_id}}')" @isset($get_answers) @if($get_answers->complied=='1') style="background-color:green;" @endif @endisset><i class="fa fa-check"></i></label>
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="notcomplied_{{$assessments->asmt_id}}" type="radio" value="0" @isset($get_answers) @if($get_answers->complied=='0') checked="true" @endif @endisset hidden>
                      <label id="radio_{{$assessments->asmt_id}}2" for="notcomplied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 2, '{{$assessments->asmt_id}}')" @isset($get_answers) @if($get_answers->complied=='0') style="background-color:red;" @endif @endisset><i class="fa fa-times"></i></label>
              </div>
              <div class="col-sm-3"><input type="file" class="file" name="file[]"></div>
              <div class="col-sm-3"><textarea placeholder="Remarks"  name="remarks[]" id="remarks_{{$assessments->asmt_id}}">@isset($get_answers) {{$get_answers->sa_remarks}} @endisset</textarea></div>
            </div>
            @endforeach
          </div>
          @endfor
        </div>
      </form>
          <ul class="nav nav-pills mb-3" id="pills-tab" style="margin-left: 46%;" role="tablist">
           <li class="nav-item">
            <a class="nav-link active" id="1-page" data-toggle="pill" href="#1-content" role="tab" aria-controls="pills-home" aria-selected="true" onclick="check_remark()">Part 1</a>
          </li>
        @for($i=$numbstart;$i <= $numend;$i++)
          <li class="nav-item">
            <a class="nav-link" id="{{$i}}-page" data-toggle="pill" href="#{{$i}}-content" role="tab" aria-controls="pills-home" aria-selected="true" onclick="check_remark()">Part {{$i}}</a>
          </li>
          @endfor
        </ul>
         @isset($result)
         @if($result=='1')
          <div class="text-center"><button form="preform" class="btn btn-success" value= "update" name="submitpre" style="border-radius: 0;">Submit</button>
          @endif
          @else
          <div class="text-center"><button form="preform" class="btn btn-success" value= "0" name="submitpre" style="border-radius: 0;">Submit</button>
         @endisset
        </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  function ch_rdb(id, bool, id2) {
    if(bool == 1) {
      document.getElementById(id+bool).setAttribute('style', 'background-color: green');
      document.getElementById(id+2).setAttribute('style', 'background-color: none');
      document.getElementById('remarks_'+id2).removeAttribute('required');
      document.getElementById('remarks_'+id2).classList.remove('need-remark');
    } else {
      document.getElementById(id+bool).setAttribute('style', 'background-color: red');
      document.getElementById(id+1).setAttribute('style', 'background-color: none');
      document.getElementById('remarks_'+id2).setAttribute('required', 'true');
      document.getElementById('remarks_'+id2).classList.add('need-remark');
    }
  }
    function check_remark(){
      // var wrong = document.getElementById('wrong');
      // var remrks = document.getElementById('remrks');
      // if (wrong.checked == true && remrks.value == '') {
      //   alert('Put remarks, when you have a X mark for this assessment');
      // }
      // var id = document.getElementsByClassName('need-remark');
      // if(id.length> 0) {
      //   alert(id[0].value);
      // }
    }

  </script>
  <script type="text/javascript">
  $('#draftxt').on('input', function(){
    var draftxt = $(this).val();
      $('#savetxt').val(draftxt);
  });
  $('.delbtn').on('click', function(){
    var delval = $(this).attr('id');
    $('#yes').val(delval);
  })
</script>
@include('client.sitemap')
@endsection
