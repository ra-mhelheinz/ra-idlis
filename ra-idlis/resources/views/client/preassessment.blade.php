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
@include('client.breadcrumb')
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
  <form class="form-group">
    <input type="text" name="" class="form-control" style="margin-bottom: 2px;border-radius: 0;">
    <button class="btn btn-success btn-block" style="border-radius: 0;">Save</button>
  </form>
  <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action"><small>Save List</small></a>
  <a href="#" class="list-group-item list-group-item-action"><small></small></a>
  <a href="#" class="list-group-item list-group-item-action"><small></small></a>
  </div>
  </div>
</div>
<div class="jumbotron container" style="margin-top: 2em;box-shadow: 0px 2px 20px rgba(0,0,0,0.2);background-color: #fff;border-radius: 3px 3px 0 0;border-top: 2px solid #28a745;">
    <div class="container">
     
      <h2>{{$clientData->facilityname}}. {{$clientData->streetname}}, {{$clientData->cmname}}</h2>
      <hr>
      <div class="container align-items-center">
        <font size="24px" >Assessment Tool</font>
        {{-- <span style="float:right">
          <div class="btn-group">
            <a href="#"><button type="button"  class="btn-primarys active">Part I</button></a>
            <a href="{{asset('client/inspection2')}}"><button type="button"  class="btn-primarys">Part II</button></a>
            <a href="{{asset('client/inspection3')}}"><button type="button"  class="btn-primarys">Part III</button></a>
          </div>
        </span> --}}
      </div>
      <hr>

      <div id="gg_err" data-spy="scroll" data-offset="0">
         <form method="post" action="{{asset('client/preassessment')}}" id="preform" enctype="multipart/form-data">
        {{ csrf_field() }}
        @foreach($countass as $countasss)
          @php
            $inc = 0;
          @endphp
          <div name="bobonneed" id="{{$countasss->partid}}"></div>
          <div name="assess" id="assess{{$countasss->partid}}">
            <center><h3>
              {{$countasss->partdesc}}
            </h3></center>
            <hr>
            @foreach($assessment as $assessments)
            @if($countasss->partid == $assessments->partid)
              <div class="row" id="err{{$countasss->partid}}_{{$inc}}">
                  <input type="hidden" name="assessments_partID" value="{{$assessments->asmt_id}}">
                  <div class="col-sm-4">
                      <h5 style="text-align: justify;">
                       {{$assessments->asmt_name}}
                      </h5>
                  </div>
                  <div class="col-sm-2 text-center">
                    <input type="hidden" name="upID[]" value="{{$assessments->asmt_id}}">
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="complied_{{$assessments->asmt_id}}" type="radio" value="1" hidden>
                      <label id="radio_{{$assessments->asmt_id}}1" for="complied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 1)"><i class="fa fa-check"></i></label>
                    <input class="radio " name="complied[{{$assessments->asmt_id}}]" id="notcomplied_{{$assessments->asmt_id}}" type="radio" value="0" hidden>
                      <label id="radio_{{$assessments->asmt_id}}2" for="notcomplied_{{$assessments->asmt_id}}" class="label text-center" onclick="ch_rdb('radio_{{$assessments->asmt_id}}', 2)"><i class="fa fa-times"></i></label>
                  </div>
                  <div class="col-3 text-center">
                      <input type="file" class="file" name="file[]">
                                          
                  </div>
                  <div class="col-sm-3 text-center">
                    <textarea placeholder="Remarks" name="remarks[]"></textarea>
                  </div>
              </div>
              <hr>
              @php
                $inc++;
                $inc++;
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
        <button form="preform" onclick="val_req()" class="btn-primarys" type="submit" style="background-color: #228B22 !important" id="submt">Submit <i class="fa fa-send-o"></i></button>
        </div>
      </div> 
