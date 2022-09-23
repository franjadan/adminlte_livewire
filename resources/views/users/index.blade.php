@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

@stop

@section('css')
    <style>
        .cursor-pointer{
            cursor: pointer;
        }
    </style>
@stop

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('alert', function($type, $message){
            Swal.fire(
                'Good job!',
                $message,
                $type
            );
        });

        Livewire.on('openModal', function($id){
            $("#" + $id).modal('show');
        });

        Livewire.on('closeModal', function($id){
            $("#" + $id).modal('hide');
        });

        Livewire.on('deleteModel', id => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value == true) {
                    Livewire.emitTo('user-component', 'delete', id);
                }
            });
        });
    });
</script>


