@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách hồ sơ đã lưu</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Hồ sơ đã lưu</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section services-section bg-light block__62849" id="next-section">
      <div class="container">
        @if($profile_list->total() != 0)
        <h2 class="section-title mb-2">Bạn đang theo dõi {{$profile_list->total()}} mẫu hồ sơ </h2>
        <div class="row">
          @foreach($profile_list as $profile)
          <div class="col-6 col-md-6 col-lg-4 mb-4 mb-lg-5">

            <a href="{{route('detailPf',$profile->id)}}" class="block__16443 text-center d-block">
              <span class="custom-icon mx-auto"><span class="icon-file-text d-block"></span></span>
              <h3>{{$profile->hoten}}</h3>
              <p>{{$profile->nganh}}</p>
              <p>{{$profile->khuvuc}}</p>
              <p>{{date('d/m/Y',strtotime($profile->created_at))}}</p>
            </a>

          </div>
          @endforeach          
        </div>    
        
        <!-- Phân trang chưa truyền biến dc :( -->
          @include('layouts.paginating',['job_listings' => $profile_list])  
        @else
          <h4 class="section-title mb-2">Bạn chưa theo dõi <a href="{{url('/nhatuyendung/danh-sach-ho-so')}}">hồ sơ</a> nào cả! Hãy xem <a href="{{url('/nhatuyendung/danh-sach-ho-so')}}">hồ sơ</a> công khai  của người tìm việc để tìm kiếm nhân lực phù hợp và nhanh chóng bạn nhé!</h4>
        @endif  
      </div>
    </section>
@endsection