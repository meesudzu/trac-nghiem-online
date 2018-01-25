<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?=Info::TITLE?>
	</title>
	<link rel="stylesheet" href="../res/css/style.min.css">
	<link rel="stylesheet" href="../res/css/font-awesome.css">
	<link rel="stylesheet" href="../res/css/materialize.min.css">
	<script src="../res/js/jquery.js"></script>
	<script src="../res/js/materialize.min.js"></script>
	<script src="../res/js/teacher_functions.js"></script>
</head>

<body class="body-login">
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper nav-green">
				<div class="left pad-left-20"><a class="cursor" id="trigger-sidebar"><i class="material-icons">menu</i></a></div>
				<a class="brand-logo right cursor" onclick="show_index()"><i class="material-icons">home</i></a>
			</div>
		</nav>
		<div id="status" class="status"></div>
	</div>
	<div class="sidebar-left sidebar-show menu-sidebar scrollbar" id="sidebar-left">
		<div class="card reset-margin">
			<div class="card-image">
				<img src="../res/img/avatar/<?=$info['avatar']?>" height="155" id="user-avatar">
				<span class="card-title" style="padding: 20px; "><i  id="user-name"><?=$info['name']?></i>
					<a class="cursor blue-text text-darken-2" onclick="show_profiles()"><i class="material-icons">create</i></a>
				</span>
			</div>
		</div>
		<ul class="collapsible reset-margin" data-collapsible="accordion">
			<li>
				<div class="collapsible-header" id="menu"><i class="material-icons hide" id="menu-arrow-down">arrow_drop_down</i>
					<i class="material-icons" id="menu-arrow-up">arrow_drop_up</i>Danh Sách Lớp</div>
					<div class="collapsible-body list">
						<a class="menu-list cursor">Lớp 3A</a>
						<a class="menu-list cursor">Lớp 3B</a>
						<a class="menu-list cursor">Lớp 3C</a>
						<a class="menu-list cursor">Lớp 3D</a>
					</div>
				</li>
				<a class="collapsible-header font-color cursor"><i class="material-icons">send</i>Gửi Thông Báo</a>
				<a class="collapsible-header font-color cursor" onclick="show_about()"><i class="material-icons">insert_comment</i>Liên Hệ</a>
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