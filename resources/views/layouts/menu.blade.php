<!-- NAVBAR -->
<header class="site-navbar mt-3">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="site-logo col-6"><a href="{{url('/')}}">HTP is Mine</a></div>

      <nav class="mx-auto site-navigation">
        <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
          <li><a href="{{url('/')}}" class="nav-link active">Trang chủ</a></li>
          <li><a href="{{url('/about')}}">Về chúng tôi</a></li>
          <li><a href="{{route('jobListings')}}">DS việc làm</a></li>          
          <!-- <li class="has-children">
            <a href="{{url('/services')}}">Pages</a>
            <ul class="dropdown">
              <li><a href="{{url('/services')}}">Services</a></li>
              <li><a href="{{url('/service-single')}}">Service Single</a></li>
              <li><a href="{{url('/blog-single')}}">Blog Single</a></li>
              <li><a href="{{url('/portfolio')}}">Portfolio</a></li>
              <li><a href="{{url('/portfolio-single')}}">Portfolio Single</a></li>
              <li><a href="{{url('/testimonials')}}">Testimonials</a></li>
              <li><a href="{{url('/faq')}}">Frequently Ask Questions</a></li>
              <li><a href="{{url('/gallery')}}">Gallery</a></li>
            </ul>
          </li> -->
          <li><a href="{{url('/blog')}}">Diễn đàn</a></li>
          <li><a href="{{url('/contact')}}">Liên hệ</a></li>
          
          <!-- FOR MOBILE -->         
          <li class="d-lg-none"><a href="{{url('/nguoitimviec/create-profile')}}">Tạo hồ sơ</a></li>
          <li class="d-lg-none"><a href="{{ url('/login')}}">Đăng nhập</a></li>
          <!-- END FOR MOBILE -->
        </ul>
      </nav>
      
      <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
        <div class="ml-auto">                   
          <a href="{{url('/nguoitimviec/create-profile')}}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Tạo hồ sơ </a>
          <a href="{{url('/login')}}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Đăng nhập</a>
        </div>
        <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
        
      </div>          
    </div>
  </div>
</header>

<div class="site-wrap">
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close mt-3">
				<span class="icon-close2 js-menu-toggle"></span>
			</div>
		</div>
	<div class="site-mobile-menu-body"></div>
</div> <!-- .site-mobile-menu -->