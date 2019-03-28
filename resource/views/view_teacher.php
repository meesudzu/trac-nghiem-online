<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * View Teacher
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 **/

class View_Teacher
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/teacher/head_left.php';
    }
    public function show_dashboard()
    {
        include 'res/templates/teacher/dashboard.html';
    }
    public function show_class_detail($class_name, $students)
    {
        include 'res/templates/teacher/class_detail.php';
    }
    public function show_notifications()
    {
        include 'res/templates/teacher/notifications.html';
    }
    
    public function show_list_test($tests)
    {
        include 'res/templates/teacher/list_test.php';
    }
    public function show_test_score($scores)
    {
        include 'res/templates/teacher/test_score.php';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/shared/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/shared/404.html';
    }
}
