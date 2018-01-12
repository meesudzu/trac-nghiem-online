<?php

include_once ('config/db.php');
/**
 * Model Giáo Viên
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class M_Giao_Vien extends Database
{
	public function login($tai_khoan,$mat_khau)
	{
		$sql = "SELECT * FROM giao_vien WHERE tai_khoan='$tai_khoan' and mat_khau = '$mat_khau'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy tên chức vụ
	public function getQuyen($chuc_vu)
	{
		$sql = "SELECT mo_ta FROM quyen WHERE chuc_vu='$chuc_vu'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy danh sách lớp
	public function getDSL($id_gv)
	{
		$sql = "SELECT ten_lop,id_lop from lop where id_gv = '$id_gv'";
		$this->setQuery($sql);
		return $this->loadRows();
	}
	// hàm lấy chi tiết lớp theo ID lớp
	public function getCTL($id_lop)
	{
		$sql = "SELECT id_hs,unit_1,unit_2,unit_3,unit_4 from diem where id_lop = '$id_lop'";
		$this->setQuery($sql);
		return $this->loadRows();
	}
	// hàm lấy tên học sinh
	public function getTHS($id_hs)
	{
		$sql = "SELECT ten from hoc_sinh where id_hs = '$id_hs'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy thông báo đã gửi cho giáo viên (chuc_vu = 2)
	public function getTBGV()
	{
		$sql = "SELECT * FROM thong_bao where chuc_vu = 2";
		$this->setQuery($sql);
		return $this->loadRows();
	}
	// hàm gửi thông báo cho học sinh
	public function sendHS($tai_khoan,$ten,$chu_de,$noi_dung)
	{
		$sql="INSERT INTO thong_bao (tai_khoan,ten,chu_de,noi_dung,thoi_gian,chuc_vu) VALUES ('$tai_khoan','$ten','$chu_de','$noi_dung',NOW(),3)";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
	public function getTBHS()
	{
		$sql = "SELECT * FROM thong_bao where chuc_vu = 3";
		$this->setQuery($sql);
		return $this->loadRows();
	}
}
?>