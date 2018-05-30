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
  padding: 8px 8px 8px 0px;height: 95px;width: auto;float: left;
}
 .img2{
  padding: 8px 8px 8px 0px;height: 95px;width: auto;float: left;
  display: none;
}
 .img3{
  padding: 8px 8px 8px 0px;height: 95px;width: auto;float: left;
}
.republic{
  margin-top: 20px;
  font-family: source code pro bold;line-height: 1px;float: left;
}
.republic h4{
  margin-bottom: 1.5px;
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
   .republic {
    margin: auto;
    text-align: center;
    margin-left: 13%;
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
  .img{
    margin-left: 28%;
  }
}
@media only screen and (max-width: 400px){
  .republic{
    margin-left: 11%;
  }
  .img{
    margin-left: 27%;
  }
}
@media only screen and (max-width: 390px){
   .republic{
    margin-left: 10%;
  }
  .img{
    margin-left: 26%;
  }
}
@media only screen and (max-width: 380px){
   .republic{
    margin-left: 9%;
  }
  .img{
    margin-left: 25%;
  }
}
@media only screen and (max-width: 370px){
   .republic{
    margin-left: 8%;
  }
  .img{
    margin-left: 24%;
  }
}
@media only screen and (max-width: 360px){
   .republic{
    margin-left: 7%;
  }
  .img{
    margin-left: 23%;
  }
}
@media only screen and (max-width: 350px){
   .republic{
    margin-left: 6%;
  }
  .img{
    margin-left: 22%;
  }
}
@media only screen and (max-width: 340px){
   .republic{
    margin-left: 12%;
  }
  .img{
    margin-left: 21%;
  }
}
@media only screen and (max-width: 330px){
  .img{
    margin-left: 20%;
  }
}
@media only screen and (max-width: 320px){
   .republic{
    margin-left: 5%;
  }
  .img{
    margin-left: 19%;
  }
}
@media only screen and (max-width: 310px){
   .republic{
    margin-left: 4%;
  }
  .img{
    margin-left: 18%;
  }
}
@media only screen and (max-width: 300px){
   .republic{
    margin-left: 3%;
  }
  .img{
    margin-left: 17%;
  }
}



	</style>
</head>
<body>
<!-- <div style="background: url('ra-idlis/public/img/color.png') no-repeat;
    background-size: 100% auto; box-shadow: 0px 2px 4px rgba(0,0,0,0.2);"> -->
    <div style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 5px 5px 5px 5px;">
<div class="container" >
  <div class="row">
    <div class="col-md-10">   
      <div class="imgcenter">
        <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img">
        <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img2">
      </div>
      <div class="republic">
        <p style="margin-bottom: 4px;font-size: 13px;">Republic of the Philippines</p>     
        <h4>DEPARTMENT OF HEALTH</h4>
        <p>Kagawaran ng Kalusugan</p>
        <p>ISO 9001:2008 CERTIFIED</p>
      </div>
    </div>
    <div class="col-md-2">
       <img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="img3">
    </div>
  </div>
</div>
</div>
	@yield('content')
	<div class="fixed-bottom" style="background:transparent;width:30%;float: left;margin-left: 72%;border-radius: 5px 5px 0 0">
	<div style="padding: 3px;">
		<img width="100%" src="{{asset('ra-idlis/public/img/slogan.png')}}">
	</div>
</div>
<!-- <footer style="background: url('ra-idlis/public/img/color.png') no-repeat;
    background-size: 100% auto; box-shadow: 0px 2px 4px rgba(0,0,0,0.2);padding:2% 2% 2% 2%;">
 -->      
<footer style=" background: linear-gradient(to bottom left,#228B22, #84bd82);padding:1% 1% 1% 1%;"">
 <div class="container">
        <p class="m-0 text-center" style="color: #fff;font-size: 15px;">DOH Licensing and Regulatory System &copy; 2018</p>
      </div>
      <!-- /.container -->
</footer>
</body>
</html>