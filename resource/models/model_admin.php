<?php

/**
 * Model Admin 
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/ 
include_once('config/database.php');

class Model_Admin extends Database
{
	public function get_admin_info($username)
	{
		$sql = "
		SELECT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM admins
		INNER JOIN permissions ON admins.permission = permissions.permission
		INNER JOIN genders ON admins.gender_id = genders.gender_id
		WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_teacher_info($username)
	{
		$sql = "
		SELECT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers
		INNER JOIN permissions ON teachers.permission = permissions.permission
		INNER JOIN genders ON teachers.gender_id = genders.gender_id WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_student_info($username)
	{
		$sql = "
		SELECT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students` 
		INNER JOIN classes ON students.class_id = classes.class_id
		INNER JOIN genders ON students.gender_id = genders.gender_id WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_class_info($class_name)
	{
		$sql = "
		SELECT class_id,class_name,name as teacher_name, detail as grade_detail FROM classes
		INNER JOIN grades ON classes.grade_id = grades.grade_id
		INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id
		WHERE class_name = '$class_name'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_list_admins()
	{
		$sql = "SELECT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM admins 
		INNER JOIN permissions ON admins.permission = permissions.permission 
		INNER JOIN genders ON admins.gender_id = genders.gender_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_list_grades()
	{
		$sql = "SELECT * FROM grades";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function update_last_login($admin_id)
	{
		$sql="UPDATE admins set last_login=NOW() where admin_id='$admin_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function valid_username_or_email( $data )
	{
		$sql = "SELECT name FROM students WHERE username = '$data' OR email = '$data'
		UNION
		SELECT name FROM teachers WHERE username = '$data' OR email = '$data'
		UNION
		SELECT name FROM admins WHERE username = '$data' OR email = '$data'";
		$this->set_query($sql);
		if ($this->load_row() != '') {
			return false;
		} else { 
			return true;
		}
	}
	public function valid_class_name( $class_name )
	{
		$sql = "SELECT class_id FROM classes WHERE class_name = '$class_name'";
		$this->set_query($sql);
		if ($this->load_row() != '') {
			return false;
		} else { 
			return true;
		}
	}
	public function edit_admin($admin_id, $password, $name,$gender_id,$birthday)
	{
		$sql = "SELECT username FROM admins WHERE admin_id = '$admin_id'";
		$this->set_query($sql);
		if ($this->load_row()=='') {
			return false;
		}
		$sql="UPDATE admins set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where admin_id='$admin_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function del_admin($admin_id)
	{
		$sql = "SELECT username FROM admins WHERE admin_id = '$admin_id'";
		$this->set_query($sql);
		if ($this->load_row()=='') {
			return false;
		}
		$sql="DELETE FROM admins where admin_id='$admin_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function add_admin($name, $username, $password, $email, $birthday, $gender)
	{
		$sql = "SELECT admin_id FROM admins WHERE username = '$username' OR email = '$email'";
		$this->set_query($sql);
		if ($this->load_row()!='') {
			return false;
		}
		//reset AUTO_INCREMENT
		$sql = "ALTER TABLE `admins` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO admins (name, username, password, email, birthday, gender_id) VALUES ('$name', '$username', '$password', '$email', '$birthday', '$gender')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_teachers()
	{
		$sql = "SELECT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers 
		INNER JOIN permissions ON teachers.permission = permissions.permission 
		INNER JOIN genders ON teachers.gender_id = genders.gender_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_teacher($teacher_id, $password, $name,$gender_id,$birthday)
	{
		$sql = "SELECT username FROM teachers WHERE teacher_id = '$teacher_id'";
		$this->set_query($sql);
		if ($this->load_row()=='') {
			return false;
		}
		$sql="UPDATE teachers set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where teacher_id='$teacher_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function del_teacher($teacher_id)
	{
		$sql="DELETE FROM teachers where teacher_id='$teacher_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_teacher($name, $username, $password, $email, $birthday, $gender)
	{
		$sql = "SELECT teacher_id FROM teachers WHERE username = '$username' or email = '$email'";
		$this->set_query($sql);
		if ($this->load_row()!='') {
			return false;
		}
	    //reset AUTO_INCREMENT
		$sql = "ALTER TABLE `teachers` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO teachers (username,password,name,email,birthday,gender_id) VALUES ('$username','$password','$name','$email','$birthday','$gender')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_students()
	{
		$sql = "
		SELECT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students` 
		INNER JOIN classes ON students.class_id = classes.class_id
		INNER JOIN genders ON students.gender_id = genders.gender_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_student($student_id, $birthday, $password, $name, $class_id,$gender)
	{
		$sql="UPDATE students set birthday='$birthday', password='$password', name ='$name', class_id ='$class_id', gender_id = '$gender' where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="UPDATE scores set class_id ='$class_id' where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function del_student($student_id)
	{
		$sql="DELETE FROM scores where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="DELETE FROM students where student_id='$student_id'";
		$this->set_query($sql);
		$this->execute_none_return();
	}
	public function add_student($username, $password, $name, $class_id,$email,$birthday,$gender)
	{
		$sql = "SELECT student_id FROM students WHERE username = '$username' OR email = '$email";
		$this->set_query($sql);
		if ($this->load_row()!='') {
			return false;
		}
	    //reset AUTO_INCREMENT
		$sql = "ALTER TABLE `students` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO students (username,password,name,class_id,email,birthday,gender_id) VALUES ('$username','$password','$name','$class_id','$email','$birthday','$gender')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_classes()
	{
		$sql = "
		SELECT class_id,class_name,name as teacher_name, detail as grade_detail FROM classes
		INNER JOIN grades ON classes.grade_id = grades.grade_id
		INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
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
	public function add_class($grade_id, $class_name, $teacher_id)
	{
		$sql = "SELECT class_id FROM classes WHERE class_name = '$class_name'";
		$this->set_query($sql);
		if ($this->load_row()!='') {
			return false;
		}
	    //reset AUTO_INCREMENT
		$sql = "ALTER TABLE `classes` AUTO_INCREMENT=1";
		$this->set_query($sql);
		$this->execute_none_return();
		$sql="INSERT INTO classes (grade_id,class_name,teacher_id) VALUES ('$grade_id','$class_name','$teacher_id')";
		$this->set_query($sql);
		$this->execute_none_return();
		return true;
	}
	public function get_list_questions()
	{
		$sql = "
		SELECT questions.ID,questions.question_detail,grades.detail as grade_detail,units.detail as question_unit, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer FROM `questions`
		INNER JOIN grades ON grades.grade_id = questions.grade_id
		INNER JOIN units ON units.unit = questions.unit";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_question_info($ID)
	{
		$sql = "
		SELECT questions.ID,questions.question_detail,grades.detail as grade_detail,units.detail as question_unit, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer FROM `questions`
		INNER JOIN grades ON grades.grade_id = questions.grade_id
		INNER JOIN units ON units.unit = questions.unit WHERE ID = '$ID'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_list_units()
	{
		$sql = "
		SELECT units.unit,units.detail,units.close_time,statuses.detail as status_detail FROM `units`
		INNER JOIN statuses ON statuses.status_id = units.status_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
	{
	    $sql="UPDATE questions set question_detail='$question_detail', grade_id='$grade_id', unit ='$unit',answer_a ='$answer_a',answer_b ='$answer_b',answer_c ='$answer_c',answer_d ='$answer_d',correct_answer ='$correct_answer' where ID = '$ID'";
	    $this->set_query($sql);
	    $this->execute_none_return();
	}
	public function del_question($ID)
	{
	    $sql="DELETE FROM questions where ID='$ID'";
	    $this->set_query($sql);
	    $this->execute_none_return();
	}
	public function add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
	{
	    //get ID current question
		$sql = "SELECT `AUTO_INCREMENT`
		FROM  INFORMATION_SCHEMA.TABLES
		WHERE TABLE_NAME   = 'questions';";
		$this->set_query($sql);
		$ID = $this->load_row();
		$sql="INSERT INTO questions (grade_id,unit,question_detail,answer_a,answer_b,answer_c,answer_d,correct_answer) VALUES ($grade_id,$unit,'$question_detail','$answer_a','$answer_b','$answer_c','$answer_d','$correct_answer')";
		$this->set_query($sql);
		$this->execute_none_return();
		return $ID;
	}
	// public function notify_teacher($username, $name, $notification_title, $notification_content)
	// {
	//     $sql="INSERT INTO notifications (username,name,notification_title,notification_content,thoi_gian,permission) VALUES ('$username','$name','$notification_title','$notification_content',NOW(),2)";
	//     $this->set_query($sql);
	//     $this->execute_none_return();
	// }
	// public function get_teacher_notifications()
	// {
	//     $sql = "SELECT * FROM notifications where permission = 2";
	//     $this->set_query($sql);
	//     return $this->load_rows();
	// }
	// public function notify_student($username, $name, $notification_title, $notification_content)
	// {
	//     $sql="INSERT INTO notifications (username,name,notification_title,notification_content,time_sent,permission) VALUES ('$username','$name','$notification_title','$notification_content',NOW(),3)";
	//     $this->set_query($sql);
	//     $this->execute_none_return();
	// }
	// public function get_student_notifications()
	// {
	//     $sql = "SELECT * FROM notifications where permission = 3";
	//     $this->set_query($sql);
	//     return $this->load_rows();
	// }
}
