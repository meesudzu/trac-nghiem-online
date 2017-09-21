<?php

/**
 * View Index Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
include_once ('controller/controller.php');
//tạo đối tượng $admin để thực hiện load các view
$admin = new Controller();

$admin->loadView('v_admin_head');//load view header

// kiểm tra phương thức get admin, nếu tồn tại, loadView tương ứng chức năng, nếu giá trị sai, loadView 404. nếu không tồn tại mặc định loadView quản lý admin
if(isset($_GET['admin']))
 {
	$check = true;
	if($_GET['admin']=='ql_cau_hoi')//load view quản lý câu hỏi
		{
			$admin->loadView('v_ql_cau_hoi');
			$check = false;
		}
	if($_GET['admin']=='ql_giao_vien')//load view quản lý giáo viên
		{
			$admin->loadView('v_ql_giao_vien');
			$check = false;
		}
	if($_GET['admin']=='ql_hoc_sinh')//load view quản lý học sinh
		{
			$admin->loadView('v_ql_hoc_sinh');
			$check = false;
		}
	if($_GET['admin']=='ql_lop')//load view quản lý lớp
		{
			$admin->loadView('v_ql_lop');
			$check = false;
		}
	if($_GET['admin']=='admin_gui_tb')//load view gửi thông báo
		{
			$admin->loadView('v_admin_gui_tb');
			$check = false;
		}
	if($check)//load view 404
		$admin->loadView('v_404');
}
 else
	 $admin->loadView('v_ql_admin');//load view quản lý admin
?>

<?php
$admin->loadView('v_foot');//load view footer
?>