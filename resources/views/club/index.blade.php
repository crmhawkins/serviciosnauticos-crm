@extends('layouts.app')

@section('title', 'Ver clubes')

@section('head')
    {{-- @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss']) --}}

@section('content-principal')
<div>
    @livewire('club.index-component')
</div>
@endsection


