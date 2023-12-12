@extends('layouts.app')

@section('title', 'Ver/Editar club')

@section('head')
    {{-- @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss']) --}}

@section('content-principal')
<div>
    @livewire('club.edit-component', ['identificador'=>$id])
</div>
@endsection


