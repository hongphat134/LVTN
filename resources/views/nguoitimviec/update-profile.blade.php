@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Mẫu hồ sơ</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Mẫu hồ sơ</strong></span>
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
                <h2>Mẫu hồ sơ</h2>
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
                Save Job
              </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form id="profile" action="{{url('/nguoitimviec/update-profile',$hoso->id)}}" class="p-4 p-md-5 border rounded" method="post" enctype="multipart/form-data">
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
                <label for="company-website-tw d-block">Upload ảnh đại diện</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" name="hinhthe" hidden>
                </label>
              </div>

              <!-- PUBLIC -->
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="public" name="public" value="1"
                @if(!empty($hoso))
                  {{$hoso->congkhai == 1 ? 'checked' : ''}}
                @endif>
                <label class="custom-control-label" for="public">Công khai để nhà tuyển dụng có thể tìm kiếm hồ sơ</label>
              </div>
             
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="private" name="public" value="0"
                @if(!empty($hoso))
                  {{$hoso->congkhai == 0 ? 'checked' : ''}}
                @endif>
                <label class="custom-control-label" for="private">Không công khai và chỉ dùng để làm mẫu</label>
              </div>

              <div class="form-group">
                <label for="nae">Họ và tên:</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên...." value="{{ !empty($hoso)?$hoso->hoten:'' }}" required>
              </div>

              <div class="form-group">
                <label for="email">Email liên hệ</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Nhập Email...." value="{{ !empty($hoso)?$hoso->emaillienhe:'' }}" required>
              </div>

              <div class="form-group">
                <label for="job-title">Ngành nghề</label>
                <!-- <input type="text" name="job" class="form-control" id="job-title" placeholder="Product Designer"> -->
                <select class="selectpicker border rounded" name="title" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngành nghề" required>                
                      @foreach($ds_job as $job)
                      @if(!empty($hoso))
                      <option {{ strcasecmp($hoso->nganh,$job->ten) == 0?'selected':'' }}>{{$job->ten}}</option>
                      @else
                      <option>{{$job->ten}}</option>
                      @endif
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-region">Kĩ năng cá nhân</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
                      @foreach($skill_list as $skill)
                      <option value="{{$skill->id}}"
                        @if(!empty($hoso))
              {{ in_array($skill->id,json_decode($hoso->kinang))?'selected':'' }}
                        @endif>
                        {{$skill->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>

              <div class="form-group">
                <label for="job-region">Số năm kinh nghiệm</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn kinh nghiệm...">
                      @foreach($exp_list as $exp)
                      <option
                        @if(!empty($hoso))
                          {{ $hoso->kinhnghiem == $exp->ten ? 'selected':'' }}
                        @endif
                      >
                        {{$exp->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>
              
              <div class="form-group">
                <label for="job-title">Bằng cấp cao nhất</label>
                <select class="selectpicker border rounded" name="degree" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn bằng cấp" required>                
                      @foreach($ds_bc as $bc)
                      @if(!empty($hoso))
                      <option {{ strcasecmp($hoso->bangcap,$bc->ten) == 0?'selected':'' }}>{{$bc->ten}}</option>
                      @else
                      <option>{{$bc->ten}}</option>
                      @endif
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Cấp bậc cao nhất</label>
                <select class="selectpicker border rounded" name="rank" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn cấp bậc" required>                
                      @foreach($ds_cb as $cb)                      
                      @if(!empty($hoso))
                      <option {{ strcasecmp($hoso->capbac,$cb->ten) == 0?'selected':'' }}>{{$cb->ten}}</option>
                      @else
                      <option>{{$cb->ten}}</option>
                      @endif
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Tình trạng hôn nhân</label>
                <select class="selectpicker border rounded" name="marital_stt" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true">    
                      @if(!empty($hoso))
                        @if($hoso->honnhan == 'Đã kết hôn')
                        <option>Độc thân</option>
                        <option selected>Đã kết hôn</option>
                        @else
                        <option selected>Độc thân</option>
                        <option>Đã kết hôn</option>
                        @endif 
                      @else           
                      <option selected>Độc thân</option>
                      <option>Đã kết hôn</option>
                      @endif
                </select>
              </div>

              <div class="form-group">
                <label for="job-region">Khu vực sinh sống</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vực" required>
                      @foreach($city_list as $city)
                      @if(!empty($hoso))
                      <option {{ strcasecmp($hoso->khuvuc,$city->Title) == 0?'selected':'' }}>{{$city->Title}}</option>
                      @else
                      <option>{{$city->Title}}</option>
                      @endif
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Hình thức làm việc</label>
                <select name="status" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn hình thức làm việc" required>
                @if(!empty($hoso))
                  @if($hoso->trangthailv == 'Part Time')
                  <option selected>Part Time</option>                
                  <option>Full Time</option>                
                  @else
                  <option>Part Time</option>                
                  <option selected>Full Time</option> 
                  @endif
                @else
                  <option>Part Time</option>                
                  <option selected>Full Time</option> 
                @endif  
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