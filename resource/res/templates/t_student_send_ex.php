<?php
// kiểm tra ngăn ngừa reload nhiều lần hoặc cố ý reload GET url
$diem = 0;
if(isset($unit))
{
	?>
	<div class="col-lg-7">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Kết Quả Bài Làm</h3>
			</div>
			<div class="panel-body" id="ket_qua">
				<span class="ket_qua">Chương: <?=$unit?></span><br />
				<span class="ket_qua">Tổng Số Câu Hỏi: <?=$ts_ch?></span>
				<div class="overflow-kq scrollbar">
					<?php 
					for ($i = 0; $i < $ts_ch; $i++) { ?>
					<div class="panel panel-default rlambai">
						<div class="panel-body lambai">

							<h3 class="panel-title">
								Câu <?=$i+1?> - #<?=$cau_hoi[$i]->id_cauhoi?> :   <?=$cau_hoi[$i]->cau_hoi?>
								<!-- $cau_hoi[$i]->id_cauhoi hiển thị id câu hỏi thứ i -->
								<!-- $cau_hoi[$i]->cau_hoi hiển thị nội dung câu hỏi thứ i -->
							</h3>
							<ul>
								<?php
							// kiểm tra đáp án, nếu đúng + điểm
								if($da_cauhoi[$i]==$cau_hoi[$i]->da_dung)
									$diem++;
								?>
								<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
								if($da_cauhoi[$i]==$cau_hoi[$i]->da_1)
									echo '<li><input type="radio" checked="checked">
								<label>'.$cau_hoi[$i]->da_1.'</label></li>';
								else
									echo '<li><input type="radio" disabled="disabled">
								<label>'.$cau_hoi[$i]->da_1.'</label></li>';
								?>
								<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
								if($da_cauhoi[$i]==$cau_hoi[$i]->da_2)
									echo '<li><input type="radio" checked="checked">
								<label>'.$cau_hoi[$i]->da_2.'</label></li>';
								else
									echo '<li><input type="radio" disabled="disabled">
								<label>'.$cau_hoi[$i]->da_2.'</label></li>';
								?>
								<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
								if($da_cauhoi[$i]==$cau_hoi[$i]->da_3)
									echo '<li><input type="radio" checked="checked">
								<label>'.$cau_hoi[$i]->da_3.'</label></li>';
								else
									echo '<li><input type="radio" disabled="disabled">
								<label>'.$cau_hoi[$i]->da_3.'</label></li>';
								?>
								<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
								if($da_cauhoi[$i]==$cau_hoi[$i]->da_4)
									echo '<li><input type="radio" checked="checked">
								<label>'.$cau_hoi[$i]->da_4.'</label></li>';
								else
									echo '<li><input type="radio" disabled="disabled">
								<label>'.$cau_hoi[$i]->da_4.'</label></li>';
								?>
							</ul>
						</div>
						<span class="dap_an">Đáp án: <span class="da_dung"><?=$cau_hoi[$i]->da_dung?></span></span>
					</div>
					<?php }
					?>
				</div>
				<span class="ket_qua">Điểm: <span class="diem"><?=$diem?></span></span>
				<a href="?"><button class="btn btn-success" style="float: right;">Xác nhận</button></a>
			</div>	
		</div>
	</div><!-- Kết thúc trả về kết quả bài làm lớp -->
	<?php
}
else
{
	?>
	<div class="col-lg-7">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Lỗi!</h3>
			</div>
			<div class="panel-body overflow-hs">
				Đã hết hạn xem lại kết quả bài kiểm tra.<br /><br />
				<a href="?"><button type="button" class="btn btn-info">Quay Lại</button></a>
			</div>	
		</div>
	</div><!-- Kết thúc báo lỗi bài tập -->
	<?php
}
?>