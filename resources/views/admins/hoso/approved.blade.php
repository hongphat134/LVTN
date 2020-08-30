@extends('admins.layouts.master')
@section('content')


<div class="content-page">
<!-- Start content -->
    <div class="content">

        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">Phê duyệt mẫu hồ sơ</h4>
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
                            @if(!empty($profile_list))
                            <div class="card-body">
                                <h4 class="m-b-30 m-t-0">
                                    Danh sách mẫu hồ sơ (Tổng cộng có {{$profile_list->count()}} hồ sơ)                                 
                                </h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ tên</th>
                                        <th>Email liên hệ</th>                                      
                                        <th>SDT liên hệ</th>
                                        <th>Ngành nghề</th>                                     
                                        <th>Ngày đăng</th>
                                        <th>Trạng thái xử lý</th>
                                        <th>Thao tác</th>
                                        <th>Mục tiêu</th>                                  
                                        <th>Sở trường</th>
                                        <th>Thông tin thêm</th>
                                        <th>Ngoại ngữ</th>
                                        <th>Tin học</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($profile_list as $profile)
                                    <tr>
                                        <td>{{$profile->id}}</td>
                                        <td>{{$profile->hoten}}</td>
                                        <td>{{$profile->emaillienhe}}</td>
                                        <td>{{$profile->sdtlienhe}}</td>
                                        <td>{{$profile->nganh}}</td>
                                        <td>{{date('d/m/Y',strtotime($profile->updated_at))}}</td>
                                        <td>
                                            @if($profile->ad_pheduyet == 0)
                                            <span class="badge badge-danger">Chưa xử lý</span>      
                                            @endif
                                        </td>
                                        <td><a href="{{url('/administrators/ho-so/phe-duyet',$profile->id)}}"><button class="btn btn-white">Phê duyệt</button></a></td>
                                        <td>{!! nl2br($profile->muctieu) !!}</td>
                                        <td>{!! nl2br($profile->sotruong) !!}</td>
                                        <td>{!! nl2br($profile->thongtinthem) !!}</td>
                                        <td>
                                            @if($profile->ngoaingu)
                                            @foreach(json_decode($profile->ngoaingu) as $lang)
                                            {{$lang}} #
                                            @endforeach                                         
                                            @endif
                                        </td>
                                        <td>
                                            @if($profile->tinhoc)
                                            @foreach(json_decode($profile->tinhoc) as $itech)
                                            {{$itech}} #
                                            @endforeach                                         
                                            @endif
                                        </td>
                                    </tr>                                       
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else <h4>Không có mẫu hồ sơ nào cả!</h4>
                            @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection