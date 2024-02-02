@extends('layouts.app')

@section('title', 'Ver Todos los socios')

@section('head')
    {{-- @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss']) --}}

@section('content-principal')
<div>
    @livewire('socio.index-admin-component')
</div>
@endsection
