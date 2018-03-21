$(function() {
	//Carousel slides
	var featContain = $('.homeCarousel .featureContainer');
	var featList = featContain.children();

	var curr = featList.first().css({'opacity': 1, 'z-index': 11});
	var currInd = 0;
	var next = curr.next();
	var nextInd = 1;
	var prev = featList.last();
	var prevInd = featList.length-1;

	//Carousel buttons
	var rBtn = $('button.arrow.right');
	var lBtn = $('button.arrow.left');
	
	function startSlider() {
		carouselInterval = setInterval(function(){
			nextSlide();
		}, 10000);
	}

	//go to the next slide
	function nextSlide() {

		curr.animate({'opacity' : 0, 'z-index' : 10}, 300, function() {
			currInd++;
			prevInd++;
			if(currInd == featList.length){
				curr = featList.first();
				currInd = 0;
			} else {
				curr = curr.next();
			}

			if(prevInd == featList.length){
				prev = featList.first();
				prevInd = 0;
			} else {
				prev = prev.next();
			}
		});
		next.animate({'opacity' : 1, 'z-index' : 11}, 300, function() {
			nextInd++;
			if(nextInd == featList.length){
				next = featList.first();
				nextInd = 0;
			} else {
				next = next.next();
			}
		});

	}

	//go to the previous slide
	function previousSlide() {
		curr.animate({'opacity' : 0, 'z-index' : 10}, 300, function() {
			currInd--;
			nextInd--;
			if(currInd == -1){
				curr = featList.last();
				currInd = featList.length-1;
			} else {
				curr = curr.prev();
			}

			if(nextInd == -1){
				next = featList.last();
				nextInd = featList.length-1;
			} else {
				next = next.prev();
			}
		});
		prev.animate({'opacity' : 1, 'z-index' : 11}, 300, function() {
			prevInd--;
			if(prevInd == -1){
				prev = featList.last();
				prevInd = featList.length-1;
			} else {
				prev = prev.prev();
			}
		});
	}

	//button functions

	function rBtnClick() {
		clearInterval(carouselInterval);
		//disable button
		rBtn.attr('disabled','disabled');
		setTimeout(function() {
			rBtn.prop('disabled','');
		}, 350);
		//move to next slide
		nextSlide();
		startSlider();
	}

	function lBtnClick() {
		clearInterval(carouselInterval);
		//disable button
		lBtn.attr('disabled','disabled');
		setTimeout(function() {
			lBtn.prop('disabled','');
		}, 350);
		//move to previous slide
		previousSlide();
		startSlider();
	}

	//event listeners
	rBtn.on('click', rBtnClick);
	lBtn.on('click', lBtnClick);

	//actions
	var $arrows = $('.homeCarousel .arrow');
	if(featList.length > 1 && $(window).width() > 1000) {
		startSlider();
	} else {
		$arrows.css({'display' : 'none'});
		startSlider();
		clearInterval(carouselInterval);
	}

});


function showDescription(event) {
	var desc = event.target.parentNode.nextElementSibling;
	if($(window).width() >= 1000) {
		desc.style.height = 'inherit';
	} else if($(window).width() < 1000) {
		desc.style.height = '100vh';
		disableScroll();
	}
	
	var featureList = $(".featureContainer li.featureItem");
	if(featureList.length > 1 && $(window).width() > 1000){
		clearInterval(carouselInterval);
	}
}

function hideDescription(event) {
	var desc = event.target.parentNode;
	if(desc.classList.contains("exit")) {
		desc = desc.parentNode;
	}
	if(desc.classList.contains("carouselDescription")) {
		desc.style.height = '0px';
	}
		enableScroll();
}


// disable scroll

function preventDefault(e) {
  e = e || window.event;
  if (e.preventDefault)
      e.preventDefault();
  e.returnValue = false;  
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
  if (window.addEventListener) // older FF
      window.addEventListener('DOMMouseScroll', preventDefault, false);
  window.onwheel = preventDefault; // modern standard
  window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
  window.ontouchmove  = preventDefault; // mobile
  document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.onmousewheel = document.onmousewheel = null; 
    window.onwheel = null; 
    window.ontouchmove = null;  
    document.onkeydown = null;  
}

//change width

function set999Css() {
	$("li.featureItem").css("opacity", 1);
	$("li.featureItem").css("z-index", "initial");
	$("button.right").css("display", "none");
	$("button.left").css("display", "none");


	var featureList = $(".featureContainer li.featureItem");
	if(featureList.length > 1){

		clearInterval(carouselInterval);
	}

}

function set1001Css() {

	$("button.right").css("display", "block");
	$("button.left").css("display", "block");
}

window.addEventListener('resize', function() {
	var width = $(window).innerWidth();
	if(width < 1000 && width > 640 ) {
		if(currentWidth == 999 || currentWidth == 641) {
			return;
		} else if(currentWidth > 1000) {
			currentWidth = 999;
			set999Css();
		} else if(currentWidth < 640) {
			currentWidth = 641;
			set999Css();
		}
	} else if(width < 640) {
		if(currentWidth == 639) {
			return;
		} else if(currentWidth > 640) {
			currentWidth = 639;
			set999Css();
		}
	} else if( width > 1000 ) {
		if(currentWidth == 1001) {
			return;
		} else if (currentWidth < 1000) {
			currentWidth = 1001;
			set1001Css();
		}
	}
});
