@include('layouts.header')
    <!-- MENU -->
    @if(Auth::check()) @include('ntv_layouts.menu')     
    @else @include('layouts.menu')
    @endif

    <!-- SEARCH -->
    @include('layouts.search')
    <!-- HOME -->
    <section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url({{ url('images/hero_1.jpg')}})">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-white">Số liệu thống kê</h2>
           <!--  <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p> -->
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{$candidates}}">0</strong>
            </div>
            <span class="caption">Candidates</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{$jobs_posted}}">0</strong>
            </div>
            <span class="caption">Jobs Posted</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="120">0</strong>
            </div>
            <span class="caption">Jobs Filled</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="{{$companies}}">0</strong>
            </div>
            <span class="caption">Companies</span>
          </div>

            
        </div>
      </div>
    </section>

    

    <section class="site-section" id="content">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
              @if($job_listings->count() == 0) Rất tiếc! Hiện tại không có tin tuyển dụng nào cả!
              @else 10 công việc <sup><span class="badge badge-danger">HOT</span></sup> dành cho bạn!             
              @endif
            </h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$news->id)}}"></a>
            <div class="job-listing-logo">
              <img src="{{url('logo/'.$news->hinh)}}" alt="{{$news->hinh}}" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$news->nganh}}</h2>
                <strong>Nhà tuyển dụng {{$news->ten}}</strong>
                <div class="keywords">
                  @foreach(json_decode($news->kinang) as $skill)
                  <button class="btn btn-outline-info skill">{{$skill}}</button>
                  @endforeach                 
                </div>      
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                @foreach(json_decode($news->tinhthanhpho) as $city)
                <span class="icon-room"></span>{{$city}}</br>
                @endforeach
              </div>
              <div class="job-listing-meta">
                @if($news->trangthailv == 'Part Time')
                <span class="badge badge-danger">{{$news->trangthailv}}</span>
                @else
                <span class="badge badge-success">{{$news->trangthailv}}</span>
                @endif                
              </div>
            </div>            
          </li>
          @endforeach       
    
        </ul>
                 
      </div>
    </section>

<!--     <section>
      <div class="container">
        <div class="row">
           <div class="col-lg-8">
             
           </div>

            <div class="col-lg-4">
              <div class="sidebar-box">
                <h3>Nhà tuyển dụng nổi bật</h3>
                <p>FShop</p> 
                <p>Samsung</p>
              </div>
            </div>
        </div>
      </div>
    </section> -->  
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