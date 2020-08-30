<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
	<h1 style="text-align: center;">Hồ sơ xin việc</h1>	
	<div class="container">		
		<table border="1">
			<tr>
				<td>Hình đại diện</td>
				<td>
					@if($profile->hinh)
					<img src="{{asset('hinhdaidien/'.$profile->hinh)}}" alt="{{$profile->hinh}}" style="width: 150px; height: 150px">
					@else
					<img src="{{asset('hinhdaidien/default.png')}}" alt="{{$profile->hinh}}">
					@endif
				</td>
			</tr>
			<tr>
				<td>Họ tên</td>
				<td>{{$profile->hoten}}</td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td>{{date('d/m/Y',strtotime($profile->ngaysinh))}}</td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td>{{$profile->gioitinh}}</td>
			</tr>
			<tr>
				<td>Email liên hệ</td>
				<td>{{$profile->emaillienhe}}</td>
			</tr>
			<tr>
				<td>SDT liên hệ</td>
				<td>{{$profile->sdtlienhe}}</td>
			</tr>
			<tr>
				<td>Ngành nghề</td>
				<td>{{$profile->nganh}}</td>
			</tr>
			<tr>
				<td>Kĩ năng</td>
				<td>
					@foreach(json_decode($profile->kinang) as $skill)
						{{$skill}} /
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
				<td>{{$profile->hinhthuc_lv}}</td>
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
				<td>Mức lương mong muốn</td>
				<td style="background-color: brown; color:lavender">{{$profile->mucluongmm}}</td>
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
				<td>{!! nl2br($profile->muctieu) !!}</td>
			</tr>
			<tr>
				<td>Sở trường</td>
				<td>{!! nl2br($profile->muctieu) !!}</td>
			</tr>
			<tr>
				<td>Thông tin thêm</td>
				<td>{!! nl2br($profile->thongtinthem) !!}</td>
			</tr>
		</table>		
	</div>
</body>
</html>