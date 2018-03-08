<?php
/**
* Controller Student
* Author: Dzu
* Mail: dzu6996@gmail.com
**/
require_once 'controller.php';
include_once('models/model_student.php');

class Controller_Student extends Controller
{
	public $info =  array();
	public function __construct()
	{
		$user_info = $this->profiles();
		$this->info['ID'] = $user_info->ID;
		$this->update_last_login($this->info['ID']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['class_id'] = $user_info->class_id;
		$this->info['grade_id'] = $user_info->grade_id;
	}
	public function profiles()
	{
		$profiles = new Model_Student();
		return $profiles->get_profiles($_SESSION['username']);
	}
	public function get_question($ID)
	{
		$answer = new Model_Student();
		return $answer->get_question($ID);
	}
	public function update_last_login()
	{
		$info = new Model_Student();
		$info->update_last_login($this->info['ID']);
	}
	public function insert_score($unit,$score)
	{
		$info = new Model_Student();
		$info->insert_score($this->info['ID'], $unit, $score, $this->info['class_id']);
	}
	public function get_profiles()
	{
		$profiles = new Model_Student();
		echo json_encode($profiles->get_profiles($this->info['username']));
	}
	public function get_units()
	{
		$units = new Model_Student();
		echo json_encode($units->get_units());
	}
	public function get_rand_questions()
	{
		$result = array();
		$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
		$quest = new Model_Student();
		$score = $quest->get_score($this->info['ID'],$this->info['class_id'],$unit);
		if($score != null)
		{
			$result[] = $score;
			$result['status'] = 0;
		} else {
			$result[] = $quest->get_rand_questions($this->info['grade_id'],$unit);
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function get_notifications()
	{
		$noti = new Model_Student();
		echo json_encode($noti->get_notifications($this->info['class_id']));
	}
	public function get_chats()
	{
		$chats = new Model_Student();
		echo json_encode($chats->get_chats($this->info['class_id']));
	}
	public function get_chat_all()
	{
		$chat_all = new Model_Student();
		echo json_encode($chat_all->get_chat_all($this->info['class_id']));
	}
	public function valid_email_on_profiles()
	{
		$result = array();
		$valid = new Model_Student();
		$new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
		$curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
		if (empty($new_email)) {
			$result['status'] = 0;
		} else {
			if ($valid->valid_email_on_profiles($curren_email, $new_email)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function update_avatar($avatar, $username)
	{
		$info = new Model_Student();
		return $info->update_avatar($avatar, $username);
	}
	public function submit_update_avatar()
	{
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		if (isset($_FILES['file'])) {
			$duoi = explode('.', $_FILES['file']['name']);
			$duoi = $duoi[(count($duoi)-1)];
			if ($duoi === 'jpg' || $duoi === 'png') {
				if (move_uploaded_file($_FILES['file']['tmp_name'], 'res/img/avatar/'.$username.'_' . $_FILES['file']['name'])) {
					$avatar = $username .'_' . $_FILES['file']['name'];
					$update = $this->update_avatar($avatar, $username);
				}
			}
		}
	}
	public function send_chat()
	{
		$result = array();
		$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';
		if(empty($content)) {
			$result['status_value'] = "Nội dung trống";
			$result['status'] = 0;
		} else {
			$m = new Model_Student();
			$m->chat($this->info['username'], $this->info['name'], $this->info['class_id'], $content);
			$result['status_value'] = "Thành công";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function send_exam()
	{
		$result = array();
		$ID = array();
		$answer = array();
		$correct = array();
		$score = 0;
		$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
		for ($i=1; $i <= 10; $i++) { 
			$ID[$i] =  $_POST['quest_'.$i.'_id'];
			$answer[$i] = isset($_POST['quest_'.$i.'_answer']) ? $_POST['quest_'.$i.'_answer'] : '';
			$correct[$i] = $this->get_question($ID[$i])->correct_answer;
			if($answer[$i] != ''&&($correct[$i] == $answer[$i]))
				$score++;
		}
		$this->insert_score($unit,$score);
		for ($i=1; $i <= 10; $i++) { 
			$quest = $this->get_question($ID[$i]);
			$quest->answer = $answer[$i];
			$result[] = $quest;
		}
		$result['score'] = $score;
		echo json_encode($result);
	}
	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$info = new Model_Student();
		return $info->update_profiles($username, $name, $email, $password, $gender, $birthday);
	}
	public function submit_update_profiles()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($gender)||empty($birthday)||empty($password)||empty($email)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->update_profiles($username, $name, $email, $password, $gender, $birthday);
			if (!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				$result = json_decode(json_encode($this->profiles($username)), true);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}
	public function show_head_left()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_head_left($this->info);
	}
	public function show_index()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_index();
	}
	public function show_chat()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_chat();
	}
	public function show_chat_all()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_chat_all();
	}
	public function show_notifications()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_notifications();
	}
	public function show_exam()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_exam();
	}
	public function show_result()
	{
		$this->load_view("student");
		$view = new View_Student();
		$view->show_result();
	}
}
