<?php

/**
 * View Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Admin {
	
	public function showHeadLeft($info)
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_ad_head_left.php';
	}
	public function showFoot()
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_foot.php';
	}
	public function showQLAdmin($dsa)
	{
		include 'res/templates/t_ad_ql_admin.php';
	}
	public function showQLGiaoVien($dsgv)
	{
		include 'res/templates/t_ad_ql_giao_vien.php';
	}
	public function showQLLop($dsl,$dskhoi,$dsgv,$khoi,$gv)
	{
		include 'res/templates/t_ad_ql_lop.php';
	}
	public function showQLHocSinh($dshs,$dsl,$tenlop,$last_id)
	{
		include 'res/templates/t_ad_ql_hoc_sinh.php';
	}
	public function showQLCauHoi($dsch,$dskhoi,$khoi)
	{
		include 'res/templates/t_ad_ql_cau_hoi.php';
	}
	public function showSendNotify($tbgv,$tbhs)
	{
		include 'res/templates/t_ad_send_notify.php';
	}
	public function show404()
	{
		include 'res/templates/t_404.php';
	}
}
?>