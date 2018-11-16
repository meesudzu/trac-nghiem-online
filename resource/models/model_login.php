<?php

/**
 * Model Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/

include_once('config/database.php');

class Model_Login extends Database
{
    public function get_username($username)
    {
        $sql = "SELECT username, name FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT username, name FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT username, name FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_password($username)
    {
        $sql = "SELECT permission,password FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT permission,password FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT permission,password FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function reset_password($username)
    {
        $sql = "SELECT name,email,password,permission FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT name,email,password,permission FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT name,email,password,permission FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $get = $this->load_row();
        if ($get) {
            $password = rand(10000000, 99999999);
            $get->password = $password;
            if ($get->permission==1) {
                $get->permission = 'admins';
            }
            if ($get->permission==2) {
                $get->permission = 'teachers';
            }
            if ($get->permission==3) {
                $get->permission = 'students';
            }
            return $get;
        } else {
            return false;
        }
    }
    public function update_new_password($password, $permission, $username)
    {
        $sql = "UPDATE $permission SET password = '$password' WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $this->load_row();
    }
}
