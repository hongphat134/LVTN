@include('layouts.header')
    <!-- SEARCH -->
    <section class="section-hero home-section overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quas fugit ex!</p>
            </div>
            <form method="post" class="search-jobs-form">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text" class="form-control form-control-lg" placeholder="Job title, Company...">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region">
                    <option>Anywhere</option>
                    <option>San Francisco</option>
                    <option>Palo Alto</option>
                    <option>New York</option>
                    <option>Manhattan</option>
                    <option>Ontario</option>
                    <option>Toronto</option>
                    <option>Kansas</option>
                    <option>Mountain View</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type">
                    <option>Part Time</option>
                    <option>Full Time</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Search Job</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 popular-keywords">
                  <h3>Trending Keywords:</h3>
                  <ul class="keywords list-unstyled m-0 p-0">
                    <li><a href="#" class="">UI Designer</a></li>
                    <li><a href="#" class="">Python</a></li>
                    <li><a href="#" class="">Developer</a></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>
    </section>

    <!-- HOME -->
    <section class="site-section" id="next">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">{{$job_listings->total()}} tin tuyển dụng đã đăng</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="#"></a>
            <div class="job-listing-logo">
              <img src="{{url('logo/'.$news->hinh)}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>
                  {{$news->nganh}}
                  <span class="badge badge-danger">Loại tin: tin miễn phí</span>
                </h2>
                <strong>Ngày cập nhật: {{date('d/m/Y',strtotime($news->updated_at))}}</strong>
                <div class="keywords">
                  @foreach($news->kinang as $skill)
                  <button class="btn btn-outline-info">{{$skill}}</button>
                  @endforeach                 
                  
                </div>                
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                @foreach(json_decode($news->tinhthanhpho) as $city)
                <span class="icon-room"></span>{{$city}}</br>
                @endforeach
              </div>
              <div class="job-listing-meta">
                @if($news->trangthailv == 'Part Time')
                <span class="badge badge-danger">{{$news->trangthailv}}</span>
                @else
                <span class="badge badge-success">{{$news->trangthailv}}</span>
                <span class="badge badge-pill badge-light text-dark">
                  {{$news->congkhai == 1 ? 'Công khai' : 'Đã ẩn'}}
                </span>
                @endif
                </br>
                <span class="badge badge-info">Hạn tuyển dụng</span>
                <span class="badge badge-danger">
                  {{date('d/m/Y',strtotime($news->hantuyendung))}}
                </span>                              
                </br>
                <span class="badge badge-dark">Lượt nộp: 0</span>
                <span class="badge badge-warning text-dark">Lượt xem: 0</span>
              </div>               
            </div>  

          </li>
          <div class="form-row">
            <div class="col">
            <form action="{{url('nhatuyendung/delete-job/'.$news->id)}}" method="post">
              <button type="submit" class="btn btn-outline-danger form-control">
              <i class="icon-trash"></i>  XOÁ
              </button>
              {!! method_field('delete') !!}
              {!! csrf_field() !!}
            </form>
            </div>
            <div class="col">
              <a href="{{route('updateJob',$news->id)}}"><button class="btn btn-outline-success form-control"><i class="icon-search"></i> CẬP NHẬT</button></a>
            </div>            
          </div>
          <!-- <button class="btn btn-outline-danger form-control">XOÁ</button>           -->
          @endforeach
          
        </ul>

        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-{{$job_listings->perPage()}} trong {{$job_listings->total()}} công việc</span>
          </div>
          @include('layouts.paginating')
        </div>

      </div>
    </section>

    @include('layouts.looking-job')
    
@include('layouts.footer')