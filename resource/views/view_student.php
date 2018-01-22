<?php

require_once 'view.php';
/**
 * View Học Sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Hoc_Sinh extends View
{
    public function showHeadLeft($info, $diem)
    {
        require_once 'config/info.php';
        include 'res/templates/hs_head_left.php';
    }
    public function showChat($chat)
    {
        include 'res/templates/hs_chat.php';
    }
    public function showAllChat($chat)
    {
        include 'res/templates/hs_all_chat.php';
    }
    public function showNotify($tbhs)
    {
        include 'res/templates/hs_nhan_tb.php';
    }
    //hàm hiển thị giao diện làm bài tập
    public function doEx($unit, $cau_hoi, $diem)
    {
        include 'res/templates/hs_lam_bai.php';
    }
    //hàm hiển thị giao diện nộp bài và ghi điểm
    public function sendEx($unit, $ts_ch, $id_cauhoi, $cau_hoi, $da_cauhoi)
    {
        include 'res/templates/hs_nop_bai.php';
        return $diem;
    }
}
