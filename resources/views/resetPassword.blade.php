@extends('master')

@section('title')
Reset Password
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/loginForm.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/640px/loginForm.css') }}">
@endsection

@section('scripts')
@endsection

@section('content')
	<div class="screen">
		<div class="background">
	        <img class="sectionPicture" src="/img/StudentsPhoto.jpg">
		</div>
		<div id="loginContainer">
			<form action="/user/reset-password" method="POST">
				{{ csrf_field() }}
				<h1>Reset Password</h1>
				<label>Password</label>
				<input type="Password" name="ResetPassword" required>
				<br>
				<label>Re-Password</label>
				<input type="Password" name="ResetPassword_confirmation" required>
				<br>
				<input class="submit" type="submit" value="Submit">
				<input type="hidden" name="reset_code" value="{{ $reset_code }}">
				<br>
			</form>
		</div>
	</div>

	@if(count($errors) > 0)
		<ul id="errorsBox">
		@foreach($errors->all() as $error)
			<li class="error">{{ $error }}</li>
		@endforeach
		</ul>
	@endif
@endsection