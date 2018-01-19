<?php

/**
 * Model Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
include_once ('config/database.php');

class Model_Admin extends Database
{
	public function get_infomation($username,$password)
	{
		$sql = "SELECT admin_id,username,avatar,email,name,permission,last_login,gender_id,birthday FROM admins WHERE username = '$username' AND password = '$password'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_permission_detail($permission)
	{
		$sql = "SELECT detail FROM permissions WHERE permission='$permission'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_gender($gender_id)
	{
		$sql = "SELECT detail FROM genders WHERE gender_id='$gender_id'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_list_admins()
	{
		$sql = "SELECT * FROM admins";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function editAdmin($admin_id,$username,$password,$name)
	{
		$sql="UPDATE admin set username='$username', password='$password', name ='$name' where admin_id='$admin_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_admin($admin_id)
	{
		$sql="DELETE FROM admins where admin_id='$admin_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_admin($username,$password,$name)
	{
		$sql = "SELECT admin_id FROM admins WHERE username = '$username'";
		$this->set_query($sql);
		if($this->load_row()!='')
			return false;
	//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `admins` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO admins (username,password,name,permission) VALUES ('$username','$password','$name',1)";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_teachers()
	{
		$sql = "SELECT * FROM teachers";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_teacher($teacher_id,$username,$password,$name)
	{
		$sql="UPDATE teachers set username='$username', password='$password', name ='$name' where teacher_id='$teacher_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_teacher($teacher_id)
	{
		$sql="DELETE FROM teachers where teacher_id='$teacher_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_teacher($username,$password,$name)
	{
		$sql = "SELECT teacher_id FROM teachers WHERE username = '$username'";
		$this->set_query($sql);
		if($this->load_row()!='')
			return false;
	//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `teachers` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO teachers (username,password,name,permission) VALUES ('$username','$password','$name',2)";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_students()
	{
		$sql = "SELECT * FROM students";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_student($student_id,$username,$password,$name,$class_id)
	{
		$sql="UPDATE students set username='$username', password='$password', name ='$name', class_id ='$class_id' where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="UPDATE scores set class_id ='$class_id'  where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_student($student_id,$class_id)
	{
		$sql="DELETE FROM scores where student_id='$student_id' and class_id = '$class_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="DELETE FROM students where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_scores($student_id,$class_id)
	{
		$sql="INSERT INTO scores (student_id,unit_1,unit_2,unit_3,unit_4,class_id) VALUES ('$student_id',-1,-1,-1,-1,'$class_id')";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_student($username,$password,$name,$class_id)
	{
		$sql = "SELECT student_id FROM students WHERE username = '$username'";
		$this->set_query($sql);
		if($this->load_row()!='')
			return false;
	//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `students` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO students (username,password,name,permission,class_id) VALUES ('$username','$password','$name',3,'$class_id')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_class_name($class_id)
	{
		$sql = "SELECT class_name from classes where class_id = '$class_id'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_list_classes()
	{
		$sql = "SELECT * FROM classes";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_class($class_id,$grade_id,$class_name,$teacher_id)
	{
		$sql="UPDATE classes set grade_id='$grade_id', class_name='$class_name', teacher_id ='$teacher_id'  where class_id ='$class_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_class($class_id)
	{
		$sql="DELETE FROM classes where class_id='$class_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_class($grade_id,$class_name,$teacher_id)
	{
		$sql = "SELECT * FROM classes WHERE class_name = '$class_name'";
		$this->set_query($sql);
		if($this->load_row()!='')
			return false;
	//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `classes` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO classes (grade_id,class_name,teacher_id) VALUES ('$grade_id','$class_name','$teacher_id')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_grade_detail($grade_id)
	{
		$sql = "SELECT detail from grades where grade_id = '$grade_id'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_grades()
	{
		$sql = "SELECT * from grades";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_teacher_name($teacher_id)
	{
		$sql = "SELECT name from teachers where teacher_id = '$teacher_id'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_list_questions()
	{
		$sql = "SELECT * FROM quetions";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_question($question_id,$question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer)
	{
		$sql="UPDATE quetions set question_detail='$question_detail', grade_id='$grade_id', unit ='$unit',answer_a ='$answer_a',answer_b ='$answer_b',answer_c ='$answer_c',answer_d ='$answer_d',correct_answer ='$correct_answer' where question_id='$question_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_question($question_id)
	{
		$sql="DELETE FROM questions where question_id='$question_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_question($question_detail,$grade_id,$unit,$answer_a,$answer_b,$answer_c,$answer_d,$correct_answer)
	{
	//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `questions` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO questions (grade_id,unit,question_detail,answer_a,answer_b,answer_c,answer_d,correct_answer) VALUES ($grade_id,$unit,'$question_detail','$answer_a','$answer_b','$answer_c','$answer_d','$correct_answer')";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function notify_teacher($username,$name,$notification_title,$notification_content)
	{
		$sql="INSERT INTO notifications (username,name,notification_title,notification_content,thoi_gian,permission) VALUES ('$username','$name','$notification_title','$notification_content',NOW(),2)";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function get_teacher_notifications()
	{
		$sql = "SELECT * FROM notifications where permission = 2";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function notify_student($username,$name,$notification_title,$notification_content)
	{
		$sql="INSERT INTO notifications (username,name,notification_title,notification_content,time_sent,permission) VALUES ('$username','$name','$notification_title','$notification_content',NOW(),3)";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function get_student_notifications()
	{
		$sql = "SELECT * FROM notifications where permission = 3";
		$this->set_query($sql);
		return $this->load_rows();
	}
}
?>