<div class="d-flex justify-content-between">
    <span>{{ $label }}</span>

    @if($sort == $field)
        @if($direction == 'asc')
            <i class="fas fa-sort-up mt-1"></i>
        @else
            <i class="fas fa-sort-down mt-1"></i>
        @endif
    @else
        <i class="fas fa-sort mt-1"></i>
    @endif
</div>