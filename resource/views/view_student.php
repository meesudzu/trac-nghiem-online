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
}
