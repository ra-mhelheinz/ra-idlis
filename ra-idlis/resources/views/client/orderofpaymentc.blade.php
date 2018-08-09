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
@php 
$paymentstart = 1; $paymentend = 5;
@endphp
@include('client.breadcrumb')
<script type="text/javascript">
  document.getElementById('second').style = "color: blue;";
</script>
<div class="container-fluid">
  <div class="jumbotron" style="background-color: #fff;">
    <div class="row">
            <div class="col-md-8">
                <div id="accordion">
                      @php
                      $i = 0;
                      @endphp
                      @php
                        $asdf = "";
                        $asdf1 = "";
                        $cat = DB::table('category')->get();
                        // $chg_app = DB::table('chg_app')->where('chg_code', '=', $charge->chg_code)->get();
                        $tikas = "SELECT appid, ch.chg_desc, aat, aap, _all.cat_id FROM charges ch LEFT JOIN (SELECT GROUP_CONCAT(amt) AS aat, GROUP_CONCAT(chgapp_id) AS appid, GROUP_CONCAT(aptid) AS aap, ca.chg_code, cat_id FROM (SELECT DISTINCT ca.*, ch.cat_id FROM chg_app ca LEFT JOIN charges ch ON ch.chg_code = ca.chg_code GROUP BY chgapp_id, chg_code, amt, aptid, cat_id, remarks) ca GROUP BY ca.chg_code, cat_id ORDER BY aptid, ca.chg_code, cat_id) _all ON ch.chg_code = _all.chg_code";
                        $bungkag = DB::select($tikas);
                        // dd($chg_app);
                      @endphp
                      <select id="category" class="form-control">
                        @foreach($cat as $cate)
                        <option value="{{$cate->cat_id}}">{{$cate->cat_desc}}</option>
                        @endforeach
                      </select>
                      <br>
                          <div class="card" style="margin-bottom: 2%;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);">
                          <div class="card-header" data-toggle="collapse" data-target="#collapseOne{{$i}}" style="color: #28a745;cursor:pointer;" >
                            <a class="card-link" id="payment_{{$i}}">
                                 Sample <i class="fa fa-question-circle"></i>
                            </a>
                          </div>
                          <div id="collapseOne{{$i}}" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              
                             
                            </div>
                          </div>
                        </div>
                  </div>
              </div>
              <div class="col-md-4">
                <div class="sticky-top">
                  <div id="asdfsqwqqwewqwee"></div>
                  <div class="card text-white bg-light mb-3" style="border-top: 2px solid #ebda0f;border-radius: 0;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);">
                    <form method="POST" action="{{asset('client/payment')}}">
                      {{csrf_field()}}
                      <div class="card-header text-center" style="color: #28a745;background-color: #fff;">Payment Summary</div>
                      <div class="card-body" id="zxcasd">
                        <span style="color: red;">None</span>
                      </div>
                      <div class="card-footer">
                        <span style="color: black; padding: .375rem .75rem;">Total &#8369;<label id="zxcasd1" style="padding: .375rem;">0</label>

                          <button id="asdfgggg" type="submit" style="background-color: #ebda0f;border-top-right-radius : 5px;border-top-left-radius : 5px;border-radius: 0;padding: .375rem .75rem; border: 1px solid transparent; float: right;" hidden>Continue <i class="fa fa-angle-right"></i>
                            </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
      </div>
    </div>
  </div>

  {{--     <div class="card" style="margin-bottom: 2%;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);">
        <div class="card-header"  style="color: #28a745;cursor:pointer;padding: 0" >
          <a class="card-link" id="payment_{{$i}}">
            <div class="row">
              <div class="col-sm-10">
                <label style="margin-bottom: 0;margin-top: 3%;margin-left: 3%;">{{$charge->chg_desc}} <i class="fa fa-question-circle"></i></label>
              </div>
              <div class="col-sm-2" >
                <button data-toggle="collapse" data-target="#collapseOne{{$i}}" id="addbtn{{$i}}" onclick="addbtn({{$i}})" class="btn btn-block yamod" style="background-color: #28B463;padding: 19px;font-size: 18px ;border-radius: 0;color: #fff;margin: 0;cursor: pointer;" value="inactive">
                  <i class="fa fa-plus"></i>
                </button> 
                <button data-toggle="collapse" id="closebtn{{$i}}" onclick="closebtn({{$i}})" data-target="#collapseOne{{$i}}" class="btn btn-block" style="background-color: #ebda0f;padding: 19px;border-radius: 0;color: #fff;display: none;" >
                 
                </button> 
              </div>
            </div>

          </a>
        </div>
        <div id="collapseOne{{$i}}" class="collapse" data-parent="#accordion">
          <div class="card-body">
           <table style="width: 100%;" class="table">
             <tr>
               <td>Facility Name</td>
               <td>Registration Fee</td>
               <td>Amount</td>
             </tr>
             @foreach($chg_app as $indv_chg)
             <tr>
               <td>{{$charge->chg_desc}}</td>
               <td>
                <input type="radio" class="radioni" id="initialval{{$indv_chg->chgapp_id}}" name="contact{{$indv_chg->chgapp_id}}" value="@if($indv_chg->aptid == 'I') {{$indv_chg->amt}} @endif" onclick="bagonasad(this.value, 'amount{{$indv_chg->chgapp_id}}')"><label for="initialval{{$indv_chg->chgapp_id}}">Initial(@if($indv_chg->aptid == 'I'){{$indv_chg->amt}}@endif)</label>
                <input type="radio" class="radioni" id="renewalval{{$indv_chg->chgapp_id}}" name="contact{{$indv_chg->chgapp_id}}" value="@if($indv_chg->aptid == 'R'){{$indv_chg->amt}}@endif" onclick="bagonasad(this.value, 'amount{{$indv_chg->chgapp_id}}')"><label for="renewalval{{$indv_chg->chgapp_id}}">Renewal(@if($indv_chg->aptid == 'R'){{$indv_chg->amt}}@endif)</label>
               <td>&#8369;<label id="amount{{$indv_chg->chgapp_id}}">0</label></td>
               @php
               $asdf = "amount".$indv_chg->chgapp_id;
               $asdf1 = "contact".$indv_chg->chgapp_id;
               @endphp
             </tr>
             @endforeach
           </table>
           <div class="row">
            <div class="col-sm-5"></div>
             <div class="col-sm-5"></div>
             <div class="col-sm-2"><button class="btn btn-success btn-block" id="addsummary{{$i}}" onclick="addsummary('{{$charge->chg_desc}}', '{{$asdf1}}', {{ $chg_app }}, this.id)" style="border-radius: 0;background-color: #28B463;"><i class="fa fa-plus-circle"></i> Add</button></div>
           </div>
          </div>
        </div>
      </div> --}}

