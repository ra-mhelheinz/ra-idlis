@extends('main')
@section('style')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/login.css')}}">
@endsection
@section('content')
	<div class="form-wrapss" style="width: 420px !important;">
 				<div class="text-center" style="background-color: #e6e7e8;">
					<h3 style="padding: 20px;">Login</h3>
				</div>
 					<div class="tabss-content">
			<div id="login-tab-content" class="active">
				<form class="login-form" action="{{asset('/employeelogin')}}" method="post">
					{{ csrf_field()}}
					@if (session()->has('dohUser_login'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('dohUser_login')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					@if (session()->has('dohUser_logout'))
					<div class="alert alert-info alert-dismissible fade show" role="alert">
					  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('dohUser_logout')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
					<input type="text" class="input form-control" id="user_login" name="uname" autocomplete="off" placeholder="Username" value="{{old('uname')}}" required>
					<input type="password" class="input form-control" id="user_pass" name="pass" autocomplete="off" placeholder="Password" required>
					<input type="checkbox" class="checkbox 	" id="remember_me">
					<label for="remember_me">Remember me</label>

					<input type="submit" class="button" value="Login">
				</form><!--.login-form-->
				<div class="help-text">
					<p>Not a DOH employee?<a href="{{asset('/')}}">&nbsp;Go back home</a></p>
				</div><!--.help-text-->
			</div><!--.login-tab-content-->
		</div><!--.tabs-content-->
	</div><!--.form-wrap-->
	@endsection