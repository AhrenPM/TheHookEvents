@extends('authMaster')

@section('title')
Student Home
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
	<script type="text/javascript" src="{{ asset('js/userEvents.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/featureInteractions.js') }}"></script>
	<script type="text/javascript">
		var urlLikeFeature = "{{ route('LikeFeature') }}";
		var urlGoingFeature = "{{ route('GoingFeature') }}";
		var urlMakeUserEvent = "{{ route('CreateUserEvent') }}";
		var urlLikeUserEvent = "{{ route('LikeUserEvent') }}";
	</script>
@endsection

@section('content')

	@if(count($carousel[0]))
		@include('homeCarousel')
		@include('weeklyOverview')
		@include('weekCalendar')
	@endif

@endsection