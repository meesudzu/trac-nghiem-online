<?php

/**
 * View đăng nhập
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Login {
	public function showLogin()
	{
		require_once 'config/info.php';
		$info = new Info();
		include 'res/templates/t_login.php';
	}
	public function loginNotify($status)
	{
		include 'res/templates/t_login_status.php';
	}
}
?>