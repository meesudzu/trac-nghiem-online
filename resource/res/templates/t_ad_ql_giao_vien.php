<!-- View Quản lý gíao viên -->
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
						for ($i = 0; $i < count($dsgv); $i++) { ?>
						<tr>	
							<td class="col-lg-1"><?=$dsgv[$i]->id_gv?></td>
							<td class="col-lg-3"><?=$dsgv[$i]->tai_khoan?></td>
							<td class="col-lg-3">******</td>
							<td class="col-lg-3"><?=$dsgv[$i]->ten?></td>
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
														<!-- input hidden để gửi id_gv về cho controller -->
														<input type="hidden" value="<?=$dsgv[$i]->id_gv?>" name="id_gv">      
														<label for="">Tên</label>
														<input type="text" class="form-control" name="ten" value="<?=$dsgv[$i]->ten?>"></br >
														<label for="">Tài khoản</label>
														<input type="text" class="form-control" name="tai_khoan" value="<?=$dsgv[$i]->tai_khoan?>" disabled></br >
														<label for="">Mật khẩu</label>
														<input type="password" class="form-control" name="mat_khau" placeholder="Nhập mật khẩu">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary" name="edit-gv">Lưu</button>
												</form>
											</div>
										</div>
									</div>
								</div>
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
													<!-- input hidden để gửi id_gv về cho controller -->
													<input type="hidden" value="<?=$dsgv[$i]->id_gv?>" name="id_gv">      
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
													<button type="submit" class="btn btn-danger" name="del-gv">Xóa</button>
												</form>
											</div>
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
<!-- kết thúc quản lý gíao viên -->
<!-- vview thêm tài khoản gíao viên -->
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
			</div>
		</div>
	</div>
</div>
<!-- kết thúc thêm tài khoản gíao viên -->