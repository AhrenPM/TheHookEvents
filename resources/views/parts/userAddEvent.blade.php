@extends('authMaster')

@section('title')
Add an Event
@endsection

@section('styles')

@endsection


@section('scripts')
<script type="text/javascript">
	function eventClick() {
		$('.venue').attr('disabled', 'disabled');
		$('.event').prop('disabled', false);
	}

	function venueClick() {
		$('.event').attr('disabled', 'disabled');
		$('.venue').prop('disabled', false);
	}
</script>
@endsection


@section('content')
<div class="section" style="top: 50px;">
	<div class="sectionTitle">Add Your Events</div>
	<form method="POST" action="/feature/create" enctype="multipart/form-data" style="margin-left: 100px">
	{{ csrf_field() }}
		<label>Name</label>
		<input type="text" name="name" maxlength="30" required>
		<br>

		<label>Description</label>
		<textarea name="description" style="height: 100px; max-width: 400px" maxlength="650" required></textarea>
		<br>

		<label>Image</label>
		<input type="file" name="image" required>
		<br>

		<label>Theme</label>
		<br>
		<input id="event_theme" type="radio" name="theme" value="1" onclick="eventClick()" required> event
		<br>
		<input id="venue_theme" type="radio" name="theme" value="2" onclick="venueClick()" required> venue
		<br>
		<br>

		<label>location</label>
		<input type="text" name="location" class="venue event" disabled="disabled" maxlength="50" required>
		<br>

		<label>website</label>
		<input type="text" name="website" class="venue event" disabled="disabled">
		<br>

		<label>Opens at</label>
		<input type="time" name="opens" class="venue" disabled="disabled" required>
		<br>

		<label>reserve</label>
		<input type="checkbox" name="reserve" class="venue" disabled="disabled">
		<br>

		<label>start time</label>
		<input type="datetime-local" name="start_time" class="event" disabled="disabled" required>
		<br>

		<label>end time</label>
		<input type="datetime-local" name="end_time" class="event" disabled="disabled">
		<br>

		<label>tickets</label>
		<input type="checkbox" name="tickets" class="event" disabled="disabled">
		<br>

		<label>recurring weekly</label>
		<input type="checkbox" name="recurring_weekly" class="event" disabled="disabled">
		<br>

		<label>recurring end</label>
		<input type="date" name="recurring_end" class="event" disabled="disabled">
		<br>

		<input type="submit" name="submit" value="Add Event">

	</form>
@if(count($errors) > 0)
		<ul id="errorsBox">
		@foreach($errors->all() as $error)
			<li class="error">{{ $error }}</li>
		@endforeach
		</ul>
	@endif
@endsection