<div class="col-lg-7">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Chat Lớp</h3>
		</div>
		<div class="panel-body" id="chat_lop">
			<div class="noi_dung scrollbar">
				<?php
				// kiểm tra, nếu chat ít hơn 10, hiển thị hết, chát trên 10 hiển thị 10
				if(count($chat)>10) 
				{
					// vòng lặp đếm ngược để hiển thị các chat mới nhất lên đầu
					for ($i = count($chat)-1; $i >= count($chat)-10 ; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$chat[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$chat[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$chat[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$chat[$i]->ten?><span class="txt_chat"> -> <?=$chat[$i]->noi_dung?></span></span>
							<!-- tên và nội dung gửi -->
						</div>
						<?php
					}
				}
				else
				{
					// vòng lặp đếm ngược để hiển thị các chat mới nhất lên đầu
					for ($i = count($chat)-1; $i >= 0; $i--) 
					{
						?>
						<div class="chat">
							<span class="id_chat">#<?=$chat[$i]->id?> - </span>
							<!-- hiển thị số thứ tự chat trong CSDL -->
							<span class="tk_chat"><?=$chat[$i]->tai_khoan?></span>
							<!-- tài khoản gửi chat -->
							<span class="tg_chat"> - [<?=$chat[$i]->thoi_gian?>]</span>
							<!-- thời gian chat -->
							<span class="ten_chat"><?=$chat[$i]->ten?><span class="txt_chat"> -> <?=$chat[$i]->noi_dung?></span></span>
							<!-- tên và nội dung gửi -->
						</div>
						<?php
					}
				}
				?>
			</div>
			<div class="send_chat">
				<form action="" method="POST">
					<div class="input-group">
						<span class="input-group-btn">
							<a class="btn btn-info" href="?luu_tru=true" title="Lưu trữ chat"><i class="fa fa-list" aria-hidden="true"></i></a>
							<a class="btn btn-warning" href="?" title="Làm mới"><i class="fa fa-refresh" aria-hidden="true"></i></a>
						</span>
						<input type="text" name="txt" class="form-control" placeholder="Nhập nội dung trò chuyện (Nhấn Enter hoặc Gửi)" autofocus>
						<span class="input-group-btn">
							<button name="send" id="send" class="btn btn-info" type="submit" title="Gửi"><i class="fa fa-paper-plane"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div><!-- Kết thúc chat lớp -->