<div class="socios-container">
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
                                            <a href="socios-edit/{{ $socio->id }}" class="btn-action btn-edit">
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
        <div class="mobile-view">
            <div class="mobile-controls">
                <div class="search-control">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="mobileSearchInput" class="search-input" placeholder="Buscar socios...">
                    </div>
                </div>
            </div>
            
            <div class="cards-container">
                @foreach ($socios as $socio)
                    <div class="socio-card" data-socio-id="{{ $socio->id }}">
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
                                <a href="socios-edit/{{ $socio->id }}" class="btn-card btn-edit">
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

<style>
/* Design System Variables */
:root {
    /* Colors */
    --primary-blue: #2563eb;
    --primary-blue-dark: #1d4ed8;
    --primary-blue-light: #3b82f6;
    --success-green: #22c55e;
    --success-green-dark: #16a34a;
    --warning-orange: #f59e0b;
    --warning-orange-dark: #d97706;
    --danger-red: #ef4444;
    --danger-red-dark: #dc2626;
    --whatsapp-green: #25d366;
    --whatsapp-green-dark: #128c7e;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Spacing */
    --space-1: 0.25rem;
    --space-2: 0.5rem;
    --space-3: 0.75rem;
    --space-4: 1rem;
    --space-5: 1.25rem;
    --space-6: 1.5rem;
    --space-8: 2rem;
    --space-10: 2.5rem;
    --space-12: 3rem;
    
    /* Typography */
    --font-size-xs: 0.75rem;
    --font-size-sm: 0.875rem;
    --font-size-base: 1rem;
    --font-size-lg: 1.125rem;
    --font-size-xl: 1.25rem;
    --font-size-2xl: 1.5rem;
    --font-size-3xl: 1.875rem;
    
    /* Border Radius */
    --border-radius-sm: 0.375rem;
    --border-radius: 0.5rem;
    --border-radius-lg: 0.75rem;
    --border-radius-xl: 1rem;
    
    /* Shadows */
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    
    /* Transitions */
    --transition-fast: 150ms ease-in-out;
    --transition-normal: 200ms ease-in-out;
    --transition-slow: 300ms ease-in-out;
}

/* Main Container */
.socios-container {
    padding: var(--space-6);
}

/* Desktop View */
.desktop-view {
    display: block;
}

.mobile-view {
    display: none;
}

/* Table Header */
.table-header {
    background: white;
    padding: var(--space-6);
    border-bottom: 1px solid var(--gray-200);
}

.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--space-4);
}

.search-control {
    flex: 1;
    max-width: 400px;
}

.search-input-wrapper {
    position: relative;
}

.search-input {
    width: 100%;
    padding: var(--space-3) var(--space-4) var(--space-3) var(--space-10);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius-lg);
    font-size: var(--font-size-base);
    transition: all var(--transition-normal);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-icon {
    position: absolute;
    left: var(--space-3);
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    font-size: var(--font-size-sm);
}

.table-actions {
    display: flex;
    align-items: center;
    gap: var(--space-4);
}

.page-size-control {
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.control-label {
    font-size: var(--font-size-sm);
    color: var(--gray-600);
    font-weight: 500;
}

.page-size-select {
    padding: var(--space-2) var(--space-3);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    font-size: var(--font-size-sm);
    background: white;
    cursor: pointer;
}

.export-buttons {
    display: none; /* oculto en escritorio */
    gap: var(--space-2);
}

.export-btn {
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-2) var(--space-3);
    background: var(--gray-100);
    border: 1px solid var(--gray-200);
    border-radius: var(--border-radius);
    font-size: var(--font-size-sm);
    color: var(--gray-700);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.export-btn:hover {
    background: var(--gray-200);
    color: var(--gray-900);
}

/* Table */
.table-wrapper {
    overflow-x: auto;
    background: white;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: var(--font-size-sm);
}

.modern-table thead {
    background: var(--gray-50);
}

.modern-table th {
    padding: var(--space-4);
    text-align: left;
    font-weight: 600;
    color: var(--gray-700);
    border-bottom: 2px solid var(--gray-200);
    white-space: nowrap;
}

.modern-table td {
    padding: var(--space-4);
    border-bottom: 1px solid var(--gray-200);
    vertical-align: middle;
}

.socio-row:hover {
    background: var(--gray-50);
}

/* Photo */
.photo-wrapper {
    position: relative;
    width: 50px;
    height: 50px;
}

.socio-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--border-radius);
    border: 2px solid var(--gray-200);
}

