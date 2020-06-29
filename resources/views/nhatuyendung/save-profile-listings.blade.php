@extends('ntd_layouts.master')
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
        @if(!empty($profile_list))
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
        <!-- <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-7 Of 43,167 Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Prev</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Next</a>
            </div>
          </div>
        </div>   -->
        @else
          Không có tin nào cả!
        @endif  
      </div>
    </section>
@endsection