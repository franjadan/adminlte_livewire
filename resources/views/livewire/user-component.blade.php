<div>
    <x-modal :id="$modal_id">
        <x-slot name="title">
            {{ $modal_title }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <div class="mb-3">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" wire:model="name">

                    @error('name')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Correo</label>
                    <input type="email" class="form-control" wire:model="email">

                    @error('email')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>


                @if($edit_view)
                    <div class="mb-3">
                        <label for="">Nueva Contraseña</label>
                        <input type="password" class="form-control" wire:model="new_password" placeholder="Mínimo 3 caracteres">

                        @error('new_password')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Confirmar Contraseña</label>
                        <input type="password" class="form-control" wire:model="new_password_confirmation" placeholder="Mínimo 3 caracteres">

                        @error('new_password_confirmation')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" wire:model="password" placeholder="Mínimo 3 caracteres">

                        @error('password')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Confirmar Contraseña</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Mínimo 3 caracteres">

                        @error('password_confirmation')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                @endif

                <div class="mb-3">
                    <label for="">Rol</label>
                    <select class="form-control" wire:model="role">
                        <option value="2">Usuario</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" wire:click="{{ $modal_method }}" wire:loading.attr="disabled">{{ $modal_success_btn }}</button>
        </x-slot>
    </x-modal>

    <x-card>
        <x-slot name="card_content">

            <div class="my-3">
                <button class="btn btn-primary" wire:click="create"><i class="fas fa-plus"></i> Crear nuevo usuario</button>
            </div>

            <x-table :items="$users">
                <x-slot name="head">
                    <tr>
                        <th class="cursor-pointer" wire:click="order('id')" scope="col"></th>
                        <th class="cursor-pointer" wire:click="order('name')" scope="col"></th>
                        <th class="cursor-pointer" wire:click="order('email')" scope="col"></th>
                        <th scope="col">Acciones</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($users as $user)
                        <tr class="text-center align-middle">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} {{ $user->isAdmin() ? '(Admin)' : '' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-primary" wire:click="edit({{ $user }})"><i class="fas fa-edit"></i></button>
                                    <button type="button" wire:click="$emit('deleteModel', {{ $user->id }})" class="ml-2 btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </x-slot>
    </x-card>
</div>
