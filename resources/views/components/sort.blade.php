<div>
    @if($sort == $field)
        @if($direction == 'asc')
            <i class="fas fa-sort-up mt-1" style="float: right"></i>
        @else
            <i class="fas fa-sort-down mt-1" style="float: right"></i>
        @endif
    @else
        <i class="fas fa-sort mt-1" style="float: right"></i>
    @endif
</div>