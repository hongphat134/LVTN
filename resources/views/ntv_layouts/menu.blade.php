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
          <li><a href="{{url('/blog')}}">Blog</a></li>
          <li><a href="{{url('/contact')}}">Liên hệ</a></li>
          
          <!-- FOR MOBILE -->
          <li class="d-lg-none"><a href="#">Thông báo</a></li>
          <li class="has-children">
            <a href="#" class="d-lg-none">Hi, {{Auth::user()->ten}}</a>
            <ul class="dropdown">
              <li><a href="{{url('/nguoitimviec/create-profile')}}"><span class="mr-2">+</span> Tạo hồ sơ</a></li>
              <li><a href="{{url('/nguoitimviec/profile-list')}}">Tủ hồ sơ</a></li>
              <li><a href="{{route('appliedJobs')}}">Tin đã ứng tuyển</a></li>
              <li><a href="{{route('saveJobs')}}">Tin đang theo dõi</a></li>
              <li><a href="{{url('/nguoitimviec/theo-doi-ntd')}}">Theo dõi nhà tuyển dụng</a></li>
              <li><a href="{{url('/create-blog')}}">Tạo Blog</a></li>
              <li><a href="{{url('/blog-listings')}}">Quản lý Blog</a></li>
              <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" href="javascript:void(0)" id="open">Cập nhật tài khoản</a></li>
              <li>
                <a href="javascript:void(0)" class="d-lg-none"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                        Đăng xuất
                </a>               
              </li>   
            </ul>
          </li>                                                           
          <!-- END FOR MOBILE -->
        </ul>
      </nav>
      
      <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
        <div class="ml-auto">                   
          <a href="#" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-notifications_active"></span>Thông báo </a>             
          <div class="dropdown dropleft border-width-2 d-none d-lg-inline-block"> 
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Hi, {{Auth::user()->ten}}
            </button>
            <div class="dropdown-menu">
              <h4 class="dropdown-header">HỒ SƠ</h4>
              <a class="dropdown-item" href="{{url('/nguoitimviec/create-profile')}}">Tạo hồ sơ</a>
              <a class="dropdown-item" href="{{url('/nguoitimviec/profile-list')}}">Tủ hồ sơ</a>              
              <h4 class="dropdown-header">TIN TUYỂN DỤNG</h4>
              <a class="dropdown-item" href="{{route('appliedJobs')}}">Tin đã ứng tuyển</a>
              <a class="dropdown-item" href="{{route('saveJobs')}}">Tin đang theo dõi</a>
              <a class="dropdown-item" href="{{url('/nguoitimviec/thong-bao-viec-lam')}}">Thông báo việc làm phù hợp</a>
              <h4 class="dropdown-header">NHÀ TUYỂN DỤNG</h4>
              <a class="dropdown-item" href="{{url('/nguoitimviec/theo-doi-ntd')}}">Theo dõi nhà tuyển dụng</a>
               <h4 class="dropdown-header">BLOG</h4>
              <a class="dropdown-item" href="{{url('/create-blog')}}">Tạo Blog</a>
              <a class="dropdown-item" href="{{url('/blog-listings')}}">Quản lý Blog</a>
              <h4 class="dropdown-header">TÀI KHOẢN</h4>
              <a class="dropdown-item" data-toggle="modal" data-target="#myModal" href="javascript:void(0)" id="open">Cập nhật tài khoản</a>
              <a class="dropdown-item" href="javascript:void(0)"
                  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              Đăng xuất
              </a>
            </div>
          </div>                                 

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>                     
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

    <div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Thông tin tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>                  
      </div>
      @if(session('user-success'))
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{session('user-success')}}
      </div>
      @elseif(session('user-warning'))
      <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{session('user-warning')}}
      </div>
      @endif
      <form id="change-name" action="{{url('user/change-name')}}" method="post">
      {{csrf_field()}}
      <!-- Modal body -->
      <div class="modal-body"> 
      <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
          <label for="">Tên tài khoản</label>
          <input type="text" name="name" class="form-control"  value="{{old('name')}}"
         placeholder="Nhập tên...." required> 
          @if($errors->has('name'))
          <span class="help-block">
              <strong>{{$errors->first('name')}}</strong>
          </span>
          @endif
      </div>       
        
      </div>
      </form> 
      
      <!-- Modal footer -->
      <div class="modal-footer">                  
        <button type="submit" class="btn btn-info"
        onclick="event.preventDefault();
               document.getElementById('change-name').submit();">
        Đổi tên tài khoản
        </button>                                   
      </div>                

      <div class="modal-header">
        <h4 class="modal-title">Đổi mật khẩu</h4>                  
      </div>
      
      <form id="change-pwd" action="{{url('user/change-pwd')}}" method="post">
      {{csrf_field()}}
      <!-- Modal body -->
      <div class="modal-body">                  
          {{csrf_field()}}   

          @if(empty(Auth::user()->email))    
          <div class="{{ session('user-error') ? 'has-error' : '' }}">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
            @if(session('user-error'))
            <span class="help-block">
                <strong>{{session('user-error')}}</strong>
            </span>
            @endif
          </div>
          @endif  

          @if(!empty(Auth::user()->password))    
          <div class="{{ session('user-error') ? 'has-error' : '' }}">
            <label for="">Mật khẩu cũ</label>
            <input type="password" name="old_password" class="form-control" placeholder="Nhập mật khẩu cũ..." required>
            @if(session('user-error'))
            <span class="help-block">
                <strong>{{session('user-error')}}</strong>
            </span>
            @endif
          </div>
          @endif

          <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="">Mật khẩu mới</label>
            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới..." required>
            @if($errors->has('password'))
            <span class="help-block">
                <strong>{{$errors->first('password')}}</strong>
            </span>
            @endif
          </div>
          
          
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới..." required>      
          
      </div>
      </form>
      <!-- Modal footer -->
      <div class="modal-footer">                  
        <button type="submit" class="btn btn-info"
        onclick="event.preventDefault();
               document.getElementById('change-pwd').submit();">
        Đổi mật khẩu
        </button>                                            
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>                
    </div>
           
  </div>
</div>          
{{session('user-warning')}}         
@if(session('user-success') || session('user-error') || session('user-warning') )
<script>
  $(document).ready(function(){
    $("#open").trigger('click');
  });
</script>
@endif