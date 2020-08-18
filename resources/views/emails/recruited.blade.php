<pre>
chúng tôi đại diện cho nhà tuyển dụng {{$recruiter->ten}} gửi thông báo đến bạn! </br>
@if($status == 1) 
Bạn đã trúng ứng tuyển! Hãy vào {{config('app.url')}} để xem thêm chi tiết!
@else Rất tiếc, nhà tuyển dụng đã từ chối yêu cầu ứng tuyển! Bạn đừng buồn nhé! Hãy tìm kiếm công việc khác tại {{config('app.url')}}! Chúc bạn may mắn!
@endif
</br>
<label for="content">Nội dung:</label>
{{$content}}

</br>
Thông tin nhà tuyển dụng:
Địa chỉ: {{$recruiter->diachi}}, {{$recruiter->tinhthanhpho}}
Email liên hệ: {{$recruiter->email}}
SDT liên hệ: {{$recruiter->sdt}}
</pre>