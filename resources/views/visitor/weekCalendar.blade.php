<div class="section">
	<div id="featureCalendar">
	@foreach($days as $day)
		<div class="day" id="{{ $now->format('l') }}">
			<div class="sectionTitle">{{ $now->format('l, F jS') }}</div>
			<div class="dayGui">
				<div class="featureItems">
				@foreach($day['events'] as $feature)
					<div class="featureItem">

					@if( $feature->feature->theme_id == 1)
						<div class="featureImgBox">
							<img class="featureImg" src="{{ $feature->feature->image }}">
						</div>
						<div class="featureInfo">
							<div class="featurePrompt">Somewhere to be:</div>
							<div class="featureTitle">{{ $feature->feature->name }}</div>
							<div class="featureTimeLocal">
							@if( $feature->feature->event->end_time == null)
								Starts at {{ Carbon\Carbon::parse( $feature->feature->event->start_time )->format('g:i A') }} @ {{ $feature->feature->event->location }}
							@else
								From {{ Carbon\Carbon::parse( $feature->feature->event->start_time )->format('g:i A') }} to {{ Carbon\Carbon::parse( $feature->feature->event->end_time )->format('g:i A') }} @ {{ $feature->feature->event->location }}
							@endif
							</div>
							<div class="featureAdmission">Tickets: {{ $feature->feature->event->tickets ? 'Yes' : 'No' }}</div>
							<div class="featureDescription">{{ $feature->feature->description }}</div>
							<div><a class="featureLink" href="{{ $feature->feature->event->website }}">{{ $feature->feature->event->website }}</a></div>
						</div>
					@endif

					@if( $feature->feature->theme_id == 2)
						<div class="featureImgBox">
							<img class="featureImg" src="{{ $feature->feature->image }}">
						</div>
						<div class="featureInfo">
							<div class="featurePrompt">Somewhere to visit:</div>
							<div class="featureTitle">{{ $feature->feature->name }}</div>
							<div class="featureTimeLocal">Opens {{ Carbon\Carbon::parse( $feature->feature->venue->opens_at )->format('g:i A') }} @ {{ $feature->feature->venue->location }}</div>
							<div class="featureAdmission">Reservations: {{ $feature->feature->venue->reserve ? 'Yes' : 'No' }}</div>
							<div class="featureDescription">{{ $feature->feature->description }}</div>
							<div><a class="featureLink" href="{{ $feature->feature->venue->website }}">{{ $feature->feature->venue->website }}</a></div>
						</div>
					@endif

					</div>
				@endforeach
				</div>
			</div>
		</div>
		<?php $now->addDay() ?>
	@endforeach
	</div>
</div>