<!DOCTYPE html>
<html lang="en">
<head>
	<title>HTP &mdash; My Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
    <link rel="shortcut icon" href="{{url('favicon.png')}}">
	<style>
		label{
			text-align: center;
			font-size: 150%;
		}
		table{
			width: 100%;
		}
		th,td{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<label for="Title"><h2>Hồ sơ xin việc</h2></label>
		<table border=2>			
			<thead>
				<tr>
					<th>Họ tên</th>
					<th>Email liên hệ</th>
					<th>Ngành</th>
					<th>Khu vực</th>
					<th>Bằng cấp</th>
				</tr>
			</thead>
			<tbody>				
				<tr>
					<td>{{$profile->hoten}}</td>
					<td>{{$profile->emaillienhe}}</td>
					<td>{{$profile->nganh}}</td>
					<td>{{$profile->khuvuc}}</td>
					<td>{{$profile->bangcap}}</td>
				</tr>				
			</tbody>
		</table>
	</div>
</body>
</html>