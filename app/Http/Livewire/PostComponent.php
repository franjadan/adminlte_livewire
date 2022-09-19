<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{User, Post};
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostComponent extends Component
{
    use WithFileUploads;

    public $post_id, $user_id, $image, $title, $content;
    public $new_image, $input_id;
    public $modal_id, $modal_title, $modal_method, $modal_success_btn;
    public $users;

    protected $rules = [
        'title' => ['required'],
        'content' => ['required'],
        'new_image' => ['nullable', 'image', 'max:2048']
    ];

    protected $validationAttributes = [
        'title' => 'Título',
        'content' => 'Contenido',
        'new_image' => 'Imagen'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function __construct()
    {

        $users = User::all();
        $this->users = $users;
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.post-component', compact('posts'))->extends('posts.index')->section('content');
    }

    public function create(){
        $this->reset();
        $this->user_id = auth()->user()->id;
        $this->modal_id = "createModal";
        $this->modal_title = "Crear nuevo post";
        $this->modal_method = "save";
        $this->modal_success_btn = "Crear post";
        $this->input_id = Str::random(5);

        $this->emit('openModal', 'createModal');

    }

    public function save(){
        $this->validate();

        if($this->new_image){
            $image = $this->new_image->store('posts');
        }else{
            $image = null;
        }


        Post::create([
            'user_id' => $this->user_id,
            'image' => $image,
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->emit('closeModal', 'createModal');
        $this->emit('successAlert', 'Se ha creado el post con éxito');
    }

    public function edit(Post $post){
        $this->post_id = $post->id;
        $this->user_id = $post->user_id;
        $this->image = $post->image;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->input_id = Str::random(5);
        $this->modal_id = "editModal";
        $this->modal_title = "Editar post";
        $this->modal_method = "update";
        $this->modal_success_btn = "Actualizar post";

        $this->emit('openModal', 'editModal');

    }

    public function update(){
        $this->validate();

        $post = Post::find($this->post_id);

        if($this->new_image){
            Storage::delete($this->image);
            $this->image = $this->new_image->store('posts');
        }

        $post->update([
            'user_id' => $this->user_id,
            'image' => $this->image,
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->emit('closeModal', 'editModal');
        $this->emit('successAlert', 'Se ha editado el post con éxito');


    }
}
