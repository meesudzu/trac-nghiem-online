<?php

/**
 * View Kết quả làm bài cho ngừoi dùng học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng index với các thuộc tính từ session
$index = new C_Hoc_Sinh($_SESSION['id_hs'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu'],$_SESSION['id_lop']);

//gán các kết quả thông số được gửi từ view làm bài thông qua phương thức POST
$unit = $_POST['unit']; //nhận số chương mà học sinh đã làm từ view làm bài thông qua POST
$ts_ch = $_POST['tong_so_ch'];//nhận tổng số câu hỏi đã hiển thị trên view làm bài của học sinh
// vòng lặp gán các ID câu hỏi đã hiển thị trên view làm bài và các đáp án tương ứng của học sinh vào 2 mảng $id_cauhoi[] và $da_cauhoi[]
for ($i = 0; $i < $ts_ch; $i++) {
	$id_cauhoi[$i] = addslashes($_POST['id_ch_'.$i.'']);
	$da_cauhoi[$i] = addslashes($_POST['da_'.$i.'']);
}
?>
<?php
// kiểm tra ngăn ngừa reload nhiều lần hoặc cố ý reload GET url
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
					$diem = 0;
			// vòng lặp load các câu hỏi và các đáp án ra
					for ($i = 0; $i < $ts_ch; $i++) {
				$cau_hoi = $index->get1CauHoi($id_cauhoi[$i]);//gán thông tin câu hỏi lấy thược vào biến $cau_hoi
				?>
				<div class="panel panel-default rlambai">
					<div class="panel-body lambai">
						<h3 class="panel-title">
							Câu <?=$i+1?> - #<?=$cau_hoi->id_cauhoi?> :   <?=$cau_hoi->cau_hoi?>
							<!-- $cau_hoi->id_cauhoi hiển thị id câu hỏi thứ i -->
							<!-- $cau_hoi->cau_hoi hiển thị nội dung câu hỏi thứ i -->
						</h3>
						<ul>
							<?php
							// kiểm tra đáp án, nếu đúng + điểm
							if($da_cauhoi[$i]==$cau_hoi->da_dung)
								$diem++;
							?>
							<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
							if($da_cauhoi[$i]==$cau_hoi->da_1)
								echo '<li><input type="radio" checked="checked">
							<label>'.$cau_hoi->da_1.'</label></li>';
							else
								echo '<li><input type="radio" disabled="disabled">
							<label>'.$cau_hoi->da_1.'</label></li>';
							?>
							<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
							if($da_cauhoi[$i]==$cau_hoi->da_2)
								echo '<li><input type="radio" checked="checked">
							<label>'.$cau_hoi->da_2.'</label></li>';
							else
								echo '<li><input type="radio" disabled="disabled">
							<label>'.$cau_hoi->da_2.'</label></li>';
							?>
							<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
							if($da_cauhoi[$i]==$cau_hoi->da_3)
								echo '<li><input type="radio" checked="checked">
							<label>'.$cau_hoi->da_3.'</label></li>';
							else
								echo '<li><input type="radio" disabled="disabled">
							<label>'.$cau_hoi->da_3.'</label></li>';
							?>
							<?php
							// kiểm tra xem đáp án nào học sinh đã trả lời thì checked
							if($da_cauhoi[$i]==$cau_hoi->da_4)
								echo '<li><input type="radio" checked="checked">
							<label>'.$cau_hoi->da_4.'</label></li>';
							else
								echo '<li><input type="radio" disabled="disabled">
							<label>'.$cau_hoi->da_4.'</label></li>';
							?>
						</ul>
					</div>
					<span class="dap_an">Đáp án: <span class="da_dung"><?=$cau_hoi->da_dung?></span></span>
				</div>
				<?php }
				?>
			</div>
			<span class="ket_qua">Điểm: <span class="diem"><?=$diem?></span></span>
			<a href="?"><button class="btn btn-success" style="float: right;">Quay lại!</button></a>
		</div>
		<?php
		// thực hiện ghi điểm vào bảng điểm theo id học sinh vào id lớp
		$index->tinhDiem($index->id_hs,$index->id_lop,$unit,$diem);
		?>	
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