<?php

/**
 * View Login
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
	public function status($status)
	{
		include 'res/templates/t_status.php';
	}
	public function forGotPassWord()
	{
		include 'res/templates/t_forgot_password.php';
	}
}
?>