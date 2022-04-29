@for ($i = 1; $i <= 5; $i++)
    @if($i <= $rate)
        <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star active-star"></i></a>
    @else
        <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star"></i></a>
    @endif
@endfor