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
.isHidden {
  display: none; /* hide radio buttons */
}

.label {
  display: inline-block;
  background-color: #fff;
  /*width: 50px;
  height: 25px;*/
  padding: 5px 10px;
}
        .transcolor {
            background-color: white;
            -webkit-transition: background-color 2s ease-out;
            -moz-transition: background-color 2s ease-out;
            -o-transition: background-color 2s ease-out;
            transition: background-color 2s ease-out;
        }
        .transcolor1 {
            background-color: #eadada;
        }
        .transcolor2 {
            background-color: white;
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

/*.radio:checked + .label {    target next sibling (+) label 
  background-color: green;
}*/
</style>
{{-- <script type="text/javascript">
  $(function(){
    var fileInput = $('.upload-file');
    var maxSize = fileInput.data('max-size');
    $('.upload-form').submit(function(e){
        if(fileInput.get(0).files.length){
            var fileSize = fileInput.get(0).files[0].size; // in bytes
            if(fileSize>maxSize){
                alert('file size is more than ' + maxSize + ' bytes');
                return false;
            }else{
                alert('file size is correct - '+fileSize+' bytes');
            }
        }else{
            alert('Please select the file to upload');
            return false;
        }

    });
});
</script> --}}
{{--   <div style="position: fixed;   right: 0; z-index: 999999;">
    <form class="form-inline">
      <div class="input-group" >
        <input type="text" class="form-control" name="" placeholder="Save Name" style="border-radius: 3px 0 0 3px;border-right: none;">
     <div class="input-group-text" style="border-radius: 0 3px 3px 0;">
      <a href="#"><div><i class="fa fa-save"></i></div></a>
     </div>
     </div>
    </form>

  </div> --}}

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
@if($isview == false) 
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
  </script>
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
            <a href="{{asset('client/preassessment/draft')}}/{{$app_assessments->draft}}" style="font-size: 15px;margin-left: -20px;">{{$app_assessments->draft}} ({{$app_assessments->sa_tdate}})
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
@endif
@if(session()->has('draft_success'))
<div id="asdf" class="alert alert-{{session()->has('alert-type')}} alert-dismissible fade show" role="alert">
            <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('draft_success')}}</center>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
