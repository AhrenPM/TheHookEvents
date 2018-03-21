function showSignUp() {
	var time = 600;
	var $login = $('#loginContainer');
	var $signup = $('#signUpContainer');
	$login.animate({'left' : '-50%'}, time);
	$login.css({'transform' : 'translateX(-100%)'}, time);
	$signup.animate({'left' : '50%'}, time);
	$signup.css({'transform' : 'translateX(-50%)'}, time);
}

function showLogin() {
	var time = 600;
	var $login = $('#loginContainer');
	var $signup = $('#signUpContainer');
	$login.animate({'left' : '50%'}, time);
	$login.css({'transform' : 'translateX(-50%)'}, time);
	$signup.animate({'left' : '150%'}, time);
	$signup.css({'transform' : 'translateX(0%)'}, time);
}