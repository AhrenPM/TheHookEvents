<a href="/develop-yourself/{{$subject->title}}/{{$subject->id}}" class="subjectButton" style="background: linear-gradient(to bottom right,{{ $subject->color1 }}, {{ $subject->color2 }})">
	<div class="statistics">
		<div class="resources">
			<div class="number">{{ unserialize($subject->statistics)[0]['resources'] }}</div>
			<div class="type">Resources</div>
		</div>
		<div class="projects">
			<div class="number">{{ unserialize($subject->statistics)[0]['industry rating'] }}</div>
			<div class="type">Rating</div>
		</div>
	</div>
	<div class="title">{{ $subject->title }}</div>
</a>