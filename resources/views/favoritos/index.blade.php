@extends('layouts.app')

@section('title', 'Favoritos')

@section('content-principal')
<div class="favoritos-container" style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div class="header-section" style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 600; color: #1f2937; margin: 0 0 0.5rem 0;">
            <i class="fas fa-star" style="color: #f59e0b; margin-right: 0.5rem;"></i>
            Favoritos
        </h1>
        <p style="color: #6b7280; margin: 0;">Socios marcados como favoritos</p>
    </div>

    @if(count($favoritos) > 0)
        <div class="favoritos-list" style="display: grid; gap: 1rem;">
            @foreach($favoritos as $favorito)
                <div class="favorito-card" 
                     style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.2s; {{ !$favorito->isVisto() ? 'border-left: 4px solid #ef4444;' : '' }}"
                     data-favorito-id="{{ $favorito->id }}">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">
                        <div style="flex: 1; display: flex; gap: 1rem;">
                            <!-- Foto del socio -->
                            <div style="flex-shrink: 0;">
                                @if($favorito->socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $favorito->socio->ruta_foto) }}" 
                                         alt="Foto" 
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;">
                                @else
                                    <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 2px solid #e5e7eb;">
                                        <i class="fas fa-ship" style="font-size: 2rem; color: #9ca3af;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Información del socio -->
                            <div style="flex: 1;">
                                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 0.5rem 0;">
                                    <a href="{{ route('socios.edit', $favorito->socio->id) }}" style="color: #2563eb; text-decoration: none;">
                                        {{ $favorito->socio->nombre_socio }}
                                    </a>
                                </h3>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; color: #6b7280; font-size: 0.875rem;">
                                    <div>
                                        <i class="fas fa-ship" style="margin-right: 0.5rem; color: #2563eb;"></i>
                                        <strong>Barco:</strong> {{ $favorito->socio->nombre_barco ?? '—' }}
                                    </div>
                                    <div>
                                        <i class="fas fa-anchor" style="margin-right: 0.5rem; color: #2563eb;"></i>
                                        <strong>Pantalán:</strong> {{ $favorito->socio->pantalan_t_atraque ?? '—' }}
                                    </div>
                                    <div>
                                        <i class="fas fa-certificate" style="margin-right: 0.5rem; color: #2563eb;"></i>
                                        <strong>Matrícula:</strong> {{ $favorito->socio->matricula ?? '—' }}
                                    </div>
                                    @if($favorito->socio->telefonos->isNotEmpty())
                                        <div>
                                            <i class="fas fa-phone" style="margin-right: 0.5rem; color: #2563eb;"></i>
                                            <strong>Teléfono:</strong> 
                                            @foreach($favorito->socio->telefonos->take(2) as $telefono)
                                                <a href="tel:{{ str_replace(' ', '', $telefono->telefono) }}" style="color: #2563eb; text-decoration: none; margin-right: 0.5rem;">
                                                    {{ $telefono->telefono }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Acciones -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-end;">
                            @if(!$favorito->isVisto())
                                <span class="badge badge-danger" style="background: #ef4444; color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    Nuevo
                                </span>
                            @endif
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('socios.edit', $favorito->socio->id) }}" 
                                   class="btn btn-primary" 
                                   style="padding: 0.5rem 1rem; background: #2563eb; color: white; border-radius: 6px; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem;"
                                   onclick="marcarVisto({{ $favorito->id }})">
                                    <i class="fas fa-eye"></i>
                                    Ver
                                </a>
                                <button type="button" 
                                        class="btn btn-danger" 
                                        onclick="eliminarFavorito({{ $favorito->id }})"
                                        style="padding: 0.5rem 1rem; background: #ef4444; color: white; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-trash"></i>
                                    Eliminar
                                </button>
                            </div>
                            <div style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.5rem;">
                                Añadido: {{ $favorito->created_at->format('d/m/Y H:i') }}
                                @if($favorito->creador)
                                    por {{ $favorito->creador->name }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px; border: 1px solid #e5e7eb;">
            <i class="fas fa-star" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.5rem; color: #374151; margin: 0 0 0.5rem 0;">No hay favoritos</h3>
            <p style="color: #6b7280; margin: 0;">Añade socios a favoritos desde la lista de socios</p>
        </div>
    @endif
</div>

<script>
function marcarVisto(favoritoId) {
    fetch(`/admin/favoritos/${favoritoId}/marcar-visto`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const card = document.querySelector(`[data-favorito-id="${favoritoId}"]`);
            if (card) {
                card.style.borderLeft = '1px solid #e5e7eb';
                const badge = card.querySelector('.badge-danger');
                if (badge) badge.remove();
            }
            // Actualizar badges en el menú
            if (typeof actualizarBadge === 'function') {
                actualizarBadge();
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

function eliminarFavorito(favoritoId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este favorito?')) {
        return;
    }
    
    fetch(`/admin/favoritos/${favoritoId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const card = document.querySelector(`[data-favorito-id="${favoritoId}"]`);
            if (card) {
                card.style.transition = 'opacity 0.3s';
                card.style.opacity = '0';
                setTimeout(() => card.remove(), 300);
            }
            // Actualizar badges en el menú
            if (typeof actualizarBadge === 'function') {
                actualizarBadge();
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar el favorito');
    });
}

// Marcar como visto al hacer clic en el enlace del socio
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorito-card a[href*="socios-edit"]').forEach(link => {
        link.addEventListener('click', function() {
            const favoritoId = this.closest('.favorito-card').getAttribute('data-favorito-id');
            if (favoritoId) {
                marcarVisto(favoritoId);
            }
        });
    });
});
</script>
@endsection
