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
							<div><button class="featureLike custom" onclick="likeFeature(event, {{ $feature->feature->id }}, false)">{{ Auth::user()->featureLikes()->where('feature_id', $feature->feature->id)->first() ? "Liked" : "like" }}</button><span>{{ $feature->feature->likes }}</span></div>
							<div><button class="featureGoing custom" onclick="goingFeature(event, {{ $feature->id }}, false)">{{ Auth::user()->featureGoings()->where('queue_id', $feature->id)->first() ? "Going!" : "Going" }}</button><span>{{ $feature->going }}</span></div>
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
							<div><button class="featureLike custom" onclick="likeFeature(event, {{ $feature->feature->id }}, false)">{{ Auth::user()->featureLikes()->where('feature_id', $feature->feature->id)->first() ? "Liked" : "like" }}</button><span>{{ $feature->feature->likes }}</span></div>
							<div><button class="featureGoing custom" onclick="goingFeature(event, {{ $feature->id }}, false)">{{ Auth::user()->featureGoings()->where('queue_id', $feature->id)->first() ? "Going!" : "Going" }}</button><span>{{ $feature->going }}</span></div>
						</div>
					@endif

					</div>
				@endforeach
				</div>

				<div class="userEvents">
					<div class="title">What are my friends doing this {{ $now->format('l') }}?</div>
					<ul class="eventsList">
					@foreach($day['userEvents'] as $userEvent)
						<li><button class="userLikeButton custom" onclick="likeUserEvent(event, {{ $userEvent->id }})"><span class="likes" style="{{ Auth::user()->userEventLikes()->where('event_id', $userEvent->id)->first() ? "background: #ff7900" : "background: #333333" }}">{{ $userEvent->likes }}</span><span class="userEvent">{{ $userEvent->name }}</span></button></li>
					@endforeach
					</ul>
					<ul>
						<li><input type="text" name="newUserEvent" maxlength="30" required></li>
						<li><button class="custom" onclick="addUserEvent(event)"><img class="addUserEventImg" src="img/add.png"></button></li>
						<input type="hidden" name="day" value="{{ $now->dayOfWeek }}">
					</ul>
				</div>
			</div>
		</div>
		<?php $now->addDay() ?>
	@endforeach
	</div>
</div>