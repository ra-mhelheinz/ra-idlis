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
                        $apptype = DB::table('apptype')->get();
                        $oop = DB::table('orderofpayment')->get();
                        // $chg_app = DB::table('chg_app')->where('chg_code', '=', $charge->chg_code)->get();
                        $appformtry = "SELECT oop_desc, oop_total, apf.status FROM appform_oopdata appo LEFT JOIN appform_orderofpayment apo ON apo.appop_id = appo.appop_id LEFT JOIN appform apf ON apf.appid = apo.appid LEFT JOIN orderofpayment opo ON opo.oop_id = apo.oop_id WHERE apf.uid = '$clientData->uid' AND (apf.status != NULL OR apf.status != '')";
                        $appform = DB::select($appformtry);
                        $tikas = "SELECT appid, ch.chg_desc, ch.chg_exp, ch.chg_rmks, remarks, aat, aap, oop_desc, oop_id, _all.cat_id FROM charges ch LEFT JOIN (SELECT GROUP_CONCAT(amt) AS aat, GROUP_CONCAT(chgapp_id) AS appid, GROUP_CONCAT(aptdesc) AS aap, oop_desc, oop_id, ca.chg_code, cat_id, remarks FROM (SELECT DISTINCT ca.*, ch.cat_id, aptdesc, oop_desc, opo.oop_id FROM chg_app ca LEFT JOIN charges ch ON ch.chg_code = ca.chg_code LEFT JOIN apptype apt ON ca.aptid = apt.aptid LEFT JOIN chg_oop cho ON cho.chgapp_id = ca.chgapp_id LEFT JOIN orderofpayment opo ON opo.oop_id = cho.oop_id INNER JOIN appform ON appform.aptid = ca.aptid) ca GROUP BY oop_desc, oop_id, ca.chg_code, cat_id, remarks ORDER BY ca.chg_code, cat_id) _all ON ch.chg_code = _all.chg_code";
                        $bungkag = DB::select($tikas);
                        // dd($chg_app);
                      @endphp
                      <div class="row">
                        <div class="col-sm-6">
                        <select id="category" class="form-control" onchange="fighting(this.value, document.getElementById('orderofpayment').value)">
                          <option hidden value="maoni">Select Category</option>
                          @foreach($cat as $cate)
                          <option value="{{$cate->cat_id}}">{{$cate->cat_desc}}</option>
                          @endforeach
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <select id="orderofpayment" class="form-control" onchange="fighting(document.getElementById('category').value, this.value)">
                          <option hidden value="maoni">Select Order of Payment</option>
                          @foreach($oop as $oops)
                          <option value="{{$oops->oop_id}}">{{$oops->oop_desc}}</option>
                          @endforeach
                        </select>
                        </div>
                      </div>
                      <br>
                      @php
                      $i = 0;
                      @endphp
                      @for($j = 0; $j < count($bungkag); $j++)
                        <?php $ctout = explode(",", $bungkag[$j]->appid); $aat = explode(",", $bungkag[$j]->aat); $ctout = explode(",", $bungkag[$j]->appid); $aap = explode(",", $bungkag[$j]->aap); ?>
                          <div id="labhi{{$i}}" class="card fightingclass {{$bungkag[$j]->oop_id}}" name="{{$bungkag[$j]->cat_id}}" style="margin-bottom: 2%;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);" hidden>
                          <div class="card-header" style="color: #28a745;cursor:pointer;padding: 0" >
                            <a class="card-link" id="payment_{{$i}}">
                                <div class="row">
                                  <div class="col-sm-10">
                                    <p name="fightingmama{{$i}}" style="margin-bottom: 0;margin-top: 3%;margin-left: 2%;">{{$bungkag[$j]->chg_desc}} {{$bungkag[$j]->remarks}} ({{$bungkag[$j]->chg_exp}} {{$bungkag[$j]->chg_rmks}})</p>
                                  </div>
                                  <div class="col-sm-2" >
                                    <button data-toggle="collapse" data-target="#collapseOne{{$i}}" id="addbtn{{$i}}" onclick="addbtn({{$i}})" class="btn btn-block yamod" style="background-color: #28B463;padding: 19px;font-size: 18px ;border-radius: 0;color: #fff;margin: 0;cursor: pointer;" value="inactive">
                                      <i class="fa fa-plus"></i>
                                    </button> 
                                  </div>
                                </div>
                            </a>
                          </div>
                          <div id="collapseOne{{$i}}" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              <table id=" " class="table" style="width: 100%;">
                                <tr>
                                  <td></td>
                                  <td style="width: 60%;">Order of Payment</td>
                                  <td hidden>Application ID</td>
                                  <td style="width: 20%;" class="text-center">Application Status</td>
                                  <td style="width: 20%;" class="text-center">Amount</td>
                                </tr>
                                @for($k = 0; $k < count($ctout); $k++)
                                  <tr id="bubblyface{{$i}}">
                                    <td><input type="radio" class="radioni" name="radioforchoose{{$i}}" id="radioforchoose{{$i}}{{$k}}"></td>
                                    <td><label for="radioforchoose{{$i}}{{$k}}" name="imongmamaenervon{{$i}}">{{$bungkag[$j]->oop_desc}}</label></td>
                                      <td hidden name="anothermama{{$i}}">{{$ctout[$k]}}</td>
                                      <td class="text-center" name="formama{{$i}}">{{$aap[$k]}}</td>
                                      <td class="text-center">&#8369;<label name="imongmama{{$i}}">{{$aat[$k]}}</label></td>
                                  </tr>
                                @endfor
                              </table>
                              <div class="row">
                                <div class="col-sm-5"></div>
                                 <div class="col-sm-5"></div>
                                 <div class="col-sm-2"><button class="btn btn-success btn-block" id="addsummary{{$i}}" onclick="addsummary({{$i}})" style="border-radius: 0;background-color: #28B463;"><i class="fa fa-plus-circle"></i> Add</button></div>
                               </div>
                            </div>
                          </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                    @endfor
                  </div>

              </div>
              <div class="col-md-4">
                <div class="sticky-top">
                  <div id="asdfsqwqqwewqwee"></div>
                  <div class="card text-white bg-light mb-3" style="border-top: 2px solid #ebda0f;border-radius: 0;box-shadow: 2px 5px 10px rgba(0,0,0,0.25);">
                    <form method="POST" action="{{asset('client/payment')}}">
                      {{csrf_field()}}
                      <div class="card-header text-center" style="color: #28a745;background-color: #fff;">Payment Summary</div>
                      <div class="card-body" id="paymentcont">
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
<script type="text/javascript">
  var asdf = "";
  var intasd;
  // var asdfj = [];
  // var ttlasdf = [];
  // var ttlasdf1 = [];
  // var addsm = [];
  // var foasdf = [];
  var imongmama = [];
  var laingmama = [];

  function addbtn(num){
    asdf = num;
    clearInterval(intasd);
    intasd = setInterval(asdfgh, -1);
  }
  function asdfgh() {
    var a = document.getElementById('addbtn'+asdf);
    var b = document.getElementById('collapseOne'+asdf);
    var content_active = '<i class="fa fa-times"></i>';
    var content_inactive = '<i class="fa fa-plus"></i>';
    var style_active = 'background-color: #ebda0f;padding: 19px;border-radius: 0;color: #28B463;margin: 0;cursor: pointer;';
    var style_inactive = 'background-color: #28B463;padding: 19px;border-radius: 0;color: #fff;font-size: 18px;margin: 0;cursor: pointer;';
    for(var i = 0; i < document.getElementsByClassName('yamod').length; i++){
      document.getElementsByClassName('yamod')[i].innerHTML = content_inactive;
      document.getElementsByClassName('yamod')[i].setAttribute('style', style_inactive);
      document.getElementsByClassName('yamod')[i].value = 'inactive';
    }
    if (!b.classList.contains('show')) {
      a.innerHTML = content_inactive;
      a.setAttribute('style', style_inactive);
      a.value = 'inactive';
    } else {
      a.innerHTML = content_active;
      a.setAttribute('style', style_active);
      a.value = 'active';
    }
  }
  function fighting(fightvalue, anotherfighter) {
    console.log([fightvalue, anotherfighter])
    for(var i = 0; i < document.getElementsByClassName('fightingclass').length; i++){
      document.getElementsByClassName('fightingclass')[i].setAttribute("hidden", true);
    }
    var inti = 0;
    var cont1 = ((fightvalue != "maoni") ? true : false);
    var cont2 = ((anotherfighter != "maoni") ? true : false);
    if(cont1 == true) {
      for(var i = 0; i < document.getElementsByName(fightvalue).length; i++){
        if(cont2 == true) {
          for(var j = 0; j < document.getElementsByClassName(anotherfighter).length; j++){
            if(document.getElementsByClassName(anotherfighter)[j].getAttribute("name") == fightvalue){
              document.getElementsByClassName(anotherfighter)[j].removeAttribute("hidden"); 
            }
          }
        } else {
          document.getElementsByName(fightvalue)[i].removeAttribute("hidden");
        }
      }
    } else {
      if(cont2 == true) {
        for(var i = 0; i < document.getElementsByClassName(anotherfighter).length; i++){
          document.getElementsByClassName(anotherfighter)[i].removeAttribute("hidden");
        }
      } else {
        inti = 1;
      }
    }

    if(inti == 1) {
      for(var i = 0; i < document.getElementsByClassName('fightingclass').length; i++){
        document.getElementsByClassName('fightingclass')[i].removeAttribute("hidden");
      }
    }
  }
  function addsummary(mama){
    for(var i = 0; i < document.getElementsByName('radioforchoose'+mama).length; i++){
      if(document.getElementsByName('radioforchoose'+mama)[i].checked == true) {
        var imongpapa = [document.getElementsByName('anothermama'+mama)[i].textContent, document.getElementsByName('fightingmama'+mama)[i].textContent, document.getElementsByName('imongmamaenervon'+mama)[i].textContent, document.getElementsByName('formama'+mama)[i].textContent, document.getElementsByName('imongmama'+mama)[i].textContent];

        var indOf = laingmama.indexOf(document.getElementsByName('anothermama'+mama)[i].textContent);
        if(indOf > -1) {
          laingmama.splice(indOf, 1, document.getElementsByName('anothermama'+mama)[i].textContent);
          imongmama.splice(indOf, 1, imongpapa);
        } else {
          laingmama.push(document.getElementsByName('anothermama'+mama)[i].textContent);
          imongmama.push(imongpapa);
        }
      }
    }
    imongmamamhelf();
  }

  function imongmamamhelf() {
    document.getElementById('paymentcont').innerHTML = "";
    if(imongmama.length < 1) {
      document.getElementById('paymentcont').innerHTML = '<span style="color: red;">None</span>';
      document.getElementById('zxcasd1').innerHTML = '0';
      document.getElementById('asdfgggg').setAttribute('hidden', true);
    } else {
      var total = 0;
      for(var i = 0; i < imongmama.length; i++){
        document.getElementById('paymentcont').innerHTML += '<button type="button"  class="btn-block text-left" data-toggle="collapse" data-target="#psummary'+i+'" style="border: 0;background-color: #fff;">'+'<small>'+imongmama[i][1]+'</small>'+'<i class="fa fa-angle-down" style="float: right; margin-top: 3px;"></i></button><div id="psummary'+i+'" class="container collapse" style="color: #000;"><small>'+imongmama[i][2]+' '+imongmama[i][3]+' (&#8369;'+imongmama[i][4]+')<input type="hidden" name="desc[]" value="'+imongmama[i][2]+' ('+imongmama[i][1]+')"><input type="hidden" name="amount[]" value="'+imongmama[i][4]+'"></small><i class="fa fa-times-circle" style="color:red; float:right;cursor:pointer;margin-top: 5px;" onclick="del_item('+i+')"></i></div>';
        total = total + parseInt(imongmama[i][4]);
      }
      document.getElementById('zxcasd1').innerHTML = total;
      document.getElementById('asdfgggg').removeAttribute('hidden');
    }
  }

  function del_item(inOf2) {
    laingmama.splice(inOf2, 1);
    imongmama.splice(inOf2, 1);
    imongmamamhelf()
  }
   function asddfasfsfasdfasdf() { if(window.scrollY > 149) { document.getElementById('asdfsqwqqwewqwee').setAttribute("style", "height: 28px;"); } else { document.getElementById('asdfsqwqqwewqwee').setAttribute("style", ""); } }
  window.addEventListener('scroll', asddfasfsfasdfasdf);
  // window.addEventListener('load', asddfasfsfasdfasdf);
  window.addEventListener('load', function(){
    asddfasfsfasdfasdf(); loadallradion();
  });
  function loadallradion() {
    var bol = localStorage.getItem('forradio');
    var j = 0;
    if(bol == undefined || bol == null) { } else { var arrsim = bol.split(','); for(var i = 0; i < arrsim.length; i++) { document.getElementsByClassName('radioni')[arrsim[i]].checked = true; document.getElementsByClassName('radioni')[arrsim[i]].click(); } }
    for(var i = 0; i < document.getElementsByClassName('radioni').length; i++) { if(document.getElementsByClassName('radioni')[i].checked == false){ if(document.getElementsByClassName('radioni')[(i+1)].checked == false) { } else { document.getElementById('addsummary'+j).click(); } } else { document.getElementById('addsummary'+j).click(); } document.getElementsByClassName('radioni')[i].addEventListener('change', newfucn); document.getElementsByClassName('radioni')[(i+1)].addEventListener('change', newfucn); i++; j++; }
  }
  function newfucn() {
    var sadfgag = [];
    for(var i = 0; i < document.getElementsByClassName('radioni').length; i++) { if(document.getElementsByClassName('radioni')[i].checked == false){ if(document.getElementsByClassName('radioni')[(i+1)].checked == false) { } else { sadfgag.push((i+1)); } } else { sadfgag.push(i); } i++; }
      localStorage.setItem('forradio', sadfgag);
  }
</script>
@include('client.sitemap')
 @endsection
