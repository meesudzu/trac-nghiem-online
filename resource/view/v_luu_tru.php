<?php

/**
 * View lưu trữ Chat lớp của học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng hs với các thuộc tính từ session
$index = new C_Hoc_Sinh($_SESSION['id_hs'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu'],$_SESSION['id_lop']);
$chat = $index->getChat();//lấy danh sách chat lớp
?>
<div class="col-lg-7">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Lưu Trữ Chat Lớp</h3>
		</div>
		<div class="panel-body" id="chat_lop">
			<div class="noi_dung_lt scrollbar">
				<?php 
				// vòng lặp ngược để hiển thị chat mới nhất lên đầu, (lấy tất cả có trong CSDL)
				for ($i = count($chat)-1; $i >= 0 ; $i--) {?>
				<div class="chat">
					<span class="id_chat">#<?=$chat[$i]->id?> - </span>
					<span class="tk_chat"><?=$chat[$i]->tai_khoan?></span>
					<span class="tg_chat"> - [<?=$chat[$i]->thoi_gian?>]</span>
					<span class="ten_chat"><?=$chat[$i]->ten?><span class="txt_chat"> -> <?=$chat[$i]->noi_dung?></span></span>
				</div>
				<?php	}?>
			</div>
		</div>
	</div>
</div><!-- Kết thúc lưu trữ chat lớp -->