<!DOCTYPE html>
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
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('ra-idlis/public/js/moment.js')}}"></script>
    <script src="{{asset('ra-idlis/public/js/num2words.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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
        opacity: .8;}
        #ERROR_MSG, #ERROR_MSG2{
            position: fixed;
            top: 78px; 
            right:3%;
            width: 36%;
            z-index: 9998;
        }
    </style>
</head>
<body class="bg-light">
    @include('doh.nav')
<script src="{{asset('ra-idlis/public/js/bootadmin.min.js')}}"></script>
@if (session()->has('system_error'))
    <div class="alert alert-danger alert-dismissible fade show" id="ERROR_MSG" role="alert">
        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> has occured. Please contact the system administrator.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    {{-- <script type="text/javascript">$("#ERROR_MSG").fadeOut(6900);</script> --}}
@endif
<div class="alert alert-danger alert-dismissible fade show" style="display: none" id="ERROR_MSG2" role="alert">
        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> has occured. Please contact the system administrator.
            <button type="button" class="close" onclick="$('#ERROR_MSG2').hide(1000);">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@yield('content')
<script type="text/javascript">
$("body").append('<div class="pageloader"></div>');
  $(document).ready(function(){
    $(".pageloader").fadeOut(1000);
  });
</script>
</body>
</html>