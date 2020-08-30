@extends('admins.layouts.master')
@section('content')
<div class="content-page">
<!-- Start content -->
    <div class="content">

        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">Tin tuyển dụng</h4>
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
                            @if(!empty($job_list))
                            <div class="card-body">
                                <h4 class="m-b-30 m-t-0">
                                    Danh sách tin tuyển dụng (Tổng cộng có {{$job_list->count()}} tin) 
                                    <a href="{{url('/administrators/tin-tuyen-dung/clear')}}"><button class="btn btn-danger float-right">Xoá tin đã hết hạn</button></a>
                                </h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ngành tuyển dụng</th>
                                        <th>Mức lương</th>                                      
                                        <th>Trạng thái xử lý</th>
                                        <th>Khu vực</th>
                                        <th>Ngày đăng</th>
                                        <th>Thao tác</th>
                                        <th>Hạn tuyển dụng</th>
                                        <th>Mô tả công việc</th>
                                        <th>Quyền lợi</th>
                                        <th>Thông tin liên hệ</th>
                                        <th>Yêu cầu công việc</th>
                                        <th>Yêu cầu ngoại ngữ</th>
                                        <th>Yêu cầu tin học</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($job_list as $job)
                                    <tr>
                                        <td>{{$job->id}}</td>
                                        <td>{{$job->nganh}}</td>
                                        <td>{{$job->mucluong}}</td>
                                        <td>
                                            @if($job->ad_pheduyet == 0)
                                            <span class="badge badge-danger">Chưa xử lý</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach(json_decode($job->tinhthanhpho) as $city)
                                            <span class="badge badge-warning">{{$city}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{date('d/m/Y',strtotime($job->updated_at))}}</td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Quản lý
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{url('/administrators/tin-tuyen-dung/phe-duyet/'.$job->id)}}">Duyệt</a>
                                                <a class="dropdown-item" href="{{url('/administrators/tin-tuyen-dung/view-pdf',$job->id)}}" target="_blank">Xem PDF</a>
                                                <a class="dropdown-item" href="{{url('/administrators/tin-tuyen-dung/export-pdf',$job->id)}}" target="_blank">Xuất PDF</a>
                                              </div>
                                            </div>
                                        </td>
                                        <td>{{date('d/m/Y',strtotime($job->hantuyendung))}}</td>
                                        <td>                                                                <ul class="list-group">
                                            @if($job->motacv)
                                            @foreach(json_decode($job->motacv) as $des)
                                            <li class="list-group-item"><span class="badge badge-primary">{{$des}}</span></li>
                                            @endforeach
                                            @endif
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                            @if($job->quyenloi)
                                            @foreach(json_decode($job->quyenloi) as $benefit)
                                            <li class="list-group-item"><span class="badge badge-secondary">{{$benefit}}</span></li>
                                            @endforeach
                                            @endif
                                            </ul>
                                        </td>
                                        <td>
                                            {{$job->ttlienhe}}
                                        </td>   
                                        <td>{{$job->yeucau_cv}}</td>
                                        <td>
                                            {{$job->ngoaingu}}
                                        </td>
                                        <td>
                                            {{$job->tinhoc}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else <h4>Không có tin nào cả!</h4>
                            @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection