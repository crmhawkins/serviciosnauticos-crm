@extends('layouts.app')

@section('title', 'Volver a dar de alta socio')

@section('head')
    {{-- @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss']) --}}

@section('content-principal')
<div>
    @livewire('socio.alta-component', ['identificador'=>$id])
</div>
@endsection


