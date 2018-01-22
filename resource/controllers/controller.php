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
}