.photo-placeholder {
    width: 100%;
    height: 100%;
    background: var(--gray-100);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    font-size: var(--font-size-lg);
}

/* Situación Badge */
.situacion-badge {
    display: inline-flex;
    align-items: center;
    padding: var(--space-1) var(--space-3);
    border-radius: var(--border-radius-lg);
    font-size: var(--font-size-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.situacion-0 {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success-green-dark);
}

.situacion-1 {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-orange-dark);
}

.situacion-2 {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary-blue-dark);
}

/* Action Buttons */
.acciones-buttons {
    display: flex;
    gap: var(--space-2);
    flex-wrap: wrap;
}

.btn-action {
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-2) var(--space-3);
    border-radius: var(--border-radius);
    font-size: var(--font-size-xs);
    font-weight: 500;
    text-decoration: none;
    transition: all var(--transition-normal);
    white-space: nowrap;
}

.btn-edit {
    background: var(--primary-blue);
    color: white;
}

.btn-edit:hover {
    background: var(--primary-blue-dark);
    color: white;
    text-decoration: none;
}

.btn-alta {
    background: var(--success-green);
    color: white;
}

.btn-alta:hover {
    background: var(--success-green-dark);
    color: white;
    text-decoration: none;
}

.btn-call {
    background: var(--gray-600);
    color: white;
}

.btn-call:hover {
    background: var(--gray-700);
    color: white;
    text-decoration: none;
}

.btn-whatsapp {
    background: var(--whatsapp-green);
    color: white;
}

.btn-whatsapp:hover {
    background: var(--whatsapp-green-dark);
    color: white;
    text-decoration: none;
}

/* Telefono Info */
.telefono-info {
    display: flex;
    flex-direction: column;
    gap: var(--space-1);
}

.telefono-number {
    font-weight: 500;
    color: var(--gray-900);
}

.telefono-count {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
}

.no-telefono {
    color: var(--gray-400);
    font-style: italic;
}