@endif
{{-- @if(session()->has('error_submit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <center><strong><i class="fas fa-exclamation"></i></strong> {{session()->get('error_submit')}}</center>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
@endif --}}
<?php $assessment_clear = $assessment; $newUrl = ""; ?>
@if(count($userAssessment) > 0) <?php $assessment_clear = $userAssessment; $newUrl = "/complied"; ?> @else <?php $assessment_clear = $assessment; $newUrl = ""; ?> @endif @isset($drafts) <?php $newUrl = '/draft/'.$drafts; ?> @endisset
<div class="jumbotron container" style="margin-top: 2em;box-shadow: 0px 2px 20px rgba(0,0,0,0.2);background-color: #fff;border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;">
    <div class="container">
     
      <h2>{{$clientData->facilityname}}. {{$clientData->streetname}}, {{$clientData->cmname}}</h2>
      <hr>
      <div class="container">
        <font size="24px" >Assessment Tool</font>
        @if(count($userAssessment) > 0) 
          @if($iscomplied == true)
            <span style="float:right">
              <div class="btn-group">
                <button onclick="filtCom(1)" type="button" class="btn btn-success"><i class="fa fa-check"></i> Complied</button>
                <button onclick="filtCom(0)" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Not Complied</button>
              </div>
            </span>
          @endif
        @endif
      </div>
      <hr>

      <div id="gg_err" data-spy="scroll" data-offset="0">
      <form @if($isview == false)  method="post" action="{{asset('client/preassessment')}}{{$newUrl}}" id="preform" enctype="multipart/form-data" @endif>
        <input type="hidden" name="savetxt" id="savetxt">
        {{ csrf_field() }}
        <input type="hidden" name="isstatus" @isset($status) value="update" @else value @endisset>
        <input type="hidden" id="isdraft" name="isdraft" @isset($drafts) value="{{$drafts}}" @else value="0" @endisset>
        @foreach($countass as $countasss)
          @php
            $inc = 0;
          @endphp
          <div name="bobonneed" id="{{$countasss->partid}}"></div>
          <div name="assess" id="assess{{$countasss->partid}}">
            <center><h3>
              {{$countasss->partdesc}}
            </h3></center>
            <br>
            @foreach($assessment_clear as $assessments)
              @if($countasss->partid == $assessments->partid)
                <div class="row oncomplied" id="err{{$countasss->partid}}_{{$inc}}" @if(count($userAssessment) > 0) @if($iscomplied == true) name="oncomplied_{{$assessments->complied}}" @endif @endif>
                  <hr>
                    <input type="hidden" name="assessments_partID" value="{{$assessments->asmt_id}}">
                    <div class="col-sm-4">
                        <h5 style="text-align: justify;">
                         {{$assessments->asmt_name}}
                        </h5>
                    </div>

                    <div name="forerr_1" class="col-sm-4 text-center forerr_1">
                      <input type="hidden" name="upID[]" value="{{$assessments->asmt_id}}">
                      <input type="hidden" name="complied[{{$assessments->asmt_id}}]" value="">
                      <input id="radio_{{$assessments->asmt_id}}0" class="radio" name="complied[{{$assessments->asmt_id}}]" id="complied_{{$assessments->asmt_id}}" type="radio" value="1"  @if(count($userAssessment) > 0) @if($assessments->complied == '1') checked @endif @endif hidden>
                        <label id="label_{{$assessments->asmt_id}}1" for="complied_{{$assessments->asmt_id}}" class="label text-center" @if($isview == false) onclick="ch_rdb('{{$assessments->asmt_id}}', 1)" @endif><i class="fa fa-check"></i></label>
                      <input id="radio_{{$assessments->asmt_id}}1" class="radio" name="complied[{{$assessments->asmt_id}}]" id="notcomplied_{{$assessments->asmt_id}}" type="radio" value="0"  @if(count($userAssessment) > 0) @if($assessments->complied == '0') checked @endif @endif hidden>
                        <label id="label_{{$assessments->asmt_id}}2" for="notcomplied_{{$assessments->asmt_id}}" class="label text-center" @if($isview == false) onclick="ch_rdb('{{$assessments->asmt_id}}', 2)" @endif><i class="fa fa-times"></i></label>
                    </div>
                 {{--    <div name="forerr_2" class="col-sm-3 text-center forerr_2">
                      @if($isview == false)
                        @if(count($userAssessment) > 0)
                          @if($assessments->fileName != null)
                            <input class="typefile" type="hidden" name="file[{{$assessments->asmt_id}}]" value="uploaded"> 
                            <span class="badge badge-light"><i class="fa fa-exclamation-circle"></i> File Uploaded</span>
                          @else
                          	<input type="hidden" name="file[{{$assessments->asmt_id}}]" value=""> 
                          	<input class="typefile" type="file" name="file[{{$assessments->asmt_id}}]">                           	
                          @endif
                        @else
                          <input type="hidden" name="file[{{$assessments->asmt_id}}]" value=""> 
                          <input class="typefile" type="file" name="file[{{$assessments->asmt_id}}]"> 
                        @endif
                      @else
                        @if(count($userAssessment) > 0)
                          @if($assessments->fileName != null)
                            @if($assessments->isapproved != null)
                              @if($assessments->isapproved < 1)
                                <span class="badge badge-danger">File Not Approved</span>
                              @else
                                <span class="badge badge-success">File Approved</span>
                              @endif
                            @else
                              <span class="badge badge-warning">File Pending for Approval</span>
                            @endif
                          @else
                            <span class="badge badge-dark">No file uploaded <i class="fa fa-exclamation-circle"></i></span>
                          @endif
                        @endif
                      @endif
                    </div> --}}
                    <div name="forerr_3" class="col-sm-4 text-center forerr_3">
                      @if($isview == false)
                        <textarea class="textarea" @if(count($userAssessment) > 0 && $assessments->sa_remarks != "") placeholder="{{$assessments->sa_remarks}}" @else placeholder="Remarks" @endif name="remarks[{{$assessments->asmt_id}}]" id="remarks_{{$assessments->asmt_id}}"></textarea>
                        @if(count($userAssessment) > 0 && $assessments->sa_remarks != "")
                        @endif
                      @else
                        <span class="badge badge-success">{{$assessments->sa_remarks}}</span>
                      @endif
                    </div>
                  <hr>
                </div>
                @php
                  $inc++; $inc++;
                @endphp
              @endif
            @endforeach
          </div>
        @endforeach
      </form>
      </div>
      <div class="text-center">
      <div id="mess_ere"></div>
      <button class="btn-primarys" style="background-color: #228B22 !important" id="btnp" onclick="next_bob(-1)"><i class="fa fa-backward"></i></button>
      <button class="btn-primarys" style="background-color: #228B22 !important"><span id="page_id"></span></button>
      <button class="btn-primarys" style="background-color: #228B22 !important" id="btnn" onclick="next_bob(1)"><i class="fa fa-forward"></i></button>
      </div>
      <div id="submit_go" hidden>
        <br>
        <div class="text-center">
        <div id="mess_ere"></div>
        @if($isview == false) <button onclick="val_req()" class="btn-primarys" type="submit" value="0" name="submitpre" style="background-color: #228B22 !important" id="submt">Submit <i class="fa fa-send-o"></i></button> @endif
        </div>
      </div> 
</div>
</div>
<script type="text/javascript">
  $('#draftxt').on('input', function(){
    var draftxt = $(this).val();
      $('#savetxt').val(draftxt);
      $('#isdraft').val(draftxt);
  });
  $('.delbtn').on('click', function(){
    var delval = $(this).attr('id');
    $('#yes').val(delval);
  })
</script>
<script type="text/javascript">
        var arrEy = [];
        var str = parseInt(document.getElementsByName('bobonneed')[0].id);
        var end = parseInt(document.getElementsByName('bobonneed')[(document.getElementsByName('bobonneed').length - 1)].id);
        var l = str;
        function next_bob(inc) {
          l = parseInt(l) + parseInt(inc);
          if(document.getElementById('assess'+((l==1)?l:l-1)) != null) {
            var cheat = 0;
            var err_id = "";
            var err_arr = []; 
            var errCount = 0;
            var newtikas = 0;
            for(var j = 0; j < document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('typefile').length; j++) {
              console.log(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('typefile').length);
              if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[newtikas] != undefined) {
                if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[newtikas].checked == false) {
                  if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[(newtikas + 1)] != undefined) {
                    if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[(newtikas + 1)].checked == false) {
                      cheat++;
                      if(err_id == "") { err_id = "err"+((l==1)?l:l-1)+"_"+newtikas+""; }
                    } else {
                      if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('textarea')[j].value == "") {
                        cheat++;
                        if(err_id == "") { err_id = "err"+((l==1)?l:l-1)+"_"+newtikas+""; }
                      }
                    }
                  }
                } else {
                  if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('typefile')[j].value == "") {
                    cheat++;
                    if(err_id == "") { err_id = "err"+((l==1)?l:l-1)+"_"+newtikas+""; }
                  }
                }
              }
              newtikas++; newtikas++;
            }
            if(cheat == 0 || inc == 0) {
              window.scrollTo({ top: (document.getElementsByClassName('jumbotron')[0].offsetTop), behavior: "smooth" });
              document.getElementById('page_id').innerHTML = l;
              document.getElementById('mess_ere').innerHTML = '';
              for(var i = 0; i < document.getElementsByName('assess').length; i++) {
                if(document.getElementsByName('assess')[i].id == "assess"+l) {
                  document.getElementsByName('assess')[i].removeAttribute('hidden');
                } else {
                  document.getElementsByName('assess')[i].setAttribute('hidden', true);
                }
              }

              if(str == l) {
                document.getElementById("btnp").setAttribute('hidden', true);
                document.getElementById("btnn").removeAttribute('hidden');
                document.getElementById("submit_go").setAttribute('hidden', true);
                @if($isview == false) document.getElementById("submt").removeAttribute('form'); @endif
              } else if(end == l) {
                document.getElementById("btnp").removeAttribute('hidden');
                document.getElementById("btnn").setAttribute('hidden', true);
                document.getElementById("submit_go").removeAttribute('hidden');
                // document.getElementById("submt").setAttribute('form', 'preform');
                @if($isview == false) document.getElementById("submt").removeAttribute('form'); @endif
              } else {
                document.getElementById("btnp").removeAttribute('hidden');
                document.getElementById("btnn").removeAttribute('hidden');
                document.getElementById("submit_go").setAttribute('hidden', true);
                @if($isview == false) document.getElementById("submt").removeAttribute('form'); @endif
              }
            } else {
              l--;
              document.getElementById('mess_ere').innerHTML = '<p>Complete the required fields</p>';
              // var loc = (location.href).split("#")[0];
              // var cows = loc + "#"+err_id+"";
              // location.href = cows;
              gt_rq1(err_id);
            }
          } else {
            next_bob(inc);
          }
        }
        function val_req() {
          //  document.getElementById('syd').style.pointerEvents="";
          // l = parseInt(document.getElementsByName('assess')[document.getElementsByName('assess').length-1].id.split("assess")[1]);
          if(document.getElementById('assess'+end) != null) {
            var cheat = 0;
            var err_id = "";
            var err_arr = [];
            var newtikas = 0;
            for(var j = 0; j < document.getElementById('assess'+end).getElementsByClassName('typefile').length; j++) {
              if(document.getElementById('assess'+end).getElementsByClassName('radio')[newtikas] != undefined) {
                if(document.getElementById('assess'+end).getElementsByClassName('radio')[newtikas].checked == false) {
                  if(document.getElementById('assess'+end).getElementsByClassName('radio')[(newtikas + 1)] != undefined) {
                    if(document.getElementById('assess'+end).getElementsByClassName('radio')[(newtikas + 1)].checked == false) {
                      cheat++;
                      if(err_id == "") { err_id = "err"+end+"_"+newtikas+""; }
                    } else {
                      if(document.getElementById('assess'+end).getElementsByClassName('textarea')[j].value == "") {
                        cheat++;
                        if(err_id == "") { err_id = "err"+end+"_"+newtikas+""; }
                      }
                    }
                  }
                } else {
                  if(document.getElementById('assess'+end).getElementsByClassName('typefile')[j].value == "") {
                    cheat++;
                    if(err_id == "") { err_id = "err"+end+"_"+newtikas+""; }
                  }
                }
              }
              newtikas++; newtikas++;
            }
            if(cheat == 0) {
              document.getElementById("btnp").removeAttribute('hidden');
              document.getElementById("btnn").setAttribute('hidden', true);
              document.getElementById("submit_go").removeAttribute('hidden');
              @if($isview == false)
                document.getElementById("submt").setAttribute('form', 'preform');
                document.getElementById("submt").click();
              @endif
            } else {
              // l--;
              document.getElementById('mess_ere').innerHTML = '<p>Complete the required fields</p>';
              // var loc = (location.href).split("#")[0];
              // var cows = loc + "#"+err_id+"";
              // location.href = cows;
              gt_rq1(err_id);
            }
          }
        }
        function gt_rq() {
            // var id = (window.location.hash).replace("#", "");
            if(id != null || id != "" ||id != undefined) {
              window.scrollTo({ top: (document.getElementById(id).offsetTop - 20), behavior: "smooth" });
                document.getElementById(id).classList.add("transcolor");
                document.getElementById(id).classList.add("transcolor1");
                setTimeout(function() { document.getElementById(id).classList.add("transcolor2"); setTimeout(function() { document.getElementById(id).classList.remove("transcolor"); document.getElementById(id).classList.remove("transcolor1"); document.getElementById(id).classList.remove("transcolor2"); }, 2000); }, 2000);
            } else {
                gt_rq();
            }
        }
        function gt_rq1(div) {
            var id = div;
            if(id != null || id != "" ||id != undefined) {
              window.scrollTo({ top: (document.getElementById(id).offsetTop - 20), behavior: "smooth" });
                document.getElementById(id).classList.add("transcolor");
                document.getElementById(id).classList.add("transcolor1");
                setTimeout(function() { document.getElementById(id).classList.add("transcolor2"); setTimeout(function() { document.getElementById(id).classList.remove("transcolor"); document.getElementById(id).classList.remove("transcolor1"); document.getElementById(id).classList.remove("transcolor2"); }, 2000); }, 2000);
            } else {
                gt_rq1(id);
            }
        }
        function anotherClr(){
          document.getElementById('isdraft').value="0";
          // val_req();
        }
        function filtCom(indOf) {
          for(var i = 0; i < document.getElementsByClassName('oncomplied').length; i++) {
            document.getElementsByClassName('oncomplied')[i].setAttribute('hidden', true);
          }
          // console.log('oncomplied_'+indOf);
          for(var i = 0; i < document.getElementsByName('oncomplied_'+indOf).length; i++) {
            document.getElementsByName('oncomplied_'+indOf)[i].removeAttribute('hidden');
          }
        }
        @if(count($userAssessment) > 0) @if($iscomplied == true) filtCom(1); @endif @endif

        @if($isview == false) document.getElementById('submt').addEventListener('mouseover', anotherClr); @endif
        next_bob(0);
        // if((window.location.hash).replace("#", "") != "") {
        //   gt_rq();
        // }
