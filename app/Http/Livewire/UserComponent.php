<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user_id, $name, $email, $password, $password_confirmation, $new_password, $new_password_confirmation, $role;
    public $modal_id, $modal_title, $modal_method, $modal_success_btn;
    public $search = '', $cant = '10', $sort = 'id', $direction = 'desc';
    public $edit_view = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'delete',
    ];

    function rules(){
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user_id . ''],
            'password' => ['sometimes', 'required', 'min:3'],
            'password_confirmation' => ['sometimes', 'required_with:password', 'same:password'],
            'new_password' => ['sometimes', 'nullable', 'min:3'],
            'new_password_confirmation' => ['sometimes', 'required_with:new_password', 'same:new_password'],
            'role' => ['required'],
        ];
    }

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Correo',
        'password' => 'Contraseña',
        'new_password' => 'Contraseña',
        'new_password_confirmation' => 'Confirmar contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'role' => 'Rol'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function order($sort){
        
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function render()
    {
        $title = "Usuarios";
        $users = User::where('id', '<>', auth()->user()->id)->where(function ($query){ return $query->where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%'); })->orderBy($this->sort, $this->direction)->paginate($this->cant);
                
        return view('livewire.user-component', compact('users'))->extends('dashboard', compact('title'))->section('content');
    }

    public function create(){
        $this->reset();
        $this->user_id = auth()->user()->id;
        $this->modal_id = "createModal";
        $this->modal_title = "Crear nuevo usuario";
        $this->modal_method = "save";
        $this->modal_success_btn = "Crear usuario";
        $this->edit_view = false;
        $this->emit('openModal', 'createModal');

    }

    public function save(){
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]); 

        $this->emit('closeModal', 'createModal');
        $this->emit('alert', 'success', 'Se ha creado el usuario con éxito');
    }

    public function edit(User $user){
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->password_confirmation = $user->password;
        $this->role = $user->role;
        $this->edit_view = true;
        $this->modal_id = "editModal";
        $this->modal_title = "Editar usuario";
        $this->modal_method = "update";
        $this->modal_success_btn = "Actualizar usuario";

        $this->emit('openModal', 'editModal');

    }

    public function update(){
        $this->validate();

        $user = User::find($this->user_id);

        if($this->new_password){
            $this->password = bcrypt($this->new_password);
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ]);

        $this->emit('closeModal', 'editModal');
        $this->emit('alert', 'success', 'Se ha editado el usuario con éxito');
    }

    public function delete(User $user){

        $user->delete();
        $this->emit('alert', 'success', 'Se ha eliminado el usuario con éxito');
    }

}
