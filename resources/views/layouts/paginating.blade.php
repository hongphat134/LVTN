@if ($job_listings->lastPage() != 1 && $job_listings->currentPage() <= $job_listings->lastPage())
<div class="col-md-6 text-center text-md-right">
	<div class="custom-pagination ml-auto">
		@if ($job_listings->currentPage() != 1)		
		<a href="{{$job_listings->url($job_listings->currentPage() - 1)}}" class="prev">Trước</a>
		@endif
		<div class="d-inline-block">
		@for ($i = 1; $i <=  $job_listings->lastPage(); $i++)
		
		@if ($job_listings->currentPage() == $i)
		<a class="active" href="javascript:void(0)">{!! $i !!}</a>

		@elseif (($i == $job_listings->currentPage() - 1 || $i == $job_listings->currentPage() - 2 || $i == $job_listings->currentPage() + 1 || $i == $job_listings->currentPage() + 2) || $i == $job_listings->lastPage() || $i == 1)
		<a href="{{ $job_listings->url($i) }}">{!! $i !!}</a>
		
		@elseif (($i == $job_listings->lastPage() - 1 || $i == 2) && $job_listings->lastPage() > 5)
            <sub><i class="icon-ellipsis-h"></i></sub>
				
		@endif
		@endfor
		</div>		
		@if ($job_listings->currentPage() != $job_listings->lastPage())        
        <a href="{{$job_listings->url($job_listings->currentPage() + 1)}}" class="next">Sau</a>                 
        @endif
	</div>
</div>
@endif