</script>
<script type="text/javascript">
  function ch_rdb(id, bool) {
    if(bool == 1) {
      document.getElementById('label_'+id+bool).setAttribute('style', 'background-color: green');
      document.getElementById('label_'+id+2).setAttribute('style', 'background-color: none');
      // document.getElementsByName(id)[(bool-1)].checked = true;
      document.getElementById('radio_'+id+'0').checked = true;
      @if($isview == false)
        document.getElementById('remarks_'+id).setAttribute('hidden', true);
        document.getElementById('remarks_'+id).value = "ok";
      @endif
    } else {
      document.getElementById('label_'+id+bool).setAttribute('style', 'background-color: red');
      document.getElementById('label_'+id+1).setAttribute('style', 'background-color: none');
      // document.getElementsByName(id)[(bool-1)].checked = true;
      document.getElementById('radio_'+id+'1').checked = true;
      @if($isview == false)
        document.getElementById('remarks_'+id).removeAttribute('hidden');
        document.getElementById('remarks_'+id).value = "";
      @endif
    }
  }
  function remLd() { 
    setTimeout(function(){ $('#asdf').fadeOut(500); }, 3000);
  };
  function cleanInputs() {
    for(var i = 0; i < document.getElementsByClassName('typefile').length; i++) {
      document.getElementsByClassName('radio')[i].checked=false;
      // document.getElementsByClassName('typefile')[i].value="";
      document.getElementsByClassName('textarea')[i].value="";
    }
  }
  cleanInputs();
  remLd();
  @foreach($assessment_clear as $assessments)
  @if(count($userAssessment) > 0) @if($assessments->complied == '1') ch_rdb('{{$assessments->asmt_id}}', 1); @else ch_rdb('{{$assessments->asmt_id}}', 2); document.getElementById('remarks_{{$assessments->asmt_id}}').value = "{{$assessments->sa_remarks}}"; @endif @endif
  @endforeach
</script>
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #0f8845;
          color: white;">
{{--               <h5 class="modal-title text-center" id="exampleModalLongTitle"><strong>Thank You for uploading your requirements.</strong></h5>
              <hr> --}}
              <h5>You have completed the pre-assessment, you may now start to apply and filling up the application form.</h5>
                <div class="alert alert-primary" role="alert">
              <p class="alert-heading"><i class="far fa-sticky-note"></i> Note:</p>
              <p>&nbsp;- Step 1: Fill-in application form and submit requirements</p>
              <p>&nbsp;- Step 2: DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
              <p>&nbsp;- Step 3: DOH will conduct inspection and notify the status of your application.</p>
              <p>&nbsp;- Step 4: You can now print your application online.</p>
            </div>
            <div class="text-center" style="margin-top: 3%;">
              <button class="btn btn-outline-success btn-block" data-dismiss="modal" >Ok</button>
            </div>
            </div>
          </div>
        </div>
</div>
@include('client.sitemap')
@endsection
