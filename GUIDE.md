-   Toàn bộ code trong thư mục resource  

-   Lưu ý: nên cho toàn bộ code trong thư mục resource ra thư mục gốc (htdocs nếu dùng xampp, www nếu dùng appserv...) và chạy theo đường dẫn localhost hoặc domain.com, không nên đặt trong thư mục con và chạy localhost/resource hoặc domain.com/resource để tránh lỗi.  

-   Chạy domain/install.php để tiến hành cài đặt và cấu hình hệ thống. Nếu quá trình cài đặt xảy ra lỗi, vui lòng kiểm tra các nguyên nhân dưới:
        1, Cấp quyền ghi cho thư mục cài đặt (htdocs, www, ...)
        2, Xem lại kết nối tới database, ví dụ tên user, tên database, mật khẩu....  

    Nếu đã kiểm tra lại và vẫn lỗi, bạn có thể mở file config/connect.php sửa trực tiếp kết nối trong đó,
    hoặc liên hệ báo lỗi tới email: dzu6996@gmail.com  

-   Sửa URL trang web trong config/config.php
-   Sửa tài khoản gửi email quên mật khẩu tại /controllers/controller_login.php dòng 127, 128  

-   Tài khoản mặc định:
    		tài khoản: admin
    		mật khẩu: 123456
