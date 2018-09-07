  @extends('main')
@section('content')
@include('client.nav')
<div class="container">@include('client.breadcrumb')</div>
<script type="text/javascript">
      document.getElementById('second').style = "margin:0;border-bottom: 3px solid #f2e20c;";
</script>
<style type="text/css">
  .paymentWrap {
  padding: 50px;
}
.paymentWrap .paymentBtnGroup .paymentMethod {
  padding: 40px;
  box-shadow: none;
  position: relative;
}

.paymentWrap .paymentBtnGroup .paymentMethod.active {
  outline: none !important;
}

.paymentWrap .paymentBtnGroup .paymentMethod.active .method {
  border-color: #4cd264;
  outline: none !important;
  box-shadow: 0px 3px 22px 0px #7b7b7b;
}

.paymentWrap .paymentBtnGroup .paymentMethod .method {
  position: absolute;
  right: 3px;
  top: 3px;
  bottom: 3px;
  left: 3px;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  border: 2px solid transparent;
  transition: all 0.5s;
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.visa {
  background-image: url("{{asset('ra-idlis/public/img/paypal.png')}}");
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.master-card {
  background-image: url("{{asset('ra-idlis/public/img/dragonpay.jpg')}}");
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.amex {
  background-image: url("{{asset('ra-idlis/public/img/ml.jpg')}}");
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.vishwa {
  background-image: url("{{asset('ra-idlis/public/img/landbank.jpg')}}");
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.ez-cash {
  background-image: url("{{asset('ra-idlis/public/img/paypal.png')}}");
}


.paymentWrap .paymentBtnGroup .paymentMethod .method:hover {


  border-color: #4cd264;
  outline: none !important;
}
</style>
@php
  $payment = DB::select("SELECT chgapp_id, chg_desc FROM chg_app ca INNER JOIN charges ch ON ch.chg_code = ca.chg_code WHERE ch.cat_id = 'PMT'");
@endphp
<div class="container">
  <div class="row">
    <div class="col-sm-12" style="margin-top: 5%; margin-bottom: 5%;">
            <div class="headingWrap">
                <a href="{{asset('client/orderofpaymentc')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Back</a><h3 class="headingTop text-center">Select Your Payment Method</h3>  
            </div>
            <div class="paymentWrap">
              <div class="paymentBtnGroup row" data-toggle="buttons">
                <div class="col-sm-2 text-center">
                      <label class="btn paymentMethod active" onclick="pay(1)">
                        <div class="method visa"></div>
                          <input type="radio" name="options" checked> 
                      </label>
                </div>      
                 <div class="col-sm-3 text-center">
                      <label class="btn paymentMethod" onclick="pay(2)">
                        <div class="method master-card"></div>
                          <input type="radio" name="options"> 
                      </label>
                </div> 
                <div class="col-sm-2 text-center">
                      <label class="btn paymentMethod" onclick="pay(3)">
                        <div class="method amex"></div>
                          <input type="radio" name="options">
                      </label>
                </div>
                <div class="col-sm-3 text-center">
                       <label class="btn paymentMethod" onclick="pay(4)">
                        <div class="method vishwa"></div>
                          <input type="radio" name="options"> 
                      </label>
                </div>
                <div class="col-sm-2 text-center">
                      <label class="btn paymentMethod" onclick="pay(5)">
                        <div class="method ez-cash"></div>
                          <input type="radio" name="options"> 
                      </label>
                 </div>  
                </div>        
            </div>
            <div class="row" style="border: 1px solid rgba(0,0,0,.125);padding: 5%;border-radius: 5px;">
              <div class="col-sm-8">
                <div class="card">
                <div class="card-header">
                  <h3 class="text-center">Payment Summary</h3>
                </div>
                @if($_POST && (isset($_POST['desc']) && isset($_POST['amount'])))
                  <table style="width: 100%;" class="table">
                    <tr>
                      <td style="width: 50%;">Charges</td>
                      <td style="width: 50%;" class="text-center">Amount</td>
                    </tr>
                    @php
                      $appform_id = $_POST['appform_id']; $desc = $_POST['desc']; $amount = $_POST['amount']; $total = 0; $hfser_id = $_POST['hfser_id']; $chgapp_id = $_POST['chgapp_id']; $hfser_desc = []; if(isset($hfser_id)) { $hfser_desc = DB::select("SELECT hfser_desc FROM `hfaci_serv_type` WHERE hfser_id = '$hfser_id'"); } else { $hfser_id = [['hfser_desc'=>"No data"]]; }
                    @endphp
                    @for($i = 0; $i < count($amount); $i++)
                      <?php $total = $total + intval($amount[$i]); ?>
                      <tr>
                        <td>{{$desc[$i]}}</td>
                        <td class="text-center">&#8369; {{$amount[$i]}}</td>
                      </tr>
                    @endfor
                    <tr>
                      <td class="text-right"><strong>Total:</strong></td>
                      <td class="text-center">&#8369; {{$total}}</td>
                    </tr>
                    @php
                      array_push($desc, 'PAYMENT'); array_push($amount, ($total*-1)); array_push($chgapp_id, '292');
                      Session::put('desc', $desc); Session::put('amount', $amount); Session::put('chgapp_id', $chgapp_id); Session::put('hfser_desc', $hfser_desc); Session::put('hfser_id', $hfser_id); Session::put('appform_id', $appform_id); 
                    @endphp
                  </table>
                @else
                  <label>No transactions made.</label>
                @endif
              </div>
              </div>
              <div class="col-sm-4 text-center" id="asdf1" class="">
                <div>
                @if($_POST && (isset($_POST['desc']) && isset($_POST['amount'])))
                  <label>Pay using your Paypal Account</label>
                  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    {{csrf_field()}}
                     <input type="hidden" name="cmd" value="_cart">
                     <input type="hidden" name="upload" value="1">
                     <input type="hidden" name="business" value="ra.janpaolocleotes-facilitator@gmail.com">
                     <input TYPE="hidden" NAME="currency_code" value="PHP">
                      @php
                      $x = 1; $y = 1;
                      @endphp
                      @for($j = 0; $j < count($amount); $j++)
                        <input type="hidden" name="item_name_{{$x}}" value="{{$desc[$j]}}">
                        <input type="hidden" name="quantity_{{$x}}" value="1">
                        <input type="hidden" name="shipping_{{$x}}" value="0.00">
                        <input type="hidden" name="amount_{{$y}}" value="{{$amount[$j]}}">
                        <?php $y++; $x++; ?>
                      @endfor
                     {{-- <input type="hidden" name="return" id="return"> --}}
                     <input type="hidden" name="cancel_return" id="cancel_return" value="{{asset('client/payment')}}/{{csrf_token()}}/292">

                     <input type="submit" class="btn btn-info" value="Continue with Paypal">
                 </form>
                @else

                @endif
               </div>
              </div>
              <div class="col-sm-4 text-center" id="asdf2" hidden>
                <label>Pay using your Dragonpay Account</label><br>
                <a href="https://test.dragonpay.ph/GenPay.aspx?merchantid=SAMPLEGEN"><button class="btn btn-info">Continue with Dragonpay</button></a>
              </div>
              <div class="col-sm-4 text-center" id="asdf3" hidden>
               
              </div>
              <div class="col-sm-4 text-center" id="asdf4" hidden>
                <label>LANDBANK</label><br>
                <form method="POST" action="{{asset('client/payment')}}/{{csrf_token()}}/294" enctype="multipart/form-data">
                    {{csrf_field()}}
                  <div class="container">
                    <div class="row">
                      <div class="col-sm-6"><label>Date of Payment:</label></div>
                      <div class="col-sm-6"><input type="date" class="form-control" name="au_date"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">Upload Official Receipt:</div>  
                      <div class="col-sm-6"><input type="file" name="au_file"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6"><label>Reference Number</label></div>
                      <div class="col-sm-6"><input type="text" class="form-control" name="au_ref"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6"><label>Amount:</label></div>
                      <div class="col-sm-6"><input type="number" class="form-control" name="au_amount"></div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info">Continue payment</button>
                </form>
              </div>
              <div class="col-sm-4 text-center" id="asdf5" hidden>
                
              </div>
            </div>
{{--             <div class="footerNavWrap clearfix">
              <div class="btn btn-success pull-left btn-fyi"><span class="glyphicon glyphicon-chevron-left"></span>Back</div>
              <div class="btn btn-success pull-right btn-fyi">Checkout<span class="glyphicon glyphicon-chevron-right"></span></div>
            </div> --}}
          </div>
    
  </div>
</div>
<script type="text/javascript">
  function pay(id){
    var int_b = 6;
    for(var i = 1; i < int_b; i++) {
      if(i == id) {
        document.getElementById('asdf'+i).removeAttribute("hidden");
      } else {
        document.getElementById('asdf'+i).setAttribute("hidden", true);
      }
    }
  }
</script>

@include('client.sitemap')
@endsection