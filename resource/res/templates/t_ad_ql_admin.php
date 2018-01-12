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
						for ($i = 0; $i < count($dsa); $i++) { ?>
						<tr>	
							<td class="col-lg-1"><?=$dsa[$i]->id_admin?></td>
							<td class="col-lg-3"><?=$dsa[$i]->tai_khoan?></td>
							<td class="col-lg-3">******</td>
							<td class="col-lg-3"><?=$dsa[$i]->ten?></td>
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
														<!-- input hidden để gửi id_admin về cho controller -->
														<input type="hidden" value="<?=$dsa[$i]->id_admin?>" name="id_admin">
														<label for="">Tên</label>
														<input type="text" class="form-control" name="ten" value="<?=$dsa[$i]->ten?>"></br >
														<label for="">Tài khoản</label>
														<input type="text" class="form-control" name="tai_khoan" value="<?=$dsa[$i]->tai_khoan?>" disabled></br >
														<label for="">Mật khẩu</label>
														<input type="password" class="form-control" name="mat_khau" value="" placeholder="Nhập mật khẩu">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary" name="edit-admin">Lưu</button>
												</div>
											</form>											
										</div>
									</div>
								</div>
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
													<!-- input hidden để gửi id_admin về cho controller -->
													<input type="hidden" value="<?=$dsa[$i]->id_admin?>" name="id_admin">                        
													<button type="submit" class="btn btn-danger" name="del-admin">Xóa</button>
												</div>
											</form>
										</div>
									</div>
								</div>
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
			</div>
		</div>
	</div>
</div><!-- Kết thúc thêm tài khoản admin -->