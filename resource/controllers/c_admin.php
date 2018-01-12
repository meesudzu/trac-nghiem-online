<?php

include_once ('models/m_admin.php');
require_once 'controller.php';
/**
 * Controller Admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class C_Admin extends Controller
{
	private $info  = array(
		'id_admin' => '', 
		'tai_khoan' => '', 
		'ten' => '', 
		'chuc_vu' => '', 
		'ten_cv' => '', 
	);
	/**
	 * constructor tạo đối tượng với các thuộc tính nhận từ SESSION
	 */
	public function __construct()
	{
		$this->info['id_admin'] = $_SESSION['id_admin'];
		$this->info['tai_khoan'] = $_SESSION['tai_khoan'];
		$this->info['ten'] = $_SESSION['ten'];
		$this->info['chuc_vu'] = $_SESSION['chuc_vu'];
		$this->info['ten_cv'] = $this->getQuyen($this->info['chuc_vu'])->mo_ta;		
	}
	public function logout()
	{
		$this->loadView('admin');
		$view = new V_Admin();
		$status = "Đăng xuất thành công!";
		$view->statusSuccess($status);
		session_destroy();
		header( "Refresh:2; url=index.php");
	}
	// hàm lấy tên chức vụ
	public function getQuyen()
	{
		$cv = new M_Admin();
		return $cv->getQuyen($this->info['chuc_vu']);
	}
	// hàm lấy danh sách admin từ CSDL
	public function getDSA()
	{
		$dsa = new M_Admin();
		return $dsa->getDSA();
	}
	public function editAdmin($id_admin,$tai_khoan,$mat_khau,$ten)
	{
		$edit = new M_Admin();
		return $edit->editAdmin($id_admin,$tai_khoan,$mat_khau,$ten);
	}
	public function delAdmin($id_admin)
	{
		$update = new M_Admin();
		return $update->delAdmin($id_admin);
	}
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
	public function editGV($id_gv,$tai_khoan,$mat_khau,$ten)
	{
		$edit = new M_Admin();
		return $edit->editGV($id_gv,$tai_khoan,$mat_khau,$ten);
	}
	public function delGV($id_gv)
	{
		$update = new M_Admin();
		return $update->delGV($id_gv);
	}
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
	public function editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop)
	{
		$edit = new M_Admin();
		return $edit->editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop);
	}
	public function delHS($id_hs,$id_lop)
	{
		$update = new M_Admin();
		return $update->delHS($id_hs,$id_lop);
	}
	public function addHS($tai_khoan,$mat_khau,$ten,$id_lop)
	{
		$addhs = new M_Admin();
		return $addhs->addHS($tai_khoan,$mat_khau,$ten,$id_lop);
	}
	// hàm thêm điểm của 1 học sinh mới vao bảng điểm
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
	public function editLop($id_lop,$id_khoi,$ten_lop,$id_gv)
	{
		$edit = new M_Admin();
		return $edit->editLop($id_lop,$id_khoi,$ten_lop,$id_gv);
	}
	public function delLop($id_lop)
	{
		$update = new M_Admin();
		return $update->delLop($id_lop);
	}
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
	public function editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
	{
		$editch = new M_Admin();
		return $editch->editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
	}
	public function delCH($id_cauhoi)
	{
		$delch = new M_Admin();
		return $delch->delCH($id_cauhoi);
	}
	public function addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung)
	{
		$addch = new M_Admin();
		return $addch->addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
	}
	// hàm gửi thông báo cho giáo viên
	public function sendGV($chu_de,$noi_dung)
	{
		$send = new M_Admin();
		return $send->sendGV($this->info['tai_khoan'],$this->info['ten'],$chu_de,$noi_dung);
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
		return $send->sendHS($this->info['tai_khoan'],$this->info['ten'],$chu_de,$noi_dung);
	}
	// hàm lấy thông báo đã gửi cho học sinh (chuc_vu = 3)
	public function getTBHS()
	{
		$tbgv = new M_Admin();
		return $tbgv->getTBHS();
	}
	public function showHeadLeft()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showHeadLeft($this->info);
	}
	public function showFoot()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showFoot();
	}
 //hàm hiển thị bảng quán lý admin + bắt các sự kiện thêm, sửa xóa
	public function showQLAdmin()
	{
		$dsa = $this->getDSA();
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showQLAdmin($dsa);
	// thực hiện thêm tài khoản admin sau khi nhấn nút thêm. Nếu thông tin đúng thực hiện, sai báo ra màn hình
		if(isset($_POST['add-admin']))
			$this->checkAddAdmin();
	// thực hiện xóa tài khoản admin sau khi nhấn nút xóa.
		if(isset($_POST['del-admin']))
			$this->checkDelAdmin();
		// thực hiện sửa tài khoản admin sau khi nhấn nút lưu. Nếu thông tin đúng thực hiện, sai báo ra màn hình
		if(isset($_POST['edit-admin']))
			$this->checkEditAdmin();
	}
	public function checkAddAdmin()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
		else
		{
			$add = $this->addAdmin($tai_khoan,$mat_khau,$ten);
			if($add)
				{
					$status = "Thêm thành công!";
					$view->statusSuccess($status);
				}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->statusFailed($status);
			}
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkDelAdmin()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_admin = Htmlspecialchars($_POST['id_admin']);
		$this->delAdmin($id_admin);
		$status = "Xóa thành công!";
		$view->statusSuccess($status);
		echo '<meta http-equiv="refresh" content="2" />'; 
	}
	public function checkEditAdmin()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_admin = Htmlspecialchars($_POST['id_admin']);
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
		else
		{
			$this->editAdmin($id_admin,$tai_khoan,$mat_khau,$ten);
			$status = "Sửa thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	//hàm hiển thị bảng quán lý giao vien + bắt các sự kiện thêm, sửa xóa
	public function showQLGiaoVien()
	{
		$dsgv = $this->getDSGV();
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showQLGiaoVien($dsgv);
		// thực hiện thêm giáo viên, nếu thông tin hợp lệ thì thực hiện, sai báo ra màn hình
		if(isset($_POST['add-gv']))
			$this->checkAddGV();
	// thực hiện xóa giáo viên
		if(isset($_POST['del-gv']))
			$this->checkDelGV();
	// thực hiện sửa giáo viên, nếu thông tin hợp lệ thì thực hiện, sai báo ra màn hình
		if(isset($_POST['edit-gv']))
			$this->checkEditGV();
	}
	public function checkAddGV()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
		else
		{
			$add = $this->addGV($tai_khoan,$mat_khau,$ten);
			if($add)
				{
					$status = "Thêm thành công!";
					$view->statusSuccess($status);
				}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->statusFailed($status);
			}
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkDelGV()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_gv = Htmlspecialchars($_POST['id_gv']);
		$this->delGV($id_gv);
		$status = "Xóa thành công!";
		$view->statusSuccess($status);
		echo '<meta http-equiv="refresh" content="2" />'; 
	}
	public function checkEditGV()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_gv = Htmlspecialchars($_POST['id_gv']);
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->statusFailed($status);
		}
		else
		{
			$this->editGV($id_gv,$tai_khoan,$mat_khau,$ten);
			$status = "Sửa thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		} 
	}
