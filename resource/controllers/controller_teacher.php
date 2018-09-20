<?php
/**
* Controller Teacher
* Author: Dzu
* Mail: dzu6996@gmail.com
**/ 
require_once 'controller.php';
include_once('models/model_teacher.php');

class Controller_Teacher extends Controller
{
    public $info =  array();
    public function __construct()
    {
        $user_info = $this->profiles();
        $this->info['ID'] = $user_info->ID;
        $this->update_last_login($this->info['ID']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }
    public function profiles()
    {
        $profiles = new Model_Teacher();
        return $profiles->get_profiles($_SESSION['username']);
    }
    public function update_last_login()
    {
        $info = new Model_Teacher();
        $info->update_last_login($this->info['ID']);
    }
    public function get_profiles()
    {
        $profiles = new Model_Teacher();
        echo json_encode($profiles->get_profiles($this->info['username']));
    }
    public function valid_email_on_profiles()
    {
        $result = array();
        $valid = new Model_Teacher();
        $new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
        $curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
        if (empty($new_email)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_email_on_profiles($curren_email, $new_email)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function update_avatar($avatar, $username)
    {
        $info = new Model_Teacher();
        return $info->update_avatar($avatar, $username);
    }
    public function submit_update_avatar()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        if (isset($_FILES['file'])) {
            $duoi = explode('.', $_FILES['file']['name']);
            $duoi = $duoi[(count($duoi)-1)];
            if ($duoi === 'jpg' || $duoi === 'png') {
                if (move_uploaded_file($_FILES['file']['tmp_name'], 'res/img/avatar/'.$username.'_' . $_FILES['file']['name'])) {
                    $avatar = $username .'_' . $_FILES['file']['name'];
                    $update = $this->update_avatar($avatar, $username);
                }
            }
        }
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $info = new Model_Teacher();
        return $info->update_profiles($username, $name, $email, $password, $gender, $birthday);
    }
    public function submit_update_profiles()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender)||empty($birthday)||empty($password)||empty($email)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->update_profiles($username, $name, $email, $password, $gender, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->profiles($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function insert_notification($notification_title, $notification_content)
    {
        $notification = new Model_Teacher();
        return $notification->insert_notification($this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    public function notify_class($ID, $class_id)
    {
        $send = new Model_Teacher();
        $send->notify_class($ID, $class_id);
    }
    public function send_notification()
    {
        $result = array();
        $notification_title = isset($_POST['notification_title']) ? htmlspecialchars($_POST['notification_title']) : '';
        $notification_content = isset($_POST['notification_content']) ? htmlspecialchars($_POST['notification_content']) : '';
        $class_id = isset($_POST['class_id']) ? json_decode(stripslashes($_POST['class_id'])) : array();
        if (empty($notification_title)||empty($notification_content)) {
            $result['status_value'] = "Nội dung hoặc tiêu đề trống!";
            $result['status'] = 0;
        } else {
            if (empty($class_id)) {
                $result['status_value'] = "Chưa lớp người nhận!";
                $result['status'] = 0;
            } else {
                $ID = $this->insert_notification($notification_title, $notification_content);
                foreach ($class_id as $class_id_) {
                    $this->notify_class($ID, $class_id_);
                }
                $result['status_value'] = "Gửi thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function get_list_classes_by_teacher()
    {
        $list = new Model_Teacher();
        echo json_encode($list->get_list_classes_by_teacher($this->info['ID']));
    }
    public function get_notifications_to_student()
    {
        $list = new Model_Teacher();
        echo json_encode($list->get_notifications_to_student($this->info['ID']));
    }
    public function get_notifications_by_admin()
    {
        $list = new Model_Teacher();
        echo json_encode($list->get_notifications_by_admin($this->info['ID']));
    }
    public function get_score()
    {
        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '1';
        $score = new Model_Teacher();
        echo json_encode($score->get_score($student_id));
    }
    public function get_class_detail()
    {
        $ID = isset($_POST['ID']) ? $_POST['ID'] : '1';
        $class = new Model_Teacher();
        echo json_encode($class->get_class_detail($ID));
    }
    public function show_head_left()
    {
        $this->load_view("teacher");
        $view = new View_Teacher();
        $view->show_head_left($this->info);
    }
    public function show_index()
    {
        $this->load_view("teacher");
        $view = new View_Teacher();
        $view->show_index();
    }
    public function show_class_detail()
    {
        $this->load_view("teacher");
        $view = new View_Teacher();
        $view->show_class_detail();
    }
    public function show_notifications()
    {
        $this->load_view("teacher");
        $view = new View_Teacher();
        $view->show_notifications();
    }
}
