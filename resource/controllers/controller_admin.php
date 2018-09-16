<?php
/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
require_once('models/model_admin.php');
require_once 'controller.php';

class Controller_Admin extends Controller
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
    public function get_unit($ID)
    {
        $info = new Model_Admin();
        return $info->get_unit($ID);
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
    public function get_list_units()
    {
        $list_units = new Model_Admin();
        echo json_encode($list_units->get_list_units());
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
    public function add_unit($detail, $time_to_do, $status_id, $close_time)
    {
        $add = new Model_Admin();
        return $add->add_unit($detail, $time_to_do, $status_id, $close_time);
    }
    public function del_unit($unit)
    {
        $del = new Model_Admin();
        return $del->del_unit($unit);
    }
    public function edit_unit($unit, $detail, $status_id, $close_time)
    {
        $del = new Model_Admin();
        $del->edit_unit($unit, $detail, $status_id, $close_time);
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
    public function edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
    {
        $edit = new Model_Admin();
        $edit->edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
    }
    public function del_question($ID)
    {
        $del = new Model_Admin();
        $del->del_question($ID);
    }
    public function add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer)
    {
        $add_question = new Model_Admin();
        return $add_question->add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
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
    public function insert_notification($notification_title, $notification_content)
    {
        $notification = new Model_Admin();
        return $notification->insert_notification($this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    public function get_dashboard_info()
    {
        $get_total = new Model_Admin();
        $total[] = new stdclass();
        $total[0]->count = $get_total->get_total_admin();
        $total[0]->name = "Quản Trị Viên";
        $total[0]->icon = "fa-user";
        $total[1]->count = $get_total->get_total_teacher();
        $total[1]->name = "Giáo Viên";
        $total[1]->icon = "fa-user";
        $total[2]->count = $get_total->get_total_student();
        $total[2]->name = "Học Sinh";
        $total[2]->icon = "fa-user";
        $total[3]->count = $get_total->get_total_grade();
        $total[3]->name = "Khối";
        $total[3]->icon = "fa-archive";
        $total[4]->count = $get_total->get_total_class();
        $total[4]->name = "Lớp";
        $total[4]->icon = "fa-archive";
        $total[5]->count = $get_total->get_total_subject();
        $total[5]->name = "Môn Học";
        $total[5]->icon = "fa-book";
        $total[6]->count = $get_total->get_total_question();
        $total[6]->name = "Câu Hỏi";
        $total[6]->icon = "fa-question";

        echo json_encode($total);
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
    public function show_head_left()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_head_left($this->info);
    }
    public function show_foot()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_foot();
    }
    public function show_admins_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_admins_panel();
    }
    public function show_dashboard()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_dashboard();
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
    public function show_teachers_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_teachers_panel();
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
    public function show_classes_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_classes_panel();
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
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
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
    public function show_students_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_students_panel();
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
    public function show_questions_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_questions_panel();
    }
    public function check_add_question()
    {
        $result = array();
        $question_detail = isset($_POST['question_detail']) ? Htmlspecialchars(addslashes($_POST['question_detail'])) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $unit = isset($_POST['unit']) ? Htmlspecialchars(addslashes($_POST['unit'])) : '';
        $answer_a = isset($_POST['answer_a']) ? Htmlspecialchars(addslashes($_POST['answer_a'])) : '';
        $answer_b = isset($_POST['answer_b']) ? Htmlspecialchars(addslashes($_POST['answer_b'])) : '';
        $answer_c = isset($_POST['answer_c']) ? Htmlspecialchars(addslashes($_POST['answer_c'])) : '';
        $answer_d = isset($_POST['answer_d']) ? Htmlspecialchars(addslashes($_POST['answer_d'])) : '';
        $correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars(addslashes($_POST['correct_answer'])) : '';
        if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập";
            $result['status'] = 0;
        } else {
            $ID = $this->add_question($question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
            $result = json_decode(json_encode($this->get_question_info($ID)), true);
            $result['status_value'] = "Thêm thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_add_unit()
    {
        $result = array();
        $detail = isset($_POST['detail']) ? Htmlspecialchars(addslashes($_POST['detail'])) : '';
        $time_to_do = isset($_POST['time_to_do']) ? Htmlspecialchars(addslashes($_POST['time_to_do'])) : '';
        $status_id = isset($_POST['status_id']) ? Htmlspecialchars(addslashes($_POST['status_id'])) : '';
        $close_time = isset($_POST['close_time']) ? Htmlspecialchars(addslashes($_POST['close_time'])) : '';
        if (empty($detail)||empty($status_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập";
            $result['status'] = 0;
        } else {
            $ID = $this->add_unit($detail, $time_to_do, $status_id, $close_time);
            $result = json_decode(json_encode($this->get_unit($ID)), true);
            $result['status_value'] = "Thêm thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_edit_unit()
    {
        $result = array();
        $unit = isset($_POST['unit']) ? Htmlspecialchars(addslashes($_POST['unit'])) : '';
        $detail = isset($_POST['detail']) ? Htmlspecialchars(addslashes($_POST['detail'])) : '';
        $status_id = isset($_POST['status_id']) ? Htmlspecialchars(addslashes($_POST['status_id'])) : '';
        $close_time = isset($_POST['close_time']) ? Htmlspecialchars(addslashes($_POST['close_time'])) : '';
        if (empty($detail)||empty($status_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập";
            $result['status'] = 0;
        } else {
            $ID = $this->edit_unit($unit, $detail, $status_id, $close_time);
            $result = json_decode(json_encode($this->get_unit($unit)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_del_unit()
    {
        $result = array();
        $unit = isset($_POST['unit']) ? Htmlspecialchars($_POST['unit']) : '';
        $del = $this->del_unit($unit);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['unit'] = $unit;
        } else {
            $result['status_value'] = "Không thể xóa!";
            $result['status'] = 0;
            $result['unit'] = $unit;
        }
        echo json_encode($result);
    }
    public function check_del_question()
    {
        $return = array();
        $ID = isset($_POST['ID']) ? Htmlspecialchars($_POST['ID']) : '';
        $this->del_question($ID);
        $result['status_value'] = "Xóa thành công!";
        $result['status'] = 1;
        $result['ID'] = $ID;
        echo json_encode($result);
    }
    public function check_edit_question()
    {
        $result = array();
        $ID = isset($_POST['ID']) ? Htmlspecialchars($_POST['ID']) : '';
        $question_detail = isset($_POST['question_detail']) ? Htmlspecialchars($_POST['question_detail']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
        $unit = isset($_POST['unit']) ? Htmlspecialchars($_POST['unit']) : '';
        $answer_a = isset($_POST['answer_a']) ? Htmlspecialchars($_POST['answer_a']) : '';
        $answer_b = isset($_POST['answer_b']) ? Htmlspecialchars($_POST['answer_b']) : '';
        $answer_c = isset($_POST['answer_c']) ? Htmlspecialchars($_POST['answer_c']) : '';
        $answer_d = isset($_POST['answer_d']) ? Htmlspecialchars($_POST['answer_d']) : '';
        $correct_answer = isset($_POST['correct_answer']) ? Htmlspecialchars($_POST['correct_answer']) : '';
        $correct_answer = addslashes($_POST['correct_answer']);
        if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->edit_question($ID, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer);
            $result = json_decode(json_encode($this->get_question_info($ID)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function show_notifications_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_notifications_panel();
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
                $ID = $this->insert_notification($notification_title, $notification_content);
                foreach ($teacher_id as $teacher_id_) {
                    $this->notify_teacher($ID, $teacher_id_);
                }
                foreach ($class_id as $class_id_) {
                    $this->notify_class($ID, $class_id_);
                }
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
    public function show_units_panel()
    {
        $this->load_view("admin");
        $view = new View_Admin();
        $view->show_units_panel();
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
    public function delete_check_units()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_unit($list_check[$i]);
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
}
