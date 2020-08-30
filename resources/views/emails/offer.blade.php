<pre>
Chào bạn, {{$ntv->ten}}!
Nhà tuyển dụng <a href="{{config('app.url')}}/thong-tin-ntd/{{$ntd->id}}">{{$ntd->ten}}</a> đã ngỏ ý đến hồ sơ mà bạn công khai!

<label for="content">Nội dung gửi:</label>
{{$content}}

Cảm ơn bạn đã tin tưởng và lựa chọn website tuyển dụng {{config('app.url')}}. Chúc bạn sớm tìm được việc làm như mong muốn.
Nếu bạn cần hỗ trợ, vui lòng liên hệ tới email {{config('mail.username')}} hoặc gọi tới hotline Miền Nam: (028) 5407 0399 và Miền Bắc: (093) 8922 315.
<strong>{{ config('app.name') }}</strong> chúc bạn sớm tìm được công việc như ý.
</pre>