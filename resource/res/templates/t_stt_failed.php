<div class="status failed" id="status"><span><?=$status?></span></div>
<script type="text/javascript" id="script">
	$('#status').animate({
		'height': '65',
		'line-height': '65px',
		'opacity': '1'
	}, 250);
	$('#status').delay(1000).animate({
		'opacity': '0',
		'height': '0',
		'line-height': '0px'
	}, 250, function() {
		$('#status').remove();
		$('#script').html('').removeAttr('id').remove();
	});
</script>