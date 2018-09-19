<?php
/**
 * Model Student
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
include_once('config/database.php');

class Model_Student extends Database
{
	public function get_profiles($username)
	{
		$sql = "SELECT students.student_id as ID,students.username,students.name,students.email,students.avatar,students.class_id,students.birthday,students.last_login,genders.gender_detail,classes.grade_id,students.doing_exam,students.doing_time FROM `students`
		INNER JOIN genders ON genders.gender_id = students.gender_id
		INNER JOIN classes ON classes.class_id = students.class_id
		WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_units()
	{
		$sql = "SELECT unit,time_to_do, units.detail as unit_detail, statuses.status_id, statuses.detail as status_detail, close_time FROM `units`
		INNER JOIN statuses ON statuses.status_id = units.status_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_unit_detail($unit)
	{
		$sql = "SELECT * FROM `units` WHERE unit = $unit";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_rand_questions($grade_id, $unit)
	{
		$sql = "SELECT * FROM `questions` WHERE grade_id = $grade_id and unit = $unit ORDER BY RAND()";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_score($student_id,$class_id,$unit)
	{
		$sql = "SELECT * FROM `scores` WHERE student_id = $student_id AND class_id = $class_id AND unit = $unit";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_question($ID)
	{
		$sql = "SELECT question_detail,answer_a,answer_b,answer_c,answer_d,correct_answer,ID FROM `questions` WHERE ID = $ID";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function insert_score($student_id, $unit, $score, $class_id)
	{
		$sql = "INSERT INTO scores (student_id,unit,score,class_id,completion_time) VALUES ('$student_id','$unit','$score','$class_id',NOW())";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function get_notifications($class_id)
	{
		$sql = "SELECT * FROM notifications WHERE notification_id IN (SELECT notification_id FROM student_notifications WHERE class_id = '$class_id')";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_chats($class_id)
	{
		$sql = "SELECT * FROM `chats` WHERE class_id = '$class_id' ORDER BY ID DESC LIMIT 10";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_chat_all($class_id)
	{
		$sql = "SELECT * FROM `chats` WHERE class_id = '$class_id' ORDER BY ID DESC";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function chat($username, $name, $class_id, $content)
	{
		$sql = "INSERT INTO chats (username,name,class_id,chat_content,time_sent) VALUES ('$username','$name','$class_id','$content',NOW())";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function update_last_login($ID)
	{
		$sql="UPDATE students set last_login=NOW() where student_id='$ID'";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function update_doing_exam($exam,$time,$ID)
	{
		$sql="UPDATE students set doing_exam= '$exam', doing_time = '$time' where student_id='$ID'";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function reset_doing_exam($ID)
	{
		$sql="UPDATE students set doing_exam= NULL, doing_time = NULL where student_id='$ID'";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function valid_email_on_profiles($curren_email, $new_email)
	{
		$sql = "SELECT name FROM teachers WHERE email = '$new_email' AND email NOT IN ('$curren_email')
		UNION SELECT name FROM admins WHERE email = '$new_email' AND email NOT IN ('$curren_email')
		UNION SELECT name FROM students WHERE email = '$new_email' AND email NOT IN ('$curren_email')";
		$this->set_query($sql);
		if ($this->load_row() != '') {
			return false;
		} else {
			return true;
		}
	}
	public function update_avatar($avatar, $username)
	{
		$sql="UPDATE students set avatar='$avatar' where username='$username'";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$sql="UPDATE students set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
		$this->set_query($sql);
		$this->execute_return_status();
		return true;
	}
}
