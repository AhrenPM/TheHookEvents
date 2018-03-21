@extends('master')

@section('title')
Student Login
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/loginForm.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/640px/loginForm.css') }}">
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/studentLogin.js') }}"></script>
@endsection

@section('content')
	<div class="screen">
		<div class="background">
	        <img class="sectionPicture" src="img/StudentsPhoto.jpg">
		</div>
		<div id="loginContainer">
			<form action="/user/login" method="POST">
				{{ csrf_field() }}
				<h1>Student Login</h1>
				<label for="LoginEmail">Email</label>
				<input type="email" name="LoginEmail" required>
				<br>
				<label>Password</label>
				<input type="Password" name="LoginPassword" required>
				<br>
				<label>Remember me?</label>
				<input type="checkbox" name="remember">
				<br>
				<input class="submit" type="submit" value="Login">
				<br>
				<div class="signUp"><a href="#" onclick="showSignUp();return false;">Sign Up</a></div>
				<div class="forgotPass"><a href="/user/forgot-password">Forgot My Password</a></div>
			</form>
		</div>
		<div id="signUpContainer">
			<form action="/user/create" method="POST">
				{{ csrf_field() }}
				<h1>Student Sign Up</h1>
				<label for="Firstname">Firstname</label>
				<input type="text" name="Firstname" required>
				<br>
				<label for="Lastname">Lastname</label>
				<input type="text" name="Lastname" required>
				<br>
				<label for="Username">Username</label>
				<input type="text" name="Username">
				<br>
				<label for="SignUpEmail">Email</label>
				<input type="email" name="SignUpEmail" required>
				<div class="warning">Please use your McMaster email address!</div>
				<br>
				<label>Password</label>
				<input type="Password" name="SignUpPassword" required>
				<br>
				<label>Re-Password</label>
				<input type="Password" name="SignUpPassword_confirmation" required>
				<br>
				<input class="submit" type="submit" value="Sign Up">
				<br>
				<div class="signUp"><a href="#" onclick="showLogin();return false;">Login</a></div>
				<input type="hidden" name="FormType" value="SignUp">
			</form>
		</div>

	@if(count($errors) > 0)
		<ul id="errorsBox">
		@foreach($errors->all() as $error)
			<li class="error">{{ $error }}</li>
		@endforeach
		</ul>
	@endif

	@if(old('FormType'))
	<script>
		var $login = $('#loginContainer');
		var $signup = $('#signUpContainer');
		$login.css({'left' : '-50%'});
		$signup.css({'left' : '50%'});
	</script>
	@endif

	</div>
@endsection