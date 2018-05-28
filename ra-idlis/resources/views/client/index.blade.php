@extends('main')
@section('style')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/service.css')}}">
@endsection
<style type="text/css">
    .carousel-inner img {
      width: 100%;
      height: 50%;
  }
/*  .divani {
    margin-top: 5%;
   z-index: 2;
    position: absolute;
    animation: mymove 3s;
    animation-iteration-count: 1;
        animation-fill-mode: forwards;
}
@-webkit-keyframes mymove {
    from {left: 0px;}
    to {left: 270px;}
}

@keyframes mymove {
    from {left: 0px;}
    to {left: 270px;}
}*/
</style>
@section('content')
@include('client.nav')

  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">        
        <!-- Modal body -->
        <div class="modal-body">
          Need a guide for first-time visitors?
          <button class="btn btn-outline-success">Yes</button><button class="btn btn-outline-danger" data-dismiss="modal">No</button>
        </div>
        
      </div>
    </div>
  </div>
<script type="text/javascript">
  $('#myModal').modal('toggle');
  // alert();
</script>
<div class="container-fluid"> 
    <div class="row" style="z-index:1;">
      <div class="col-sm-12">
    <!--     <div id="mainMouse" class="divani" onclick="asdf()"> <img id="asdf1" src="https://upload.wikimedia.org/wikipedia/commons/3/39/Pointing_hand_cursor_vector.svg" class="img" style="width:45px;" hidden> <img id="asdf2" src="http://www.pngmart.com/files/3/Cursor-Arrow-PNG-Picture.png" style="width:15px;" class="img2"> </div>
        <script type="text/javascript">
          setTimeout(function() {
            if(document.getElementById('mainMouse').offsetLeft == 270) {
              document.getElementById('asdf1').removeAttribute('hidden');
              document.getElementById('asdf2').setAttribute('hidden', true);
            }
            // document.getElementsByClassName('box')[0].setAttribute('id', 'extraFunction');
            $('.row .col-lg-6:first-child').attr('id','extraFunction');
          }, 3000);
        </script> -->
        <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-6  animated">
            <div class="box wow fadeInLeft" id="textSample">
              <div class="icon"><i class="fa fa-edit"></i></div>
              <h4 class="title"><a href="{{asset('apply')}}">Step 1. Apply</a></h4>
              <p class="description">Fill-in application form and submit requirements online.</p>
            </div>
          </div>

          <div class="col-lg-6 slideInRight animated">
            <div class="box wow fadeInRight">
              <div class="icon"><i class="fa fa-check"></i></div>
              <h4 class="title"><a href="{{asset('evaluate')}}">Step 2. Evaluate</a></h4>
              <p class="description">DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
              <p><a href="{{asset('evaluate')}}">View your evaluation status</a></p>
            </div>
          </div>

          <div class="col-lg-6 slideInLeft animated">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-search"></i></div>
              <h4 class="title"><a href="{{asset('inspection')}}">Step 3. Inspection</a></h4>
              <p class="description">DOH will conduct inspection and notify the status of your application.</p>
            </div>
          </div>

          <div class="col-lg-6 slideInRight animated">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-print"></i></div>
              <h4 class="title"><a href="{{asset('issuance')}}">Step 4. Issuance</a></h4>
              <p class="description">You can now print your application online.</p>
              <p>Issuance Status:<font style="color:orange;">PENDING</font> </p>
            </div>
          </div>

        </div>

      </div>
    </section>
   </div>
         <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <div class="text-center">
        <img src="{{asset('ra-idlis/public/img/FAQ.png')}}">
        </div>
    <main role="main">
      <div id="demo" class="carousel slide" data-ride="carousel" style="border-radius: 3px;">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('ra-idlis/public/img/slider/slide1.png')}}" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide1</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide2.png')}}" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide2</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide3.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide3</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide4.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide4</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide5.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide5</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide6.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide6</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide7.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide7</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide8.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide8</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="{{asset('ra-idlis/public/img/slider/slide9.png')}}" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Slide9</h3>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
    </main>
      </div>
      <div class="col-sm-2"></div>
  </div>
 <center><hr style="width:75%;"></center>
      <div class="container" style="width:30%;">
    <div class="row">
      <div class="col-md-3">
        <img src="{{asset('ra-idlis/public/img/nosmoking.png')}}" width="50" height="60">
      </div>
      <div class="col-md-3">
         <img src="{{asset('ra-idlis/public/img/nogift.PNG')}}"  width="50" height="60">
      </div>
      <div class="col-md-3">
        <img src="{{asset('ra-idlis/public/img/fix.PNG')}}"  width="50" height="60">
      </div>
      <div class="col-md-3">
         <img src="{{asset('ra-idlis/public/img/nobreak.jpg')}}"  width="125" height="60">
      </div>
    </div>
    </div>
  </div>
@endsection