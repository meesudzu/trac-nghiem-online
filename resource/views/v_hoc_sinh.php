<?php

/**
 * View học sinh 
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Hoc_Sinh{

	public function showHeadLeft($info,$diem)
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_hs_head_left.php';
	}
	public function showFoot()
	{
		require_once 'config/info.php';
		$info_config = new Info();
		include 'res/templates/t_foot.php';
	}
	public function showChat($chat)
	{
		include 'res/templates/t_hs_chat.php';
	}
	public function showAllChat($chat)
	{
		include 'res/templates/t_hs_all_chat.php';
	}
	public function showNotify($tbhs)
	{
		include 'res/templates/t_hs_nhan_tb.php';
	}
	//hàm hiển thị giao diện làm bài tập
	public function doEx($unit,$cau_hoi,$diem)
	{
		include 'res/templates/t_hs_lam_bai.php';
	}
	   //hàm hiển thị giao diện nộp bài và ghi điểm
	public function sendEx($unit,$ts_ch,$id_cauhoi,$cau_hoi,$da_cauhoi)
	{
		include 'res/templates/t_hs_nop_bai.php';
		return $diem;
	}
}
?>