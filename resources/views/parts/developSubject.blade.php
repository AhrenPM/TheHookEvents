@extends('authMaster')

@section('title')
{{ $head->title }}
@endsection


@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/subject.css') }}">
@endsection


@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/develop/subject.js') }}"></script>
@endsection


@section('content')
<div class="banner">
	<img src="{{ $category->image }}">
	<div class="back"><a href="/develop-yourself">Back to subjects</a></div>
	<div>{{ $head->title }}</div>
	<p>{{ $category->title }} {{ $head->sub_category_id ? ' - '.$category->sub()->find($head->sub_category_id)->title : '' }}</p>
</div>

<ul class="parentList">
	<li>What Comes Before This?</li>

	<?php $top = 1; ?>
	@foreach($topics as $topic)
	<?php $parents = $topic->parents()->get(); ?>
	@if( $parents->first() )
		@foreach( $parents as $parent )
		<li class="parent"><a  href="/develop-yourself/{{ $parent->parent_title }}/{{ $parent->parent_id }}">{{ $parent->parent_title }}</a></li>
		@endforeach
		<?php $top = 0;?>
	@endif
	@endforeach
	@if( $top == 1)
		<li style="color: #333; font-size: 12px;">This is the beginning of the tree</li>
	@endif

</ul>

<div class="partsOverview">

<?php $item = 1 ?>
	@foreach($topics as $topic)
	<div class="part">
		<div>
			<div class="number">{{ $item }}</div>
			<div class="description">
				<a class="title" href="/develop-yourself/topic/{{ $topic->title }}/{{ $topic->id }}:{{ $item }}">{{ $topic->title }}</a>
				<div class="tree">{{ $category->title }}</div> <!-- change this -->
				<button class="custom" onclick="togglePart(event)"><div class="plusSign"></div></button>
			</div>
		</div>
		<div class="contains">
			<div>Contains</div> <!-- change this -->
			<ul> 
			<!-- Get the first concept of the subject -->
				<?php 
					$concept = $topic->concepts()->where('parent_id', null)->first();
				?>
				@for( $i=0 ; $i<count($topic->concepts()->get()) ; $i++)
				<li>{{ $concept->title }}</li>
				<?php 
				//check to see if the child exists
					if($concept->child) {
						$concept =  $concept->child;
					} else {
						break;
					}
				?>
				@endfor

				@foreach( $topic->children()->get() as $related )
				<a href="/develop-yourself/{{ $related->child_title }}/{{ $related->child_id }}"><li class="subtree">{{ $related->child_title }}<img style="padding-left: 5px; height: 15px" src="/img/arrow.png"></li></a>
				@endforeach
			</ul>
		</div>

		<div class="stats">
			<ul class="industry">
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[0]['resources'] }}</div>
					<div class="name">resources</div>
				</li>
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[0]['industry rating'] }}</div>
					<div class="name">industry rating</div>
				</li>
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[0]['contributions'] }}</div>
					<div class="name">contributions</div>
				</li>
			</ul>
			<ul class="user">
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[1]['submissions'] }}</div>
					<div class="name">submissions</div>
				</li>
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[1]['learner rating'] }}</div>
					<div class="name">learning rating</div>
				</li>
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[1]['clicks'] }}</div>
					<div class="name">clicks</div>
				</li>
				<li>
					<div class="stat">{{ unserialize($topic->statistics)[1]['threads'] }}</div>
					<div class="name">threads</div>
				</li>
			</ul>
		</div>
	</div>
	
	<?php $item++; 

	?>

	@endforeach

</div>



<div class="section">
	<div class="developFooter">
		<h1>Make Your Mark,</h1>
		<h3>Have something to offer? Start creating your own tree <a>here</a></h3>
	</div>
</div>

<div class="buttons">
	<button class="custom">How does this whole thing work?</button>
	<button class="custom">Help us develop this tree</button>
	<button class="custom">Start developing your own tree</button>
</div>
@endsection