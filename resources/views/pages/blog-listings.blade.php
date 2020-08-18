@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách Blog</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Quản lý Blog</strong> /</span>
              
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
        	<div class="col-lg-8">
        	<table class="table table-striped">
        		<thead>
        			<tr style="font-weight: bold;">
        				<td>Tiêu đề</td>        				
        				<td>Hình</td>
        				<td>Ngày tạo</td>
        				<td>Trạng thái</td>
        				<td>Thao tác</td>        				
        			</tr>
        		</thead>

        		<tbody>
        			@foreach($blog_list as $blog)
        			<tr>
        				<td>{{$blog->tieude}}</td>        				
        				<td>
        					<img src="{{asset('/blog_images/'.$blog->hinh)}}" alt="" style="width: 150px; height: 100px">
        					
        				</td>
        				<td>{{date('d-m-Y',strtotime($blog->created_at))}}</td>
        				<td>
        					@if($blog->trangthai == 0)
        					<span class="badge badge-danger">Chờ duyệt</span>
        					@else
        					<span class="badge badge-success">Đã duyệt</span>
        					@endif
        				</td>
        				<td><a href="{{url('/update-blog',$blog->id)}}">Cập nhật</a></td>
        			</tr>
        			@endforeach
        		</tbody>

        	</table>
             @include('layouts.paginating',['job_listings' => $blog_list])
			</div>
        </div>
      </div>
    </section>
@endsection