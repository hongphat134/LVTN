@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Tìm kiếm nâng cao</h1>
            <div class="custom-breadcrumbs">
              <a href="{{url('/')}}">Trang chủ</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Tìm kiếm nâng cao</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

   	<section class="site-section">
    <div class="container">

        <div class="row">
          <div class="col-lg-12 mb-5">            
            <form method="POST" action="{{ route('advancedSearch',['#content']) }}" class="p-5 border rounded form-group" style="background-color: lavender">
            {{ csrf_field() }}
            <fieldset class="form-group">
             	<!-- <legend>Tìm kiếm nâng cao</legend> -->
             	<legend class="col-form-label"><h3>Tìm kiếm nâng cao</h3></legend>
             	<div class="row form-group">
	             	<label for="job" class="col-lg-2 col-form-label">Ngành nghề</label>
	             	<div class="col-lg-4">
	             		<select name="job[]" data-style="btn-warning" data-width="100%" data-live-search="true" title="Chọn ngành nghề...(tối đa 3 ngành nghề)" class="selectpicker form-control" data-max-options="3" multiple>
	             		@foreach($job_list as $job)	
						<option
							@isset($search_info['job'])
							{{in_array($job,$search_info['job']) ? 'selected' : ''}}
							@endisset
						>{{$job}}</option>
					    @endforeach
					    <!-- <option selected>Other</option> -->
	             		</select>
	             	</div>
	             	<label for="job" class="col-lg-2 col-form-label">Kĩ năng</label>
	             	<div class="col-lg-4">
	             		<select name="skill[]" data-style="btn-danger" data-width="100%" data-live-search="true" title="Chọn kĩ năng...(tối đa 5 kĩ năng)" class="selectpicker form-control" data-max-options="5" multiple>
	             		@foreach($skill_list as $skill)	
						<option
							@isset($search_info['skill'])
							{{in_array($skill,$search_info['skill']) ? 'selected' : ''}}
							@endisset
						>{{$skill}}</option>
					    @endforeach
	             		</select>
	             	</div>
	            </div>

	            <div class="row form-group">
	            	<label for="job" class="col-lg-2 col-form-label">Khu vực</label>
	             	<div class="col-lg-4">
	             		<select name="region[]" data-style="btn-info" data-width="100%" data-live-search="true" class="selectpicker form-control" title="Chọn khu vực...(tối đa 3 khu vực)" data-size="8" data-max-options="3" multiple>
	             		@foreach($region_list as $region => $city_list)	
						<optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
							@foreach($city_list as $city)
							<option
							@isset($search_info['region'])
							{{in_array($city->Ten,$search_info['region']) ? 'selected' : ''}}
							@endisset
							>					    
					    	{{$city->Ten}}
					    	</option>
							@endforeach
						</optgroup>
					    @endforeach
	             		</select>
	             	</div>
	             	<label for="job" class="col-lg-2 col-form-label">Bằng cấp</label>
	             	<div class="col-lg-4">
	             		<select name="degree[]" data-style="btn-primary" data-width="100%" data-live-search="true" title="Chọn bằng cấp...(tối đa 3 bằng cấp)" class="selectpicker form-control" data-max-options="3" multiple>
	             		@foreach($degree_list as $degree)	
						<option
						@isset($search_info['degree'])
						{{in_array($degree,$search_info['degree']) ? 'selected' : ''}}
						@endisset
						>{{$degree}}</option>
					    @endforeach
	             		</select>
	             	</div>
	            </div>

	            <div class="row form-group">
	            	<label for="job" class="col-lg-2 col-form-label">Mức lương</label>
	             	<div class="col-lg-4">
	             		<select name="salary[]" data-style="btn-secondary" data-width="100%" data-live-search="true" class="selectpicker form-control" title="Chọn mức lương...(tối đa 3 mức lương)" data-max-options="3" multiple>	             		
	             		@foreach($salary_list as $salary)	
						<option
						@isset($search_info['salary'])
						{{in_array($salary,$search_info['salary']) ? 'selected' : ''}}
						@endisset
						>
							{{$salary}}
						</option>
					    @endforeach
	             		</select>
	             	</div>
	             	<label for="job" class="col-lg-2 col-form-label">Số lượng</label>
	             	<div class="col-lg-2">
	             		<input name="number" type="number" min='1' max='99' class="form-control" placeholder="Số lớn nhất..." 
	            value=@if(!empty($search_info['number'])) 
	           			 {{(int)$search_info['number']}}
	            		@endif>
	             	</div>
	             	<div class="col-lg-2">
				      <button type="submit" class="btn btn-dark float-right"><span class="icon-search mr-2"></span>Tìm kiếm</button>
				    </div>
	            </div>

	            <div class="row form-group">
	            	<legend class="col-form-label col-lg-2 pt-0">Điều kiện</legend>
	            	<div class="col-lg-4">
				        <div class="form-check">
				          <input class="form-check-input" type="radio" name="condition" id="gridRadios1" value="and" checked>
				          <label class="form-check-label" for="And">
				            Thoả tất cả điều kiện trên
				          </label>
				        </div>
				        <div class="form-check">
				          <input class="form-check-input" type="radio" name="condition" id="gridRadios2" value="or" 
				          @isset($search_info['condition']) 
				          {{$search_info['condition'] == 'or' ? 'checked' : '' }}
				          @endisset>
				          <label class="form-check-label" for="Or">
				            Thoả 1 trong số điều kiện trên
				          </label>
				        </div>				       
				    </div>
				    <label for="job" class="col-lg-2 col-form-label">Reset Form</label>
	             	<div class="col-lg-2">
	             		<input id="reset-form" type="reset" value="Nhập lại">
	             	</div>	      
	             	<script>
	             		$("#reset-form").click(function(){
	             			$(".selectpicker").val('default');
							$(".selectpicker").selectpicker("refresh");
	             		});
	             	</script>       
	           	</div>

	           	<div class="form-group row">
				    <div class="col-sm-2">
				    	Checkbox				    	
					</div>
				    <div class="col-sm-10">
				      <div class="form-check">
				        <input class="form-check-input" type="checkbox" id="gridCheck1">
				        <label class="form-check-label" for="gridCheck1">
				          Example checkbox

				        </label>
				      </div>
				    </div>
				 </div>								
            </fieldset>         

            </form> 

          </div>                             
        </div>
    </div>
    </section>

	@if(isset($job_listings))
    <section class="site-section" id="content" style="margin-top: -220px; z-index: 0;">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">
              @if($job_listings->total() == 0) Rất tiếc! Không có tin tuyển dụng nào như bạn tìm kiếm cả!
              @else Có {{$job_listings->total()}} tin tuyển dụng
              @endif
            </h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          @foreach($job_listings as $news)
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{route('news',$news->id)}}"></a>
            <div class="job-listing-logo">
              <img src="{{asset('logo/'.$news->hinh)}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{$news->nganh}}</h2>
                <strong>Nhà tuyển dụng {{$news->ten}}</strong>              
                <div class="keywords">
                  @foreach(json_decode($news->kinang) as $skill)
                  <button class="btn btn-outline-info skill">{{$skill}}</button>
                  @endforeach                 
                </div>      
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">  
                @foreach(json_decode($news->tinhthanhpho) as $city)
                <span class="icon-room"></span>{{$city}}</br>
                @endforeach
              </div>
              <div class="job-listing-meta">
                @if($news->trangthailv == 'Part Time')
                <span class="badge badge-danger">{{$news->trangthailv}}</span>
                @else
                <span class="badge badge-success">{{$news->trangthailv}}</span>
                @endif
                </br>
                <span class="badge badge-dark">
                Giờ đăng: {{ time_elapsed_string($news->updated_at) }}
                </span>         
                </br>
                <span class="badge badge-info">
                Hạn tuyển dụng: {{date('d/m/Y',strtotime($news->hantuyendung))}}
                </span>
              </div>
            </div>            
          </li>
          @endforeach       
        </ul>       
        @include('layouts.paginating')
       

      </div>
    </section>
    @endif
@endsection