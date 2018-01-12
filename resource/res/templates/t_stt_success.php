<div class="status success" id="status"><span><?=$status?></span></div>
<script type="text/javascript">
	$('#status').animate({
		'height': '50',
		'line-height': '50px',
		'opacity' : '1'
	},450);
	$('#status').delay(1000).animate({
		'opacity' : '0',
		'height': '0',
		'line-height': '0px'
	},450,function() {
		$('#status').css('display', 'none');
	});
</script>