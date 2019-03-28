<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * Controller Teacher
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 */

require_once('models/model_teacher.php');
require_once 'views/view_teacher.php';
//load thư viện PhpSpreadSheet
require 'res/libs/SpreadSheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller_Teacher
{
    private $info =  array();
    public function __construct()
    {
        $user_info = $this->profiles();
        $this->info['ID'] = $user_info->ID;
        $this->update_last_login($this->info['ID']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }
    private function profiles()
    {
        $model = new Model_Teacher();
        return $model->get_profiles($_SESSION['username']);
    }
    private function update_last_login()
    {
        $model = new Model_Teacher();
        $model->update_last_login($this->info['ID']);
    }
    public function get_profiles()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_profiles($this->info['username']));
    }
    public function valid_email_on_profiles()
    {
        $result = array();
        $model = new Model_Teacher();
        $new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
        $curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
        if (empty($new_email)) {
            $result['status'] = 0;
        } else {
            if ($model->valid_email_on_profiles($curren_email, $new_email)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    private function update_avatar($avatar, $username)
    {
        $model = new Model_Teacher();
        return $model->update_avatar($avatar, $username);
    }
    public function submit_update_avatar()
    {
        if (isset($_FILES['file'])) {
            $duoi = explode('.', $_FILES['file']['name']);
            $duoi = $duoi[(count($duoi)-1)];
            if ($duoi === 'jpg' || $duoi === 'png') {
                if (move_uploaded_file($_FILES['file']['tmp_name'], 'upload/avatar/'.$this->info['username'].'_' . $_FILES['file']['name'])) {
                    $avatar = $this->info['username'] .'_' . $_FILES['file']['name'];
                    $update = $this->update_avatar($avatar, $this->info['username']);
                }
            }
        }
    }
    private function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $model = new Model_Teacher();
        return $model->update_profiles($username, $name, $email, $password, $gender, $birthday);
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
    private function insert_notification($notification_id,$notification_title, $notification_content)
    {
        $model = new Model_Teacher();
        return $model->insert_notification($notification_id,$this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    private function notify_class($ID, $class_id)
    {
        $model = new Model_Teacher();
        $model->notify_class($ID, $class_id);
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
                do {
                    $notification_id = rand(1,999999)+rand(1,111111);
                    $insert = $this->insert_notification($notification_id,$notification_title, $notification_content);
                } while($insert == false);
                foreach ($class_id as $class_id_) {
                    $this->notify_class($notification_id, $class_id_);
                }
                $result['status_value'] = "Gửi thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function get_list_classes_by_teacher()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_list_classes_by_teacher($this->info['ID']));
    }
    public function get_notifications_to_student()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_notifications_to_student($this->info['ID']));
    }
    public function get_notifications_by_admin()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_notifications_by_admin($this->info['ID']));
    }
    public function get_score()
    {
        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '1';
        $model = new Model_Teacher();
        echo json_encode($model->get_score($student_id));
    }
    private function get_class_detail($ID)
    {
        $model = new Model_Teacher();
        return $model->get_class_detail($ID);
    }
    private function get_class_name($ID)
    {
        $model = new Model_Teacher();
        return $model->get_class_name($ID);
    }
    public function export_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

        $model = new Model_Teacher();
        $scores = $model->get_test_score($test_code);

        //Create Excel Data
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Danh Sách Điểm Bài Thi '. $test_code);
        $sheet->setCellValue('A3', 'STT');
        $sheet->setCellValue('B3', 'Tên');
        $sheet->setCellValue('C3', 'Tài Khoản');
        $sheet->setCellValue('D3', 'Lớp');
        $sheet->setCellValue('E3', 'Điểm');

        for ($i = 0; $i < count($scores); $i++) {
            $sheet->setCellValue('A'.($i+4), $i+1);
            $sheet->setCellValue('B'.($i+4), $scores[$i]->name);
            $sheet->setCellValue('C'.($i+4), $scores[$i]->username);
            $sheet->setCellValue('D'.($i+4), $scores[$i]->class_name);
            $sheet->setCellValue('E'.($i+4), $scores[$i]->score_number);
        }

        //Output File
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attactment;filename="danh-sach-diem-'.$test_code.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function toggle_sidebar()
    {
        if ($_SESSION['sidebar-logout'] != '') {
            $_SESSION['sidebar-logout'] = '';
            $_SESSION['menu-icon'] = 'rot';
            $_SESSION['box-content'] = '';
        } else {
            $_SESSION['sidebar-logout'] = 'sidebar-show';
            $_SESSION['menu-icon'] = '';
            $_SESSION['box-content'] = 'box-content-mini';
        }
    }
    public function logout()
    {
        $result = array();
        $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : false;
        if ($confirm) {
            $result['status_value'] = "Đăng xuất thành công!";
            $result['status'] = 1;
            session_destroy();
        }
        echo json_encode($result);
    }
    public function show_dashboard()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_dashboard();
        $view->show_foot();
    }
    public function show_class_detail()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $class_id = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        if ($class_id == '') {
            $view->show_404();
        } else {
            $view->show_class_detail($this->get_class_name($class_id), $this->get_class_detail($class_id));
        }
        $view->show_foot();
    }
    public function show_notifications()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_notifications();
        $view->show_foot();
    }
    public function show_profiles()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_profiles($this->profiles());
        $view->show_foot();
    }
    public function show_about()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_about();
        $view->show_foot();
    }
    public function list_test()
    {
        $model = new Model_Teacher();
        $tests = $model->get_list_test($this->info['ID']);

        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_list_test($tests);
        $view->show_foot();
    }
    public function test_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';
        $model = new Model_Teacher();
        $scores = $model->get_test_score($test_code);

        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_test_score($scores);
        $view->show_foot();
    }
    public function show_404()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_404();
        $view->show_foot();
    }
}
