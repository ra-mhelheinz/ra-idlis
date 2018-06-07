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
  <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/parsley.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
	 @yield('style')
	<style type="text/css">
		  @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300);
body{
    font: 16px/26px "Raleway", sans-serif; 
}
.img{
    height: 95px;padding: 8px 8px 8px 0px;width: auto;float: left;
}

 .img2{
  padding: 8px 8px 8px 0px;height: 95px;width: auto;float: left;
  display: none;
}
 .img3{
  display: none;
  padding: 8px 8px 8px 0px;height: 95px;width: auto;float: left;
}
.republic{
    font-size: 0.765625rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding:  10px;
}
.republic > p{
  margin: 0;
}
@media only screen and (max-height: 600px) and (max-height: 500px ) and (max-height: 421px ) {
   div .img {
       width: auto;
    }
}
@media only screen and (max-width: 770px){
  .img3{
    display: none;
  }
}
@media only screen and (max-width: 470px ) {
  .img{
    margin-left: 28%;
  }
   .republic {
    margin: auto;
    text-align: center;
  }
     .img3 {
    display: none;
  }
  .img2{
    display: block;
  }
  .imgcenter{
    width: 100%;
    overflow: auto;
  }
}
@media only screen and (max-width: 460px){
  .img {
  margin-left: 27%;
}
}
@media only screen and (max-width: 450px){
  .img {
  margin-left: 26%;
}
}
@media only screen and (max-width: 440px){
  .img {
  margin-left: 25%;
}
}

@media only screen and (max-width: 360px){
  .img {
  margin-left: 24%;
}
}


	</style>
</head>
<body>
  @if(session()->exists('client_data'))
  @else

      <div style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 5px 5px 5px 5px;">
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
	<div class="fixed-bottom" style="background:transparent;border-radius: 5px 5px 0 0">
	<div>
		<img src="{{asset('ra-idlis/public/img/slogan.png')}}" style="width: 400px;float:right;" >
	</div>
</div>
<!-- <footer style="background: url('ra-idlis/public/img/color.png') no-repeat;
    background-size: 100% auto; box-shadow: 0px 2px 4px rgba(0,0,0,0.2);padding:2% 2% 2% 2%;">
 -->      
<footer style=" background: linear-gradient(to bottom left,#228B22, #84bd82);padding:1% 1% 1% 1%;">
 <div class="container">
        <p class="m-0 text-center" style="color: #fff;font-size: 15px;">DOH Licensing and Regulatory System &copy; 2018</p>
      </div>
      <!-- /.container -->
</footer>
</body>
</html>