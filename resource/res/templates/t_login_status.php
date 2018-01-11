<?php
if($status)
{
	echo "Đăng nhập thành công!";
	header( "Refresh:0.2; url=index.php");
}
else 
{
	echo "Thông tin đăng nhập không hợp lệ!";
}
?>