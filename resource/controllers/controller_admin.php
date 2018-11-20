<?php

/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/

require_once('models/model_admin.php');
require_once('views/view_admin.php');
//load thư viện PhpSpreadSheet
require 'res/libs/SpreadSheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller_Admin
{
    private $info  = array();

    public function __construct()
    {
        $user_info = $this->get_admin_info($_SESSION['username']);
        $this->info['admin_id'] = $user_info->admin_id;
        $this->update_last_login($this->info['admin_id']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }
    public function get_profiles()
    {
        $info = new Model_Admin();
        echo json_encode($info->get_admin_info($this->info['username']));
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $info = new Model_Admin();
        return $info->update_profiles($username, $name, $email, $password, $gender, $birthday);
    }
    public function update_avatar($avatar, $username)
    {
        $info = new Model_Admin();
        return $info->update_avatar($avatar, $username);
    }
    public function get_admin_info($username)
    {
        $info = new Model_Admin();
        return $info->get_admin_info($username);
    }
    public function get_teacher_info($username)
    {
        $info = new Model_Admin();
        return $info->get_teacher_info($username);
    }
    public function get_student_info($username)
    {
        $info = new Model_Admin();
        return $info->get_student_info($username);
    }
    public function get_class_info($class_name)
    {
        $info = new Model_Admin();
        return $info->get_class_info($class_name);
    }
    public function get_question_info($ID)
    {
        $info = new Model_Admin();
        return $info->get_question_info($ID);
    }
    public function update_last_login()
    {
        $info = new Model_Admin();
        $info->update_last_login($this->info['admin_id']);
    }
    public function get_list_admins()
    {
        $list_admins = new Model_Admin();
        echo json_encode($list_admins->get_list_admins());
    }
    public function get_list_grades()
    {
        $list_grades = new Model_Admin();
        echo json_encode($list_grades->get_list_grades());
    }
    public function get_list_subjects()
    {
        $list_grades = new Model_Admin();
        echo json_encode($list_grades->get_list_subjects());
    }
    public function get_list_statuses()
    {
        $list_statuses = new Model_Admin();
        echo json_encode($list_statuses->get_list_statuses());
    }
    public function valid_username_or_email()
    {
        $result = array();
        $valid = new Model_Admin();
        $usr_or_email = isset($_GET['usr_or_email']) ? htmlspecialchars($_GET['usr_or_email']) : '';
        if (empty($usr_or_email)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_username_or_email($usr_or_email)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function valid_email_on_profiles()
    {
        $result = array();
        $valid = new Model_Admin();
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
    public function valid_class_name()
    {
        $result = array();
        $valid = new Model_Admin();
        $class_name = isset($_GET['class_name']) ? htmlspecialchars($_GET['class_name']) : '';
        if (empty($class_name)) {
            $result['status'] = 0;
        } else {
            if ($valid->valid_class_name($class_name)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function edit_admin($admin_id, $password, $name, $gender_id, $birthday)
    {
        $edit = new Model_Admin();
        return $edit->edit_admin($admin_id, $password, $name, $gender_id, $birthday);
    }
    public function del_admin($admin_id)
    {
        $del = new Model_Admin();
        return $del->del_admin($admin_id);
    }
    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $add = new Model_Admin();
        return $add->add_admin($name, $username, $password, $email, $birthday, $gender);
    }
    public function get_list_teachers()
    {
        $list_teachers = new Model_Admin();
        echo json_encode($list_teachers->get_list_teachers());
    }
    public function edit_teacher($teacher_id, $password, $name, $gender_id, $birthday)
    {
        $edit = new Model_Admin();
        return $edit->edit_teacher($teacher_id, $password, $name, $gender_id, $birthday);
    }
    public function del_teacher($teacher_id)
    {
        $del = new Model_Admin();
        return $del->del_teacher($teacher_id);
    }
    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $add = new Model_Admin();
        return $add->add_teacher($name, $username, $password, $email, $birthday, $gender);
    }
    public function get_list_students()
    {
        $list_students = new Model_Admin();
        echo json_encode($list_students->get_list_students());
    }
    public function edit_student($student_id, $birthday, $password, $name, $class_id, $gender)
    {
        $edit = new Model_Admin();
        $edit->edit_student($student_id, $birthday, $password, $name, $class_id, $gender);
    }
    public function del_student($student_id)
    {
        $del = new Model_Admin();
        return $del->del_student($student_id);
    }
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender)
    {
        $add_student = new Model_Admin();
        return $add_student->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
    }
    public function get_list_classes()
    {
        $list_classes = new Model_Admin();
        echo json_encode($list_classes->get_list_classes());
    }
    public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
    {
        $edit = new Model_Admin();
        $edit->edit_class($class_id, $grade_id, $class_name, $teacher_id);
    }
    public function del_class($class_id)
    {
        $del = new Model_Admin();
        return $del->del_class($class_id);
    }
    public function add_class($grade_id, $class_name, $teacher_id)
    {
        $add = new Model_Admin();
        return $add->add_class($grade_id, $class_name, $teacher_id);
    }
    public function get_list_questions()
    {
        $list_questions = new Model_Admin();
        echo json_encode($list_questions->get_list_questions());
    }
    public function get_list_tests()
    {
        $list_tests = new Model_Admin();
        echo json_encode($list_tests->get_list_tests());
    }
    public function edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
    {
        $edit = new Model_Admin();
        return $edit->edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
    }
    public function del_question($question_id)
    {
        $del = new Model_Admin();
        $del->del_question($question_id);
    }
    public function add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
    {
        $add_question = new Model_Admin();
        return $add_question->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
    }
    public function get_teacher_notifications()
    {
        $notifications = new Model_Admin();
        echo json_encode($notifications->get_teacher_notifications());
    }
    public function get_student_notifications()
    {
        $notifications = new Model_Admin();
        echo json_encode($notifications->get_student_notifications());
    }
    public function insert_notification($notification_id,$notification_title, $notification_content)
    {
        $notification = new Model_Admin();
        return $notification->insert_notification($notification_id,$this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    public function edit_subject($subject_id, $subject_detail)
    {
        $edit = new Model_Admin();
        return $edit->edit_subject($subject_id, $subject_detail);
    }
    public function del_subject($subject_id)
    {
        $del = new Model_Admin();
        return $del->del_subject($subject_id);
    }
    public function add_subject($subject_detail)
    {
        $add = new Model_Admin();
        return $add->add_subject($subject_detail);
    }
    public function add_test($test_code,$test_name, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note)
    {
        $test = new Model_Admin();
        return $test->add_test($test_code,$test_name, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
    }
    public function toggle_test_status($test_code, $status_id)
    {
        $toggle = new Model_Admin();
        return $toggle->toggle_test_status($test_code, $status_id);
    }
    public function get_list_units()
    {
        $grade_id = $_POST['grade_id'];
        $subject_id = $_POST['subject_id'];
        $unit = new Model_Admin();
        echo json_encode($unit->get_list_units($grade_id,$subject_id));
    }
    public function get_dashboard_info()
    {
        $get_total = new Model_Admin();
        $admin = new stdclass();
        $admin->count = $get_total->get_total_admin();
        $admin->name = "Quản Trị Viên";
        $admin->icon = "fa-user";
        $admin->actionlink = "show_admins_panel";
        $teacher = new stdclass();
        $teacher->count = $get_total->get_total_teacher();
        $teacher->name = "Giáo Viên";
        $teacher->icon = "fa-user";
        $teacher->actionlink = "show_teachers_panel";
        $student = new stdclass();
        $student->count = $get_total->get_total_student();
        $student->name = "Học Sinh";
        $student->icon = "fa-user";
        $student->actionlink = "show_students_panel";
        $grade = new stdclass();
        $grade->count = $get_total->get_total_grade();
        $grade->name = "Khối";
        $grade->icon = "fa-archive";
        $grade->actionlink = "show_classes_panel";
        $class = new stdclass();
        $class->count = $get_total->get_total_class();
        $class->name = "Lớp";
        $class->icon = "fa-archive";
        $class->actionlink = "show_classes_panel";
        $subject = new stdclass();
        $subject->count = $get_total->get_total_subject();
        $subject->name = "Môn Học";
        $subject->icon = "fa-book";
        $subject->actionlink = "show_subjects_panel";
        $question = new stdclass();
        $question->count = $get_total->get_total_question();
        $question->name = "Câu Hỏi";
        $question->icon = "fa-question";
        $question->actionlink = "show_questions_panel";
        $test = new stdclass();
        $test->count = $get_total->get_total_test();
        $test->name = "Bài Thi";
        $test->icon = "fa-edit";
        $test->actionlink = "show_tests_panel";
        $total = array($admin,$teacher,$student,$grade,$class,$subject,$question,$test);
        return $total;
    }
    public function notify_teacher($ID, $teacher_id)
    {
        $send = new Model_Admin();
        $send->notify_teacher($ID, $teacher_id);
    }
    public function notify_class($ID, $class_id)
    {
        $send = new Model_Admin();
        $send->notify_class($ID, $class_id);
    }
    public function check_add_admin()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        if (empty($name)||empty($username)||empty($password)||empty($email)||empty($birthday)||empty($gender)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_admin_via_file()
    {
        $inputFileType = 'Xlsx';      
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    public function check_del_admin()
    {
        $result = array();
        $admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
        $del = $this->del_admin($admin_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['admin_id'] = $admin_id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['admin_id'] = $admin_id;
        }
        echo json_encode($result);
    }
    public function check_edit_admin()
    {
        $result = array();
        $admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender_id)||empty($birthday)||empty($admin_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_admin($admin_id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_teacher()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($username)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_teacher_via_file()
    {
        $inputFileType = 'Xlsx';      
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    public function check_del_teacher()
    {
        $result = array();
        $teacher_id = Htmlspecialchars($_POST['teacher_id']);
        $del = $this->del_teacher($teacher_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['teacher_id'] = $teacher_id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['teacher_id'] = $teacher_id;
        }
        echo json_encode($result);
    }
    public function check_edit_teacher()
    {
        $result = array();
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender_id)||empty($birthday)||empty($teacher_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_teacher($teacher_id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_class()
    {
        $result = array();
        $class_name = isset($_POST['class_name']) ? Htmlspecialchars(addslashes($_POST['class_name'])) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars(addslashes($_POST['teacher_id'])) : '';
        if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_class($grade_id, $class_name, $teacher_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_class_info($class_name)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! lớp đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_del_class()
    {
        $result = array();
        $class_id = Htmlspecialchars($_POST['class_id']);
        $del = $this->del_class($class_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['class_id'] = $class_id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['class_id'] = $class_id;

        }
        echo json_encode($result);
    }
    public function check_edit_class()
    {
        $result = array();
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars($_POST['class_id']) : '';
        $class_name = isset($_POST['class_name']) ? Htmlspecialchars($_POST['class_name']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
        if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $this->edit_class($class_id, $grade_id, $class_name, $teacher_id);
            $result = json_decode(json_encode($this->get_class_info($class_name)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_add_student()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($username)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_student_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_student_via_file()
    {
        $inputFileType = 'Xlsx';      
        $result = array();
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    public function check_edit_student()
    {
        $result = array();
        $student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender)||empty($birthday)||empty($student_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->edit_student($student_id, $birthday, $password, $name, $class_id, $gender);
            $result = json_decode(json_encode($this->get_student_info($username)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_del_student()
    {
        $result = array();
        $student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
        $del = $this->del_student($student_id);
        if($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['student_id'] = $student_id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['student_id'] = $student_id;

        }
        echo json_encode($result);
    }
    public function check_add_question()
    {
        $result = array();
        $question_detail = isset($_POST['question_detail']) ? $_POST['question_detail'] : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $unit = isset($_POST['unit']) ? Htmlspecialchars(addslashes($_POST['unit'])) : '';
        $subject_id = isset($_POST['subject_id']) ? addslashes($_POST['subject_id']) : '';
        $answer_a = isset($_POST['answer_a']) ? addslashes($_POST['answer_a']) : '';
        $answer_b = isset($_POST['answer_b']) ? addslashes($_POST['answer_b']) : '';
        $answer_c = isset($_POST['answer_c']) ? addslashes($_POST['answer_c']) : '';
        $answer_d = isset($_POST['answer_d']) ? addslashes($_POST['answer_d']) : '';
        $correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars(addslashes($_POST['correct_answer'])) : '';
        if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập";
            $result['status'] = 0;
        } else {
            $res = $this->add_question($subject_id,$question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
            if($res) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Thêm thất bại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function check_add_question_via_file()
    {
        $inputFileType = 'Xlsx';      
        $result = array();
        $shuffle = array();
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars(addslashes($_POST['subject_id'])) : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $question_content = $sheetData[$i]['B'];
            $answer_a = $sheetData[$i]['C'];
            $answer_b = $sheetData[$i]['D'];
            $answer_c = $sheetData[$i]['E'];
            $answer_d = $sheetData[$i]['F'];
            $correct_answer = $sheetData[$i]['G'];
            $grade_id = $sheetData[$i]['G'];
            $unit = $sheetData[$i]['G'];
            $add = $this->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' câu hỏi!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm câu hỏi có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_del_question()
    {
        $return = array();
        $question_id = isset($_POST['question_id']) ? Htmlspecialchars($_POST['question_id']) : '';
        $this->del_question($question_id);
        $result['status_value'] = "Xóa thành công!";
        $result['status'] = 1;
        $result['question_id'] = $question_id;
        echo json_encode($result);
    }
    public function check_edit_question()
    {
        $result = array();
        $question_id = isset($_POST['question_id']) ? Htmlspecialchars($_POST['question_id']) : '';
        $question_content = isset($_POST['question_content']) ? $_POST['question_content'] : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars($_POST['subject_id']) : '';
        $unit = isset($_POST['unit']) ? Htmlspecialchars($_POST['unit']) : '';
        $answer_a = isset($_POST['answer_a']) ? Htmlspecialchars($_POST['answer_a']) : '';
        $answer_b = isset($_POST['answer_b']) ? Htmlspecialchars($_POST['answer_b']) : '';
        $answer_c = isset($_POST['answer_c']) ? Htmlspecialchars($_POST['answer_c']) : '';
        $answer_d = isset($_POST['answer_d']) ? Htmlspecialchars($_POST['answer_d']) : '';
        $correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars($_POST['correct_answer']) : '';
        $correct_answer = addslashes($_POST['correct_answer']);
        if (empty($question_content)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $res = $this->edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
            if($res) {
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Sửa thất bại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function send_notification()
    {
        $result = array();
        $notification_title = isset($_POST['notification_title']) ? htmlspecialchars($_POST['notification_title']) : '';
        $notification_content = isset($_POST['notification_content']) ? htmlspecialchars($_POST['notification_content']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? json_decode(stripslashes($_POST['teacher_id'])) : array();
        $class_id = isset($_POST['class_id']) ? json_decode(stripslashes($_POST['class_id'])) : array();
        if (empty($notification_title)||empty($notification_content)) {
            $result['status_value'] = "Nội dung hoặc tiêu đề trống!";
            $result['status'] = 0;
        } else {
            if (empty($teacher_id)&&empty($class_id)) {
                $result['status_value'] = "Chưa chọn người nhận!";
                $result['status'] = 0;
            } else {
                do {
                    $notification_id = rand(1,999999)+rand(1,111111);
                    $insert = $this->insert_notification($notification_id,$notification_title, $notification_content);
                } while($insert == false);
                foreach ($teacher_id as $teacher_id_) {
                    $this->notify_teacher($notification_id, $teacher_id_);
                }
                foreach ($class_id as $class_id_) {
                    $this->notify_class($notification_id, $class_id_);
                };
                $result['status_value'] = "Gửi thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
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
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
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
    public function delete_check_students()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_student($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del;
        }
        echo json_encode($result);
    }
    public function delete_check_admins()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_admin($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del;
        }
        echo json_encode($result);
    }
    public function delete_check_teachers()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_teacher($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del;
        }
        echo json_encode($result);
    }
    public function delete_check_classes()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_class($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del;
        }
        echo json_encode($result);
    }
    public function delete_check_questions()
    {
        $result = array();
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $this->del_question($list_check[$i]);
        }
        $result['status'] = 1;
        $result['status_value'] = "Xóa thành công";
        echo json_encode($result);
    }

    public function check_add_subject()
    {
        $result = array();
        $subject_detail = isset($_POST['subject_detail']) ? Htmlspecialchars(addslashes($_POST['subject_detail'])) : '';
        if (empty($subject_detail)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_subject($subject_detail);
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Môn đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_del_subject()
    {
        $result = array();
        $subject_id = Htmlspecialchars($_POST['subject_id']);
        $del = $this->del_subject($subject_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['subject_id'] = $subject_id;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['subject_id'] = $subject_id;
        }
        echo json_encode($result);
    }
    public function check_edit_subject()
    {
        $result = array();
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars($_POST['subject_id']) : '';
        $subject_detail = isset($_POST['subject_detail']) ? Htmlspecialchars(addslashes($_POST['subject_detail'])) : '';
        if (empty($subject_detail)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_subject($subject_id, $subject_detail);
            if (!$update) {
                $result['status_value'] = "Môn không tồn tại!";
                $result['status'] = 0;
            } else {
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_test()
    {
        $result = array();
        $test_name = isset($_POST['test_name']) ? Htmlspecialchars(addslashes($_POST['test_name'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars(addslashes($_POST['subject_id'])) : '';
        $total_questions = isset($_POST['total_questions']) ? Htmlspecialchars(addslashes($_POST['total_questions'])) : '';
        $time_to_do = isset($_POST['time_to_do']) ? Htmlspecialchars(addslashes($_POST['time_to_do'])) : '';
        $note = isset($_POST['note']) ? Htmlspecialchars(addslashes($_POST['note'])) : '';
        $test_code = rand(100000,999999);
        if (empty($test_name)||empty($time_to_do)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_test($test_code,$test_name, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
                //Tạo bộ câu hỏi cho đề thi
                $model = new Model_Admin();
                $list_unit = $model->get_list_units($grade_id,$subject_id);
                foreach ($list_unit as $unit) {
                    $limit = $_POST[$unit->unit];
                    $list_quest = $model->list_quest_of_unit($grade_id,$subject_id,$unit->unit,$limit);
                    foreach ($list_quest as $quest) {
                        $model->add_quest_to_test($test_code,$quest->question_id);
                    }
                }
            } else {
                $result['status_value'] = "Thêm thất bại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_toggle_test_status()
    {
        $result = array();
        $status_id = Htmlspecialchars($_POST['status_id']);
        $test_code = Htmlspecialchars($_POST['test_code']);
        $toggle = $this->toggle_test_status($test_code, $status_id);
        if ($toggle) {
            $result['status_value'] = "Đã thay đổi trạng thái!";
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Không thay đổi trạng thái!";
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function export_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

        $model = new Model_Admin();
        $scores = $model->get_test_score($test_code);

        //Create Excel Data
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','Danh Sách Điểm Bài Thi '.$test_code);
        $sheet->setCellValue('A3','STT');
        $sheet->setCellValue('B3','Tên');
        $sheet->setCellValue('C3','Tài Khoản');
        $sheet->setCellValue('D3','Lớp');
        $sheet->setCellValue('E3','Điểm');

        for ($i = 0; $i < count($scores); $i++) {
            $sheet->setCellValue('A'.($i+4),$i+1);
            $sheet->setCellValue('B'.($i+4),$scores[$i]->name);
            $sheet->setCellValue('C'.($i+4),$scores[$i]->username);
            $sheet->setCellValue('D'.($i+4),$scores[$i]->class_name);
            $sheet->setCellValue('E'.($i+4),$scores[$i]->score_number);
        }

        //Output File
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attactment;filename="danh-sach-diem-'.$test_code.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
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
    public function show_admins_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_admins_panel();
        $view->show_foot();
    }
    public function show_dashboard()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_dashboard($this->get_dashboard_info());
        $view->show_foot();
    }
    public function show_teachers_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_teachers_panel();
        $view->show_foot();
    }
    public function show_classes_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_classes_panel();
        $view->show_foot();
    }
    public function show_students_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_students_panel();
        $view->show_foot();
    }
    public function show_questions_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_questions_panel();
        $view->show_foot();
    }
    public function show_tests_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_tests_panel();
        $view->show_foot();
    }
    public function test_detail()
    {
        $view = new View_Admin();
        $model = new Model_Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $view->show_head_left($this->info);
        $view->show_tests_detail($model->get_quest_of_test($test_code));
        $view->show_foot();
    }
    public function test_score()
    {
        $view = new View_Admin();
        $model = new Model_Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $view->show_head_left($this->info);
        $view->show_test_score($model->get_test_score($test_code));
        $view->show_foot();
    }
    public function show_subjects_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_subjects_panel();
        $view->show_foot();
    }
    public function show_notifications_panel()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_notifications_panel();
        $view->show_foot();
    }
    public function show_about()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_about();
        $view->show_foot();
    }
    public function show_profiles()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_profiles($this->get_admin_info($this->info['username']));
        $view->show_foot();
    }
    public function show_404()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_404();
        $view->show_foot();
    }
}
