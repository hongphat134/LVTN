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
              <div class="col-6">
                <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                    onclick="event.preventDefault();
                           document.getElementById('profile').submit();">
                Cập nhật
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
              
              @foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
               {{ $error }}
              </div>
              @endforeach
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

              <div class="form-group">
                <label for="email">Tên nhà tuyển dụng</label>
                <input type="text" name="name" class="form-control" id="email" placeholder="Nhập tên...." value="{{$profile->ten}}" required>
              </div> 

              <div class="form-group">
                <label for="email">Địa chỉ</label>
                <input type="text" name="address" class="form-control" id="email" placeholder="Nhập địa chỉ...." value="{{$profile->diachi}}" required>
              </div>         

              <div class="form-group">
                <label for="job-region">khu vực hoạt động</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vự..." required>
                      @foreach($city_list as $city)                     
                      <option {{$profile->tinhthanhpho == $city->Title ? 'selected':''}}>{{$city->Title}}</option>                  
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-region">Quy mô dân sự</label>
                <select class="selectpicker border rounded" name="scale" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn quy mô..." required>
                      @foreach($scale_list as $scale)                     
                      <option {{$profile->quymodansu == $scale ? 'selected':''}}>{{$scale}}</option>                  
                      @endforeach
                </select>
              </div>
              
              

              <div class="form-group">
                <label for="job-description">Mục tiêu</label>
                <div class="editor" name="ASSA" id="editor-1">
                  <p>Write Job Description!</p>
                </div>                
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Thông tin thêm</h3>              
              <div class="form-group">
                <label for="company-tagline">Trình độ ngoại ngữ</label>
                <input type="text" class="form-control" id="company-tagline" placeholder="e.g. New York">
              </div>

              <div class="form-group">
                <label for="job-description">Trình độ tin học</label>
                <div class="editor" id="editor-2">
                  <p>Description</p>
                </div>
              </div>
              
              <div class="form-group">
                <label for="company-website">Sở trường</label>
                <input type="text" class="form-control" id="company-website" placeholder="https://">
              </div>
              
            </form>
          </div>

         
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              <div class="col-6">
                <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                      onclick="event.preventDefault();
                           document.getElementById('profile').submit();"
                >
              Save Job
            </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection