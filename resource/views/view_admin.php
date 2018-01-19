<?php

require_once 'view.php';
/**
 * View Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View_Admin extends View
{
    public function show_head_left($info)
    {
        require_once 'config/info.php';
        include 'res/templates/t_ad_head_left.php';
    }
    public function show_foot()
    {
        require_once 'config/info.php';
        include 'res/templates/t_foot.php';
    }
    public function show_admin_manager($list_admins)
    {
        include 'res/templates/t_ad_ql_admin.php';
    }
    public function show_teacher_manager($dsgv)
    {
        include 'res/templates/t_ad_ql_giao_vien.php';
    }
    public function show_class_manager($dsl, $dskhoi, $dsgv, $khoi, $gv)
    {
        include 'res/templates/t_ad_ql_lop.php';
    }
    public function show_student_manager($dshs, $dsl, $tenlop)
    {
        include 'res/templates/t_ad_ql_hoc_sinh.php';
    }
    public function show_question_manager($dsch, $dskhoi, $khoi)
    {
        include 'res/templates/t_ad_ql_cau_hoi.php';
    }
    public function notify_student($tbgv, $tbhs)
    {
        include 'res/templates/t_ad_send_notify.php';
    }
    public function show_404()
    {
        include 'res/templates/t_404.php';
    }
}
