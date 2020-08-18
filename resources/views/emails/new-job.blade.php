@component('mail::message')
# Thông báo

Xin chào,<br>
Bạn đang có 1 việc làm mới từ những Nhà tuyển dụng mà bạn đã theo dõi trên website {{config('app.url')}}.

@component('mail::table')
| Nhà tuyển dụng   |  Số việc làm   |
| ---------------- |:---------------|
|  {{$ten}}  	   |	{{$count}}  |
@endcomponent

Bạn có thể điều chỉnh việc theo dõi tại 
@component('mail::button', ['url' => config('app.url').'/nguoitimviec/theo-doi-ntd', 'color' => 'red'])
Nhà tuyển dụng đã theo dõi
@endcomponent

Cảm ơn bạn đã tin tưởng và lựa chọn website tuyển dụng {{config('app.url')}}. Chúc bạn sớm tìm được việc làm như mong muốn.<br>
Nếu bạn cần hỗ trợ, vui lòng liên hệ tới email {{config('mail.username')}} hoặc gọi tới hotline Miền Nam: (028) 5407 0399 và Miền Bắc: (093) 8922 315.<br>
<strong>{{ config('app.name') }}</strong> chúc bạn sớm tìm được công việc như ý.
@endcomponent
