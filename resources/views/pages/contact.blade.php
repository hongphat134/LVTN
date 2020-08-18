@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Liên hệ với chúng tôi</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Liên hệ với chúng tôi</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <form action="{{url('contact')}}" method="post" class="">
              {{csrf_field()}}
              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Họ</label>
                  <input type="text" id="fname" class="form-control" name="fname" placeholder="Nhập họ..." required autofocus>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Tên</label>
                  <input type="text" id="lname" class="form-control" name="lname" placeholder="Nhập tên..." required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" name="email"
                   value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="Nhập Email liên hệ..." required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Tiêu đề</label>( tối thiểu 5 kí tự)
                  <input type="subject" id="subject" class="form-control" minlength="5" name="subject" placeholder="Nhập tiêu đề..." required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Lời nhắn</label>( tối thiểu 10 kí tự)
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Để lại lời nhắn hoặc câu hỏi của bạn..." minlength="10" maxlength="1000" name="message" required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Gửi lời nhắn" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-lg-5 ml-auto">
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Địa chỉ</p>
              <p class="mb-4">180 Cao Lỗ, Phường 14, Quận 8</p>

              <p class="mb-0 font-weight-bold">Số điện thoại</p>
              <p class="mb-4"><a href="#">+0938 229 513</a></p>

              <p class="mb-0 font-weight-bold">Email liên hệ</p>
              <p class="mb-0"><a href="#">hongphat701@gmail.com</a></p>

              <p class="mb-0 font-weight-bold">Họ tên</p>
              <p class="mb-0"><a href="#">Hồng Thuận Phát</a></p>

              <p class="mb-0 font-weight-bold">MSSV</p>
              <p class="mb-0"><a href="#">DH51603902</a></p>

              <p class="mb-0 font-weight-bold">Lớp</p>
              <p class="mb-0"><a href="#">D16-TH10</a></p>

              <p class="mb-0 font-weight-bold">Khoa</p>
              <p class="mb-0"><a href="#">Công nghệ thông tin</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3">Ứng viên vui vẻ nói</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
              <blockquote>
                <p>&ldquo;Website nhìn sơ thì cũng tạm mà nhìn thì thấy củ chuối vl&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3>HTP</h3>
                  <span class="position">Nhà sáng tạo</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
              <blockquote>
                <p>&ldquo;Template khó cắt với nghiệp vụ khó phân tích quá&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_2.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3>Lại là HTP</h3>
                  <span class="position">Nhà thiết kế</span>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
@endsection