{{--   <div class="col-md-4">
    <div class="sticky-top">
      <div id="asdfsqwqqwewqwee"></div>
      <div class="card text-white bg-light mb-3" style="border-top: 2px solid #ebda0f;border-radius: 0;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);">
        <form method="POST" action="{{asset('client/payment')}}">
          {{csrf_field()}}
          <div class="card-header text-center" style="color: #28a745;background-color: #fff;">Payment Summary</div>
          <div class="card-body" id="zxcasd">
            <span style="color: red;">None</span>
          </div>
          <div class="card-footer">
            <span style="color: black; padding: .375rem .75rem;">Total &#8369;<label id="zxcasd1" style="padding: .375rem;">0</label>

              <button id="asdfgggg" type="submit" style="background-color: #ebda0f;border-top-right-radius : 5px;border-top-left-radius : 5px;border-radius: 0;padding: .375rem .75rem; border: 1px solid transparent; float: right;" hidden>Continue <i class="fa fa-angle-right"></i>
                </button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
<script type="text/javascript">
  // var asdf = "";
  // var intasd;
  // var asdfj = [];
  // var ttlasdf = [];
  // var ttlasdf1 = [];
  // var addsm = [];
  // var foasdf = [];

  // function addbtn(num){
  //   asdf = num;
  //   clearInterval(intasd);
  //   intasd = setInterval(asdfgh, -1);
  // }
  // function asdfgh() {
  //   var a = document.getElementById('addbtn'+asdf);
  //   var b = document.getElementById('collapseOne'+asdf);
  //   var content_active = '<i class="fa fa-times"></i>';
  //   var content_inactive = '<i class="fa fa-plus"></i>';
  //   var style_active = 'background-color: #ebda0f;padding: 19px;border-radius: 0;color: #28B463;margin: 0;cursor: pointer;';
  //   var style_inactive = 'background-color: #28B463;padding: 19px;border-radius: 0;color: #fff;font-size: 18px;margin: 0;cursor: pointer;';
  //   for(var i = 0; i < document.getElementsByClassName('yamod').length; i++){
  //     document.getElementsByClassName('yamod')[i].innerHTML = content_inactive;
  //     document.getElementsByClassName('yamod')[i].setAttribute('style', style_inactive);
  //     document.getElementsByClassName('yamod')[i].value = 'inactive';
  //   }
  //   if (!b.classList.contains('show')) {
  //     a.innerHTML = content_inactive;
  //     a.setAttribute('style', style_inactive);
  //     a.value = 'inactive';
  //   } else {
  //     a.innerHTML = content_active;
  //     a.setAttribute('style', style_active);
  //     a.value = 'active';
  //   }
  // }
  // function bagonasad(val, div) {
  //   document.getElementById(div).innerHTML = val;
  // }
  // function atoecheck(tl, qwe, div, thatid, idasd){
  //   var inOf2 = ttlasdf.indexOf(tl);
  //   if(inOf2 > -1) {
  //     ttlasdf.splice(inOf2, 1, tl);
  //     ttlasdf1.splice(inOf2, 1, qwe);
  //     asdfj.splice(inOf2, 1, div[0]);
  //     addsm.splice(inOf2, 1, thatid);
  //   } else {
  //     ttlasdf.push(tl);
  //     ttlasdf1.push(qwe);
  //     asdfj.push(div[0]);
  //     addsm.push(thatid);
  //   }
  //   document.getElementById('zxcasd').innerHTML = '';
  //   var intsadf = 0;
  //   document.getElementById('asdfgggg').setAttribute('hidden', 'true');
  //   for(var i = 0; i < ttlasdf.length; i++) {
  //     var j = -1;
  //     for(var k = 0; k < document.getElementsByName(ttlasdf1[i]).length; k++){
  //       if(document.getElementsByName(ttlasdf1[i])[k].checked == true) {
  //         j = k;
  //       }
  //     }
  //     document.getElementById('zxcasd').innerHTML += '<button type="button" class="btn-block text-left" data-toggle="collapse" data-target="#psummary'+i+'" style="border: 0;background-color: #fff;">'+ttlasdf[i]+'<i class="fa fa-angle-down" style="float: right;    margin-top: 3px;"></i></button><div id="psummary'+i+'" class="container collapse" style="color: #000;">'+((j == 0) ? 'Initial: (&#8369;'+asdfj[i]["initial"]+')' : ((j > 0) ? 'Renewal: (&#8369;'+asdfj[i]["renewal"]+')' : 'Amount: (&#8369;'+asdfj[i]["amt"]+')'))+'<input type="hidden" name="amount[]" value="'+((j == 0) ? asdfj[i]["initial"] : ((j > 0) ? asdfj[i]["renewal"] : asdfj[i]["amt"]))+'"><input type="hidden" name="desc[]" value="'+ttlasdf[i]+'"><i class="fa fa-times-circle" style="color:red; float:right;cursor:pointer;" onclick="del_item('+i+')"></i></div>';

  //     intsadf = intsadf + parseInt(((j == 0) ? asdfj[i]["initial"] : ((j > 0) ? asdfj[i]["renewal"] : asdfj[i]["amt"])));
  //   }
  //   document.getElementById('zxcasd1').innerHTML = intsadf;
  //   document.getElementById('asdfgggg').removeAttribute('hidden');
  //   document.getElementById(thatid).innerHTML = '<i class="fa fa-check"></i> Added';
  // }
  // function  addsummary(tl, qwe, div, thatid){
  //   var dd = document.getElementsByName('contact'+div[0]['chgapp_id']);
  //   if(dd[0].checked == false) {
  //     if(dd[1].checked == false){
  //       alert("Select 1");
  //     } else {
  //       atoecheck(tl, qwe, div, thatid, 1);
  //     }
  //   } else {
  //     atoecheck(tl, qwe, div, thatid, 0);
  //   }
  // }
  // function del_item(inOf2) {
  //   for(var i = 0; i < addsm.length; i++) { document.getElementById(addsm[i]).innerHTML = '<i class="fa fa-plus-circle"></i> Add'; }
  //   ttlasdf.splice(inOf2, 1);
  //   ttlasdf1.splice(inOf2, 1);
  //   asdfj.splice(inOf2, 1);
  //   addsm.splice(inOf2, 1);
  //   document.getElementById('zxcasd').innerHTML = '';
  //   var intsadf = 0;
  //   document.getElementById('asdfgggg').setAttribute('hidden', 'true');
  //   for(var i = 0; i < ttlasdf.length; i++) {
  //     var j = -1;
  //     for(var k = 0; k < document.getElementsByName(ttlasdf1[i]).length; k++){
  //       if(document.getElementsByName(ttlasdf1[i])[k].checked == true) {
  //         j = k;
  //       }
  //     }
  //     document.getElementById('zxcasd').innerHTML += '<button type="button"  class="btn-block text-left" data-toggle="collapse" data-target="#psummary'+i+'" style="border: 0;background-color: #fff;">'+ttlasdf[i]+'<i class="fa fa-angle-down" style="float: right;    margin-top: 3px;"></i></button><div id="psummary'+i+'" class="container collapse" style="color: #000;">'+((j == 0) ? 'Initial: (&#8369;'+asdfj[i]["initial"]+')' : ((j > 0) ? 'Renewal: (&#8369;'+asdfj[i]["renewal"]+')' : 'Amount: (&#8369;'+asdfj[i]["amt"]+')'))+'<input type="hidden" name="amount[]" value="'+((j == 0) ? asdfj[i]["initial"] : ((j > 0) ? asdfj[i]["renewal"] : asdfj[i]["amt"]))+'"><input type="hidden" name="desc[]" value="'+ttlasdf[i]+'"><i class="fa fa-times-circle" style="color:red; float:right;cursor:pointer;" onclick="del_item('+i+')"></i></div>';
  //     document.getElementById(addsm[i]).innerHTML = '<i class="fa fa-check"></i> Added';
  //     intsadf = intsadf + parseInt(((j == 0) ? asdfj[i]["initial"] : ((j > 0) ? asdfj[i]["renewal"] : asdfj[i]["amt"])));
  //     document.getElementById('asdfgggg').removeAttribute('hidden');
  //   }
  //   document.getElementById('zxcasd1').innerHTML = intsadf;
  // }
  // function asddfasfsfasdfasdf() { if(window.scrollY > 149) { document.getElementById('asdfsqwqqwewqwee').setAttribute("style", "height: 28px;"); } else { document.getElementById('asdfsqwqqwewqwee').setAttribute("style", ""); } }
  // window.addEventListener('scroll', asddfasfsfasdfasdf);
  // // window.addEventListener('load', asddfasfsfasdfasdf);
  // window.addEventListener('load', function(){
  //   asddfasfsfasdfasdf(); loadallradion();
  // });
  // function loadallradion() {
  //   var bol = localStorage.getItem('forradio');
  //   var j = 0;
  //   if(bol == undefined || bol == null) { } else { var arrsim = bol.split(','); for(var i = 0; i < arrsim.length; i++) { document.getElementsByClassName('radioni')[arrsim[i]].checked = true; document.getElementsByClassName('radioni')[arrsim[i]].click(); } }
  //   for(var i = 0; i < document.getElementsByClassName('radioni').length; i++) { if(document.getElementsByClassName('radioni')[i].checked == false){ if(document.getElementsByClassName('radioni')[(i+1)].checked == false) { } else { document.getElementById('addsummary'+j).click(); } } else { document.getElementById('addsummary'+j).click(); } document.getElementsByClassName('radioni')[i].addEventListener('change', newfucn); document.getElementsByClassName('radioni')[(i+1)].addEventListener('change', newfucn); i++; j++; }
  // }
  // function newfucn() {
  //   var sadfgag = [];
  //   for(var i = 0; i < document.getElementsByClassName('radioni').length; i++) { if(document.getElementsByClassName('radioni')[i].checked == false){ if(document.getElementsByClassName('radioni')[(i+1)].checked == false) { } else { sadfgag.push((i+1)); } } else { sadfgag.push(i); } i++; }
  //     localStorage.setItem('forradio', sadfgag);
  // }
</script>
@include('client.sitemap')
 @endsection
