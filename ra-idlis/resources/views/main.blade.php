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
     <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/fa.css')}}">
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


/************************************************************
*************************Footer******************************
*************************************************************/
.footer1 {
    background: #fff url("../images/footer/footer-bg.png") repeat scroll left top;
  padding-top: 40px;
  padding-right: 0;
  padding-bottom: 20px;
  padding-left: 0;/*  border-top-width: 4px;
  border-top-style: solid;
  border-top-color: #003;*/
}



.title-widget {
  color: #898989;
  font-size: 20px;
  font-weight: 300;
  line-height: 1;
  position: relative;
  text-transform: uppercase;
  font-family: 'Fjalla One', sans-serif;
  margin-top: 0;
  margin-right: 0;
  margin-bottom: 25px;
  margin-left: 0;
  padding-left: 28px;
}

.title-widget::before {
    background-color: #ea5644;
    content: "";
    height: 22px;
    left: 0px;
    position: absolute;
    top: -2px;
    width: 5px;
}



.widget_nav_menu ul {
    list-style: outside none none;
    padding-left: 0;
}

.widget_archive ul li {
    background-color: rgba(0, 0, 0, 0.3);
    content: "";
    height: 3px;
    left: 0;
    position: absolute;
    top: 7px;
    width: 3px;
}


.widget_nav_menu ul li {
    font-size: 13px;
    font-weight: 700;
    line-height: 20px;
  position: relative;
    text-transform: uppercase;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 7px;
    padding-bottom: 7px;
  width:95%;
}



.title-median {
    color: #636363;
    font-size: 20px;
    line-height: 20px;
    margin: 0 0 15px;
    text-transform: uppercase;
  font-family: 'Fjalla One', sans-serif;
}

.footerp p {font-family: 'Gudea', sans-serif; }


#social:hover {
          -webkit-transform:scale(1.1); 
-moz-transform:scale(1.1); 
-o-transform:scale(1.1); 
      }
      #social {
        -webkit-transform:scale(0.8);
                /* Browser Variations: */
-moz-transform:scale(0.8);
-o-transform:scale(0.8); 
-webkit-transition-duration: 0.5s; 
-moz-transition-duration: 0.5s;
-o-transition-duration: 0.5s;
      }           
/* 
    Only Needed in Multi-Coloured Variation 
                                               */
      .social-fb:hover {
        color: #3B5998;
      }
      .social-tw:hover {
        color: #4099FF;
      }
      .social-gp:hover {
        color: #d34836;
      }
      .social-em:hover {
        color: #f39c12;
      }
      .nomargin { margin:0px; padding:0px;}





.footer-bottom {
   background: linear-gradient(to bottom left,#228B22, #84bd82);
    min-height: 30px;
    width: 100%;
}
.copyright {
    color: #fff;
    line-height: 30px;
    min-height: 30px;
    padding: 7px 0;
}
.design {
    color: #fff;
    line-height: 30px;
    min-height: 30px;
    padding: 7px 0;
    text-align: right;
}
.design a {
    color: #fff;
}


/************************************************************
*************************Footer******************************
*************************************************************/
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
<hr>
<div id="paraTago"> 
<div class="footer-bottom">

  <div class="container">

    <div class="row">

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

        <div class="copyright">

          © 2017, RIGHTAPPS, All rights reserved

        </div>

      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

        <div class="design">

           <a href="#">Department of Health  </a> |  <a target="_blank" href="http://www.webenlance.com">Web Design & Development by RIGHTAPPS</a>

        </div>

      </div>

    </div>

  </div>

</div>
</div>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5Eq93e_E7Jjj6aGqhUATjFnzXecUk5Hc&libraries=places&callback=initMap"
    async defer></script>
<script type="text/javascript" src="{{asset('ra-idlis/public/js/intro.js')}}">
  // introJs().start();
</script>

</body>
</html>