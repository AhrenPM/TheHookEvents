@extends('master')

@section('title')
Visitor Home
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/homeCarousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/1000px/homeCarousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/events.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/1000px/events.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/allWeek.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/weekCalendar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/640px/weekCalendar.css') }}">
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/homeCarousel.js') }}"></script>
@endsection

@section('content')

<!-- only include these secitons if there are events to show -->
	@if(count($carousel[0]))
		@include('visitor.homeCarousel')
		@include('visitor.weeklyOverview')
		@include('visitor.weekCalendar')
	@endif

@endsection