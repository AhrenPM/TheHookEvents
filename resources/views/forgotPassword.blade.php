@extends('master')

@section('title')
Forgot Password
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
		<div class="messageBox">
			<div class="warning">
				Enter your email:
			</div>
			<div align="center">
				<form action="/user/send-password-reset" method="POST" >
				{{ csrf_field() }}
					<input style="color: black" type="text" name="email">
					<button class="secondaryButton" style="margin-top: 10px">
						Send Password Reset Email
					</button>
				</form>
			</div>

			@if(session('sent'))
			<div class="alert alert-success" style="margin-top: 10px">
				{{ session('sent')}}
			</div>
			@endif
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