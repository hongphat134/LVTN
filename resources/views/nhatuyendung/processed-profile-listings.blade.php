@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách hồ sơ ứng tuyển</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Hồ sơ xin việc</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
<section class="site-section services-section bg-light block__62849" id="next-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <h3 class="text-center"><span class="icon-done_all mr-2"></span>Danh sách hồ sơ đã xử lý <span class="icon-done_all"></span></h3>
      @if(session('success'))
       <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Hoàn tất!</strong> {{session('success')}}
      </div>
      @endif     
      <form action="#">
        Từ ngày: <input type="date" name="key" value="">
        - Đến ngày: <input type="date" name="key" value="">
        <button class="btn btn-info"><span class="icon-search"></span></button>
      </form>
      @if($profile_list->total() != 0)
      <form action="{{url('/nhatuyendung/xoa-ho-so')}}">
      <table class="table table-bordered table-hover">
        <thead style="font-weight: bold">
        <tr>
          <td>STT</td>
          <td>Nội dung đã gửi</td>
          <td>Giờ xử lý</td>
          <td>Thao tác</td>
          <td>
            <button id="checkAll" type="button" class="btn btn-primary">Chọn tất</button>
          </td>
        </tr>
        </thead>          
        <tbody>
        @foreach($profile_list as $key => $profile)
        <tr>
          <td>Hồ sơ {{$profile->id}}</td>
          <td>{{ limit_description($profile->noidung_ungtuyen) }}</td>
          <td>{{date('H \g\i\ờ d/m/Y',strtotime($profile->updated_at))}}</td>
          <td>
            <!-- Example split danger button -->
  <div class="btn-group">
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Profile{{$key}}Modal">Xem</button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
  <a class="dropdown-item" target="_blank" href="{{url('nhatuyendung/ung-tuyen/pdf',[$profile->idUser,$profile->idTTD])}}">Xuất PDF</a>
  <a class="dropdown-item" href="#">Another action</a>
  <a class="dropdown-item" href="#">Something else here</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">Separated link</a>
  </div>
  </div>             
          </td>
          <td>
            <input type="checkbox" name="recCheckbox[]" value="{{$profile->idUser}} {{$profile->idTTD}}">
          </td>
        </tr>          
        @endforeach
        </tbody>

        <tfoot style="font-weight: bold">
        <tr>
          <td>STT</td>
          <td>Nội dung đã gửi</td>
          <td>Giờ xử lý</td>
          <td>Thao tác</td>
          <td>
            <button id="uncheckAll" type="button" class="btn btn-danger">Xoá tất</button>
          </td>
        </tr>
        </tfoot>
      </table>
              
      @include('layouts.paginating',['job_listings' => $profile_list])
      <button type="submit" id="recBtn" class="btn btn-danger">Xoá những hồ sơ đã chọn</button>
      @else
      Hiện tại chưa có hồ sơ nào cả! Hãy kiên nhẫn chờ đợi bạn nhé!
      @endif 
      </div>  

      <div class="col-lg-4 border p-5">
        <h4>Thông tin tuyển dụng</h4>
        <p>Ngành cần tuyển: {{$job->nganh}}</p>
        <p>Số lượng: {{$job->soluong}}</p>
        <p>Mức lương: {{$job->mucluong}}</p>
        <p>Vị trí: {{$job->capbac}}</p>
        <p>Hình thức làm việc: {{$job->hinhthuc_lv}}</p>
        <p class="text-danger">Hạn tuyển dụng: {{date('d/m/Y',strtotime($job->hantuyendung))}}</p>
        <p>Khu vực: 
          @foreach(json_decode($job->tinhthanhpho) as $city)
          {{$city}} #
          @endforeach
        </p>

        <h4>Yêu cầu</h4>
        <p>Bằng cấp: {{$job->bangcap}}</p>
        <p>Giới tính: {{$job->gioitinh}}</p>
        <p>Kinh nghiệm: {{$job->kinhnghiem}}</p>
        <p>Kĩ năng: 
        @foreach(json_decode($job->kinang) as $skill)
          {{$skill}} #
        @endforeach</p>

        <h4>Yêu cầu khác</h4>
        @if($job->ngoaingu)
        <p>Ngoại ngữ: 
          @foreach(json_decode($job->ngoaingu) as $language)
          {{$language}} &
          @endforeach
        </p>
        @endif
        @if($job->tinhoc)
        <p>Tin học: 
          @foreach(json_decode($job->tinhoc) as $itech)
          {{$itech}} &
          @endforeach</p>        
        @endif

        @if($job->yeucau_cv)
        <h4>Yêu cầu thêm</h4>
        {!! nl2br($job->yeucau_cv) !!}
        @endif
      </div> 
    </div>
  </div>
