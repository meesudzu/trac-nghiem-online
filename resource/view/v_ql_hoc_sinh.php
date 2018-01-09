<?php


/**
 * View Quản lý học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
// tạo đối tượng $index với các thuộc tính nhận từ sesion
$index = new C_Admin($_SESSION['id_admin'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
?>
<div class="col-lg-7">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Quản Lý Thông Tin Học Sinh</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover table-fixed">
				<thead>
					<tr>
						<th class="col-lg-1">ID</th>
						<th class="col-lg-2">Tài Khoản</th>
						<th class="col-lg-2">Mật Khẩu</th>
						<th class="col-lg-3">Tên</th>
						<th class="col-lg-2">Lớp</th>
						<th class="col-lg-2">chức năng</th>
					</tr>
				</thead>
				<tbody class="scrollbar">
					<?php
						// load danh sách học sinh từ CSDL
					$dshs = $index->getDSHS();
						$dsl = $index->getDSL();//load danh sách lớp
						for ($i = 0; $i < count($dshs); $i++) { 
							$tenlop = $index->getTenLop($dshs[$i]->id_lop);//lấy tên lớp từ ID lớp
							$last_id = $dshs[$i]->id_hs+1;//lấy ID học sinh cuối cùng ?>
							<tr>	
								<td class="col-lg-1"><?=$dshs[$i]->id_hs?></td>
								<!-- ID học sinh -->
								<td class="col-lg-2"><?=$dshs[$i]->tai_khoan?></td>
								<!-- tài khoản -->
								<td class="col-lg-2">******</td>
								<!-- mật khẩu không  hiện -->
								<td class="col-lg-3"><?=$dshs[$i]->ten?></td>
								<!-- tên -->
								<td class="col-lg-2"><?=$tenlop->ten_lop?></td>
								<!-- thuộc lớp -->
								<td class="col-lg-2">
									<a class="btn btn-info" data-toggle="modal" href="#edit-<?=$dshs[$i]->id_hs?>">Sửa</a>
									<div class="modal fade" id="edit-<?=$dshs[$i]->id_hs?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Sửa Thông Tin Học Sinh ID: <?=$dshs[$i]->id_hs?></h4>
												</div>
												<form action="" method="POST" role="form">
													<div class="modal-body">
														<div class="form-group">
															<label for="">Tên</label>
															<input type="text" class="form-control" name="ten" value="<?=$dshs[$i]->ten?>"></br >
															<label for="">Tài khoản</label>
															<input type="text" class="form-control" name="tai_khoan" value="<?=$dshs[$i]->tai_khoan?>"></br >
															<label for="">Mật khẩu</label>
															<input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu"></br >
															<label for="">Lớp</label>
															<select name="id_lop" id="inputid_lop" class="form-control" required="required">
																<?php
																// vòng lặp load danh sách lớp cho option của thẻ select
																for ($j = 0; $j < count($dsl); $j++) {
																	?>
																	<option value="<?=$dsl[$j]->id_lop?>"><?=$dsl[$j]->ten_lop?></option>
																	<?php 
																}
																?>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
														<button type="submit" class="btn btn-primary" name="edit-<?=$dshs[$i]->id_hs?>">Lưu</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<?php 
									// thực hiện sửa thông tin học sinh, nếu thông tin hợp lệ thực hiện, sai báo ra màn hình
									if(isset($_POST['edit-'.$dshs[$i]->id_hs.'']))
									{
										$ten = addslashes($_POST['ten']);
										$tai_khoan = addslashes($_POST['tai_khoan']);
										$mat_khau = md5($_POST['mat_khau']);
										$id_lop = addslashes($_POST['id_lop']);
										if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
											echo '<script type="text/javascript">alert("không được bỏ trống các trường khi nhập");</script>';
										else
										{
											$index->editHS($dshs[$i]->id_hs,$tai_khoan,$mat_khau,$ten,$id_lop);
											echo '<meta http-equiv="refresh" content="0" />';
										}  
									}
									?>
									<a class="btn btn-danger" data-toggle="modal" href="#del-<?=$dshs[$i]->id_hs?>">xóa</a></td>

									<div class="modal fade" id="del-<?=$dshs[$i]->id_hs?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Cảnh Báo</h4>
												</div>
												<div class="modal-body">
													Xác nhận xóa tài khoản <?=$dshs[$i]->tai_khoan?>           
												</div>
												<form action="" method="POST" role="form">   
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
														<button type="submit" class="btn btn-danger" name="del-<?=$dshs[$i]->id_hs?>">Xóa</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php 
									// thực hiện xóa 1 học sinh
									if(isset($_POST['del-'.$dshs[$i]->id_hs.'']))
									{
										$index->delHS($dshs[$i]->id_hs,$dshs[$i]->id_lop);
										echo '<meta http-equiv="refresh" content="0" />'; 
									}
									?>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="alert">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Thêm Tài Khoản Học Sinh</h3>
					</div>
					<div class="panel-body overflow">
						<form action="" method="POST" role="form">
							<div class="form-group">
								<label for="">Tên</label>
								<input type="text" class="form-control" name="ten" placeholder="Nhập tên học sinh" onchange="check();"></br >
								<label for="">Tài khoản</label>
								<input type="text" class="form-control" name="tai_khoan" placeholder="Nhập tài khoản học sinh"></br >
								<label for="">Mật khẩu</label>
								<input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu học sinh"></br >
								<label for="">Lớp</label>
								<select name="id_lop" id="inputid_lop" class="form-control" required="required">
									<?php
								// vòng lặp load danh sách lớp cho option của thẻ select
									for ($j = 0; $j < count($dsl); $j++) {
										?>
										<option value="<?=$dsl[$j]->id_lop?>"><?=$dsl[$j]->ten_lop?></option>
										<?php 
									}
									?>
								</select></br >
							</div>   
							<button type="submit" class="btn btn-primary btn-max" name="add-hs">Thêm</button>
						</form>
						<?php
					// thực hiện thêm học sinh với các thông tin nhập vào
						if(isset($_POST['add-hs']))
						{
							$ten = addslashes($_POST['ten']);
							$tai_khoan = addslashes($_POST['tai_khoan']);
							$mat_khau = md5($_POST['mat_khau']);
							$id_lop = addslashes($_POST['id_lop']);
							if(empty($ten)||empty($tai_khoan)||empty($mat_khau))
								echo '<br /><div class="panel panel-warning">
							<div class="panel-heading">
							<h3 class="panel-title">Không được để trống các trường dữ liệu khi nhập</h3>
							</div></div>';
							else
							{
								$index->addHS($tai_khoan,$mat_khau,$ten,$id_lop);
								$index->addDiem($last_id,$id_lop);
								echo '<meta http-equiv="refresh" content="0" />';
							}
						}

						?>
					</div>
				</div>
			</div>
		</div>
