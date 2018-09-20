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
        require_once 'config/config.php';
        include 'res/templates/admin_head_left.php';
    }
    public function show_admins_panel()
    {
        include 'res/templates/admin_admins_panel.html';
    }
    public function show_dashboard()
    {
        include 'res/templates/admin_dashboard.html';
    }
    public function show_teachers_panel()
    {
        include 'res/templates/admin_teachers_panel.html';
    }
    public function show_classes_panel()
    {
        include 'res/templates/admin_classes_panel.html';
    }
    public function show_students_panel()
    {
        include 'res/templates/admin_students_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/admin_questions_panel.html';
    }
    public function show_notifications_panel()
    {
        include 'res/templates/admin_notifications_panel.html';
    }
    public function show_units_panel()
    {
        include 'res/templates/admin_units_panel.html';
    }
}
