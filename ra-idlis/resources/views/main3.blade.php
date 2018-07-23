<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <script src="{{asset('ra-idlis/public/js/moment.js')}}"></script>
    <script src="{{asset('ra-idlis/public/js/num2words.js')}}"></script>
    <title>Dashboard | DOH</title>
    @yield('style')
        <style type="text/css">
      .pageloader {
position: fixed;
left: 0px;
top: 0px;
width: 100%;
height: 100%;
z-index: 9999;
background: url('{{asset("ra-idlis/public/img/pageloader.gif")}}') 50% 50% no-repeat rgb(249,249,249);
opacity: .8;
    </style>
</head>
<body class="bg-light">
    @include('doh.nav')
    @yield('content')
<script src="{{asset('ra-idlis/public/js/bootadmin.min.js')}}"></script>
</body>
<script type="text/javascript">
$("body").append('<div class="pageloader"></div>');
  $(document).ready(function(){
    $(".pageloader").fadeOut(1000);
  });
</script>
</html>