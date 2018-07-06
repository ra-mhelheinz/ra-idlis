@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Evaluation
        </div>
        <div class="card-body">
            <table class="table table-borderless">
          <thead>
            <tr>
              <td width="80%">
                <h2>{{$AppData->facilityname}}</h2>
                <h5>{{$AppData->streetname}}, {{$AppData->brgyname}}, {{$AppData->cmname}}, {{$AppData->provname}}</h5>
              </td>
              <td width="5%"></td>
              <td width="15%">
                <center><h4>DOH</h4>
                  <h4>Evaluation</h4></center>
              </td>
            </tr>
          </thead>
          <tbody>
            <form id="EvalForm" data-parsley-validate>
            <input type="text" name="TotalNumber" value="{{count($UploadData)}}" hidden>
            @foreach ($UploadData as $UpData) 
              <tr>
              <td >
                <font>
                  {{$UpData->updesc}}
                </font>
              </td>
              <td>
                <center>
                  <a href="{{ route('DownloadFile', $UpData->filepath) }}">
                  <button type="button" class="btn-primarys">
                    <i class="fa fa-download" aria-hidden="true"></i>
                  </button>
                  </a>
                </center>
              </td>
              <td>
                <center>
                  
                  <button type="button" id="appdow_{{$UpData->apup_id}}" data-toggle="modal" data-target="#TestModal" class="btn btn-success app_id_{{$UpData->appid}}" onclick="showModalForEvaluate(1)">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </button>
                  <button type="button" data-toggle="modal" data-target="#TestModal" class="btn btn-danger" onclick="showModalForEvaluate(0)">
                    <i class="fa fa-times" aria-hidden="true"></i>
                  </button>
                </center>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
                     <div class="row">
          <div class="col-sm-6" >
              <label>Recommended for Inspection?</label>
              <!-- data-toggle="modal" data-target="#exampleModalCenter" -->
        <a href="#" data-toggle="modal" data-target="#modalins"><button class="btn-primarys">Yes</button></a>
        <button class="btn-defaults">No</button>
          </div>  
          <div class="col-sm-6">
            <span>
              <label class="form-inline">Proposed Date of Inspection:&nbsp;
              <input type="date" name="" class="form-control"></label>
            </span>
            </form>
          </div>    
        </div>
        </div>
    </div>
        </div>
    </div>
    {{-- TestModal --}}
     <div class="modal fade" id="TestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title text-center"><strong>Evaluate</strong></h5>
                <hr>
                <div class="container">
                  <div id="TestModalBody">
                    
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-4" style="font-weight: bold">
                      Remarks:
                    </div>
                    <div class="col-sm-8">
                      <textarea class="form-group" rows="4" style="max-width: 100%"></textarea>
                    </div>
                  </div>
                  </div>
                <hr>
                  <div class="row">
                        <div class="col-sm-2">
                      </div>
                      <div class="col-sm-4">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Confirm</button>
                      </div> 
                      <div class="col-sm-4">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                  </div>
              </div>
            </div>
        </div>
     </div>
    <div class="modal fade" id="modalins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
                <table  class="showConfirm">
                <td><h5>Are you sure you want to confirm?</h5></td>
                <td><button type="button" class="btn-primarys showConfirm" onclick="showNow()">Yes</button></td>
                <td><button type="button" class="btn-defaults showConfirm" data-dismiss="modal">No</button></td>
               </table>
       <div class="showHospit" style="display: none"><h5>Since YES you will proceed to Order of Payment.</h5>
        <ul>
          <ol><a href="{{asset('headorderofpayment')}}">Hospital Based Private</a></ol>
          <ol><a href="{{asset('headorderofpayment2')}}">Hospital Based Government</a></ol>
          <ol><a href="{{asset('headorderofpayment3')}}">Non-Hospital based other Health Facilities</a></ol>
          <ol><a href="{{asset('headorderofpayment4')}}">Certificate of Need/Permit to Construct </a></ol>
          <ol><a href="{{asset('headorderofpayment5')}}">Dental Laboratory</a></ol>
          <ol><a href="{{asset('headorderofpayment6')}}">Non-Hospital Based with Ancillary</a></ol>
       </ul>
       <div class="text-center"><button type="button" class="btn btn-warning showHospit" data-dismiss="modal" style="display:none" onclick="showNow2()">Cancel</button></div>
       </div>
               
      </div>
      <script type="text/javascript">
        function showNow(){
          $('.showHospit').show();
          $('.showConfirm').hide();
        }
        function showNow2(){
          $('.showConfirm').show();
          $('.showHospit').hide();
        }
        function showModalForEvaluate(YesNo){
          $('#TestModalBody').empty();
          if (YesNo == 0) { // NO
              
          } else { // YES

          }
        }
      </script>
    </div>
  </div>
</div>
@endsection