</section>
</form>

<script>
  $("#checkAll").click(function(){
      const checkboxList = $("input[type='checkbox']");               
      checkboxList.prop('checked',true);            
  });
  $("#uncheckAll").click(function(){
      const checkboxList = $("input[type='checkbox']");               
      checkboxList.prop('checked',false);            
  });
  $("#recBtn").click(function(e){
    if($("input[type='checkbox']").is(":checked") == false){            
      $(this).attr('data-target','');
      alert("Bạn chưa chọn hồ sơ nào cả!");      
    }
    else  $(this).attr('data-target','#recModal');   
  });
</script>
@foreach($profile_list as $key => $profile)
<!-- Profile Modal -->
  <div class="modal fade" id="Profile{{$key}}Modal" style="z-index: 9999">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thông tin hồ sơ ứng tuyển</span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
<section class="site-section" style="padding-top: 0">
<div class="container">
<div class="row">
<div class="col-lg-8 blog-content">
<h3 class="mb-4">{{$profile->nganh}}</h3>
<p class="lead">Trình độ {{$profile->bangcap}}</p>        

<blockquote><p>Vị trí đã từng đảm nhiệm {{$profile->capbac}}</p></blockquote>
  
<p>Khu vực sinh sống {{$profile->khuvuc}}</p>

<p><span class="text-danger">Ngày sinh: {{date('d/y/Y',strtotime($profile->ngaysinh))}}</span> - <span class="text-primary">Giới tính: {{$profile->gioitinh}}</span></p>

<h4 class="mt-5 mb-4">Hình thức làm việc mong muốn: {{$profile->hinhthuc_lv}}</h4>

<p>Tình trạng hôn nhân: {{$profile->honnhan}}</p>
<p>Kinh nghiệm làm việc: {{$profile->kinhnghiem}}</p>
<p class="text-info">Mức lương mong muốn: {{$profile->mucluongmm}}</p>

<h4 class="mt-5 mb-4">Thông tin liên hệ:</h4>
<p>Email liên hệ: {{$profile->emaillienhe}}</p>
<p>SDT liên hệ: {{$profile->sdtlienhe}}</p>

<div class="pt-5">
<p><h4>Mục tiêu:</h4>
  {!! nl2br($profile->muctieu) !!}</p>
</div>

<div class="pt-5">
<p><h4>Thông tin thêm:</h4>
  {!! nl2br($profile->thongtinthem) !!}</p>
</div>

<div class="pt-5 text-danger">
  <p><h4>Nội dung đã gửi cho ứng viên:</h4>
  <strong>{!! nl2br($profile->noidung_ungtuyen) !!}</strong>
  </p>
</div>

</div>
<div class="col-lg-4 sidebar pl-lg-5">
<div class="sidebar-box">
@if($profile->hinh)
<img src="{{asset('hinhdaidien/'.$profile->hinh)}}" alt="{{$profile->hinh}}" class="img-fluid mb-4 w-50 rounded-circle">
@else
<img src="{{asset('hinhdaidien/default.png')}}" alt="Default" class="img-fluid mb-4 w-50 rounded-circle">
@endif
<h3>{{$profile->hoten}}</h3>
<p><strong>Sở trường:</strong></br> <i>{!! nl2br($profile->sotruong) !!}</i></p>
<p><a href="#" class="btn btn-primary btn-sm">Mô tả sơ lược</a></p>
</div>

<div class="sidebar-box">
  <div class="categories">
  <h3>Kỹ năng</h3>
    <div>
    @foreach(json_decode($profile->kinang) as $skill)
    <li><a href="#">{{$skill}} <span class="icon-star"></span></a></li>
    @endforeach
    </div>
  </div>
</div>

<div class="sidebar-box">
<div class="categories">
<h3>Trình độ ngoại ngữ</h3>
<div>
@if($profile->ngoaingu)
@foreach(json_decode($profile->ngoaingu) as $language)
<li><a href="#">{{$language}} <span class="icon-star"></span></a></li>
@endforeach
@endif
</div>
</div>
</div>

<div class="sidebar-box">
<div class="categories">
<h3>Trình độ tin học</h3>
<div>
@if($profile->tinhoc)
@foreach(json_decode($profile->tinhoc) as $itech)
<li><a href="#">{{$itech}} <span class="icon-star"></span></a></li>
@endforeach
@endif
</div>
</div>
</div>

</div>
</div>
</div>
</section>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
        
      </div>
    </div>
  </div>
@endforeach
@endsection