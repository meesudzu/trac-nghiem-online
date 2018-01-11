# Hệ Thống Trắc Nghiệm Online
[![Build Status](https://travis-ci.org/meesudzu/trac-nghiem-online.svg?branch=master)](https://travis-ci.org/meesudzu/trac-nghiem-online)

Mục tiêu: Xây dựng hệ thống trắc nghiệm online cho các trường THPT THCS, thay thế cách thức làm bài tập và kiểm tra truyền thống
## Sắp Có

   - Thêm nhiều dạng bài tập hơn
   - Tích hợp thêm nhập, xuất dữ liệu bằng XML
   - Thêm file install.php để dễ dàng trong việc cài đặt & cấu hình sản phẩm lần đầu
   - Fix lỗi XSS các khung nhập dữ liệu vào
   - Thêm kiểm tra và trả về thông báo nếu tài khoản thêm vào bị trùng.
   - Giáo viên có thể thêm học sinh, xoá học sinh, sửa học sinh trong lớp quản lý
   - Thêm 1 vài hoạt động để học sinh kiếm thêm điểm chuyên cần
   - Học sinh, Giáo viên có thể quản lý tài khoản cá nhân (không cần thiết phải qua admin)
   - Chức năng quên mật khẩu thông qua email
   - Học sinh có thể có nhiều hơn 4 chương (hiện thời gian làm xong từng chương)
   - Cập nhật thêm nhiều môn học có thể kiểm tra bằng hình thức trắc nghiệm

[Hướng dẫn sử dụng](GUIDE.md)
## Lưu ý
Trên GitHub chỉ lưu từ v2.0.1 trở đi.
Xem thêm tại [CHANGELOG](CHANGELOG.md)
v2.0 và v1.0 mọi người có thể tải file nén về tham khảo ( vì lúc mình bắt đầu làm v1 v2 thì chưa có ý định public lên GitHub)
## v2.0 (19/09/2017)
[Download v2.0!](https://drive.google.com/open?id=0B2XjHVJwd5PSdEpObFltbmZzZGc)
## v1.0 (16/05/2017)
[Download v1.0!](https://drive.google.com/open?id=0B2XjHVJwd5PSa0FtWXFMM2xhcjg)
## Ảnh Demo (Chụp Từ v2.0.1)
( nút tròn tím có số 0 kia không phải của web đâu nhé :) lúc chụp mình quên tắt extension của chrome đó )

Học Sinh
	
	Đăng nhập
![Đăng nhập](demo-images/login-hs.png)

	Trang chủ
![Trang chủ](demo-images/hoc-sinh-index.png)

	Làm bài tập
![Làm bài tập](demo-images/hoc-sinh-lam-bai.png)

	Nộp bài
![Nộp bài](demo-images/hoc-sinh-nop-bai.png)

Giáo Viên

	Đăng nhập
![Đăng nhập](demo-images/login-gv.png)

	Trang chủ
![Trang chủ](demo-images/giao-vien-index.png)

	Xem chi tiết lớp
![Xem chi tiết lớp](demo-images/giao-vien-xem-diem.png)

Admin

	Đăng nhập
![Đăng nhập](demo-images/login-admin.png)

	Trang quản lý học sinh
![Trang quản lý học sinh](demo-images/admin-ql.png)

	Trang gửi thông báo
![Trang gửi thông báo](demo-images/admin-tb.png)