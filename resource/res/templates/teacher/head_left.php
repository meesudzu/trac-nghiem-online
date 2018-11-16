<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?=Config::TITLE?>
	</title>
	<link rel="stylesheet" href="res/css/normalize.css">
	<link rel="stylesheet" href="res/css/style.min.css">
	<link rel="stylesheet" href="res/css/font-awesome.css">
	<link rel="stylesheet" href="res/css/materialize.min.css">
	<link rel="stylesheet" href="res/libs/DataTables/css/jquery.dataTables.css">
	<script src="res/js/jquery.js"></script>
	<script src="res/js/materialize.min.js"></script>
	<script src="res/libs/DataTables/js/jquery.dataTables.js"></script>
	<script src="res/js/teacher_functions.js"></script>
</head>

<body class="body-login  overflow scrollbar">
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper nav-green">
				<div class="left pad-left-20"><a class="cursor" id="trigger-sidebar"><i class="material-icons" id="menu-icon" title="Ẩn/Hiện bảng điều hướng">menu</i></a></div>
				<a href="index.php?action=show_dashboard" class="brand-logo right cursor"><i class="material-icons">home</i></a>
			</div>
		</nav>
		<div id="status" class="status"></div>
	</div>
	<div class="sidebar-left sidebar-show menu-sidebar scrollbar" id="sidebar-left">
		<div class="card reset-margin">
			<div class="card-image">
				<img src="res/img/avatar/<?=$info['avatar']?>" height="155" id="user-avatar">
				<span class="card-title" style="padding: 20px; "><i  id="user-name"><?=$info['name']?></i>
					<a href="index.php?action=show_profiles" class="cursor blue-text text-darken-2"><i class="material-icons">create</i></a>
				</span>
			</div>
		</div>
		<ul class="collapsible reset-margin" data-collapsible="accordion">
			<li class="active">
				<div class="collapsible-header" id="menu"><i class="material-icons hide" id="menu-arrow-down">arrow_drop_down</i>
					<i class="material-icons" id="menu-arrow-up">arrow_drop_up</i>Danh Sách Lớp</div>
					<div class="collapsible-body list" id="list_classes_sidebar">
					</div>
				</li>
				<a href="index.php?action=list_test" class="collapsible-header font-color cursor"><i class="material-icons">list</i>Xem Danh Sách Điểm</a>
				<a href="index.php?action=show_notifications" class="collapsible-header font-color cursor"><i class="material-icons">send</i>Gửi/Xem Thông Báo</a>
				<a href="index.php?action=show_about" class="collapsible-header font-color cursor"><i class="material-icons">insert_comment</i>Liên Hệ</a>
			</ul>
		</div>
		<a data-target="modal1" class="sidebar-show logout modal-trigger waves-effect" id="logout">Đăng Xuất</a>
		<div id="modal1" class="modal">
			<div class="modal-content">
				<h4>Đăng Xuất</h4>
				<p>Xác nhận đăng xuất</p>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Không</a>
				<a class="modal-action modal-close waves-effect waves-green btn-flat" id="btn-logout">Có</a>
			</div>
		</div>
		<div class="box-content right box-content-mini" id="box-content">
