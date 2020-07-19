﻿@extends('admins.layouts.master')
@section('content')
 <!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Danh sách tin tuyển dụng</h4>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{session('success')}} <a href="#" class="alert-link">Alert Link</a>.
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
                            <h4 class="m-b-30 m-t-0">Danh sách tin tuyển dụng
                                <a href="{{url('/administrators/tin-tuyen-dung/clear')}}"><button class="btn btn-danger float-right">Xoá tin đã hết hạn</button></a>
                            </h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ngành</th>
                                                <th>Bằng cấp</th>
                                                <th>Mức lương</th>
                                                <th>Khu vực</th>
                                                <th>Hạn tuyển dụng</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($job_list as $job)
                                            <tr>
                                                <td>{{$job->id}}</td>
                                                <td>{{$job->nganh}}</td>
                                                <td>{{$job->bangcap}}</td>
                                                <td>{{$job->mucluong}}</td>
                                                <td>{{$job->tinhthanhpho}}</td>
                                                <td>{{$job->hantuyendung}}</td>
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
                    @include('admins.layouts.paginating',['job_listings' => $job_list])
                </div>

            </div> <!-- End row -->

        </div><!-- container-fluid -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
@endsection