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
		$sql = "SELECT students.student_id as ID,students.username,students.name,students.email,students.avatar,students.class_id,students.birthday,students.last_login,genders.gender_id,genders.gender_detail,classes.grade_id,students.doing_exam,students.time_remaining FROM `students`
		INNER JOIN genders ON genders.gender_id = students.gender_id
		INNER JOIN classes ON classes.class_id = students.class_id
		WHERE username = '$username'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_score($student_id,$test_code)
	{
		$sql = "SELECT * FROM `scores` WHERE student_id = $student_id AND test_code = $test_code";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_scores($student_id)
	{
		$sql = "SELECT * FROM `scores` WHERE student_id = $student_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_notifications($class_id)
	{
		$sql = "SELECT * FROM notifications WHERE notification_id IN (SELECT notification_id FROM student_notifications WHERE class_id = '$class_id') ORDER BY `time_sent` DESC";
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
	public function update_doing_exam($test_code,$time,$ID)
	{
		$sql="UPDATE students set doing_exam= '$test_code', time_remaining = '$time',starting_time = NOW() where student_id='$ID'";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function reset_doing_exam($ID)
	{
		$sql="UPDATE students set doing_exam= NULL, time_remaining = NULL, starting_time = NULL where student_id='$ID'";
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
	public function get_list_tests()
	{
		$sql = "
		SELECT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
		INNER JOIN grades ON grades.grade_id = tests.grade_id
		INNER JOIN subjects ON subjects.subject_id = tests.subject_id
		INNER JOIN statuses ON statuses.status_id = tests.status_id";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_test($test_code)
	{
		$sql = "SELECT * FROM tests WHERE test_code = '$test_code'";
		$this->set_query($sql);
		return $this->load_row();
	}
	public function get_quest_of_test($test_code)
	{
		$sql = "SELECT * FROM quest_of_test
		INNER JOIN questions ON questions.question_id = quest_of_test.question_id
		WHERE test_code = $test_code ORDER BY RAND()";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function add_student_quest($student_id, $ID, $test_code, $question_id, $answer_a, $answer_b, $answer_c, $answer_d)
	{
		$sql = "INSERT INTO `student_test_detail` (`student_id`,`ID`,`test_code`, `question_id`, `answer_a`, `answer_b`, `answer_c`, `answer_d`) VALUES ($student_id, $ID, $test_code, $question_id, '$answer_a', '$answer_b', '$answer_c', '$answer_d');";
		$this->set_query($sql);
		return $this->execute_return_status();
	}
	public function get_doing_quest($test_code,$student_id)
	{
		$sql = "SELECT *,questions.question_content FROM student_test_detail
		INNER JOIN questions ON student_test_detail.question_id = questions.question_id
		WHERE test_code = $test_code AND student_id = $student_id ORDER BY ID";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function get_result_quest($test_code,$student_id)
	{
		$sql = "SELECT * FROM student_test_detail
		INNER JOIN questions ON student_test_detail.question_id = questions.question_id
		INNER JOIN tests ON student_test_detail.test_code = tests.test_code
		WHERE student_test_detail.test_code = $test_code AND student_id = $student_id ORDER BY ID";
		$this->set_query($sql);
		return $this->load_rows();
	}
	public function update_answer($student_id, $test_code, $question_id,$student_answer)
	{
		$sql="UPDATE student_test_detail set student_answer='$student_answer' where student_id=$student_id AND test_code=$test_code AND question_id=$question_id";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function update_timing($student_id, $time)
	{
		$sql="UPDATE students set time_remaining='$time' where student_id=$student_id";
		$this->set_query($sql);
		$this->execute_return_status();
	}
	public function insert_score($student_id,$test_code,$score,$score_detail)
	{
		$sql = "INSERT INTO `scores` (`student_id`, `test_code`, `score_number`, `score_detail`, completion_time) VALUES ('$student_id', '$test_code', '$score', '$score_detail', NOW())";
		$this->set_query($sql);
		return $this->execute_return_status();
	}
}
