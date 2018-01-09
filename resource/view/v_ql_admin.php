<?php


/**
 * View Quản lý admin
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
// tạo đối tượng admin với các thuộc tính nhận từ session
$index = new C_Admin($_SESSION['id_admin'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
?>
<div class="col-lg-7">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Quản Lý Thông Tin Admin</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-fixed">
					<thead>
						<tr>
							<th class="col-lg-1">ID</th>
							<th class="col-lg-3">Tài Khoản</th>
							<th class="col-lg-3">Mật Khẩu</th>
							<th class="col-lg-3">Tên</th>
							<th class="col-lg-2">chức năng</th>
						</tr>
					</thead>
					<tbody class="scrollbar">
						<?php
						// vòng lặp lấy danh sách admin
						$dsa = $index->getDSA();
						for ($i = 0; $i < count($dsa); $i++) { ?>
						<tr>	
							<td class="col-lg-1"><?=$dsa[$i]->id_admin?></td>
							<!-- ID Admin -->
							<td class="col-lg-3"><?=$dsa[$i]->tai_khoan?></td>
							<!-- Tài khoản admin -->
							<td class="col-lg-3">******</td>
							<!-- Mật khẩu không hiện-->
							<td class="col-lg-3"><?=$dsa[$i]->ten?></td>
							<!-- Tên Admin -->
							<td class="col-lg-2">
								<a class="btn btn-info" data-toggle="modal" href="#edit-<?=$dsa[$i]->id_admin?>">Sửa</a>
								<div class="modal fade" id="edit-<?=$dsa[$i]->id_admin?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Sửa Thông Tin Admin ID: <?=$dsa[$i]->id_admin?></h4>
											</div>
											<form action="" method="POST" role="form">
												<div class="modal-body">
													<div class="form-group">
														<label for="">Tên</label>
														<input type="text" class="form-control" name="ten" value="<?=$dsa[$i]->ten?>"></br >
														<label for="">Tài khoản</label>
														<input type="text" class="form-control" name="tai_khoan" value="<?=$dsa[$i]->tai_khoan?>"></br >
														<label for="">Mật khẩu</label>
														<input type="password" class="form-control" name="mat_khau" value="" placeholder="Nhập mật khẩu">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary" name="edit-<?=$dsa[$i]->id_admin?>">Lưu</button>
												</div>
											</form>											
										</div>
									</div>
								</div>

								<?php 
								// thực hiện sửa tài khoản admin sau khi nhấn nút lưu. Nếu thông tin đúng thực hiện, sai báo ra màn hình
								if(isset($_POST['edit-'.$dsa[$i]->id_admin.'']))
								{
									$ten = addslashes($_POST['ten']);
									$tai_khoan = addslashes($_POST['tai_khoan']);
									$mat_khau = md5($_POST['mat_khau']);
									if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
										echo '<script type="text/javascript">alert("không được bỏ trống các trường khi nhập");</script>';
									else
									{
										$index->editAdmin($dsa[$i]->id_admin,$tai_khoan,$mat_khau,$ten);
										echo '<meta http-equiv="refresh" content="0" />';
									}  
								}?>
								<a class="btn btn-danger" data-toggle="modal" href="#del-<?=$dsa[$i]->id_admin?>">xóa</a></td>
								<div class="modal fade" id="del-<?=$dsa[$i]->id_admin?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Cảnh Báo</h4>
											</div>
											<div class="modal-body">
												Xác nhận xóa tài khoản <?=$dsa[$i]->tai_khoan?>           
											</div>
											<form action="" method="POST" role="form">   
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
													<button type="submit" class="btn btn-danger" name="del-<?=$dsa[$i]->id_admin?>">Xóa</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<?php
								// thực hiện xóa tài khoản admin sau khi nhấn nút xóa. Nếu thông tin đúng thực hiện, sai báo ra màn hình
								if(isset($_POST['del-'.$dsa[$i]->id_admin.'']))
								{
									$index->delAdmin($dsa[$i]->id_admin);
									echo '<meta http-equiv="refresh" content="0" />'; 
								}?>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Kết thúc quản lý admin -->
<div class="col-lg-3">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Thêm Tài Khoản Admin</h3>
			</div>
			<div class="panel-body overflow">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<label for="">Tên</label>
						<input type="text" class="form-control" name="ten" placeholder="Nhập tên admin" onchange="check();"><br />
						<label for="">Tài khoản</label>
						<input type="text" class="form-control" name="tai_khoan" placeholder="Nhập tài khoản admin"><br />
						<label for="">Mật khẩu</label>
						<input type="password" data-minlength="6" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu admin"><br />
					</div>   
					<button type="submit" class="btn btn-primary btn-max" name="add-admin">Thêm</button>
				</form>
				<?php
				// thực hiện thêm tài khoản admin sau khi nhấn nút thêm. Nếu thông tin đúng thực hiện, sai báo ra màn hình
				if(isset($_POST['add-admin']))
				{
					$ten = addslashes($_POST['ten']);
					$tai_khoan = addslashes($_POST['tai_khoan']);
					$mat_khau = md5($_POST['mat_khau']);
					if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
						echo '<br /><div class="panel panel-warning">
					<div class="panel-heading">
					<h3 class="panel-title">Không được để trống các trường dữ liệu khi nhập</h3>
					</div></div>';
					else
					{
						$index->addAdmin($tai_khoan,$mat_khau,$ten);
						echo '<meta http-equiv="refresh" content="0" />';
					}
				}?>
			</div>
		</div>
	</div>
</div><!-- Kết thúc thêm tài khoản admin -->