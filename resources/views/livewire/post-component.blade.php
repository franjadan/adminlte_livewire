<div>
    <x-card>
        <x-slot name="card_content">
            <x-table>
                <x-slot name="head">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Contenido</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($posts as $post)
                        <tr class="align-middle">
                            <td>{{ $post->id }}</td>
                            <td>{{ Storage::url($post->image) }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </x-slot>
    </x-card>
</div>
