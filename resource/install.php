<?php 

/**
* INSTALL WIZARD
* Author: Dzu
* Mail: dzu6996@gmail.com
**/

error_reporting(0);
ini_set('display_errors', 0);

class install
{
	private $connect = '';
	private $connect_info = array();
	function step_0()
	{
		$require_check = true;
		echo '<div class="box">';
		echo '<div class="title-install">Kiểm Tra Hệ Thống</div>';
		echo '<div class="content-install">';
		echo '<strong>Trước khi cài đặt, yêu cầu máy chủ cần đáp ứng các điều kiện để tiếp tục cài đặt.</strong><br />';

		if(version_compare(PHP_VERSION, '7.0.0', '>=')) {
			$php_version = '<span class="pass">ĐẠT</span>';
		} else {
			$php_version = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if(extension_loaded('xml')) {
			$ext_xml = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_xml = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if(extension_loaded('xmlwriter')) {
			$ext_xmlwriter = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_xmlwriter = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if(extension_loaded('mbstring')) {
			$ext_mbstring = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_mbstring = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if(extension_loaded('zip')) {
			$ext_zip = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_zip = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		$ext_gd = extension_loaded('gd') ? '<span class="pass">ĐẠT</span>' : '<span class="failed">KHÔNG ĐẠT</span>';
		$ext_dom = extension_loaded('dom') ? '<span class="pass">ĐẠT</span>' : '<span class="failed">KHÔNG ĐẠT</span>';

		echo 'PHP 7.0.0: '.$php_version.'<br />';
		echo 'PHP extension XML: '.$ext_xml.'<br />';
		echo 'PHP extension xmlwriter: '.$ext_xmlwriter.'<br />';
		echo 'PHP extension mbstring: '.$ext_mbstring.'<br />';
		echo 'PHP extension ZipArchive: '.$ext_zip.'<br />';
		echo 'PHP extension GD (tùy chọn): '.$ext_gd.'<br />';
		echo 'PHP extension dom (tùy chọn): '.$ext_dom.'<br />';

		if($require_check) {
			echo '</div>';
			echo '</div>';
			$this->step_1();
		} else {
			echo '<span class="failed">Máy chủ không đạt đủ yêu cầu, liên hệ nhà cung cấp để biết thêm chi tiết.</span>';
			echo '</div>';
			echo '</div>';
		}
	}

	function step_1()
	{
		echo '<div class="box">';
		echo '<div class="title-install">Tiến Hành Cài Đặt</div>';
		echo '<div class="content-install">';

		if(isset($_POST['step_1'])) {
			$host = $this->connect_info['host'] = $_POST['host'];
			$user = $this->connect_info['user'] = $_POST['user'];
			$password = $this->connect_info['password'] = $_POST['password'];
			$database_name = $this->connect_info['dbname'] = $_POST['database_name'];

			$this->connect = new mysqli($host,$user,$password,$database_name);
			if($this->connect->connect_error)
				echo '<span class="failed">Kết nối cơ sở dữ liệu lỗi, vui lòng kiểm tra lại.</span>';
			else {
				$this->import_database();
				$this->step_2();
			}
		} else {
			echo '<strong>Nhập các thông số kết nối cơ sở dữ liệu (Hãy chắc chắn bạn đã tạo sẵn 1 database).</strong><br />';

			echo '<form method="POST">';
			echo '<div class="input-field col s6">
			<input id="host" type="text" name="host" value="localhost" required>
			<label for="host">Database Host</label>
			</div>';
			echo '<div class="input-field col s6">
			<input id="user" type="text" name="user" required>
			<label for="user">Người dùng</label>
			</div>';
			echo '<div class="input-field col s6">
			<input id="password" type="text" name="password">
			<label for="password">Mật Khẩu</label>
			</div>';
			echo '<div class="input-field col s6">
			<input id="database_name" type="text" name="database_name" required>
			<label for="database_name">Tên Database</label>
			</div>';
			echo '<div class="input-field col s6">
			<button type="submit" name="step_1" class="waves-effect waves-light btn">TIẾP TỤC</button>
			</form>
			</div>';
			echo '<div class="input-field col s6">
			<a href="install.php?step=0" class="waves-effect waves-light btn">QUAY LẠI</a>
			</div>';
		}
		echo '</div></div>';
	}

	function step_2()
	{
		$this->save_config();
		echo "<span class='pass'>Cài đặt Hệ Thống Trắc Nghiệm Online thành công.</span><br />";
		echo "File install.php sẽ bị xóa sau quá trình cài đặt để đảm bảo vấn đề bảo mật.<br />";
		echo "Tài khoản mặc định: <b>admin</b><br />";
		echo "Mật khẩu: <b>123456</b> <br />";
		echo "Vui lòng đăng nhập và đổi mật khẩu ngay sau khi đăng nhập. <br />";
		echo 'Mọi thông tin chi tiết, hỗ trợ, góp ý, báo lỗi,<br />';
		echo"vui lòng liên hệ <span class='pass'>dzu6996@gmail.com</span> hoặc trực tiếp trang chính thức sản phẩm <a href='https://github.com/meesudzu/trac-nghiem-online'>TẠI ĐÂY</a>
		<br /><br />";
		echo '<a href="index.php" class="waves-effect waves-light btn">KẾT THÚC</a>';
	}

	function import_database()
	{
		//database file
		$filename = 'res/files/database.sql';
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line)
		{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
    			// Perform the query
				$this->connect->query($templine);
    			// Reset temp variable to empty
				$templine = '';
			}
		}
		echo "<br /><span class='pass'>Tạo cơ sở dữ liệu xong.</span><hr />";
	}
	function save_config()
	{
		//write config file
		$writer="<?php
return (object) array('host' => '".$this->connect_info['host']."','user' => '".$this->connect_info['user']."','password' => '".$this->connect_info['password']."','dbname' => '".$this->connect_info['dbname']."','INSTALL_MODE' => FALSE);
?>";
		$write=fopen('config/connect.php' , 'w');
		$a = fwrite($write,$writer);
		fclose($write);
		chmod('install.php',0777);
		rename('install.php','reinstall.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cài Đặt Hệ Thống Trắc Nghiệm Online</title>
	<link rel="stylesheet" href="res/css/normalize.css">
	<link rel="stylesheet" href="res/css/style.min.css">
	<link rel="stylesheet" href="res/css/font-awesome.css">
	<link rel="stylesheet" href="res/css/materialize.min.css">
	<script src="res/js/jquery.js"></script>
	<script src="res/js/materialize.min.js"></script>
	<style>
	span {
		font-weight: bold;
	}
	.pass {
		color: green;
	}
	.failed {
		color: red;
		background: none !important;
	}
	.box {
		margin: 10px;
		border: 1.5px solid #02796e;
		border-radius: 15px;
	}
	.title-install {
		padding: 20px;
		padding-left: 30px;
		font-size: 18px;
		color: white;
		background: #02796e;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}
	.content-install {
		padding: 20px;
		padding-left: 30px;
		font-size: 16px;
	}
</style>
</head>
<body>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper nav-green" style="text-align: center">
				<span style="font-weight: 100; font-size: 20px">Cài Đặt Hệ Thống Trắc Nghiệm Online</span>
			</div>
		</nav>
	</div>
	<div class="box-content box-content-mini" id="box-content" style="margin: auto">
		<?php
		$install = new install();
		$install->step_0();
		?>
	</div>
</body>
</html>