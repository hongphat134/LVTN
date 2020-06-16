@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
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
                <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>
              </div>
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md"
                        onclick="event.preventDefault();
                           document.getElementById('post-job').submit();">
                Đăng tin
              </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form id="post-job" action="{{route('postJob')}}" class="p-4 p-md-5 border rounded" method="post">
              {{csrf_field()}}
              <h3 class="text-black mb-5 border-bottom pb-2">Thông tin tuyển dụng</h3>@foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
               {{ $error }}
              </div>
              @endforeach                     

              <!-- <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="you@yourdomain.com">
              </div> -->

              <div class="form-group">
                <label for="job-title">Số lượng tuyển dụng</label>
                <input type="number" class="form-control" id="job-title" name="vacancy" placeholder="Nhập số lượng...." value="{{old('vacancy')}}">
              </div>
             <!--  <div class="form-group">
                <label for="job-location">Location</label>
                <input type="text" class="form-control" id="job-location" placeholder="e.g. New York">
              </div> -->

              <div class="form-group">
                <label for="job-region">Kĩ năng cần thiết</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="skill[]" title="Chọn kĩ năng..." multiple data-max-options="5">
                      @foreach($skill_list as $skill)
                      <option value="{{$skill->id}}" 
      {{ !empty(old('skill'))?(in_array($skill->id,old('skill')) ? 'selected':''):'' }}>
                        {{$skill->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>

              <div class="form-group">
                <label for="job-region">Ngành nghề cần tuyển</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="job" title="Chọn ngành nghề...">
                      @foreach($job_list as $job)
                      <option value="{{$job->ten}}"
                          {{ $job->ten == old('job') ? 'selected' : ''}}>
                        {{$job->ten}}
                      </option>
                      @endforeach
                    </select>
              </div>
              
              <div class="form-group">
                <label for="job-type">Yêu cầu trình độ</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="degree" title="Chọn yêu cầu...">
                @foreach($degree_list as $degree)                      
                  <option {{ $degree->ten == old('degree') ?'selected':''}}>{{$degree->ten}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Yêu cầu kinh nghiệm</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="exp" title="Chọn yêu cầu...">
                @foreach($exp_list as $exp)                      
                  <option {{ $exp->ten == old('exp') ?'selected':''}}>{{$exp->ten}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Mức lương</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="salary" title="Chọn mức lương...">
                @foreach($salary_list as $salary)                      
                  <option {{ $salary->ten == old('salary') ?'selected':''}}>{{$salary->ten}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Giới tính</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="gender" title="Chọn hình thức...">
                  <option selected>Bất kì</option>
                  <option {{old('gender') == 'Nam' ? 'selected':''}}>Nam</option>
                  <option {{old('gender') == 'Nữ' ? 'selected':''}}>Nữ</option>
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Hình thức làm việc</label>
                <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" name="status" title="Chọn hình thức...">
                  <option selected>Full Time</option>
                  <option {{ old('status') == 'Part Time' ? 'selected':''}}>Part Time</option>                  
                </select>
              </div>
              
              <div class="form-group">
                <label for="job-region">Nơi làm việc</label>
                <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" name="region[]" title="Chọn khu vực..." multiple data-max-options="3">
                      @foreach($city_list as $city)
                      <option
                    @if(old('region'))
                 {{ in_array($city->Title,old('region')) ? 'selected':'' }}     
                    @endif>
                        {{$city->Title}}</option>
                      @endforeach
                    </select>                    
              </div>

              <div class="form-group">
                <label for="job-description">Job Description</label>
                <div class="editor" id="editor-1">
                  <p>Write Job Description!</p>
                </div>
              </div>


              <h3 class="text-black my-5 border-bottom pb-2">Company Details</h3>
              <div class="form-group">
                <label for="company-name">Company Name</label>
                <input type="text" class="form-control" id="company-name" placeholder="e.g. New York">
              </div>

              <div class="form-group">
                <label for="company-tagline">Tagline (Optional)</label>
                <input type="text" class="form-control" id="company-tagline" placeholder="e.g. New York">
              </div>

              <div class="form-group">
                <label for="job-description">Company Description (Optional)</label>
                <div class="editor" id="editor-2">
                  <p>Description</p>
                </div>
              </div>
              
              <div class="form-group">
                <label for="company-website">Website (Optional)</label>
                <input type="text" class="form-control" id="company-website" placeholder="https://">
              </div>

              <div class="form-group">
                <label for="company-website-fb">Facebook Username (Optional)</label>
                <input type="text" class="form-control" id="company-website-fb" placeholder="companyname">
              </div>

              <div class="form-group">
                <label for="company-website-tw">Twitter Username (Optional)</label>
                <input type="text" class="form-control" id="company-website-tw" placeholder="@companyname">
              </div>
              <div class="form-group">
                <label for="company-website-tw">Linkedin Username (Optional)</label>
                <input type="text" class="form-control" id="company-website-tw" placeholder="companyname">
              </div>

              <div class="form-group">
                <label for="company-website-tw d-block">Upload Logo</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" hidden>
                </label>
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
                <a href="#" class="btn btn-block btn-primary btn-md">Save Job</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection