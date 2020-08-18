@extends('layouts.master')
@section('content')
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Danh sách hồ sơ xin việc</h1>
        <div class="custom-breadcrumbs">
          <a href="#">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Hồ sơ xin việc</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>
    
<section class="site-section services-section bg-light block__62849" id="next-section">
  <div class="container">            
      <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
             <span class="icon-group_add mr-2"></span>Danh sách hồ sơ chờ phê duyệt <span class="icon-group_add">
            </h2>
          </div>
        </div>      
      @if($job_listings->total() != 0)
      <form action="{{route('recruit')}}">
      <table class="table table-hover table-responsive">
        <thead style="font-weight: bold">
        <tr>
          <td>Vị trí tuyển dụng</td>
          <td>Số lượng cần tuyển</td>                                  
          <td>Chờ duyệt</td>         
          <td>Đã xử lý</td>         
          <td>Ngày đăng</td>
          <td>Hạn tuyển dụng</td>
          <td>Trạng thái</td>
          <td>Thao tác</td>          
        </tr>
        </thead>          
        <tbody>
        @foreach($job_listings as $job)
        <tr>
          <td>{{$job->nganh}}</td>
          <td>{{$job->soluong}} người</td>          
          <td>{{$job->hschoduyet}} hồ sơ</td> 
          <td>{{$job->hsdaxuly}} hồ sơ</td> 
          <td>{{date('d/m/Y',strtotime($job->updated_at))}}</td>
          <td>{{date('d/m/Y',strtotime($job->hantuyendung))}}</td>          
          <td>
            @if($job->congkhai == 0) <span class="badge badge-danger">Chờ duyệt</span>
            @else <span class="badge badge-success">Đã duyệt</span>
            @endif
          </td>
          <td>
            <!-- Example split danger button -->
  <div class="btn-group">
    <button type="button" class="btn btn-info">Quản lý</button>
    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
    @if($job->congkhai == 1)
    <a class="dropdown-item" target="_blank" href="{{url('/nhatuyendung/ho-so-cho-duyet',$job->id)}}">Xem hồ sơ chờ duyệt</a>
    <a class="dropdown-item" target="_blank" href="{{url('/nhatuyendung/ho-so-da-xu-ly',$job->id)}}">Xem hồ sơ đã xử lý</a>        
    @else
    <a class="dropdown-item" target="_blank" href="{{route('updateJob',$job->id)}}">Cập nhật</a>
    <a class="dropdown-item" target="_blank" href="{{url('/delete-job',$job->id)}}">Xoá</a>
    @endif
  </div>
  </div>             
          </td>               
        </tr>          
        @endforeach
        </tbody>        
      </table>
              
      @include('layouts.paginating')
      @else
      Bạn chưa <a href="{{url('/nhatuyendung/post-job')}}">đăng tin</a> tuyển dụng nào cả! <a href="{{url('/nhatuyendung/post-job')}}">Đăng tin tuyển dụng</a> để nhanh chóng tìm kiếm được nhân lực bạn nhé!
      @endif 
    </div>   
  </div>
</section>

@endsection