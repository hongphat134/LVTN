Yêu cầu hệ thống:
1. Cài Wamp hoặc Xampp ( PHP version từ 5.6.40 trở lên)
2. cài Composer

* Demo chức năng login Facebook cần:
1.Download cacert.pem từ link https://curl.haxx.se/ca/cacert.pem để vào thư mục
C:\wamp64\bin\php\php5.6.40 ( nếu bạn dùng version khác thì hãy theo folder tương ứng)
2. Mở file php.ini => tìm ";curl.cainfo=" gõ thành => curl.cainfo="/path/to/downloaded/cacert.pem"
3. Restart lại wamp nhé

Bước 1 : tạo db tên lvtn. Sau đó nạp file CSDL vào
Bước 2 : 