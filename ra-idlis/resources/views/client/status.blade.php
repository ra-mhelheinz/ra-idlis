@extends('main')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/service.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/engine1/style.css')}}" />
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/jquery.js')}}"></script>
@section('content')
<style type="text/css">

  input[type=file]{
    width:90px;
    color:transparent;
}
</style>
@include('client.nav')
<div class="container jumbotron" style="background-color: #fff;">
  <div id="accordion">
    <p>List of Application</p>
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
          <div class="row">
          <div class="col-sm-10">
          Application 1
          </div>
          <div class="col-sm-2 text-right" style="margin-top: 5px;"><i class="fa fa-chevron-down"></i></div>
        </div>
        </a>
      </div>
      <div id="collapseOne" class="collapse" data-parent="#accordion">
        <div class="cardb" style="padding: 2%;">
          <div class="row">
            <div class="col-sm-2">Application Type:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Date Applied:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Date Evaluated:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Date Inspected:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Date Issued:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Date Printed:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Status:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">LTO No:</div>
            <div class="col-sm-10"></div>
             <div class="col-sm-2">Validity Date:</div>
            <div class="col-sm-10"></div>
          </div>
          <div class="card-footer text-center">
            <div><input type='file' title="Choose a video please" id="aa" onchange="pressed()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="fileLabel">Upload OR</label></div>
            <br>
            <button class="btn btn-outline-success">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  window.pressed = function(){
    var a = document.getElementById('aa');
    if(a.value == "")
    {
        fileLabel.innerHTML = "Choose file";
    }
    else
    {
        var theSplit = a.value.split('\\');
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};
</script>
  @include('client.sitemap')
@endsection