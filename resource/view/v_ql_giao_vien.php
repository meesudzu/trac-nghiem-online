<?php

/**
 * View Quản lý giáo viên
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
// tạo đối tượng $index với thuộc tính nhận từ session
$index = new C_Admin($_SESSION['id_admin'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
?>
<div class="col-lg-7">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Quản Lý Thông Tin Giáo Viên</h3>
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
						// thực hiện load danh sách giáo viên
						$dsgv = $index->getDSGV();
						for ($i = 0; $i < count($dsgv); $i++) { ?>
						<tr>	
							<td class="col-lg-1"><?=$dsgv[$i]->id_gv?></td>
							<!-- ID giáo viên -->
							<td class="col-lg-3"><?=$dsgv[$i]->tai_khoan?></td>
							<!-- tài khoản -->
							<td class="col-lg-3">******</td>
							<!-- mật khẩu không hiện-->
							<td class="col-lg-3"><?=$dsgv[$i]->ten?></td>
							<!-- tên -->
							<td class="col-lg-2">
								<a class="btn btn-info" data-toggle="modal" href="#edit-<?=$dsgv[$i]->id_gv?>">Sửa</a>
								<div class="modal fade" id="edit-<?=$dsgv[$i]->id_gv?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Sửa Thông Tin Giáo Viên ID: <?=$dsgv[$i]->id_gv?></h4>
											</div>
											<div class="modal-body">
												<form action="" method="POST" role="form">
													<div class="form-group">
														<label for="">Tên</label>
														<input type="text" class="form-control" name="ten" value="<?=$dsgv[$i]->ten?>"></br >
														<label for="">Tài khoản</label>
														<input type="text" class="form-control" name="tai_khoan" value="<?=$dsgv[$i]->tai_khoan?>"></br >
														<label for="">Mật khẩu</label>
														<input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary" name="edit-<?=$dsgv[$i]->id_gv?>">Lưu</button>
												</form>
											</div>
										</div>
									</div>
								</div>

								<?php 
								// thực hiện sửa giáo viên, nếu thông tin hợp lệ thì thực hiện, sai báo ra màn hình
								if(isset($_POST['edit-'.$dsgv[$i]->id_gv.'']))
								{
									$ten = addslashes($_POST['ten']);
									$tai_khoan = addslashes($_POST['tai_khoan']);
									$mat_khau = md5($_POST['mat_khau']);
									if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
										echo '<script type="text/javascript">alert("không được bỏ trống các trường khi nhập");</script>';
									else
									{
										$index->editGV($dsgv[$i]->id_gv,$tai_khoan,$mat_khau,$ten);
										echo '<meta http-equiv="refresh" content="0" />';
									}  
								}?>
								<a class="btn btn-danger" data-toggle="modal" href="#del-<?=$dsgv[$i]->id_gv?>">xóa</a></td>

								<div class="modal fade" id="del-<?=$dsgv[$i]->id_gv?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Cảnh Báo</h4>
											</div>
											<div class="modal-body">
												Xác nhận xóa tài khoản <?=$dsgv[$i]->tai_khoan?>           
											</div>
											<form action="" method="POST" role="form">   
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
													<button type="submit" class="btn btn-danger" name="del-<?=$dsgv[$i]->id_gv?>">Xóa</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
								// thực hiện xóa giáo viên
								if(isset($_POST['del-'.$dsgv[$i]->id_gv.'']))
								{
									$index->delGV($dsgv[$i]->id_gv);
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
<div class="col-lg-3">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Thêm Tài Khoản Giáo Viên</h3>
			</div>
			<div class="panel-body overflow">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<label for="">Tên</label>
						<input type="text" class="form-control" name="ten" placeholder="Nhập tên giáo viên" onchange="check();"><br />
						<label for="">Tài khoản</label>
						<input type="text" class="form-control" name="tai_khoan" placeholder="Nhập tài khoản giáo viên"><br />
						<label for="">Mật khẩu</label>
						<input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu giáo viên"><br />
					</div>   
					<button type="submit" class="btn btn-primary btn-max" name="add-gv">Thêm</button>
				</form>
				<?php
				// thực hiện thêm giáo viên, nếu thông tin hợp lệ thì thực hiện, sai báo ra màn hình
				if(isset($_POST['add-gv']))
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
						$index->addGV($tai_khoan,$mat_khau,$ten);
						echo '<meta http-equiv="refresh" content="0" />';
					}
				}?>
			</div>
		</div>
	</div>
</div>
