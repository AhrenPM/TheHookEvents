@extends('authMaster')

@section('title')
{{ $topic->title }}
@endsection


@section('styles')
	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/topic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/addResourceForm.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/Lightbox-Gallery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/develop/chat.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/Navigation-Clean1.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/develop/addResourceForm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/forms.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/develop/topic.js') }}"></script>
    <script type="text/javascript">
        var urlGetComments = "{{ route('GetComments') }}";
    </script>
@endsection


@section('content')
        <a href="/develop-yourself/{{$topic->title}}/{{$topic->id}}"><button class="custom back"><img src="/img/arrowBack.png"></button></a>

    <div class="section">
        <div id="part-header">
            <ul class="part-overview">
                <li class="number">{{ $num }}</li>
                <li class="title">{{ $topic->title }}</li>
                <li class="tree">{{ $category->title }} {{ $topic->sub_category_id ? ' - '.$category->sub()->find($topic->sub_category_id)->title : '' }}</li>
            </ul>
            <div class="btn-list">
                <button class="btn btn-default btn-primary" type="button"> What's Happening Here?</button>
            </div>
        </div>
    </div>
    <div class="flex-section">
        <div id="concept-overview" class="flex-item">
            <div class="btn-list">
            <!-- Title of each concept -->
            <?php $i = 0; ?>
                @foreach( $concepts as $concept )
                <button class="btn btn-default btn-text-bold custom {{ $i == 0 ? 'active' : '' }}" type="button" data-concept-id="{{ $concept->id }}" onclick="showConceptD(event)">{{ $concept->title}}</button>

                <?php $i = 1; ?>
                @endforeach
            </div>

            <!-- Descriptions for each concept -->
            <!-- Creators and Editors -->
            <?php $i = 0; ?>
            @foreach( $concepts as $concept )
            <div class="conceptD {{ $i!=0 ? 'hidden' : '' }}" data-concept-id="{{ $concept->id }}">
                <p>{{ $concept->description }}</p>
                <p class="user-list">Creators: 
                @foreach( $concept->contributions()->where('is_creator', 1)->get() as $creator)
                    <span class="user-tag">{{ $creator->user->firstname }} {{ $creator->user->lastname }}</span>
                @endforeach
                </p>
                <p class="user-list">Editors:  
                @foreach( $concept->contributions()->where('is_creator', 0)->get() as $creator)
                    <span class="user-tag">{{ $creator->user->firstname }} {{ $creator->user->lastname }}</span>
                @endforeach
                </p>
            </div>

            <?php $i = 1; ?>
            @endforeach

<!-- create the list of supported materials -->
            @if($topic->supports)
            <?php $logos = unserialize($topic->supports);?>
            <ul class="list-supported">
                <li>Supports: </li>
                @foreach( $logos as $logo )
                    <li><img src="{{ $logo[1] }}" class="img-support"><p>{{ $logo[0] }}</p></li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Chat Box -->
        <div class="flex-item">
        <!-- Threads -->
            <div id="chat-box-threads">
                <div class="chat-gradient"></div>
                <ul id="chat-threads">
                <!-- Threads for each separate conversation -->
                    <li class="chat-item speech-bubble top">What's on your mind? Add a thread</li>
                    @foreach( $topic->threads()->get() as $thread )
                    <li class="chat-item"><a onclick="showThread({{ $thread->id }})">{{ $thread->title }}</a></li>
                    @endforeach
                </ul>
                <form class="chat-enter">
                    {{ csrf_field() }}
                    <input class="form-control chat-text-input" type="text">
                    <button class="btn btn-default chat-submit" type="button">Create </button>
                </form>
            </div>

            <!-- Comments -->
            <div id="chat-box-comments">
                <button onclick="hideThread()" class="custom back"><img src="/img/arrowBack.png"></button>
                <img src="/img/loader.gif" id="chat-loader">
                <ul id="chat-comments">
                    
                </ul>
                <form class="chat-enter">
                    <input class="form-control chat-text-input" type="text">
                    <button class="btn btn-default chat-submit" type="button">Send</button>
                </form>
            </div>
        </div>
    </div>

