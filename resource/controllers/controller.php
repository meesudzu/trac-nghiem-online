<?php

/**
 * Controller Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller{

	// hàm load View
	function load_view($view){
		require_once ('views/view_'.$view.'.php');
	}
	// hàm load Model
	function load_model($model){
		require_once ('models/model_'.$model.'.php');
	}
}

?>