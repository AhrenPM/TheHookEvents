@extends('master')

@section('title')
The Hook Confirmation
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
	        <img class="sectionPicture" src="img/StudentsPhoto.jpg">
		</div>
		<div class="messageBox">
			<div class="warning">
				Check your email for a confirmation message!
			</div>
			<div align="center">
				<form action="/user/re-confirm" method="POST" >
				{{ csrf_field() }}
					<input style="color: black" type="text" name="email">
					<button class="secondaryButton">
						Re-send Confirmation Email
					</button>
				</form>
			</div>

			@if(session('resent'))
			<div class="alert alert-success" style="margin-top: 10px">
				{{ session('resent')}}
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