<?php

/**
 * Controller Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller{

	// hàm load View
	function loadView($view){
		require_once ('views/v_'.$view.'.php');
	}
	// hàm load Model
	function loadModel($model){
		require_once ('models/m_'.$model.'.php');
	}
}

?>