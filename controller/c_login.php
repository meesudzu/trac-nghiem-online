<?php
 
include_once ('model/m_giao_vien.php');
include_once ('model/m_hoc_sinh.php');
include_once ('model/m_admin.php');

/**
 * Controller Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Login
{
    /**
     * summary
     */
    // hàm đăng nhập ngừoi dùng giáo viên
    public function giaoVien($tai_khoan,$mat_khau)
    {
        $login_gv = new M_Giao_Vien();
        $user = $login_gv->login($tai_khoan,$mat_khau);
        if($user == true){
            $_SESSION['id_gv'] = $user->id_gv;
            $_SESSION['tai_khoan'] = $user->tai_khoan;
            $_SESSION['ten'] = $user->ten;
            $_SESSION['chuc_vu'] = $user->chuc_vu;
			$_SESSION['login'] = "Đăng nhập thành công!";
			unset($_SESSION['login_error_gv']);
			header( "Refresh:0.2; url=index.php");
		}
		else{
            $_SESSION['login_error_gv'] = "Thông tin đăng nhập không hợp lệ!";
            unset($_SESSION['login']);
        }
		
    }
    // hàm đăng nhập ngừoi dùng học sinh
    public function hocSinh($tai_khoan,$mat_khau)
    {
        $login_hs = new M_Hoc_Sinh();
        $user = $login_hs->login($tai_khoan,$mat_khau);
        if($user == true){
            $_SESSION['id_hs'] = $user->id_hs;
            $_SESSION['tai_khoan'] = $user->tai_khoan;
            $_SESSION['ten'] = $user->ten;
            $_SESSION['chuc_vu'] = $user->chuc_vu;
            $_SESSION['id_lop'] = $user->id_lop;
			$_SESSION['login'] = "Đăng nhập thành công!";
			unset($_SESSION['login_error_hs']);
			header( "Refresh:0.2; url=index.php");
		}
		else{
            $_SESSION['login_error_hs'] = "Thông tin đăng nhập không hợp lệ!";
            unset($_SESSION['login']);
        }
		
    }
    // hàm đăng nhập ngừoi dùng admin
    public function admin($tai_khoan,$mat_khau)
    {
        $login_hs = new M_Admin();
        $user = $login_hs->login($tai_khoan,$mat_khau);
        if($user == true){
            $_SESSION['id_admin'] = $user->id_admin;
            $_SESSION['tai_khoan'] = $user->tai_khoan;
            $_SESSION['ten'] = $user->ten;
            $_SESSION['chuc_vu'] = $user->chuc_vu;
            $_SESSION['login'] = "Đăng nhập thành công!";
            unset($_SESSION['login_error_ad']);
            header( "Refresh:0.2; url=index.php");
        }
        else{
            $_SESSION['login_error_ad'] = "Thông tin đăng nhập không hợp lệ!";
            unset($_SESSION['login']);
        }
        
    }
};
?>