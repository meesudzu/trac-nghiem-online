<?php

/**
 * View giáo viên xem chi tiết lớp
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng index với các thuộc tính từ session
$index = new C_Giao_Vien($_SESSION['id_gv'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);

$id_lop = (int)$_GET['id_lop'];//lấy ID lớp từ url
$getCTL = $index->getCTL($id_lop);//load thông tin chi tiết học sinh trong lớp từ id lớp
$id_lop -= 1;//vì mảng bắt đầu từ 0 nên phải giảm giá trị xuống 1 ***
$tsl = count($index->dsl);//lấy tổng số lớp giáo viên này đang quản lý
?>
<?php
// kiểm tra lớp có tồn tại không
if($id_lop<$tsl&&$id_lop>=0)
{
	$ten_lop = $index->dsl[$id_lop]->ten_lop;//lấy tên lớp từ mảng chứa danh sách lớp ***
	?>
	<div class="col-lg-10">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Chi Tiết Lớp <?=$ten_lop?> - Tổng Số <?=count($getCTL)?> </h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-ctl">
					<thead>
						<tr>
							<th class="col-xs-1">Tài Khoản</th>
							<th class="col-xs-3">Tên</th>
							<th class="col-xs-2">Điểm 1</th>
							<th class="col-xs-2">Điểm 2</th>
							<th class="col-xs-2">Điểm 3</th>
							<th class="col-xs-2">Điểm 4</th>
						</tr>
					</thead>
					<tbody class="scrollbar">
						<?php

					 		//load danh sách học sinh từng học sinh của lớp 
						for ($j = 0; $j < count($getCTL); $j++) 
						{ 
							?>
							<tr>
								<td class="col-lg-1"><?=$getCTL[$j]->id_hs?></td>
								<!-- ID của học sinh -->
								<?php $id_hs = $getCTL[$j]->id_hs; ?>
								<td class="col-xs-3"><?=$index->getTHS($id_hs)->ten?></td>
								<!-- lấy tên học sinh từ ID học sinh -->
								<td class="col-xs-2"><?=$getCTL[$j]->unit_1?></td>
								<td class="col-xs-2"><?=$getCTL[$j]->unit_2?></td>
								<td class="col-xs-2"><?=$getCTL[$j]->unit_3?></td>
								<td class="col-xs-2"><?=$getCTL[$j]->unit_4?></td>
								<!-- Điểm các bài kiểm tra 1,2,3,4 -->
							</tr>
							<div class="clearfix">

							</div>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>	
		</div>
	</div><!-- Kết thúc xem chi tiết lớp-->
	<?php
}
else 
	{?>
		<div class="col-lg-10">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">Lỗi </h3>
				</div>
				<div class="panel-body overflow-gv">
					Lớp không tồn tại hoặc đã bị xóa, vui lòng kiểm tra lại hoặc liên hệ Quản trị viên.<br /><br />
					<a href="?"><button type="button" class="btn btn-info">Quay Lại</button></a>
				</div>	
			</div>
		</div><!-- Kết thúc xem chi tiết lớp-->

		<?php
	}
	?>