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
        min-width: 200px;
        white-space: nowrap;
    }
    .acciones-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-accion {
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-accion.btn-editar {
        background: #2563eb;
        color: white;
    }
    .btn-accion.btn-editar:hover {
        background: #1d4ed8;
    }
    .btn-accion.btn-llamar {
        background: #4b5563;
        color: white;
    }
    .btn-accion.btn-llamar:hover {
        background: #374151;
    }
    .btn-accion.btn-whatsapp {
        background: #25d366;
        color: white;
    }
    .btn-accion.btn-whatsapp:hover {
        background: #128c7e;
    }
    .btn-favorito {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0.5rem;
        transition: all 0.2s;
    }
    .btn-favorito:hover {
        transform: scale(1.2);
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
                        <th class="acciones-cell">Acciones</th>
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
                            <td class="acciones-cell" onclick="event.stopPropagation();">
                                <div class="acciones-buttons">
                                    @can('update', $socio)
                                        <a href="socios-edit/{{ $socio->id }}?from=socios" class="btn-accion btn-editar" title="Ver/Editar">
                                            <i class="fas fa-edit"></i>
                                            <span>Editar</span>
                                        </a>
                                    @else
                                        <a href="socios-edit/{{ $socio->id }}?from=socios" class="btn-accion" style="background:#6b7280;color:#fff" title="Ver">
                                            <i class="fas fa-eye"></i>
                                            <span>Ver</span>
                                        </a>
                                    @endcan
                                    
                                    @if($socio->telefonos->isNotEmpty())
                                        @foreach($socio->telefonos->take(1) as $telefono)
                                            @if(!empty($telefono->telefono))
                                                <a href="tel:{{ str_replace(' ', '', $telefono->telefono) }}" 
                                                   class="btn-accion btn-llamar" 
                                                   title="Llamar a {{ $telefono->telefono }}">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                                @if(Str::startsWith($telefono->telefono, ['6', '7']))
                                                    <a href="https://wa.me/+34{{ str_replace(' ', '', $telefono->telefono) }}" 
                                                       class="btn-accion btn-whatsapp" 
                                                       target="_blank"
                                                       title="WhatsApp a {{ $telefono->telefono }}">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    @if(in_array((int) Auth::user()->role, [1, 6], true))
                                        <button type="button" 
                                                class="btn-favorito {{ $esFavorito ? 'favorito-activo' : '' }}"
                                                onclick="toggleFavoritoTabla({{ $socio->id }}, {{ $esFavorito ? 'true' : 'false' }}, this)"
                                                style="color:{{ $esFavorito ? '#f59e0b' : '#9ca3af' }};"
                                                title="{{ $esFavorito ? 'Quitar de favoritos' : 'Añadir a favoritos' }}">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
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
