@if ($job_listings->lastPage() != 1 && $job_listings->currentPage() <= $job_listings->lastPage())
<ul class="pagination m-b-5">
        @if ($job_listings->currentPage() != 1)            
        <li class="page-item">
            <a class="page-link" href="{{$job_listings->url($job_listings->currentPage() - 1)}}" aria-label="Previous">
                <i class="fa fa-angle-left"></i>&nbsp;
            </a>
        </li>
        @endif        
        @for ($i = 1; $i <=  $job_listings->lastPage(); $i++)
        
        @if ($job_listings->currentPage() == $i)
        <li class="page-item active">
            <a href="javascript:void(0)" class="page-link">{!! $i !!}</a>
        </li>
        @elseif (($i == $job_listings->currentPage() - 1 || $i == $job_listings->currentPage() - 2 || $i == $job_listings->currentPage() + 1 || $i == $job_listings->currentPage() + 2) || $i == $job_listings->lastPage() || $i == 1)
        <li class="page-item">
            <a href="{{ $job_listings->url($i) }}" class="page-link">{!! $i !!}</a>
        </li>
        @elseif (($i == $job_listings->lastPage() - 1 || $i == 2) && $job_listings->lastPage() > 5)
        <li class="page-item disabled">
            <a href="#" class="page-link">
                <span class="mdi mdi-dots-horizontal"></span>
            </a>            
        </li>
        <!-- <li class="page-item disabled"><a href="#" class="page-link">4</a></li> -->
                
        @endif
        @endfor
        @if ($job_listings->currentPage() != $job_listings->lastPage())        
        <li class="page-item">
            <a class="page-link" href="{{$job_listings->url($job_listings->currentPage() + 1)}}" aria-label="Next">
                <i class="fa fa-angle-right"></i>&nbsp;
            </a>
        </li>                
        @endif
</ul>
@endif