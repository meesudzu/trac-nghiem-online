<?php

/**
 * View Student
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View_Student
{
	public function show_head_left($info)
	{
		require_once 'config/config.php';
		include 'res/templates/student_head_left.php';
	}
	public function show_dashboard()
	{
		include 'res/templates/student_index.html';
	}
	public function show_chat()
	{
		include 'res/templates/student_chat.html';
	}
	public function show_chat_all()
	{
		include 'res/templates/student_chat_all.html';
	}
	public function show_notifications()
	{
		include 'res/templates/student_notifications.html';
	}
	public function show_exam($test,$min,$sec)
	{
		include 'res/templates/student_exam.php';
	}
	public function show_result($score,$result)
	{
		include 'res/templates/student_result.php';
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
