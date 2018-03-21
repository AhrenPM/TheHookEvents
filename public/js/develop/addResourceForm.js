function showFileIn(event) {
	// hide current label
	var fileLabel = event.target.parentElement;
	fileLabel.style.display = 'none';
	// show other label
	fileLabel.nextElementSibling.style.display = 'inline';

	// hide current input
	var form = $(fileLabel.parentElement.parentElement);
	form.find('[name="url"]').css({'display': 'none'});
	form.find('[name="url"]').attr('disabled', 'disabled');

	form.find('[name="file"]').css({'display': 'inline'});
	form.find('[name="file"]').prop('disabled', false);
}

function showUrlIn(event) {
	// hide current label
	var fileLabel = event.target.parentElement;
	fileLabel.style.display = 'none';
	// show other label
	fileLabel.previousElementSibling.style.display = 'inline';

	// hide current input
	var form = $(fileLabel.parentElement.parentElement);
	form.find('[name="url"]').css({'display': 'inline'});
	form.find('[name="url"]').prop('disabled', false);

	form.find('[name="file"]').css({'display': 'none'});
	form.find('[name="file"]').attr('disabled', 'disabled');
}