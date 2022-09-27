<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Hash;

class ProfileComponent extends Component
{

    public $name, $email;
    public $old_password, $new_password, $confirm_new_password;

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Correo',
        'old_password' => 'Contraseña antigua',
        'new_password' => 'Nueva contraseña',
        'confirm_new_password' => 'Confirmar nueva contraseña'
    ];

    public function render()
    {

        return view('livewire.profile-component')->extends('dashboard', ['title' => "Perfil"])->section('content');
    }

    public function edit(){
        $this->reset();
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->emit('openModal', 'editModal');
    }

    public function update(){
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id . ''],
        ]);

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        $this->emit('closeModal', 'editModal');
        $this->emit('alert', 'success', 'Se ha actualizado el perfil con éxito');
    }

    public function editPassword(){
        $this->reset();
        $this->emit('openModal', 'editPasswordModal');
    }

    public function updatePassword(){
        $this->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:3'],
            'confirm_new_password' => ['required', 'same:new_password']
        ]);

        if(!Hash::check($this->old_password, auth()->user()->password)){
            $this->resetErrorBag('old_password');
            $this->resetValidation('old_password');
            $this->addError('old_password', 'La contraseña antigua no coincide con tu contraseña actual');
        }else{
            auth()->user()->update([
                'password' => bcrypt($this->new_password)
            ]);
            $this->emit('closeModal', 'editPasswordModal');
            $this->emit('alert', 'success', 'Se ha actualizado la contraseña con éxito');
        }
        
    }
}
