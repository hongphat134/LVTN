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
                                                <th>ID Blog</th>
                                                <th>ID User</th>
                                                <th>Nội dung</th>                                  
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>                 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cmt_list as $cmt)
                                            <tr>
                                            	<td>{{$cmt->id}}</td>
                                            	<td>{{$cmt->idBlog}}</td>
                                            	<td>{{$cmt->idUser}}</td>                                          
                                            	<td>{{limit_description($cmt->noidung)}}</td>                                            	
                                            	<td>{{time_elapsed_string($cmt->created_at)}}</td>
                                            	<td>                                            		
                                            		<a href="{{url('/administrators/bai-viet/xoa-binh-luan',$cmt->id)}}">Xoá</a>
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
                    @include('admins.layouts.paginating',['job_listings' => $cmt_list])
                </div>
            </div> <!-- End row -->

        </div><!-- container-fluid -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
@endsection