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
                                                <th>Quyền</th>                                  
                                                <th>ID nhân viên</th>
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>                 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td>1</td>
                                            	<td>Lương Thành</td>
                                            	<td>luongthanh@gmail.com</td>
                                            	<td>2</td>
                                            	<td>3</td>
                                            	<td>30/05/2020</td>
                                            	<td></td>
                                            </tr>             
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