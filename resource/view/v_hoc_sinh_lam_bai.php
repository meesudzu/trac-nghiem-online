<?php

/**
 * View Chat lớp cho học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng hs với các thuộc tính từ session
$index = new C_Hoc_Sinh($_SESSION['id_hs'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu'],$_SESSION['id_lop']);

$unit = addslashes($_GET['unit']);//lấy số chương học sinh muốn làm từ url
$cau_hoi = $index->getCauHoi($unit);//load danh sách câu hỏi từ CSDL
$ts_ch = count($cau_hoi);//đếm tổng số câu hỏi load ra
//kiểm tra xem bài tập có tồn tại và bài đó đã làm hay chưa
if($unit<5&&$unit>0&&$index->diem[$unit-1]==-1)
{
	?>
	<div class="col-lg-7">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Làm Bài Tập Chương <?=$unit?></h3>
			</div>
			<div class="panel-body" id="lambai">
				<form action="?nop_bai" method="POST" role="form">
					<div class="overflow-bt scrollbar">
						<input type="hidden" name="unit" value="<?=$unit?>">
						<input type="hidden" name="tong_so_ch" value="<?=$ts_ch?>">
						<?php 
					// vòng lặp load các câu hỏi ra
						for ($i = 0; $i < $ts_ch; $i++) {?>
						<div class="panel panel-default rlambai">
							<div class="panel-body lambai">
								<h3 class="panel-title">
									Câu <?=$i+1?> - #<?=$cau_hoi[$i]->id_cauhoi?> :   <?=$cau_hoi[$i]->cau_hoi?>
									<!-- $cau_hoi[$i]->id_cauhoi hiển thị id câu hỏi thứ i -->
									<!-- $cau_hoi[$i]->cau_hoi hiển thị nội dung câu hỏi thứ i -->
								</h3>
								<input type="hidden" name="id_ch_<?=$i?>" value="<?=$cau_hoi[$i]->id_cauhoi?>">
								<!-- id_ch_<?=$i?> sẽ nhận giá trị id câu hỏi (<?=$cau_hoi[$i]->id_cauhoi?>) để truyền qua view kết qua bài làm thông qua phương thức POST-->
								<ul>
									<li>
										<input type="radio" name="da_<?=$i?>" value="<?=$cau_hoi[$i]->da_1?>">
										<label><?=$cau_hoi[$i]->da_1?></label>
										<!-- hiển thị đáp án 1 -->
									</li>
									<li>
										<input type="radio" name="da_<?=$i?>" value="<?=$cau_hoi[$i]->da_2?>">
										<label><?=$cau_hoi[$i]->da_2?></label>
										<!-- hiển thị đáp án 2 -->
									</li>
									<li>
										<input type="radio" name="da_<?=$i?>" value="<?=$cau_hoi[$i]->da_3?>">
										<label><?=$cau_hoi[$i]->da_3?></label>
										<!-- hiển thị đáp án 3 -->
									</li>
									<li>
										<input type="radio" name="da_<?=$i?>" value="<?=$cau_hoi[$i]->da_4?>">
										<label><?=$cau_hoi[$i]->da_4?></label>
										<!-- hiển thị đáp án 4 -->
									</li>
									<!-- da_<?=$i?> sẽ nhận đáp án của câu hỏi có id là id_ch_<?=$i?> mà học sinh trả lời để gửi qua view kết quả qua phương thức POST-->
								</ul>
							</div>
						</div>
						<?php }
						?>
					</div>
					<button type="submit" name="nopbai" class="btn btn-success btn-nopbai" value="true">Nộp Bài</button>
					<a href="?" class="btn btn-success btn-nopbai">Quay lại!</a>
				</form>
			</div>	
		</div>
	</div><!-- Kết thúc làm bài tập -->
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
				Bài tập không tồn tại hoặc đã làm xong, vui lòng kiểm tra lại hoặc liên hệ giáo viên.<br /><br />
				<a href="?"><button type="button" class="btn btn-info">Quay Lại</button></a>
			</div>	
		</div>
	</div><!-- Kết thúc báo lỗi bài tập -->
	<?php
}
?>