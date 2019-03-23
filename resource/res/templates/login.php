<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?=Config::TITLE?>
	</title>
	<link rel="stylesheet" href="res/css/style.min.css">
	<link rel="stylesheet" href="res/css/font-awesome.css">
	<link rel="stylesheet" href="res/css/materialize.min.css">
	<script src="res/js/jquery.js"></script>
	<script src="res/js/login.js"></script>
	<script src="res/js/materialize.min.js"></script>
</head>

<body class="bg-login">
	<div id="status" class="status"></div>
	<div class="fade">
		<div class="login fadeInLogin">
			<h4 class="title-login">
			<i id="reload" class="material-icons" onclick="reload()" title="Quay lại">arrow_back</i>
			Đăng Nhập</h4>
			<div class="login-form">
				<div class="row" style="position: relative;">
					<img src="/res/img/loading.gif" alt="" id="loading" class="img-loading hidden">
					<form>
						<div class="input-field" id="field_username">
							<input type="text" name="username" id="username" required autofocus>
							<label for="username" id="lbl_usr">Tài Khoản</label>
							<div class="left-align" style="color: #3c763d;">
								<span>Tài khoản có thể là tên đăng nhập, mã học sinh hoặc email.</span>
							</div>
						</div>
						<div class="left-align" style="color: #3c763d;">
								<div id="hi" style="display: none;">Xin Chào: <b><span id="hi-text" style="color: blue; font-weight: bold"></span></b>, nhập mật khẩu để tiếp tục.</div>
							</div>
						<div class="input-field" id="field_password">
							<input type="password" name="password" id="password" class="hidden" required>
							<label for="password" id="lbl_pw" class="hidden">Mật Khẩu</label>
						</div>
						<div class="login-btn">
							<button type="submit" class="btn waves-effect waves-light green darken-4" onclick="submit_login()" id="btn-login">Đăng Nhập</button>
							<button class="btn waves-effect waves-light orange darken-1" onclick="submit_forgot_password()" id="btn-forgot">Quên MK?
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
