<div class="modern-index-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-users"></i>
                    Socios
                </h1>
                <p class="page-subtitle">Gestiona los socios y transeúntes del club</p>
            </div>
            <div class="header-actions header-actions--single">
                <a href="socios-create" class="btn-add-socio btn-add-socio--full">
                    <i class="fas fa-user-plus"></i>
                    <span>Nuevo Socio</span>
                </a>
            </div>
        </div>
        
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-users"></i>
                    Socios
                </span>
            </nav>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-section">
        <div class="filter-card">
            <div class="filter-header">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i>
                    Filtros
                </h3>
            </div>
            <div class="filter-content">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="vista" class="filter-label">Listado a seleccionar</label>
                        <div class="select-wrapper" wire:ignore.self>
                            <select wire:model="vista" id="vista" class="modern-select">
                                <option value="1">Todos en alta</option>
                                <option value="2">Socios en alta</option>
                                <option value="3">Socios en atraque</option>
                                <option value="4">Socios en varada</option>
                                <option value="5">Socios en baja</option>
                                <option value="6">Transeúntes en alta</option>
                                <option value="7">Transeúntes en atraque</option>
                                <option value="8">Transeúntes en varada</option>
                                <option value="9">Transeúntes en baja</option>
                                <option value="10">Socio/Transeúntes en alta</option>
                            </select>
                            <i class="fas fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>
                    <div class="export-actions">
                        <a href="{{ route('socios.export.excel') }}" class="btn-export btn-export-excel">
                            <i class="fas fa-file-excel"></i>
                            <span>Exportar Excel</span>
                        </a>
                        <a href="{{ route('socios.export.pdf') }}" class="btn-export btn-export-pdf">
                            <i class="fas fa-file-pdf"></i>
                            <span>Exportar PDF</span>
                        </a>
                    </div>
            </div>
        </div>
        
        <!-- Order Section -->
        <div class="filter-card" style="margin-top: 1rem;">
            <div class="filter-header">
                <h3 class="filter-title">
                    <i class="fas fa-sort"></i>
                    Ordenar
                </h3>
            </div>
            <div class="filter-content">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="orderBy" class="filter-label">Ordenar por</label>
                        <div class="select-wrapper">
                            <select wire:model="orderBy" id="orderBy" class="modern-select">
                                <option value="pantalan_t_atraque">Pantalán / Atraque</option>
                                <option value="nombre_socio">Nombre del socio</option>
                                <option value="numero_socio">Nº de socio</option>
                                <option value="nombre_barco">Nombre del barco</option>
                                <option value="matricula">Matrícula</option>
                            </select>
                            <i class="fas fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="orderDir" class="filter-label">Dirección</label>
                        <div class="select-wrapper">
                            <select wire:model="orderDir" id="orderDir" class="modern-select">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                            <i class="fas fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        @switch($vista)
            @case(1)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(2)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(3)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(4)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(5)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(6)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(7)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(8)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(9)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @case(10)
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
            @default
                @livewire('socio.tabla-component', ['vista' => $vista])
            @break
        @endswitch
    </div>
</div>


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var table = $('#datatable-buttons').DataTable({
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
                last: 'Ultimo',
                next: '>',

                previous: '<'
            },
        },
        order: [[0, 'asc']],
    });

    // botones de DataTables deshabilitados; usamos nuestros botones propios en Filtros

    // Escucha el cambio en el selector de cantidad de páginas
    $('#pageSize').change(function () {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
    });
});
</script>
<script>
    document.addEventListener('livewire:load', function() {
        window.livewire.hook('message.processed', () => {
            // Verifica si la instancia de DataTables ya existe y destrúyela
            if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
                $('#datatable-buttons').DataTable().clear().destroy();
            }

            // Reinicializa DataTables aquí
            $('#datatable-buttons').DataTable({
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
                    last: 'Ultimo',
                    next: '>',

                    previous: '<'
                },
            },
            order: [[0, 'asc']],
            });
        });
    });
    </script>



    <script src="../assets/js/jquery.slimscroll.js"></script>

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/datatables/jszip.min.js"></script>
    <script src="../plugins/datatables/pdfmake.min.js"></script>
    <script src="../plugins/datatables/vfs_fonts.js"></script>
    <script src="../plugins/datatables/buttons.html5.min.js"></script>
    <script src="../plugins/datatables/buttons.print.min.js"></script>
    <script src="../plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
@endsection

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
    --font-size-4xl: 2.25rem;
    
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
.modern-index-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--space-6);
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header Section */
.header-section {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-8);
    margin-bottom: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--space-6);
    gap: var(--space-4);
}

.title-section {
    flex: 1;
}

