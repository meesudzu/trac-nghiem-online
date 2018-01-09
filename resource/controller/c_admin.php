<?php

include_once ('model/m_admin.php');

/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Admin
{
	var $id_admin = '';
	var $tai_khoan = '';
	var $ten = '';
	var $chuc_vu = '';
	var $ten_cv = '';
    /**
     * construct tạo đối tượng với các thuộc tính nhận từ SESSION
     */
    public function __construct($id_admin,$tai_khoan,$ten,$chuc_vu)
    {
    	$this->id_admin = $id_admin;
    	$this->tai_khoan = $tai_khoan;
    	$this->ten = $ten;
    	$this->chuc_vu = $chuc_vu;
    	$this->ten_cv = $this->getQuyen($this->chuc_vu)->mo_ta;		
    }
    // hàm đăng xuất
    public function logout()
    {
    	session_destroy();
    	header( "Refresh:0; url=index.php");
    }
    // hàm lấy tên chức vụ
    public function getQuyen()
    {
    	$cv = new M_Admin();
    	return $cv->getQuyen($this->chuc_vu);
    }
    // hàm lấy danh sách admin từ CSDL
    public function getDSA()
    {
    	$dsa = new M_Admin();
    	return $dsa->getDSA();
    }
    // hàm sửa admin
    public function editAdmin($id_admin,$tai_khoan,$mat_khau,$ten)
    {
    	$edit = new M_Admin();
    	return $edit->editAdmin($id_admin,$tai_khoan,$mat_khau,$ten);
    }
    // hàm xóa admin
    public function delAdmin($id_admin)
    {
    	$update = new M_Admin();
    	return $update->delAdmin($id_admin);
    }
    // hàm thêm admin
    public function addAdmin($tai_khoan,$mat_khau,$ten)
    {
    	$add = new M_Admin();
    	return $add->addAdmin($tai_khoan,$mat_khau,$ten);
    }
    // hàm lấy danh sách giáo viên
    public function getDSGV()
    {
    	$dsa = new M_Admin();
    	return $dsa->getDSGV();
    }
    // hàm sửa giáo viên
    public function editGV($id_gv,$tai_khoan,$mat_khau,$ten)
    {
    	$edit = new M_Admin();
    	return $edit->editGV($id_gv,$tai_khoan,$mat_khau,$ten);
    }
    // hàm xóa giáo viên
    public function delGV($id_gv)
    {
    	$update = new M_Admin();
    	return $update->delGV($id_gv);
    }
    // hàm thêm giáo viên
    public function addGV($tai_khoan,$mat_khau,$ten)
    {
    	$add = new M_Admin();
    	return $add->addGV($tai_khoan,$mat_khau,$ten);
    }
    // hàm lấy danh sách học sinh
    public function getDSHS()
    {
    	$dsa = new M_Admin();
    	return $dsa->getDSHS();
    }
    // hàm sửa học sinh
    public function editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop)
    {
    	$edit = new M_Admin();
    	return $edit->editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop);
    }
    // hàm xóa học sinh
    public function delHS($id_hs,$id_lop)
    {
    	$update = new M_Admin();
    	return $update->delHS($id_hs,$id_lop);
    }
    // hàm thêm học sinh
    public function addHS($tai_khoan,$mat_khau,$ten,$id_lop)
    {
    	$addhs = new M_Admin();
    	return $addhs->addHS($tai_khoan,$mat_khau,$ten,$id_lop);
    }
    // hàm thêm điểm của 1 học sinh mới bảng điểm
    public function addDiem($id_hs,$id_lop)
    {
        $adddiem = new M_Admin();
        return $adddiem->addDiem($id_hs,$id_lop);
    }
    // hàm lấy tên lớp
    public function getTenLop($id_lop)
    {
    	$tenlop = new M_Admin();
    	return $tenlop->getTenLop($id_lop);
    }
    // hàm lấy danh sách lớp
    public function getDSL()
    {
    	$dsl = new M_Admin();
    	return $dsl->getDSL();
    }
    // hàm sửa thông tin lớp
    public function editLop($id_lop,$id_khoi,$ten_lop,$id_gv)
    {
    	$edit = new M_Admin();
    	return $edit->editLop($id_lop,$id_khoi,$ten_lop,$id_gv);
    }
    // hàm xóa lớp
    public function delLop($id_lop)
    {
    	$update = new M_Admin();
    	return $update->delLop($id_lop);
    }
    // hàm thêm lớp
    public function addLop($id_khoi,$ten_lop,$id_gv)
    {
    	$add = new M_Admin();
    	return $add->addLop($id_khoi,$ten_lop,$id_gv);
    }
    // hàm lấy tên khối
    public function getTenKhoi($id_khoi)
    {
    	$tkhoi = new M_Admin();
    	return $tkhoi->getTenKhoi($id_khoi);
    }
    // hàm lấy danh sách khối
    public function getKhoi()
    {
    	$khoi = new M_Admin();
    	return $khoi->getKhoi();
    }
    // hàm lấy tên giáo viên
    public function getTenGV($id_gv)
    {
    	$khoi = new M_Admin();
    	return $khoi->getTenGV($id_gv);
    }
    // hàm lấy danh sách câu hỏi
    public function getDSCH()
    {
        $dsch = new M_Admin();
        return $dsch->getDSCH();
    }
    // hàm sửa câu hỏi
    public function editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
    {
        $editch = new M_Admin();
        return $editch->editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
    }
    // hàm xóa câu hỏi
    public function delCH($id_cauhoi)
    {
        $delch = new M_Admin();
        return $delch->delCH($id_cauhoi);
    }
    // hàm thêm câu hỏi
    public function addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
    {
        $addch = new M_Admin();
        return $addch->addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
    }
    // hàm gửi thông báo cho giáo viên
    public function sendGV($chu_de,$noi_dung)
    {
        $send = new M_Admin();
        return $send->sendGV($this->tai_khoan,$this->ten,$chu_de,$noi_dung);
    }
    // hàm lấy thông báo đã gửi cho giáo viên (chuc_vu = 2)
    public function getTBGV()
    {
        $tbgv = new M_Admin();
        return $tbgv->getTBGV();
    }
    // hàm gửi thông báo cho học sinh
    public function sendHS($chu_de,$noi_dung)
    {
        $send = new M_Admin();
        return $send->sendHS($this->tai_khoan,$this->ten,$chu_de,$noi_dung);
    }
    // hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
    public function getTBHS()
    {
        $tbgv = new M_Admin();
        return $tbgv->getTBHS();
    }

}
?>