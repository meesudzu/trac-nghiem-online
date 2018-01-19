<?php

include_once ('config/db.php');
/**
 * Model Học Sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class M_Hoc_Sinh extends Database
{
	// hàm lấy tên lớp
	public function getTLop($id_lop)
	{
		$sql = "SELECT ten_lop FROM lop WHERE id_lop='$id_lop'";
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
	// hàm lấy bảng điểm
	public function getBangDiem($id_lop,$id_hs)
	{
		$sql = "SELECT unit_1, unit_2, unit_3, unit_4 from diem where id_lop = '$id_lop' and id_hs = '$id_hs'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy ID khối
	public function getKhoi($id_lop)
	{
		$sql = "SELECT id_khoi from lop where id_lop = '$id_lop'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy ngẫu nhiên 10 câu hỏi trong CSDL dựa theo khối và chương (cơ sở dữ liệu lớn sẽ load lâu)
	public function getCauHoi($id_khoi,$unit)
	{
		$sql = "SELECT * from cau_hoi where id_khoi = '$id_khoi' and unit = '$unit' ORDER BY RAND() LIMIT 10";
		$this->setQuery($sql);
		return $this->loadRows();
	}
	// hàm lấy thông tin 1 câu hỏi thông qua id câu hỏi
	public function get1CauHoi($id_cauhoi)
	{
		$sql = "SELECT * from cau_hoi where id_cauhoi = '$id_cauhoi'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm ghi điểm sau khi làm bài thành công
	public function tinhDiem($id_hs,$id_lop,$unit,$diem)
	{
		$sql = "UPDATE diem SET unit_$unit = $diem WHERE id_hs = '$id_hs' and id_lop = '$id_lop'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	//hàm thêm đoạn chat vào MySQL theo id lớp
	public function chat($tai_khoan,$ten,$noi_dung,$id_lop)
	{
		$sql="INSERT INTO chat_lop (tai_khoan,ten,thoi_gian,noi_dung,id_lop) VALUES ('$tai_khoan','$ten',NOW(),'$noi_dung','$id_lop')";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	// hàm lấy chat lớp
	public function getChat($id_lop)
	{
		$sql = "SELECT * from chat_lop where id_lop = '$id_lop'";
		$this->setQuery($sql);
		return $this->loadRows();
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