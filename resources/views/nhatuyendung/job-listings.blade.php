@include('layouts.header')
    <!-- MENU -->
    @include('ntd_layouts.menu')
    <!-- SEARCH -->
    @include('ntd_layouts.search')

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
            @if($news->congkhai == 1)
            <div class="ribbon-wrapper">
                <div class="ribbon green">Duyệt</div>  
            </div>
            <!-- Duyệt r` thì k dc sửa -->
            <a href="javascript:void(0)"></a>
            @else
            <a href="#"></a>                       
            @endif
            
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