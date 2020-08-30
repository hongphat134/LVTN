@extends('admins.layouts.master')
@section('content')
<div class="content-page">
<!-- Start content -->
    <div class="content">

        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">Danh sách nhà tuyển dụng</h4>
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
                            @if(!empty($user_list))
                            <div class="card-body">
                                <h4 class="m-b-30 m-t-0">
                                    Danh sách nhà tuyển dụng (Tổng cộng có {{$user_list->count()}} tài khoản)                                 
                                </h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                       <th>ID</th>
                                        <th>Tên</th>                                 
                                        <th>Email</th>
                                        <th>Theo dõi</th>
                                        <th>Liên kết</th>
                                        <th>Xác thực</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Thao tác</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_list as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->ten}}</td>
                                        <td>{{$user->email}}</td>                                        
                                        <td>{{$user->theodoi}}</td>
                                        <td>
                                            {{$user->provider != '' ? $user->provider : 'Không'}}
                                        </td>
                                        <td>
                                            @if($user->verified == 1) <span class="badge badge-success">Đã xác thực</span>
                                            @else <span class="badge badge-danger">Chưa xác thực</span>
                                            @endif
                                        </td>
                                        <td>{{date('d/m/Y',strtotime($user->created_at))}}</td>
                                        <td>{{date('d/m/Y',strtotime($user->updated_at))}}</td>
                                        <td>
                                            <a href="#"><i class="mdi mdi-table-search"></i></a>
                                            <a href="#"><i class="mdi mdi-delete-circle"></i></a>
                                            <a href="#"><i class="mdi mdi-calendar-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            @else <h4>Không có bình luận nào cả!</h4>
                            @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection