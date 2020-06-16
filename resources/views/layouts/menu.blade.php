<!-- NAVBAR -->
<header class="site-navbar mt-3">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="site-logo col-6"><a href="{{url('/')}}">HTP is Mine</a></div>

      <nav class="mx-auto site-navigation">
        <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
          <li><a href="{{url('/')}}" class="nav-link active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li class="has-children">
            <a href="{{route('jobListings')}}">Job Listings</a>
            <ul class="dropdown">
              <li><a href="job-single.html">Job Single</a></li>
              <li><a href="post-job.html">Post a Job</a></li>
            </ul>
          </li>
          <li class="has-children">
            <a href="services.html">Pages</a>
            <ul class="dropdown">
              <li><a href="services.html">Services</a></li>
              <li><a href="service-single.html">Service Single</a></li>
              <li><a href="blog-single.html">Blog Single</a></li>
              <li><a href="portfolio.html">Portfolio</a></li>
              <li><a href="portfolio-single.html">Portfolio Single</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>
              <li><a href="faq.html">Frequently Ask Questions</a></li>
              <li><a href="gallery.html">Gallery</a></li>
            </ul>
          </li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="contact.html">Contact</a></li>
          
          @if(Auth::check())
          <li class="has-children">
            <a href="#" class="d-lg-none">Hi, {{Auth::user()->ten}}</a>
            <ul class="dropdown">
              <li><a href="{{url('/nguoitimviec/profile')}}"><span class="mr-2">+</span> Tạo hồ sơ</a></li>
              <li><a href="#">Tin đã apply</a></li>
              <li><a href="#">Tin đã lưu</a></li>              
              <li>
                <a href="{{ route('logout') }}" class="d-lg-none"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                        Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
              </li>   
            </ul>
          </li>                                                     
          @else
          <li class="d-lg-none"><a href="{{ url('/login')}}">Đăng nhập</a></li>
          @endif
        </ul>
      </nav>
      
      <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
        <div class="ml-auto">          
          @if(Auth::check()) 
          @if(Auth::user()->loaitk == 0)
          <div class="dropdown dropleft"> 
            <button type="button" class="btn btn-primary border-width-2 d-none d-lg-inline-block dropdown-toggle" data-toggle="dropdown">
              Hi, {{Auth::user()->ten}}
            </button>
            <div class="dropdown-menu">
              <h5 class="dropdown-header">HỒ SƠ</h5>
              <a class="dropdown-item" href="{{url('/nguoitimviec/profile')}}">Tạo hồ sơ</a>
              <a class="dropdown-item" href="#">Link 2</a>
              <a class="dropdown-item" href="#">Link 3</a>
              <h5 class="dropdown-header">TIN TUYỂN DỤNG</h5>
              <a class="dropdown-item" href="#">Tin đã apply</a>
              <a class="dropdown-item" href="#">Tin đã lưu</a>
              <h5 class="dropdown-header">TÀI KHOẢN</h5>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              Đăng xuất
              </a>
            </div>
          </div>
          @else
          <div class="dropdown dropleft"> 
            <button type="button" class="btn btn-primary border-width-2 d-none d-lg-inline-block dropdown-toggle" data-toggle="dropdown">
              Hi, {{Auth::user()->ten}}
            </button>
            <div class="dropdown-menu">
              <h5 class="dropdown-header">TIN TUYỂN DỤNG</h5>
              <a class="dropdown-item" href="{{route('postJob')}}">Đăng tin</a>
              <a class="dropdown-item" href="{{url('/nhatuyendung/jobs-list')}}">quản lý tin</a>              
              <h5 class="dropdown-header">TÀI KHOẢN</h5>
              <a class="dropdown-item" href="{{url('nhatuyendung/profile')}}">Chỉnh sửa hồ sơ</a>              
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              Đăng xuất
              </a>
            </div>
          </div>
          @endif                                                             
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          @else
          <a href="{{url('/nguoitimviec/profile')}}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Tạo hồ sơ </a>
          <a href="{{url('/login')}}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Đăng nhập</a>
          @endif
        </div>
        <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>

        
      </div>          
    </div>
  </div>
</header>