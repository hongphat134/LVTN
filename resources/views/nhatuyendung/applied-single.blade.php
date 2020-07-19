@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông tin hồ sơ xin việc</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông tin hồ sơ xin việc</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mr-auto">
            <div class="border p-3 rounded">
              <ul class="list-unstyled block__47528 mb-0">
                <li><span class="active"><h3>{{$profile->nganh}}</h3></span></li>
                <li>Họ & tên: <a href="#">{{$profile->hoten}}</a></li>
                <li>Email: <a href="#">{{$profile->emaillienhe}}</a></li>
                <li>Khu vực: <a href="#">{{$profile->khuvuc}}</a></li>
                <li>Hôn nhân: <a href="#">{{$profile->honnhan}}</a></li>
                <li>Hình thức: <a href="#">{{$profile->trangthailv}}</a></li>
                <li>Bằng cấp: <a href="#">{{$profile->bangcap}}</a></li>
                <li>Cấp bậc: <a href="#">{{$profile->capbac}}</a></li>
                <li>Kinh Nghiệm: <a href="#">{{$profile->kinhnghiem}}</a></li>                              
              </ul>
            </div>
          </div>
          <div class="col-lg-8">
            <span class="text-primary d-block mb-5">
              <span class="icon-search display-1"></span>
              <span class="icon-star display-1"></span>
              <span class="icon-files-o display-1"></span>
              <span class="icon-file-text-o display-1"></span>
              <span class="icon-file-text display-1"></span>
              <span class="icon-file display-1"></span>
              <span class="icon-file-word-o display-1"></span>
              <span class="icon-insert_drive_file display-1"></span>
            </span>
            
            <h2 class="mb-4">Mục tiêu</h2>
            <p>
              {!! nl2br($profile->muctieu) !!}
            </p>           
            <h2 class="mb-4">Trình độ ngoại ngữ</h2>
            <p>
              @if($profile->ngoaingu)              
              @foreach(json_decode($profile->ngoaingu) as $language)
              {{$language}} <strong>&</strong>
              @endforeach
              @else
                Chưa có ngoại ngữ!
              @endif
            </p>           
            <h2 class="mb-4">Trình độ tin học</h2>
            <p>
              @if($profile->tinhoc)
              @foreach(json_decode($profile->tinhoc) as $itech)
              {{$itech}} <strong>&</strong>
              @endforeach
              @else
                Không có!
              @endif
            </p>     
            <h2 class="mb-4">Sở trường</h2>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p> <-->
            <p>
              {!! nl2br($profile->sotruong) !!}
            </p>            
            <p>
              <a href="#" class="btn btn-primary btn-md mt-4">{{$profile->created_at}}</a>
              <a href="#" class="btn btn-danger btn-md mt-4">Ứng tuyển</a>
            </p>

          </div>
        </div>
      </div>
    </section>
@endsection