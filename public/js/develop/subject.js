function togglePart(e) {
	var node = e.target.parentNode;


	while(!node.classList.contains('part')) {
		node = node.parentNode;
	}

	var contains = node.firstElementChild.nextElementSibling;
	var stats = contains.nextElementSibling;

	var currentState = contains.style.display; 
	
	if( currentState == "" || currentState == "none" ) {
		contains.style.display = "block";
		stats.style.display = "block";
	} else {
		contains.style.display = "none";
		stats.style.display = "none";
	}
}