<div>
    <div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="{{$id}}Label" class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $content }}
                </div>
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</div>
