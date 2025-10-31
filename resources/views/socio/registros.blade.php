@extends('layouts.app')

@section('title', 'Registros de entrada y salida')

@section('content-principal')
<div class="modern-edit-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-history"></i>
                    Registros de entrada y salida
                </h1>
                <p class="page-subtitle">Histórico de atraque/varada y transeúntes del socio {{ $socio->nombre_socio ?? '' }}</p>
            </div>
            <div class="header-actions"></div>
        </div>
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="{{ route('socios.edit', $socio->id) }}" class="breadcrumb-item"><i class="fas fa-user-edit"></i> Editar socio</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active"><i class="fas fa-history"></i> Registros</span>
            </nav>
        </div>
    </div>

    <div class="form-section">
        <div class="form-container">
            <div class="form-section-card">
                <h3 class="section-title"><i class="fas fa-anchor"></i> Registros de atraque/varada</h3>
                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Fecha entrada</th>
                                <th>Fecha salida</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($socio->registros_entrada ?? []) as $r)
                                <tr>
                                    <td>{{ $r->fecha_1 ?? ($r->fecha_entrada ?? '-') }}</td>
                                    <td>{{ $r->fecha_2 ?? ($r->fecha_salida ?? '-') }}</td>
                                    <td>{{ $r->observaciones ?? '' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3">Sin registros</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-section-card">
                <h3 class="section-title"><i class="fas fa-walking"></i> Registros de transeúntes</h3>
                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Fecha entrada</th>
                                <th>Fecha salida</th>
                                <th>Precio/día</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($socio->registros_entradas_transeuntes ?? []) as $t)
                                <tr>
                                    <td>{{ $t->fecha_entrada ?? '-' }}</td>
                                    <td>{{ $t->fecha_salida ?? '-' }}</td>
                                    <td>{{ $t->precio ?? '-' }}</td>
                                    <td>{{ $t->total ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4">Sin registros</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-save-button" style="padding:8px; background:transparent;">
        <div style="display:flex; gap:8px;">
            <a href="{{ route('socios.edit', $socio->id) }}" 
               style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; background:#2563eb; color:#fff; padding:10px 12px; border-radius:10px; font-weight:600; text-decoration:none; box-shadow: 0 4px 12px rgba(37,99,235,0.35);">
                <i class="fas fa-arrow-left"></i>
                <span>Volver al Edit</span>
            </a>
        </div>
    </div>
</div>

@include('livewire.socio.edit-component-styles')
@endsection


