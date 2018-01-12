<?php

/**
 * View Base
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class View {
	public function statusSuccess($status)
	{
		include 'res/templates/t_stt_success.php';
	}
	public function statusFailed($status)
	{
		include 'res/templates/t_stt_failed.php';
	}
}
?>