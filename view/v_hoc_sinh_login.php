<?php


/**
 * View đăng nhập cho ngừoi dùng học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
include_once ('controller/c_login.php');
// tạo đối tượng thuộc lớp login
$v_user = new C_Login();
// thực hiện kiểm tra vào đăng nhập hệ thống
if(isset($_POST['dang_nhap']))
{
	$tai_khoan = addslashes($_POST['tai_khoan']);
	$mat_khau = md5($_POST['mat_khau']);
	$v_user->hocSinh($tai_khoan,$mat_khau);
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hệ Thống Trắc Nghiệm Online</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="../res/css/style.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/bootstrap.min.js"></script>

</head>
<body class="bg-login">
	<div class="full">
		<div class="login">
			<h1 class="font">Học Sinh Đăng Nhập</h1>
			<?php
		// hiển thị thông báo đăng nhập lỗi
			if(isset($_SESSION['login_error_hs'])){
				echo '<h3>'.$_SESSION['login_error_hs'].'</h3>';
			}
		// hiển thị thông báo đăng nhập thành công
			if(isset($_SESSION['login'])){
				echo '<h3>'.$_SESSION['login'].'</h3>';
			}

			?>
			<form method="POST" class="f">
				<input type="text" name="tai_khoan" placeholder="Tài Khoản">
				<input type="password" name="mat_khau" placeholder="mật khẩu">
				<button type="submit" name='dang_nhap'>Đăng Nhập</button>
			</form>
		</div>
	</div>
</body>
</html>