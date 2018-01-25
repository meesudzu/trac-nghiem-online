<?php

/**
 * Controller Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller
{
    public function load_view($view)
    {
        require_once('views/view_'.$view.'.php');
    }
    public function load_model($model)
    {
        require_once('models/model_'.$model.'.php');
    }
    public function show_foot()
    {
        require_once 'views/view.php';
        $view = new View();
        $view->show_foot();
    }
    public function logout()
    {
        $result = array();
        $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : false;
        if ($confirm) {
            $result['status_value'] = "Đăng xuất thành công!";
            $result['status'] = 1;
            session_destroy();
        }
        echo json_encode($result);
    }
    public function show_404()
    {
        require_once 'views/view.php';
        $view = new View();
        $view->show_404();
    }
    public function show_about()
    {
        require_once 'views/view.php';
        $view = new View();
        $view->show_about();
    }
    public function show_profiles()
    {
        require_once 'views/view.php';
        $view = new View();
        $view->show_profiles();
    }
}
