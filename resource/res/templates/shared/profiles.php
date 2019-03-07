<div class="title-content">
	<span class="title">Thông Tin Cá Nhân</span>
</div>
<div class="block-content overflow scrollbar">
	<div class="content">
		<div class="row col l12" style="padding-top: 50px;">
			<div class="col l3 s12">
				<img src="res/img/avatar/<?=$profile->avatar?>" alt="Avatar" width="100%" height="200" id="profiles-avatar">
				<div class="file-field input-field">
					<div class="btn">
						<span>File</span>
						<input type="file" id="file" onchange="update_avatar()">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
						<img src="res/img/loading.gif" width="50" height="50" class="valid-img hidden" id="avatar_uploading">
					</div>
				</div>
				<span class="help">Ảnh JPG,PNG nhỏ hơn 2mb</span>
			</div>
			<form action="" id="upload_profiles">
				<div class="col l4 s12">
					<div class="input-field">
						<label for="username" class="active">Tên Truy Cập</label>
						<input type="text" name="username" id="profiles-username" value="<?=$profile->username?>" readonly>
					</div>
					<div class="input-field">
						<input type="date" name="birthday" id="profiles-birthday" value="<?=$profile->birthday?>" required>
						<label for="birthday" class="active">Ngày Sinh</label>
					</div>
					<div class="input-field">
						<select name="gender" id="gender">
							<?php
							if($profile->gender_id == 1)
								echo '<option value="1" selected>Không Xác Định</option>';
							else
								echo '<option value="1">Không Xác Định</option>';
							if($profile->gender_id == 2)
								echo '<option value="2" selected>Nam</option>';
							else
								echo '<option value="2">Nam</option>';
							if($profile->gender_id == 3)
								echo '<option value="3" selected>Nữ</option>';
							else
								echo '<option value="3">Nữ</option>';
							?>
								
								
								
							</select>
						<label>Giới Tính</label>
					</div>
					<div class="input-field">
						<span>Đăng nhập cuối: </span><br />
						<span id="profiles-last-login"><?=$profile->last_login?></span>
					</div>
				</div>
				<div class="col l4 s12">
					<div class="input-field">
						<input type="text" name="name" id="profiles-name" value="<?=$profile->name?>" required>
						<label for="name" class="active">Tên</label>
					</div>
					<div class="input-field">
						<label for="email" class="active">Email</label>
						<input type="hidden" id="profiles-current-email" value="">
						<input type="email" id="profiles-new-email" name="email" oninput="valid_email_on_profiles()" value="<?=$profile->email?>" required>
						<img src="res/img/true.png" class="valid-img" id="valid-email-true">
						<img src="res/img/false.png" class="valid-img hidden" id="valid-email-false">
					</div>
					<div class="input-field">
						<label for="password" class="active">Mật Khẩu</label>
						<input type="password" name="password" id="profiles-password" required>
					</div>
					<div class="input-field">
						<button type="submit" class="btn" style="width: 100%">Cập Nhật</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="res/js/profiles.js"></script>