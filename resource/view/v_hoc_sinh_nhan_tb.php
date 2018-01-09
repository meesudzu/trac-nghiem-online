<?php

/**
 * View Thông báo cho ngừoi dùng học sinh
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng index với các thuộc tính từ session
$index = new C_Hoc_Sinh($_SESSION['id_hs'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu'],$_SESSION['id_lop']);
$tbhs = $index->getTBHS();
?>
<div class="col-lg-3">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Thông Báo</h3>
		</div>
		<div class="panel-body">
			<div class="noi_dung_hs scrollbar">
				<?php
				// kiểm tra, nếu thông báo ít hơn 10, hiển thị hết, chát trên 10 hiển thị 10
				if(count($tbhs)>10) 
				{
					// vòng lặp đếm ngược để hiển thị cácthông báo mới nhất lên đầu
					for ($i = count($tbhs)-1; $i >= count($tbhs)-10 ; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$tbhs[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$tbhs[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$tbhs[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$tbhs[$i]->ten?><span class="txt_chat"> : <?=$tbhs[$i]->chu_de?></span></span>
							<!-- tên và chủ đề gửi -->
							<span class="nd_chat"><?=$tbhs[$i]->noi_dung?></span>
							<!-- nội dung thông báo -->
						</div>
						<?php
					}
				}
				else
				{
					// vòng lặp đếm ngược để hiển thị các thông báo mới nhất lên đầu
					for ($i = count($tbhs)-1; $i >= 0; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$tbhs[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$tbhs[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$tbhs[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$tbhs[$i]->ten?><span class="txt_chat"> : <?=$tbhs[$i]->chu_de?></span></span>
							<!-- tên và chủ đề gửi -->
							<span class="nd_chat"><?=$tbhs[$i]->noi_dung?></span>
							<!-- nội dung thông báo -->
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div><!-- Kết thúc giáo viên xem thông báo được gửi từ admin -->