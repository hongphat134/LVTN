@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông tin hồ sơ</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông tin hồ sơ</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Thông tin hồ sơ</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">              
              <div class="col-12">
                <a href="#" class="btn btn-block btn-primary btn-md"
                    onclick="event.preventDefault();
                           document.getElementById('profile').submit();">
                <span class="icon-users mr-2"></span>Cập nhật thông tin
              </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form id="profile" action="{{url('/nhatuyendung/profile')}}" class="p-4 p-md-5 border rounded" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <h3 class="text-black mb-5 border-bottom pb-2">Thông tin hồ sơ</h3>
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
              </div>
              @endif  
              <div class="form-group">
                <label for="company-website-tw d-block">Upload logo</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" name="logo" hidden>
                </label>
              </div>

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="email">Tên nhà tuyển dụng</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên...." value="{{$profile->ten}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div> 
              
              <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                <label for="email">Tên người liên hệ</label>
                <input type="text" name="contact_name" class="form-control"  placeholder="Nhập Họ tên...." value="{{empty($profile->tenlh)? old('contact_name'): $profile->tenlh}}">
                @if ($errors->has('contact_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contact_name') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="email">SDT liên hệ</label>
                <input type="text" name="phone" class="form-control"  placeholder="Nhập SDT...." value="{{empty($profile->sdt)? old('phone'): $profile->sdt}}" required>
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email liên hệ</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập Email liên hệ...." value="{{empty($profile->email)? old('email'): $profile->email}}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="email">Địa chỉ</label>
                <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ...." value="{{$profile->diachi}}">
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
              </div>         

              <div class="form-group">
                <label for="job-region">khu vực hoạt động</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vự...">                     
                      @foreach($region_list as $region => $city_list) 
                      <optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
                        @foreach($city_list as $city)
                        <option {{$profile->tinhthanhpho == $city->Ten ? 'selected':''}}>{{$city->Ten}}</option> 
                        @endforeach
                      </optgroup>
                      @endforeach
                </select>               
              </div>

              <div class="form-group">
                <label for="job-region">Quy mô dân sự</label>
                <select class="selectpicker border rounded" name="scale" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn quy mô...">
                      @foreach($scale_list as $scale)                     
                      <option {{$profile->quymodansu == $scale ? 'selected':''}}>{{$scale}}</option>                  
                      @endforeach
                </select>              
              </div>

              <div class="form-group{{ session('error') ? ' has-error' : '' }}">
                <label for="company-website">Website công ty</label>
                <input type="text" name="website" class="form-control" id="company-website" placeholder="https://" value="{{empty($profile->website)? old('website'): $profile->website}}">
                @if (session('error'))
                    <span class="help-block">
                        <strong>{{ session('error') }}</strong>
                    </span>
                @endif
              </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">              
              <div class="col-12">
                <a href="#" class="btn btn-block btn-primary btn-md"
                      onclick="event.preventDefault();
                           document.getElementById('profile').submit();"
                >
                <span class="icon-users mr-2"></span>Cập nhật thông tin
            </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection