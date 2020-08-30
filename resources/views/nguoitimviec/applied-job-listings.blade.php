@include('layouts.header')
    <!-- MENU -->
    @include('ntv_layouts.menu')
    <!-- HOME -->
    @include('layouts.search')

    <section class="site-section" id="next">
      <div class="container">
      
        @if($job_listings->total() != 0)
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
              Đã ứng tuyển {{ $job_listings->total()}} tin tuyển dụng
            </h2>
          </div>
        </div>    
        
        <ul class="job-listings mb-5">          
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$news->id)}}"></a>
            <div class="job-listing-logo">
              @if($news->hinh)
              <img src="{{url('logo/'.$news->hinh)}}" alt="{{$news->hinh}}" style="width: 200px; height: 150px">
              @else
              <img src="{{url('logo/default.png')}}" alt="Không có hình" class="img-fluid">
              @endif
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$news->nganh}}</h2>
                <strong>{{$news->ten}}</strong>
                <div class="keywords">
                  @foreach(json_decode($news->kinang) as $skill)
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
                @if($news->hinhthuc_lv == 'Part Time')
                <span class="badge badge-danger">{{$news->hinhthuc_lv}}</span>
                @else
                <span class="badge badge-success">{{$news->hinhthuc_lv}}</span>
                @endif
              </div>
            </div>            
          </li>
          @endforeach     
        </ul>

        @include('layouts.paginating',['job_listings' => $job_listings])

        @else 
        <p>Bạn chưa ứng tuyển <a href="{{url('/job-list')}}">tin tuyển dụng</a> nào cả! Hãy tìm <a href="{{url('/job-list')}}">tin tuyển dụng</a> phù hợp và ứng tuyển để có cơ hội tìm được việc làm mình mong muốn bạn nhé!</p>
        @endif  
      </div>
    </section>

    @include('layouts.looking-job')
    
@include('layouts.footer')