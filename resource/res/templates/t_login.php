<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?=Info::TITLE?>
	</title>
	<link rel="stylesheet" href="../res/css/style.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/script.js"></script>
	<script src="../res/js/materialize.min.js"></script>
</head>

<body class="bg-login">
	<div id="st"></div>
	<div class="fade">
		<div class="login fadeIn">
			<h4 class="title-login">Đăng Nhập</h4>
			<div class="login-form">
				<div class="row">
					<img src="/res/img/loading.gif" alt="" id="loading" class="img-loading hidden">
					<div class="input-field" id="login-field">
						<input type="text" name="username" id="username" class="validate">
						<label for="username" id="lbl_usr">Tài Khoản Hoặc Email</label>
					</div>
					<div class="input-field" id="login-field">
						<input type="password" name="password" id="password" class="validate hidden">
						<label for="password" id="lbl_pw" class="hidden">Mật Khẩu</label>
					</div>
					<div class="login-btn">
						<button class="btn waves-effect waves-light green darken-4" onclick="submit_login()" id="btn-login">Đăng Nhập
						</button>
						<button class="btn waves-effect waves-light orange darken-1" onclick="submit_forgot_password()" id="btn-fotgot">Quên MK?
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>