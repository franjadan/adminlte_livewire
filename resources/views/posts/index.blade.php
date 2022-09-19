@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')

@stop


@section('css')

@stop

@section('js')

@stop

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('successAlert', function($message){
            Swal.fire(
                'Good job!',
                $message,
                'success'
            );
        });

        Livewire.on('openModal', function($id){
            $("#" + $id).modal('show');
        });

        Livewire.on('closeModal', function($id){
            $("#" + $id).modal('hide');
        });
    });
</script>

