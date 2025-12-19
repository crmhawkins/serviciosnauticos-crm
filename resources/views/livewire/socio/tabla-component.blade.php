<div class="socios-container">
    <style>
    .socios-table-wrapper {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }
    .modern-table {
        width: 100%;
        border-collapse: collapse;
    }
    .modern-table thead th {
        background: #f9fafb;
        color: #374151;
        font-weight: 600;
        padding: 14px 16px;
        text-align: left;
        border-bottom: 2px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .modern-table thead th:last-child {
        border-right: none;
    }
    .modern-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }
    .modern-table tbody tr:hover {
        background-color: #f9fafb;
    }
    .modern-table tbody tr:last-child {
        border-bottom: none;
    }
    .modern-table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-right: 1px solid #e5e7eb;
    }
    .modern-table tbody td:last-child {
        border-right: none;
    }
    .photo-cell {
        width: 80px;
    }
    .photo-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
    }
    .socio-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .photo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 1.5rem;
    }
    .pantalan-cell, .matricula-cell, .barco-cell {
        font-size: 0.9375rem;
        color: #374151;
    }
    .barco-cell {
        font-weight: 500;
    }
    .situacion-cell {
        min-width: 140px;
    }
    .badge-situacion {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .badge-barco-atraque {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #86efac;
    }
    .badge-barco-varada {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    .badge-persona-socio {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #86efac;
    }
    .badge-persona-transeunte {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    .badge-persona-mixto {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .acciones-cell {
        width: 80px;
    }
    .btn-favorito:hover {
        transform: scale(1.2);
        transition: all 0.2s;
    }
    .favorito-activo {
        color: #f59e0b !important;
    }
    @media (max-width: 768px) {
        .socios-table-wrapper {
            overflow-x: auto;
        }
        .modern-table {
            min-width: 600px;
        }
        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px;
            font-size: 0.875rem;
        }
        .photo-wrapper {
            width: 48px;
            height: 48px;
        }
    }
    </style>
    @if (count($socios) > 0)
        <div class="socios-table-wrapper">
            <table id="sociosTable" class="modern-table">
                <thead>
                    <tr>
                        <th class="photo-cell">Foto</th>
                        <th class="pantalan-cell">Pantalán y Atraque</th>
                        <th class="matricula-cell">Matrícula</th>
                        <th class="barco-cell">Nombre del Barco</th>
                        <th class="situacion-cell">Situación</th>
                        @if(in_array((int) Auth::user()->role, [1, 6], true))
                            <th class="acciones-cell">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                        @php
                            $esFavorito = \App\Models\FavoritoSocio::where('socio_id', $socio->id)->exists();
                        @endphp
                        <tr class="socio-row" 
                            data-socio-id="{{ $socio->id }}">
                            <td class="photo-cell">
                                @if($socio->ruta_foto)
                                    <div class="photo-wrapper">
                                        <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}" 
                                             alt="Foto" 
                                             class="socio-photo"
                                             loading="lazy"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="photo-placeholder" style="display: none;">
                                            <i class="fas fa-ship"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="photo-wrapper">
                                        <div class="photo-placeholder">
                                            <i class="fas fa-ship"></i>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="pantalan-cell" onclick="window.location.href='socios-edit/{{ $socio->id }}?from=socios'">{{ $socio->pantalan_t_atraque ?? '—' }}</td>
                            <td class="matricula-cell" onclick="window.location.href='socios-edit/{{ $socio->id }}?from=socios'">{{ $socio->matricula ?? '—' }}</td>
                            <td class="barco-cell" onclick="window.location.href='socios-edit/{{ $socio->id }}?from=socios'">{{ $socio->nombre_barco ?? '—' }}</td>
                            <td class="situacion-cell" onclick="window.location.href='socios-edit/{{ $socio->id }}?from=socios'">
                                <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-start;">
                                    <span class="badge-situacion badge-barco-{{ $socio->situacion_barco == 0 ? 'atraque' : 'varada' }}">
                                        <i class="fas {{ $socio->situacion_barco == 0 ? 'fa-anchor' : 'fa-tools' }}"></i>
                                        {{ $socio->situacion_barco == 0 ? 'En Atraque' : 'En Varada' }}
                                    </span>
                                    <span class="badge-situacion badge-persona-{{ $socio->situacion_persona == 0 ? 'socio' : ($socio->situacion_persona == 1 ? 'transeunte' : 'mixto') }}">
                                        <i class="fas {{ $socio->situacion_persona == 0 ? 'fa-user' : ($socio->situacion_persona == 1 ? 'fa-walking' : 'fa-users') }}"></i>
                                        @if($socio->situacion_persona == 0)
                                            Socio
                                        @elseif($socio->situacion_persona == 1)
                                            Transeúnte
                                        @else
                                            Socio/Transeúnte
                                        @endif
                                    </span>
                                </div>
                            </td>
                            @if(in_array((int) Auth::user()->role, [1, 6], true))
                                <td class="acciones-cell" style="text-align:center;" onclick="event.stopPropagation();">
                                    <button type="button" 
                                            class="btn-favorito {{ $esFavorito ? 'favorito-activo' : '' }}"
                                            onclick="toggleFavoritoTabla({{ $socio->id }}, {{ $esFavorito ? 'true' : 'false' }}, this)"
                                            style="background:transparent; border:none; cursor:pointer; font-size:1.2rem; color:{{ $esFavorito ? '#f59e0b' : '#9ca3af' }}; padding:0.5rem;"
                                            title="{{ $esFavorito ? 'Quitar de favoritos' : 'Añadir a favoritos' }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="empty-title">No se encuentran socios</h3>
            <p class="empty-description">No hay socios disponibles para el filtro seleccionado.</p>
            <a href="socios-create" class="btn-empty-action">
                <i class="fas fa-user-plus"></i>
                <span>Crear primer socio</span>
            </a>
        </div>
    @endif
</div>

 

<script>
document.addEventListener('DOMContentLoaded', function () {
    initializeDataTable();
});

function initializeDataTable() {
    if (!$.fn.DataTable) return;

    $('#sociosTable').DataTable({
        lengthChange: false,
        pageLength: 35,
        language: {
            lengthMenu: 'Mostrando _MENU_ registros por página',
            zeroRecords: 'No se encontraron registros coincidentes',
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(filtrado de _MAX_ total registros)',
            search: 'Buscar:',
            paginate: {
                first: 'Primero',
                last: 'Último',
                next: '>',
                previous: '<'
            },
        },
        order: [[1, 'asc']], // ordenar por Pantalán/Atraque por defecto
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [0, 4, 5] } // columna de foto, situación y acciones no ordenables
        ]
    });
}

// Re-inicializar tras cada actualización de Livewire
document.addEventListener('livewire:load', function() {
    window.livewire.hook('message.processed', () => {
        if ($.fn.DataTable && $.fn.DataTable.isDataTable('#sociosTable')) {
            $('#sociosTable').DataTable().clear().destroy();
        }
        initializeDataTable();
    });
});

// Toggle favorito en tabla
function toggleFavoritoTabla(socioId, esFavorito, btn) {
    if (esFavorito) {
        // Eliminar favorito
        fetch(`/admin/favoritos/socio/${socioId}`, {
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
                btn.classList.remove('favorito-activo');
                btn.style.color = '#9ca3af';
                btn.title = 'Añadir a favoritos';
                btn.setAttribute('onclick', `toggleFavoritoTabla(${socioId}, false, this)`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al quitar de favoritos');
        });
    } else {
        // Añadir favorito
        fetch(`/admin/favoritos/${socioId}`, {
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
                btn.classList.add('favorito-activo');
                btn.style.color = '#f59e0b';
                btn.title = 'Quitar de favoritos';
                btn.setAttribute('onclick', `toggleFavoritoTabla(${socioId}, true, this)`);
            } else if (data.error) {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al añadir a favoritos');
        });
    }
}
</script>
