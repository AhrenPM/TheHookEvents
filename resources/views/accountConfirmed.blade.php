@extends('authMaster')

@section('title')
Confirmation
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
		@if($confirmed == true)
		<div class="warning">
			{{ $name }}, your account has been confirmed!
		</div>
		<div align="center">
			<a href="/">
				<button class="primaryButton medButton">
					Go to the site
				</button>
			</a>
		</div>
		@else
		<div class="warning">
			Sorry, your account has not been confirmed :'(
		</div>
		<div>
			Help me fix it:
			<ul>
				<li>Check your email for a confirmation email</li>
				<li>email: thehookdevelopment@gmail.com for more help</li>
			</ul>
		</div>
		@endif
	</div>
</div>
@endsection