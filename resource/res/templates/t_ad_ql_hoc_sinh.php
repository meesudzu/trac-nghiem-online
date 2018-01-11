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
					for ($i = 0; $i < count($dshs); $i++) { ?>
					<tr>	
						<td class="col-lg-1"><?=$dshs[$i]->id_hs?></td>
						<!-- ID học sinh -->
						<td class="col-lg-2"><?=$dshs[$i]->tai_khoan?></td>
						<!-- tài khoản -->
						<td class="col-lg-2">******</td>
						<!-- mật khẩu không  hiện -->
						<td class="col-lg-3"><?=$dshs[$i]->ten?></td>
						<!-- tên -->
						<td class="col-lg-2"><?=$tenlop[$i]->ten_lop?></td>
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
													<!-- input hidden để gửi id_hs về cho controller -->
													<input type="hidden" value="<?=$dshs[$i]->id_hs?>" name="id_hs">    
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
												<button type="submit" class="btn btn-primary" name="edit-hs">Lưu</button>
											</div>
										</form>
									</div>
								</div>
							</div>
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
												<!-- input hidden để gửi id_hs về cho controller -->
												<input type="hidden" value="<?=$dshs[$i]->id_hs?>" name="id_hs">     
												<!-- input hidden để gửi id_lop về cho controller -->
												<input type="hidden" value="<?=$dshs[$i]->id_lop?>" name="id_lop">      
												<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
												<button type="submit" class="btn btn-danger" name="del-hs">Xóa</button>
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
			</div>
		</div>
	</div>
</div>
