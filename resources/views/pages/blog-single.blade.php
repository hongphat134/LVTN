@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="custom-breadcrumbs mb-0">
              <span class="slash">Đăng bởi</span> {{$author->ten}}</a> 
              <span class="mx-2 slash">&bullet;</span>
              <span class="text-white"><strong>{{date('d/m/Y',strtotime($blog->updated_at))}}</strong></span>
            </div>
            <h1 class="text-white">Thông tin bài viết</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 blog-content">
            <h3 class="mb-4">{{$blog->tieude}}</h3>
            <p class="lead">{{$blog->phude}}</p>
            <p><img src="{{asset('blog_images/'.$blog->hinh)}}" alt="Image" class="img-fluid rounded"></p>
            <p>{{$blog->noidung}}</p>

            
           <!--  <div class="pt-5">
              <p>Categories:  <a href="#">Design</a>, <a href="#">Events</a>  Tags: <a href="#">#html</a>, <a href="#">#trends</a></p>
            </div> -->


            <div class="pt-5">
              <h3 class="mb-5">{{$cmt_list->count()}} Comments</h3>
              <ul class="comment-list">
                @foreach($cmt_list as $cmt)
                <li class="comment">
                  <div class="vcard bio">
                    <img src="{{asset('hinhdaidien/person_2.jpg')}}" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>{{$cmt->ten}}</h3>
                    <div class="meta">{{date('d/m/Y \v\à\o \l\ú\c H:i',strtotime($cmt->created_at))}}</div>
                    <p>{{$cmt->noidung}}</p>
                   <!--  <p><a href="#" class="reply">Reply</a></p> -->
                  </div>
                </li>
                @endforeach                
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                @if(Auth::check())
                <h3 class="mb-5">Để lại bình luận</h3>
                <form id="cmt-form" action="#" method="post">
                {{csrf_field()}}                   
                  <input type="hidden" name="idBlog" value="{{$blog->id}}">
                  <div class="form-group">
                    <label for="message">Lời nhắn</label>
                    <textarea name="content" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input id="cmt-btn" value="Bình luận" class="btn btn-primary btn-md">
                  </div>
                </form>
                @else
                <h3 class="mb-5"><a href="{{url('/login')}}">Đăng ký</a> trở thành hội viên của website để bình luận bạn nhé!</h3>
                @endif
              </div>
            </div>

          </div>
          <div class="col-lg-4 sidebar pl-lg-5">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control form-control-lg" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <div class="sidebar-box">
              <img src="{{asset('hinhdaidien/person_2.jpg')}}" alt="Image placeholder" class="img-fluid mb-4 w-50 rounded-circle">
              <h3>{{$author->ten}}</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
              <p><a href="#" class="btn btn-primary btn-sm">Read More</a></p>
            </div>

            <div class="sidebar-box">
              <div class="categories">
                <h3>Các bài viết khác</h3>
                @foreach($blog_list as $blog)
                <li><a href="#">{{$blog->tieude}}</a><span>{{$blog->count}} bình luận</span> - {{date('d/m/Y',strtotime($blog->updated_at))}}</li>
                @endforeach
              </div>
            </div>
                       
          </div>
        </div>
      </div>
    </section>
    <script src="{{asset('ajax/comment.js')}}"></script>
@endsection