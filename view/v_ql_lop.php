<?php

/**
 * View Quản lý lớp
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng $index với các thuộc tính nhận từ session
$index = new C_Admin($_SESSION['id_admin'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
?>
<div class="col-lg-7">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Quản Lý Thông Tin Lớp</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-fixed">
					<thead>
						<tr>
							<th class="col-lg-1">ID</th>
							<th class="col-lg-1">Khối</th>
							<th class="col-lg-3">Tên lớp</th>
							<th class="col-lg-4">GV Quản Lý</th>
							<th class="col-lg-3">chức năng</th>
						</tr>
					</thead>
					<tbody class="scrollbar">
						<?php
						// thực hiện load danh sách lớp từ CSDL
						$dsl = $index->getDSL();
						for ($i = 0; $i < count($dsl); $i++) { 
							$khoi = $index->getTenKhoi($dsl[$i]->id_khoi);//lấy tên khối từ ID khối
							$dskhoi = $index->getKhoi();//load danh sách khối
							$gv = $index->getTenGV($dsl[$i]->id_gv);//lấy têng giáo viên từ ID giáo viên
							$dsgv = $index->getDSGV();//load danh sách giáo viên
							?>
							<tr>	
								<td class="col-lg-1"><?=$dsl[$i]->id_lop?></td>
								<!-- ID lớp -->
								<td class="col-lg-1"><?=$khoi->mo_ta?></td>
								<!-- tên khối -->
								<td class="col-lg-3"><?=$dsl[$i]->ten_lop?></td>
								<!-- tên lớp -->
								<td class="col-lg-4"><?=$gv->ten?></td>
								<!-- tên giáo viên quản lý -->
								<td class="col-lg-3">
									<a class="btn btn-info" data-toggle="modal" href="#edit-<?=$dsl[$i]->id_lop?>">Sửa</a>
									<div class="modal fade" id="edit-<?=$dsl[$i]->id_lop?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Sửa Thông Tin Lớp ID: <?=$dsl[$i]->id_lop?></h4>
												</div>
												<div class="modal-body">
													<form action="" method="POST" role="form">
														<div class="form-group">
															<label for="">Tên Lớp</label>
															<input type="text" class="form-control" name="ten_lop" value="<?=$dsl[$i]->ten_lop?>"></br >
															<label for="">Khối</label>
															<select name="id_khoi" id="inputKhoi" class="form-control" required="required">
																<?php
																// vòng lặp load danh sách khối cho các option của thẻ select
																for ($k = 0; $k < count($dskhoi); $k++) {
																	?>
																	<option value="<?=$dskhoi[$k]->id_khoi?>"><?=$dskhoi[$k]->mo_ta?></option>
																	<?php 
																}
																?>
															</select><br />
															<label for="">ID Giáo Viên Quản Lý</label>
															<select name="id_gv" id="inputTrinh_do" class="form-control" required="required">
																<?php
																// vòng lặp load danh sách giáo viên cho các option của thẻ select
																for ($j = 0; $j < count($dsgv); $j++) {
																	?>
																	<option value="<?=$dsgv[$j]->id_gv?>"><?=$dsgv[$j]->ten?></option>
																	<?php 
																}
																?>
															</select>	
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
														<button type="submit" class="btn btn-primary" name="edit-<?=$dsl[$i]->id_lop?>">Lưu</button>
													</form>
												</div>
											</div>
										</div>
									</div>

									<?php 
									// thực hiện sửa thông tin lớp với các thông tin nhập vào, sai báo ra màn hình
									if(isset($_POST['edit-'.$dsl[$i]->id_lop.'']))
									{
										$ten_lop = addslashes($_POST['ten_lop']);
										$id_khoi = addslashes($_POST['id_khoi']);
										$id_gv = addslashes($_POST['id_gv']);
										if(empty($ten_lop)||empty($id_khoi)||empty($id_gv))
											echo '<script type="text/javascript">alert("không được bỏ trống các trường khi nhập");</script>';
										else
										{
											$index->editLop($dsl[$i]->id_lop,$id_khoi,$ten_lop,$id_gv);
											echo '<meta http-equiv="refresh" content="0" />';
										}  
									}
									?>
									<a class="btn btn-danger" data-toggle="modal" href="#del-<?=$dsl[$i]->id_lop?>">xóa</a></td>

									<div class="modal fade" id="del-<?=$dsl[$i]->id_lop?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Cảnh Báo</h4>
												</div>
												<div class="modal-body">
													Xác nhận xóa lớp <?=$dsl[$i]->ten_lop?>           
												</div>
												<form action="" method="POST" role="form">   
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
														<button type="submit" class="btn btn-danger" name="del-<?=$dsl[$i]->id_lop?>">Xóa</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
								// thực hiện xóa 1 lớp
								if(isset($_POST['del-'.$dsl[$i]->id_lop.'']))
								{
									$index->delLop($dsl[$i]->id_lop);
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
</div>
<div class="col-lg-3">
	<div class="alert">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Thêm Lớp</h3>
			</div>
			<div class="panel-body overflow">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<label for="">Tên Lớp</label>
						<input type="text" class="form-control" name="ten_lop" value="" placeholder="Nhập tên lớp"></br >
						<label for="">Khối</label>
						<select name="id_khoi" id="inputKhoi" class="form-control" required="required">
							<?php
							// vòng lặp load danh sách khối cho các option của thẻ select
							for ($k = 0; $k < count($dskhoi); $k++) {
								?>
								<option value="<?=$dskhoi[$k]->id_khoi?>"><?=$dskhoi[$k]->mo_ta?></option>
								<?php 
							}
							?>
						</select><br />
						<label for="">ID Giáo Viên Quản Lý</label>
						<select name="id_gv" id="inputTrinh_do" class="form-control" required="required">
							<?php
							// vòng lặp load danh sách giáo viên cho các option của thẻ select
							for ($j = 0; $j < count($dsgv); $j++) {
								?>
								<option value="<?=$dsgv[$j]->id_gv?>"><?=$dsgv[$j]->ten?></option>
								<?php 
							}
							?>
						</select><br />
					</div>   
					<button type="submit" class="btn btn-primary btn-max" name="add-lop">Thêm</button>
				</form>
				<?php
				// thực hiện thêm 1 lớp với các thông tin nhập vào, sai báo ra màn hình
				if(isset($_POST['add-lop']))
				{
					$ten_lop = addslashes($_POST['ten_lop']);
					$id_khoi = addslashes($_POST['id_khoi']);
					$id_gv = addslashes($_POST['id_gv']);
					if(empty($ten_lop)||empty($id_khoi)||empty($id_gv))
						echo '<br /><div class="panel panel-warning">
					<div class="panel-heading">
					<h3 class="panel-title">Không được để trống các trường dữ liệu khi nhập</h3>
					</div></div>';
					else
					{
						$index->addLop($id_khoi,$ten_lop,$id_gv);
						echo '<meta http-equiv="refresh" content="0" />';
					}
				}

				?>
			</div>
		</div>
	</div>
</div>
