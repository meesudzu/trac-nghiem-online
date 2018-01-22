<?php

require_once 'controller.php';
include_once('models/m_giao_vien.php');
/**
    * Controller Giáo Viên
    * Author: Dzu
    * Mail: dzu6996@gmail.com
    **/
    class C_Giao_Vien extends Controller
    {
        public $info =  array(
            'id_gv' => '',
            'tai_khoan' => '',
            'ten' => '',
            'chuc_vu' => '',
            'ten_cv' => '');
        //mảng sẽ chưa danh sách lớp giáo viên đó quản lý
        private $dsl = array();
        //hàm tạo với các thuộc tính nhận từ session
        public function __construct()
        {
            $this->info['id_gv'] = $_SESSION['id_gv'];
            $this->info['tai_khoan'] = $_SESSION['tai_khoan'];
            $this->info['ten'] = $_SESSION['ten'];
            $this->info['chuc_vu'] = $_SESSION['chuc_vu'];
            $this->info['ten_cv'] = $this->getQuyen($this->info['chuc_vu'])->mo_ta;
            $this->dsl = $this->getDSL();
        }
        public function logout()
        {
            $this->loadView('giao_vien');
            $view = new V_Giao_Vien();
            $status = "Đăng xuất thành công!";
            $view->statusSuccess($status);
            session_destroy();
            header("Refresh:2; url=index.php");
        }
        // hàm lấy tên chức vụ
        public function getQuyen()
        {
            $cv = new M_Giao_Vien();
            return $cv->getQuyen($this->info['chuc_vu']);
        }
        // hàm lấy danh sách lớp
        public function getDSL()
        {
            $getDSL = new M_Giao_Vien();
            return $getDSL->getDSL($this->info['id_gv']);
        }
        // hàm lấy chi tiết lớp theo ID lớp
        public function getCTL($id_lop)
        {
            $getCTL = new M_Giao_Vien();
            return $getCTL->getCTL($id_lop);
        }
        // hàm lấy tên học sinh
        public function getTHS($id_hs)
        {
            $getTHS = new M_Giao_Vien();
            return $getTHS->getTHS($id_hs);
        }
        // hàm lấy thông báo đã gửi cho giáo viên (chuc_vu = 2)
        public function getTBGV()
        {
            $tbgv = new M_Giao_Vien();
            return $tbgv->getTBGV();
        }
        // hàm gửi thông báo cho học sinh
        public function sendHS($chu_de, $noi_dung)
        {
            $send = new M_Giao_Vien();
            return $send->sendHS($this->info['tai_khoan'], $this->info['ten'], $chu_de, $noi_dung);
        }
        // hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
        public function getTBHS()
        {
            $tbgv = new M_Giao_Vien();
            return $tbgv->getTBHS();
        }
        public function showHeadLeft()
        {
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $view->showHeadLeft($this->info, $this->dsl);
        }
        public function showFoot()
        {
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $view->showFoot();
        }
        //hàm gửi thônng báo cho học sinh
        public function sendNotify()
        {
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $view->sendNotify($this->getTBHS());
            //kiểm tra nội dung và chủ đè không bỏ trống, thực hiện thêm vào CSDL
            if (isset($_POST['send_hs'])) {
                $this->checkNotify();
            }
        }
        public function checkNotify()
        {
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $chu_de =  Htmlspecialchars(trim(addslashes($_POST['chu_de_hs'])));
            $noi_dung =  Htmlspecialchars(trim(addslashes($_POST['noi_dung_hs'])));
            if ($chu_de != '' && $noi_dung != '') {
                $this->sendHS($chu_de, $noi_dung);
                $status = "Gửi thành công!";
                $view->statusSuccess($status);
                echo '<meta http-equiv="refresh" content="2" />';
            } else {
                $status = "Nội dung không được bỏ trống!";
                $view->statusFailed($status);
            }
        }
        //hàm nhận thông báo cho giáo viên
        public function reNotify()
        {
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $view->reNotify($this->getTBGV());
        }
        //hàm hiển thị chi tiết lớp
        public function showDetails($id_lop)
        {
            $dsTenHS  = array();
            //mảng lưu chi tiết điểm của lớp theo id_lop
            $getCTL = $this->getCTL($id_lop);
            //biến lưu danh sách lớp gíao viên đó quản lý
            $dsl = $this->dsl;
            for ($j = 0; $j < count($getCTL); $j++) {
                //mảng lưu tên học sin theo id_hs
                $dsTenHS[$j] = $this->getTHS($getCTL[$j]->id_hs);
            }
            $this->loadView("giao_vien");
            $view = new V_Giao_Vien();
            $view->showDetails($id_lop, $dsl, $dsTenHS, $getCTL);
        }
    }
