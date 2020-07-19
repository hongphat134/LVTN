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
                  <input id="search" name="key" type="text" class="form-control form-control-lg" placeholder="ngành, kĩ năng..." 
                  value="@isset($_GET['key']){{$_GET['key']}}@endisset">                                
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <!-- Multi -->
                  <select name="region" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn khu vực..." data-size="10">
                  <option value=''>Tất cả</option>
                  @foreach($city_list as $city)   
                    <option @isset($_GET['region']) {{$_GET['region'] == $city->Title ? 'selected' : ''}} @endisset>
                      {{$city->Title}}
                    </option>
                  @endforeach
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" name="status" title="Chọn hình thức...">
                    <option value="">Tất cả</option>
                    <option @isset($_GET['status']){{$_GET['status'] == 'Part Time' ? 'selected' : ''}}@endisset>Part Time</option>
                    <option @isset($_GET['status']){{$_GET['status'] == 'Full Time' ? 'selected' : ''}}@endisset>Full Time</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search mr-2"></span>Tìm kiếm hồ sơ</button>
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