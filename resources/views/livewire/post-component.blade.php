<div>
    <!-- Modal creación y edición -->
        <x-modal :id="$modal_id">
            <x-slot name="title">
                {{ $modal_title }}
            </x-slot>

            <x-slot name="content">
                <div class="mb-4">
                    <div wire:loading wire:target="new_image" class="mb-3">
                        <div>
                            <strong>Cargando imagen...</strong>
                            <div class="spinner-border ml-3" role="status" aria-hidden="true"></div>
                        </div>
                    </div>

                    @if($new_image)
                        <div class="mb-3">
                            <img class="img-fluid" src="{{ $new_image->temporaryUrl() }}" alt="">
                        </div>
                    @else
                        @if($image)
                            <div class="mb-3">
                                <img class="img-fluid" src="{{ Storage::url($image) }}" alt="">
                            </div>
                        @endif
                    @endif
                    <div class="mb-3">
                        <label for="">Usuario</label>
                        <select wire:model="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title">Título del post</label>
                        <input type="text" class="form-control" id="title" wire:model="title">

                        @error('title')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content">Contenido del post</label>
                        <textarea wire:model="content" class="form-control" id="content" cols="30" rows="10"></textarea>

                        @error('content')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id={{ $input_id }} wire:loading.attr="disabled" wire:target="{{ $modal_method }}, new_image" type="file" wire:model="new_image">

                        @error('new_image')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" wire:click="{{ $modal_method }}" wire:loading.attr="disabled">{{ $modal_success_btn }}</button>
            </x-slot>
        </x-modal>
    <!-- Fin modal -->


    <x-card>
        <x-slot name="card_content">

            <div class="my-3">
                <button class="btn btn-primary" wire:click="create"><i class="fas fa-plus"></i> Crear nuevo post</button>
            </div>

            <x-table :items="$posts">
                <x-slot name="head">
                    <tr>
                        <th class="cursor-pointer" wire:click="order('id')" scope="col"># <x-sort field="id" :sort="$sort" :direction="$direction"></x-sort></th>
                        <th scope="col">Imagen </th>
                        <th class="cursor-pointer" wire:click="order('title')" scope="col">Título <x-sort field="title" :sort="$sort" :direction="$direction"></x-sort></th>
                        <th class="cursor-pointer" wire:click="order('content')" scope="col">Contenido <x-sort field="content" :sort="$sort" :direction="$direction"></x-sort></th>
                        <th class="cursor-pointer" wire:click="order('users.name')" scope="col">Usuario <x-sort field="users.name" :sort="$sort" :direction="$direction"></x-sort></th>
                        <th scope="col">Acciones</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($posts as $post)
                        <tr class="text-center align-middle">
                            <td>{{ $post->id }}</td>
                            <td>@if($post->image)   <img class="img-fluid" src="{{ Storage::url($post->image) }}" alt=""> @endif</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-primary" wire:click="edit({{ $post }})"><i class="fas fa-edit"></i></button>
                                    <button type="button" wire:click="$emit('deleteModel', {{ $post->id }})" class="ml-2 btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
           
        </x-slot>
    </x-card>
</div>
