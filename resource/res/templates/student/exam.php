<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Làm Bài Thi</title>
	<link rel="stylesheet" href="res/css/normalize.css">
	<link rel="stylesheet" href="res/css/style.min.css">
	<link rel="stylesheet" href="res/css/font-awesome.css">
	<link rel="stylesheet" href="res/css/materialize.min.css">
	<script src="res/js/jquery.js"></script>
	<script src="res/js/materialize.min.js"></script>
    <script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
	<script src="res/js/student_functions.js"></script>
</head>

<body class="body-login overflow scrollbar">
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper nav-green">
				<div class="left pad-left-20">
					<span class="title">Làm Bài Thi <?=$test[0]->test_code?></span>
				</div>
				<span class="brand-logo right cursor" id="timer"></span>
			</div>
		</nav>
		<div id="status" class="status"></div>
	</div>
	<div class="test-content">
		<div class="testing-left">
			<?php
			for ($i = 0; $i < count($test); $i++) {
				if($test[$i]->student_answer != "") {
					echo '<a href="#quest-'.($i+1).'" class="menu-link">Câu '.($i+1).' <span class="tick" id="tick-'.($i+1).'">✓</span></a>';
				} else {
					echo '<a href="#quest-'.($i+1).'" class="menu-link">Câu '.($i+1).' <span class="tick" id="tick-'.($i+1).'"></span></a>';
				}
			}
			?>
		</div>
		<div class="testing-right">
			<?php
			for($i = 0; $i < count($test); $i++) {
				?>
				<div id="quest-<?=($i+1)?>" class="item-quest">
					<div class="quest-title">Câu <?=($i+1)?> :</div>
					<div class="quest-content">
						<span><?=$test[$i]->question_content?></span>
					</div>
					<div class="quest-answer">
                            <div class="answer">
    							<label>
    								<?php
    								if (trim($test[$i]->student_answer) == trim($test[$i]->answer_a))
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a" checked />';
    								}
    								else
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a" />';
    								}
    								?>
    								<span><?=$test[$i]->answer_a?></span>
    							</label>
    						</div class="answer">
                            <div class="answer">
    							<label>
    								<?php
    								if (trim($test[$i]->student_answer) == trim($test[$i]->answer_b))
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b" checked />';
    								}
    								else
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b" />';
    								}
    								?>
    								<span><?=$test[$i]->answer_b?></span>
    							</label>
    						</div class="answer">
                            <div class="answer">
    							<label>
    								<?php
    								if (trim($test[$i]->student_answer) == trim($test[$i]->answer_c))
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c" checked />';
    								}
    								else
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c" />';
    								}
    								?>
    								<span><?=$test[$i]->answer_c?></span>
    							</label>
    						</div class="answer">
                            <div class="answer">
    							<label>
    								<?php
    								if (trim($test[$i]->student_answer) == trim($test[$i]->answer_d))
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d" checked />';
    								}
    								else
    								{
    									echo '<input name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d" />';
    								}
    								?>
    								<span><?=$test[$i]->answer_d?></span>
    							</label>
    						</div class="answer">
					</div>
				</div>
				<?php
			}
			?>
			<a href="nop-bai" class="btn" onclick="return confirm('Xác nhận nộp bài?')" style="width: 300px;margin-left: 40%;margin-bottom: 20px;">Nộp</a>
		</div>
		<div class="clear"></div>
	</div>
	<script>
		var min = <?=$min?>;
		var sec = <?=$sec?>;
		countdown();
		$('input[type=radio]').on("change", function () {
			var stt = $(this).data("stt");
			var idquest = $(this).data("idquest");
			var value = $(this).val();
			var data = {
				id: idquest,
				answer: value,
				min: min,
				sec: sec
			}
			var url = "index.php?action=update_answer";
			var success = function (result) {
				$('#tick-' + stt).text("✓");
			};
			$.post(url, data, success);
		})
		function countdown() {
			cdID = setInterval(function () {
				if (sec == 0) {
					min--;
					sec = 60;
				}
				sec--;
				if (min < 10) {
					$('#timer').css('color', 'red');
					min_text = '0' + min;
				} else {
					min_text = min;
				}
				if (sec < 10)
					sec_text = '0' + sec;
				else
					sec_text = sec;
				$('#timer').text(min_text + ':' + sec_text);
				if (min < 0) {
					alert('Hết giờ, hệ thống sẽ tự động nộp bài!');
					window.location.replace("nop-bai");
				}
			}, 1000);
		}

		$(window).scroll(function () {
		});
		$('a[href*="#"]:not([href="#"])').click(function () {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top - 65
					}, 500);
					return false;
				}
			}
		});
		window.onbeforeunload = function () {
			var url = "index.php?action=update_timing"
			var data = {
				min: min,
				sec: sec
			}
			var success = function () {};
			$.post(url, data, success);
		}
	</script>
</body>
<script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
</html>
