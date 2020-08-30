@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image home-section" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Cập nhật tin tuyển dụng</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Cập nhật tin tuyển dụng</strong></span>
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
                <h2>Cập nhật tin tuyển dụng</h2>
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
                  <a href="#" class="btn btn-block btn-primary btn-md"
                          onclick="event.preventDefault();
                             document.getElementById('post-job').submit();">
                  <span class="icon-edit mr-2"></span>Cập nhật tin
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form id="post-job" action="{{route('updateJob',$news->id)}}" class="p-4 p-md-5 border rounded" method="post">
              {{csrf_field()}}
              <h3 class="text-black mb-5 border-bottom pb-2">Thông tin tuyển dụng</h3>
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
              </div>
              @endif            

              <div class="row form-group">
                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Hạn tuyển dụng 
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-2 col-sm-12{{ $errors->has('deadline') || session('errorDate') ? ' has-error' : '' }}">
                  <input type="date" class="form-control" name="deadline" value="{{$news->hantuyendung}}">
                  @if ($errors->has('deadline'))
                      <span class="help-block">
                          <strong>{{ $errors->first('deadline') }}</strong>
                      </span>                
                  @elseif (session('errorDate'))
                      <span class="help-block">
                          <strong>{{ session('errorDate') }}</strong>
                      </span>
                  @endif 
                </div>  

                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Số lượng
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-2 col-sm-12{{ $errors->has('vacancy')? ' has-error' : '' }}">                  
                  <input type="number" class="form-control" id="job-title" name="vacancy" min="1" max="99" placeholder="Nhập số lượng...." value="{{$news->soluong}}">
                  @if ($errors->has('vacancy'))
                      <span class="help-block">
                          <strong>{{ $errors->first('vacancy') }}</strong>
                      </span>
                  @endif
                </div>

                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Giới tính 
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-2 col-sm-12">
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="gender">
                    <option selected>Không yêu cầu</option>
                    <option {{$news->gioitinh == 'Nam' ? 'selected':''}}>Nam</option>
                    <option {{$news->gioitinh == 'Nữ' ? 'selected':''}}>Nữ</option>
                  </select> 
                </div> 
              </div>       

              <div class="row form-group">
                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Ngành nghề
                  <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-4 col-sm-12{{ $errors->has('job')? ' has-error' : '' }}">
                  <select class="selectpicker border" name="job" id="title" data-style="btn-white" data-width="100%" data-live-search="true" data-size="8" title="Chọn ngành nghề" required>
                    @if(in_array($news->nganh,$job_list))                                  
                      @foreach($job_list as $job)                      
                      <option {{ strcasecmp($news->nganh,$job) == 0?'selected':'' }}>{{$job}}</option>
                      @endforeach
                      <option value="other">Khác</option>
                    @else                                          
                      @foreach($job_list as $job)                      
                      <option>{{$job}}</option>                      
                      @endforeach  
                      <option value="other" selected="true">Khác</option>
                    @endif
                  </select> 
                  @if($errors->has('job'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job') }}</strong>
                        </span>
                  @endif 
                </div>  

                <div id="other_title" class="col-lg-6 col-sm-12" 
                @if(in_array($news->nganh,$job_list) && !session('errorJob')) style="display: none;"
                @endif>
                  <div class="row">
                    <label for="job" class="col-lg-4 col-sm-12 col-form-label">Ngành nghề khác
                     <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                    </label>              
                    <div class="col-lg-8 col-sm-12{{ session('errorJob')? ' has-error' : '' }}">                  
                      <input type="text" name="other_title" class="form-control" placeholder="Nhập tên ngành nghề..." value="{{ in_array($news->nganh,$job_list) ? '' : $news->nganh}}" required>
                      @if(session('errorJob'))
                        <span class="help-block">
                            <strong>{{ session('errorJob') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>    

              <div class="row form-group">
                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Kĩ năng cần thiết 
                  <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-4 col-sm-12{{ $errors->has('skill')? ' has-error' : '' }}">
                  <select class="selectpicker border rounded" id="skill-list" data-style="btn-black" data-width="100%" data-size="10" data-live-search="true" name="skill[]" title="Chọn kĩ năng (tối đa 5)" multiple data-max-options="5">
                  @empty($news->kinang)                    
                    @foreach($skill_list as $skill)
                    <option>{{$skill}}</option>
                    @endforeach
                  @else                  
                    @foreach($skill_list as $skill)
                    <option {{ in_array($skill,$news->kinang) ? 'selected' : ''}}>{{$skill}}</option>
                    @endforeach
                  @endempty
                  </select>
                  @if ($errors->has('skill'))
                      <span class="help-block">
                          <strong>{{ $errors->first('skill') }}</strong>
                      </span>
                  @endif 
                </div>                             

                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Vị trí tuyển dụng
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-4 col-sm-12{{ $errors->has('rank')? ' has-error' : '' }}">                  
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="rank" title="Chọn vị trí...">
                  @foreach($rank_list as $rank)                      
                    <option {{ $rank == $news->capbac ?'selected':''}}>{{$rank}}</option>
                  @endforeach
                  </select>
                  @if ($errors->has('rank'))
                      <span class="help-block">
                          <strong>{{ $errors->first('rank') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row form-group">
                <label for="job" class="col-lg-3 col-sm-12 col-form-label">Yêu cầu kinh nghiệm 
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-3 col-sm-12{{ $errors->has('exp')? ' has-error' : '' }}">
                  <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn yêu cầu...">
                  @foreach($exp_list as $exp)                      
                    <option {{ $exp == $news->kinhnghiem ?'selected':''}}>{{$exp}}</option>
                  @endforeach
                  </select>
                  @if ($errors->has('exp'))
                      <span class="help-block">
                          <strong>{{ $errors->first('exp') }}</strong>
                      </span>
                  @endif
                </div>  

                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Mức lương
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-4 col-sm-12{{ $errors->has('salary')? ' has-error' : '' }}">                  
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="salary" title="Chọn mức lương...">
                  @foreach($salary_list as $salary)                      
                    <option {{ $salary == $news->mucluong ?'selected':''}}>{{$salary}}</option>
                  @endforeach
                  </select>
                  @if ($errors->has('salary'))
                      <span class="help-block">
                          <strong>{{ $errors->first('salary') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row form-group">
                <label for="job" class="col-lg-3 col-sm-12 col-form-label">Yêu cầu trình độ 
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-3 col-sm-12{{ $errors->has('degree')? ' has-error' : '' }}">
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="degree" title="Chọn yêu cầu...">
                @foreach($degree_list as $degree)                      
                  <option {{ $degree == $news->bangcap ?'selected':''}}>{{$degree}}</option>
                @endforeach
                </select>
                @if ($errors->has('degree'))
                    <span class="help-block">
                        <strong>{{ $errors->first('degree') }}</strong>
                    </span>
                @endif 
                </div>  

                <label for="job" class="col-lg-3 col-sm-12 col-form-label">Hình thức làm việc
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-3 col-sm-12{{ $errors->has('status')? ' has-error' : '' }}">                  
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="status">                    
                    <option selected>Full Time</option>
                    <option {{ $news->trangthailv == 'Part Time' ? 'selected':''}}>Part Time</option>
                </select>
                </div>
              </div>         
              
              <div class="row form-group">
                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Nơi làm việc
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>               
                <div class="col-lg-4 col-sm-12{{ $errors->has('region')? ' has-error' : '' }}">
                  <select class="selectpicker border rounded" id="region-list" data-style="btn-black" data-width="100%" data-live-search="true" name="region[]" title="Chọn khu vực (tối đa 3)" data-size="10" multiple data-max-options="3">                     
                  @foreach($region_list as $region => $city_list)  
                  <optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
                    @foreach($city_list as $city)
                    <option                   
                      {{ in_array($city->Ten,json_decode($news->tinhthanhpho)) ? 'selected=true': '' }}>
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

                <label for="job" class="col-lg-2 col-sm-12 col-form-label">Thời gian thử việc
                <sup><span class="text-danger"><i class="icon-asterisk"></i></span></sup>
                </label>              
                <div class="col-lg-4 col-sm-12{{ $errors->has('probation')? ' has-error' : '' }}">                  
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="probation">
                    <option selected>Nhận việc ngay</option>                  
                    <option {{$news->tg_thuviec == '1 tháng' ? 'selected' : '' }}>1 tháng</option>
                    <option {{$news->tg_thuviec == '2 tháng' ? 'selected' : '' }}>2 tháng</option>
                    <option {{$news->tg_thuviec == '3 tháng' ? 'selected' : '' }}>3 tháng</option>
                    <option {{$news->tg_thuviec == 'Trao đổi trực tiếp khi phỏng vấn' ? 'selected' : '' }}>Trao đổi trực tiếp khi phỏng vấn</option>
                </select>
                </div>
              </div> 
              
              <?php 
                $other_languages = '';
                if($news->ngoaingu)
                foreach(json_decode($news->ngoaingu) as $language) {
                  if(!in_array($language, $language_list)) $other_languages .= $language.',';
                }
              ?>
              <h3 class="text-black my-5 border-bottom pb-2">Yêu cầu trình độ ngoại ngữ</h3>
              <div class="row form-group">              
                <label for="language" class="col-lg-2 col-sm-12 col-form-label">Ngoại ngữ &nbsp;
                  <span class="text-primary"><i class="icon-language"></i></span>
                </label>              
                <div class="col-lg-4 col-sm-12">
                  <select class="selectpicker border rounded" data-style="btn-black" data-width="100%" data-live-search="true" name="language[]" id="language" title="Chọn ngoại ngữ..." multiple>
                    @if($news->ngoaingu)
                      @foreach($language_list as $language)
                      <option 
                      {{in_array($language, json_decode($news->ngoaingu) ) ? 'selected' : ''}}>
                      {{$language}}
                      </option>
                      @endforeach
                    @else
                      @foreach($language_list as $language)
                      <option>{{$language}}</option>
                      @endforeach
                    @endif   
                    <option value="other"{{ $other_languages ? 'selected' : ''}}>Ngôn ngữ khác
                      </option>             
                  </select>                
                </div>  

                <div id="other_language" class="col-lg-6 col-sm-12" 
                @if(!$other_languages) style="display: none;"
                @endif>
                  <div class="row">
                    <label for="job" class="col-lg-4 col-sm-12 col-form-label">Ngoại ngữ khác &nbsp;
                     <sup><span class="text-primary"><i class="icon-language"></i></span></sup>
                    </label>              
                    <div class="col-lg-8 col-sm-12">                  
                      <input type="text" name="other_language" class="form-control" placeholder="Nếu nhập nhiều, hãy nhập (VD: Anh,Pháp,Đức,...)" value="{{$other_languages ? substr($other_languages, 0, -1) : ''}}" required>
                    </div>
                  </div>
                </div>
              </div>

              <?php 
                $other_itechs = '';
                if($news->tinhoc)
                foreach(json_decode($news->tinhoc) as $itech) {
                  if(!in_array($itech, $itech_list)) $other_itechs .= $itech.',';
                }
              ?>
              <h3 class="text-black my-5 border-bottom pb-2">Yêu cầu trình độ tin học</h3>
                <div class="row form-group">              
                  <label for="itech" class="col-lg-2 col-sm-12 col-form-label">Phần mềm &nbsp;
                    <span class="text-primary"><i class="icon-gear"></i></span>
                  </label>              
                  <div class="col-lg-4 col-sm-12">
                     <select class="selectpicker border rounded" name="itech[]" id="itech" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn phần mềm" multiple>
                       @if($news->tinhoc)
                        @foreach($itech_list as $itech)
                        <option {{in_array($itech, json_decode($news->tinhoc) ) ? 'selected' : ''}}>
                        {{$itech}}
                        </option>
                        @endforeach
                      @else
                        @foreach($itech_list as $itech)
                        <option>{{$itech}}</option>
                        @endforeach
                      @endif         
                      <option value="other" {{ $other_itechs ? 'selected' : ''}}>Phần mềm khác</option>
                    </select>  
                  </div>                

                <div id="other_itech" class="col-lg-6 col-sm-12" 
                @if(!$other_itechs) style="display: none;"
                @endif>
                  <div class="row">
                    <label for="job" class="col-lg-4 col-sm-12 col-form-label">Phần mềm khác &nbsp;
                     <sup><span class="text-primary"><i class="icon-hand-o-right"></i></span></sup>
                    </label>              
                    <div class="col-lg-8 col-sm-12">                  
                      <input type="text" name="other_itech" class="form-control" id="name" placeholder="Nhập tên phần mềm...(Access,Visio,Github,...)" value="{{ $other_itechs ? substr($other_itechs, 0, -1) : '' }}" required>
                    </div>
                  </div>
                </div>
              </div>
          
              <h3 class="text-black my-5 border-bottom pb-2">Mô tả công việc</h3>
              <div class="form-group">
              @if($news->motacv)
                @foreach(json_decode($news->motacv) as $des)
                <input type="text" name="des_job[]" class="form-control" placeholder="Nội dung..." value="{{$des}}">
                @endforeach                
              @endif
                <input type="text" name="des_job[]" class="form-control" placeholder="Nội dung...">                
                <button type="button" id="des-job" class=" btn btn-secondary form-control">Thêm <span class="icon-plus"></span>
                </button>
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Quyền lợi</h3>
              <div class="form-group">
              @if($news->quyenloi)
                @foreach(json_decode($news->quyenloi) as $benefit)
                <input type="text" name="benefit[]" class="form-control" placeholder="Nội dung..." value="{{$benefit}}">
                @endforeach                             
              @endif
                <input type="text" name="benefit[]" class="form-control" id="company-name" placeholder="Nội dung...">
                <button type="button" id="benefit" class="btn btn-dark btn-block">
                Thêm <span class="icon-plus"></span></button>               
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Thông tin liên hệ</h3>
              <div class="form-group">
              @if($news->ttlienhe)
                @foreach(json_decode($news->ttlienhe) as $info)
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin..." value="{{$info}}">
                @endforeach              
              @endif
                <input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin...">
                <button type="button" id="info-contact" class="btn btn-primary form-control">Thêm <span class="icon-plus"></span></button>
              </div>

               <h3 class="text-black my-5 border-bottom pb-2">Thông tin thêm</h3>
              <div class="form-group">
                <textarea class="form-control" name="plus" cols="30" rows="3" placeholder="Nhập yêu cầu....">{{ $news->yeucau_cv}}</textarea>
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
                <a href="#" class="btn btn-block btn-primary btn-md"
                        onclick="event.preventDefault();
                           document.getElementById('post-job').submit();">                  
                  <span class="icon-edit mr-2"></span>Cập nhật tin
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

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-info"><span class="icon-turned_in mr-3"></span>Yêu cầu thêm</h3>
              <ul class="list-unstyled m-0 p-0" id="plus-preview">                
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
                <li class="mb-2" id="salary-preview"></li>
                <li class="mb-2" id="gender-preview"></li>
                <li class="mb-2" id="region-preview"></li>
                <li class="mb-2" id="status-preview"></li>
                <li class="mb-2" id="probation-preview"></li>
                <li class="mb-2" id="deadline-preview"></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-info  mt-3 h5 pl-3 mb-3">Yêu cầu trình độ ngoại ngữ</h3>
              <div class="px-3" id="language-preview">               
              </div>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-info mt-3 h5 pl-3 mb-3">Yêu cầu trình độ tin học</h3>
              <div class="px-3" id="itech-preview">                
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
          <span class="icon-newspaper-o mr-2"></span>Cập nhật tin
        </button>
          
      </div>
    </div>
  </div>
</div>

    <script src="{{url('js/job.js')}}"></script>
@endsection