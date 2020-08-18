@extends('admins.layouts.master')
@section('content')
 <!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Danh sách bài viết</h4>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{session('success')}} <a href="#" class="alert-link">Alert Link</a>.
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{session('error')}} <a href="#" class="alert-link">Alert Link</a>.
            </div>
            @endif
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Danh sách bài viết</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tiêu đê</th>                                                                                 
                                                <th>Hình</th>
                                                <th>Nội dung</th>                                  
                                                <th>Trạng thái</th>
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>                 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($blog_list as $blog)
                                            <tr>
                                            	<td>{{$blog->id}}</td>
                                            	<td>{{$blog->tieude}}</td>
                                            	<td>
                                            		<img src="{{asset('blog_images/'.$blog->hinh)}}" alt="Blog Image" style="width: 150px; height: 100px">
                                            	</td>
                                            	<td>{{limit_description($blog->noidung)}}</td>
                                            	<td>
                                            		@if($blog->ad_pheduyet == 0) <span class="badge badge-danger">Chưa duyệt</span>
                                            		@else <span class="badge badge-success">Đã duyệt</span>
                                            		@endif
                                            	</td>
                                            	<td>{{time_elapsed_string($blog->created_at)}}</td>
                                            	<td>
                                            		<a href="{{url('administrators/bai-viet/phe-duyet',$blog->id)}}">Phê duyệt</a>
                                            		<a href="{{url('administrators/bai-viet/ds-binh-luan',$blog->id)}}">DS bình luận</a>
                                            	</td>                                            	
                                            </tr>  
                                            @endforeach
                                                       
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admins.layouts.paginating',['job_listings' => $blog_list])
                </div>
            </div> <!-- End row -->

        </div><!-- container-fluid -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
@endsection