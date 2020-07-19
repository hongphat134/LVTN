@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image home-section" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
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
      <a href="#footer" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>
    </section>

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Mẫu hồ sơ</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="row">
              <div class="col-6">
                <a href="javascript:void(0)" class="btn btn-block btn-light btn-md preview" data-toggle="modal" data-target=".bd-example-modal-xl">
                <span class="icon-open_in_new mr-2"></span>Xem trước</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                    onclick="event.preventDefault();
                           document.getElementById('profile').submit();">
                <span class="icon-list-alt mr-2"></span>Tạo mẫu hồ sơ
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
              @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
               {{ session('error') }}
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
                      @foreach($job_list as $job)                      
                      <option {{ strcasecmp(old('title'),$job) == 0?'selected':'' }}>{{$job}}</option>                      
                      @endforeach
                      <option value="other">Khác</option>
                </select>
              </div>

              <div class="form-group" id="other_title"
              @if(!old('other_title')) style="display: none;"
              @endif>
                <label for="nae">Ngành nghề khác</label>
                <input type="text" name="other_title" class="form-control" placeholder="Nhập tên ngành nghề..." value="{{old('other_title')}}" required>
              </div>

              <div class="form-group">
                <label for="job-region">Kĩ năng cá nhân</label>
                <select class="selectpicker border rounded" id="skill-list" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
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
                      <option {{ old('exp') == $exp ? 'selected':'' }}>
                        {{$exp}}
                      </option>
                      @endforeach
                    </select>
              </div>
              
              <div class="form-group">
                <label for="job-title">Bằng cấp cao nhất</label>
                <select class="selectpicker border rounded" name="degree" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn bằng cấp" required>                
                      @foreach($degree_list as $degree)
                   	<option {{ strcasecmp(old('degree'),$degree) == 0?'selected':'' }}>{{$degree}}</option>                      
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Cấp bậc cao nhất</label>
                <select class="selectpicker border rounded" name="rank" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn cấp bậc" required>                
                      @foreach($rank_list as $rank)                                          
                      <option {{ strcasecmp(old('rank'),$rank) == 0?'selected':'' }}>{{$rank}}</option>                      
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
                <select class="selectpicker border rounded" name="language[]" id="language" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngoại ngữ" required multiple value="">
                      @foreach($language_list as $language)
                      <option
                      @if(is_array(old('language')))
                      {{ in_array($language,old('language')) ? 'selected':'' }}
                      @endif
                      >
                      {{$language}}
                      </option>
                      @endforeach
                      <option value="other"
                      @if(is_array(old('language')))
                      {{ in_array('other',old('language')) ? 'selected':'' }}
                      @endif
                      >Ngôn ngữ khác
                      </option>
                </select>
              </div>

              <div class="form-group" id="other_language" 
              @if(old('other_language'))
              @else style="display: none" 
              @endif>
                <label for="nae">Ngoại ngữ khác</label>
                <input type="text" name="other_language" class="form-control" placeholder="Nếu nhập nhiều, hãy nhập (VD: Anh,Pháp,Đức,...)" value="{{old('other_language')}}" required>
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
                      @foreach($itech_list as $itech)
                      <option
                      @if(is_array(old('itech')))
                      {{ in_array($itech,old('itech')) ? 'selected':'' }}
                      @endif
                      >{{$itech}}</option>
                      @endforeach
                      <option value="other"
                      @if(is_array(old('itech')))
                      {{ in_array('other',old('itech')) ? 'selected':'' }}
                      @endif
                      >Phần mềm khác</option>
                </select>
              </div>

              <div class="form-group" id="other_itech"
              @if(old('other_itech'))
              @else style="display: none" 
              @endif>
                <label for="nae">Phần mềm khác</label>
                <input type="text" name="other_itech" class="form-control" id="name" placeholder="Nhập tên phần mềm...(Access,Visio,Github,...)" value="{{ old('other_itech') }}" required>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Mục tiêu nghề nghiệp</h3>
              <div class="form-group">
                  <textarea class="form-control" name="target" cols="30" rows="10" placeholder="Nhập mục tiêu....">{{ old('target')}}</textarea>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Sở trường</h3>
              <div class="form-group">
                  <textarea class="form-control" name="talent" cols="30" rows="10" placeholder="Nhập sở trường....">{{old('talent')}}</textarea>
              </div>
              
            </form>
          </div>

         
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-5 ml-auto">
            <div class="row">
              <div class="col-6">
                <!-- <a href="javascript:void(0)" id="preview" class="btn btn-block btn-light btn-md" data-toggle="modal" data-target=".bd-example-modal-xl">
                <span class="icon-open_in_new mr-2"></span>Xem trước</a> -->
                <a href="javascript:void(0)" class="btn btn-block btn-light btn-md preview" data-toggle="modal" data-target=".bd-example-modal-xl">
                <span class="icon-open_in_new mr-2"></span>Xem trước</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                      onclick="event.preventDefault();
                           document.getElementById('profile').submit();"
                >
              <span class="icon-list-alt mr-2"></span>Tạo mẫu hồ sơ
              </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="previewProfile" aria-hidden="true" style="z-index: 1999">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewProfile">Xem trước</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">            
        <section class="site-section" style="padding-top: 0">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 blog-content">
            <h3 class="mb-4" id="title-preview"></h3>
            <p class="lead" id="degree-preview"></p>        

            <blockquote><p id="rank-preview"></p></blockquote>
                      
            <p id="region-preview"></p>

            <h4 class="mt-5 mb-4" id="status-preview"></h4>

            <p id="marital_stt-preview"></p>

            <p id="exp-preview">I</p>
            <p id="email-preview"></p>

            <div class="pt-5">
              <p id="target-preview"></p>
            </div>

          </div>
          <div class="col-lg-4 sidebar pl-lg-5">
            <div class="sidebar-box">
              <img src="{{asset('images/person_1.jpg')}}" alt="Image placeholder" class="img-fluid mb-4 w-50 rounded-circle">
              <h3 id="name-preview"></h3>
              <p id="talent-preview"></p>
              <p><a href="#" class="btn btn-primary btn-sm">Mô tả sơ lược</a></p>
            </div>

            <div class="sidebar-box">
              <div class="categories">
                <h3>Kỹ năng</h3>
                <div id="skill-preview">
                </div>
              </div>
            </div>

            <div class="sidebar-box">
              <div class="categories">
                <h3>Trình độ ngoại ngữ</h3>
                <div id="language-preview">
                </div>
              </div>
            </div>

            <div class="sidebar-box">
              <div class="categories">
                <h3>Trình độ tin học</h3>
                <div id="itech-preview">
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <a href="javascript::void(0)"  onclick="event.preventDefault();
                           document.getElementById('profile').submit();"
                ><button type="button" class="btn btn-primary">Tạo mẫu hồ sơ</button></a>
      </div>
    </div>
  </div>
</div>
    <script src="{{asset('js/profile.js')}}"></script>    
@endsection