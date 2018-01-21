<?php
/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
require_once('models/model_admin.php');
require_once 'controller.php';

class Controller_Admin extends Controller
{
	private $info  = array();

	public function __construct()
	{
		$user_info = $this->get_admin_info($_SESSION['username']);
		$this->info['admin_id'] = $user_info->admin_id;
		$this->update_last_login($this->info['admin_id']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['email'] = $user_info->email;
		$this->info['last_login'] = $user_info->last_login;
		$this->info['birthday'] = $user_info->birthday;
		$this->info['permission'] = $user_info->permission_detail;
		$this->info['gender'] = $user_info->gender_detail;
	}
	public function logout()
	{
		$result = array();
		$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : false;
		if($confirm)
		{
			$result['status_value'] = "Đăng xuất thành công!";
			$result['status'] = 1;
			session_destroy();
		}
		echo json_encode($result);
	}
	public function get_admin_info($username)
	{
		$info = new Model_Admin();
		return $info->get_admin_info($username);
	}
	public function get_teacher_info($username)
	{
		$info = new Model_Admin();
		return $info->get_teacher_info($username);
	}
	public function get_student_info($username)
	{
		$info = new Model_Admin();
		return $info->get_student_info($username);
	}	
	public function get_class_info($class_name)
	{
		$info = new Model_Admin();
		return $info->get_class_info($class_name);
	}
	public function get_question_info($ID)
	{
		$info = new Model_Admin();
		return $info->get_question_info($ID);
	}		
	public function update_last_login()
	{
		$info = new Model_Admin();
		$info->update_last_login($this->info['admin_id']);
	}
	public function get_list_admins()
	{
		$list_admins = new Model_Admin();
		echo json_encode($list_admins->get_list_admins());
	}
	public function get_list_grades()
	{
		$list_grades = new Model_Admin();
		echo json_encode($list_grades->get_list_grades());
	}
	public function get_list_units()
	{
		$list_units = new Model_Admin();
		echo json_encode($list_units->get_list_units());
	}
	public function valid_username_or_email()
	{
		$result = array();
		$valid = new Model_Admin();
		$usr_or_email = isset($_GET['usr_or_email']) ? htmlspecialchars($_GET['usr_or_email']) : '';
		if (empty($usr_or_email)) {
			$result['status'] = 0;
		} else {
			if ($valid->valid_username_or_email($usr_or_email)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function valid_class_name()
	{
		$result = array();
		$valid = new Model_Admin();
		$class_name = isset($_GET['class_name']) ? htmlspecialchars($_GET['class_name']) : '';
		if (empty($class_name)) {
			$result['status'] = 0;
		} else {
			if ($valid->valid_class_name($class_name)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function edit_admin($admin_id, $password, $name,$gender_id,$birthday)
	{
		$edit = new Model_Admin();
		return $edit->edit_admin($admin_id, $password, $name,$gender_id,$birthday);
	}
	public function del_admin($admin_id)
	{
		$del = new Model_Admin();
		return $del->del_admin($admin_id);
	}
	public function add_admin($name, $username, $password, $email, $birthday, $gender)
	{
		$add = new Model_Admin();
		return $add->add_admin($name, $username, $password, $email, $birthday, $gender);
	}
	public function get_list_teachers()
	{
		$list_teachers = new Model_Admin();
		echo json_encode($list_teachers->get_list_teachers());
	}
	public function edit_teacher($teacher_id, $password, $name,$gender_id,$birthday)
	{
		$edit = new Model_Admin();
		return $edit->edit_teacher($teacher_id, $password, $name,$gender_id,$birthday);
	}
	public function del_teacher($teacher_id)
	{
		$del = new Model_Admin();
		return $del->del_teacher($teacher_id);
	}
	public function add_teacher($name, $username, $password, $email, $birthday, $gender)
	{
		$add = new Model_Admin();
		return $add->add_teacher($name, $username, $password, $email, $birthday, $gender);
	}
	public function get_list_students()
	{
		$list_students = new Model_Admin();
		echo json_encode($list_students->get_list_students());
	}
	public function edit_student($student_id, $birthday, $password, $name, $class_id,$gender)
	{
		$edit = new Model_Admin();
		$edit->edit_student($student_id, $birthday, $password, $name, $class_id,$gender);
	}
	public function del_student($student_id)
	{
		$del = new Model_Admin();
		$del->del_student($student_id);
	}
	public function add_student($username, $password, $name, $class_id,$email,$birthday,$gender)
	{
		$add_student = new Model_Admin();
		return $add_student->add_student($username, $password, $name, $class_id,$email,$birthday,$gender);
	}
	public function get_list_classes()
	{
		$list_classes = new Model_Admin();
		echo json_encode($list_classes->get_list_classes());
	}
	public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
	{
		$edit = new Model_Admin();
		$edit->edit_class($class_id, $grade_id, $class_name, $teacher_id);
	}
	public function del_class($class_id)
	{
		$del = new Model_Admin();
		$del->del_class($class_id);
	}
	public function add_class($grade_id, $class_name, $teacher_id)
	{
		$add = new Model_Admin();
		return $add->add_class($grade_id, $class_name, $teacher_id);
	}
	public function get_list_questions()
	{
		$list_questions = new Model_Admin();
		echo json_encode($list_questions->get_list_questions());
	}
	public function edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
	{
		$edit = new Model_Admin();
		$edit->edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
	}
	public function del_question($ID)
	{
		$del = new Model_Admin();
		$del->del_question($ID);
	}
	public function add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
	{
		$add_question = new Model_Admin();
		return $add_question->add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
	}
	// public function notify_teacher($notification_title, $notification_content)
	// {
	//     $send = new Model_Admin();
	//     return $send->notify_teacher($this->info['username'], $this->info['name'], $notification_title, $notification_content);
	// }
	// public function get_teacher_notifications()
	// {
	//     $tbgv = new Model_Admin();
	//     return $tbgv->get_teacher_notifications();
	// }
	// public function notify_student($notification_title, $notification_content)
	// {
	//     $send = new Model_Admin();
	//     return $send->notify_student($this->info['username'], $this->info['name'], $notification_title, $notification_content);
	// }
	// public function get_student_notifications()
	// {
	//     $tbgv = new Model_Admin();
	//     return $tbgv->get_student_notifications();
	// }
	public function show_head_left()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_head_left($this->info);
	}
	public function show_foot()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_foot();
	}
	public function show_admin_panel()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_admin_panel();
	}
	public function check_add_admin()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		if (empty($name)||empty($username)||empty($password)||empty($email)||empty($birthday)||empty($gender)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$add = $this->add_admin($name, $username, $password, $email, $birthday, $gender);
			if ($add) {
				$result = json_decode(json_encode($this->get_admin_info($username)), True);
				$result['status_value'] = "Thêm thành công!";
				$result['status'] = 1;
			} else {
				$result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function check_del_admin()
	{
		$result = array();
		$admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
		$del = $this->del_admin($admin_id);
		if($del) {
			$result['status_value'] = "Xóa thành công!";
			$result['status'] = 1;
			$result['admin_id'] = $admin_id;
		} else {
			$result['status_value'] = "Tài khoản không tồn tại!";
			$result['status'] = 0;
		}
		echo json_encode($result);
	}
	public function check_edit_admin()
	{
		$result = array();
		$admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($gender_id)||empty($birthday)||empty($admin_id)||empty($password)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->edit_admin($admin_id, $password, $name,$gender_id,$birthday);
			if(!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				$result = json_decode(json_encode($this->get_admin_info($username)), True);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}
	public function show_teacher_panel()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_teacher_panel();
	}
	public function check_add_teacher()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($username)||empty($password)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender);
			if ($add) {
				$result = json_decode(json_encode($this->get_teacher_info($username)), True);
				$result['status_value'] = "Thêm thành công!";
				$result['status'] = 1;
			} else {
				$result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
				$return['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function check_del_teacher()
	{
		$result = array();
		$teacher_id = Htmlspecialchars($_POST['teacher_id']);
		$this->del_teacher($teacher_id);
		$result['status_value'] = "Xóa thành công!";
		$result['status'] = 1;
		$result['teacher_id'] = $teacher_id;
		echo json_encode($result);
	}
	public function check_edit_teacher()
	{
		$result = array();
		$teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($gender_id)||empty($birthday)||empty($teacher_id)||empty($password)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->edit_teacher($teacher_id, $password, $name,$gender_id,$birthday);
			if(!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				$result = json_decode(json_encode($this->get_teacher_info($username)), True);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}
	public function show_class_panel()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_class_panel();
	}
	public function check_add_class()
	{
		$result = array();
		$class_name = isset($_POST['class_name']) ? Htmlspecialchars(addslashes($_POST['class_name'])) : '';
		$grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
		$teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars(addslashes($_POST['teacher_id'])) : '';
		if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$add = $this->add_class($grade_id, $class_name, $teacher_id);
			if ($add) {
				$result = json_decode(json_encode($this->get_class_info($class_name)), True);
				$result['status_value'] = "Thêm thành công!";
				$result['status'] = 1;
			} else {
				$result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
				$return['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function check_del_class()
	{
		$result = array();
		$class_id = Htmlspecialchars($_POST['class_id']);
		$this->del_class($class_id);
		$result['status_value'] = "Xóa thành công!";
		$result['status'] = 1;
		$result['class_id'] = $class_id;
		echo json_encode($result);
	}
	public function check_edit_class()
	{
		$result = array();
		$class_id = isset($_POST['class_id']) ? Htmlspecialchars($_POST['class_id']) : '';
		$class_name = isset($_POST['class_name']) ? Htmlspecialchars($_POST['class_name']) : '';
		$grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
		$teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
		if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
			$result['status_value'] = "Không được bỏ trống các trưòng nhập";
			$result['status'] = 0;
		} else {
			$this->edit_class($class_id, $grade_id, $class_name, $teacher_id);
			$result = json_decode(json_encode($this->get_class_info($class_name)), True);
			$result['status_value'] = "Sửa thành công!";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function show_student_panel()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_student_panel();
	}
	public function check_add_student()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($username)||empty($password)) {
			$result['status_value'] = "Không được bỏ trống các trưòng nhập";
			$result['status'] = 0;
		} else {
			$add = $this->add_student($username, $password, $name, $class_id,$email,$birthday,$gender);
			if ($add) {
				$result = json_decode(json_encode($this->get_student_info($username)), True);
				$result['status_value'] = "Thêm thành công!";
				$result['status'] = 1;
			} else {
				$result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function check_edit_student()
	{
		$result = array();
		$student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($gender)||empty($birthday)||empty($student_id)||empty($password)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$this->edit_student($student_id, $birthday, $password, $name, $class_id,$gender);
			$result = json_decode(json_encode($this->get_student_info($username)), True);
			$result['status_value'] = "Sửa thành công!";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function check_del_student()
	{
		$result = array();
		$student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
		$this->del_student($student_id);
		$result['status_value'] = "Xóa thành công!";
		$result['status'] = 1;
		$result['student_id'] = $student_id;
		echo json_encode($result);
	}
	public function show_question_panel()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_question_panel();
	}
	public function check_add_question()
	{
		$result = array();
		$question_detail = isset($_POST['question_detail']) ? Htmlspecialchars(addslashes($_POST['question_detail'])) : '';
		$grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
		$unit = isset($_POST['unit']) ? Htmlspecialchars(addslashes($_POST['unit'])) : '';
		$answer_a = isset($_POST['answer_a']) ? Htmlspecialchars(addslashes($_POST['answer_a'])) : '';
		$answer_b = isset($_POST['answer_b']) ? Htmlspecialchars(addslashes($_POST['answer_b'])) : '';
		$answer_c = isset($_POST['answer_c']) ? Htmlspecialchars(addslashes($_POST['answer_c'])) : '';
		$answer_d = isset($_POST['answer_d']) ? Htmlspecialchars(addslashes($_POST['answer_d'])) : '';
		$correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars(addslashes($_POST['correct_answer'])) : '';
		if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập";
			$result['status'] = 0;
		} else {
			$ID = $this->add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
			$result = json_decode(json_encode($this->get_question_info($ID->AUTO_INCREMENT)), True);
			$result['status_value'] = "Thêm thành công!";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function check_del_question()
	{
		$return = array();
		$ID = isset($_POST['ID']) ? Htmlspecialchars($_POST['ID']) : '';
		$this->del_question($ID);
		$result['status_value'] = "Xóa thành công!";
		$result['status'] = 1;
		$result['ID'] = $ID;
		echo json_encode($result);
	}
	public function check_edit_question()
	{
		$result = array();
		$ID = isset($_POST['ID']) ? Htmlspecialchars($_POST['ID']) : '';
		$question_detail = isset($_POST['question_detail']) ? Htmlspecialchars($_POST['question_detail']) : '';
		$grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
		$unit = isset($_POST['unit']) ? Htmlspecialchars($_POST['unit']) : '';
		$answer_a = isset($_POST['answer_a']) ? Htmlspecialchars($_POST['answer_a']) : '';
		$answer_b = isset($_POST['answer_b']) ? Htmlspecialchars($_POST['answer_b']) : '';
		$answer_c = isset($_POST['answer_c']) ? Htmlspecialchars($_POST['answer_c']) : '';
		$answer_d = isset($_POST['answer_d']) ? Htmlspecialchars($_POST['answer_d']) : '';
		$correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars($_POST['correct_answer']) : '';
		$correct_answer = addslashes($_POST['correct_answer']);
		if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$this->edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
			$result = json_decode(json_encode($this->get_question_info($ID)), True);
			$result['status_value'] = "Sửa thành công!";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	// public function notification_panel()
	// {
	//     $tbgv = $this->get_teacher_notifications();
	//     $tbhs = $this->get_student_notifications();
	//     $this->load_view("admin");
	//     $view = new View_Admin();
	//     $view->notification_panel($tbgv, $tbhs);
	//     if (isset($_POST['send_gv'])) {
	//         $this->check_notify_teacher();
	//     }
	//     if (isset($_POST['send_hs'])) {
	//         $this->check_notify_student();
	//     }
	// }
	// public function check_notify_teacher()
	// {
	//     $this->load_view("admin");
	//     $view = new View_Admin();
	//     $chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_gv'])));
	//     $notification_content = Htmlspecialchars(trim(addslashes($_POST['notification_content_gv'])));
	//     if ($chu_de != '' && $notification_content != '') {
	//         $this->notify_teacher($chu_de, $notification_content);
	//         $status = "Gửi thành công!";
	//         $view->status_success($status);
	//         echo '<meta http-equiv="refresh" connamet="2" />';
	//     } else {
	//         $status = "Không được bỏ trống các trường nhập!";
	//         $view->status_failed($status);
	//     }
	// }
	// public function check_notify_student()
	// {
	//     $this->load_view("admin");
	//     $view = new View_Admin();
	//     $chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_hs'])));
	//     $notification_content = Htmlspecialchars(trim(addslashes($_POST['notification_content_hs'])));
	//     if ($chu_de != '' && $notification_content != '') {
	//         $this->notify_student($chu_de, $notification_content);
	//         $status = "Gửi thành công!";
	//         $view->status_success($status);
	//         echo '<meta http-equiv="refresh" connamet="2" />';
	//     } else {
	//         $status = "Không được bỏ trống các trường nhập!";
	//         $view->status_failed($status);
	//     }
	// }
	public function show_404()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_404();
	}
}
