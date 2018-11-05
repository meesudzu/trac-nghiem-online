<?php
/**
 * View Teacher
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View_Teacher
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/teacher_head_left.php';
    }
    public function show_dashboard()
    {
        include 'res/templates/teacher_index.html';
    }
    public function show_class_detail()
    {
        include 'res/templates/teacher_class_detail.html';
    }
    public function show_notifications()
    {
        include 'res/templates/teacher_notifications.html';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/about.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/foot.php';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/404.html';
    }
}
