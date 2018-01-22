<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=Info::TITLE?></title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="../res/css/style.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/script.js"></script>
	<script src="../res/js/bootstrap.min.js"></script>
</head>
<body style="overflow-x: hidden;">
	<div class="col-lg-12">
		<nav class="navbar navbar-default logo" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand font" href="?" style="color: blue !important"><?=$info_config->getTitle()?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right font">
						<li><a href="?" style="color: blue !important">Trang Chủ</a></li>
						<li><a href="#" style="color: blue !important">Hướng Dẫn Sử Dụng</a></li>
						<li><a href="#" style="color: blue !important">Ôn Lại Kiến Thức</a></li>
						<li><a href="#" style="color: blue !important">Báo Lỗi - Góp ý</a></li>
						<li><a href="#" style="color: blue !important">Liên Hệ</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</div>
	<!-- Kết thúc header -->
	<div class="col-lg-2">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Thông tin tài khoản</h3>
			</div>
			<div class="panel-body">
				<span>Tài khoản: <?=$info['tai_khoan']?></span><br />
				<span>Tên: <?=$info['ten']?></span><br />
				<span>Chức vụ: <?=$info['ten_cv']?>
				</span><br />
				<a class="" data-toggle="modal" style="color: blue !important;"  href='#logout'>Đăng xuất</a>
				<div class="modal fade" id="logout">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" >Đăng xuất</h4>
							</div>
							<div class="modal-body">
								Bạn có muốn thoát phiên làm việc!
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
								<a href="index.php?logout=true" class="btn btn-primary" name="logout">Đăng Xuất</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kết thúc thông tin cá nhân giáo viên -->
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Danh Sách Lớp</h3>
			</div>
			<div class="panel-body">
				<?php
                //vòng lặp load danh sách lớp với các thuộc tính
                for ($i = 0; $i < count($dsl); $i++) {
                    ?>
					<a class="btn btn-max btn-success" data-toggle="modal" href="?id_lop=<?=$dsl[$i]->id_lop?>"><?=$dsl[$i]->ten_lop?></a><br /><br />
					<?php
                }
                ?>
			</div>
		</div>
	</div><!-- Kết thúc danh sách lớp -->
</div>
<!-- Kết thúc Sidebar trái -->
