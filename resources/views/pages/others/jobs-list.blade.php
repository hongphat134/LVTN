@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách ngành nghề</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>              
              <span class="text-white"><strong>Danh sách ngành nghề</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">
        <div class="row"> 
       		<div class="border p-4 round">
       			<h3>Danh sách ngành nghề</h3>
       			<hr>
       			@foreach($job_list as $job)
       			<div class="col-12 col-lg-3 col-xs-5 col-md-5 col-sm-12 d-inline-flex"><a href=""></a>{{$job}}</div>
       			@endforeach
       		</div>
        </div>
      </div>

    </section>
@endsection