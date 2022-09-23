<div>
    <div class="my-3">
        <div class="d-flex justify-content-between">
            <div class="col-md-2">
                <div class="d-flex align-items-center">
                    <span>Mostrar</span>
                    <select class="ml-2 form-control" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="col-md row justify-content-end">
                <div class="d-flex col-md-4 align-items-center">
                    <span>Buscar: </span>
                    <input type="text" placeholder="Buscar.." class="form-control ml-2" wire:model="search">
                </div>
            </div>  
        </div>
    </div>

    @if(count($items))

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    {{ $head }}
                </thead>
                <tbody>
                    {{ $body }}
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="d-flex  justify-content-between">
                <div>
                    <span>Mostrando {{ $items->count() }} de {{ $items->total() }}</span>
                </div>
                <div>
                    {{ $items->links() }}
                </div>
            </div>
        @endif
    @else
        <p class="my-3 text-center">No hay elementos</p>
    @endif
</div>