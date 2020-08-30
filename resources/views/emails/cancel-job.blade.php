@component('mail::message')
# Thông báo

Xin chào,<br>
Nhà tuyển dụng <a href="{{config('app.url')}}/thong-tin-ntd/{{$idUser}}">"{{$ten}}"</a> đã tạm ngừng tuyển dụng với vị trí tuyển dụng "{{$vitri}}" của họ, Xin bạn thông cảm nhé!

Còn có rất nhiều cơ hội tìm kiếm việc làm dành cho bạn tại
@component('mail::button', ['url' => config('app.url'), 'color' => 'red'])
Website tìm kiếm việc làm HTP
@endcomponent

Cảm ơn bạn đã tin tưởng và lựa chọn website tuyển dụng {{config('app.url')}}. Chúc bạn sớm tìm được ứng viên phù hợp.<br>
Nếu bạn cần hỗ trợ, vui lòng liên hệ tới email {{config('mail.username')}} hoặc gọi tới hotline Miền Nam: (028) 5407 0399 và Miền Bắc: (093) 8922 315.<br>
<strong>{{ config('app.name') }}</strong> chúc bạn sớm tìm được công việc phù hợp!
@endcomponent