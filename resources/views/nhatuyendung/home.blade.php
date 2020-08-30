@include('layouts.header')
    <!-- MENU -->
    @include('ntd_layouts.menu')
    <!-- SEARCH -->
    @include('ntd_layouts.search')          

    <!-- HOME -->
    <section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-white">THỐNG KÊ</h2>
            <!-- <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p> -->
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="1930">0</strong>
            </div>
            <span class="caption">Ứng viên</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="54">0</strong>
            </div>
            <span class="caption">Công việc</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="120">0</strong>
            </div>
            <span class="caption">Công việc đã đầy</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="550">0</strong>
            </div>
            <span class="caption">Công ty</span>
          </div>            
        </div>
      </div>
    </section>

    
    <section class="site-section" id="content">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            @if($profile_list->count() == 0)
            <h2 class="section-title mb-2">Hiện tại không có hồ sơ tìm việc nào cả!</h2>
            @else
            <h2 class="section-title mb-2"><span class="icon-person_add mr-2"></span>Hồ sơ tìm việc của những ứng viên <span class="icon-person_add"></span></h2>
            @endif
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($profile_list as $profile)          
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">             
            <a target="_blank" href="{{route('detailPf',$profile->id)}}"></a>
            <div class="job-listing-logo">
               
    @if($profile->hinh)
    <img src="{{url('hinhdaidien/'.$profile->hinh)}}" alt="{{$profile->hinh}}" class="img-fluid" style="width: 150px; height: 150px !important;">
    @else  
    <img src="{{url('hinhdaidien/default.png')}}" alt="Hình mặc định" class="img-fluid" style="width: 150px; height: 150px !important;">
    @endif
     
              
            </div>
            <div class="ribbon-wrapper">
              <div class="ribbon red">Hot</div>
            </div>
            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$profile->nganh}} (<span class="text-info">{{$profile->kinhnghiem}}</span>)</h2>

                Họ tên: <strong>{{$profile->hoten}}</strong> - Giới tính: <strong>{{$profile->gioitinh}}</strong></br>
                Trình độ: <strong>{{$profile->bangcap}}</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> {{$profile->khuvuc}}
              </div>
              <div class="job-listing-meta">
                @if($profile->sdtlienhe)
                <span class="badge badge-dark">SDT liên hệ: {{$profile->sdtlienhe}}</span></br>
                @endif
                <span class="badge badge-primary">Mức lương mong muốn: {{$profile->mucluongmm}}</span></br>                            
                <span class="badge badge-info">Ngày cập nhật</span>
                <span class="badge badge-danger">{{date('d/m/Y',strtotime($profile->updated_at))}}</span>
              </div>
            </div>            
          </li>    
          @endforeach      
        </ul>      
      </div>
    </section>

    @include('layouts.looking-job')

    
    <section class="site-section py-4">
      <div class="container">
  
        <div class="row align-items-center">
          <div class="col-12 text-center mt-4 mb-5">
            <div class="row justify-content-center">
              <div class="col-md-7">
                <h2 class="section-title mb-2">Hãy đến với chúng tôi!</h2>
                <p class="lead">Tìm việc phù hợp & tuyển dụng nhân lực nhanh chóng </p>
              </div>
            </div>
            
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_mailchimp.svg" alt="Image" class="img-fluid logo-1">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_paypal.svg" alt="Image" class="img-fluid logo-2">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_stripe.svg" alt="Image" class="img-fluid logo-3">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_visa.svg" alt="Image" class="img-fluid logo-4">
          </div>

          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_apple.svg" alt="Image" class="img-fluid logo-5">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_tinder.svg" alt="Image" class="img-fluid logo-6">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_sony.svg" alt="Image" class="img-fluid logo-7">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="images/logo_airbnb.svg" alt="Image" class="img-fluid logo-8">
          </div>
        </div>
      </div>
    </section>


    <section class="bg-light pt-5 testimony-full">
        <div class="owl-carousel single-carousel">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Hãy đăng ký để trở thành hội viên của Website để sử dụng những dịch vụ tiện ích nhất&rdquo;</p>
                  <p><cite> &mdash; Hồng Phát, @HTP</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent_2.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Tìm việc phù hợp & tuyển dụng nhân lực nhanh chóng.&rdquo;</p>
                  <p><cite> &mdash; Hồng Phát, @HTP</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>
      </div>
    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Mobile</h2>
            <p class="mb-5 lead text-white">Giao diện tương thích, tiện ích và dễ sử dụng.</p>
            <p class="mb-0">
              <a href="javascript:void(0)" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>IOS</a>
              <a href="javascript:void(0)" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Android</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="images/apps.png" alt="Free Website Template by Free-Template.co" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    
@include('layouts.footer')