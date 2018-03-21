$('#chat-loader').hide();

chatItems = 0;

//show the description for a specific concept
function showConceptD(event) {
	$("#concept-overview .btn.btn-default.btn-text-bold").removeClass('active');
	$(event.target).addClass('active');

	var id = $(event.target).data('concept-id');

	var $descriptions = $('.conceptD');
	$descriptions.addClass('hidden');

	$(".conceptD[data-concept-id=" + id + "]").removeClass('hidden');
}

function showThread(id) {
	var itemNum = $('#chat-comments li').length;
	$.ajax({
		method: 'POST',
		url: urlGetComments,
		data: { threadId: id , itemNum: itemNum},
		beforeSend: function() {

			$('#chat-box-comments #chat-comments').empty();
			$('#chat-box-threads').css('display', 'none');
			$('#chat-box-comments').css('display', 'block');
			$('#chat-loader').show();
		}
	}).done(function(arr) {
		//hide the loader
		$('#chat-loader').hide();

		var container = $('#chat-box-comments #chat-comments')[0];

		//create each comment
		for (var i = arr['comments'].length - 1; i >= 0; i--) {
			var listNode = document.createElement("li");
			var messageNode = document.createElement("div");
			var commentNode = document.createElement("p");
			var nameNode = document.createElement("div");
			var commentText = document.createTextNode(arr['comments'][i].comment);
			var nameText = document.createTextNode(arr['comments'][i].user);

			if( arr['comments'][i].user_id != arr['userId'] ){
				listNode.setAttribute('class', 'chat-item');
			} else {
				listNode.setAttribute('class', 'chat-item owner');
			}

			messageNode.setAttribute('class', 'msg');

			commentNode.appendChild(commentText);
			nameNode.appendChild(nameText);

			messageNode.appendChild(commentNode);
			messageNode.appendChild(nameNode);

			listNode.appendChild(messageNode);
			container.appendChild(listNode);
		}

	}).fail(function() {
		alert("Oops something went wrong :/");

		//hide loader and go back to original view
		$('#chat-loader').hide();
		$('#chat-box-threads').css('display', 'block');
		$('#chat-box-comments').css('display', 'none');
	});
}

function hideThread() {
	//go back to original view
	$('#chat-box-threads').css('display', 'block');
	$('#chat-box-comments').css('display', 'none');
}

// resource carousels
var scrollTime = 500;

function backwardScroll(event) {
	var resourceW = $($('.carousel-item')[0]).width();

	var node = event.target.parentNode;
	while( !node.classList.contains('carousel') ) {
		node = node.parentNode;
	}
	var carousel = $(node.firstElementChild);

	if(parseInt(carousel.css('margin-left')) < -2*resourceW ) {
		carousel.css({marginLeft: '+=' + 2*resourceW + ''});
	} else {
		carousel.css({marginLeft: '0px'});
	}
}

function forwardScroll(event) {
	var resourceW = $($('.carousel-item')[0]).width();

	var node = event.target.parentNode;
	while( !node.classList.contains('carousel') ) {
		node = node.parentNode;
	}
	var carousel = $(node.firstElementChild);

	if(parseInt(carousel.css('margin-left')) > -(carousel.children().length*resourceW - 2.5*resourceW) ) {
		carousel.css({marginLeft: '-=' + 2*resourceW + ''});
	}
}