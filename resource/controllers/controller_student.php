<?php

require_once 'controller.php';
include_once('models/m_hoc_sinh.php');
/**
    * Controller Học Sinh
    * Author: Dzu
    * Mail: dzu6996@gmail.com
    **/
    class C_Hoc_Sinh extends Controller
    {
        private $info = array(
            'id_hs' => '',
            'tai_khoan' => '',
            'ten' => '',
            'chuc_vu' => '',
            'ten_cv' => '',
            'id_lop' => '',
            'ten_lop' => '',
            'id_khoi' => '');
        private $diem = array();
        /**
            * khởi tạo đối tượng với các thuộc tính nhận từ SESSION
            */
        public function __construct()
        {
            $this->info['id_hs'] = $_SESSION['id_hs'];
            $this->info['tai_khoan'] = $_SESSION['tai_khoan'];
            $this->info['ten'] = $_SESSION['ten'];
            $this->info['chuc_vu'] = $_SESSION['chuc_vu'];
            $this->info['id_lop'] = $_SESSION['id_lop'];
            $this->info['id_khoi'] = $this->getKhoi()->id_khoi;
            $this->info['ten_lop'] = $this->getTlop()->ten_lop;
            $this->info['ten_cv'] = $this->getQuyen()->mo_ta;
            $this->diem[0]=$this->getBangDiem()->unit_1;
            $this->diem[1]=$this->getBangDiem()->unit_2;
            $this->diem[2]=$this->getBangDiem()->unit_3;
            $this->diem[3]=$this->getBangDiem()->unit_4;
        }
        public function logout()
        {
            $this->loadView('hoc_sinh');
            $view = new V_Hoc_Sinh();
            $status = "Đăng xuất thành công!";
            $view->statusSuccess($status);
            session_destroy();
            header("Refresh:2; url=index.php");
        }
        public function getTaiKhoan()
        {
            return $this->info['tai_khoan'];
        }
        public function getTen()
        {
            return $this->info['ten'];
        }
        public function getTlop()
        {
            $lop = new M_Hoc_Sinh();
            return $lop->getTLop($this->info['id_lop']);
        }
        public function getQuyen()
        {
            $cv = new M_Hoc_Sinh();
            return $cv->getQuyen($this->info['chuc_vu']);
        }
        public function getBangDiem()
        {
            $diem = new M_Hoc_Sinh();
            return $diem->getBangDiem($this->info['id_lop'], $this->info['id_hs']);
        }
        // hàm lấy ID khối
        public function getKhoi()
        {
            $idkhoi = new M_Hoc_Sinh();
            return $idkhoi->getKhoi($this->info['id_lop']);
        }
        // hàm lấy ngẫu nhiên 10 câu hỏi trong CSDL dựa theo khối và chương (cơ sở dữ liệu lớn sẽ load lâu)
        public function getCauHoi($unit)
        {
            $cauhoi = new M_Hoc_Sinh();
            return $cauhoi->getCauHoi($this->info['id_khoi'], $unit);
        }
        public function get1CauHoi($id_cauhoi)
        {
            $ch = new M_Hoc_Sinh();
            return $ch->get1CauHoi($id_cauhoi);
        }
        // hàm ghi điểm sau khi làm bài thành công
        public function tinhDiem($unit, $diem)
        {
            $tdiem = new M_Hoc_Sinh();
            return $tdiem->tinhDiem($this->info['id_hs'], $this->info['id_lop'], $unit, $diem);
        }
        //hàm thêm đoạn chat vào MySQL theo id lớp
        public function chat($noi_dung)
        {
            $chat = new M_Hoc_Sinh();
            return $chat->chat($this->info['tai_khoan'], $this->info['ten'], $noi_dung, $this->info['id_lop']);
        }
        public function getChat()
        {
            $gchat = new M_Hoc_Sinh();
            return $gchat->getChat($this->info['id_lop']);
        }
        // hàm get thông báo đã  được gửi cho học sinh (chuc_vu = 3)
        public function getTBHS()
        {
            $tbgv = new M_Hoc_Sinh();
            return $tbgv->getTBHS();
        }
        public function showHeadLeft()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $view->showHeadLeft($this->info, $this->diem);
        }
        public function showFoot()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $view->showFoot();
        }
        public function showChat()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $chat = $this->getChat();
            $view->showChat($chat);
            // kiểm tra nút gửi chat được nhấn và đoạn chat có rỗng không
            if (isset($_POST['send'])) {
                $this->sendChat();
            }
        }
        public function sendChat()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $txt =  Htmlspecialchars(trim(addslashes($_POST['txt'])));
            if ($txt != '') {
                $this->chat($txt);
                $status = "Gửi thành công!";
                $view->statusSuccess($status);
                echo '<meta http-equiv="refresh" content="2" />';
            } else {
                $status = "Nội dung không được bỏ trống!";
                $view->statusFailed($status);
            }
        }
        public function showAllChat()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $chat = $this->getChat();
            $view->showAllChat($chat);
        }
        public function showNotify()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $tbhs = $this->getTBHS();
            $view->showNotify($tbhs);
        }
        //hàm làm bài tập
        public function doEx($unit)
        {
            //lấy số chương học sinh muốn làm từ url
            $unit =  Htmlspecialchars(addslashes($_GET['unit']));
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $cau_hoi = $this->getCauHoi($unit);
            $view->doEx($unit, $cau_hoi, $this->diem);
        }
        //hàm nộp bài và ghi điểm
        public function sendEx()
        {
            $this->loadView("hoc_sinh");
            $view = new V_Hoc_Sinh();
            $status = "Nộp bài thành công!";
            $view->statusSuccess($status);
            //gán các kết quả thông số được gửi từ view làm bài thông qua phương thức POST
    $unit = $_POST['unit']; //nhận số chương mà học sinh đã làm từ view làm bài thông qua POST
    $ts_ch = $_POST['tong_so_ch'];//nhận tổng số câu hỏi đã hiển thị trên view làm bài của học sinh
    // vòng lặp gán các ID câu hỏi đã hiển thị trên view làm bài và các đáp án tương ứng của học sinh vào 2 mảng $id_cauhoi[] và $da_cauhoi[]
    for ($i = 0; $i < $ts_ch; $i++) {
        $id_cauhoi[$i] =  Htmlspecialchars(addslashes($_POST['id_ch_'.$i.'']));
        $da_cauhoi[$i] =  Htmlspecialchars(addslashes($_POST['da_'.$i.'']));
    }
            // vòng lặp load các câu hỏi và các đáp án ra
            for ($i = 0; $i < $ts_ch; $i++) {
                //gán thông tin câu hỏi lấy thược vào biến $cau_hoi
                $cau_hoi[$i] = $this->get1CauHoi($id_cauhoi[$i]);
            }
            $diem = $view->sendEx($unit, $ts_ch, $id_cauhoi, $cau_hoi, $da_cauhoi);
            $this->tinhDiem($unit, $diem);
        }
    }
