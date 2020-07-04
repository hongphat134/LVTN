@extends('admins.layouts.master')
@section('content')
 <!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Blank Page</h4>            
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Danh sách thông tin liên hệ</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>                                 
                                                <th>Email</th>
                                                <th>Loại tài khoản</th>
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
                                                <td>{{$user->loaitk == 0 ? 'Người tìm việc' : 'Nhà tuyển dụng'}}</td>
                                                <td>{{$user->theodoi}}</td>
                                                <td>
                                                    {{$user->provider != '' ? $user->provider : 'Không'}}
                                                </td>
                                                <td>{{$user->verified}}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End row -->

        </div><!-- container-fluid -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
@endsection