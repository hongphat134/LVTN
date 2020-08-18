@extends('layouts.master')
@section('content')
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image home-section" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Tạo hồ sơ xin việc</h1>
        <div class="custom-breadcrumbs">
          <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>          
          <span class="text-white"><strong>Tạo hồ sơ xin việc</strong></span>
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
            <span class="icon-list-alt mr-2"></span>Tạo hồ sơ
          </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-lg-12">
        <form id="profile" action="{{url('/nguoitimviec/apply',$ttd_id)}}" class="p-4 p-md-5 border rounded" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <h3 class="text-black mb-5 border-bottom pb-2">Thông tin hồ sơ</h3>
 
          <div class="form-group">
            <label for="company-website-tw d-block">Upload ảnh đại diện</label> <br>
            <label class="btn btn-primary btn-md btn-file">
              Browse File<input type="file" name="hinhthe" hidden>
            </label>
          </div>        

          <div class="row form-group">              
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Họ & tên 
              <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-4 col-sm-12{{ $errors->has('name')? ' has-error' : '' }}">
              <input type="text" name="name" class="form-control" placeholder="Nhập họ tên...." value="{{ old('name') }}" required> 
              @if($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
              @endif 
            </div>                
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Email liên hệ
             <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-4 col-sm-12{{ $errors->has('email')? ' has-error' : '' }}">                  
              <input type="email" name="email" class="form-control" id="email" placeholder="Nhập Email...." value="{{ old('email') }}" required>
              @if($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
              @endif 
            </div>
          </div>

          <div class="row form-group">              
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Ngành nghề
              <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-4 col-sm-12{{ $errors->has('title')? ' has-error' : '' }}">
              <select class="selectpicker border" name="title" id="title" data-style="btn-white" data-width="100%" data-live-search="true" data-size="8" title="Chọn ngành nghề" required>                
                  @foreach($job_list as $job)                      
                  <option {{ strcasecmp(old('title'),$job) == 0?'selected':'' }}>{{$job}}</option>                      
                  @endforeach
                  <option value="other" @if(old('other_title') || session('error')) selected @endif>Khác</option>
              </select> 
              @if($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
              @endif 
            </div>  

            <div id="other_title" class="col-lg-6 col-sm-12" 
            @if(!old('other_title') && !session('error')) style="display: none;"
            @endif>
              <div class="row">
                <label for="job" class="col-lg-4 col-sm-12 col-form-label">Ngành nghề khác
                 <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-8 col-sm-12{{ session('error')? ' has-error' : '' }}">                  
                  <input type="text" name="other_title" class="form-control" placeholder="Nhập tên ngành nghề..." value="{{old('other_title')}}" required>
                  @if(session('error'))
                    <span class="help-block">
                        <strong>{{ session('error') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
          </div>      


          <div class="row form-group">
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Kĩ năng cá nhân
               <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>
            <div class="col-lg-4 col-sm-12{{ $errors->has('skill')? ' has-error' : '' }}">
              <select class="selectpicker border rounded" id="skill-list" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" data-size="10" title="Chọn kĩ năng..." multiple data-max-options="5">
                @foreach($skill_list as $skill)
                <option
  @if(is_array(old('skill')))                        
          {{ in_array($skill,old('skill')) ? 'selected':'' }}
          @endif
                 >
                  {{$skill}}
                </option>
                @endforeach
              </select>
              @if($errors->has('skill'))
                    <span class="help-block">
                        <strong>{{ $errors->first('skill') }}</strong>
                    </span>
              @endif
            </div>

            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Số năm kinh nghiệm
             <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-3 col-sm-12{{ $errors->has('exp')? ' has-error' : '' }}">                  
              <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn kinh nghiệm...">
                @foreach($exp_list as $exp)
                <option {{ old('exp') == $exp ? 'selected':'' }}>
                  {{$exp}}
                </option>
                @endforeach
              </select>
              @if($errors->has('exp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('exp') }}</strong>
                    </span>
              @endif
            </div>
          </div>
          <!-- BẰNG CẤP -->
          <div class="row form-group">
            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Bằng cấp cao nhất
               <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>
            <div class="col-lg-3 col-sm-12{{ $errors->has('degree')? ' has-error' : '' }}">
              <select class="selectpicker border rounded" name="degree" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn bằng cấp" required>                
                  @foreach($degree_list as $degree)
                <option {{ strcasecmp(old('degree'),$degree) == 0?'selected':'' }}>{{$degree}}</option>                      
                  @endforeach
              </select>
              @if($errors->has('degree'))
                    <span class="help-block">
                        <strong>{{ $errors->first('degree') }}</strong>
                    </span>
              @endif
            </div>

            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Cấp bậc cao nhất
             <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-3 col-sm-12{{ $errors->has('rank')? ' has-error' : '' }}">                  
              <select class="selectpicker border rounded" name="rank" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn cấp bậc" required>                
                  @foreach($rank_list as $rank)                                          
                  <option {{ strcasecmp(old('rank'),$rank) == 0?'selected':'' }}>{{$rank}}</option>                      
                  @endforeach
              </select>
              @if($errors->has('rank'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rank') }}</strong>
                    </span>
              @endif
            </div>
          </div>
<!-- TÌNH TRẠNG HÔN NHÂN -->
          <div class="row form-group">
            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Tình trạng hôn nhân
               <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>
            <div class="col-lg-3 col-sm-12">
              <select class="selectpicker border rounded" name="marital_stt" data-style="btn-black" data-width="100%" data-live-search="true">          
                  <option selected>Độc thân</option>
                  <option {{ old('marital_stt') == 'Đã kết hôn' ? 'selected': '' }}>Đã kết hôn</option>                      
             </select>
            </div>

            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Khu vực sinh sống
             <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>              
            <div class="col-lg-3 col-sm-12{{ $errors->has('region')? ' has-error' : '' }}">                  
              <select class="selectpicker border rounded" name="region" data-style="btn-black" data-width="100%" data-live-search="true" data-size="10" title="Chọn khu vực" required>                      
                  @foreach($region_list as $region => $city_list) 
                  <optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
                    @foreach($city_list as $city)
                    <option {{ strcasecmp(old('region'),$city->Ten) == 0?'selected':'' }}>{{$city->Ten}}</option>  
                    @endforeach
                  </optgroup>
                  @endforeach
              </select>
              @if($errors->has('region'))
                    <span class="help-block">
                        <strong>{{ $errors->first('region') }}</strong>
                    </span>
              @endif
            </div>
          </div>
<!-- MỨC LƯƠNG MM -->
          <div class="row form-group">
            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Mức lương mong muốn 
             <span class="text-info"><i class="icon-money"></i></span>
            </label>              
            <div class="col-lg-3 col-sm-12">                  
              <select name="salary" class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn mức lương mong muốn">                  
              @foreach($salary_list as $salary)
              <option {{ old('salary') == $salary ? 'selected' : '' }}>{{$salary}}</option>
              @endforeach                              
              </select>
            </div>

            <label for="job" class="col-lg-3 col-sm-12 col-form-label">Hình thức làm việc
               <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
            </label>
            <div class="col-lg-3 col-sm-12">
              <select name="status" class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn hình thức làm việc" required>
              <option selected>Part Time</option>                
              <option {{ old('job-type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>                              
              </select>
            </div>            
          </div>
        
          <h3 class="text-black my-5 border-bottom pb-2">Trình độ ngoại ngữ</h3>
          <div class="row form-group">              
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Ngoại ngữ &nbsp;
              <span class="text-primary"><i class="icon-language"></i></span>
            </label>              
            <div class="col-lg-4 col-sm-12">
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

            <div id="other_language" class="col-lg-6 col-sm-12" 
            @if(!old('other_language')) style="display: none;"
            @endif>
              <div class="row">
                <label for="job" class="col-lg-4 col-sm-12 col-form-label">Ngoại ngữ khác &nbsp;
                 <sup><span class="text-primary"><i class="icon-language"></i></span></sup>
                </label>              
                <div class="col-lg-8 col-sm-12">                  
                  <input type="text" name="other_language" class="form-control" placeholder="Nếu nhập nhiều, hãy nhập (VD: Anh,Pháp,Đức,...)" value="{{old('other_language')}}" required>
                </div>
              </div>
            </div>
          </div>
              
             
          <h3 class="text-black my-5 border-bottom pb-2">Trình độ tin học</h3>
          <div class="row form-group">              
            <label for="job" class="col-lg-2 col-sm-12 col-form-label">Phần mềm &nbsp;
              <span class="text-primary"><i class="icon-hand-o-right"></i></span>
            </label>              
            <div class="col-lg-4 col-sm-12">
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

            <div id="other_itech" class="col-lg-6 col-sm-12" 
            @if(!old('other_itech')) style="display: none;"
            @endif>
              <div class="row">
                <label for="job" class="col-lg-4 col-sm-12 col-form-label">Phần mềm khác &nbsp;
                 <sup><span class="text-primary"><i class="icon-hand-o-right"></i></span></sup>
                </label>              
                <div class="col-lg-8 col-sm-12">                  
                  <input type="text" name="other_itech" class="form-control" id="name" placeholder="Nhập tên phần mềm...(Access,Visio,Github,...)" value="{{ old('other_itech') }}" required>
                </div>
              </div>
            </div>
          </div>
         
          <h3 class="text-black my-5 border-bottom pb-2">Mục tiêu nghề nghiệp</h3>
          <div class="form-group">
              <textarea class="form-control" name="target" cols="30" rows="3" placeholder="Nhập mục tiêu....">{{ old('target')}}</textarea>
          </div>

          <h3 class="text-black my-5 border-bottom pb-2">Sở trường</h3>
          <div class="form-group">
              <textarea class="form-control" name="talent" cols="30" rows="3" placeholder="Nhập sở trường....">{{old('talent')}}</textarea>
          </div>
          
        </form>
      </div>

     
    </div>
    <div class="row align-items-center mb-5">
      
      <div class="col-lg-5 ml-auto">
        <div class="row">
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-block btn-light btn-md preview" data-toggle="modal" data-target=".bd-example-modal-xl">
            <span class="icon-open_in_new mr-2"></span>Xem trước</a>
          </div>
          <div class="col-6">
            <a href="#" class="btn btn-block btn-primary btn-md"
                  onclick="event.preventDefault();
                       document.getElementById('profile').submit();"
            >
          <span class="icon-list-alt mr-2"></span>Tạo hồ sơ
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
            <p id="salary-preview"></p>

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
                ><button type="button" class="btn btn-primary">Tạo hồ sơ</button></a>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('js/profile.js')}}"></script>    
@endsection