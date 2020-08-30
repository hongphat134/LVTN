@include('layouts.header')
    <!-- MENU -->
    @include('ntv_layouts.menu')
    <!-- HOME -->
    @include('layouts.search')
	
<section class="site-section" id="next">
<div class="container">
	<div class="row mb-5">
		<div class="col-12 col-md-8 col-sm-12 col-lg-7">
			<form action="{{url('nguoitimviec/tim-kiem-ntd')}}" method="post">
			{{csrf_field()}}
			<div style="margin-left: -14px">
			<div class="col-10 col-xs-9 col-sm-9 col-md-10 col-lg-10 d-inline-flex">
				<input type="text" name="key" class="form-control" placeholder="Tên nhà tuyển dụng...." value="{{isset($key)?$key:''}}" autofocus>	
			</div>
			
			<button type="submit" class="btn btn-info" style="margin-left: -14px"><span class="icon-search"></span></button>
			</form>
			
			</div>
		<div class="clear-fix" style="margin-bottom: 10px"></div>
		@if(count($ntd_list) > 0)
		@foreach($ntd_list as $ntd)		
			<div class="card d-inline-flex" style="width:200px">
		    <a href="{{url('/thong-tin-ntd',$ntd->idUser)}}"><img class="card-img-top" src="{{asset('/logo/'.$ntd->hinh)}}" alt="Card image" style="width:100%; height: 150px"></a>
		    <div class="card-body">
		      <h4 class="card-title"><a href="{{url('/thong-tin-ntd',$ntd->idUser)}}">{{$ntd->ten}}</a></h4>
		      <p class="card-text">{{$ntd->tinhthanhpho}}</p>
		      @if(Auth::user()->theodoi_ntd)
		      	@if(in_array($ntd->idUser,json_decode(Auth::user()->theodoi_ntd)))
		      	<a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-danger theo-doi">ĐANG THEO DÕI</a>	
		      	@else
		      	<a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
		      	@endif
		      @else
		      <a href="javascript:void(0)" id="{{$ntd->idUser}}" class="btn btn-outline-danger theo-doi follow-rec">THEO DÕI</a>
		      @endif
		    </div>
		  </div>
		@endforeach
		@include('layouts.paginating',['job_listings' => $ntd_list])
		@else
		Không tìm thấy nhà tuyển dụng nào cả!
		@endif
		</div>
		<div class="col-12 col-md-4 col-sm-12 col-lg-5">
			@if(Auth::user()->theodoi_ntd)
			<h4>Đang theo dõi <count>{{count(json_decode(Auth::user()->theodoi_ntd))}}</count> nhà tuyển dụng</h4>
			<table class="table table-bordered">
				<thead style="font-weight: bold">
				<tr>
					<td>Tên nhà tuyển dụng</td>
					<td>Số lượng tin mới</td>
				</tr>
				</thead>
				<tbody>
				@foreach($f_ntd_list as $ntd)
				<tr>
					<td>
						<a href="{{url('/thong-tin-ntd',$ntd->idUser)}}">{{$ntd->ten}}</a> 
						<a id="{{$ntd->idUser}}" class="unfollow-ntd theo-doi" href="javascript:void(0)"><span class="badge badge-secondary"><span class="icon-close mr-1"></span>Huỷ theo dõi</span></a>
					</td>
					<td>Có {{$ntd->count}} tin mới</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			@else
			<h5>Bạn chưa theo dõi nhà tuyển dụng nào cả! Hãy theo dõi để nhận được thông báo từ nhà tuyển dụng đấy nhé!</h5>
			@endif
		</div>
	</div>
</div>
</section>
<script>
	$(".unfollow-ntd").click(function(){
		$(this).parent().parent().remove();
		$('count').text($('count').text() - 1);
	});
</script>
<script src="{{url('ajax/follow-recruiters.js')}}"></script>
@include('layouts.footer')    