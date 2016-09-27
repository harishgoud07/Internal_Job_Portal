$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

	$('#tab-button-login').click(function(event){
		if(!$('#tab-button-login').hasClass('active')) {
			$('#tab-button-register').removeClass('active');
			$('#tab-button-login').addClass('active');
		}
	});
	$('#tab-button-register').click(function(event){
		if(!$('#tab-button-register').hasClass('active')) {
			$('#tab-button-login').removeClass('active');
			$('#tab-button-register').addClass('active');
		}
	});

});
