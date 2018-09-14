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
    public function valid_username_or_email($data)
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
    public function valid_class_name($class_name)
    {
        $sql = "SELECT class_id FROM classes WHERE class_name = '$class_name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
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
    public function edit_admin($admin_id, $password, $name, $gender_id, $birthday)
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
        $sql="DELETE FROM admins where admin_id='$admin_id'";
        $this->set_query($sql);
        $this->execute_none_return();
        $sql = "SELECT username FROM admins WHERE admin_id = '$admin_id'";
        $this->set_query($sql);
        if ($this->load_row()!='') {
            return false;
        }
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
    public function edit_teacher($teacher_id, $password, $name, $gender_id, $birthday)
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
        $sql = "SELECT username FROM teachers WHERE teacher_id = '$teacher_id'";
        $this->set_query($sql);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
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
    public function edit_student($student_id, $birthday, $password, $name, $class_id, $gender)
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
        $sql = "SELECT username FROM students WHERE student_id = '$student_id'";
        $this->set_query($sql);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender)
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
        $sql = "SELECT class_name FROM classes WHERE class_id = '$class_id'";
        $this->set_query($sql);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
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
    public function get_unit($unit)
    {
        $sql = "
        SELECT units.unit,units.detail,units.close_time,statuses.detail as status_detail FROM `units`
        INNER JOIN statuses ON statuses.status_id = units.status_id WHERE unit = '$unit'";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_statuses()
    {
        $sql = "
        SELECT * FROM `statuses`";
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
        WHERE TABLE_NAME   = 'questions'";
        $this->set_query($sql);
        $ID = $this->load_row();
        $sql="INSERT INTO questions (grade_id,unit,question_detail,answer_a,answer_b,answer_c,answer_d,correct_answer) VALUES ($grade_id,$unit,'$question_detail','$answer_a','$answer_b','$answer_c','$answer_d','$correct_answer')";
        $this->set_query($sql);
        $this->execute_none_return();
        return $ID->AUTO_INCREMENT;
    }
    public function add_unit($detail, $status_id, $close_time)
    {
        //get ID current question
        $sql = "SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME   = 'units'";
        $this->set_query($sql);
        $ID = $this->load_row();
        $sql="INSERT INTO units (detail, status_id, close_time) VALUES ('$detail', '$status_id', '$close_time')";
        $this->set_query($sql);
        $this->execute_none_return();
        return $ID->AUTO_INCREMENT;
    }
    public function edit_unit($unit, $detail, $status_id, $close_time)
    {
        $sql="UPDATE units set detail='$detail', status_id='$status_id', close_time ='$close_time' where unit = '$unit'";
        $this->set_query($sql);
        $this->execute_none_return();
    }
    public function del_unit($unit)
    {
        $sql="DELETE FROM units where unit='$unit'";
        $this->set_query($sql);
        $this->execute_none_return();
        $sql = "SELECT detail FROM units WHERE unit = '$unit'";
        $this->set_query($sql);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function insert_notification($username, $name, $notification_title, $notification_content)
    {
        //get ID current notification
        $sql = "SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME   = 'notifications'";
        $this->set_query($sql);
        $ID = $this->load_row();
        $sql="INSERT INTO notifications (username,name,notification_title,notification_content,time_sent) VALUES ('$username','$name','$notification_title','$notification_content',NOW())";
        $this->set_query($sql);
        $this->execute_none_return();
        return $ID->AUTO_INCREMENT;
    }
    public function notify_teacher($ID, $teacher_id)
    {
        $sql="INSERT INTO teacher_notifications (notification_id,teacher_id) VALUES ('$ID','$teacher_id')";
        $this->set_query($sql);
        $this->execute_none_return();
    }
    public function notify_class($ID, $class_id)
    {
        $sql="INSERT INTO student_notifications (notification_id,class_id) VALUES ('$ID','$class_id')";
        $this->set_query($sql);
        $this->execute_none_return();
    }
    public function get_teacher_notifications()
    {
        $sql = "
        SELECT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,teachers.name as receive_name,teachers.username as receive_username,notifications.time_sent FROM teacher_notifications
        INNER JOIN notifications ON notifications.notification_id = teacher_notifications.notification_id
        INNER JOIN teachers ON teachers.teacher_id = teacher_notifications.teacher_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_student_notifications()
    {
        $sql = "
        SELECT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,classes.class_name,notifications.time_sent FROM student_notifications
        INNER JOIN notifications ON notifications.notification_id = student_notifications.notification_id
        INNER JOIN classes ON classes.class_id = student_notifications.class_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE admins set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_none_return();
        return true;
    }
    public function update_avatar($avatar, $username)
    {
        $sql="UPDATE admins set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_none_return();
    }
    public function get_total_student()
    {
        $sql = "SELECT COUNT(student_id) as total FROM students";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_admin()
    {
        $sql = "SELECT COUNT(admin_id) as total FROM admins";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_teacher()
    {
        $sql = "SELECT COUNT(teacher_id) as total FROM teachers";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_class()
    {
        $sql = "SELECT COUNT(class_id) as total FROM classes";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_subject()
    {
        $sql = "SELECT COUNT(subject_id) as total FROM subjects";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_question()
    {
        $sql = "SELECT COUNT(ID) as total FROM questions";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_grade()
    {
        $sql = "SELECT COUNT(grade_id) as total FROM grades";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
}
