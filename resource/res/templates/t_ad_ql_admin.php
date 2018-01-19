<div class="box-content right box-content-mini" id="box-content">
	<div class="title-content">
		<span class="title">Quản Lý Thông Tin Admin</span>
	</div>
	<div class="block-content overflow scrollbar">
		<div class="content fadeRight">
			<table class="trigger centered responsive-table">
				<thead>
					<tr>
						<th class="">ID</th>
						<th class="">Avatar</th>
						<th class="">Tên</th>
						<th class="">Tài Khoản</th>
						<th class="">Email</th>
						<th class="">Giới Tính</th>
						<th class="">Ngày Sinh</th>
						<th class="">Sử Dụng Lần Cuối</th>
						<th class=""></th>
					</tr>
				</thead>
				<tbody class="scrollbar">
					<?php
                    for ($i = 0; $i < count($list_admins); $i++) {
                        ?>
						<tr>
							<td class="">
								<?=$list_admins[$i]->admin_id?>
							</td>
							<td class=""><img src="../res/img/avatar/<?=$list_admins[$i]->avatar?>" alt="avatar" class="avatar" /></td>
							<td class="">
								<?=$list_admins[$i]->name?>
							</td>
							<td class="">
								<?=$list_admins[$i]->username?>
							</td>
							<td class="">
								<?=$list_admins[$i]->email?>
							</td>
							<td class="">
								<?=$list_admins[$i]->gender_id?>
							</td>
							<td class="">
								<?=$list_admins[$i]->birthday?>
							</td>
							<td class="">
								<?=$list_admins[$i]->last_login?>
							</td>
							<td class="">
								<!-- Modal Trigger -->
								<a class="waves-effect waves-light btn modal-trigger" href="#edit-<?=$list_admins[$i]->admin_id?>">Sửa</a>
								<!-- Modal Structure -->
								<div id="edit-<?=$list_admins[$i]->admin_id?>" class="modal modal-edit">
									<div class="modal-content">
										<h4>Sửa Thông Tin Admin ID: <?=$list_admins[$i]->admin_id?></h4>
										<form action="" method="POST" role="form">
											<div class="modal-body">
												<div class="form-group">
													<input type="hidden" value="<?=$list_admins[$i]->admin_id?>" name="admin_id">
													<label for="">Tên</label>
													<input type="text" class="form-control" name="name" value="<?=$list_admins[$i]->name?>"></br>
													<label for="">Tài khoản</label>
													<input type="text" class="form-control" name="username" value="<?=$list_admins[$i]->username?>" disabled></br>
													<label for="">Mật khẩu</label>
													<input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu">
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
									</div>
									</form>
								</div>
								<!-- Modal Trigger -->
								<a class="waves-effect waves-light btn modal-trigger" href="#del-<?=$list_admins[$i]->admin_id?>">Xóa</a>
								<!-- Modal Structure -->
								<div id="del-<?=$list_admins[$i]->admin_id?>" class="modal">
									<div class="modal-content">
										<h4>Cảnh Báo</h4>
										<p>Xác nhận xóa tài khoản
											<?=$list_admins[$i]->username?>
										</p>
									</div>
									<form action="" method="POST" role="form">
										<div class="modal-footer">
											<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Khong</a>
											<!-- input hidden để gửi admin_id về cho controller -->
											<input type="hidden" value="<?=$list_admins[$i]->admin_id?>" name="admin_id">
											<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Co</a>
										</div>
									</form>
								</div>
						</tr>
						<?php
                    } ?>
				</tbody>
			</table>
		</div>
		<div class="content fadeRight">
			<div class="row col l12">
				<form action="" method="POST" role="form">
					<div class="col l6 s12">
						<div class="input-field">
							<label for="name">Tên</label>
							<input type="text" id="name" name="name" onchange="check();">
						</div>
						<div class="input-field">
							<label for="username">Tài khoản</label>
							<input type="text" name="username" id="username">
						</div>
						<div class="input-field">
							<label for="password">Mật khẩu</label>
							<input type="password" data-minlength="6" name="password" id="password">
						</div>
					</div>
					<div class="col l6 s12">
						<div class="input-field">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" onchange="check();">
						</div>
						<div class="input-field">
							<input type="date" name="birthday" id="birthday">
						</div>
						<div class="input-field">
							<select name="gender">
									<option value="" disabled selected>Chọn</option>
									<option value="1">Không Xác Định</option>
									<option value="2">Nam</option>
									<option value="3">Nữ</option>
								</select>
							<label>Giới Tính</label>
						</div>
					</div>
					<div class="col l12">
						<button type="submit" class="btn btn-primary btn-max" name="add-admin">Thêm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>