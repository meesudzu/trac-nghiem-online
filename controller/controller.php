<?php

session_start();
/**
 * Controller Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller{

	// hàm loadView
	function loadView($view){
		include_once ('view/'.$view.'.php');
	}
}

?>