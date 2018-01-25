<?php

require_once 'view.php';
/**
 * View Teacher
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View_Teacher extends View
{
    public function show_head_left($info)
    {
        require_once 'config/info.php';
        include 'res/templates/teacher_head_left.php';
    }
        public function show_index()
    {
        include 'res/templates/teacher_index.html';
    }
}