//hàm hiển thị bảng quán lý lớp + bắt các sự kiện thêm, sửa xóa
	public function showQLLop()
	{
		$dsl = $this->getDSL();
		$dskhoi = $this->getKhoi();
		$dsgv = $this->getDSGV();
		for ($i = 0; $i < count($dsl); $i++) { 
			$khoi[$i] = $this->getTenKhoi($dsl[$i]->id_khoi);
			$gv[$i] = $this->getTenGV($dsl[$i]->id_gv);
		}
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showQLLop($dsl,$dskhoi,$dsgv,$khoi,$gv);
	// thực hiện sửa thông tin lớp với các thông tin nhập vào, sai báo ra màn hình
		if(isset($_POST['edit-lop']))
			$this->checkEditLop();
	// thực hiện bắt sự kiện và xóa 1 lớp
		if(isset($_POST['del-lop']))
			$this->checkDelLop();
	 // thực hiện thêm 1 lớp với các thông tin nhập vào, sai báo ra màn hình
		if(isset($_POST['add-lop']))
			$this->checkAddLop();
	}
	public function checkAddLop()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$ten_lop = Htmlspecialchars(addslashes($_POST['ten_lop']));
		$id_khoi = Htmlspecialchars(addslashes($_POST['id_khoi']));
		$id_gv = Htmlspecialchars(addslashes($_POST['id_gv']));
		if(empty($ten_lop)||empty($id_khoi)||empty($id_gv))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->statusFailed($status);
		}
		else
		{
			$add = $this->addLop($id_khoi,$ten_lop,$id_gv);
			if($add)
				{
					$status = "Thêm thành công!";
					$view->statusSuccess($status);
				}
			else
			{
				$status = "Lỗi! Lớp đã tồn tại!";
				$view->statusFailed($status);
			}
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkDelLop()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_lop = Htmlspecialchars($_POST['id_lop']);
		$this->delLop($id_lop);
		$status = "Xóa thành công!";
		$view->statusSuccess($status);
		echo '<meta http-equiv="refresh" content="2" />'; 
	}
	public function checkEditLop()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_lop = Htmlspecialchars($_POST['id_lop']);
		$ten_lop = Htmlspecialchars(addslashes($_POST['ten_lop']));
		$id_khoi = Htmlspecialchars(addslashes($_POST['id_khoi']));
		$id_gv = Htmlspecialchars(addslashes($_POST['id_gv']));
		if(empty($ten_lop)||empty($id_khoi)||empty($id_gv))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->statusFailed($status);
		}
		else
		{
			$this->editLop($id_lop,$id_khoi,$ten_lop,$id_gv);
			$status = "Sửa thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
//hàm hiển thị bảng quán lý hoc sinh + bắt các sự kiện thêm, sửa xóa
	public function showQLHocSinh()
	{
		$dshs = $this->getDSHS();
		$dsl = $this->getDSL();
		for ($i = 0; $i < count($dshs); $i++)
			$tenlop[$i] = $this->getTenLop($dshs[$i]->id_lop);		
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showQLHocSinh($dshs,$dsl,$tenlop);
// thực hiện thêm học sinh với các thông tin nhập vào
		if(isset($_POST['add-hs']))
			$this->checkAddHS();
// thực hiện xóa 1 học sinh
		if(isset($_POST['del-hs']))
			$this->checkDelHS();
// thực hiện sửa thông tin học sinh, nếu thông tin hợp lệ thực hiện, sai báo ra màn hình
		if(isset($_POST['edit-hs']))
			$this->checkEditHS();
	}
	public function checkAddHS()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		$id_lop = Htmlspecialchars(addslashes($_POST['id_lop']));
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->statusFailed($status);
		}
		else
		{
			$add = $this->addHS($tai_khoan,$mat_khau,$ten,$id_lop);
			$this->addDiem($last_id,$id_lop);
			if($add)
				{
					$status = "Thêm thành công!";
					$view->statusSuccess($status);
				}
			else
			{
				$status = "Lỗi! Tài khoản đã tồn tại!";
				$view->statusFailed($status);
			}
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkEditHS()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_hs = Htmlspecialchars($_POST['id_hs']);
		$ten = Htmlspecialchars(addslashes($_POST['ten']));
		$tai_khoan = Htmlspecialchars(addslashes($_POST['tai_khoan']));
		$mat_khau = md5($_POST['mat_khau']);
		$id_lop = Htmlspecialchars(addslashes($_POST['id_lop']));
		if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
		{
			$status = "Không được bỏ trống các trưòng nhập";
			$view->statusFailed($status);
		}
		else
		{
			$this->editHS($id_hs,$tai_khoan,$mat_khau,$ten,$id_lop);
			$status = "Sửa thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkDelHS()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_hs = Htmlspecialchars($_POST['id_hs']);
		$id_lop = Htmlspecialchars($_POST['id_lop']);
		$this->delHS($id_hs,$id_lop);
		$status = "Xóa thành công!";
		$view->statusSuccess($status);
		echo '<meta http-equiv="refresh" content="2" />'; 
	}
//hàm hiển thị bảng quán lý cau hoi + bắt các sự kiện thêm, sửa xóa
	public function showQLCauHoi()
	{
		$dsch = $this->getDSCH();
		$dskhoi = $this->getKhoi();
		for ($i = 0; $i < count($dsch); $i++)
			$khoi[$i] = $this->getTenKhoi($dsch[$i]->id_khoi);
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showQLCauHoi($dsch,$dskhoi,$khoi);
	 // thực hiện thêm câu hỏi, nếu thông tin đúng thực hiện, sai báo ra màn hình
		if(isset($_POST['add-ch']))
			$this->checkAddCH();
// thực hiện xóa câu hỏi
		if(isset($_POST['del-ch']))
			$this->checkDelCH();
// thực hiện sửa câu hỏi, nếu thông tin đúng thực hiện, sai báo ra màn hình 
		if(isset($_POST['edit-ch']))
			$this->checkEditCH();
	}
	public function checkAddCH()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$cau_hoi = Htmlspecialchars(addslashes($_POST['cau_hoi']));
		$id_khoi = Htmlspecialchars(addslashes($_POST['id_khoi']));
		$unit = Htmlspecialchars(addslashes($_POST['unit']));
		$da_1 = Htmlspecialchars(addslashes($_POST['da_1']));
		$da_2 = Htmlspecialchars(addslashes($_POST['da_2']));
		$da_3 = Htmlspecialchars(addslashes($_POST['da_3']));
		$da_4 = Htmlspecialchars(addslashes($_POST['da_4']));
		$da_dung = Htmlspecialchars(addslashes($_POST['da_dung']));
		if(empty($cau_hoi)||empty($id_khoi)||empty($unit)||empty($da_1)||empty($da_2)||empty($da_3)||empty($da_4)||empty($da_dung))
		{
			$status = "Không được bỏ trống các trường nhập";
			$view->statusFailed($status);
		}
		else
		{
			$this->addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);     
			$status = "Thêm thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
	}
	public function checkDelCH()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_cauhoi = Htmlspecialchars($_POST['id_cauhoi']);
		$this->delCH($id_cauhoi);
		$status = "Xóa thành công!";
		$view->statusSuccess($status);
		echo '<meta http-equiv="refresh" content="2" />'; 
	}
	public function checkEditCH()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$id_cauhoi = Htmlspecialchars($_POST['id_cauhoi']);
		$cau_hoi = Htmlspecialchars(addslashes($_POST['cau_hoi']));
		$id_khoi = Htmlspecialchars(addslashes($_POST['id_khoi']));
		$unit = Htmlspecialchars(addslashes($_POST['unit']));
		$da_1 = Htmlspecialchars(addslashes($_POST['da_1']));
		$da_2 = Htmlspecialchars(addslashes($_POST['da_2']));
		$da_3 = Htmlspecialchars(addslashes($_POST['da_3']));
		$da_4 = Htmlspecialchars(addslashes($_POST['da_4']));
		$da_dung = addslashes($_POST['da_dung']);
		if(empty($cau_hoi)||empty($id_khoi)||empty($unit)||empty($da_1)||empty($da_2)||empty($da_3)||empty($da_4)||empty($da_dung))
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
		else
		{
			$this->editCH($id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
			$status = "Sửa thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		} 
	}
//hàm hiển thị bảng thong bao
	public function showSendNotify()
	{
		$tbgv = $this->getTBGV();
		$tbhs = $this->getTBHS();
		$this->loadView("admin");
		$view = new V_Admin();
		$view->showSendNotify($tbgv,$tbhs);
 //kiểm tra nội dung và chủ đè không bỏ trống, thực hiện thêm vào CSDL
		if(isset($_POST['send_gv']))
			$this->checkSendGV();
	//kiểm tra nội dung và chủ đè không bỏ trống, thực hiện thêm vào CSDL
		if(isset($_POST['send_hs']))
			$this->checkSendHS();
	}
	public function checkSendGV()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_gv'])));
		$noi_dung = Htmlspecialchars(trim(addslashes($_POST['noi_dung_gv'])));
		if($chu_de != '' && $noi_dung != '')
		{
			$this->sendGV($chu_de,$noi_dung);
			$status = "Gửi thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
		else
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
	}
	public function checkSendHS()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$chu_de = Htmlspecialchars(trim(addslashes($_POST['chu_de_hs'])));
		$noi_dung = Htmlspecialchars(trim(addslashes($_POST['noi_dung_hs'])));
		if($chu_de != '' && $noi_dung != '')
		{
		// $this->sendHS($chu_de,$noi_dung);
			$status = "Gửi thành công!";
			$view->statusSuccess($status);
			echo '<meta http-equiv="refresh" content="2" />';
		}
		else
		{
			$status = "Không được bỏ trống các trường nhập!";
			$view->statusFailed($status);
		}
	}
	public function show404()
	{
		$this->loadView("admin");
		$view = new V_Admin();
		$view->show404();
	}

}
?>