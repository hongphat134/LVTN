@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">{{$news->nganh}}</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>{{$news->nganh}}</strong></span>
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
              <div class="border p-2 d-inline-block mr-3 rounded">                
              @if($owner->hinh)
              <a href="{{url('/thong-tin-ntd',$owner->idUser)}}"><img src="{{asset('logo/'.$owner->hinh)}}" alt="Image" style="width: 200px; height: 200px"></a>
              @else
              <a href="{{url('/thong-tin-ntd',$owner->idUser)}}"><img src="{{asset('logo/default.png')}}" alt="Image"></a>
              @endif
                
              </div>
              <div>
                <h2>
                  {{$news->nganh}}
                @if(Auth::check())
                  @if(Auth::user()->theodoi_ntd)
                    @if(in_array($owner->idUser,json_decode(Auth::user()->theodoi_ntd)))
                    <a href="javascript:void(0)" id="{{$owner->idUser}}" class="btn btn-danger theo-doi">ĐANG THEO DÕI</a>  
                    @else
                    <a href="javascript:void(0)" id="{{$owner->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
                    @endif
                  @else
                  <a href="javascript:void(0)" id="{{$owner->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
                  @endif
                <script src="{{url('ajax/follow-recruiters.js')}}"></script>
                @endif
                </h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span>Nhà tuyển dụng {{$owner->ten}}</span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary">{{$news->hinhthuc_lv}}</span></span></br>
                  @foreach(json_decode($news->tinhthanhpho) as $city)
                  <span class="ml-0 mr-2 mb-2"><span class="icon-room mr-2"></span>{{$city}}</span>
                  @endforeach                         
                  <hr class="hr-text" data-content="Yêu cầu kĩ năng">
                  <div class="keywords">
                  @foreach(json_decode($news->kinang) as $skill)
                  <button class="btn btn-outline-info btn-sm">{{$skill}}</button>
                  @endforeach                  
                  </div>   
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6 follow">
              @if(Auth::check()) 
                @if(!empty(Auth::user()->theodoi))
                  @if(in_array($news->id,json_decode(Auth::user()->theodoi)))
                  <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-dark btn-md">
                  <span class="icon-heart mr-2 text-danger"></span>
                  Đang theo dõi
                  </a>   
                  @else             
                  <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-light btn-md follow-news">
                  <span class="icon-heart-o mr-2 text-danger"></span>
                  Theo dõi tin tuyển dụng
                  </a>  
                  @endif                          
                @else
                <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-light btn-md follow-news">
                  <span class="icon-heart-o mr-2 text-danger"></span>
                  Theo dõi tin tuyển dụng
                </a>
                @endif
              @endif
              </div>
              <div class="col-6">
                @if(empty($hoso))
               <!--  <a href="{{--route('apply',$news->id)--}}" class="btn btn-block btn-primary btn-md">Ứng tuyển</a>       -->          
                <a href="{{url('/nguoitimviec/choose-apply',$news->id)}}" class="btn btn-block btn-primary btn-md">Ứng tuyển</a> 
                @else                
                <a href="javascript:void(0)" class="btn btn-block btn-danger btn-md">Đã nộp đơn vào </br>
                  {{date("d-m-Y", strtotime($hoso->created_at))}}
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="{{url('images/job_single_img_1.jpg')}}" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Mô tả công việc</h3>
               <ul class="list-unstyled m-0 p-0">
              @if($news->motacv)
                @foreach(json_decode($news->motacv) as $chitiet)
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{!! $chitiet !!}</span></li>
                @endforeach              
              @endif                
              </ul>              
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Quyền lợi</h3>
              <ul class="list-unstyled m-0 p-0">
              @if($news->quyenloi)
                @foreach(json_decode($news->quyenloi) as $quyenloi)
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{!! $quyenloi !!}</span></li>
                @endforeach
              @endif               
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Thông tin liên hệ</h3>
              <ul class="list-unstyled m-0 p-0">
              @if($news->ttlienhe)
                @foreach(json_decode($news->ttlienhe) as $chitiet)
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{!! $chitiet !!}</span></li>
                @endforeach
              @endif               
              </ul>
            </div> 
            @if($news->yeucau_cv)
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-asterisk mr-3"></span>Yêu cầu thêm</h3>
              <ul class="list-unstyled m-0 p-0">
              {!! nl2br($news->yeucau_cv) !!}             
              </ul>
            </div>          
            @endif
            <div class="row mb-5">
              @if(Auth::check())
                @if(!empty(Auth::user()->theodoi))
                  @if(in_array($news->id,json_decode(Auth::user()->theodoi)))
                  <div class="col-6 follow">                
                    <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-dark btn-md"><span class="icon-heart mr-2 text-danger"></span>Đang theo dõi</a>
                  </div>   
                  @else
                  <div class="col-6 follow">                
                    <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-light btn-md follow-news"><span class="icon-heart-o mr-2 text-danger"></span>Theo dõi tin tuyển dụng</a>                
                  </div>             
                  @endif
                @else
                <div class="col-6 follow">                
                  <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-light btn-md follow-news"><span class="icon-heart-o mr-2 text-danger"></span>Theo dõi tin tuyển dụng</a>                
                </div>
                @endif
              @endif
              <div class="col-6">
                @if(empty($hoso))
                <a href="{{route('apply',$news->id)}}" class="btn btn-block btn-primary btn-md">Ứng tuyển</a>
                @else
                <a href="javascript:void(0)" class="btn btn-block btn-danger btn-md">Đã nộp đơn vào {{date('d-m-Y',strtotime($hoso->created_at))}}</a>
                @endif
              </div>
            </div>

          </div>
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
             
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Tổng quan</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Ngày đăng:</strong> {{date("d-m-Y", strtotime($news->created_at))}}</li>
                <li class="mb-2"><strong class="text-black">Vị trí cần tuyển: <span class="badge badge-primary">{{$news->capbac}}</span></strong></li>
                <li class="mb-2"><strong class="text-black">Số lượng:</strong> {{$news->soluong}} người</li>                               
                <li class="mb-2"><strong class="text-black">Hình thức làm việc:</strong> {{$news->hinhthuc_lv}}</li>                
                <li class="mb-2"><strong class="text-black">Khu vực làm việc:</strong> 
                  @foreach(json_decode($news->tinhthanhpho) as $tp)
                  <span class="badge badge-dark">{{$tp}}</span>
                  @endforeach
                </li>
                <li class="mb-2"><strong class="text-black">Mức lương:</strong> {!!$news->mucluong!!}</li>                
                <li class="mb-2"><strong class="text-black">Hạn tuyển dụng: </strong><span class="text-danger">{{date("d-m-Y", strtotime($news->hantuyendung))}}</span></li>
                <li class="mb-2"><strong class="text-black">Thời gian thử việc: </strong><span class="text-info">{{$news->tg_thuviec}}</span></li>
                @if($news->website)
                <li class="mb-2"><strong class="text-black">Website:</strong> {{$news->website}}</li>
                @endif
                <li class="mb-2"><strong class="text-black">Lượt xem: </strong><span class="text-danger">{{$news->luotxem}}</span></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Yêu cầu</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Giới tính:</strong> {{$news->gioitinh}}</li>
                <li class="mb-2">
                  <strong class="text-black">Kĩ năng: </strong>
                  @foreach(json_decode($news->kinang) as $skill)
                  <span class="badge badge-info">{{$skill}}</span>
                @endforeach
                </li>
                <li class="mb-2">
                  <strong class="text-black">Trình độ: </strong>
                  {{$news->bangcap}}
                </li>
                <li class="mb-2">
                  <strong class="text-black">Kinh nghiệm: </strong>
                  {{$news->kinhnghiem}}
                </li>
                @if($news->ngoaingu)
                <li class="mb-2"><strong class="text-black">Ngoại ngữ:</strong>                 
                @foreach(json_decode($news->ngoaingu) as $language)
                  <span class="badge badge-secondary">{{$language}}</span>
                @endforeach
                </li>
                @endif
                
                @if($news->tinhoc)
                <li class="mb-2"><strong class="text-black">Trình độ tin học:</strong>                 
                @foreach(json_decode($news->tinhoc) as $itech)
                  <span class="badge badge-primary">{{$itech}}</span>
                @endforeach
                </li>
                @endif

              </ul>               
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">{{$related_jobs->count()}} tin tuyển dụng liên quan</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($related_jobs as $job)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$job->id)}}"></a>
            <div class="job-listing-logo">
              @if($job->hinh)
              <img src="{{url('logo/'.$job->hinh)}}" alt="{{$job->hinh}}" style="width: 200px; height: 150px">
              @else
              <img src="{{url('logo/default.png')}}" alt="Không có hình" class="img-fluid">
              @endif
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$job->nganh}}</h2>
                <strong>Nhà tuyển dụng {{$job->ten}}</strong>
                <div class="keywords">
                  @foreach(json_decode($job->kinang) as $skill)
                  <button class="btn btn-outline-info skill">{{$skill}}</button>
                  @endforeach                 
                </div>      
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">  
                @foreach(json_decode($job->tinhthanhpho) as $city)
                <span class="icon-room"></span>{{$city}}</br>
                @endforeach
              </div>
              <div class="job-listing-meta">
                @if($job->hinhthuc_lv == 'Part Time')
                <span class="badge badge-danger">{{$job->hinhthuc_lv}}</span>
                @else
                <span class="badge badge-success">{{$job->hinhthuc_lv}}</span>
                @endif
              </br>
                <span class="badge badge-dark">Giờ đăng: {{time_elapsed_string($job->created_at)}}</span>
              </br>
              <span class="badge badge-info">Hạn tuyển dụng: {{date("d-m-Y", strtotime($job->hantuyendung))}}</span>
              </div>              
            </div>            
          </li>
          @endforeach          
        </ul>
      </div>
    </section>
    

    <section class="bg-light pt-5 testimony-full">
        <div class="owl-carousel single-carousel">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Hãy đăng ký để trở thành hội viên của Website để sử dụng những dịch vụ tiện ích nhất&rdquo;</p>
                  <p><cite> &mdash; Hồng Phát, @HTP</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="{{asset('images/person_transparent_2.png')}}" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Tìm việc phù hợp & tuyển dụng nhân lực nhanh chóng.&rdquo;</p>
                  <p><cite> &mdash; Hồng Phát, @HTP</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="{{asset('images/person_transparent.png')}}" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>
      </div>
    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Mobile</h2>
            <p class="mb-5 lead text-white">Giao diện tương thích, tiện ích và dễ sử dụng.</p>
            <p class="mb-0">
              <a href="javascript:void(0)" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>IOS</a>
              <a href="javascript:void(0)" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Android</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="{{asset('images/apps.png')}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <!-- Ajax -->
    <script src="{{url('ajax/save-job.js')}}"></script>
@endsection