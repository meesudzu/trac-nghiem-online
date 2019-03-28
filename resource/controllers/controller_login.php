<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * Controller Login
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 */

require_once 'views/view_login.php';
require_once 'models/model_login.php';

class Controller_Login
{
    /**
     * Call by submit_password()
     * @return object [permission, password from students or teachers or admins]
     */
    
    public function get_password($username)
    {
        $model = new Model_Login();
        return $model->get_password($username);
    }

    /**
     * Call by submit_login()
     * @return object [username, name from students or teachers or admins]
     */
    
    public function get_username($username)
    {
        $model = new Model_Login();
        return $model->get_username($username);
    }

    /**
     * Call by submit_forgot_password()
     * @return object [name, email, permission [, password] from students or teachers or admins]
     * if username or email is exist, else
     * @return boolean false
     */
    
    public function reset_password($username)
    {
        $model = new Model_Login();
        return $model->reset_password($username);
    }

    /**
     * @return View
     */
    
    public function show_login()
    {
        $view = new View_Login();
        $view->show_login();
    }

    /**
     * Call by ajax in res/js/login.js > submit_login()
     * @return json
     */
    
    public function submit_login()
    {
        $result = array();
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $user = $this->get_username($username);
            if (!empty($user)) {
                $result['status_value'] = "Nhập mật khẩu để tiếp tục...";
                $result['name'] = $user->name;
                $result['status'] = 1;
                $_SESSION['username'] = $user->username;
            } else {
                $result['status_value'] = "Tài khoản hoặc email không tồn tại!";
                $result['status'] = 0;
            }
        } else {
            $result['status_value'] = "Nhập tài khoản hoặc email!";
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    /**
     * Call by ajax in res/js/login.js > submit_password()
     * @return json
     */

    public function submit_password()
    {
        $result = array();
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (isset($_SESSION['username'])) {
            $user = $this->get_password($_SESSION['username']);
            if ($password == $user->password) {
                $result['status_value'] = "Đăng nhập thành công, chuẩn bị chuyển hưóng...";
                $result['status'] = 1;
                if ($user->permission==1) {
                    $_SESSION['permission'] = "admin";
                }
                if ($user->permission==2) {
                    $_SESSION['permission'] = "teacher";
                }
                if ($user->permission==3) {
                    $_SESSION['permission'] = "student";
                }
                $_SESSION['login'] = true;
                $_SESSION['sidebar-logout'] = 'sidebar-show';
                $_SESSION['menu-icon'] = '';
                $_SESSION['box-content'] = 'box-content-mini';
            } else {
                $result['status_value'] = "Sai mật khẩu!";
                $result['status'] = 0;
            }
        }

        echo json_encode($result);
    }

    /**
     * Call by submit_forgot_password()
     * @return boolean
     */
    
    public function send_mail($password, $nTo, $mTo)
    {
        $nFrom = 'IKun.Org';
        $mFrom = 'example@gmail.com';
        $mPass = 'example';
        $mail = new PHPMailer();
        $content = 'Đây là mật khẩu mới của bạn.<br /><b>'.$password.'</b><br />Hãy đổi ngay sau khi đăng nhập. <br />Đây là email gửi tự động, vui lòng không trả lời email này.';
        $body = $content;
        $mail->IsSMTP();
        $mail->CharSet  = "utf-8";
        // enables SMTP debug information (for testing), 0 = disable, 1 = enable
        $mail->SMTPDebug  = 0;
        // enable SMTP authentication
        $mail->SMTPAuth   = true;
        // sets the prefix to the servier
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        // GMAIL username
        $mail->Username   = $mFrom;
        // GMAIL password
        $mail->Password   = $mPass;
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

    /**
     * Call by ajax in res/js/login.js > submit_forgot_password()
     * @return json
     */
    
    public function submit_forgot_password()
    {
        $result = array();
        $model = new  Model_Login();

        require_once 'res/libs/class.phpmailer.php';
        require_once 'res/libs/class.smtp.php';

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $get = $this->reset_password($username);

        if ($get) {
            $password = $get->password;
            $nameTo = $get->name;
            $mailTo = $get->email;
            $mail = $this->send_mail($password, $nameTo, $mailTo);
            if ($mail) {
                $result['status_value'] = "Gửi email thành công. Kiểm tra hộp thư để lấy mật khẩu (có thể trong Spam)";
                $result['status'] = 1;
                $model->update_new_password(md5($password), $get->permission, $username);
            } else {
                $result['status_value'] = "Gửi email thất bại, vui lòng thử lại trong giây lát.";
                $result['status'] = 0;
            }
        } else {
            $result['status_value'] = "Tài khoản hoặc email không tồn tại, vui lòng thử lại.";
            $result['status'] = 0;
        }

        echo json_encode($result);
    }
}
