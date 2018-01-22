<?php

require_once 'view.php';
/**
 * View Giáo Viên
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class V_Giao_Vien extends View
{
    public function showHeadLeft($info, $dsl)
    {
        require_once 'config/info.php';
        include 'res/templates/gv_head_left.php';
    }
    public function sendNotify($tbhs)
    {
        include 'res/templates/gv_send_notify.php';
    }
    public function reNotify($tbgv)
    {
        include 'res/templates/gv_re_notify.php';
    }
    public function showDetails($id_lop, $dsl, $dsTenHS, $getCTL)
    {
        include 'res/templates/gv_details.php';
    }
}
