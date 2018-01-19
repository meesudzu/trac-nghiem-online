<?php

require_once 'controller.php';
/**
 * Controller Login
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Controller_Login extends Controller
{
    public function show_login()
    {
        $this->load_view("login");
        $view = new View_Login();
        $view->show_login();
    }
    public function submit_login()
    {
        $this->load_view("login");
        $view = new View_Login();

        if (isset($_POST['username'])) {
            $username = htmlspecialchars(addslashes($_POST['username']));
            $user = $this->get_username($username);
            if (!empty($user)) {
                $status = "Nhập mật khẩu để tiếp tục...";
                $view->status_success($status);
                $_SESSION['username'] = $user->username;
            } else {
                $status = "Tài khoản hoặc email không tồn tại!";
                $view->status_failed($status);
            }
        } else {
            $status = "Nhập tài khoản hoặc email!";
            $view->status_failed($status);
        }
    }
    public function submit_password()
    {
        $this->load_view("login");
        $view = new View_Login();

        if (isset($_POST['password'])) {
            $password = md5($_POST['password']);
        } else {
            $password = '';
        }
        if (isset($_SESSION['username'])) {
            $user = $this->get_password($_SESSION['username']);
        } else {
            $user->password = '';
        }
        if ($password == $user->password) {
            $status = "Đăng nhập thành công, chuẩn bị chuyển hưóng...";
            $view->status_success($status);
            $_SESSION['password'] = $user->password;
            $_SESSION['permission'] = $user->permission;
            $_SESSION['login'] = true;
        } else {
            $status = "Sai mật khẩu!";
            $view->status_failed($status);
        }
    }
    public function get_password($username)
    {
        $this->load_model("login");
        $model = new Model_Login();
        return $model->get_password($username);
    }
    public function get_username($username)
    {
        $this->load_model("login");
        $model = new Model_Login();
        return $model->get_username($username);
    }
    public function submit_forgot_password()
    {
        $this->load_model("login");
        $model = new  Model_Login();
        $this->load_view("login");
        $view = new View_Login();
        require_once 'res/libs/class.phpmailer.php';
        require_once 'res/libs/class.smtp.php';
        $username = Htmlspecialchars($_POST['username']);
        $get = $this->reset_password($username);
        if ($get) {
            $password = $get->password;
            $nameTo = $get->name;
            $mailTo = $get->email;
            $mail = $this->send_mail($password, $nameTo, $mailTo);
            if ($mail) {
                $status = "Gửi email thành công. Kiểm tra hộp thư để lấy mật khẩu (có thể trong Spam)";
                $view->status_success($status);
                $model->update_new_password(md5($password), $get->permission, $username);
            } else {
                $status = "Gửi email thất bại, vui lòng thử lại trong giây lát.";
                $view->status_failed($status);
            }
        } else {
            $status = "Tài khoản hoặc email không tồn tại, vui lòng thử lại";
            $view->status_failed($status);
        }
    }
    public function reset_password($username)
    {
        $this->load_model('login');
        $model = new Model_Login();
        return $model->reset_password($username);
    }
    public function send_mail($password, $nTo, $mTo)
    {
        $nFrom = 'IKun.Org';
        $mFrom = 'example@gmail.com';
        $mPass = 'example';
        $mail = new PHPMailer();
        $content = 'Đây là mật khẩu của bạn.<br /><b>'.$password.'</b><br />Hãy đổi ngay sau khi đăng nhập. <br />Đây là email gửi tự động, vui lòng không trả lời email này.';
        $body = $content;
        $mail->IsSMTP();
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                   // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Username   = $mFrom;  // GMAIL username
        $mail->Password   = $mPass;              // GMAIL password
        $mail->SetFrom($mFrom, $nFrom);
        $title = 'Reset Mật Khẩu Trên Hệ Thống Trắc Nghiệm Online';
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $address = $mTo;
        $mail->AddAddress($address, $nTo);
        $mail->AddReplyTo('noreply24@ikun.org', 'IKun.Org');
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}
