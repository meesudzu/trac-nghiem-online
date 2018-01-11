<?php
 
 require_once 'controller.php';
/**
 * Controller Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Login extends Controller
{
    public function showLogin()
    {
        $this->loadView("login");
        $login = new V_Login();
        $login->showLogin();
    }
    public function checkLogin()
    {
        $status = "Đang kiểm tra...!";
        if(isset($_POST['tai_khoan']))
            $tai_khoan = addslashes($_POST['tai_khoan']);
        if(isset($_POST['mat_khau']))
            $mat_khau = md5($_POST['mat_khau']);
        if(isset($_POST['chuc_vu']))
        {
            $chuc_vu = $_POST['chuc_vu'];
            //gọi hàm đăng nhập theo $chuc_vu
            $user = $this->$chuc_vu($tai_khoan,$mat_khau);
            if($user == true)
            {
                if($chuc_vu=="giaoVien")
                    $_SESSION['id_gv'] = $user->id_gv;
                if($chuc_vu=="admin")
                    $_SESSION['id_admin'] = $user->id_admin;
               if($chuc_vu=="hocSinh")
               {
                    $_SESSION['id_hs'] = $user->id_hs;
                    $_SESSION['id_lop'] = $user->id_lop;
               }
                $_SESSION['tai_khoan'] = $user->tai_khoan;
                $_SESSION['ten'] = $user->ten;
                $_SESSION['chuc_vu'] = $user->chuc_vu;
                $_SESSION['login'] = true;
                $status = true;
            }
            else
            {
                $status = false;
            }
        }
        $this->loadView("login");
        $login = new V_Login();
        $login->loginNotify($status);
    }
    // hàm kiểm tra đăng nhập tài khoản ngừoi dùng giáo viên và trả kết quả về $user
    public function giaoVien($tai_khoan,$mat_khau)
    {
        $this->loadModel("giao_vien");
        $login_gv = new M_Giao_Vien();
        $user = $login_gv->login($tai_khoan,$mat_khau);
        return $user;
		
    }
    // hàm kiểm tra đăng nhập tài khoản ngừoi dùng hoc sinh và trả kết quả về $user
    public function hocSinh($tai_khoan,$mat_khau)
    {
        $this->loadModel("hoc_sinh");
        $login_hs = new M_Hoc_Sinh();
        $user = $login_hs->login($tai_khoan,$mat_khau);
        return $user;
		
    }
    // hàm kiểm tra đăng nhập tài khoản ngừoi dùng  admin và trả kết quả về $user
    public function admin($tai_khoan,$mat_khau)
    {
        $this->loadModel("admin");
        $login_hs = new M_Admin();
        $user = $login_hs->login($tai_khoan,$mat_khau);
        return $user;
    }
}
?>