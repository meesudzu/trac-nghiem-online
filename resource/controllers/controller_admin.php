<?php

include_once ('models/model_admin.php');
require_once 'controller.php';
/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller_Admin extends Controller
{
	private $info  = array(
		'admin_id' => '', 
		'username' => '', 
		'name' => '', 
		'permission' => '', 
		'permission_detail' => '', 
		'avatar' => '', 
		'last_login' => '', 
		'email' => '',
		'birthday' => '',
		'gender' => ''
	);

	public function __construct()
	{
		$user_info = $this->get_infomation($_SESSION['username'],$_SESSION['password']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['email'] = $user_info->email;
		$this->info['last_login'] = $user_info->last_login;
		$this->info['permission'] = $user_info->permission;
		$this->info['birthday'] = $user_info->birthday;
		$this->info['permission_detail'] = $this->get_permission_detail($this->info['permission'])->detail;
		$this->info['gender'] = $this->get_gender($user_info->gender_id);
	}
	public function show_logout()
	{
		$this->load_view('admin');
		$view = new View_Admin();
		$status = "Đăng xuất thành công!";
		$view->status_success($status);
		session_destroy();
		header( "Refresh:1.5; url=index.php");
	}
	public function get_infomation($username,$password)
	{
		$info = new Model_Admin();
		return $info->get_infomation($username,$password);
	}
	public function get_gender($gender_id)
	{
		$info = new Model_Admin();
		return $info->get_gender($gender_id);
	}
	public function get_permission_detail()
	{
		$cv = new Model_Admin();
		return $cv->get_permission_detail($this->info['permission']);
	}
	public function get_list_admins()
	{
		$list_admins = new Model_Admin();
		return $list_admins->get_list_admins();
	}
	public function edit_admin($admin_id,$username,$password,$name)
	{
		$edit = new Model_Admin();
		return $edit->edit_admin($admin_id,$username,$password,$name);
	}
	public function del_admin($admin_id)
	{
		$update = new Model_Admin();
		return $update->del_admin($admin_id);
	}
	public function add_admin($username,$password,$name)
	{
		$add = new Model_Admin();
		return $add->add_admin($username,$password,$name);
	}
	public function get_list_teachers()
	{
		$dsa = new Model_Admin();
		return $dsa->get_list_teachers();
	}
	public function edit_teacher($teacher_id,$username,$password,$name)
	{
		$edit = new Model_Admin();
		return $edit->edit_teacher($teacher_id,$username,$password,$name);
	}
	public function del_teacher($teacher_id)
	{
		$update = new Model_Admin();
		return $update->del_teacher($teacher_id);
	}
	public function add_teacher($username,$password,$name)
	{
		$add = new Model_Admin();
		return $add->add_teacher($username,$password,$name);
	}
	public function get_list_students()
	{
		$dsa = new Model_Admin();
		return $dsa->get_list_students();
	}
	public function edit_student($student_id,$username,$password,$name,$class_id)
	{
		$edit = new Model_Admin();
		return $edit->edit_student($student_id,$username,$password,$name,$class_id);
	}
	public function del_student($student_id,$class_id)
	{
		$update = new Model_Admin();
		return $update->del_student($student_id,$class_id);
	}
	public function add_student($username,$password,$name,$class_id)
	{
		$addhs = new Model_Admin();
		return $addhs->add_student($username,$password,$name,$class_id);
	}
	public function add_score($student_id,$class_id)
	{
		$adddiem = new Model_Admin();
		return $adddiem->add_score($student_id,$class_id);
	}
	public function get_class_name($class_id)
	{
		$namelop = new Model_Admin();
		return $namelop->get_class_name($class_id);
	}
	public function get_list_classes()
	{
		$dsl = new Model_Admin();
		return $dsl->get_list_classes();
	}
	public function editLop($class_id,$grade_id,$class_name,$teacher_id)
	{
		$edit = new Model_Admin();
		return $edit->editLop($class_id,$grade_id,$class_name,$teacher_id);
	}
	public function del_class($class_id)
	{
		$update = new Model_Admin();
		return $update->del_class($class_id);
	}
	public function add_class($grade_id,$class_name,$teacher_id)
	{
		$add = new Model_Admin();
		return $add->add_class($grade_id,$class_name,$teacher_id);
	}
	public function get_grade_detail($grade_id)
	{
		$tkhoi = new Model_Admin();
		return $tkhoi->get_grade_detail($grade_id);
	}
	public function get_grades()
	{
		$khoi = new Model_Admin();
		return $khoi->get_grade();
	}
	public function get_teacher_name($teacher_id)
	{
		$khoi = new Model_Admin();
		return $khoi->get_teacher_name($teacher_id);
	}
	public function get_list_questions()
	{
		$dsch = new Model_Admin();
		return $dsch->get_list_questions();
	}
	public function edit_question($question_id,$question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer)
	{
		$editch = new Model_Admin();
		return $editch->edit_question($question_id,$question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer);
	}
	public function del_question($question_id)
	{
		$delch = new Model_Admin();
		return $delch->del_question($question_id);
	}
	public function add_question($question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer)
	{
		$addch = new Model_Admin();
		return $addch->add_question($question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer);
	}
	public function notify_teacher($notification_title,$notification_content)
	{
		$send = new Model_Admin();
		return $send->notify_teacher($this->info['username'],$this->info['name'],$notification_title,$notification_content);
	}
	public function get_teacher_notifications()
	{
		$tbgv = new Model_Admin();
		return $tbgv->get_teacher_notifications();
	}
	public function notify_student($notification_title,$notification_content)
	{
		$send = new Model_Admin();
		return $send->notify_student($this->info['username'],$this->info['name'],$notification_title,$notification_content);
	}
	public function get_student_notifications()
	{
		$tbgv = new Model_Admin();
		return $tbgv->get_student_notifications();
	}
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
	public function show_admin_manager()
	{
		$list_admins = $this->get_list_admins();
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_admin_manager($list_admins);
		if(isset($_POST['add-admin']))
			$this->check_add_admin();
		if(isset($_POST['del-admin']))
			$this->check_del_admin();
		if(isset($_POST['edit-admin']))
			$this->check_edit_admin();
	}
	public function check_add_admin()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
		else
		{
			$add = $this->add_admin($username,$password,$name);
			if($add)
			{
				$status = "Thêm thành công!";
				$view->status_success($status);
			}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->status_failed($status);
			}
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_del_admin()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$admin_id = Htmlspecialchars($_POST['admin_id']);
		$this->del_admin($admin_id);
		$status = "Xóa thành công!";
		$view->status_success($status);
		echo '<meta http-equiv="refresh" connamet="2" />'; 
	}
	public function check_edit_admin()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$admin_id = Htmlspecialchars($_POST['admin_id']);
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
		else
		{
			$this->edit_admin($admin_id,$username,$password,$name);
			$status = "Sửa thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function show_teacher_manager()
	{
		$dsgv = $this->get_list_teachers();
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_teacher_manager($dsgv);
		if(isset($_POST['add-gv']))
			$this->check_add_teacher();
		if(isset($_POST['del-gv']))
			$this->check_del_teacher();
		if(isset($_POST['edit-gv']))
			$this->check_edit_teacher();
	}
	public function check_add_teacher()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
		else
		{
			$add = $this->addGV($username,$password,$name);
			if($add)
			{
				$status = "Thêm thành công!";
				$view->status_success($status);
			}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->status_failed($status);
			}
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_del_teacher()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$teacher_id = Htmlspecialchars($_POST['teacher_id']);
		$this->del_teacher($teacher_id);
		$status = "Xóa thành công!";
		$view->status_success($status);
		echo '<meta http-equiv="refresh" connamet="2" />'; 
	}
	public function check_edit_teacher()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$teacher_id = Htmlspecialchars($_POST['teacher_id']);
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->status_failed($status);
		}
		else
		{
			$this->edit_teacher($teacher_id,$username,$password,$name);
			$status = "Sửa thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		} 
	}
	public function show_class_manager()
	{
		$dsl = $this->get_list_classes();
		$dskhoi = $this->get_grade();
		$dsgv = $this->get_list_teachers();
		for ($i = 0; $i < count($dsl); $i++) { 
			$khoi[$i] = $this->get_grade_detail($dsl[$i]->grade_id);
			$gv[$i] = $this->get_teacher_name($dsl[$i]->teacher_id);
		}
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_class_manager($dsl,$dskhoi,$dsgv,$khoi,$gv);
		if(isset($_POST['edit-lop']))
			$this->check_edit_class();
		if(isset($_POST['del-lop']))
			$this->check_del_class();
		if(isset($_POST['add-lop']))
			$this->check_add_class();
	}
	public function check_add_class()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$class_name = Htmlspecialchars(addslashes($_POST['class_name']));
		$grade_id = Htmlspecialchars(addslashes($_POST['grade_id']));
		$teacher_id = Htmlspecialchars(addslashes($_POST['teacher_id']));
		if(empty($class_name)||empty($grade_id)||empty($teacher_id))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->status_failed($status);
		}
		else
		{
			$add = $this->add_class($grade_id,$class_name,$teacher_id);
			if($add)
			{
				$status = "Thêm thành công!";
				$view->status_success($status);
			}
			else
			{
				$status = "Lỗi! Lớp đã tồn tại!";
				$view->status_failed($status);
			}
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_del_class()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$class_id = Htmlspecialchars($_POST['class_id']);
		$this->del_class($class_id);
		$status = "Xóa thành công!";
		$view->status_success($status);
		echo '<meta http-equiv="refresh" connamet="2" />'; 
	}
	public function check_edit_class()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$class_id = Htmlspecialchars($_POST['class_id']);
		$class_name = Htmlspecialchars(addslashes($_POST['class_name']));
		$grade_id = Htmlspecialchars(addslashes($_POST['grade_id']));
		$teacher_id = Htmlspecialchars(addslashes($_POST['teacher_id']));
		if(empty($class_name)||empty($grade_id)||empty($teacher_id))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->status_failed($status);
		}
		else
		{
			$this->edit_class($class_id,$grade_id,$class_name,$teacher_id);
			$status = "Sửa thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function show_student_manager()
	{
		$dshs = $this->get_list_students();
		$dsl = $this->get_list_classes();
		for ($i = 0; $i < count($dshs); $i++)
			$namelop[$i] = $this->get_class_name($dshs[$i]->class_id);		
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_student_manager($dshs,$dsl,$namelop);
		if(isset($_POST['add-hs']))
			$this->check_add_student();
		if(isset($_POST['del-hs']))
			$this->check_del_student();
		if(isset($_POST['edit-hs']))
			$this->check_edit_student();
	}
	public function check_add_student()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		$class_id = Htmlspecialchars(addslashes($_POST['class_id']));
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->status_failed($status);
		}
		else
		{
			$add = $this->add_student($username,$password,$name,$class_id);
			$this->add_score($last_id,$class_id);
			if($add)
			{
				$status = "Thêm thành công!";
				$view->status_success($status);
			}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->status_failed($status);
			}
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_edit_student()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$student_id = Htmlspecialchars($_POST['student_id']);
		$name = Htmlspecialchars(addslashes($_POST['name']));
		$username = Htmlspecialchars(addslashes($_POST['username']));
		$password = md5($_POST['password']);
		$class_id = Htmlspecialchars(addslashes($_POST['class_id']));
		if(empty($name)||empty($username)||empty($password))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->status_failed($status);
		}
		else
		{
			$this->edit_student($student_id,$username,$password,$name,$class_id);
			$status = "Sửa thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_del_student()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$student_id = Htmlspecialchars($_POST['student_id']);
		$class_id = Htmlspecialchars($_POST['class_id']);
		$this->del_student($student_id,$class_id);
		$status = "Xóa thành công!";
		$view->status_success($status);
		echo '<meta http-equiv="refresh" connamet="2" />'; 
	}
	public function show_question_manager()
	{
		$dsch = $this->get_list_questions();
		$dskhoi = $this->get_grade();
		for ($i = 0; $i < count($dsch); $i++)
			$khoi[$i] = $this->get_grade_detail($dsch[$i]->grade_id);
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_question_manager($dsch,$dskhoi,$khoi);
		if(isset($_POST['add-ch']))
			$this->check_add_question();
		if(isset($_POST['del-ch']))
			$this->check_del_question();
		if(isset($_POST['edit-ch']))
			$this->check_edit_question();
	}
	public function check_add_question()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$question_detail = Htmlspecialchars(addslashes($_POST['question_detail']));
		$grade_id = Htmlspecialchars(addslashes($_POST['grade_id']));
		$unit = Htmlspecialchars(addslashes($_POST['unit']));
		$answer_a = Htmlspecialchars(addslashes($_POST['answer_a']));
		$answer_b = Htmlspecialchars(addslashes($_POST['answer_b']));
		$answer_c = Htmlspecialchars(addslashes($_POST['answer_c']));
		$answer_d = Htmlspecialchars(addslashes($_POST['answer_d']));
		$correct_answer = Htmlspecialchars(addslashes($_POST['correct_answer']));
		if(empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer))
		{
			$status = "Không được bỏ trống các trường nhập";
			$view->status_failed($status);
		}
		else
		{
			$this->add_question($question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer);     
			$status = "Thêm thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
	}
	public function check_del_question()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$question_id = Htmlspecialchars($_POST['question_id']);
		$this->del_question($question_id);
		$status = "Xóa thành công!";
		$view->status_success($status);
		echo '<meta http-equiv="refresh" connamet="2" />'; 
	}
	public function check_edit_question()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$question_id = Htmlspecialchars($_POST['question_id']);
		$question_detail = Htmlspecialchars(addslashes($_POST['question_detail']));
		$grade_id = Htmlspecialchars(addslashes($_POST['grade_id']));
		$unit = Htmlspecialchars(addslashes($_POST['unit']));
		$answer_a = Htmlspecialchars(addslashes($_POST['answer_a']));
		$answer_b = Htmlspecialchars(addslashes($_POST['answer_b']));
		$answer_c = Htmlspecialchars(addslashes($_POST['answer_c']));
		$answer_d = Htmlspecialchars(addslashes($_POST['answer_d']));
		$correct_answer = addslashes($_POST['correct_answer']);
		if(empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
		else
		{
			$this->edit_question($question_id,$question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer);
			$status = "Sửa thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		} 
	}
	public function notification_manager()
	{
		$tbgv = $this->get_teacher_notifications();
		$tbhs = $this->get_student_notifications();
		$this->load_view("admin");
		$view = new View_Admin();
		$view->notification_manager($tbgv,$tbhs);
		if(isset($_POST['send_gv']))
			$this->check_notify_teacher();
		if(isset($_POST['send_hs']))
			$this->check_notify_student();
	}
	public function check_notify_teacher()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_gv'])));
		$notification_content = Htmlspecialchars(trim(addslashes($_POST['notification_content_gv'])));
		if($chu_de != '' && $notification_content != '')
		{
			$this->notify_teacher($chu_de,$notification_content);
			$status = "Gửi thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
		else
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
	}
	public function check_notify_student()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_hs'])));
		$notification_content = Htmlspecialchars(trim(addslashes($_POST['notification_content_hs'])));
		if($chu_de != '' && $notification_content != '')
		{
			$this->notify_student($chu_de,$notification_content);
			$status = "Gửi thành công!";
			$view->status_success($status);
			echo '<meta http-equiv="refresh" connamet="2" />';
		}
		else
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->status_failed($status);
		}
	}
	public function show_404()
	{
		$this->load_view("admin");
		$view = new View_Admin();
		$view->show_404();
	}

}
?>