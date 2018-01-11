<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$info->getTitle()?></title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="../res/css/style.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/bootstrap.min.js"></script>

</head>
<body class="bg-login">
	<div class="full">
		<div class="login">
			<h1 class="font">Đăng Nhập Hệ Thống Trắc Nghiệm Online</h1>
			<?php
		// hiển thị thông báo đăng nhập lỗi
			if(isset($_SESSION['login_error_gv'])){
				echo '<h3>'.$_SESSION['login_error_gv'].'</h3>';
			}
		// hiển thị thông báo đăng nhập thành công
			if(isset($_SESSION['login'])){
				echo '<h3>'.$_SESSION['login'].'</h3>';
			}

			?>
			<form action="?login" method="POST" class="f">
				<input type="text" name="tai_khoan" placeholder="Tài Khoản">
				<input type="password" name="mat_khau" placeholder="mật khẩu">
				<input type="radio" name="chuc_vu" id="hocSinh" value="hocSinh" checked>
				<label class="lbl-white" for="hocSinh">Học Sinh</label>
				<input type="radio" name="chuc_vu" id="giaoVien" value="giaoVien">
				<label class="lbl-white" for="giaoVien">Giáo Viên</label>
				<input type="radio" name="chuc_vu" id="admin" value="admin">
				<label class="lbl-white" for="admin">Admin</label><br />
				<button type="submit" name='dang_nhap'>Đăng Nhập</button>
			</form>
		</div>
	</div>
</body>
</html>