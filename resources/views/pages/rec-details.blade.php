@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông tin nhà tuyển dụng</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông tin nhà tuyển dụng</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mr-auto">
            <div class="border p-4 rounded">
              <ul class="list-unstyled block__47528 mb-0">
                <li><span class="active">Thông tin liên hệ</span></li>
                <li>Tên người liên hệ:<a href="#"> {{$ntd->tenlh}}</a></li>
                <li>Email liên hệ:<a href="#"> {{$ntd->email}}</a></li>
                <li>SDT liên hệ:<a href="#"> {{$ntd->sdt}}</a></li>
                <li>Địa chỉ:<a href="#"> {{$ntd->diachi}}, {{$ntd->tinhthanhpho}}</a></li>
              </ul>
            </div>
			@if(Auth::check())
            <div class="border p-4 rounded">            	
        		<span class="icon-asterisk mr-2"></span>Bạn có muốn nhận thông báo việc làm mới nhất từ Nhà tuyển dụng này?
        		<hr>
        		 <span class="icon-arrow-right mr-2"></span>
				@if(Auth::user()->theodoi_add)
					@if(in_array($ntd->idUser,json_decode(Auth::user()->theodoi_add)))
					<a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-danger theo-doi">ĐANG THEO DÕI</a>	
					@else
					<a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
					@endif
				@else
				<a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
				@endif
		    </div>
		    <script src="{{url('ajax/follow-recruiters.js')}}"></script>
		    @endif
          </div>
						
          <div class="col-lg-8 border" style="background-color: lav">
            <span class="text-primary d-block mb-5">
            	<img src="{{asset('logo/'.$ntd->hinh)}}" alt="">
            </span>
            <h2 class="mb-4">Công ty {{$ntd->ten}}</h2>
            <h4>Quy mô dân sự</h4>            
            <p>{{$ntd->quymodansu}}</p>
            <h4>Văn hoá & phúc lợi</h4>
            <p>{{$ntd->vanhoaphucloi}}</p>
            @if($ntd->website)
            <h4>Website</h4>
            <p>{{$ntd->website}}</p>
            @endif
            <!-- <p><a href="#" class="btn btn-primary btn-md mt-4">Hire Us, Our Agency</a></p> -->
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
              @if($job_listings->total() == 0) Rất tiếc! Hiện tại không có tin tuyển dụng nào cả!
              @else Có {{$job_listings->total()}} tin tuyển dụng
              @endif
            </h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$news->id)}}"></a>
            <div class="job-listing-logo">
              <img src="{{asset('logo/'.$ntd->hinh)}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$news->nganh}}</h2>
                <strong>Nhà tuyển dụng {{$news->ten}}</strong>              
                <div class="keywords">
                  @foreach(json_decode($news->kinang) as $skill)
                  <button class="btn btn-outline-info skill">{{$skill}}</button>
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
                @endif
                </br>
                <span class="badge badge-dark">
                Giờ đăng: {{ time_elapsed_string($news->updated_at) }}
                </span>         
                </br>
                <span class="badge badge-info">
                Hạn tuyển dụng: {{date('d/m/Y',strtotime($news->hantuyendung))}}
                </span>
              </div>
            </div>            
          </li>
          @endforeach       
        </ul>       
        @include('layouts.paginating')
       

      </div>
    </section>
@endsection