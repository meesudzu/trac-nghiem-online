<?php

include_once ('config/db.php');
/**
 * Model Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class M_Login extends Database
{
    public function getPassWord($email,$chuc_vu)
    {
        $sql = "SELECT tai_khoan,mat_khau,ten FROM $chuc_vu WHERE  email = '$email'";
        $this->setQuery($sql);
        $get = $this->loadRow();
        if($get)
        {
            $passWord = rand(10000000, 99999999);
            $get->mat_khau = $passWord;
            $passWord = md5($passWord);
            $tai_khoan = $get->tai_khoan;
            $this->setPassWord($passWord,$chuc_vu,$tai_khoan);
            return $get;
        }
        else
            return false;
    }
    public function setPassWord($mat_khau,$chuc_vu,$tai_khoan)
    {
        $sql = "UPDATE $chuc_vu SET mat_khau = '$mat_khau' WHERE tai_khoan = '$tai_khoan'";
        $this->setQuery($sql);
        $this->loadRow();
    }

}
?>