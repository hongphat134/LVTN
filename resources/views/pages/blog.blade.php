@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Diễn đàn</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Diễn đàn</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="content">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h1 class="section-title mb-2">
              <span class="icon-forumbee mr-2"></span>Diễn đàn <span class="icon-forumbee"></span>
            </h1>
          </div>
        </div>  
        

        <div class="row mb-5">
          @foreach($blog_list as $blog)
          <div class="col-md-6 col-lg-4 mb-5">
            <a href="{{url('blog-single',$blog->id)}}"><img src="{{asset('blog_images/'.$blog->hinh)}}" alt="Image" class="img-fluid rounded mb-4"></a>
            <h3><a href="{{url('blog-single',$blog->id)}}" class="text-black">{{$blog->tieude}}</a></h3>
            <div>Ngày đăng: {{date('d/m/Y',strtotime($blog->updated_at))}} <span class="mx-2">|</span> <a href="#">{{$blog->count}} bình luận</a></div>
          </div>
          @endforeach
        

      </div>
      @include('layouts.paginating',['job_listings' => $blog_list])
    </section>
@endsection