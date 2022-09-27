<div>
    <x-modal id="editModal">
        <x-slot name="title">
            Editar perfil
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <div class="mb-3">
                    <label for="Nombre"></label>
                    <input type="text" class="form-control" wire:model.defer="name">
                
                    @error('name')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Correo"></label>
                    <input type="email" class="form-control" wire:model.defer="email">
                
                    @error('email')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" wire:click="update" wire:loading.attr="disabled">Actualizar perfil</button>
        </x-slot>
    </x-modal>

    <x-modal id="editPasswordModal">
        <x-slot name="title">
            Editar contraseña
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <div class="mb-3">
                    <label for="">Contraseña antigua</label>
                    <input type="password" class="form-control" wire:model.defer="old_password">
                
                    @error('old_password')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Nueva contraseña</label>
                    <input type="password" class="form-control" wire:model.defer="new_password">
                
                    @error('new_password')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Confirmar nueva contraseña</label>
                    <input type="password" class="form-control" wire:model.defer="confirm_new_password">
                
                    @error('confirm_new_password')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" wire:click="updatePassword" wire:loading.attr="disabled">Actualizar contraseña</button>
        </x-slot>
    </x-modal>

    <x-card>
        <x-slot name="card_content">
            <div class="card">
                <div class="card-header bg-info">
                  Nombre
                </div>
                <div class="card-body">
                  <p class="card-text">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                  Correo
                </div>
                <div class="card-body">
                  <p class="card-text">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="my-3">
                <div class="d-flex">
                    <button class="btn btn-primary" wire:click="edit"><i class="fas fa-edit"></i> Editar perfil</button>
                    <button class="btn btn-warning ml-3" wire:click="editPassword"><i class="fas fa-edit"></i> Editar contraseña</button>
                </div>
            </div>
        </x-slot>
    </x-card>
</div>
