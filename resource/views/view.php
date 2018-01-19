<?php

/**
 * View Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View {
	public function status_success($status)
	{
		include 'res/templates/t_stt_success.php';
	}
	public function status_failed($status)
	{
		include 'res/templates/t_stt_failed.php';
	}
}
?>