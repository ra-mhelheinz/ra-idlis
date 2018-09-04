@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           View Failed Application
           <button class="float-right btn btn-primarys" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
          <thead>
            <tr>
              <td width="100%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                <h6>@isset($AppData) Status: @if ($AppData->isApprove === null) <span style="color:blue">For Approval</span> @elseif($AppData->isApprove == 1)  <span style="color:green">Approve Application</span> @else <span style="color:red">Rejected Application</span> @endif @endisset</h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="container">
        {{--  --}}
        <div class="accordion" id="accordionExample">
          {{-- PRE-ASSESSMENT --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($PreAss) list-group-item-success @else list-group-item-danger @endisset" id="headingzero" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($PreAss) list-group-item-success @else list-group-item-danger @endisset" type="button" style="text-decoration:none">
                  <h3>Pre-Assessment</h3>
                </button>
              </div>
            </div>
            {{-- END HEAD --}}
            {{-- START BODY --}}
            <div id="collapseZero"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">Already Taken</span>@else<span style="color:red;font-weight: bolder">Not yet taken</span>@endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">{{$PreAss->formattedDate}}</span>@else<span style="color:red;font-weight: bolder">Not Available</span>@endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">{{$PreAss->formattedTime}}</span>@else<span style="color:red;font-weight: bolder">Not Available</span>@endisset</td>
                          </tr>
                        </tbody>
                      </table>
                      {{-- <div class="row">
                        <div class="col-sm-5">Status :</div>
                        <div class="col-sm-7">Status</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">Date :</div>
                        <div class="col-sm-7">Status</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">Time :</div>
                        <div class="col-sm-7">Status</div>
                      </div>   --}}
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @if(isset($PreAss) && isset($AppData))
                      <button class="btn btn-primarys" onclick="window.location.href='{{asset('/employee/dashboard/lps/preassessment/')}}/{{$AppData->uid}}'"><i class="fa fa-eye" aria-hidden="true"></i><span>&nbsp;View Pre-Assessment</span></button>
                      @else
                      &nbsp;
                      @endif($PreAss)
                    </center>
                  </div>
                </div>
              </div>
            </div>
          {{-- END BODY --}}
          </div>
          {{-- PRE-ASSESSMENT --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isrecommended == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isrecommended == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseOne"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            {{-- @isset($PreAss)<span style="color:green;font-weight: bolder">Already Taken</span>@else<span style="color:red;font-weight: bolder">Not yet taken</span>@endisset --}}
                            <td>@isset($AppData) @if($AppData->isrecommended == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($AppData->isrecommended == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Rejected Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedEvalDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedEvalTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->Evaluator) <span style="color:green;font-weight: bolder">{{$AppData->Evaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isrecommended != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/lps/evaluate') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Evaluation</button>
                        @else
                        &nbsp;
                        @endif
                        @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Assessment</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseTwo"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isInspected == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->isInspected == 1)<span style="color:green;font-weight: bolder">Accepted Assessment</span>@else<span style="color:red;font-weight: bolder">Rejected Assessment</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedAssessDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedAssessDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedAssessTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedAssessTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->Assessor) <span style="color:green;font-weight: bolder">{{$AppData->Assessor}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table> 
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isInspected != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{asset('/employee/dashboard/lps/assess')}}/{{$AppData->appid}}/view'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Assessment</button>
                          @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Payment Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isPayEval == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isPayEval == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Rejected Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedPayEvalTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedPayEvalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedPayEvalDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedPayEvalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->PayEvaluator) <span style="color:green;font-weight: bolder">{{$AppData->PayEvaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isPayEval != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/lps/cashier') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Payment Evaluation</button>
                        @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          </div>
        </div>
        {{--  --}}
      </div>
      </div>
    </div>
        </div>
    </div>
@endsection