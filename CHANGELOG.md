Building v3.0.0 (xx/xx/xxxx)

	- Nâng cấp lên giao diện Material để tăng trải nghiệm người dùng trên các thiết bị di động
	- Thay đổi cấu trúc cơ sở dữ liệu để tiện cho việc bảo trì, nâng cấp ✓
	- Do thay đổi cơ sở dữ liệu, hiện đã có thể mở được nhiều hơn 4 bài kiểm tra, và admin có thể quản lý bài kiểm tra nào đang mở làm, bài nào đang đóng (sử dụng cho bài kiểm tra) ✓
    - Học sinh, Giáo viên có thể quản lý tài khoản cá nhân (không cần thiết phải qua admin)
    - Giáo viên có thể thêm học sinh, xoá học sinh, sửa học sinh trong lớp quản lý
	- Giáo viên, admin có thể chọn khối, lớp để gửi thông báo (thay vì gửi cho tất cả như hiện tại)
	- Sửa lại code theo đúng PHP Convention (PSR)
	- Gộp các trang đăng nhập, quên mật khẩu lại làm 1 ✓
	- Kiểm tra dữ liệu tài khoản, email, tên lớp nhập vào ở Thêm, sửa Admin, học sinh, giáo viên, lớp ngay lập tức sau khi nhập xong
	- Sử dụng AJAX cho các form nhập tạo hiệu ứng real-time ✓
v2.1.1 (12/01/2018)

	- Tối ưu hóa các hàm ✓
	- Sửa lại status bar để hiển thị tốt hơn ✓
	- Báo lỗi khi tài khoản thêm vào bị trùng ✓
	- Thêm JS để ẩn input placeholder khi focus ✓
v2.1.0 (12/01/2018)

	- Thay đổi toàn bộ cấu trúc thư mục hệ thống theo chuẩn MVC nhất có thể ✓
	- Fix các lỗi XSS từ các phiên bản cũ ✓
	- Thêm chức năng quên mật khẩu qua email ✓
	- Fix các lỗi còn tồn tại và tối ưu hóa code ✓
v2.0.1 (20/09/2017)

	- Sửa lỗi khi chạy trên Xampp ✓
v2.0 (19/09/2017)

	- Nâng cấp toàn bộ hệ thống (xây dựng lại bằng OOP PHP trên mô hình MVC để thuận tiện trong nâng cấp và bảo trì sau này) ✓
	- Thay đổi cơ sở dữ liệu phù hợp với phiên bản mới ✓
	- Model Giáo Viên:
		+ Thêm chức năng gửi thông báo đến các lớp đang quản lý ✓
		+ Nâng cấp chức năng xem chi tiết từng lớp ✓
	- Model Học Sinh:
		+ Nâng cấp chức năng làm bài tập trắc nghiệm ✓
		+ Thêm chức năng chát lớp online ✓
		+ Nhận thông báo trực tiếp từ giáo viên quản lý + admin ✓
	- Model Admin:
		+ Gửi thông báo đến các giáo viên ✓
		+ Gửi thông báo đến các lớp ✓
v1.0 (16/05/2017)

	- Xây dựng trên php thuần ✓
	- Cơ sở dữ liệu chỉ dành cho môn toán ✓
	- Hệ thống hướng đến các trường THPT THCS quy mô nhỏ. ✓
	- Mục tiêu: xây dựng hệ thống trắc nghiệm online cho các trường THPT THCS, thay thế các thức làm bài tập và kiểm tra truyền thống ✓
	- Giáo Viên:
		+ Xem Điểm Của Học Sinh Trong Các Lớp Đang Quản Lý ✓
	- Học Sinh:
		+ Làm bài tập trắc nghiệm online ✓
	- Admin:
		+ Quản Lý Tài Khoản Admin ✓
		+ Quản Lý Thông Tin Giáo Viên ✓
		+ Quản Lý Thông Tin Lớp Học ✓
		+ Quản Lý Thông Tin Học Sinh ✓
		+ Quản Lý Ngân Hàng Câu Hỏi ✓
