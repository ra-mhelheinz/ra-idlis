<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <title>Department of Health | Integrated DOH Licensing Information System</title>
	 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/parsley.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/introjs.css')}}">
    @yield('style')
    <script type="text/javascript">
      function loader(bool) {
        if(bool) {
          $('body').append("<div id='pageload'></div>");
        } else {
          $('#pageload').fadeOut(1000);
        }
      }
    </script>
</head>
<style type="text/css">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
#pageload {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("{{asset('ra-idlis/public/img/greenload.gif')}}") center no-repeat #fff;
}
</style>
<body>
  @if(session()->exists('client_data'))
  @else
      <div class="back">
        <div class="container" >
          <div class="row">
            <div class="col-md-10">   
              <div class="imgcenter">
                <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img">
                <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img2">
              </div>
              <div class="republic">
                    <p><small>Republic of the Philippines</small></p>    
                    <p  style="margin-top: -10px;font-size: 18px;font-weight: 600">DEPARTMENT OF HEALTH</p>
                    <p  style="margin-top: -10px;">Kagawaran ng Kalusugan</p>
                    <p  style="margin-top: -10px;">ISO 9001:2008 CERTIFIED</p>
                  </div>
            </div>
            <div class="col-md-2">
               <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img3">
            </div>
          </div>
        </div>
        </div>
  @endif
	@yield('content')
	<div class="fixed-bottom">
	<div>
		<img src="{{asset('ra-idlis/public/img/slogan.png')}}" class="slogan" >
	</div>
</div>
<div id="paraTago"> 
<footer style=" background: linear-gradient(to bottom left,#228B22, #84bd82);padding:1% 1% 1% 1%;">
 <div class="container">
        <p class="m-0 text-center" style="color: #fff;font-size: 15px;">DOH Licensing and Regulatory System &copy; 2018</p>
      </div>
      <!-- /.container -->
</footer>
</div>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5Eq93e_E7Jjj6aGqhUATjFnzXecUk5Hc&libraries=places&callback=initMap"
    async defer></script>
<script type="text/javascript" src="{{asset('ra-idlis/public/js/intro.js')}}">
  // introJs().start();
</script>

</body>
</html>