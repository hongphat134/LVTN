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
            <form id="profile" action="{{url('/nguoitimviec/create-profile')}}" class="p-4 p-md-5 border rounded" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <h3 class="text-black mb-5 border-bottom pb-2">Thông tin hồ sơ</h3>
              
              @foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
               {{ $error }}
              </div>
              @endforeach
              
              
              <div class="form-group">
                <label for="company-website-tw d-block">Upload ảnh đại diện</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" name="hinhthe" hidden>
                </label>
              </div>

              <!-- PUBLIC -->
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="public" name="public" value="1">
                <label class="custom-control-label" for="public">Công khai để nhà tuyển dụng có thể tìm kiếm hồ sơ</label>
              </div>
             
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="private" name="public" value="0">
                <label class="custom-control-label" for="private">Không công khai và chỉ dùng để làm mẫu</label>
              </div>

              <div class="form-group">
                <label for="nae">Họ và tên:</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên...." value="{{ old('name') }}" required>
              </div>

              <div class="form-group">
                <label for="email">Email liên hệ</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Nhập Email...." value="{{ old('email') }}" required>
              </div>

              <div class="form-group">
                <label for="job-title">Ngành nghề</label>
                <select class="selectpicker border rounded" name="title" id="title" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngành nghề" required>                
                      @foreach($ds_job as $job)                      
                      <option {{ strcasecmp(old('title'),$job->ten) == 0?'selected':'' }}>{{$job->ten}}</option>                      
                      @endforeach
                      <option value="other">Khác</option>
                </select>
              </div>

              <div class="form-group" id="other_title" style="display: none;">
                <label for="nae">Ngành nghề khác</label>
                <input type="text" name="other_title" class="form-control" placeholder="Nhập tên ngành nghề..." required>
              </div>

              <div class="form-group">
                <label for="job-region">Kĩ năng cá nhân</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
                      @foreach($skill_list as $skill)
                      <option value="{{$skill->id}}"
				@if(is_array(old('skill')))                        
              	{{ in_array($skill->id,old('skill')) ? 'selected':'' }}
              	@endif
                       >
                        {{$skill->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>

              <div class="form-group">
                <label for="job-region">Số năm kinh nghiệm</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn kinh nghiệm...">
                      @foreach($exp_list as $exp)
                      <option {{ old('exp') == $exp->ten ? 'selected':'' }}>
                        {{$exp->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>
              
              <div class="form-group">
                <label for="job-title">Bằng cấp cao nhất</label>
                <select class="selectpicker border rounded" name="degree" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn bằng cấp" required>                
                      @foreach($ds_bc as $bc)
                   	<option {{ strcasecmp(old('degree'),$bc->ten) == 0?'selected':'' }}>{{$bc->ten}}</option>                      
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Cấp bậc cao nhất</label>
                <select class="selectpicker border rounded" name="rank" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn cấp bậc" required>                
                      @foreach($ds_cb as $cb)                                          
                      <option {{ strcasecmp(old('rank'),$cb->ten) == 0?'selected':'' }}>{{$cb->ten}}</option>                      
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Tình trạng hôn nhân</label>
                <select class="selectpicker border rounded" name="marital_stt" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true">          
                      <option selected>Độc thân</option>
                      <option {{ old('marital_stt') == 'Đã kết hôn' ? 'selected': '' }}>Đã kết hôn</option>                      
                </select>
              </div>

              <div class="form-group">
                <label for="job-region">Khu vực sinh sống</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vực" required>
                      @foreach($city_list as $city)                      
                      <option {{ strcasecmp(old('region'),$city->Title) == 0?'selected':'' }}>{{$city->Title}}</option>                      
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Hình thức làm việc</label>
                <select name="status" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn hình thức làm việc" required>
                  <option selected>Part Time</option>                
                  <option {{ old('job-type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>                              
                </select>
              </div>

<!--               <div class="form-group">
                <label for="job-description">Mục tiêu</label>
                <div class="editor" name="ASSA" id="editor-1">
                  <p>Write Job Description!</p>
                </div>                
              </div> -->

              <h3 class="text-black my-5 border-bottom pb-2">Trình độ ngoại ngữ</h3>              
              <div class="form-group">
                <label for="job-region">Ngoại ngữ</label>
                <select class="selectpicker border rounded" name="language[]" id="language" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngoại ngữ" required multiple>
                      <option>Tiếng Anh</option>
                      <option>Tiếng Pháp</option>
                      <option>Tiếng Trung</option>
                      <option>Tiếng Nhật</option>
                      <option>Tiếng Hàn</option>
                      <option>Tiếng Nga</option>
                      <option>Tiếng Đức</option>
                      <option>Tiếng Ý</option>
                      <option>Tiếng Ả-Rập</option>
                      <option value="other">Ngôn ngữ khác</option>
                </select>
              </div>

              <div class="form-group" id="other_language" style="display: none;">
                <label for="nae">Ngoại ngữ khác</label>
                <input type="text" name="other_language" class="form-control" placeholder="Nếu nhập nhiều, hãy nhập (VD: Anh,Pháp,Đức,...)" required>
              </div>
<!-- 
              <div class="form-group">
                <label for="job-region">Trình độ</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vực" required>
                      <option>Sơ cấp</option>
                      <option>Trung cấp</option>
                      <option>Cao cấp</option>
                </select>
              </div> -->
              
              <h3 class="text-black my-5 border-bottom pb-2">Trình độ tin học</h3>
              <div class="form-group">
                <label for="nae">Phần mềm</label>
                <select class="selectpicker border rounded" name="itech[]" id="itech" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn phần mềm" required multiple>
                      <option>MS Word</option>
                      <option>MS Excel</option>
                      <option>MS PowerPoint</option>
                      <option>MS Outlook</option>
                      <option value="other">Phần mềm khác</option>
                </select>
              </div>

              <div class="form-group" id="other_itech" style="display: none;">
                <label for="nae">Phần mềm khác</label>
                <input type="text" name="other_itech" class="form-control" id="name" placeholder="Nhập tên phần mềm...(Access,Visio,Github,...)" value="{{ old('name') }}" required>
              </div>
              
              <h3 class="text-black my-5 border-bottom pb-2">Sở trường</h3>
              <div class="form-group">
                  <textarea class="form-control" name="talent" id="" cols="30" rows="10" placeholder="Nhập sở trường...."></textarea>
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
    <script src="{{asset('js/profile.js')}}"></script>
@endsection