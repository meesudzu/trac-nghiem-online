<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quên Mật Khẩu</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="../res/css/style.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/bootstrap.min.js"></script>

</head>
<body class="bg-login">
	<div class="full">
		<div class="login">
			<h1 class="font">Quên Mật Khẩu</h1>
			<form method="POST" class="f">
				<input type="text" name="email" placeholder="Email">
				<input type="radio" name="chuc_vu" id="hoc_sinh" value="hoc_sinh" checked>
				<label class="lbl-white" for="hoc_sinh">Học Sinh</label>
				<input type="radio" name="chuc_vu" id="giao_vien" value="giao_vien">
				<label class="lbl-white" for="giao_vien">Giáo Viên</label>
				<input type="radio" name="chuc_vu" id="admin" value="admin">
				<label class="lbl-white" for="admin">Admin</label><br />
				<button type="submit" name='forgotpw'>Đăng Nhập</button>
			</form>
		</div>
	</div>
</body>
</html>