@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
  <input type="text" id="CurrentPage" value="" hidden>
  <script type="text/javascript">Right_GG();</script>
  @if (isset($parts) && isset($asments))
    @foreach ($parts as $part)
     <datalist id="{{$part->partid}}_list">
       @foreach ($asments as $asment)
         @if ($part->partid == $asment->partid)
            <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}" complied="{{$asment->complied}}" fileSelected="" remarks="{{$asment->remarks}}">{{$asment->asmt_name}}</option>
         @endif
       @endforeach
     </datalist>
    @endforeach
  @endif
   {{-- $('#new_rgnid').val() =--}}
 {{-- <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
   @endforeach
 </datalist> --}}
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment 
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
          <div class="container"> 
            <div class="row">
              <div class="col-sm-8"> 
                @if(isset($AppData))
                    <h2>{{$AppData->facilityname}}</h2>
                    <h5>{{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} {{$AppData->zipcode}}</h5>
                    {{-- <h6>Status:@if ($AppData->isInspected === null) <span style="color:blue">For Inspection</span> @elseif($AppData->isInspected == 1)  <span style="color:green">Accepted Inspection</span> @else <span style="color:red">Rejected Inspection</span> @endif</h6> --}}
                    {{-- <select class="form-control">
                    	
                    </select> --}}
                @else
                @endif
              </div>
              <div class="col-sm-4">
                Filter:
                <select class="form-control" id="Filterer" onchange="filterMode()">
                  <option value="0">Show all</option>
                  <option value="1">Complied</option>
                  <option value="2">Not Complied</option>
                </select>
                &nbsp;
                <select class="form-control" id="CatFilterer" onchange="filterByCategory()">
                  <option value="">Select Category ...</option>
                  @isset ($Cats)
                      @foreach ($Cats as $c)
                        <option value="{{$c->caid}}">{{$c->categorydesc}}</option>
                      @endforeach
                  @endisset
                </select>
              </div>
            </div>  
          </div>
          <hr>
          <div class="container">
            <div class="row">
                <div class="col-sm-5 text-center"  style="font-weight: bolder">ASSESSMENT</div>
                <div class="col-sm-2 text-center"  style="font-weight: bolder">USER</div>
                {{-- <div class="col-sm-2 text-center"  style="font-weight: bolder">USER</div> --}}
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-3 text-center" style="font-weight: bolder">REMARKS</div> 
            </div>
          </div>
          <hr>
          <div class="container">
            

      <form id="TESTING" data-parsley-validate>
        <input type="text" id="AppID" value="@isset($appId){{$appId}}@endisset" hidden disabled>        
                @if (isset($Parts) && isset($Assments) && isset($BigData))
                {{-- $i = 0; $i < 10; $i++ --}}
                    @for ($i = 0; $i < count($Parts); $i++)
                    <div class="container text-center"><h3>{{$Parts[$i]->partdesc}}</h3></div>
                    <hr>
                      @for ($j = 0; $j < count($Assments); $j++)
                        @if ($Parts[$i]->partid == $Assments[$j]->partid)
                          @if($Assments[$j]->asmt_id == $BigData[$j]->asmt_id)
              <span class="@if($BigData[$j]->complied == 1) OKCls @else NotOkCls @endif {{$BigData[$j]->caid}}_getCat C2T">  
                        <div class="row {{-- @if($BigData[$j]->complied == 1) OKCls @else NotOkCls @endif --}}" id="app_{{$j}}_div" selectedAppAssId="{{$BigData[$j]->app_assess_id}}" selectedId="{{$Assments[$j]->asmt_id}}">
                            <div class="col-sm-5 text-justify" ><h5>&nbsp;&nbsp;&nbsp;&nbsp;{{$Assments[$j]->asmt_name}}</h5></div> {{-- Assessment --}}
                            <div class="col-sm-2">
                              <center>
                                @isset ($BigData[$j]->complied)
                                  @if ($BigData[$j]->complied == 1)
                                      <button type="button" class="btn btn-outline-success active" disabled><i class="fa fa-check" aria-hidden="true"></i></button>
                                    @else
                                    <button type="button" class="btn btn-outline-danger active" disabled><i class="fa fa-times" aria-hidden="true"></i></button>
                                  @endif                                    
                                @endisset
                              </center>
                            </div>
                            {{-- <div class="col-sm-1">
                              <a @isset($BigData[$j]->fileName)href="{{asset('/file/download')}}/{{$BigData[$j]->fileName}}"@else href="#" disabled @endisset>
                                <button type="button" class="btn btn-outline-primary" @isset($BigData[$j]->fileName) @else disabled @endisset>
                                <i class="fa fa-download" aria-hidden="true"></i>
                              </button>
                              </a>
                            </div> --}}
                            <div class="col-sm-2">
                               <center>
                                <button type="button" id="app_{{$j}}_yes" class="btn btn-outline-success addBTN" onclick="btnClicked(1, {{$j}})"><i class="fa fa-check" aria-hidden="true"></i></button>
                                <button type="button" id="app_{{$j}}_no" class="btn btn-outline-danger" onclick="btnClicked(0, {{$j}})"><i class="fa fa-times" aria-hidden="true"></i></button>
                               </center>
                            </div>
                            <div class="col-sm-3">
                              <center>
                                <textarea id="app_{{$j}}_rmk" rows="3" class="form-control" placeholder="Remarks"></textarea>
                              </center>
                            </div>
                          </div>
                          <br>
                        </span>
                          @endif
                        @endif
                      @endfor
                    @endfor
                @endif
                <hr>
                <center><button type="button" style="background-color:#0ed639" onclick="SubmitNow()" class="btn btn-primarys">Submit</button></center>
      </form>
          </div>
          {{-- <hr>
          <div class="container">
            <center>
              <button class="btn btn-primarys" onclick="window.history.back();">Back</button>
              </button>
            </center> 
          </div> --}}
              {{-- <table class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 40%">ID</th>
                  <th style="width: 35%">Name</th>
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table> --}}
        </div>
    </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New Assessment</strong></h5>
                <hr>
                <div class="container">
                  <form class="row" id="addCls" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="col-sm-4">Part:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <select id="partid" data-parsley-required-message="*<strong>Part</strong> required" class="form-control" required>  
                          <option value="">Select Part ...</option>
                          {{-- @foreach ($parts as $part)
                            <option value="{{$part->partid}}">{{$part->partid}}</option>
                          @endforeach --}}
                      </select>
                    </div>
                    <div class="col-sm-4">ID:</div>
                    <div class="col-sm-8"  style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
                    </div>
                    <div class="col-sm-4">Description:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required>
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
              <h5 class="modal-title text-center"><strong>Edit Assessment</strong></h5>
              <hr>
              <div class="container">
                    <form id="EditNow" data-parsley-validate>
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
      <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Assessment</strong></h5>
              <hr>
              <div class="container">
                <span id="DelModSpan">
                </span>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <script type="text/javascript">
      var CheckedOrNot = [], Remarks = [], GetAsMentId=[], SelectedId = [];
      var numOfAssMents = {{$numOfAssMents}}, test =0, hasNotApproved = 0;
      $(document).ready(function(){
          for (var i = 0; i < numOfAssMents; i++) {
          CheckedOrNot[i] = null;
          Remarks[i] = "";
          GetAsMentId[i] = $('#app_'+i+'_div').attr('selectedId');
        }
      });
      // console.log(CheckedOrNot);
    function btnClicked(YesNo, AssMentID){
      if(YesNo == 1){
        var name1 = '#app_'+AssMentID+'_yes';
        var name2 = '#app_'+AssMentID+'_no';
        var name3 = '#app_'+AssMentID+'_rmk';
        $(name3).removeAttr('required');
        $(name3).removeAttr('data-parsley-required-message');
      } else {
        var name1 = '#app_'+AssMentID+'_no';
        var name2 = '#app_'+AssMentID+'_yes';
        var name3 = '#app_'+AssMentID+'_rmk';
        $(name3).removeAttr('required');
        $(name3).attr('required', '');
        $(name3).removeAttr('data-parsley-required-message');
        $(name3).attr('data-parsley-required-message', "<strong>Remark</strong> required");
      }
      CheckedOrNot[AssMentID] = YesNo;
      // console.log(CheckedOrNot);
      $(name1).addClass('active')
      $(name2).removeClass('active');

    }
    function SubmitNow(){
      // console.log(CheckedOrNot);
      // console.log(Remarks);
      
      for (var i = 0; i < numOfAssMents; i++) {
        Remarks[i] = $('#app_'+i+'_rmk').val();
      }

      for (var i = 0; i < numOfAssMents; i++) {
        SelectedId[i] = $('#app_'+i+'_div').attr('selectedappassid');
      }

      for (var i = 0; i < numOfAssMents; i++) {

        if(CheckedOrNot[i] == 0){
          hasNotApproved = 1;
        }

        if(CheckedOrNot[i] == null) {
          $('#app_'+i+'_yes').focus();
          test = 1;
          break;
        } else {
          test = 0;
        }

        if (CheckedOrNot[i] == 0 && Remarks[i] == ""){
          $('#app_'+i+'_rmk').focus();
          test = 1;
          break;
        } 

      }

        if(test == 0){
            $.ajax({
              // url : 
              method: 'POST',
              data: {
                _token : '{{Session::token()}}',
                chckOrNot : CheckedOrNot,
                num : numOfAssMents,
                rmks : Remarks,
                AsId : GetAsMentId,
                SeldID : SelectedId,
                id : $('#AppID').val(),
                hasNotApproved : hasNotApproved,
              },
              success : function (data){
                if(data == 'DONE'){
                	var id = $('#AppID').val();
                    alert('Successfully Inspected Application');
                    location.href = '{{ asset('/employee/dashboard/lps/assess') }}';
                } else if(data == 'ERROR'){
                    $('#ERROR_MSG2').show(100);
                }
              },
              error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#ERROR_MSG2').show(100);
              },
            });
        }       
      }
      function filterMode(){
        //  OKCls  NotOkCls
          var test = $('#Filterer').val();
          // console.log(test);
          if (test == 0) {
              $('.OKCls').show();
              $('.NotOkCls').show();
              $('.OKCls .NotOkCls').css({'margin':'0 0 0 0'});
              $('.OKCls .NotOkCls').css({'margin':'0 15 0 15'});
          } else if (test == 1) {
              $('.OKCls').show();
              $('.NotOkCls').hide();
              $('.OKCls .NotOkCls').css({'margin':'0 0 0 0'});
              $('.OKCls').css({'margin':'0 15 0 15'});
          } else {
            $('.OKCls').hide();
            $('.NotOkCls').show();
            $('.OKCls .NotOkCls').css({'margin':'0 0 0 0'});
            $('.NotOkCls').css({'margin':'0 15 0 15'});
          }
      }
      function filterByCategory(){
          var selected = $('#CatFilterer').val();
          if (selected != '') {
              $('.C2T').hide();
              $('.'+selected+'_getCat').show();
          } else {
            $('.C2T').show();
          }
      }
    </script>
@endsection