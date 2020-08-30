@component('mail::message')
# Thông báo

Xin chào,<br>
Nhà tuyển dụng <a href="{{config('app.url')}}/thong-tin-ntd/{{$idUser}}">"{{$ten}}"</a> ngỏ ý đến hồ sơ đăng công khai của bạn phù hợp với vị trí tuyển dụng <a href="{{config('app.url')}}/tin-tuyen-dung/{{$id_ttd}}">"{{$vitri}}"</a> của họ, nếu có nhu cầu thì bạn hãy nhanh chóng ứng tuyển bạn nhé!

Bạn vui lòng xem chi tiết tại
@component('mail::button', ['url' => config('app.url').'/tin-tuyen-dung/'.$id_ttd, 'color' => 'blue'])
Thông tin tuyển dụng
@endcomponent

Cảm ơn bạn đã tin tưởng và lựa chọn website tuyển dụng {{config('app.url')}}. Chúc bạn sớm tìm được ứng viên phù hợp.<br>
Nếu bạn cần hỗ trợ, vui lòng liên hệ tới email {{config('mail.username')}} hoặc gọi tới hotline Miền Nam: (028) 5407 0399 và Miền Bắc: (093) 8922 315.<br>
<strong>{{ config('app.name') }}</strong> chúc bạn sớm tìm được công việc phù hợp!
@endcomponent