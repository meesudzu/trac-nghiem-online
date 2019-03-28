<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * View Login
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 **/

class View_Login
{
    public function show_login()
    {
        require_once 'config/config.php';
        include 'res/templates/login.php';
    }
}
