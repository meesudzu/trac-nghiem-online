<?php
/**
 * View Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
require_once 'view.php';

class View_Admin extends View
{
    public function show_head_left($info)
    {
        require_once 'config/info.php';
        include 'res/templates/t_admin_head_left.php';
    }
    public function show_foot()
    {
        require_once 'config/info.php';
        include 'res/templates/t_foot.php';
    }
    public function show_admin_panel()
    {
        include 'res/templates/t_admin_panel.html';
    }
    public function show_teacher_panel()
    {
        include 'res/templates/t_teacher_panel.html';
    }
    public function show_class_panel()
    {
        include 'res/templates/t_class_panel.html';
    }
    public function show_student_panel()
    {
        include 'res/templates/t_student_panel.html';
    }
    public function show_question_panel()
    {
        include 'res/templates/t_question_panel.html';
    }
    public function notify_student()
    {
        include 'res/templates/t_ad_send_notify.php';
    }
    public function show_404()
    {
        include 'res/templates/t_404.php';
    }
}
