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
        $sql = "SELECT students.student_id as ID,students.username,students.name,students.email,students.avatar,students.birthday,students.last_login,genders.gender_detail FROM `students`
        INNER JOIN genders ON genders.gender_id = students.gender_id
        WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function update_last_login($ID)
    {
        $sql="UPDATE students set last_login=NOW() where student_id='$ID'";
        $this->set_query($sql);
        $this->execute_none_return();
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
        $this->execute_none_return();
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE students set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_none_return();
        return true;
    }
}
