@extends('admins.layouts.master')
@section('content')
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

        <div class="page-content-wrapper">                    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">                     
                        <div class="card">
                            @if(!empty($blog_list))
                            <div class="card-body">
                                <h4 class="m-b-30 m-t-0">
                                    Danh sách bài viết (Tổng cộng có {{$blog_list->count()}} bài viết)                                 
                                </h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Phụ đề</th>
                                        <th>Hình</th>                                        
                                        <th>Ngày tạo</th>
                                        <th>Ngày xử lý</th>
                                        <th>Trạng thái xử lý</th>
                                        <th>Thao tác</th>
                                        <th>Nội dung</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blog_list as $blog)
                                    <tr>
                                        <td>{{$blog->id}}</td>
                                        <td>{{$blog->tieude}}</td>
                                        <td>{{$blog->phude}}</td>
                                        <td>
                                            <img src="{{asset('blog_images/'.$blog->hinh)}}" alt="Blog Image" style="width: 150px; height: 100px">
                                        </td>               
                                        <td>{{time_elapsed_string($blog->created_at)}}</td>
                                        <td>{{time_elapsed_string($blog->updated_at)}}</td>
                                        <td>
                                            @if($blog->ad_pheduyet == 0) <span class="badge badge-danger">Chưa duyệt</span>
                                            @else <span class="badge badge-success">Đã duyệt</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($blog->ad_pheduyet == 0)
                                            <a class="text-danger" href="{{url('administrators/bai-viet/phe-duyet',$blog->id)}}">Phê duyệt</a></br>
                                            @endif
                                            <a target="_blank" href="{{url('administrators/bai-viet/ds-binh-luan',$blog->id)}}">DS bình luận</a>
                                        </td>
                                        <td>{!! nl2br($blog->noidung) !!}</td>                      
                                    </tr>  
                                    @endforeach
                                               
                                    </tbody>
                                </table>
                            </div>
                            @else <h4>Không có bài viết nào cả!</h4>
                            @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection