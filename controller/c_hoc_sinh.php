<?php

include_once ('model/m_hoc_sinh.php');

 
/**
 * Controller Học Sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Hoc_Sinh
{
	var $id_hs = '';
	var $tai_khoan = '';
	var $ten = '';
	var $chuc_vu = '';
	var $ten_cv = '';
	var $id_lop = '';
	var $ten_lop = '';
    var $id_khoi = '';
	var $diem = array();
    /**
     * hàm tạo với các thuộc tính nhận từ SESSION
     */
    public function __construct($id_hs,$tai_khoan,$ten,$chuc_vu,$id_lop)
    {
    	$this->id_hs = $id_hs;
    	$this->tai_khoan = $tai_khoan;
    	$this->ten = $ten;
    	$this->chuc_vu = $chuc_vu;	
    	$this->id_lop = $id_lop;
        $this->id_khoi = $this->getKhoi($this->id_lop)->id_khoi;
        $this->ten_lop = $this->getTlop()->ten_lop;
        $this->ten_cv = $this->getQuyen()->mo_ta;
        $this->diem[0]=$this->getBangDiem()->unit_1;
        $this->diem[1]=$this->getBangDiem()->unit_2;
        $this->diem[2]=$this->getBangDiem()->unit_3;
        $this->diem[3]=$this->getBangDiem()->unit_4;	
    }
    // hàm đăng xuất
    public function logout()
    {
    	session_destroy();
    	header( "Refresh:0; url=index.php");
    }
    // hàm lấy tên lớp
    public function getTlop()
    {
    	$lop = new M_Hoc_Sinh();
    	return $lop->getTLop($this->id_lop);
    }
    // hàm lấy tên chức vụ
    public function getQuyen()
    {
    	$cv = new M_Hoc_Sinh();
    	return $cv->getQuyen($this->chuc_vu);
    }
    // hàm lấy bảng điểm
    public function getBangDiem()
    {
    	$diem = new M_Hoc_Sinh();
    	return $diem->getBangDiem($this->id_lop,$this->id_hs);
    }
    // hàm lấy ID khối
    public function getKhoi($id_lop)
    {
        $idkhoi = new M_Hoc_Sinh();
        return $idkhoi->getKhoi($id_lop);
    }
    // hàm lấy ngẫu nhiên 5 câu hỏi trong CSDL dựa theo khối và chương (cơ sở dữ liệu lớn sẽ load lâu)
    public function getCauHoi($unit)
    {
    	$cauhoi = new M_Hoc_Sinh();
    	return $cauhoi->getCauHoi($this->id_khoi,$unit);
    }
    // hàm lấy thông tin 1 câu hỏi thông qua id câu hỏi
    public function get1CauHoi($id_cauhoi)
    {
        $ch = new M_Hoc_Sinh();
        return $ch->get1CauHoi($id_cauhoi);
    }
    // hàm ghi điểm sau khi làm bài thành công
    public function tinhDiem($id_hs,$id_lop,$unit,$diem)
    {
        $tdiem = new M_Hoc_Sinh();
        return $tdiem->tinhDiem($id_hs,$id_lop,$unit,$diem);
    }
    //hàm thêm đoạn chat vào MySQL theo id lớp
    public function chat($noi_dung)
    {
        $chat = new M_Hoc_Sinh();
        return $chat->chat($this->tai_khoan,$this->ten,$noi_dung,$this->id_lop);
    }
    // hàm lấy chat lớp
    public function getChat()
    {
        $gchat = new M_Hoc_Sinh();
        return $gchat->getChat($this->id_lop);
    }
    // hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
    public function getTBHS()
    {
        $tbgv = new M_Hoc_Sinh();
        return $tbgv->getTBHS();
    }
}
?>