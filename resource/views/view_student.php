<?php

require_once 'view.php';
/**
 * View Student
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View_Student extends View
{
	public function show_head_left($info)
	{
		require_once 'config/info.php';
		include 'res/templates/student_head_left.php';
	}
	public function show_index()
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
	public function show_exam()
	{
		include 'res/templates/student_exam.html';
	}
	public function show_result()
	{
		include 'res/templates/student_result.html';
	}
}
