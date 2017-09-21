<?php


/**
 * View quản lý câu hỏi
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng $index với các thuộc tính nhận từ session
$index = new C_Admin($_SESSION['id_admin'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
?>
<div class="col-lg-10">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Quản Lý Danh Sách Câu Hỏi</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover table-fixed">
				<thead>
					<tr>
						<th class="col-lg-1">ID</th>
						<th class="col-lg-1">Khối</th>
						<th class="col-lg-1">Chương</th>
						<th class="col-lg-2">Câu Hỏi</th>
						<th class="col-lg-1">A</th>
						<th class="col-lg-1">B</th>
						<th class="col-lg-1">C</th>
						<th class="col-lg-1">D</th>
						<th class="col-lg-1">Đúng</th>
						<th class="col-lg-2">chức năng</th>
					</tr>
				</thead>
				<tbody class="scrollbar">
					<?php
					// load danh sách câu hỏi từ CSDL
					$dsch = $index->getDSCH();
					for ($i = 0; $i < count($dsch); $i++) { 
						$khoi = $index->getTenKhoi($dsch[$i]->id_khoi);//lấy tên khối từ ID khối
						$dskhoi = $index->getKhoi();//load danh sách khối từ CSDL
						?>
						<tr>	
							<td class="col-lg-1"><?=$dsch[$i]->id_cauhoi?></td>
							<!-- ID câu hỏi -->
							<td class="col-lg-1"><?=$khoi->mo_ta?></td>
							<!-- Tên khối -->
							<td class="col-lg-1"><?=$dsch[$i]->unit?></td>
							<!-- Câu hỏi thuộc chương -->
							<td class="col-lg-2"><?=$dsch[$i]->cau_hoi?></td>
							<!-- nội dung câu hỏi -->
							<td class="col-lg-1"><?=$dsch[$i]->da_1?></td>
							<td class="col-lg-1"><?=$dsch[$i]->da_2?></td>
							<td class="col-lg-1"><?=$dsch[$i]->da_3?></td>
							<td class="col-lg-1"><?=$dsch[$i]->da_4?></td>
							<td class="col-lg-1"><?=$dsch[$i]->da_dung?></td>
							<!-- đáp án 1,2,3,4, đúng -->
							<td class="col-lg-2">
								<a class="btn btn-info" data-toggle="modal" href="#edit-<?=$dsch[$i]->id_cauhoi?>">Sửa</a>
								<div class="modal fade" id="edit-<?=$dsch[$i]->id_cauhoi?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Sửa Câu Hỏi ID: <?=$dsch[$i]->id_cauhoi?></h4>
											</div>
											<div class="modal-body">
												<form action="" method="POST" role="form">
													<label for="">Câu Hỏi</label>
													<textarea name="cau_hoi" rows="3" class="form-control"><?=$dsch[$i]->cau_hoi?></textarea></br >
													<label for="">Khối</label>
													<select name="id_khoi" id="inputKhoi" class="form-control" required="required">
														<?php
														// vòng lặp load danh sách khối cho option của thẻ select
														for ($k = 0; $k < count($dskhoi); $k++) {
															?>
															<option value="<?=$dskhoi[$k]->id_khoi?>"><?=$dskhoi[$k]->mo_ta?></option>
															<?php 
														}
														?>
													</select></br >
													<label for="">Chương</label>
													<input type="number" class="form-control" name="unit" value="<?=$dsch[$i]->unit?>"></br >
													<label for="">Đáp Án A</label>
													<input type="text" class="form-control" name="da_1" value="<?=$dsch[$i]->da_1?>"><br />
													<label for="">Đáp Án B</label>
													<input type="text" class="form-control" name="da_2" value="<?=$dsch[$i]->da_2?>"><br />
													<label for="">Đáp Án C</label>
													<input type="text" class="form-control" name="da_3" value="<?=$dsch[$i]->da_3?>"><br />
													<label for="">Đáp Án D</label>
													<input type="text" class="form-control" name="da_4" value="<?=$dsch[$i]->da_4?>"><br />
													<label for="">Đáp Án Đúng</label>
													<input type="text" class="form-control" name="da_dung" value="<?=$dsch[$i]->da_dung?>">	
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
													<button type="submit" class="btn btn-primary" name="edit-<?=$dsch[$i]->id_cauhoi?>">Lưu</button>
												</form>
											</div>
										</div>
									</div>
								</div>

								<?php
								// thực hiện sửa câu hỏi, nếu thông tin đúng thực hiện, sai báo ra màn hình 
								if(isset($_POST['edit-'.$dsch[$i]->id_cauhoi.'']))
								{
									$cau_hoi = addslashes($_POST['cau_hoi']);
									$id_khoi = addslashes($_POST['id_khoi']);
									$unit = addslashes($_POST['unit']);
									$da_1 = addslashes($_POST['da_1']);
									$da_2 = addslashes($_POST['da_2']);
									$da_3 = addslashes($_POST['da_3']);
									$da_4 = addslashes($_POST['da_4']);
									$da_dung = addslashes($_POST['da_dung']);
									if(empty($cau_hoi)||empty($id_khoi)||empty($unit)||empty($da_1)||empty($da_2)||empty($da_3)||empty($da_4)||empty($da_dung))
										echo '<script type="text/javascript">alert("không được bỏ trống các trường khi nhập");</script>';
									else
									{
										$index->editCH($dsch[$i]->id_cauhoi,$cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
										echo '<meta http-equiv="refresh" content="0" />';
									} 
								}
								?>
								<a class="btn btn-danger" data-toggle="modal" href="#del-<?=$dsch[$i]->id_cauhoi?>">xóa</a></td>

								<div class="modal fade" id="del-<?=$dsch[$i]->id_cauhoi?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Cảnh Báo</h4>
											</div>
											<div class="modal-body">
												Xác nhận xóa câu hỏi <?=$dsch[$i]->cau_hoi?>           
											</div>
											<form action="" method="POST" role="form">   
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>                         
													<button type="submit" class="btn btn-danger" name="del-<?=$dsch[$i]->id_cauhoi?>">Xóa</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<?php 
							// thực hiện xóa câu hỏi
							if(isset($_POST['del-'.$dsch[$i]->id_cauhoi.'']))
							{
								$index->delCH($dsch[$i]->id_cauhoi);
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
<div class="col-lg-12">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Thêm Câu Hỏi</h3>
		</div>
		<div class="panel-body">
			<form action="" method="POST" role="form">
				<div class="form-group">
					<div class="col-lg-4 col-sm-4 col-md-4 col-lg-4">
						<label for="">Câu Hỏi</label>
						<textarea name="cau_hoi" class="form-control" rows="5"></textarea></br >
						<label for="">Khối</label>
						<select name="id_khoi" id="inputKhoi" class="form-control" required="required">
							<?php
							// vòng lặp load danh sách khối cho option của thẻ select
							for ($k = 0; $k < count($dskhoi); $k++) {
								?>
								<option value="<?=$dskhoi[$k]->id_khoi?>"><?=$dskhoi[$k]->mo_ta?></option>
								<?php 
							}
							?>
						</select></br >
					</div>
					<div class="col-lg-4 col-sm-4 col-md-4 col-lg-4">
						<label for="">Chương</label>
						<input type="number" class="form-control" name="unit" placeholder="Câu hỏi thuộc chương"></br >
						<label for="">Đ.Án Đúng</label>
						<input type="text" class="form-control" name="da_dung" placeholder="Đáp án đúng"></br >
						<label for="">Đáp Án A</label>
						<input type="text" class="form-control" name="da_1" placeholder="Đáp án A"><br />
					</div>
					<div class="col-lg-4 col-sm-4 col-md-4 col-lg-4">
						<label for="">Đáp Án B</label>
						<input type="text" class="form-control" name="da_2" placeholder="Đáp án B"><br />
						<label for="">Đáp Án C</label>
						<input type="text" class="form-control" name="da_3" placeholder="Đáp án C"><br />
						<label for="">Đáp Án D</label>
						<input type="text" class="form-control" name="da_4" placeholder="Đáp án D"><br />
					</div>
					<button type="submit" class="btn btn-max btn-primary" name="add-ch">Thêm</button>   
				</div>
			</form>
			<?php
			// thực hiện thêm câu hỏi, nếu thông tin đúng thực hiện, sai báo ra màn hình
			if(isset($_POST['add-ch']))
			{
				$cau_hoi = addslashes($_POST['cau_hoi']);
				$id_khoi = addslashes($_POST['id_khoi']);
				$unit = addslashes($_POST['unit']);
				$da_1 = addslashes($_POST['da_1']);
				$da_2 = addslashes($_POST['da_2']);
				$da_3 = addslashes($_POST['da_3']);
				$da_4 = addslashes($_POST['da_4']);
				$da_dung = $_POST['da_dung'];
				if(empty($cau_hoi)||empty($id_khoi)||empty($unit)||empty($da_1)||empty($da_2)||empty($da_3)||empty($da_4)||empty($da_dung))
					echo '<br /><div class="panel panel-warning">
					<div class="panel-heading">
					<h3 class="panel-title">Không được để trống các trường dữ liệu khi nhập</h3>
					</div></div>';
				else
				{
					$index->addCH($cau_hoi,$id_khoi,$unit,$da_1,$da_2,$da_3,$da_4,$da_dung);
					echo '<meta http-equiv="refresh" content="0" />';
				}
			}
			?>
		</div>
	</div>
</div>
