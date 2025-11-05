<div class="socios-container">
    <style>
    /* Desktop table header controls */
    .desktop-view .table-header{background:#fff;border:1px solid #e5e7eb;border-bottom:none;border-radius:12px 12px 0 0;padding:16px 16px 8px 16px}
    .desktop-view .table-wrapper{background:#fff;border:1px solid #e5e7eb;border-top:none;border-radius:0 0 12px 12px;overflow:hidden}
    .table-controls{display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap}
    .search-input-wrapper{position:relative;min-width:260px}
    .search-input{width:100%;padding:10px 12px 10px 36px;border:2px solid #e5e7eb;border-radius:10px;background:#fff;transition:.2s}
    .search-input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12)}
    .search-icon{position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af}
    .table-actions{display:flex;align-items:center;gap:14px}
    .control-label{font-size:.875rem;color:#374151;margin-right:6px}
    .page-size-select{padding:8px 10px;border:2px solid #e5e7eb;border-radius:10px;background:#fff}
    .export-buttons{display:flex;gap:8px}
    .export-btn{display:inline-flex;align-items:center;gap:8px;border:none;border-radius:10px;padding:10px 12px;font-weight:600;cursor:pointer;transition:.2s;color:#fff}
    .export-btn[data-action="copy"]{background:#4b5563}
    .export-btn[data-action="copy"]:hover{background:#374151}
    .export-btn[data-action="csv"]{background:#198754}
    .export-btn[data-action="csv"]:hover{background:#157347}
    .export-btn[data-action="pdf"]{background:#dc3545}
    .export-btn[data-action="pdf"]:hover{background:#bb2d3b}
    .modern-table{width:100%;border-collapse:separate;border-spacing:0}
    .modern-table thead th{background:#f9fafb;color:#374151;font-weight:600;padding:12px;border-bottom:1px solid #e5e7eb}
    .modern-table tbody td{padding:12px;border-bottom:1px solid #f1f5f9}
    .photo-placeholder,.photo-wrapper{width:44px;height:44px}
    .socio-photo{width:44px;height:44px;object-fit:cover;border-radius:8px;border:2px solid #e5e7eb}
    .acciones-buttons{display:flex;gap:8px;flex-wrap:wrap}
    .btn-action{display:inline-flex;align-items:center;gap:6px;padding:8px 10px;border-radius:10px;text-decoration:none;font-weight:600}
    .btn-edit{background:#2563eb;color:#fff}
    .btn-edit:hover{background:#1d4ed8}
    .btn-alta{background:#22c55e;color:#fff}
    .btn-alta:hover{background:#16a34a}
    .btn-call{background:#4b5563;color:#fff}
    .btn-whatsapp{background:#25d366;color:#fff}
    @media (max-width: 1024px){.desktop-view .table-header{border-radius:12px}}
    </style>
    @if (count($socios) > 0)
        <!-- Desktop Table View -->
        <div class="desktop-view">
            <div class="table-header">
                <div class="table-controls">
                    <div class="search-control">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" class="search-input" placeholder="Buscar socios...">
                        </div>
                    </div>
                    <div class="table-actions">
                        <div class="page-size-control">
                            <label for="pageSize" class="control-label">Por página:</label>
                            <select id="pageSize" class="page-size-select">
                                <option value="35">35</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="export-buttons">
                            <button class="export-btn" data-action="copy">
                                <i class="fas fa-copy"></i>
                                <span>Copiar</span>
                            </button>
                            <button class="export-btn" data-action="csv">
                                <i class="fas fa-file-csv"></i>
                                <span>CSV</span>
                            </button>
                            <button class="export-btn" data-action="pdf">
                                <i class="fas fa-file-pdf"></i>
                                <span>PDF</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-wrapper">
                <table id="sociosTable" class="modern-table">
                    <thead>
                        <tr>
                            <th class="photo-column">Foto</th>
                            <th class="pantalan-column">Pantalán y Atraque</th>
                            <th class="matricula-column">Matrícula</th>
                            <th class="barco-column">Nombre del Barco</th>
                            <th class="socio-column">Nombre del Socio</th>
                            <th class="telefono-column">Teléfono</th>
                            <th class="situacion-column">Situación</th>
                            <th class="acciones-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr class="socio-row" data-socio-id="{{ $socio->id }}">
                                <td class="photo-cell">
                                    @if($socio->ruta_foto)
                                        <div class="photo-wrapper">
                                            <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}" 
                                                 alt="Foto de {{ $socio->nombre_socio }}" 
                                                 class="socio-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="photo-placeholder" style="display: none;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="photo-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="pantalan-cell">{{ $socio->pantalan_t_atraque }}</td>
                                <td class="matricula-cell">{{ $socio->matricula }}</td>
                                <td class="barco-cell">{{ $socio->nombre_barco }}</td>
                                <td class="socio-cell">{{ $socio->nombre_socio }}</td>
                                <td class="telefono-cell">
                                    @if($socio->telefonos->first())
                                        <div class="telefono-info">
                                            <span class="telefono-number">{{ $socio->telefonos->first()->telefono }}</span>
                                            @if($socio->telefonos->count() > 1)
                                                <span class="telefono-count">+{{ $socio->telefonos->count() - 1 }} más</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="no-telefono">Sin teléfono</span>
                                    @endif
                                </td>
                                <td class="situacion-cell">
                                    <span class="situacion-badge situacion-{{ $socio->situacion_persona }}">
                                        @if ($socio->situacion_persona == 0)
                                            Socio
                                        @elseif ($socio->situacion_persona == 1)
                                            Transeúnte
                                        @else
                                            Socio/Transeúnte
                                        @endif
                                    </span>
                                </td>
                                <td class="acciones-cell">
                                    <div class="acciones-buttons">
                                        @if($socio->alta_baja == 0)
                                            <a href="socios-edit/{{ $socio->id }}?from=socios" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i>
                                                <span>Editar</span>
                                            </a>
                                        @else
                                            <a href="socios-alta/{{ $socio->id }}" class="btn-action btn-alta">
                                                <i class="fas fa-user-plus"></i>
                                                <span>Dar de alta</span>
                                            </a>
                                        @endif
                                        
                                        @if($socio->telefonos->isNotEmpty())
                                            @foreach($socio->telefonos as $telefono)
                                                @if(!empty($telefono->telefono))
                                                    <a href="tel:{{ str_replace(' ','',$telefono->telefono) }}" 
                                                       class="btn-action btn-call">
                                                        <i class="fas fa-phone"></i>
                                                        <span>Llamar</span>
                                                    </a>
                                                @endif
                                                @if(Str::startsWith($telefono->telefono, ['6', '7']))
                                                    <a href="https://wa.me/+34{{ str_replace(' ','',$telefono->telefono) }}" 
                                                       class="btn-action btn-whatsapp">
                                                        <i class="fab fa-whatsapp"></i>
                                                        <span>WhatsApp</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Cards View -->
        <div class="mobile-view" wire:ignore>
            <style>
            :root {
                --primary-blue: #2563eb; --primary-blue-dark: #1d4ed8; --success-green: #22c55e; --success-green-dark: #16a34a;
                --gray-50:#f9fafb; --gray-100:#f3f4f6; --gray-200:#e5e7eb; --gray-400:#9ca3af; --gray-500:#6b7280; --gray-700:#374151; --gray-900:#111827;
                --space-1:.25rem; --space-2:.5rem; --space-3:.75rem; --space-4:1rem; --space-6:1.5rem;
                --border-radius:.5rem; --border-radius-lg:.75rem; --border-radius-xl:1rem;
                --shadow-md:0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);
                --shadow-lg:0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05);
                --transition-normal:200ms ease-in-out; --font-size-sm:.875rem; --font-size-base:1rem; --font-size-lg:1.125rem;
            }
            @media (max-width:768px){
                .socio-cardscope .cards-container{display:flex;flex-direction:column;gap:var(--space-4)}
                .socio-cardscope .socio-card{background:#fff;border-radius:var(--border-radius-xl);box-shadow:var(--shadow-md);border:1px solid var(--gray-200);overflow:hidden;transition:all var(--transition-normal)}
                .socio-cardscope .socio-card:hover{box-shadow:var(--shadow-lg);transform:translateY(-2px)}
                .socio-cardscope .card-header{padding:var(--space-4);border-bottom:1px solid var(--gray-200);display:flex;justify-content:space-between;align-items:flex-start}
                .socio-cardscope .socio-info{display:flex;gap:var(--space-3);flex:1}
                .socio-cardscope .socio-photo-section{flex-shrink:0}
                .socio-cardscope .photo-wrapper{position:relative;width:60px;height:60px}
                .socio-cardscope .socio-photo{width:100%;height:100%;object-fit:cover;border-radius:var(--border-radius);border:2px solid var(--gray-200)}
                .socio-cardscope .photo-placeholder{width:100%;height:100%;background:var(--gray-100);border:2px solid var(--gray-200);border-radius:var(--border-radius);display:flex;align-items:center;justify-content:center;color:#9ca3af}
                .socio-cardscope .socio-details{flex:1;min-width:0}
                .socio-cardscope .socio-name{font-size:var(--font-size-lg);font-weight:600;color:var(--gray-900);margin:0 0 var(--space-1) 0}
                .socio-cardscope .barco-name{font-size:var(--font-size-base);color:#6b7280;margin:0 0 var(--space-2) 0}
                .socio-cardscope .socio-meta{display:flex;flex-direction:column;gap:var(--space-1)}
                .socio-cardscope .pantalan-info,.socio-cardscope .matricula-info{display:flex;align-items:center;gap:var(--space-1);font-size:var(--font-size-sm);color:var(--gray-500)}
                .socio-cardscope .pantalan-info i,.socio-cardscope .matricula-info i{color:var(--primary-blue);width:12px}
                .socio-cardscope .card-content{padding:var(--space-4)}
                .socio-cardscope .telefonos-section{margin-bottom:var(--space-4)}
                .socio-cardscope .section-title{font-size:var(--font-size-sm);font-weight:600;color:var(--gray-700);margin:0 0 var(--space-3) 0;display:flex;align-items:center;gap:var(--space-2)}
                .socio-cardscope .section-title i{color:var(--primary-blue)}
                .socio-cardscope .telefonos-list{display:flex;flex-direction:column;gap:var(--space-2)}
                .socio-cardscope .telefono-item{display:flex;justify-content:space-between;align-items:center;padding:var(--space-2) var(--space-3);background:var(--gray-50);border-radius:var(--border-radius)}
                .socio-cardscope .telefono-number{font-weight:500;color:var(--gray-900)}
                .socio-cardscope .telefono-actions{display:flex;gap:var(--space-1)}
                .socio-cardscope .btn-telefono{display:flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:var(--border-radius);text-decoration:none;transition:all var(--transition-normal)}
                .socio-cardscope .btn-telefono.btn-call{background:#4b5563;color:#fff}
                .socio-cardscope .btn-telefono.btn-call:hover{background:#374151;color:#fff}
                .socio-cardscope .btn-telefono.btn-whatsapp{background:#25d366;color:#fff}
                .socio-cardscope .btn-telefono.btn-whatsapp:hover{background:#128c7e;color:#fff}
                .socio-cardscope .card-actions{padding:var(--space-4);border-top:1px solid var(--gray-200);background:var(--gray-50)}
                .socio-cardscope .btn-card{display:flex;align-items:center;justify-content:center;gap:var(--space-2);width:100%;padding:var(--space-3) var(--space-4);border-radius:var(--border-radius-lg);font-weight:600;text-decoration:none;transition:all var(--transition-normal)}
                .socio-cardscope .btn-edit{background:var(--primary-blue)!important;color:#fff!important;border:none}
                .socio-cardscope .btn-edit:hover{background:var(--primary-blue-dark)!important;color:#fff!important}
                .socio-cardscope .btn-alta{background:var(--success-green)!important;color:#fff!important;border:none}
                .socio-cardscope .btn-alta:hover{background:var(--success-green-dark)!important;color:#fff!important}
                .socio-cardscope .socio-card.is-hidden{display:none!important}
            }
            </style>
            <div class="socio-cardscope">
            <div class="mobile-controls">
                <div class="search-control">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="mobileSearchInput" class="search-input" placeholder="Buscar socios...">
                    </div>
                </div>
            </div>
            
            <div class="cards-container" id="mobileCardsContainer">
                @foreach ($socios as $socio)
                    <div class="socio-card" data-socio-id="{{ $socio->id }}" data-nombre="{{ Str::of($socio->nombre_socio)->lower() }}" data-barco="{{ Str::of($socio->nombre_barco)->lower() }}" data-matricula="{{ Str::of($socio->matricula)->lower() }}" data-pantalan="{{ Str::of($socio->pantalan_t_atraque)->lower() }}" data-numero="{{ (string) $socio->numero_socio }}">
                        <div class="card-header">
                            <div class="socio-info">
                                <div class="socio-photo-section">
                                    @if($socio->ruta_foto)
                                        <div class="photo-wrapper">
                                            <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}" 
                                                 alt="Foto de {{ $socio->nombre_socio }}" 
                                                 class="socio-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="photo-placeholder" style="display: none;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="photo-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="socio-details">
                                    <h3 class="socio-name">{{ $socio->nombre_socio }}</h3>
                                    <p class="barco-name">{{ $socio->nombre_barco }}</p>
                                    <div class="socio-meta">
                                        <span class="pantalan-info">
                                            <i class="fas fa-anchor"></i>
                                            {{ $socio->pantalan_t_atraque }}
                                        </span>
                                        <span class="matricula-info">
                                            <i class="fas fa-certificate"></i>
                                            {{ $socio->matricula }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="situacion-badge situacion-{{ $socio->situacion_persona }}">
                                @if ($socio->situacion_persona == 0)
                                    Socio
                                @elseif ($socio->situacion_persona == 1)
                                    Transeúnte
                                @else
                                    Socio/Transeúnte
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-content">
                            @if($socio->telefonos->isNotEmpty())
                                <div class="telefonos-section">
                                    <h4 class="section-title">
                                        <i class="fas fa-phone"></i>
                                        Teléfonos
                                    </h4>
                                    <div class="telefonos-list">
                                        @foreach($socio->telefonos as $telefono)
                                            @if(!empty($telefono->telefono))
                                                <div class="telefono-item">
                                                    <span class="telefono-number">{{ $telefono->telefono }}</span>
                                                    <div class="telefono-actions">
                                                        <a href="tel:{{ str_replace(' ','',$telefono->telefono) }}" 
                                                           class="btn-telefono btn-call">
                                                            <i class="fas fa-phone"></i>
                                                        </a>
                                                        @if(Str::startsWith($telefono->telefono, ['6', '7']))
                                                            <a href="https://wa.me/+34{{ str_replace(' ','',$telefono->telefono) }}" 
                                                               class="btn-telefono btn-whatsapp">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-actions">
                            @if($socio->alta_baja == 0)
                                <a href="socios-edit/{{ $socio->id }}?from=socios" class="btn-card btn-edit">
                                    <i class="fas fa-edit"></i>
                                    <span>Editar</span>
                                </a>
                            @else
                                <a href="socios-alta/{{ $socio->id }}" class="btn-card btn-alta">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Dar de alta</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
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
    // Initialize DataTable for desktop
    if (window.innerWidth > 768) { initializeDataTable(); }
    updateResponsiveViews();
    
    // Initialize search functionality
    initializeSearch();
    
    // Initialize page size control
    initializePageSize();
    
    // Initialize export buttons
    initializeExportButtons();
    // Keep correct view on resize
    window.addEventListener('resize', updateResponsiveViews);
});

function initializeDataTable() {
    $('#sociosTable').DataTable({
        lengthChange: false,
        dom: 'Bfrtip',
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
        order: [[0, 'asc']],
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [0, 7] } // Photo and actions columns
        ],
        buttons: [
            { extend: 'copy', text: 'Copiar', exportOptions: { columns: ':not(:last-child)', modifier: { search: 'applied', order: 'applied' } } },
            { extend: 'csv', text: 'CSV', exportOptions: { columns: ':not(:last-child)', modifier: { search: 'applied', order: 'applied' } } },
            { extend: 'pdf', text: 'PDF', exportOptions: { columns: ':not(:last-child)', modifier: { search: 'applied', order: 'applied' } } }
        ]
    });
}

function updateResponsiveViews() {
    var isMobile = window.matchMedia('(max-width: 768px)').matches;
    var desktop = document.querySelector('.desktop-view');
    var mobile = document.querySelector('.mobile-view');
    if (!desktop || !mobile) return;
    if (isMobile) {
        desktop.style.display = 'none';
        mobile.style.display = 'block';
        if ($.fn.DataTable && $.fn.DataTable.isDataTable('#sociosTable')) {
            $('#sociosTable').DataTable().clear().destroy();
        }
    } else {
        desktop.style.display = 'block';
        mobile.style.display = 'none';
        if ($.fn.DataTable && !$.fn.DataTable.isDataTable('#sociosTable')) {
            initializeDataTable();
        }
    }
}

function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const mobileSearchInput = document.getElementById('mobileSearchInput');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const table = $('#sociosTable').DataTable();
            if (table) { table.search(this.value).draw(); }
        });
    }
    
    if (mobileSearchInput) {
        mobileSearchInput.addEventListener('input', function() {
            filterMobileCards(this.value);
        });
    }
}

function filterMobileCards(searchTerm) {
    const cards = document.querySelectorAll('.socio-card');
    const term = searchTerm.toLowerCase();
    
    cards.forEach(card => {
        const socioName = card.querySelector('.socio-name').textContent.toLowerCase();
        const barcoName = card.querySelector('.barco-name').textContent.toLowerCase();
        const pantalanInfo = card.querySelector('.pantalan-info').textContent.toLowerCase();
        const matriculaInfo = card.querySelector('.matricula-info').textContent.toLowerCase();
        
        const matches = socioName.includes(term) || 
                       barcoName.includes(term) || 
                       pantalanInfo.includes(term) || 
                       matriculaInfo.includes(term);
        
        card.style.display = matches ? 'block' : 'none';
    });
}

function initializePageSize() {
    const pageSizeSelect = document.getElementById('pageSize');
    if (pageSizeSelect) {
        pageSizeSelect.addEventListener('change', function() {
            const table = $('#sociosTable').DataTable();
            if (table) { table.page.len(parseInt(this.value)).draw(); }
        });
    }
}

function initializeExportButtons() {
    const exportButtons = document.querySelectorAll('.export-btn');
    exportButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            const table = $('#sociosTable').DataTable();
            if (table) {
                switch(action) {
                    case 'copy':
                        table.button('.buttons-copy').trigger();
                        break;
                    case 'csv':
                        table.button('.buttons-csv').trigger();
                        break;
                    case 'pdf':
                        table.button('.buttons-pdf').trigger();
                        break;
                }
            }
        });
    });
}

// Reinitialize when Livewire updates
document.addEventListener('livewire:load', function() {
    window.livewire.hook('message.processed', () => {
        // Reaplicar modo responsive y volver a enlazar comportamientos tras cada render
        // Timeout 0 para asegurar DOM final aplicado
        setTimeout(function(){
            updateResponsiveViews();
            initializeSearch();
            initializePageSize();
            initializeExportButtons();
            applyMobileSortFromSelectors();
        }, 0);
    });
});
</script>

<script>
// Mobile sorting helpers
function isMobile() { return window.matchMedia('(max-width: 768px)').matches; }

function applyMobileSortFromSelectors() {
    if (!isMobile()) return;
    var orderBySel = document.getElementById('orderBy');
    var orderDirSel = document.getElementById('orderDir');
    if (!orderBySel || !orderDirSel) return;
    sortMobileCards(orderBySel.value, orderDirSel.value);
}

function sortMobileCards(orderBy, orderDir) {
    if (!isMobile()) return;
    var container = document.getElementById('mobileCardsContainer');
    if (!container) return;
    var cards = Array.from(container.querySelectorAll('.socio-card'));
    var dir = (orderDir || 'asc').toLowerCase() === 'desc' ? -1 : 1;
    var map = {
        'nombre_socio': 'nombre',
        'numero_socio': 'numero',
        'pantalan_t_atraque': 'pantalan',
        'nombre_barco': 'barco',
        'matricula': 'matricula'
    };
    var dataKey = map[orderBy] || 'nombre';
    cards.sort(function(a, b) {
        var va = a.dataset[dataKey] || '';
        var vb = b.dataset[dataKey] || '';
        if (dataKey === 'numero') {
            var na = parseFloat(va) || 0;
            var nb = parseFloat(vb) || 0;
            return (na - nb) * dir;
        }
        return va.localeCompare(vb, 'es', { sensitivity: 'base' }) * dir;
    });
    cards.forEach(function(card){ container.appendChild(card); });
}

// Bind selectors once
document.addEventListener('DOMContentLoaded', function(){
    function bindChange(id){
        var el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('change', function(){ applyMobileSortFromSelectors(); });
    }
    bindChange('orderBy');
    bindChange('orderDir');
    applyMobileSortFromSelectors();
});
</script>

<!-- DataTables Buttons dependencies (solo si no están ya cargadas globalmente) -->
<script src="../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake.min.js"></script>
<script src="../plugins/datatables/vfs_fonts.js"></script>
<script src="../plugins/datatables/buttons.html5.min.js"></script>
