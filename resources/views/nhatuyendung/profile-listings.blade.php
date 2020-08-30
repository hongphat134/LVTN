@include('layouts.header')
    <!-- MENU -->
    @include('ntd_layouts.menu')
    <!-- SEARCH -->
    @include('ntd_layouts.search')          
    
    <section class="site-section" id="content">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            @if($profile_list->total() == 0)
            <h2 class="section-title mb-2">Hiện tại không có hồ sơ tìm việc nào cả!</h2>
            @else
            <h2 class="section-title mb-2">Có {{$profile_list->total()}} hồ sơ <span class="icon-find_in_page"></span> tìm việc công khai</h2>
            @endif
          </div>
        </div>
        <ul class="job-listings mb-5">
          @foreach($profile_list as $profile)          
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">             
            <a href="{{route('detailPf',$profile->id)}}"></a>
            <div class="job-listing-logo">
               
    @if($profile->hinh)
    <img src="{{url('hinhdaidien/'.$profile->hinh)}}" alt="{{$profile->hinh}}" class="img-fluid" style="width: 150px; height: 150px !important;">
    @else  
    <img src="{{url('hinhdaidien/default.png')}}" alt="Hình mặc định" class="img-fluid" style="width: 150px; height: 150px !important;">
    @endif
     
              
            </div>
            <div class="ribbon-wrapper">
              <div class="ribbon red">Hot</div>
            </div>
            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$profile->nganh}} (<span class="text-info">{{$profile->kinhnghiem}}</span>)</h2>

                Họ tên: <strong>{{$profile->hoten}}</strong> - Giới tính: <strong>{{$profile->gioitinh}}</strong></br>
                Trình độ: <strong>{{$profile->bangcap}}</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> {{$profile->khuvuc}}
              </div>
              <div class="job-listing-meta">
                @if($profile->sdtlienhe)
                <span class="badge badge-dark">SDT liên hệ: {{$profile->sdtlienhe}}</span></br>
                @endif
                <span class="badge badge-primary">Mức lương mong muốn: {{$profile->mucluongmm}}</span></br>                            
                <span class="badge badge-info">Ngày cập nhật</span>
                <span class="badge badge-danger">{{date('d/m/Y',strtotime($profile->updated_at))}}</span>
              </div>
            </div>            
          </li>    
          @endforeach      
        </ul>
        
        @include('layouts.paginating',['job_listings' => $profile_list]) 
      </div>
    </section>

    @include('layouts.looking-job')

    
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

    <section class="pt-5 bg-image overlay-primary fixed overlay" 
    style="background-image: url({{ asset('images/hero_1.jpg') }})">
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
    <!-- TÔ ĐẬM Search Result => Cần cải tiến-->
    <script>      
        var search = $("#search").val();
        // console.log(search);
        var s = $("body .job-listing-position h2");
        
        $.each(s,function(k,v){
          var regex = new RegExp(search, "i");
          var str = v.innerText;
          if (str.search(regex) != -1) {  
             v.innerHTML = str.replace(regex, "<b style='background-color:red'>$&</b>");
          }
          // console.log(v);
        });          
    </script>
@include('layouts.footer')