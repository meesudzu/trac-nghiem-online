<?php
/**
 * Index Site
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
session_start();
// session_destroy();
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_SESSION['login'])) {
    $controller = 'controller_'. $_SESSION['permission'];
    require_once 'controllers/'. $controller .'.php';
    $index = new $controller();
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '';
    if (is_callable([$index, $action])) {
        $index->$action();
    } else {
        $index->show_head_left();
        $index->show_404();
        $index->show_foot();
    }
} else {
    if (!isset($_GET['action'])) {
        $action = 'show_login';
    } else {
        $action = $_GET['action'];
    }
    require_once 'controllers/controller_login.php';
    $login = new Controller_Login();
    if (is_callable([$login, $action])) {
        $login->$action();
    } else {
        header("Refresh:0; url=index.php");
        $login->show_login();
    }
}
