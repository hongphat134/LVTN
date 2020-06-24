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
            Bạn có chắc chắn muốn xoá mẫu hồ sơ không?
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
            <a href="{{url('/nguoitimviec/update-profile',$profile->id)}}" class="block__16443 text-center d-block">
              <span class="custom-icon mx-auto"><span class="icon-file-text d-block"></span></span>
              <h3>Mẫu hô sơ {{$key + 1}}</h3>
              <p>Ngành nghề: {{ $profile->nganh }}</p>              
              <p>Khu vực: {{ $profile->khuvuc }}</p>  
              <p>Ngày cập nhật: {{ date('d/m/Y',strtotime($profile->updated_at)) }}</p>            
            </a>

            <div class="row">
              <span class="col-6">
              <button class="btn btn-outline-success form-control" data-toggle="modal" data-target="#viewModal{{$key}}"><i class="icon-search"></i> XEM</button>
              </span>
              
              <span class="col-6">              
              <button id="{{$profile->id}}" class="btn btn-outline-danger form-control call-delete" data-toggle="modal" data-target="#deleteModal"><i class="icon-trash"></i> XOÁ</button>
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
                <li>Email: <a href="#">{{$profile->emaillienhe}}</a></li>
                <li>Khu vực: <a href="#">{{$profile->khuvuc}}</a></li>
                <li>Hôn nhân: <a href="#">{{$profile->honnhan}}</a></li>
                <li>Hình thức: <a href="#">{{$profile->trangthailv}}</a></li>
                <li>Bằng cấp: <a href="#">{{$profile->bangcap}}</a></li>
                <li>Cấp bậc: <a href="#">{{$profile->capbac}}</a></li>
                <li>Kinh Nghiệm: <a href="#">{{$profile->kinhnghiem}}</a></li>              
                <li>Trạng thái: <a href="#">{{$profile->trangthai == 1 ? 'Công khai': 'Chưa công khai'}}</a></li>              
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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Trình độ ngoại ngữ</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Trình độ tin học</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <h2 class="mb-4">Sở trường</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>           
            <p>
              <a href="#" class="btn btn-primary btn-md mt-4">{{$profile->created_at}}</a>
              <a href="#" class="btn btn-primary btn-md mt-4">{{$profile->updated_at}}</a>
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