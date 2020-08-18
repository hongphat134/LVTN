@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Đăng nhập/Đăng ký</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Đăng nhập</strong> /</span>
              <span class="text-white"><strong>Đăng ký</strong> /</span> 
              <span class="text-white"><strong>Khôi phục mật khẩu</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Đăng ký dành cho người tìm việc</h2>
            <form method="POST" action="{{ route('register') }}" class="p-4 border rounded">
            {{ csrf_field() }}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Tên xưng danh</label>
                  <input type="text" id="name"  name="name" class="form-control" placeholder="Nhập tên...." value="{{ old('name') }}" >
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" id="fname" name="email" class="form-control" placeholder="Nhập địa chỉ Email..." value="{{ old('email') }}">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0 {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Password</label>
                  <input type="password" id="password" class="form-control" name="password" placeholder="Nhập Password....">
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nhập lại Password</label>
                  <input type="password" id="fname" name="password_confirmation" class="form-control" placeholder="Nhập lại Password....">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Đăng ký" class="btn px-4 btn-primary text-white">                  
                  <a href="{{route('recRegister')}}"><button type="button" class="btn btn-info">Đăng ký cho nhà tuyển dụng</button></a>
                </div>
              </div>

            </form>
          </div>
          <div class="col-lg-6">
            <h2 class="mb-4">Đăng nhập vào HTP</h2>
            
            <form action="{{route('login')}}" method="post" class="p-4 border rounded">
            {{ csrf_field() }}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" name="email" id="fname" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Password</label>
                  <input type="password" name="password" id="fname" class="form-control" placeholder="Password" required>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                      </label>
                  </div>

                  <input type="submit" value="Đăng nhập" class="btn px-4 btn-primary text-white">
                  
                  <a href="{{url('/auth/redirect/google')}}"><button type="button" class="btn btn-danger"><i class="icon-google-plus"></i> Google</button></a>
                  <a href="{{url('/auth/redirect/facebook')}}"><button type="button" class="btn btn-danger"><i class="icon-facebook-square"></i> Facebook</button></a>

                </div>
              </div>
            </form>
            
          
            <hr>
            <h2 class="mb-4">Khôi phục mật khẩu</h2>
            
            <form action="{{ route('password.email') }}" method="post" class="p-4 border rounded">
            {{ csrf_field() }}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" name="email" id="fname" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>              

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Gửi Email" class="btn px-4 btn-primary text-white">
                </div>
              </div>

            </form>
          </div>
          
                     
        </div>
      </div>
    </section>
@endsection