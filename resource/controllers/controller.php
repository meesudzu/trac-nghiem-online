<?php

/**
 * Controller Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller{

	function load_view($view){
		require_once ('views/view_'.$view.'.php');
	}
	function load_model($model){
		require_once ('models/model_'.$model.'.php');
	}
}

?>