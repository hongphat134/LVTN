@extends('layouts.master')
@section('content')
    
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image home-section" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Đăng tin tuyển dụng</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Đăng tin tuyển dụng</strong></span>
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
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Đăng tin tuyển dụng</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
                <a href="#" class="btn btn-block btn-light btn-md preview" data-toggle="modal" data-target=".bd-example-modal-xl">
                  <span class="icon-open_in_new mr-2"></span>Xem trước</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-info btn-md"
                        onclick="event.preventDefault();
                           document.getElementById('post-job').submit();">
                <span class="icon-newspaper-o mr-2"></span>Đăng tin
              </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form id="post-job" action="{{route('postJob')}}" class="p-4 p-md-5 border rounded" method="post">
              {{csrf_field()}}
              <h3 class="text-black mb-5 border-bottom pb-2">Thông tin tuyển dụng</h3>
              <div class="form-group{{ $errors->has('deadline')||session('error') ? ' has-error' : '' }}">
                <label for="job-title">Hạn tuyển dụng</label>
                <input type="date" class="form-control" name="deadline" placeholder="Chọn hạn...." value="{{ old('deadline')}}">
                @if ($errors->has('deadline'))
                    <span class="help-block">
                        <strong>{{ $errors->first('deadline') }}</strong>
                    </span>                
                @elseif (session('error'))
                    <span class="help-block">
                        <strong>{{ session('error') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('vacancy') ? ' has-error' : '' }}">
                <label for="job-title">Số lượng tuyển dụng</label>
                <input type="number" class="form-control" id="job-title" name="vacancy" min="1" max="99" placeholder="Nhập số lượng...." value="{{old('vacancy')}}">
                @if ($errors->has('vacancy'))
                    <span class="help-block">
                        <strong>{{ $errors->first('vacancy') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('skill') ? ' has-error' : '' }}">
                <label for="job-region">Kĩ năng cần thiết</label>
                <select class="selectpicker border rounded" id="skill-list" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
                  @foreach($skill_list as $skill)
                  <option
    {{ !empty(old('skill'))?(in_array($skill,old('skill')) ? 'selected':''):'' }}>
                        {{$skill}}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('skill'))
                    <span class="help-block">
                        <strong>{{ $errors->first('skill') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
                <label for="job-region">Ngành nghề cần tuyển</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="job" title="Chọn ngành nghề...">
                  @foreach($job_list as $job)
                  <option
                      {{ $job == old('job') ? 'selected' : ''}}>
                    {{$job}}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('job'))
                    <span class="help-block">
                        <strong>{{ $errors->first('job') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group{{ $errors->has('degree') ? ' has-error' : '' }}">
                <label for="job-type">Yêu cầu trình độ</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="degree" title="Chọn yêu cầu...">
                @foreach($degree_list as $degree)                      
                  <option {{ $degree == old('degree') ?'selected':''}}>{{$degree}}</option>
                @endforeach
                </select>
                @if ($errors->has('degree'))
                    <span class="help-block">
                        <strong>{{ $errors->first('degree') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('rank') ? ' has-error' : '' }}">
                <label for="job-type">Vị trí tuyển dụng</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="rank" title="Chọn vị trí...">
                @foreach($rank_list as $rank)                      
                  <option {{ $rank == old('rank') ?'selected':''}}>{{$rank}}</option>
                @endforeach
                </select>
                @if ($errors->has('rank'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rank') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('exp') ? ' has-error' : '' }}">
                <label for="job-type">Yêu cầu kinh nghiệm</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn yêu cầu...">
                @foreach($exp_list as $exp)                      
                  <option {{ $exp == old('exp') ?'selected':''}}>{{$exp}}</option>
                @endforeach
                </select>
                @if ($errors->has('exp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('exp') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                <label for="job-type">Mức lương</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="salary" title="Chọn mức lương...">
                @foreach($salary_list as $salary)                      
                  <option {{ $salary == old('salary') ?'selected':''}}>{{$salary}}</option>
                @endforeach
                </select>
                @if ($errors->has('salary'))
                    <span class="help-block">
                        <strong>{{ $errors->first('salary') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group">
                <label for="job-type">Giới tính</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="gender" title="Chọn hình thức...">
                  <option selected>Bất kì</option>
                  <option {{old('gender') == 'Nam' ? 'selected':''}}>Nam</option>
                  <option {{old('gender') == 'Nữ' ? 'selected':''}}>Nữ</option>
                </select>                
              </div>

              <div class="form-group">
                <label for="job-type">Hình thức làm việc</label>
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="status" title="Chọn hình thức...">
                  <option selected>Full Time</option>
                  <option {{ old('status') == 'Part Time' ? 'selected':''}}>Part Time</option>                  
                </select>
              </div>
              
              <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                <label for="job-region">Nơi làm việc</label>
                <select class="selectpicker border rounded" id="region-list" data-style="btn-black" data-width="100%" data-live-search="true" name="region[]" title="Chọn khu vực..." multiple data-max-options="3">                     
                      @foreach($region_list as $region => $city_list)  
                      <optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
                        @foreach($city_list as $city)
                        <option
                    @if(old('region'))
                 {{ in_array($city->Ten,old('region')) ? 'selected':'' }}     
                    @endif>
                        {{$city->Ten}}</option>
                        @endforeach
                      </optgroup>
                      @endforeach
                  </select> 
                  @if ($errors->has('region'))
                    <span class="help-block">
                        <strong>{{ $errors->first('region') }}</strong>
                    </span>
                @endif                   
              </div>
             

              <h3 class="text-black my-5 border-bottom pb-2">Yêu cầu trình độ ngoại ngữ</h3>
              <div class="form-group">
                <select class="selectpicker border rounded" id="language-list" data-style="btn-black" data-width="100%" data-live-search="true" name="language[]"  title="Chọn ngoại ngữ...(không bắt buộc)" multiple> 
                @if(is_array(old('language')))
                  @foreach($language_list as $language)
                  <option {{in_array($language,old('language')) ? 'selected' : ''}}>
                  {{$language}}
                  </option>
                  @endforeach
                @else
                  @foreach($language_list as $language)
                  <option>{{$language}}</option>
                  @endforeach
                @endif
                  <option>Ngôn ngữ khác</option>                
                </select>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Yêu cầu trình độ tin học</h3>
              <div class="form-group">
                <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="itech[]" id="itech-list" title="Chọn phần mềm...(không bắt buộc)" multiple>
                @if(is_array(old('itech')))
                  @foreach($itech_list as $itech)
                  <option {{in_array($itech,old('itech')) ? 'selected' : ''}}>
                  {{$itech}}
                  </option>
                  @endforeach
                @else
                  @foreach($itech_list as $itech)
                  <option>{{$itech}}</option>
                  @endforeach
                @endif       
                <option>Phần mềm khác</option>           
                </select>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Mô tả công việc</h3>
              <div class="form-group">
              @if(old('des_job'))
                @foreach(old('des_job') as $des)
                <input type="text" name="des_job[]" class="form-control" placeholder="Nội dung..." value="{{$des}}">
                @endforeach  
              @else
                <input type="text" name="des_job[]" class="form-control" placeholder="Nội dung...">                
              @endif
                <button type="button" id="des-job" class=" btn btn-secondary form-control">Thêm <span class="icon-plus"></span>
                </button>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Quyền lợi</h3>
              <div class="form-group">
              @if(old('benefit'))
                @foreach(old('benefit') as $benefit)
                <input type="text" name="benefit[]" class="form-control" placeholder="Nội dung..." value="{{$benefit}}">
                @endforeach
              @else
                <input type="text" name="benefit[]" class="form-control" id="company-name" placeholder="Nội dung...">
              @endif
                <button type="button" id="benefit" class="btn btn-dark btn-block">
                Thêm <span class="icon-plus"></span></button>               
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Thông tin liên hệ</h3>
              <div class="form-group">
              @if(old('info_contact'))
                @foreach(old('info_contact') as $info)
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="{{$info}}">
                @endforeach
              @else
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="Email liên hệ: {{$user->email}}">
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="SDT liên hệ: {{$user->sdt}}">
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="Tên: {{$user->tenlh}}">
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="Địa chỉ: {{$user->diachi}}, {{$user->tinhthanhpho}}">
              @endif
                <button type="button" id="info-contact" class="btn btn-info form-control">Thêm <span class="icon-plus"></span></button>
              </div>              
            </form>
          </div>

         
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              <div class="col-6">
                <a href="#" class="btn btn-block btn-light btn-md preview" data-toggle="modal" data-target=".bd-example-modal-xl"><span class="icon-open_in_new mr-2"></span>Xem trước</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-info btn-md"
                        onclick="event.preventDefault();
                           document.getElementById('post-job').submit();">                  
                  <span class="icon-newspaper-o mr-2"></span>Đăng tin
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="z-index: 1999">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Xem trước</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">            
    <section class="site-section" style="padding-top:0">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="mb-5">
              <figure class="mb-5"><img src="{{asset('images/job_single_img_1.jpg')}}" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-info"><span class="icon-align-left mr-3"></span>Mô tả công việc</h3>
              <span id="des-preview">              
              </span>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-info"><span class="icon-rocket mr-3"></span>Quyền lợi</h3>
              <ul class="list-unstyled m-0 p-0" id="benefit-preview">                
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-info"><span class="icon-book mr-3"></span>Thông tin liên hệ</h3>
              <ul class="list-unstyled m-0 p-0" id="contact-preview">                
              </ul>
            </div>         

          </div>
          <div class="col-lg-5">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-info  mt-3 h5 pl-3 mb-3 ">Tổng quan</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <!-- <li class="mb-2"><strong class="text-black">Published on:</strong> April 14, 2019</li> -->
                <li class="mb-2" id="job-preview"></li>
                <li class="mb-2" id="rank-preview"></li>
                <li class="mb-2" id="vacancy-preview"></li>
                <li class="mb-2" id="skill-preview"></li>
                <li class="mb-2" id="degree-preview"></li>                
                <li class="mb-2" id="exp-preview"></li>                
                <li class="mb-2" id="language-preview"></li>
                <li class="mb-2" id="itech-preview"></li>
                <li class="mb-2" id="salary-preview"></li>
                <li class="mb-2" id="gender-preview"></li>
                <li class="mb-2" id="region-preview"></li>
                <li class="mb-2" id="status-preview"></li>
                <li class="mb-2" id="deadline-preview"></li>
                <li class="mb-2" id="website-preview"></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-info  mt-3 h5 pl-3 mb-3 ">Share</h3>
              <div class="px-3">
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-info" onclick="event.preventDefault();
                           document.getElementById('post-job').submit();">          
          <span class="icon-newspaper-o mr-2"></span>Đăng tin
        </button>
          
      </div>
    </div>
  </div>
</div>
    
    <script src="{{url('js/job.js')}}"></script>
@endsection