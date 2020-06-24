@include('layouts.header')
    <!-- HOME -->
    @include('layouts.search')

    <section class="site-section" id="next">
      <div class="container">
      
        @if($job_listings)
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
              Đang theo dõi {{ $job_listings->total()}} tin tuyển dụng
            </h2>
          </div>
        </div>    
        
        <ul class="job-listings mb-5">          
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$news->id)}}"></a>
            <div class="job-listing-logo">
              <img src="{{url('logo/'.$news->hinh)}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$news->nganh}}</h2>
                <strong>{{$news->ten}}</strong>
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
                @endif
              </div>
            </div>            
          </li>
          @endforeach     
        </ul>

        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-{{$job_listings->perPage()}} trong {{$job_listings->total()}} Jobs</span>
          </div>
          @include('layouts.paginating')
        </div>

        @else 
        <p>Bạn chưa theo dõi tin nào cả!</p>
        @endif  
      </div>
    </section>

    @include('layouts.looking-job')
    
@include('layouts.footer')