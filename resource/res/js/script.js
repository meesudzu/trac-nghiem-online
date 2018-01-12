//remove placeholder when focus input
$( document ).ready(function() {
	var $placeholder = '';
	$( "input" ).focus(function() {
		$placeholder = $(this).attr('placeholder');
		$(this).removeAttr('placeholder');
	});
	$( "input" ).focusout(function() {
		$(this).attr('placeholder' , $placeholder);
	});
});