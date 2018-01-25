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
        $sql = "SELECT teachers.teacher_id as ID,teachers.username,teachers.name,teachers.email,teachers.avatar,teachers.birthday,teachers.last_login,genders.gender_detail FROM `teachers`
		INNER JOIN genders ON genders.gender_id = teachers.gender_id
		WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function update_last_login($ID)
    {
        $sql="UPDATE teachers set last_login=NOW() where teacher_id='$ID'";
        $this->set_query($sql);
        $this->execute_none_return();
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
    public function update_avatar($avatar, $username)
    {
        $sql="UPDATE teachers set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_none_return();
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE teachers set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_none_return();
        return true;
    }
}
