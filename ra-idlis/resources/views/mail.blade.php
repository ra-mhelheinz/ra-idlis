<h1>Hi, {{ $name }}</h1>
<p>Verify your account by clicking the link below</p>
<a href="{{ asset('/register/verify') }}/{{ $token }}">Verify account</a>