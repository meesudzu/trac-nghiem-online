<?php
/**
 * Index Site
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
session_start();
// nếu như đã thực hiện đăng nhập thành công thì tùy theo chức vụ người dùng để load controller tương ứng
if(isset($_SESSION['login']))
{
	if($_SESSION['chuc_vu']==3)
	{
		require_once 'controllers/c_hoc_sinh.php';
		$index = new C_Hoc_Sinh();
		$index->showHeadLeft();
		if(isset($_GET['logout']))
			$index->logout();
		if(isset($_GET['unit']))				
			$index->doEx($_GET['unit']);
		if(isset($_GET['nop_bai']))			
			$index->sendEx();
		if(isset($_GET['luu_tru']))
			$index->showAllChat();
		if(!isset($_GET['luu_tru'])&&!isset($_GET['unit'])&&!isset($_GET['nop_bai']))
			$index->showChat();
		$index->showNotify();
		$index->showFoot();
	}
	if($_SESSION['chuc_vu']==2)
	{
		require_once 'controllers/c_giao_vien.php';
		$index = new C_Giao_Vien();
		$index->showHeadLeft();
		if(isset($_GET['logout']))
			$index->logout();
		if(isset($_GET['id_lop']))
			$index->showDetails((int)$_GET['id_lop']);
		else 
		{
			$index->sendNotify();
			$index->reNotify();
		}
		$index->showFoot();
	}
	if($_SESSION['chuc_vu']==1)
	{
		require_once 'controllers/c_admin.php';
		$admin = new C_Admin();
		$admin->showHeadLeft(); 
		if(isset($_GET['logout']))
			$admin->logout();
		$action = 'showQLAdmin';
		//gọi hàm tương ứng GET trong url
		if(isset($_GET['admin']))
			$action='show'. $_GET['admin'];
		//kiểm tra xem hàm được truyền trong GET có tồn tại không, nếu không báo 404
		if (is_callable([$admin, $action]))
    			$admin->$action();
    		else
    			$admin->show404();
		$admin->showFoot();
	}
}
// nếu chưa đăng nhập thì thực hiện load controller đăng nhập
else
{
	require_once 'controllers/c_login.php';
	$login = new C_Login();
	$login->showLogin();
	if(isset($_GET['login']))
		$login->checkLogin();
}

?>