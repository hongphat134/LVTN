@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Chọn hình thức ứng tuyển</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Chọn hình thức ứng tuyển</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-5">
            <h2 class="mb-4 text-center">Tủ hồ sơ</h2>
            @if(!empty($profiles->toArray()))
            <form class="p-4 border rounded" method="get" 
            action="{{ url('/nguoitimviec/nop-ho-so') }}">
            	@if(session('error'))
    					<div class="alert alert-danger alert-dismissible fade show">
    					  <button type="button" class="close" data-dismiss="alert">&times;</button>
    					  {{session('error')}}
    					</div>            		
            	@endif
				
            	@foreach($profiles as $profile)
            	<div class="p-4 border rounded">
            		<h4><input type="radio" name="profile" value="{{$profile->id}}"> {{$profile->nganh}}</h4>
					
    					<span class="col-3">
    						<label for="lname">Trình độ: {{$profile->bangcap}}</label>
    					</span> 
    					<span class="col-3">
    						<label for="lname">Kinh nghiệm: {{$profile->kinhnghiem}}</label>
    					</span>            		
    					<span class="col-3">
    						<label for="lname">Tỉnh thành phố: {{$profile->khuvuc}}</label>
    					</span> 
    					<span class="col-3">
    						<label for="lname">Cập nhật: {{date('d/m/Y',strtotime($profile->updated_at))}}</label>
              </span> 
            	</div> 
            	@endforeach
				<input type="hidden" value="{{$news_id}}" name="ttd_id">
            	<button class="btn btn-primary float-right">Nộp hồ sơ</button>
            </form>
            @endif 
            <a href="{{ route('apply',$news_id) }}"><button class="btn btn-danger">Tạo hồ sơ mới</button></a>
            	<a href="#"><button class="btn btn-danger">Copy hồ sơ</button></a>
             

          </div>                                        
        </div>
      </div>
    </section>
@endsection