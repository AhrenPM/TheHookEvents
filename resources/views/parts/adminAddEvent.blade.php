@extends('authMaster')

@section('styles')
<style>
	form {
		width: 300px;
		flex-grow: 1;
	}

	.featureList {
		min-width: 300px;
		flex-grow: 2;
	}

	table {
	    font-family: arial, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	}

	td, th {
	    border: 1px solid #dddddd;
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even) {
	    background-color: #dddddd;
	}
	.featureList input {
		width: 50px;
	}
</style>
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

	function deleteFeature(id) {
		$.ajax({
			method: "DELETE",
			url: "{{ route('deleteFeature') }}",
			data: { featureId: id }
		}).done(function () {
			location.reload();
		}).fail(function() {
			location.reload();
			alert('Oops :/ something went wrong');
		})
	}

	function addToQueue(event, id) {
		var input = event.target.nextElementSibling.value;

		$.ajax({
			method: "POST",
			url: "{{ route('addToQueue') }}",
			data: { featureId: id, date: input }
		}).done(function(message) {
			location.reload();
			if(message){
				alert(message);
			}
		}).fail(function() {
			location.reload();
			alert('Oops :/ something went wrong');
		})
	}

	function promoteFeature(event, id, promoteNum) {
		var input = event.target.nextElementSibling.value;

		$.ajax({
			method: "POST",
			url: "{{ route('promoteFeature') }}",
			data: { featureId: id, promoteNum: promoteNum, date: input }
		}).done(function(message) {
			location.reload();
			if(message) {
				alert(message);
			}
		}).fail(function() {
			alert('Oops :/ something went wrong');
		});
	}

	function forceFeature(id) {
		$.ajax({
			method: "POST",
			url: "{{ route('forceFeature') }}",
			data: { featureId: id }
		}).done(function(message) {
			location.reload();
			if(message) {
				alert(message);
			}
		}).fail(function() {
			alert('Oops :/ something went wrong');
		});
	}

	function deleteQueue(id) {
		$.ajax({
			method: "DELETE",
			url: "{{ route('deleteQueue') }}",
			data: { QueueId: id }
		}).done(function(message) {
			location.reload();
			if(message) {
				alert(message);
			}
		}).fail(function() {
			alert('Oops :/ something went wrong');
		});
	}
</script>
@endsection


@section('content')
<br>
<br>
<br>
<br>
<div class="flexSection">
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
		<input id="event_theme" type="radio" name="theme" value="1" onclick="eventClick()"> event
		<br>
		<input id="venue_theme" type="radio" name="theme" value="2" onclick="venueClick()"> venue
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
	<div class="featureList">
		<div class="sectionTitle">Features</div>
		<table>
			<tr>
				<th>Name</th>
				<th>Uses</th>
				<th>In Queue</th>
				<th>Add to Queue</th>
				<th>Delete</th>
			</tr>
			@foreach($features as $feature)
			<tr>
				<th>{{ $feature->name }} - {{ $feature->theme_id }}</th>
				<th>{{ $feature->uses }}</th>
				<th>{{ $feature->queue ? "Yes" : "no" }}</th>
				<th><button style="background: green; color: white" onclick="addToQueue(event, {{ $feature->id }})">add</button><input type="date" name="date"></th>
				<th><button style="background: red; color: white" onclick="deleteFeature({{ $feature->id }})">delete</button></th>
			</tr>
			@endforeach
		</table>
		<div class="sectionTitle">Queue</div>
		<table>
			<tr>
				<th>Name</th>
				<th>Promotion 1</th>
				<th>Promotion 2</th>
				<th>Promotion 3</th>
				<th>Force</th>
				<th>Remove</th>
				<th>Date</th>
			</tr>
			@foreach($queue as $featureQueue)
			<tr>
				<th>{{ $featureQueue->feature->name }} - {{ $featureQueue->feature->theme_id }}</th>
				<th>{{ $featureQueue->promotion_1 }}<button style="background: green; color: white" onclick="promoteFeature(event, {{ $featureQueue->id }}, 1)">add</button><input type="date" name="date"></th>
				<th>{{ $featureQueue->promotion_2 }}<button style="background: green; color: white" onclick="promoteFeature(event, {{ $featureQueue->id }}, 2)">add</button><input type="date" name="date"></th>
				<th>{{ $featureQueue->promotion_3 }}<button style="background: green; color: white" onclick="promoteFeature(event, {{ $featureQueue->id }}, 3)">add</button><input type="date" name="date"></th>
				<th>{{ $featureQueue->forced ? "Yes" : "No" }}<button style="background: red; color: white" onclick="forceFeature({{ $featureQueue->id }})">Force</button></th>
				<th><button style="background: red; color: white" onclick="deleteQueue({{ $featureQueue->id }})">Remove</button></th>
				<th>{{ $featureQueue->event_date }}</th>
			</tr>
			@endforeach
		</table>
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