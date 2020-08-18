@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách kĩ năng</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>              
              <span class="text-white"><strong>Danh sách kĩ năng</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container"> 
        <div class="row">

       		<div class="border p-4 round">
       			<h3>Tìm kiếm theo kĩ năng chuyên môn</h3>
       			<hr>
       			@foreach($skill_list as $skill)
       			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-2 d-inline-flex"><a href="{{url('/tim-kiem-skill/'.$skill)}}">{{$skill}}</a></div>
       			@endforeach
       		</div>

        </div>
      </div>

    </section>
@endsection