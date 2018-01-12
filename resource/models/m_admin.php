<?php

include_once ('config/db.php');
/**
 * Model Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class M_Admin extends Database
{
	public function login($tai_khoan,$mat_khau)
	{
		$sql = "SELECT * FROM admin WHERE tai_khoan='$tai_khoan' and mat_khau = '$mat_khau'";
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
	// hàm lấy danh sách admin
public function getDSA()
{
	$sql = "SELECT * FROM admin";
	$this->setQuery($sql);
	return $this->loadRows();
}
public function editAdmin($id_admin,$tai_khoan,$mat_khau,$ten)
{
	$sql="UPDATE admin set tai_khoan='$tai_khoan', mat_khau='$mat_khau', ten ='$ten' where id_admin='$id_admin'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function delAdmin($id_admin)
{
	$sql="DELETE FROM admin where id_admin='$id_admin'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function addAdmin($tai_khoan,$mat_khau,$ten)
{
	$sql = "SELECT id_admin FROM admin WHERE tai_khoan = '$tai_khoan'";
	$this->setQuery($sql);
	if($this->loadRow()!='')
		return false;
	//reset AUTO_INCREMENT
	$sql = "ALTER TABLE `admin` AUTO_INCREMENT=1";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="INSERT INTO admin (tai_khoan,mat_khau,ten,chuc_vu) VALUES ('$tai_khoan','$mat_khau','$ten',1)";
	$this->setQuery($sql);
	$this->execNonReturn();
	return true;
}
	// hàm lấy danh sách giáo viên
public function getDSGV()
{
	$sql = "SELECT * FROM giao_vien";
	$this->setQuery($sql);
	return $this->loadRows();
}
public function editGV($id_gv,$tai_khoan,$mat_khau,$ten)
{
	$sql="UPDATE giao_vien set tai_khoan='$tai_khoan', mat_khau='$mat_khau', ten ='$ten' where id_gv='$id_gv'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function delGV($id_gv)
{
	$sql="DELETE FROM giao_vien where id_gv='$id_gv'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function addGV($tai_khoan,$mat_khau,$ten)
{
	$sql = "SELECT id_gv FROM giao_vien WHERE tai_khoan = '$tai_khoan'";
	$this->setQuery($sql);
	if($this->loadRow()!='')
		return false;
	//reset AUTO_INCREMENT
	$sql = "ALTER TABLE `giao_vien` AUTO_INCREMENT=1";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="INSERT INTO giao_vien (tai_khoan,mat_khau,ten,chuc_vu) VALUES ('$tai_khoan','$mat_khau','$ten',2)";
	$this->setQuery($sql);
	$this->execNonReturn();
	return true;
}
	// hàm lấy danh sách học sinh
public function getDSHS()
{
	$sql = "SELECT * FROM hoc_sinh";
	$this->setQuery($sql);
	return $this->loadRows();
}
	// hàm sửa học sinh (sau đó sửa thông tin học sinh trong bảng điểm)
public function editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop)
{
	$sql="UPDATE hoc_sinh set tai_khoan='$tai_khoan', mat_khau='$mat_khau', ten ='$ten', id_lop ='$id_lop' where id_hs='$id_hs'";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="UPDATE diem set id_lop ='$id_lop'  where id_hs='$id_hs'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
	 // hàm xóa học sinh (sau đó xóa thông tin học sinh trong bảng điểm)
public function delHS($id_hs,$id_lop)
{
	$sql="DELETE FROM diem where id_hs='$id_hs' and id_lop = '$id_lop'";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="DELETE FROM hoc_sinh where id_hs='$id_hs'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
	// hàm thêm điểm của 1 học sinh mới vao bảng điểm
public function addDiem($id_hs,$id_lop)
{
	$sql="INSERT INTO diem (id_hs,unit_1,unit_2,unit_3,unit_4,id_lop) VALUES ('$id_hs',-1,-1,-1,-1,'$id_lop')";
	$this->setQuery($sql);
	$this->execNonReturn();
}
	// hàm reset bộ đếm ID tự động rồi thêm học sinh
public function addHS($tai_khoan,$mat_khau,$ten,$id_lop)
{
	$sql = "SELECT id_hs FROM hoc_sinh WHERE tai_khoan = '$tai_khoan'";
	$this->setQuery($sql);
	if($this->loadRow()!='')
		return false;
	//reset AUTO_INCREMENT
	$sql = "ALTER TABLE `hoc_sinh` AUTO_INCREMENT=1";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="INSERT INTO hoc_sinh (tai_khoan,mat_khau,ten,chuc_vu,id_lop) VALUES ('$tai_khoan','$mat_khau','$ten',3,'$id_lop')";
	$this->setQuery($sql);
	$this->execNonReturn();
	return true;
}
public function getTenLop($id_lop)
{
	$sql = "SELECT ten_lop from lop where id_lop = '$id_lop'";
	$this->setQuery($sql);
	return $this->loadRow();
}
	// hàm lấy danh sách lớp
public function getDSL()
{
	$sql = "SELECT * FROM lop";
	$this->setQuery($sql);
	return $this->loadRows();
}
public function editLop($id_lop,$id_khoi,$ten_lop,$id_gv)
{
	$sql="UPDATE lop set id_khoi='$id_khoi', ten_lop='$ten_lop', id_gv ='$id_gv'  where id_lop ='$id_lop'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function delLop($id_lop)
{
	$sql="DELETE FROM lop where id_lop='$id_lop'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function addLop($id_khoi,$ten_lop,$id_gv)
{
	$sql = "SELECT * FROM lop WHERE ten_lop = '$ten_lop'";
	$this->setQuery($sql);
	if($this->loadRow()!='')
		return false;
	//reset AUTO_INCREMENT
	$sql = "ALTER TABLE `lop` AUTO_INCREMENT=1";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="INSERT INTO lop (id_khoi,ten_lop,id_gv) VALUES ('$id_khoi','$ten_lop','$id_gv')";
	$this->setQuery($sql);
	$this->execNonReturn();
	return true;
}
public function getTenKhoi($id_khoi)
{
	$sql = "SELECT mo_ta from khoi where id_khoi = '$id_khoi'";
	$this->setQuery($sql);
	return $this->loadRow();
}
	// hàm lấy danh sách khối
public function getKhoi()
{
	$sql = "SELECT * from khoi";
	$this->setQuery($sql);
	return $this->loadRows();
}
public function getTenGV($id_gv)
{
	$sql = "SELECT ten from giao_vien where id_gv = '$id_gv'";
	$this->setQuery($sql);
	return $this->loadRow();
}
	// hàm lấy danh sách câu hỏi
public function getDSCH()
{
	$sql = "SELECT * FROM cau_hoi";
	$this->setQuery($sql);
	return $this->loadRows();
}
public function editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
{
	$sql="UPDATE cau_hoi set cau_hoi='$cau_hoi', id_khoi='$id_khoi', unit ='$unit',da_1 ='$da_1',da_2 ='$da_2',da_3 ='$da_3',da_4 ='$da_4',da_dung ='$da_dung' where id_cauhoi='$id_cauhoi'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function delCH($id_cauhoi)
{
	$sql="DELETE FROM cau_hoi where id_cauhoi='$id_cauhoi'";
	$this->setQuery($sql);
	$this->execNonReturn();
}
public function addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
{
	//reset AUTO_INCREMENT
	$sql = "ALTER TABLE `cau_hoi` AUTO_INCREMENT=1";
	$this->setQuery($sql);
	$this->execNonReturn();
	$sql="INSERT INTO cau_hoi (id_khoi,unit,cau_hoi,da_1,da_2,da_3,da_4,da_dung) VALUES ($id_khoi,$unit,'$cau_hoi','$da_1','$da_2','$da_3','$da_4','$da_dung')";
	$this->setQuery($sql);
	$this->execNonReturn();
}
	// hàm gửi thông báo cho giáo viên
public function sendGV($tai_khoan,$ten,$chu_de,$noi_dung)
{
	$sql="INSERT INTO thong_bao (tai_khoan,ten,chu_de,noi_dung,thoi_gian,chuc_vu) VALUES ('$tai_khoan','$ten','$chu_de','$noi_dung',NOW(),2)";
	$this->setQuery($sql);
	$this->execNonReturn();
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
	$this->execNonReturn();
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