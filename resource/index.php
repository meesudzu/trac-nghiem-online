<?php


// Điều khiển index
include_once ('controller/controller.php');

// tạo đối tượng $index để loadView
$index = new Controller();
// nếu như đã thực hiện đăng nhập thành công thì tùy theo chức vụ người dùng để loadView tương ứng
if(isset($_SESSION['login']))
{
	if($_SESSION['chuc_vu']==3)
		$index->loadView('v_hoc_sinh');
	if($_SESSION['chuc_vu']==2)
		$index->loadView('v_giao_vien');
	if($_SESSION['chuc_vu']==1)
		$index->loadView('v_admin');
}
// nếu chưa đăng nhập thì thực hiện loadView đăng nhập
else
{
	// nếu có phương thức GET đăng nhập admin, loadView đăng nhập admin
	if(isset($_GET['admin']))
		$index->loadView('v_admin_login');
	// nếu có phương thức GET đăng nhập giao_vien, loadView đăng nhập giáo viên
	if(isset($_GET['giao_vien']))
		$index->loadView('v_giao_vien_login');
	//mặc định load view đang nhập học sinh
	if(!isset($_GET['admin'])&&!isset($_GET['giao_vien']))
		$index->loadView('v_hoc_sinh_login');
}

?>