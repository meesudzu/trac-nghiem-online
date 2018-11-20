<?php

/**
 * Model Teacher
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/

include_once('config/database.php');

class Model_Teacher extends Database
{
    public function get_profiles($username)
    {
        $sql = "SELECT teachers.teacher_id as ID,teachers.username,teachers.name,teachers.email,teachers.avatar,teachers.birthday,teachers.last_login,genders.gender_id,genders.gender_detail FROM `teachers`
        INNER JOIN genders ON genders.gender_id = teachers.gender_id
        WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function update_last_login($ID)
    {
        $sql="UPDATE teachers set last_login=NOW() where teacher_id='$ID'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function valid_email_on_profiles($curren_email, $new_email)
    {
        $sql = "SELECT name FROM students WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT name FROM admins WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT name FROM teachers WHERE email = '$new_email' AND email NOT IN ('$curren_email')";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }
    public function get_list_test($teacher_id)
    {
        $sql = "SELECT tests.test_code,tests.test_name,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        WHERE `test_code` IN (SELECT DISTINCT test_code FROM `scores`
        INNER JOIN students ON scores.student_id = students.student_id
        WHERE students.class_id IN (SELECT DISTINCT class_id FROM classes WHERE classes.teacher_id = '$teacher_id'))";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_test_score($test_code)
    {
        $sql = "SELECT * FROM `scores` INNER JOIN students ON scores.student_id = students.student_id 
        INNER JOIN classes ON students.class_id = classes.class_id
        WHERE test_code = '$test_code'";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function update_avatar($avatar, $username)
    {
        $sql="UPDATE teachers set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE teachers set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }
    public function get_list_classes_by_teacher($teacher_id)
    {
        $sql = "SELECT classes.class_id,classes.class_name,grades.detail as grade FROM classes
        INNER JOIN grades ON grades.grade_id = classes.grade_id
        WHERE teacher_id = '$teacher_id'";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_class_detail($class_id)
    {
        $sql = "SELECT students.student_id,students.avatar,students.username,students.name,students.birthday,genders.gender_detail,students.last_login,class_name FROM students
        INNER JOIN genders ON genders.gender_id = students.gender_id
        INNER JOIN classes ON students.class_id =classes.class_id
        WHERE students.class_id = '$class_id'";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_notifications_to_student($teacher_id)
    {
        $sql = "SELECT * FROM notifications WHERE notification_id IN (SELECT notification_id FROM student_notifications WHERE student_notifications.class_id IN (SELECT classes.class_id FROM classes WHERE teacher_id = '$teacher_id')) ORDER BY `time_sent` DESC";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_notifications_by_admin($teacher_id)
    {
        $sql = "SELECT * FROM notifications WHERE notification_id IN (SELECT notification_id FROM teacher_notifications WHERE teacher_id = '$teacher_id') ORDER BY `time_sent` DESC";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function insert_notification($notification_id,$username, $name, $notification_title, $notification_content)
    {
        $sql="INSERT INTO notifications (notification_id,username,name,notification_title,notification_content,time_sent) VALUES ($notification_id,'$username','$name','$notification_title','$notification_content',NOW())";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function notify_class($ID, $class_id)
    {
        $sql="INSERT INTO student_notifications (notification_id,class_id) VALUES ('$ID','$class_id')";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function get_score($student_id)
    {
        $sql = "SELECT * FROM `scores`
        WHERE `student_id` = $student_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
}
