@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Về chúng tôi</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Về chúng tôi</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 bg-image overlay-primary fixed overlay" id="next-section" style="background-image: url('images/hero_1.jpg');">
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

    
    <section class="site-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a data-fancybox data-ratio="2" href="https://vimeo.com/317571768" class="block__96788">
              <span class="play-icon"><span class="icon-play"></span></span>
              <img src="images/sq_img_6.jpg" alt="Image" class="img-fluid img-shadow">
            </a>
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-title mb-3">Website dành riêng cho nhà tuyển dụng</h2>
            <p class="lead">Bạn đang tìm kiếm nhân lực nhanh chóng, hãy đến với chúng tôi!</p>
            <p>Chắc hẳn bạn đang gặp khó khăn về vấn đề tuyển dụng nhân lực phù hợp theo nhiều tiêu chí? đáp ứng đủ số lượng? tiết kiệm thời gian?</p>
            <p>Đừng lo, chúng tôi đã giải quyết được hầu hết những vấn đề bạn gặp phải. Bạn chi cần <a href="{{route('recRegister')}}">đăng ký</a> và sử dụng các dịch vụ và tất cả đều miễn phí!</p>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section pt-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0 order-md-2">
            <a data-fancybox data-ratio="2" href="https://vimeo.com/317571768" class="block__96788">
              <span class="play-icon"><span class="icon-play"></span></span>
              <img src="images/sq_img_8.jpg" alt="Image" class="img-fluid img-shadow">
            </a>
          </div>
          <div class="col-lg-5 mr-auto order-md-1  mb-5 mb-lg-0">
            <h2 class="section-title mb-3">Website dành riêng cho người tìm việc</h2>
            <p class="lead">Bạn đang tìm kiếm việc làm phù hợp, hãy đến với chúng tôi!</p>
            <p>Hãy <a href="{{route('login')}}">đăng ký</a> để nộp hồ sơ trực tuyến đến tay các nhà tuyển dụng, bạn sẽ có nhiều cơ hội để tìm được công việc phù hợp!</p>
          </div>
        </div>
      </div>
    </section>

   
    <section class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3">Our Team(only 1 member)</h2>
          </div>
        </div>

        <div class="row align-items-center block__69944">

          <div class="col-md-6">
            <img src="images/person_5.jpg" alt="Image" class="img-fluid mb-4 rounded">
          </div>

          <div class="col-md-6">
            <h3>HTP is Mine</h3>
            <p class="text-muted">Full stack</p>
            <p>DH51603902 - CNTT - Khoá D16</p>
            <div class="social mt-4">
              <a href="https://www.facebook.com/duongphat1234/"><span class="icon-facebook"></span></a>
              <a href="https://twitter.com/Call_Me_ZeroOne"><span class="icon-twitter"></span></a>
              <a href="https://www.instagram.com/hohongnguoihoa/"><span class="icon-instagram"></span></a>
              <a href="https://www.linkedin.com/in/hong-phat-81ba94184/"><span class="icon-linkedin"></span></a>
            </div>
          </div>
      </div>
    </section>
@endsection