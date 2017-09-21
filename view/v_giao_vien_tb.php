<?php

/**
 * View giáo viên gửi và nhận thông báo
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
//tạo đối tượng index với các thuộc tính từ session
$index = new C_Giao_Vien($_SESSION['id_gv'],$_SESSION['tai_khoan'],$_SESSION['ten'],$_SESSION['chuc_vu']);
$tbgv = $index->getTBGV();
$tbhs = $index->getTBHS();
?>
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
<div class="col-lg-5">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Gửi Thông Báo Đến Học Sinh</h3>
		</div>
		<div class="panel-body">
			<div class="noi_dung_gv_2 scrollbar">
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
			<div class="send_gv">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<input name="chu_de_hs" type="text" class="form-control" id="" placeholder="Chủ đề">
						<textarea name="noi_dung_hs" id="inputNoi_dung" class="form-control" rows="3" required="required"></textarea>
					</div>
					<button name="send_hs" type="submit" class="btn btn-info btn-max">Gửi</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
//kiểm tra nội dung và chủ đè không bỏ trống, thực hiện thêm vào CSDL
if(isset($_POST['send_hs']))
{
	$chu_de = trim(addslashes($_POST['chu_de_hs']));
	$noi_dung = trim(addslashes($_POST['noi_dung_hs']));
	if($chu_de != '' && $noi_dung != '')
	{
		$index->sendHS($chu_de,$noi_dung);
		echo '<meta http-equiv="refresh" content="0" />';
	}
}
?>
<!-- Kết thúc giáo viên gửi thông báo học sinh-->
