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
                <!-- <img src="images/job_logo_5.jpg" alt="Image"> -->
                <img src="{{asset('logo/'.$news->hinh)}}" alt="Image">
              </div>
              <div>
                <h2>{{$news->nganh}}</h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span>{{$news->ten}}</span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary">{{$news->trangthailv}}</span></span></br>
                  @foreach(json_decode($news->tinhthanhpho) as $city)
                  <span class="ml-0 mr-2 mb-2"><span class="icon-room mr-2"></span>{{$city}}</span>
                  @endforeach                         
                  <hr class="hr-text" data-content="Yêu cầu kĩ năng">
                  <div class="keywords">
                  @foreach($news->kinang as $skill)
                  <button class="btn btn-outline-info btn-sm">{{$skill->ten}}</button>
                  @endforeach                  
                  </div>   
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6 follow">
              @if(Auth::check() && !empty(Auth::user()->theodoi) ) 
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
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{!! $news->motacv !!}</span></li>
              </ul>              
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Necessitatibus quibusdam facilis</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et voluptas reiciendis n Velit unde aliquam et voluptas reiciendis non sapiente labore</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est itaque</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores blanditiis nihil quia officiis dolor</span></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Necessitatibus quibusdam facilis</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et voluptas reiciendis non sapiente labore</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est itaque</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores blanditiis nihil quia officiis dolor</span></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Những quyền lợi khác</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{{$news->quyenloi}}</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et voluptas reiciendis non sapiente labore</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est itaque</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores blanditiis nihil quia officiis dolor</span></li>
              </ul>
            </div>

            <div class="row mb-5">
              @if(Auth::check() && !empty(Auth::user()->theodoi) )
                @if(in_array($news->id,json_decode(Auth::user()->theodoi)))
                <div class="col-6 follow">                
                  <a href="javascript:void(0)" id="{{$news->id}}" class="btn btn-block btn-dark btn-md"><span class="icon-heart mr-2 text-danger"></span>Đang theo dõi</a>
                </div>   
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
                <li class="mb-2"><strong class="text-black">Số lượng:</strong> {{$news->soluong}}</li>
                <li class="mb-2"><strong class="text-black">Yêu cầu trình độ:</strong> {{$news->bangcap}}</li>
                <li class="mb-2"><strong class="text-black">Yêu cầu kĩ năng:</strong> 
                
                @foreach($news->kinang as $skill)
                <span class="badge badge-info">{{$skill->ten}}</span>
                @endforeach
                
                </li>
                <li class="mb-2"><strong class="text-black">Trạng thái làm việc:</strong> {{$news->trangthailv}}</li>
                <li class="mb-2"><strong class="text-black">Kinh nghiệm:</strong> {{$news->kinhnghiem}}</li>
                <li class="mb-2"><strong class="text-black">Khu vực làm việc:</strong> 
                  @foreach(json_decode($news->tinhthanhpho) as $tp)
                  <span class="badge badge-dark">{{$tp}}</span>
                  @endforeach
                </li>
                <li class="mb-2"><strong class="text-black">Mức lương:</strong> {!!$news->mucluong!!}</li>
                <li class="mb-2"><strong class="text-black">Giới tính:</strong> {{$news->gioitinh}}</li>
                <li class="mb-2"><strong class="text-black">Hạn tuyển dụng: </strong><span class="text-danger">{{date("d-m-Y", strtotime($news->hantuyendung))}}</span></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
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

    <section class="site-section" id="next">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">22,392 Related Jobs</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_1.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Adidas</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> New York, New York
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-danger">Part Time</span>
              </div>
            </div>
            
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_2.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Digital Marketing Director</h2>
                <strong>Sprint</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_3.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Back-end Engineer (Python)</h2>
                <strong>Amazon</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_4.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Senior Art Director</h2>
                <strong>Microsoft</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Anywhere 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_5.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Puma</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> San Mateo, CA 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_1.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Adidas</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> New York, New York
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-danger">Part Time</span>
              </div>
            </div>
            
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.html"></a>
            <div class="job-listing-logo">
              <img src="{{url('images/job_logo_2.jpg')}}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Digital Marketing Director</h2>
                <strong>Sprint</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          

          
        </ul>

        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-7 Of 22,392 Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Prev</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Next</a>
            </div>
          </div>
        </div>

      </div>
    </section>
    

    <section class="bg-light pt-5 testimony-full">
        
        <div class="owl-carousel single-carousel">

        
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="{{url('images/person_transparent_2.png')}}" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Chris Peters, @Google</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="{{url('images/person_transparent.png')}}" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

      </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url({{ url('images/hero_1.jpg')}})">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Get The Mobile Apps</h2>
            <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
            <p class="mb-0">
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="{{url('images/apps.png')}}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <!-- Ajax -->
    <script src="{{url('ajax/save-job.js')}}"></script>
@endsection