.page-title {
    font-size: var(--font-size-4xl);
    font-weight: 700;
    color: var(--gray-900);
    margin: 0 0 var(--space-2) 0;
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.page-title i {
    color: var(--primary-blue);
    font-size: var(--font-size-3xl);
}

.page-subtitle {
    color: var(--gray-600);
    margin: 0;
    font-size: var(--font-size-lg);
}

.header-actions {
    display: flex;
    gap: var(--space-3);
}

.btn-add-socio {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    background: var(--success-green);
    color: white;
    text-decoration: none;
    padding: var(--space-3) var(--space-6);
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    font-size: var(--font-size-base);
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-md);
    border: none;
    cursor: pointer;
}

.header-actions--single { width: 100%; }
.btn-add-socio--full { width: 100%; justify-content: center; }

/* Desktop: botón tamaño normal alineado a la derecha */
@media (min-width: 992px) {
    .header-actions--single { width: auto; }
    .btn-add-socio--full { width: auto; padding: var(--space-3) var(--space-6); }
}

.btn-add-socio:hover {
    background: var(--success-green-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    color: white;
    text-decoration: none;
}

.btn-add-socio:active {
    transform: translateY(0);
    box-shadow: var(--shadow-md);
}

/* Breadcrumb */
.breadcrumb-section {
    padding-top: var(--space-4);
    border-top: 1px solid var(--gray-200);
}

.breadcrumb {
    display: flex !important;
    align-items: center;
    gap: var(--space-1);
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
    flex-wrap: nowrap !important;
    background: transparent !important;
    border-radius: 0 !important;
    font-size: var(--font-size-sm);
    white-space: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    max-width: 100%;
    box-sizing: border-box;
}

.breadcrumb-item {
    color: var(--gray-500);
    text-decoration: none;
    font-size: var(--font-size-sm);
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-1);
    border-radius: 4px;
    transition: all var(--transition-normal);
    white-space: nowrap;
    flex-shrink: 0;
}

.breadcrumb-item:hover {
    color: var(--primary-blue);
    background: rgba(37, 99, 235, 0.1);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--gray-700);
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--gray-400);
    font-size: var(--font-size-sm);
    white-space: nowrap;
    flex-shrink: 0;
}

/* Filters Section */
.filters-section {
    margin-bottom: var(--space-6);
}

.filter-card {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.filter-header {
    margin-bottom: var(--space-4);
}

.filter-title {
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.filter-title i {
    color: var(--primary-blue);
}

.filter-content {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.export-actions {
    display: flex;
    gap: var(--space-3);
}

.btn-export {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius-lg);
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    transition: all var(--transition-normal);
}

.btn-export-excel {
    background: #198754;
}
.btn-export-excel:hover { background: #157347; }

.btn-export-pdf { background: #dc3545; }
.btn-export-pdf:hover { background: #bb2d3b; }

.filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-4);
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.filter-label {
    font-weight: 500;
    color: var(--gray-700);
    font-size: var(--font-size-sm);
}

.select-wrapper {
    position: relative;
}

.modern-select {
    width: 100%;
    padding: var(--space-3) var(--space-4);
    padding-right: var(--space-10);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius-lg);
    background: white;
    font-size: var(--font-size-base);
    color: var(--gray-900);
    transition: all var(--transition-normal);
    appearance: none;
    cursor: pointer;
}

.modern-select:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.modern-select:hover {
    border-color: var(--gray-300);
}

.select-icon {
    position: absolute;
    right: var(--space-3);
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    pointer-events: none;
    font-size: var(--font-size-sm);
}

/* Content Section */
.content-section {
    background: white;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .modern-index-container {
        padding: var(--space-4);
    }
    
    .header-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .modern-index-container {
        padding: var(--space-4);
    }
    
    .header-section {
        padding: var(--space-6);
    }
    
    .page-title {
        font-size: var(--font-size-3xl);
    }
    
    .filter-card {
        padding: var(--space-4);
    }
    
    /* Breadcrumb más compacto en móvil */
    .breadcrumb {
        gap: 4px;
        font-size: 12px;
    }
    
    .breadcrumb-item {
        padding: 2px 4px;
        font-size: 12px;
    }
    
    .breadcrumb-item i {
        font-size: 10px;
    }
    
    .breadcrumb-separator {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: var(--font-size-2xl);
    }
    
    .btn-add-socio {
        padding: var(--space-3) var(--space-4);
        font-size: var(--font-size-sm);
    }
    
    /* Mantener el texto visible también en móvil */
    .btn-add-socio span {
        display: inline;
    }
    
    .btn-add-socio i {
        margin: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Select2 for the vista select
    $('#vista').select2({
        placeholder: 'Selecciona un listado',
        allowClear: false,
        width: '100%'
    });
    
    // Handle change event
    $('#vista').on('change', function(e) {
        var data = $('#vista').select2('val');
        @this.set('vista', data);
        @this.emit('cambiarVista');
    });
});

// Reinitialize Select2 when Livewire updates
document.addEventListener('livewire:load', function() {
    window.livewire.hook('message.processed', () => {
        $('#vista').select2('destroy');
        $('#vista').select2({
            placeholder: 'Selecciona un listado',
            allowClear: false,
            width: '100%'
        });
    });
});
</script>
