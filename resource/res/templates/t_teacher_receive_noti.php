<div class="col-lg-5">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Thông Báo Nhận Từ Admin</h3>
		</div>
		<div class="panel-body">
			<div class="noi_dung_gv_1 scrollbar">
				<?php
				// kiểm tra, nếu thông báo ít hơn 10, hiển thị hết, chát trên 10 hiển thị 10 
				if(count($tbgv)>10) 
				{
					// vòng lặp đếm ngược để hiển thị cácthông báo mới nhất lên đầu
					for ($i = count($tbgv)-1; $i >= count($tbgv)-10 ; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$tbgv[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$tbgv[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$tbgv[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$tbgv[$i]->ten?><span class="txt_chat"> : <?=$tbgv[$i]->chu_de?></span></span>
							<!-- tên và chủ đề gửi -->
							<span class="nd_chat"><?=$tbgv[$i]->noi_dung?></span>
						</div>
						<?php
					}
				}
				else
				{
					// vòng lặp đếm ngược để hiển thị các thông báo mới nhất lên đầu
					for ($i = count($tbgv)-1; $i >= 0; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$tbgv[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$tbgv[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$tbgv[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$tbgv[$i]->ten?><span class="txt_chat"> : <?=$tbgv[$i]->chu_de?></span></span>
							<!-- tên và chủ đề gửi -->
							<span class="nd_chat"><?=$tbgv[$i]->noi_dung?></span>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div><!-- Kết thúc giáo viên xem thông báo được gửi từ admin -->