#NOTE: folder gốc là folder chứa toàn bộ sources code (Vd: C:\wamp64\www\blog)

*Yêu cầu hệ thống:
1. Cài Wamp( PHP version từ 5.6.40 trở lên)
2. cài Composer (Next liên tục)

Cài đặt hệ thống:
	*Cách 1: Tạo một website ảo (Khuyên dùng cách này vì chủ source làm bằng cách này)
		Bước 1: vào localhost => Tools(góc trái dưới màn hình) => Add a Virtual Host
		Bạn sẽ thấy 2 mục Required
		-Mục 1 : Name of the Virtual Host No space - No underscore(_) (Bạn điền 'lvtn.laravel.info' => đây là tên link)
		-Mục 2 : Complete absolute path of the VirtualHost folder Examples: C:/wamp/www/projet/ or E:/www/site1/ Required
		(bạn điền đường dẫn đến folder gốc. VD: C:\wamp64\www\blog) (khuyên dùng mở link và copy đường dẫn để tránh sai sót)
		Bước 2: Restart All Services Wamp (nhấp trái chuột ở góc phải dưới màn hình)
		Bước 3: hoàn tất cài đặt và vào link lvtn.laravel.info để sử dụng hệ thống
#Lưu ý: Mở file .env để thiết lập lại các trường ( MAIL, GOOGLE, FACEBOOK, APP_URL ,...)

*Cách 2: Copy folder gốc vào thư mục www của Wamp. ví dụ: 'C:\wamp64\www'

* Demo chức năng login Facebook cần:
	1.Download cacert.pem từ link https://curl.haxx.se/ca/cacert.pem để vào thư mục C:\wamp64\bin\php\php5.6.40 ( nếu bạn dùng version khác thì hãy theo folder tương ứng)
	2. Mở file php.ini => tìm ";curl.cainfo=" gõ thành => curl.cainfo="/path/to/downloaded/cacert.pem"
	3. Restart lại wamp nhé
	Tài khoản demo Facebook : 
	dinh_kpxjvyz_manh@tfbnw.net LVTN2020
	nguoi_ytlokho_moi@tfbnw.net	LVTN1998
#Lưu ý: Khi kết nối, web sẽ trả về dạng kết nối không an toàn. Bạn chỉ cần bỏ chữ 's' trong đầu link "https" sang "http"

#Lưu ý: mở file .env => fix trường GOOGLE_REDIRECT và FACEBOOK_REDIRECT theo link của mình để sử dụng được chức năng liên kết Google và Facebook

*có thể tạo random Database bằng cách:
mở cmd ngay folder project. Vd: blog chứa public,resources,app,.... => C:\wamp64\www\blog gõ 'php artisan migrate:reset' => 'php artisan migrate' => 'php artisan db:seed'
#Lưu ý: phải cài đặt Composer mới có thể dùng lệnh đó

*Cài đặt Database:
Bước 1 : tạo db tên: lvtn. Sau đó nạp file CSDL vào
Bước 2 : vào file .env kiểm tra xem trường DB_DATABASE, DB_USERNAME, DB_PASSWORD có đúng không?

*Nên sửa trường APP_URL trong file .env theo link đang sử dụng

#Lưu ý: Nếu hệ thống có sự cố. Bạn hãy thử mở cửa số CMD ngay folder gốc và gõ 'php artisan config:cache' => 'php artisan config:clear' => ''php artisan cache:clear'
để clear bộ nhớ tạm bạn nhé!. Hoặc có thể gõ 'composer dump-autoload'!