</div>
</div>
<script type="text/javascript">
        var str = parseInt(document.getElementsByName('bobonneed')[0].id);
        var end = parseInt(document.getElementsByName('bobonneed')[(document.getElementsByName('bobonneed').length - 1)].id);
        var l = str;
        function next_bob(inc) {
          l = parseInt(l) + parseInt(inc);
          if(document.getElementById('assess'+((l==1)?l:l-1)) != null) {
            var cheat = 0;
            var err_id = "";
            var err_arr = []; 

            // for(var j = 0; j < document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('file').length; j++){
            //   if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('file')[j].value == "") {
            //     cheat++;
            //     if(err_id == "") { err_id = "err"+((l==1)?l:l-1)+"_"+j+""; }
            //     err_arr.push("err"+((l==1)?l:l-1)+"_"+j+"");
            //     if (document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('file')[j].files['length'] > 0) {
            //       if (document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('file')[j].files[0].size >2000000) {
            //         alert("asdf");
            //       }
            //     }
            //   } else {

            //   }
            // }
            for(var j = 0; j < document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio').length; j++){
              if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[j].checked == false) {
                if(document.getElementById('assess'+((l==1)?l:l-1)).getElementsByClassName('radio')[(j+1)].checked == false) {
                  cheat++;
                  if(err_id == "") { err_id = "err"+((l==1)?l:l-1)+"_"+j+""; }
                  err_arr.push("err"+((l==1)?l:l-1)+"_"+j+"");
                } else {

                }
              } else {

              }
              j++;
            }

            if(cheat == 0 || inc == 0) {
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
              } else if(end == l) {
                document.getElementById("btnp").removeAttribute('hidden');
                document.getElementById("btnn").setAttribute('hidden', true);
                document.getElementById("submit_go").removeAttribute('hidden');
              } else {
                document.getElementById("btnp").removeAttribute('hidden');
                document.getElementById("btnn").removeAttribute('hidden');
                document.getElementById("submit_go").setAttribute('hidden', true);
              }
            } else {
              l--;
              document.getElementById('mess_ere').innerHTML = '<p>Complete the required fields</p>';
              var loc = (location.href).split("#")[0];
              var cows = loc + "#"+err_id+"";
              location.href = cows;
              gt_rq1(err_id);
            }
          } else {
            next_bob(inc);
          }
        }
        // function val_req() {
        //    document.getElementById('syd').style.pointerEvents="";
        //   l = parseInt(document.getElementsByName('assess')[document.getElementsByName('assess').length-1].id.split("assess")[1]);
        //   if(document.getElementById('assess'+l) != null) {
        //     var cheat = 0;
        //     var err_id = "";
        //     var err_arr = [];
        //     for(var j = 0; j < document.getElementById('assess'+l).getElementsByClassName('radio').length; j++){
        //       if(document.getElementById('assess'+l).getElementsByClassName('radio')[j].checked == false) {
        //         if(document.getElementById('assess'+l).getElementsByClassName('radio')[(j+1)].checked == false) {
        //           cheat++;
        //           if(err_id == "") { err_id = "err"+l+"_"+j+""; }
        //           err_arr.push("err"+l+"_"+j+"");
        //         } else {

        //         }
        //       } else {

        //       }
        //       j++;
        //     }
        //     for(var j = 0; j < document.getElementById('assess'+l).getElementsByClassName('file').length; j++){
        //       if(document.getElementById('assess'+l).getElementsByClassName('file')[j].value == "") {
        //         cheat++;
        //         if(err_id == "") { err_id = "err"+l+"_"+j+""; }
        //         err_arr.push("err"+l+"_"+j+"");
        //         if (document.getElementById('assess'+l).getElementsByClassName('file')[j].files['length'] > 0) {
        //           if (document.getElementById('assess'+l).getElementsByClassName('file')[j].files[0].size >2000000) {
        //             alert('asdf');
        //           }
        //         }
        //       } else {

        //       }
        //     }

        //     if(cheat == 0 || inc == 0) {
        //       document.getElementById('page_id').innerHTML = l;
        //       document.getElementById('mess_ere').innerHTML = '';
        //       for(var i = 0; i < document.getElementsByName('assess').length; i++) {
        //         if(document.getElementsByName('assess')[i].id == "assess"+l) {
        //           document.getElementsByName('assess')[i].removeAttribute('hidden');
        //         } else {
        //           document.getElementsByName('assess')[i].setAttribute('hidden', true);
        //         }
        //       }

        //       if(str == l) {
        //         document.getElementById("btnp").setAttribute('hidden', true);
        //         document.getElementById("btnn").removeAttribute('hidden');
        //         document.getElementById("submit_go").setAttribute('hidden', true);
        //       } else if(end == l) {
        //         document.getElementById("btnp").removeAttribute('hidden');
        //         document.getElementById("btnn").setAttribute('hidden', true);
        //         document.getElementById("submit_go").removeAttribute('hidden');
        //       } else {
        //         document.getElementById("btnp").removeAttribute('hidden');
        //         document.getElementById("btnn").removeAttribute('hidden');
        //         document.getElementById("submit_go").setAttribute('hidden', true);
        //       }
        //     } else {
        //       l--;
        //       document.getElementById('mess_ere').innerHTML = '<p>Complete the required fields</p>';
        //       var loc = (location.href).split("#")[0];
        //       var cows = loc + "#"+err_id+"";
        //       location.href = cows;
        //       gt_rq1(err_id);
        //     }
        //   } else {
        //     next_bob(inc);
        //   }
        // }
        function gt_rq() {
            var id = (window.location.hash).replace("#", "");
            if(id != null || id != "" ||id != undefined) {
              window.scrollBy(0, -50);
                document.getElementById(id).classList.add("transcolor");
                document.getElementById(id).classList.add("transcolor1");
                setTimeout(function() { document.getElementById(id).classList.add("transcolor2"); setTimeout(function() { document.getElementById(id).classList.remove("transcolor"); document.getElementById(id).classList.remove("transcolor1"); document.getElementById(id).classList.remove("transcolor2"); }, 2000); }, 2000);
            } else {
                gt_rq();
            }
        }
        function gt_rq1(div) {
            var id = div;
            console.log(id);
            if(id != null || id != "" ||id != undefined) {
              window.scrollBy(0, -50);
                document.getElementById(id).classList.add("transcolor");
                document.getElementById(id).classList.add("transcolor1");
                setTimeout(function() { document.getElementById(id).classList.add("transcolor2"); setTimeout(function() { document.getElementById(id).classList.remove("transcolor"); document.getElementById(id).classList.remove("transcolor1"); document.getElementById(id).classList.remove("transcolor2"); }, 2000); }, 2000);
            } else {
                gt_rq();
            }
        }
        next_bob(0);
        gt_rq();
</script>
<script type="text/javascript">
  function ch_rdb(id, bool) {
    if(bool == 1) {
      document.getElementById(id+bool).setAttribute('style', 'background-color: green');
      document.getElementById(id+2).setAttribute('style', 'background-color: none');
      document.getElementsByName(id)[(bool-1)].checked = true;
    } else {
      document.getElementById(id+bool).setAttribute('style', 'background-color: red');
      document.getElementById(id+1).setAttribute('style', 'background-color: none');
      document.getElementsByName(id)[(bool-1)].checked = true;
    }
  }
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
