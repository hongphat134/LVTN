@extends('layouts.master')
@section('content')
    <!-- MODAL FORM DELETE -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Xoá mẫu hồ sơ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Bạn có chắc chắn muốn xoá mẫu hồ sơ này không?
          </div>
          <div class="modal-footer">
            <a id="delete" href="#"><button type="button" class="btn btn-primary">Đồng ý</button></a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Tủ hồ sơ</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Tủ hồ sơ</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section services-section bg-light block__62849">
      <div class="container">
        @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Hoàn tất!</strong> {{session('success')}}
        </div>
        @endif
        
        <div class="row">
          @foreach($profile_list as $key => $profile)
          <div class="col-6 col-md-6 col-lg-4 mb-4 mb-lg-5">           
            <a class="block__16443 text-center d-block" data-toggle="modal" data-target="#viewModal{{$key}}" href="javascript:void(0)">
            @if($profile->congkhai == 1)
            <div class="ribbon-right-wrapper">
              <div class="ribbon-right blue">Public</div>  
            </div>
            @endif
            @if($profile->trangthai == 1)
            <div class="ribbon-wrapper">
              <div class="ribbon red">Duyệt</div>  
            </div>
            @endif
              <span class="custom-icon mx-auto"><span class="icon-file-text d-block"></span></span>
              <h3>{{$profile->nganh}} </h3>
              <p>Họ & tên: {{ $profile->hoten }}</p>
              @if($profile->trangthai == 1)              
              <p>Lượt xem: {{ $profile->luotxem }}</p>  
              @else
              <p><span class="badge badge-pill badge-danger">Đang chờ duyệt</span></p>
              @endif
              <p>Ngày cập nhật: {{ date('d/m/Y',strtotime($profile->updated_at)) }}</p>            
            </a>
            
            <div class="row">
              <span class="col-7">
                <div class="dropdown">
  <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="icon-th-large"></i> Quản lý mẫu hồ sơ
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    @if($profile->trangthai == 0)
    <a class="dropdown-item" href="{{url('nguoitimviec/update-profile',$profile->id)}}" target="_blank">Cập nhật mẫu</a>
    @endif
    <a class="dropdown-item" href="{{route('pdf-profile',$profile->id)}}" target="_blank">Xuất PDF</a>
    <a class="dropdown-item call-delete" id="{{$profile->id}}" data-toggle="modal" data-target="#deleteModal" href="javascript:void(0)">Xoá</a>
  </div>
</div>             
              </span>
              <span class="col-5">                
              <a href="{{url('/nguoitimviec/set-status',$profile->id)}}"><button class="btn btn-outline-info"><i class="icon-public"></i> {{$profile->congkhai == 0 ? 'Bật':'Tắt'}} Public</button></a>
              </span> 
            </div>
          </div>
          @endforeach
          <script>
            $(".call-delete").click(function(){
                // console.log($(this).attr('id'));
                var id = $(this).attr('id');
                          
                $("#delete").attr('href', '/nguoitimviec/delete-profile/' + id);
            });
          </script>    
        </div>
        <!-- ROW -->
         @include('layouts.paginating',['job_listings' => $profile_list])
      </div>
      <!-- CONTAINER -->

    </section>
  
  <!-- VIEW PROFILE -->
  @foreach($profile_list as $key => $profile)
   <!-- MODAL FORM VIEW -->
    <div class="modal fade" id="viewModal{{$key}}" tabindex="-1">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">          
          <div class="row">
          <div class="col-lg-4 mr-auto">
            <div class="border p-3 rounded">
              <ul class="list-unstyled block__47528 mb-0">
                <li><span class="active"><h3>{{$profile->nganh}}</h3></span></li>
                <li>Họ & tên: <a href="#">{{$profile->hoten}}</a></li>
                <li>Email: <a href="#">{{$profile->emaillienhe}}</a></li>
                <li>Nơi sinh sống: <a href="#">{{$profile->khuvuc}}</a></li>
                <li>Hôn nhân: <a href="#">{{$profile->honnhan}}</a></li>
                <li>Thời gian làm việc: <a href="#">{{$profile->trangthailv}}</a></li>
                <li>Bằng cấp cao nhất: <a href="#">{{$profile->bangcap}}</a></li>
                <li>Cấp bậc cao nhất: <a href="#">{{$profile->capbac}}</a></li>
                <li>Kinh Nghiệm: <a href="#">{{$profile->kinhnghiem}}</a></li>              
                <li>Trạng thái: <a href="#">{{$profile->trangthai == 1 ? 'Công khai': 'Chưa công khai'}} mẫu hồ sơ</a></li>              
              </ul>
            </div>
          </div>
          <div class="col-lg-8">
            <span class="text-primary d-block mb-5">
              <span class="icon-search display-1"></span>
              <span class="icon-star display-1"></span>
              <span class="icon-files-o display-1"></span>
              <span class="icon-file-text-o display-1"></span>
              <span class="icon-file-text display-1"></span>
              <span class="icon-file display-1"></span>
              <span class="icon-file-word-o display-1"></span>
              <span class="icon-insert_drive_file display-1"></span>
            </span>
            <h2 class="mb-4">Mục tiêu</h2>
            <p>
              {!! $profile->muctieu ? nl2br($profile->muctieu) : 'Bạn để trống mục này!' !!}
            </p>
            <h2 class="mb-4">Kỹ năng</h2>
            <p>              
              @foreach(json_decode($profile->kinang) as $skill)
              {{$skill}} &
              @endforeach
            </p>           
            <h2 class="mb-4">Trình độ ngoại ngữ</h2>
            <p>
              @if($profile->ngoaingu)              
              @foreach(json_decode($profile->ngoaingu) as $language)
              {{$language}} <strong>&</strong>
              @endforeach
              @else
                Bạn để trống mục này!
              @endif
            </p>           
            <h2 class="mb-4">Trình độ tin học</h2>
            <p>
              @if($profile->tinhoc)
              @foreach(json_decode($profile->tinhoc) as $itech)
              {{$itech}} <strong>&</strong>
              @endforeach
              @else
                Bạn để trống mục này!
              @endif
            </p>     
            <h2 class="mb-4">Sở trường</h2>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p> <-->
            <p>
              {!! $profile->sotruong ? nl2br($profile->sotruong) : 'Bạn để trống mục này!' !!}
            </p>            
            <p>
              <a href="#" class="btn btn-primary btn-md mt-4">Ngày đăng: {{time_elapsed_string($profile->created_at)}}</a>
              <a href="#" class="btn btn-primary btn-md mt-4">Ngày cập nhật: {{time_elapsed_string($profile->updated_at)}}</a>
            </p>

          </div>
        </div>
          <div class="modal-footer">           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
@endsection