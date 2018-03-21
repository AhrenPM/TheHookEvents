function toggleShow(id) {
	var dropList = $(id);
	if( dropList.css('display') == 'none' || dropList.css('display') == '') {
		dropList.css('display', 'block');
	} else {
		dropList.css('display', 'none');
	}
}

window.addEventListener('resize', function() {
	if(window.innerWidth < 1000) {
		$('#dropdownList').css('display', 'none');
	}
	if(window.innerWidth > 1001) {
		$('#dropdownList').css('display', 'block');
	}
})
