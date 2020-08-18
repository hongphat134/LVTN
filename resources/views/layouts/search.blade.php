<section class="section-hero home-section overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">

	<div class="container">
	<div class="row align-items-center justify-content-center">
	<div class="col-md-12">
	<div class="mb-5 text-center">
	<h1 class="text-white font-weight-bold">Cách nhanh nhất để tìm được việc mong muốn</h1>
	<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quas fugit ex!</p>	 -->
	</div>
	<form action="{{route('search')}}" class="search-jobs-form">				
		<div class="row mb-5">
		<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
			<input id="search" name="key" type="text" class="form-control form-control-lg" placeholder="ngành, kỹ năng..." value="{{ empty($key)?'':$key }}">
			
			<ul class="list-group" id="job-skill-autocomplete">				
			</ul>			
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
		<select name="region[]" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Chọn khu vực..." data-size="10" data-max-options="3" multiple>		
		@foreach($region_list as $region => $city_list)	
		<optgroup label="{{$region == 'MienNam' ? 'Miền Nam' : ($region == 'MienBac' ? 'Miền Bắc' : 'Miền Trung')}}">
			@foreach($city_list as $city)
			<option
	    	@if(!empty($regions))
	    		{{ in_array($city->Ten,$regions) ? 'selected' : '' }}
	    	@endif
	    	>
	    	{{$city->Ten}}
	    </option>
			@endforeach
		</optgroup>
	    @endforeach
		</select>
		</div>
		
		<div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
		<select name="status" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" data-size="3" title="Chọn thời gian...">		
			<option value=''>Tất cả</option>
			<option 
			@if(!empty($status))
			{{ ($status=='Part Time')?'selected':'' }}
			@endif
			>
				Part Time
			</option>
			<option 
			@if(!empty($status))
			{{ ($status=='Full Time')?'selected':'' }}
			@endif
			>
				Full Time
			</option>
		</select>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
		<select name="sort" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" data-size="5" title="Chọn tiêu chí...">		
		<option value="1" {{ !empty($sort) ? ($sort == 1 ? 'selected' : '' ): ''}}>Mới nhất</option>
		<option value="2" {{ !empty($sort) ? ($sort == 2 ? 'selected' : '' ): ''}}>Dài hạn nhất</option>
		</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
		<button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Tìm kiếm</button>
		</div>
		</div>
		<div class="row">
		<div class="col-md-10 popular-keywords">
		<h3>Từ khoá phổ biến:</h3>
		<ul class="keywords list-unstyled m-0 p-0">
		<li><a href="javascript:void(0)" class="skill">Database</a></li>
		<li><a href="javascript:void(0)" class="skill">Python</a></li>
		<li><a href="javascript:void(0)" class="skill">PHP</a></li>
		</ul>
		</div>
		<div class="col-md-2">
			<a href="{{url('/tim-kiem-nang-cao')}}"><button type="button" class="btn btn-dark btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Nâng cao</button></a>
		</div>
		</div>
	</form>
	</div>
	</div>
	</div>

	<a href="#next" class="scroll-button smoothscroll">
	<span class=" icon-keyboard_arrow_down"></span>
	</a>
</section>
<script src="{{url('ajax/autocomplete.js')}}"></script>