@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Đăng ký cho nhà tuyển dụng</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Thông tin nhà tuyển dụng</h2>
            <form method="POST" action="{{ route('recRegister') }}" class="p-4 border rounded">
            {{csrf_field()}}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Tên nhà tuyển dụng</label>
                  <input type="text" id="name"  name="name" class="form-control" placeholder="Nhập tên...." value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Địa chỉ</label>
                  <input type="text" id="fname" name="address" class="form-control" placeholder="Nhập địa chỉ..." value="{{ old('address')}}" required>                  
                </div>
              </div>
              
              <div class="form-group">
                <label class="text-black" for="job-region">Khu vực làm việc</label>
                <select class="selectpicker form-control border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vực..." required>
                      @foreach($city_list as $city)
                      <option {{ old('region') == $city->Title ? 'selected':'' }}>
                        {{$city->Title}}
                      </option>
                      @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label class="text-black" for="job-region">Quy mô dân sự</label>
                <select class="selectpicker form-control border rounded" name="scale" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn quy mô..." required>
                      @foreach($scale_list as $scale)
                      <option {{ old('scale')==$scale ? 'selected':''}}>
                        {{$scale}}
                    </option>
                      @endforeach
                </select>
              </div>
<!-- 
              <div class="form-group">
                <label for="company-website-tw d-block">Upload ảnh đại diện</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" name="hinhthe" hidden>
                </label>
              </div> -->

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Đăng ký" class="btn px-4 btn-primary text-white">                                    
                </div>
              </div>
            
          </div>
          <div class="col-lg-6">
            <h2 class="mb-4">Thông tin tài khoản</h2>
                        
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('usrname') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Tên tài khoản</label>
                  <input type="text" id="usrname"  name="usrname" class="form-control" placeholder="Nhập tên tài khoản...." value="{{ old('usrname') }}" required autofocus>
                  @if ($errors->has('usrname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('usrname') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="col-md-12 mb-3 mb-md-0{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" name="email" id="fname" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>

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
                  <input type="password" name="password" id="fname" class="form-control" placeholder="Nhập Password..." required>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>            
              </div>  
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nhập lại password</label>
                  <input type="password" name="password_confirmation" id="fname" class="form-control" placeholder="Nhập lại Password..." required>                 
                </div>            
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection