function addUserEvent(e) {
	var input = e.target.parentNode.parentNode.previousElementSibling.firstChild.value;
	 var date = e.target.parentNode.parentNode.nextElementSibling.value;

	$.ajax({
		method: "POST",
		url: urlMakeUserEvent,
		data: { name: input, date: date }
	}).done( function(arr) {
		if(arr["isNew"]) {
			var dayList = $('#'+arr["day"]+' .userEvents .eventsList')[0];
			var listNode = document.createElement("li");
			var buttonNode = document.createElement("button");
			var spanLikesNode = document.createElement("span");
			var spanEventNode = document.createElement("span");
			var textLikes = document.createTextNode(arr["likes"]);
			var textName = document.createTextNode(input);

			buttonNode.setAttribute("class", "userLikeButton custom");
			buttonNode.setAttribute("onclick", "likeUserEvent(event, "+ arr["id"] +")")
			spanLikesNode.setAttribute("class", "likes");
			spanEventNode.setAttribute("class", "userEvent");

			spanLikesNode.appendChild(textLikes);
			spanEventNode.appendChild(textName);

			buttonNode.appendChild(spanLikesNode);
			buttonNode.appendChild(spanEventNode);

			listNode.appendChild(buttonNode);
			dayList.appendChild(listNode);

		} else {
			var dayEvents = $('#'+arr["day"]+' .userEvents .userEvent');
			for (var i = 0; i <= dayEvents.length - 1; i++) {
				if( dayEvents[i].innerText.toLowerCase() == input.toLowerCase()) {
					dayEvents[i].previousElementSibling.innerText = arr["likes"];

					break;
				}
			}
		}

		e.target.parentNode.parentNode.previousElementSibling.firstChild.value = "";
	}).fail( function() {
		alert("Oops something went wrong :/");
	});
}

function likeUserEvent(e, id) {

	if (e.target.parentNode.className != 'userLikeButton custom') {
		return;
	}
	
	$.ajax({
		method: "POST",
		url: urlLikeUserEvent,
		data: { eventId: id}
	}).done(function(arr) {
		var element = e.target.parentNode.firstChild;
		element.innerText = arr["likes"];
		element.style.background = arr["color"];
	}).fail(function() {
		alert("Oops something went wrong :/");
	});
}