<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Mẫu hồ sơ xin việc của {{$profile->hoten}}</title>
	<!-- <link rel="stylesheet" href="{{asset('css/custom-bs.css')}}"> -->
      
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
	<style>
		*{
			font-family: DejaVu Sans;			
		}
		table{
			width: 100%;	
			text-align: center;		
		}
		td:first-child{
			background-color: #EECFC4;
		}
	</style>
</head>
<body>	
	<h1 style="text-align: center;">Hồ sơ xin việc</h1>
	<div class="container">		
		<table border="1">
			<tr>
				<td>Họ tên</td>
				<td>{{$profile->hoten}}</td>
			</tr>
			<tr>
				<td>Email liên hệ</td>
				<td>{{$profile->emaillienhe}}</td>
			</tr>
			<tr>
				<td>Ngành nghề</td>
				<td>{{$profile->nganh}}</td>
			</tr>
			<tr>
				<td>Kĩ năng</td>
				<td>
					@foreach($profile->kinang as $skill)
						{{$skill->ten}} /
					@endforeach					
				</td>
			</tr>
			<tr>
				<td>Khu vực</td>
				<td>{{$profile->khuvuc}}</td>
			</tr>
			<tr>
				<td>Tình trạng hôn nhân</td>
				<td>{{$profile->honnhan}}</td>
			</tr>
			<tr>
				<td>Hình thức làm việc</td>
				<td>{{$profile->trangthailv}}</td>
			</tr>
			<tr>
				<td>Bằng cấp cao nhất</td>
				<td>{{$profile->bangcap}}</td>
			</tr>
			<tr>
				<td>Cấp bậc cao nhất</td>
				<td>{{$profile->capbac}}</td>
			</tr>
			<tr>
				<td>Kinh nghiệm</td>
				<td>{{$profile->kinhnghiem}}</td>
			</tr>
			<tr>
				<td>Ngoại ngữ</td>
				<td>
					@if($profile->ngoaingu)
						@foreach(json_decode($profile->ngoaingu) as $language)
						{{$language}} &
						@endforeach
					@endif					
				</td>
			</tr>
			<tr>
				<td>Tin học</td>
				<td>
					@if($profile->tinhoc)
						@foreach(json_decode($profile->tinhoc) as $itech)
						{{$itech}} $
						@endforeach
					@endif	
				</td>
			</tr>
			<tr>
				<td>Mục tiêu</td>
				<td>{{$profile->muctieu}}</td>
			</tr>
			<tr>
				<td>Sở trường</td>
				<td>{{$profile->sotruong}}</td>
			</tr>
		</table>		
	</div>
</body>
</html>