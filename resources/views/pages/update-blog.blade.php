@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Cập nhật Blog</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Cập nhật Blog</strong></span>            
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Thông tin chính</h2>
            <form method="POST" action="{{ url('/update-blog',$blog->id) }}" enctype="multipart/form-data" class="p-4 border rounded">
            {{ csrf_field() }}
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Hoàn tất!</strong> {{session('success')}}
              </div>
              @endif
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('title') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Tiêu đề</label>
                  <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề...." value="{{ $blog->tieude }}" tabindex="1">
                  @if ($errors->has('title'))
                      <span class="help-block">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Phụ đề</label>
                  <input type="text" name="sub_title"  class="form-control" placeholder="Nhập phụ đề..." value="{{$blog->phude }}" tabindex="2">                 
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Hình ảnh hiện tại</label>
                  
                  <img src="{{asset('/blog_images/'.$blog->hinh)}}" alt="" style="width: 100%; height: 100%;">               
                </div>
              </div>  

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Hình ảnh</label>
                  <input type="file" name="picture" class="form-control" tabindex="3">               
                </div>
              </div>                  

              <button class="btn btn-primary" type="submit" tabindex="5"><span class="icon-edit mr-2"></span>Cập nhật bài viết</button>
              <hr>
              <span class="icon-asterisk mr-2"></span>Lưu ý: Bài đăng phải <span class="text-danger">chờ duyệt</span> mới có thể công khai
          </div>
          <div class="col-lg-6">

            <h2 class="mb-4">Nội dung</h2>          
            <div class="col-md-12 mb-3 mb-md-0{{ $errors->has('content') ? ' has-error' : '' }}">
            <textarea name="content" class="form-control" id="" cols="30" rows="10" tabindex="4">{{$blog->noidung}}</textarea> 
            @if ($errors->has('content'))
              <span class="help-block">
                  <strong>{{ $errors->first('content') }}</strong>
              </span>
            @endif                 
            </div>
          </div>
          
        </form>       
        </div>
      </div>
    </section>
@endsection