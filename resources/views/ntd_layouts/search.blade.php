<section class="section-hero home-section overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">Cách nhanh nhất để tìm kiếm nhân lực</h1>
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quas fugit ex!</p> -->
            </div>
            <form method="get" class="search-jobs-form" action="{{url('/nhatuyendung/tim-kiem')}}">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input id="search" name="key" type="text" class="form-control form-control-lg" placeholder="ngành, kỹ năng..." 
                  value="@isset($search_info){{$search_info['key']}}@endisset">

                  <ul class="list-group" id="job-skill-autocomplete">       
                  </ul>                               
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <!-- Multi -->
                  <select name="region[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn khu vực..." data-size="10" data-max-options="3" multiple>
                  @foreach($region_list as $region => $city_list) 
                <optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
                  @isset($search_info)
                    @isset($search_info['region'])          
                      @foreach($city_list as $city)
                      <option {{ in_array($city->Ten,$search_info['region']) ? 'selected' : '' }}>
                        {{$city->Ten}}
                      </option>
                      @endforeach
                    @else
                      @foreach($city_list as $city)
                      <option>{{$city->Ten}}</option>
                      @endforeach
                    @endisset
                  @else
                    @foreach($city_list as $city)
                    <option>{{$city->Ten}}</option>
                    @endforeach
                  @endisset     
                </optgroup>
                  @endforeach
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select name="salary[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn mức lương..." data-size="10" data-max-options="3" multiple>  
                  @isset($search_info)
                    @isset($search_info['salary'])          
                      @foreach($salary_list as $salary)
                      <option {{ in_array($salary,$search_info['salary']) ? 'selected' : '' }}>
                        {{$salary}}
                      </option>
                      @endforeach
                    @else
                      @foreach($salary_list as $salary)
                      <option>{{$salary}}</option>
                      @endforeach
                    @endisset
                  @else
                    @foreach($salary_list as $salary)
                    <option>{{$salary}}</option>
                    @endforeach
                  @endisset
                </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-info btn-lg btn-block text-white btn-search"><span class="icon-find_in_page mr-1"></span>Tìm kiếm hồ sơ</button>
                </div>
              </div>

              <!-- NÂNG CAO --> 
    <div class="row mb-5">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <a class="text-white" id="advanced-search" href="javascript:void(0)" style="text-decoration: none;">
      Tìm kiếm nâng cao 
      @isset($search_info)
        {{-- var_dump($search_info) --}}
        @if(isset($search_info['sex']) || isset($search_info['number']) || isset($search_info['status']) || 
         isset($search_info['job']) || isset($search_info['skill']) || isset($search_info['rank']) || isset($search_info['degree']) || isset($search_info['exp']))
        <span class="icon-chevron-down"></span>
        @else
        <span class="icon-chevron-right"></span>  
        @endif      
      @else
      <span class="icon-chevron-right"></span>
      @endisset
      </a>  
      </div>
    </div>  
      
    <!-- HÀNG 1 -->
    <div class="row mb-5 advanced-search-form">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">    
      <select name="job[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn thêm ngành nghề..." data-size="10" data-max-options="3" multiple>       
        @isset($search_info)
          @isset($search_info['job'])         
            @foreach($job_list as $job)
            <option {{ in_array($job,$search_info['job']) ? 'selected' : '' }}>
              {{$job}}
            </option>
            @endforeach
          @else
            @foreach($job_list as $job)
            <option>{{$job}}</option>
            @endforeach
          @endisset
        @else
          @foreach($job_list as $job)
          <option>{{$job}}</option>
          @endforeach
        @endisset
      </select>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <select name="skill[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn kĩ năng..." data-size="10" data-max-options="5" multiple>       
          @isset($search_info)
          @isset($search_info['skill'])         
            @foreach($skill_list as $skill)
            <option {{ in_array($skill,$search_info['skill']) ? 'selected' : '' }}>
              {{$skill}}
            </option>
            @endforeach
          @else
            @foreach($skill_list as $skill) 
              <option>{{$skill}}</option>
              @endforeach
          @endisset
        @else
          @foreach($skill_list as $skill) 
            <option>{{$skill}}</option>
            @endforeach
        @endisset
      </select>
      </div>
    
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <select name="degree[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn bằng cấp..." data-size="10" data-max-options="3" multiple>       
        @isset($search_info)
          @isset($search_info['degree'])          
            @foreach($degree_list as $degree)
            <option {{ in_array($degree,$search_info['degree']) ? 'selected' : '' }}>
              {{$degree}}
            </option>
            @endforeach
          @else
            @foreach($degree_list as $degree)
            <option>{{$degree}}</option>
            @endforeach
          @endisset
        @else
          @foreach($degree_list as $degree)
          <option>{{$degree}}</option>
          @endforeach
        @endisset
      </select>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <select name="rank[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn cấp bậc..." data-size="10" data-max-options="3" multiple>
        @isset($search_info)
          @isset($search_info['rank'])          
            @foreach($rank_list as $rank)
            <option {{ in_array($rank,$search_info['rank']) ? 'selected' : '' }}>
              {{$rank}}
            </option>
            @endforeach
          @else
            @foreach($rank_list as $rank)
              <option>{{$rank}}</option>
            @endforeach
          @endisset
        @else
          @foreach($rank_list as $rank)
            <option>{{$rank}}</option>
          @endforeach
        @endisset
      </select>
      </div>
    </div>
    <!-- END HÀNG 1 -->
    <!-- HÀNG 2 -->
    <div class="row mb-5 advanced-search-form">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">  
      <select name="sex" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn giới tính...">
        <option value="">Bất kì giới tính nào</option>
        <option @isset($search_info['sex']) {{$search_info['sex'] == 'Nam' ? 'selected' : ''  }}@endisset>Nam</option>
        <option @isset($search_info['sex']) {{$search_info['sex'] == 'Nữ' ? 'selected' : ''  }}@endisset>Nữ</option>        
      </select>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <select name="exp" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn kinh nghiệm...">
        <option value="">Bất kì kinh nghiệm nào</option>
          @isset($search_info)
          @isset($search_info['exp'])                     
            @foreach($exp_list as $exp) 
              <option {{ $exp == $search_info['exp'] ? 'selected' : '' }}>
              {{$exp}}
              </option>
              @endforeach
          @else
            @foreach($exp_list as $exp) 
              <option>{{$exp}}</option>
              @endforeach
          @endisset
        @else
          @foreach($exp_list as $exp) 
            <option>{{$exp}}</option>
            @endforeach
        @endisset
      </select>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <select name="status" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn hình thức..."> 
        <option value="">Bất kì hình thức nào</option>
        <option @isset($search_info['status']) {{$search_info['status'] == 'Full Time' ? 'selected' : ''  }}@endisset>Full Time</option>
        <option @isset($search_info['status']) {{$search_info['status'] == 'Part Time' ? 'selected' : ''  }}@endisset>Part Time</option>
      </select>
      </div> 

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <input type="reset" id="reset-form" class="form-control btn-danger" value="Reset Form">
      </div>   
    </div>
    <!-- END HÀNG 2 -->   
    <!-- HÀNG 3 -->
    <!-- <div class="row form-group mb-5 advanced-search-form">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <input type="reset" id="reset-form" class="form-control btn-danger" value="Reset Form">
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="condition" value="or" checked>
          <label class="form-check-label text-white" for="Or">          
          Thoả 1 trong số điều kiện trên
          </label>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-5 mb-4 mb-lg-0">        
        <div class="form-check">          
          <input class="form-check-input" type="radio" name="condition" value="or">
          <label class="form-check-label text-white" for="And">
          Thoả tất cả những điều kiện trên
          </label>
        </div>
      </div>
    </div> -->
    <!-- END HÀNG 3 -->   
    </form>
    <!-- END NÂNG CAO  -->

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
<script src="{{url('ajax/autocomplete.js')}}"></script>
<script>
  $(document).ready(function(){   
    @isset($search_info)
    @if(isset($search_info['sex']) || isset($search_info['number']) || isset($search_info['status']) || isset($search_info['job']) || isset($search_info['skill']) || isset($search_info['rank']) || isset($search_info['degree']) || isset($search_info['exp']))
    $(".advanced-search-form").css({'display':'flex'});
    @else $(".advanced-search-form").css({'display':'none'});
    @endif
    @else
    $(".advanced-search-form").css({'display':'none'});
    @endisset
  });

  $("#reset-form").click(function(){
    $(".selectpicker").val('default');
    $(".selectpicker").selectpicker("refresh");
    $('.selectpicker option[value=All]').click(function(){
        $('.selectpicker option').each(function(){
            this.selected = $('.selectpicker option[value=All]').attr('selected');
        });
    });
  });
  
  $("#advanced-search").click(function(){   
    $(".advanced-search-form").slideToggle("slow");
    $(this).children(":last-child").toggleClass(['icon-chevron-down','icon-chevron-right']);    
  });
</script>