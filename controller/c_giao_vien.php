<?php

include_once ('model/m_giao_vien.php');


/**
 * Controller Giáo Viên
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Giao_Vien
{
	var $id_gv = '';
	var $tai_khoan = '';
	var $ten = '';
	var $chuc_vu = '';
	var $ten_cv = '';
    var $dsl = array();//mảng sẽ chưa danh sách lớp giáo viên đó quản lý
    /**
     * hàm tạo với các thuộc tính nhận từ session
     */
    public function __construct($id_gv,$tai_khoan,$ten,$chuc_vu)
    {
    	$this->id_gv = $id_gv;
    	$this->tai_khoan = $tai_khoan;
    	$this->ten = $ten;
    	$this->chuc_vu = $chuc_vu;
        $this->ten_cv = $this->getQuyen($this->chuc_vu)->mo_ta;
        $this->dsl = $this->getDSL();		
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
    	$cv = new M_Giao_Vien();
    	return $cv->getQuyen($this->chuc_vu);
    }
    // hàm lấy danh sách lớp
    public function getDSL()
    {
        $getDSL = new M_Giao_Vien();
        return $getDSL->getDSL($this->id_gv);
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
    public function sendHS($chu_de,$noi_dung)
    {
        $send = new M_Giao_Vien();
        return $send->sendHS($this->tai_khoan,$this->ten,$chu_de,$noi_dung);
    }
    // hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
    public function getTBHS()
    {
        $tbgv = new M_Giao_Vien();
        return $tbgv->getTBHS();
    }
}
?>