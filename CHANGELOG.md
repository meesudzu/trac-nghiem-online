#3428  
v3.4.3 (xx/xx/2019)

    - Tối ưu lại một số code ✓
    - Lưu lại trạng thái ẩn/hiện menu trái ✓
    - Fix lỗi update avatar ✓
    - Thêm Ẩn/Hiện đề thi ✓
    - Thêm comment cho các hàm phục vụ cho việc bảo trì, nâng cấp
    
v3.4.2 (27/03/2019)

    - Thay đổi lại cách thức thực hiện truy vấn SQL -> hạn chế lỗi SQL Injection ✓
    - Fix lỗi bị lag khi thực hiện thêm, sửa, xóa với các mục có nhiều dữ liệu ✓
    - Fix lỗi không cài đặt được ở 1 số máy ✓
    - Fix lỗi không hiện công thức toán khi làm bài ✓
    - Rewrite URL ✓
    - Thêm upload ảnh trong nội dung câu hỏi ✓
    - Tối ưu lại một số code ✓
    - Thêm comment cho các hàm phục vụ cho việc bảo trì, nâng cấp ✗

v3.4.1 (17/03/2019)

    - Fix upload ảnh ✓
    - Fix nhập câu hỏi trực tiếp trên web bị mã hóa 1 số ký tự ✓
    - Sửa lại giao diện xem lại bài trực quan hơn ✓
    - Thêm chức năng sau khi Admin xác nhận, học sinh mới có thể xem chi tiết bài thi (formype@gmail.com) ✓
    - Thêm nhập nội dung ảnh cho câu hỏi và câu trả lời ✗
    - Thay đổi cách thức gửi đáp án của học sinh (sữa lỗi đáp án chọn không trùng với đáp án trong bảng câu hỏi và đáp án có nội dung ảnh) ✓

v3.4.0 (18/02/2019)

    - Thêm hỗ trợ nhập công thức bằng LaTeX (ckeditor + mathjax add-on) (Cảm ơn bạn tranphong965@gmail.com, Hoang Duong đã góp ý) ✓
    - Thêm phân loại: dễ, trung bình, khó (Cảm ơn bạn tranphong965@gmail.com, Hoang Duong đã góp ý) ✓
    - Tách trang thêm câu hỏi và sửa câu hỏi ra trang riêng ✓
    - Thêm thông báo lỗi ở một số chỗ (thêm học sinh, thêm lớp,...) ✓
    - Chỉnh lại phần chọn đáp án đúng cho thêm câu hỏi (chọn A, B, C, D thay vì phải nhập lại đáp án, giảm thiểu lỗi do nhập lỗi nhập liệu) ✓
    - Fix một số lỗi từ các phiên bản trước ✓

v3.3.0 (16/11/2018)

    - Thêm chức năng xem danh sách điểm của tất cả các bài thi/kiểm tra và xuất file excel cho Admin ✓
    - Thêm chức năng xem danh sách điểm của các bài thi và xuất file excel mà có lớp giáo viên đó đang quản lý tham gia ✓
    - Thêm chức năng xem chi tiết đề thi cho Admin ✓
    - Fix file path ✓
    - Optimize code ✓

v3.2.1 (07/11/2018)

    - Fix chức năng làm bài của học sinh ✓
    - Thay đổi một chút giao diện cho hợp lý hơn ✓
    - Thay đổi cấu trúc thư mục ✓

v3.2.0 (06/11/2018)

    - Nâng cấp chức năng tạo đề thi của quản trị viên ✓
    	- Có thể chọn môn, chọn khối, chọn số câu hỏi của từng chương trong đề thi ✓
    	- Hệ thống sẽ lấy ngẫu nhiên các câu hỏi theo điều kiện đã chọn để tạo đề thi ✓
    	- Mỗi học sinh khi chọn đề thi để làm bài sẽ có bộ câu hỏi được lấy từ bộ câu hỏi của đề thi sau khi đã được trộn thứ tự các câu hỏi và câu trả lời. ✓
    - Nâng cấp chức năng làm bài của học sinh ✓
    	- Thay đổi giao diện trang làm bài/thi trực quan, nhiều chức năng hơn ✓
    	- Hệ thống sẽ lưu lại trạng thái làm bài và thời gian còn lại của học sinh. Khi gặp sự cố hoặc học sinh lỡ tay đóng trình duyệt đang mở, khi mở lại trang làm bài tập sẽ vẫn lưu lại trang thái các câu đã làm và thời gian còn lại. ✓
    	- Có thể xem lại thông tin bài làm và điểm bất cứ khi nào cần. ✓
    - Hỗ trợ thêm các môn có thể kiểm tra/thi bằng hình thức trắc nghiệm

v3.1.3 (29/09/2018)

    - Fix chức năng thêm câu hỏi qua file (cho phép hiển thị ảnh trong nội dung câu hỏi) ✓

v3.1.2 (28/09/2018)

    - Fix chức năng thêm admin qua file ✓

v3.1.1 (26/09/2018)

    - Thêm giao diện cho trình cài đặt (install.php) ✓

v3.1.0 (20/09/2018)

    - Thêm chức năng xem điểm từng học sinh cho giáo viên ✓
    - Thêm file install.php để dễ dàng trong việc cài đặt & cấu hình sản phẩm lần đầu ✓
    - Thêm nhập dữ liệu bằng file thay vì nhập từng dòng (gồm thêm admin, giáo viên, học sinh, bộ câu hỏi) ✓
    - Thêm bộ đếm ngược thời gian ở phần làm bài tập, bài kiểm tra ✓
    - Hạn chế chức năng sử dụng khi đang làm bài tập/bài kiểm tra. Ví dụ: Chat lớp... ✓
    - Thêm checkbox để thực hiện lệnh cùng lúc cho nhiều dòng (xóa,...) ✓
    - Sử dụng thư viện DataTables để hỗ trợ trong việc hiển thị dữ liệu ✓
    - Thêm trang tổng quan ✓
    - Thêm hiệu ứng cho nút menu để dễ nhận biết ✓
    - Thêm nút back sau khi nhập username ở phần đăng nhập ✓

v3.0.0 (08/03/2018)

    - Nâng cấp lên giao diện Material để tăng trải nghiệm người dùng trên các thiết bị di động ✓
    - Thay đổi cấu trúc cơ sở dữ liệu để tiện cho việc bảo trì, nâng cấp ✓
    - Do thay đổi cơ sở dữ liệu, hiện đã có thể mở được nhiều hơn 4 bài kiểm tra, và admin có thể quản lý bài kiểm tra nào đang mở làm, bài nào đang đóng (sử dụng cho bài kiểm tra) ✓
    - Học sinh, Giáo viên có thể tự cập nhật thông tin cá nhân (không cần thiết phải qua admin) ✓
    - Giáo viên, admin có thể chọn khối, lớp để gửi thông báo (thay vì gửi cho tất cả như hiện tại) ✓
    - Sửa lại code theo đúng PHP Convention (PSR) ✓
    - Gộp các trang đăng nhập, quên mật khẩu lại làm 1 ✓
    - Kiểm tra dữ liệu tài khoản, email, tên lớp nhập vào ở Thêm, sửa Admin, học sinh, giáo viên, lớp ngay lập tức sau khi nhập xong ✓
    - Sử dụng AJAX cho các form nhập,load trang tạo hiệu ứng real-time ✓

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
