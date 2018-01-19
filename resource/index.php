<?php
/**
 * Index Site
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
session_start();
// session_destroy();
if (isset($_SESSION['login'])) {
    // if ($_SESSION['permission']==3) {
    //     require_once 'controllers/controller_student.php';
    //     $index = new Controller_Student();
    //     $index->show_head_left();
    //     if (isset($_GET['logout'])) {
    //         $index->logout();
    //     }
    //     if (isset($_GET['unit'])) {
    //         $index->doEx($_GET['unit']);
    //     }
    //     if (isset($_GET['nop_bai'])) {
    //         $index->sendEx();
    //     }
    //     if (isset($_GET['luu_tru'])) {
    //         $index->showAllChat();
    //     }
    //     if (!isset($_GET['luu_tru'])&&!isset($_GET['unit'])&&!isset($_GET['nop_bai'])) {
    //         $index->showChat();
    //     }
    //     $index->showNotify();
    //     $index->showFoot();
    // }
    // if ($_SESSION['permission']==2) {
    //     require_once 'controllers/controller_teacher.php';
    //     $index = new Controller_Teacher();
    //     $index->show_head_left();
    //     if (isset($_GET['logout'])) {
    //         $index->logout();
    //     }
    //     if (isset($_GET['id_lop'])) {
    //         $index->showDetails((int)$_GET['id_lop']);
    //     } else {
    //         $index->sendNotify();
    //         $index->reNotify();
    //     }
    //     $index->showFoot();
    // }
    if ($_SESSION['permission']==1) {
        require_once 'controllers/controller_admin.php';
        $admin = new Controller_Admin();
        $admin->show_head_left();
        $action = 'show_admin_manager';
        if (isset($_GET['action'])) {
            $action='show_'. $_GET['action'];
        }
        if (is_callable([$admin, $action])) {
            $admin->$action();
        } else {
            $admin->show_404();
        }
        $admin->show_foot();
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