/* Mobile View */
@media (max-width: 768px) {
    .export-buttons { display: flex; }
    .desktop-view {
        display: none;
    }
    
    .mobile-view {
        display: block;
    }
    
    .socios-container {
        padding: var(--space-4);
    }
    
    .mobile-controls {
        margin-bottom: var(--space-4);
    }
    
    .cards-container {
        display: flex;
        flex-direction: column;
        gap: var(--space-4);
    }
    
    .socio-card {
        background: white;
        border-radius: var(--border-radius-xl);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: all var(--transition-normal);
    }
    
    .socio-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }
    
    .card-header {
        padding: var(--space-4);
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .socio-info {
        display: flex;
        gap: var(--space-3);
        flex: 1;
    }
    
    .socio-photo-section {
        flex-shrink: 0;
    }
    
    .socio-photo-section .photo-wrapper {
        width: 60px;
        height: 60px;
    }
    
    .socio-details {
        flex: 1;
        min-width: 0;
    }
    
    .socio-name {
        font-size: var(--font-size-lg);
        font-weight: 600;
        color: var(--gray-900);
        margin: 0 0 var(--space-1) 0;
    }
    
    .barco-name {
        font-size: var(--font-size-base);
        color: var(--gray-600);
        margin: 0 0 var(--space-2) 0;
    }
    
    .socio-meta {
        display: flex;
        flex-direction: column;
        gap: var(--space-1);
    }
    
    .pantalan-info,
    .matricula-info {
        display: flex;
        align-items: center;
        gap: var(--space-1);
        font-size: var(--font-size-sm);
        color: var(--gray-500);
    }
    
    .pantalan-info i,
    .matricula-info i {
        color: var(--primary-blue);
        width: 12px;
    }
    
    .card-content {
        padding: var(--space-4);
    }
    
    .telefonos-section {
        margin-bottom: var(--space-4);
    }
    
    .section-title {
        font-size: var(--font-size-sm);
        font-weight: 600;
        color: var(--gray-700);
        margin: 0 0 var(--space-3) 0;
        display: flex;
        align-items: center;
        gap: var(--space-2);
    }
    
    .section-title i {
        color: var(--primary-blue);
    }
    
    .telefonos-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-2);
    }
    
    .telefono-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--space-2) var(--space-3);
        background: var(--gray-50);
        border-radius: var(--border-radius);
    }
    
    .telefono-number {
        font-weight: 500;
        color: var(--gray-900);
    }
    
    .telefono-actions {
        display: flex;
        gap: var(--space-1);
    }
    
    .btn-telefono {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: var(--border-radius);
        text-decoration: none;
        transition: all var(--transition-normal);
    }
    
    .btn-telefono.btn-call {
        background: var(--gray-600);
        color: white;
    }
    
    .btn-telefono.btn-call:hover {
        background: var(--gray-700);
        color: white;
    }
    
    .btn-telefono.btn-whatsapp {
        background: var(--whatsapp-green);
        color: white;
    }
    
    .btn-telefono.btn-whatsapp:hover {
        background: var(--whatsapp-green-dark);
        color: white;
    }
    
    .card-actions {
        padding: var(--space-4);
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
    }
    
    .btn-card {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-2);
        width: 100%;
        padding: var(--space-3) var(--space-4);
        border-radius: var(--border-radius-lg);
        font-weight: 600;
        text-decoration: none;
        transition: all var(--transition-normal);
    }
    
    .btn-card.btn-edit {
        background: var(--primary-blue);
        color: white;
    }
    
    .btn-card.btn-edit:hover {
        background: var(--primary-blue-dark);
        color: white;
        text-decoration: none;
    }
    
    .btn-card.btn-alta {
        background: var(--success-green);
        color: white;
    }
    
    .btn-card.btn-alta:hover {
        background: var(--success-green-dark);
        color: white;
        text-decoration: none;
    }
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-12) var(--space-6);
    background: white;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.empty-icon {
    font-size: 4rem;
    color: var(--gray-300);
    margin-bottom: var(--space-4);
}

.empty-title {
    font-size: var(--font-size-2xl);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 var(--space-2) 0;
}

.empty-description {
    color: var(--gray-600);
    margin: 0 0 var(--space-6) 0;
    font-size: var(--font-size-lg);
}

.btn-empty-action {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-6);
    background: var(--success-green);
    color: white;
    text-decoration: none;
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    transition: all var(--transition-normal);
}

.btn-empty-action:hover {
    background: var(--success-green-dark);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .socios-container {
        padding: var(--space-3);
    }
    
    .socio-name {
        font-size: var(--font-size-base);
    }
    
    .barco-name {
        font-size: var(--font-size-sm);
    }
    
    .socio-meta {
        font-size: var(--font-size-xs);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable for desktop
    if (window.innerWidth > 768) {
        initializeDataTable();
    }
    
    // Initialize search functionality
    initializeSearch();
    
    // Initialize page size control
    initializePageSize();
    
    // Initialize export buttons
    initializeExportButtons();
});

function initializeDataTable() {
    $('#sociosTable').DataTable({
        lengthChange: false,
        dom: 'lrtip',
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
        ]
    });
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
                        // Copy functionality
                        break;
                    case 'csv':
                        // CSV export
                        break;
                    case 'pdf':
                        // PDF export
                        break;
                }
            }
        });
    });
}

// Reinitialize when Livewire updates
document.addEventListener('livewire:load', function() {
    window.livewire.hook('message.processed', () => {
        if (window.innerWidth > 768) {
            if ($.fn.DataTable.isDataTable('#sociosTable')) {
                $('#sociosTable').DataTable().clear().destroy();
            }
            initializeDataTable();
        }
    });
});
</script>
