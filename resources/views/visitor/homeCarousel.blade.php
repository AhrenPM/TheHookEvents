<div class="homeCarousel">
	<button class="arrow left">
		<img class="arrowImg" src="img/arrowLeft.png">
	</button>
	<button class="arrow right">
		<img class="arrowImg" src="img/arrowRight.png">
	</button>
	<ul class="featureContainer">
	@foreach($carousel as $feature)

	@if($feature->feature->theme_id == 2)
		<li class="featureItem">
			<img class="featureImg" src="{{ $feature->feature->image }}">
			<div class="carouselCenterBox">
				<div class="summaryBox">
					<div class="featureTitle">{{ $feature->feature->name }}</div>
					<div class="featureLocation">{{ $feature->feature->venue->location }}</div>
					<div class="timeInfo">Opens at {{ Carbon\Carbon::parse( $feature->feature->venue->opens_at )->format('g:i A') }}</div>
				</div>
				<button class="moreInfo medButton secondaryButton" onclick="showDescription(event)">
					More Info...
				</button>
			</div>
			<div class="carouselDescription">
				<button class="exit custom" onclick="hideDescription(event)"><img class="exitImg" src="img/exit.png"></button>
				<div class="infoContainer">
					<div class="featureTitle">{{ $feature->feature->name }}</div>
					<a class="featureUrl" href="{{ $feature->feature->venue->website}}">{{ $feature->feature->venue->website}}</a>
					<div class="featureLocation">{{ $feature->feature->venue->location }}</div>
					<div class="timeInfo">Opens at {{ Carbon\Carbon::parse( $feature->feature->venue->opens_at )->format('g:i A') }}</div>
					<div class="featureDescription">{{ $feature->feature->description }}</div>
				</div>
			</div>
		</li>
	@endif

	@if($feature->feature->theme_id == 1)
		<li class="featureItem">
			<img class="featureImg" src="{{ $feature->feature->image }}">
			<div class="carouselCenterBox">
				<div class="summaryBox">
					<div class="featureTitle">{{ $feature->feature->name }}</div>
					<div class="featureLocation">{{ $feature->feature->event->location }}</div>
					<div class="timeInfo">Starts {{ Carbon\Carbon::parse( $feature->feature->event->start_time )->format('l') }} at {{ Carbon\Carbon::parse( $feature->feature->event->start_time )->format('g:i A') }}</div>
				</div>
				<button class="moreInfo medButton secondaryButton" onclick="showDescription(event)">
					More Info...
				</button>
			</div>
			<div class="carouselDescription">
				<button class="exit custom" onclick="hideDescription(event)"><img class="exitImg" src="img/exit.png"></button>
				<div class="infoContainer">
					<div class="featureTitle">{{ $feature->feature->name }}</div>
					<a class="featureUrl" href="{{ $feature->feature->event->website }}">{{ $feature->feature->event->website}}</a>
					<div class="featureLocation">{{ $feature->feature->event->location }}</div>
					<div class="timeInfo">Starts at {{ Carbon\Carbon::parse( $feature->feature->event->start_time )->format('g:i A') }}</div>
					<div class="featureDescription">{{ $feature->feature->description }}</div>
					</ul>
				</div>
			</div>
		</li>
	@endif
	
	@endforeach
	</ul>
</div>
