@component('mail::message')
# Thông báo

Xin chào,<br>
Bạn đang có 1 hồ sơ ứng tuyển mới từ **Ứng viên** trên website *{{config('app.url')}}*.

Bạn vui lòng xem chi tiết tại
@component('mail::button', ['url' => config('app.url').'/nhatuyendung/applied-profile-list', 'color' => 'green'])
Quản lý hồ sơ
@endcomponent

Cảm ơn bạn đã tin tưởng và lựa chọn website tuyển dụng {{config('app.url')}}. Chúc bạn sớm tìm được ứng viên phù hợp.<br>
Nếu bạn cần hỗ trợ, vui lòng liên hệ tới email {{config('mail.username')}} hoặc gọi tới hotline Miền Nam: (028) 5407 0399 và Miền Bắc: (093) 8922 315.<br>
<strong>{{ config('app.name') }}</strong> chúc bạn sớm tìm được đủ nhân lực.
@endcomponent
