@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}}" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Thông báo việc làm</h1>
            <div class="custom-breadcrumbs">
              <a href="index.html">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Thông báo việc làm</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">  
        <div class="row">
          <div class="col-lg-8">
            <h2>Thiết lập thông báo việc làm</h2>
            <form action="" class="border p-4 mx-auto">
              Tần suất (ngày/tuần)
              <hr>
              Ngành nghề
              <hr>
              Địa điểm
              <hr>
              Trình độ học vấn
              <hr>
              Kinh nghiệm
              <hr>
              Mức lương
              <hr>
            </form>
          </div>  

          <div class="col-lg-4">
            
          </div>
        </div>
        
      </div>      
    </section>
@endsection