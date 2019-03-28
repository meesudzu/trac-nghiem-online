<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * View Admin
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 **/

class View_Admin
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/admin/head_left.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_admins_panel()
    {
        include 'res/templates/admin/admins_panel.html';
    }
    public function show_dashboard($dashboard)
    {
        include 'res/templates/admin/dashboard.php';
    }
    public function show_teachers_panel()
    {
        include 'res/templates/admin/teachers_panel.html';
    }
    public function show_classes_panel()
    {
        include 'res/templates/admin/classes_panel.html';
    }
    public function show_students_panel()
    {
        include 'res/templates/admin/students_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/admin/questions_panel.html';
    }
    public function show_add_question()
    {
        include 'res/templates/admin/add_question.html';
    }
    public function show_edit_question($question, $grades, $subjects)
    {
        include 'res/templates/admin/edit_question.php';
    }
    public function show_subjects_panel()
    {
        include 'res/templates/admin/subjects_panel.html';
    }
    public function show_tests_panel()
    {
        include 'res/templates/admin/tests_panel.html';
    }
    public function show_tests_detail($questions)
    {
        include 'res/templates/admin/tests_detail.php';
    }
    public function show_test_score($test_code, $scores)
    {
        include 'res/templates/admin/test_score.php';
    }
    public function show_notifications_panel()
    {
        include 'res/templates/admin/notifications_panel.html';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
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
