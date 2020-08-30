@include('layouts.header')
    <!-- MENU -->
    @if(Auth::check()) @include('ntv_layouts.menu')     
    @else @include('layouts.menu')
    @endif     
    <!-- HOME -->
    @include('layouts.search')

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
              @if($news->hinh)
              <img src="{{url('logo/'.$news->hinh)}}" alt="{{$news->hinh}}" style="width: 200px; height: 150px">
              @else
              <img src="{{url('logo/default.png')}}" alt="{{$news->hinh}}" class="img-fluid">
              @endif
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
                @if($news->hinhthuc_lv == 'Part Time')
                <span class="badge badge-danger">{{$news->hinhthuc_lv}}</span>
                @else
                <span class="badge badge-success">{{$news->hinhthuc_lv}}</span>
                @endif
                </br>
                <span class="badge badge-dark">
                Mức lương: {{ $news->mucluong }}
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
    @include('layouts.looking-job')
    
@include('layouts.footer')