<!-- concept resources -->
    @foreach ( $concepts as $concept )
    <div class="concept-resources">
        <div class="section">
            <div class="concept-header">
                <p class="concept-title"> {{ $concept->title }} </p>
                <button class="btn btn-default custom resource-enter" type="button" data-conceptId="{{ $concept->id }}">Add Resource</button>
            </div>

            <!-- submit resource form -->
            <div class="resourceForm" data-conceptId="{{ $concept->id }}">
                <form method="POST" id="{{ $concept->id }}" action="/subject/{{ $concept->id }}/resource/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label>Enter the resource:</label>
                    <input style="display: inline;" class="url" type="text" name="url" required>
                    <input style="display: none;" type="file" name="file" required>
                    <label class="smallText"><a class="showFileIn" onclick="showFileIn(event)">Add a file instead</a></label>
                    <label style="display: none;" class="smallText"><a class="showUrlIn" onclick="showUrlIn(event)">Add a URL instead</a></label>
                    <br>
                    <label>Add an image:</label>
                    <input style="display: inline;" type="file" name="resourceImage">
                    <br>
                    <label class="smallText">OR use the default image?</label>
                    <input type="checkbox" name="useDefaultImage">
                    <br>
                    <input type="button" onclick="submitForm( {{ $concept->id }} )" name="btnSubmit" value="Add Resource">
                </form>
            </div>

        </div>

        <!-- resource carousel -->
        <div class="carousel">
            <ul class="carousel-items">
                @if(is_null($concept->resources()->first()))
                    <li class="empty-carousel">There's nothing here yet.<li> 
                @else
                @foreach( $concept->resources()->orderBy('likes', 'desc')->get() as $resource )
                <li class="carousel-item">
                    <a href="#" target="_blank"><img src="{{ $resource->image }}" class="carousel-image"></a>
                    <ul class="item-description">
                    @if($resource->type == 'video')
                        <li class="flex-item"> <span class="resource-type"><img src="/img/video.png" class="concept-type-icon">Video </span>
                    @elseif($resource->type == 'blog')
                        <li class="flex-item"> <span class="resource-type"><img src="/img/blog.png" class="concept-type-icon">Blog </span>
                    @elseif($resource->type == 'book')
                        <li class="flex-item"> <span class="resource-type"><img src="/img/book.png" class="concept-type-icon">Book </span>
                    @else
                        <li class="flex-item">
                    @endif
                            <a href="#" target="_blank"> <span class="resource-name">{{ $resource->title }}</span></a>
                        </li>
                        <!-- <li class="flex-item like">
                            <button class="btn btn-default like custom" type="button">like <span class="like-num">{{ $resource->likes }} </span></button>
                        </li> -->
                    </ul>
                </li>
                @endforeach
                @endif
            </ul>
            <!-- left to right buttons -->
            <div class="carousel-buttons">
                <button onclick="backwardScroll(event)" class="btn btn-default custom carousel-button button-left" type="button"> <img src="/img/arrowLeft.png" class="carousel-arrow"></button>
                <button onclick="forwardScroll(event)" class="btn btn-default custom carousel-button button-right" type="button"> <img src="/img/arrowRight.png" class="carousel-arrow"></button>
            </div>
        </div>
    </div>
    @endforeach
    <!--
    <div class="section">
        <div class="section-title-middle">
            <h1>Try it out</h1></div>
        <div class="flex-section">
            <div class="flex-item exercises">
                <button class="btn btn-default custom exercise" type="button">Stick Ninja Fight</button>
                <button class="btn btn-default custom exercise active" type="button">Simple Logo</button>
                <button class="btn btn-default custom exercise" type="button">Organization </button>
                <button class="btn btn-default custom exercise" type="button">House </button>
                <button class="btn btn-default custom exercise-create" type="button">Add Project</button>
            </div>
            <div class="flex-item goals">
                <div class="btn-list">
                    <button class="btn btn-default custom goal" type="button">Goal 1</button>
                    <button class="btn btn-default custom goal" type="button">Goal 2</button>
                    <button class="btn btn-default custom goal active" type="button">Goal 3</button>
                </div>
                <div class="goal">
                    <div class="objective">
                        <p><strong>Objective:</strong> Create the figure below</p>
                    </div>
                    <a href="/img/stickFig.jpg" data-lightbox="photos">
                        <img class="img-responsive image" src="/img/stickFig.jpg">
                    </a>
                    <div class="description">
                        <p> <strong>Description:</strong> Use the line tool and geometry tool to create a scene of two ninja's fighting. Be creative by starting with some brainstorming of scenes, then push yourself into the drawing process.</p>
                    </div>
                    <div>
                        <p class="user-list">Project Created By: <span class="user-tag">Emery Chag</span></p>
                    </div>
                </div>
            </div>
            <div class="flex-item instructions">
                <ul class="list-supported">
                    <li> <img src="assets/img/SiteIcon.png" class="img-support"></li>
                    <li> <img src="assets/img/krita.png" class="img-support"></li>
                    <li> <img src="assets/img/fruitylogo.png" class="img-support"></li>
                </ul>
                <div class="heading">
                    <p style="margin:0;">Process: </p>
                </div>
                <ul>
                    <li class="step"><strong>Step 1: </strong>Start by drawing a line on the bottom to creat a flat plane. </li>
                    <li class="step"><strong>Step 2: </strong>Use the pencil tool with a medium bruch size to create some bumps and elevation on the ground.</li>
                    <li class="step"><strong>Step 3: </strong>Make your Stick Men.</li>
                    <li class="prompt">Have Fun!</li>
                </ul>
            </div>
        </div>
    </div>
    -->

    <!-- The suggestions section -->
    <div class="section">

        <!-- What comes next section : describes the next elements in the current tree -->
        <div class="section-title-middle">
            <h1>What Comes Next?</h1>
        </div>
        <div class="flex-section">
            @if(!$topic->is_last)
                <?php 
                $subject = $topic;
                $item = $num;
                ?>
                @for( $i=0 ; $i<3 ; $i++ )
                <?php
                if(!$subject->is_last){
                    $subject = $subject->directChild;
                    $item++;
                }else{
                    break;
                }
                ?>
                <p>{{$i+1}}.</p>
                    @include('topicButton')
                @endfor
            @else
                    <div class="emptyList">There's nothing else here, Try something more specific!</div> 
            @endif

        </div>

        <!-- 3 sections based on new learning -->
        <div class="flex-section">
            <!-- More in depth suggestions -->
            <div class="flex-item columns-3">
                <div class="title-middle">
                    <h3>More Specific</h3>
                </div>
                <div class="tree-list-vertical">
                @if(!is_null($topic->children()->first()))
                    @foreach($moreSpecific as $subject)
                        <?php 
                        $subject = $subject->child()->first();
                        ?>
                        @include('subjectButton')
                    @endforeach
                @else
                    <p>This is as far as this subject goes...</p>
                    <p>Have something to add? Create a more specific section Here</p>
                @endif
                </div>
            </div>
            <!-- Related suggestions: same category -->
            <div class="flex-item columns-3">
                <div class="title-middle">
                    <h3>Similar </h3>
                </div>
                <div class="tree-list-vertical">
                    @foreach($similarSubjects as $subject)
                        @include('subjectButton')
                    @endforeach
                </div>
            </div>
            <!-- Unrelated suggestions : random list of new subjects -->
            <div class="flex-item columns-3">
                <div class="title-middle">
                    <h3>Something Different</h3>
                </div>
                <div class="tree-list-vertical">
                    @foreach($newSubjects as $subject)
                        @include('subjectButton')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 item text">
                        <h3>The Hook at Mac</h3>
                        <p>The Hook at Mac strives to create one cohesive community of McMaster students that support healthy living standards. Bringing together acedemic and recreational balance to keep up mental and physical health.</p>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-sm-4 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">The Hook at Mac © 2017</p>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@endsection