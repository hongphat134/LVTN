@extends('admins.layouts.master')
@section('content')
 <!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Phê duyệt hồ sơ ứng tuyển</h4>
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
                            <h4 class="m-b-30 m-t-0">Danh sách hồ sơ ứng tuyển</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>ID job</th>
                                                <th>Họ tên</th>                                 
                                                <th>Bằng cấp cao nhất</th>
                                                <th>Cấp bậc cao nhất</th>
                                                <th>Kinh nghiệm</th>
                                                <th>Khu vực</th>
                                                <th>Email liên hệ</th>
                                                <th>Phê duyệt</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($profile_list as $profile)
                                            <tr>
                                                <td>{{$profile->idTTD}}</td>
                                                <td>{{$profile->hoten}}</td>
                                                <td>{{$profile->bangcap}}</td>
                                                <td>{{$profile->capbac}}</td>
                                                <td>{{$profile->kinhnghiem}}</td>
                                                <td>{{$profile->khuvuc}}</td>
                                                <td>{{$profile->emaillienhe}}</td>
                                                <td>
                                                    <a href="{{url('/administrators/ho-so/ung-tuyen',[$profile->idTTD,$profile->idUser])}}">
                                                        <button class="btn-small btn-primary">
                                                            Tán thành
                                                        </button>
                                                    </a>
                                                </td>
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
                    @include('admins.layouts.paginating',['job_listings' => $profile_list])
                </div>
            </div> <!-- End row -->

        </div><!-- container-fluid -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
@endsection