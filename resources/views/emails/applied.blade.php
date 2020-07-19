@component('mail::message')
# Thông báo

Xin chào, bạn có 1 hồ sơ xin việc mới.

@component('mail::button', ['url' => 'http://lvtn.laravel.info/nhatuyendung/applied-profile-list', 'color' => 'green'])
Xem ngay
@endcomponent

Cảm ơn đã sử dụng dịch vụ của chúng tôi,<br>
{{ config('app.name') }}
@endcomponent
