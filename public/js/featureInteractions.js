function likeFeature(event, id, carousel) {
	if( event.target.innerText == "Like") {
		event.target.innerText = "Liked";
	} else {
		event.target.innerText = "Like";
	}
	$.ajax({
		method: 'POST',
		url: urlLikeFeature,
		data: { featureId: id }
	}).done(function(like) {
		event.target.innerText = like[1];
		event.target.nextElementSibling.innerText = like[0];
	}).fail(function() {
		alert("Oops something went wrong :/");
	});
}

function goingFeature(event, id, carousel) {
	$.ajax({
		method: "POST",
		url: urlGoingFeature,
		data: { queueId: id }
	}).done(function(going) {
		event.target.innerText = going[1];
		event.target.nextElementSibling.innerText = going[0];
	}).fail(function() {
		alert("Oops something went wrong :/");
	});
}