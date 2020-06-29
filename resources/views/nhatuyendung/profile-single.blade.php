@extends('ntd_layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông tin hồ sơ</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông tin hồ sơ</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mr-auto">
            <div class="border p-4 rounded">
          	<ul class="list-unstyled block__47528 mb-0">
                <li><span class="active"><h3>{{$profile->nganh}}</h3></span></li>
                <li>Email liên hệ: <a href="#">{{$profile->emaillienhe}}</a></li>
                <li>Khu vực sinh sống: <a href="#">{{$profile->khuvuc}}</a></li>
                <li>Tình trạng hôn nhân: <a href="#">{{$profile->honnhan}}</a></li>
                <li>Hình thức mong muốn: <a href="#">{{$profile->trangthailv}}</a></li>
                <li>Bằng cấp cao nhất: <a href="#">{{$profile->bangcap}}</a></li>
                <li>Cấp bậc cao nhất: <a href="#">{{$profile->capbac}}</a></li>
                <li>Kinh Nghiệm: <a href="#">{{$profile->kinhnghiem}}</a></li>
    		</ul>
            </div>
          </div>
          <div class="col-lg-8">
            <span class="text-primary d-block mb-5">
              <div class="thumbnail">
                <img src="{{url('hinhdaidien/'.$profile->hinh)}}" alt="Không có hình" class="img-thumbnail img-responsive">
                <div class="caption">
                  <p>Ảnh đại diện</p>
                </div>
              </div>
            </span>
            <h2 class="mb-4">Mục tiêu</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Trình độ ngoại ngữ</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Trình độ tin học</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Sở trường</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <p>              
              <a href="#" class="btn btn-primary btn-md mt-4">
              Ngày cập nhật: {{ date('d/m/Y',strtotime($profile->updated_at))}}
              </a>
              @if(in_array($profile->id,json_decode(Auth::user()->theodoi)))
              <a id="{{$profile->id}}" href="javascript:void(0)" class="btn btn-danger btn-md mt-4 save-profile active">
                Đã lưu hồ sơ
              </a>
              @else
              <a id="{{$profile->id}}" href="javascript:void(0)" class="btn btn-danger btn-md mt-4 save-profile">
                Lưu hồ sơ xin việc
              </a>
              @endif
            </p>
          </div>
        </div>
      </div>
    </section>
    <script src="{{url('ajax/save-profile.js')}}"></script>
@endsection