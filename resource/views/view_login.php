<?php

/**
 * View Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
require_once 'view.php';

class View_Login extends View
{
    public function show_login()
    {
        require_once 'config/info.php';
        include 'res/templates/login.php';
    }
}
