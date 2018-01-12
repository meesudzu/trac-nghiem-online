<?php

require_once 'view.php';
/**
 * View Giáo Viên
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Giao_Vien extends View{

	public function showHeadLeft($info,$dsl)
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_gv_head_left.php';
	}
	public function showFoot()
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_foot.php';
	}
	public function sendNotify($tbhs)
	{
		include 'res/templates/t_gv_send_notify.php';
	}
	public function reNotify($tbgv)
	{
		include 'res/templates/t_gv_re_notify.php';
	}
	public function showDetails($id_lop,$dsl,$dsTenHS,$getCTL)
	{
		include 'res/templates/t_gv_details.php';
	}
}
?>