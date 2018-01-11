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
						for ($i = 0; $i < count($dsl); $i++) { 
							?>
							<tr>	
								<td class="col-lg-1"><?=$dsl[$i]->id_lop?></td>
								<!-- ID lớp -->
								<td class="col-lg-1"><?=$khoi[$i]->mo_ta?></td>
								<!-- tên khối -->
								<td class="col-lg-3"><?=$dsl[$i]->ten_lop?></td>
								<!-- tên lớp -->
								<td class="col-lg-4"><?=$gv[$i]->ten?></td>
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
													<!-- input hidden để gửi id_lop về cho controller -->
													<input type="hidden" value="<?=$dsl[$i]->id_lop?>" name="id_lop">
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
														<button type="submit" class="btn btn-primary" name="edit-lop">Lưu</button>
													</form>
												</div>
											</div>
										</div>
									</div>
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
														<!-- input hidden để gửi id_lop về cho controller -->
														<input type="hidden" value="<?=$dsl[$i]->id_lop?>" name="id_lop">
														<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
														<button type="submit" class="btn btn-danger" name="del-lop">Xóa</button>
													</div>
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
			</div>
		</div>
	</div>
</div>
