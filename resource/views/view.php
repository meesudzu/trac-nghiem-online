<?php

/**
 * View Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View
{
    const SHOW = "View";
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
    public function show_profiles()
    {
        include 'res/templates/profiles.html';
    }
    public function show_404()
    {
        include 'res/templates/404.html';
    }
}