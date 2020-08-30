<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Thông tin tuyển dụng <h3></h3></title>
      
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
	<style>
		*{
			font-family: DejaVu Sans;
		}		
	</style>
</head>
<body>	
	<h1 style="text-align: center;">Thông tin tuyển dụng (ID: {{$job->id}} )</h1>
	<div class="container">
		<div>
			Kĩ năng:
			@foreach(json_decode($job->kinang) as $skill)
			{{$skill}} &
			@endforeach
		</div>
		<div>
			Ngành: {{$job->nganh}}
		</div>
		<div>
			Mức lương: {{$job->mucluong}}
		</div>
		<div>
			Số lượng cần tuyển: {{$job->soluong}}
		</div>
		<div>
			Bằng cấp yêu cầu: {{$job->bangcap}}
		</div>	
		<div>
			Cấp bậc yêu cầu: {{$job->capbac}}
		</div>
		<div>
			Hình thức làm việc: {{$job->hinhthuc_lv}}
		</div>		
		<div>
			Khu vực làm việc:
			@foreach(json_decode($job->tinhthanhpho) as $city)
			{{$city}} $
			@endforeach
		</div>
		<div>
			Yêu cầu giới tính: {{$job->gioitinh}}
		</div>
		<div>
			Yêu cầu kinh nghiệm: {{$job->kinhnghiem}}
		</div>
		<div>
			Thời gian thử việc : {{$job->tg_thuviec}}
		</div>
		<div>
			Hạn tuyển dụng: {{$job->hantuyendung}}
		</div>
		<div>
			Lượt xem: {{$job->luotxem}}
		</div>
		@if($job->ttlienhe)
		<div>
			<pre>
			Thông tin liên hệ:
			@foreach(json_decode($job->ttlienhe) as $des)
			{{$des}}
			@endforeach
			</pre>
		</div>
		@endif

		@if($job->ngoaingu)
		<div>
			<pre>
			Yêu cầu ngoại ngữ:
			@foreach(json_decode($job->ngoaingu) as $lang)
			{{$lang}}
			@endforeach
			</pre>
		</div>
		@endif

		@if($job->tinhoc)
		<div>
			<pre>
			Yêu cầu trình độ tin học:
			@foreach(json_decode($job->tinhoc) as $itech)
			{{$itech}}
			@endforeach
			</pre>
		</div>
		@endif
		<div>
			Quyền lợi: {!! nl2br($job->quyenloi) !!}
		</div>
		<div>
			Mô tả công việc: {!! nl2br($job->motacv) !!}
		</div>
		<div>
			Yêu cầu thêm: {!! nl2br($job->yeucau_cv) !!}
		</div>
		<div>
			Ngày tạo: {{$job->created_at}}
		</div>
		<div>
			Ngày cập nhật: {{$job->updated_at}}
		</div>
	</div>	
</body>
</html>