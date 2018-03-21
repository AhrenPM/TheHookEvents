@extends('authMaster')


@section('title')
Develop Yourself
@endsection


@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/main.css') }}">
@endsection


@section('scripts')

@endsection


@section('content')
<div class="banner" style="background: #4ddeff;">Learn Something New</div>
<div class="flexSection subjectsOverview">
@foreach($subjects as $subject)
	@include('subjectButton')
@endforeach
</div>
<div class="section">
	<div class="developFooter">
		<h1>Enjoy Everyone,</h1>
		<h3>Have something to offer? Start creating your own tree <a>here</a></h3>
	</div>
</div>
@endsection