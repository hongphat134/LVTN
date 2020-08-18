@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Danh sách tỉnh thành phố</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Home</a> <span class="mx-2 slash">/</span>              
              <span class="text-white"><strong>Danh sách tỉnh thành phố</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container"> 
   		<div class="border p-4 round">
   			<h3>Danh sách tỉnh thành phố</h3>
   			<hr>
        @foreach($region_list as $region => $city_list) 
        <h3>{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}
        </h3>
          @foreach($city_list as $city)
          <div class="col-2 d-inline-flex"><a href=""></a>{{$city->Ten}}</div>
          @endforeach
        </optgroup>
        @endforeach
   		</div>
      </div>

    </section>
@endsection