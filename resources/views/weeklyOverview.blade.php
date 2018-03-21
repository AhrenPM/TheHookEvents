<div class="section">
	<div class="sectionTitle">All Week</div>
	<div id="allWeek">
	@for ( $i = 0 ; $i < 15 ; $i++ )
		@if( $i == count($carousel))
			@break
		@endif
		@if( $i%5 == 0)
		<ul class="featureList">
		@endif
			<li>
				<div class="dateTime">
					<div class="date">{{ Carbon\Carbon::parse( $weekOverview[$i]->event_date )->format('D') }}</div>
				@if($weekOverview[$i]->feature->theme_id == 1)
					<div class="time">{{ Carbon\Carbon::parse( $weekOverview[$i]->feature->event->start_time )->format('g:i A') }}</div>
				@elseif($weekOverview[$i]->feature->theme_id == 2)
					<div class="time">{{ Carbon\Carbon::parse( $weekOverview[$i]->feature->venue->opens_at )->format('g:i A') }}</div>
				@endif
				</div>
				<div class="title">{{ $weekOverview[$i]->feature->name }}</div>
			</li>
		@if( ($i+1)%5 == 0 || $i == count($carousel)-1)
		</ul>
		@endif
	@endfor
	</div>
</div>