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
                <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Xem trước</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                    onclick="event.preventDefault();
                           document.getElementById('profile').submit();">
                Lưu hồ sơ
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
                <input type="radio" class="custom-control-input" id="public" name="public" value="1" {{$hoso->congkhai == 1 ? 'checked' : ''}}>
                <label class="custom-control-label" for="public">Công khai để nhà tuyển dụng có thể tìm kiếm hồ sơ</label>
              </div>
             
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="private" name="public" value="0" {{$hoso->congkhai == 0 ? 'checked' : ''}}>
                <label class="custom-control-label" for="private">Không công khai và chỉ dùng để làm mẫu</label>
              </div>

              <div class="form-group">
                <label for="nae">Họ và tên:</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên...." value="{{$hoso->hoten}}" required>
              </div>

              <div class="form-group">
                <label for="email">Email liên hệ</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Nhập Email...." value="{{$hoso->emaillienhe}}" required>
              </div>

              <div class="form-group">
                <label for="job-title">Ngành nghề</label>
                <!-- <input type="text" name="job" class="form-control" id="job-title" placeholder="Product Designer"> -->
                <select class="selectpicker border rounded" name="title" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngành nghề" required>
                @if(in_array($hoso->nganh,$ds_job))
                  @foreach($ds_job as $job)               
              <option {{ strcasecmp($hoso->nganh,$job) == 0?'selected':'' }}>{{$job}}</option>
                  @endforeach
                  <option value="other">Khác</option>
                @else
                  @foreach($ds_job as $job)
                  <option>{{$job}}</option>
                  @endforeach
                  <option value="other" selected>Khác</option>
                @endif
                </select>
              </div>

              <div class="form-group" id="other_title"
              @if(in_array($hoso->nganh,$ds_job)) style="display:none"
              @endif
              >
                <label for="nae">Ngành nghề khác</label>
                <input type="text" name="other_title" class="form-control" placeholder="Nhập tên ngành nghề..." 
                value="{{!in_array($hoso->nganh,$ds_job) ? $hoso->nganh : ''}}" required>
              </div>

              <div class="form-group">
                <label for="job-region">Kĩ năng cá nhân</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
                      @foreach($skill_list as $skill)
                      <option value="{{$skill->id}}"                       
              {{ in_array($skill->id,json_decode($hoso->kinang))?'selected':'' }}>
                        {{$skill->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>

              <div class="form-group">
                <label for="job-region">Số năm kinh nghiệm</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn kinh nghiệm...">
                      @foreach($exp_list as $exp)
                      <option {{ $hoso->kinhnghiem == $exp ? 'selected':'' }}>
                        {{$exp}}
                      </option>
                      @endforeach
                    </select>
              </div>
              
              <div class="form-group">
                <label for="job-title">Bằng cấp cao nhất</label>
                <select class="selectpicker border rounded" name="degree" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn bằng cấp" required>                
                      @foreach($ds_bc as $bc)                    
              <option {{ strcasecmp($hoso->bangcap,$bc) == 0?'selected':'' }}>{{$bc}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Cấp bậc cao nhất</label>
                <select class="selectpicker border rounded" name="rank" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn cấp bậc" required>                
                      @foreach($ds_cb as $cb)                                          
                <option {{ strcasecmp($hoso->capbac,$cb) == 0?'selected':'' }}>{{$cb}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-title">Tình trạng hôn nhân</label>
                <select class="selectpicker border rounded" name="marital_stt" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true">
                  <option selected>Độc thân</option>
                  <option {{$hoso->honnhan == 'Đã kết hôn' ? 'selected' : ''}}>Đã kết hôn</option>                  
                </select>
              </div>

              <div class="form-group">
                <label for="job-region">Khu vực sinh sống</label>
                <select class="selectpicker border rounded" name="region" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn khu vực" required>
                      @foreach($city_list as $city)                      
                      <option {{ strcasecmp($hoso->khuvuc,$city->Title) == 0?'selected':'' }}>{{$city->Title}}</option>                      
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Hình thức làm việc</label>
                <select name="status" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn hình thức làm việc" required>                                
                  <!-- <option selected>Cả Part Time và Full Time</option>  -->
                  <option selected>Part Time</option>                
                  <option {{$hoso->trangthailv == 'Full Time' ? 'selected' : ''}}>Full Time</option>               
                </select>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Trình độ ngoại ngữ</h3>
              <?php 
                $other_languages = '';
                if($hoso->ngoaingu)
                foreach(json_decode($hoso->ngoaingu) as $language) {
                  if(!in_array($language, $ds_nn)) $other_languages .= $language.',';
                }
              ?>      
              <div class="form-group">
                <label for="job-region">Ngoại ngữ</label>
                <select class="selectpicker border rounded" name="language[]" id="language" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn ngoại ngữ" required multiple>
                      @foreach($ds_nn as $language)
                      <option
                      @if($hoso->ngoaingu)
                      {{ in_array($language,json_decode($hoso->ngoaingu)) ? 'selected':'' }}
                      @endif
                      >
                      {{$language}}
                      </option>
                      @endforeach
                      <option value="other" {{ $other_languages ? 'selected' : ''}}>Ngôn ngữ khác
                      </option>
                </select>
              </div>

              <div class="form-group" id="other_language" 
              @if(!$other_languages) style="display: none"              
              @endif>
                <label for="nae">Ngoại ngữ khác</label>
                <input type="text" name="other_language" class="form-control" placeholder="Nếu nhập nhiều, hãy nhập (VD: Anh,Pháp,Đức,...)"
                value="{{ $other_languages ? substr($other_languages, 0, -1) : '' }}" required>
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
              <?php 
                $other_itechs = '';
                if($hoso->tinhoc)
                foreach (json_decode($hoso->tinhoc) as $itech) {                  
                  if(!in_array($itech,$ds_th)) $other_itechs .= $itech.',';
                }                  
              ?>  
              <div class="form-group">
                <label for="nae">Phần mềm</label>
                <select class="selectpicker border rounded" name="itech[]" id="itech" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn phần mềm" required multiple>
                      @foreach($ds_th as $itech)
                      <option
                      @if($hoso->tinhoc)
                      {{ in_array($itech,json_decode($hoso->tinhoc)) ? 'selected':'' }}
                      @endif
                      >{{$itech}}</option>
                      @endforeach
                      <option value="other" {{ $other_itechs ? 'selected' : ''}}>Phần mềm khác</option>
                </select>
              </div>

              <div class="form-group" id="other_itech"
              @if(!$other_itechs) style="display: none"              
              @endif>
                <label for="nae">Phần mềm khác</label>
                <input type="text" name="other_itech" class="form-control" id="name" placeholder="Nhập tên phần mềm...(Access,Visio,Github,...)" 
                value="{{ $other_itechs ? substr($other_itechs, 0, -1) : '' }}" required>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Mục tiêu nghề nghiệp</h3>
              <div class="form-group">
                  <textarea class="form-control" name="target" id="" cols="30" rows="10" placeholder="Nhập mục tiêu....">{{ $hoso->muctieu }}</textarea>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Sở trường</h3>
              <div class="form-group">
                  <textarea class="form-control" name="talent" id="" cols="30" rows="10" placeholder="Nhập sở trường....">{{$hoso->sotruong}}</textarea>
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