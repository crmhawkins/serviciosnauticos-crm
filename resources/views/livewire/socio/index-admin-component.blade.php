<div class="modern-index-container">
    <style>
        .dataTables_wrapper .dataTables_filter>label { display: block; text-align: left; font-size: 1rem; }
        .dataTables_wrapper .dataTables_filter { width: 100%; margin-bottom: 1rem; }
        #datatable-buttons>tbody>tr.child>td>ul>li>span.dtr-title { font-weight: bold !important; }
    </style>

    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title"><i class="fas fa-users"></i> Socios</h1>
                <p class="page-subtitle">Listado general de socios y transeúntes</p>
            </div>
        </div>
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="javascript:void(0);" class="breadcrumb-item"><i class="fas fa-home"></i> Dashboard</a>
                <span class="breadcrumb-separator">/</span>
                <a href="javascript:void(0);" class="breadcrumb-item"><i class="fas fa-id-card"></i> Socios</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active"><i class="fas fa-list"></i> Todos los socios</span>
            </nav>
        </div>
    </div>

    <div class="content-section">
        <div class="form-card" style="margin-bottom:16px;">
            <div class="form-content">
                <div class="form-row" wire:ignore.self>
                    <div class="form-group" style="min-width:260px;">
                        <label for="vista" class="form-label">Listado a seleccionar</label>
                        <div x-init="$nextTick(() => {
                                $('#vista').select2();
                                $('#vista').on('change', function(e) {
                                    var data = $('#vista').select2('val');
                                    @this.set('vista', data);
                                    @this.emit('cambiarVista');
                                });
                            });" wire:key='{{ time() . 'juanito' }}'>
                            <select wire:model="vista" id="vista" class="form-input js-example-responsive w-100">
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
                        </div>
                    </div>
                    <div class="form-group d-none d-md-block" style="min-width:200px;">
                        <label for="pageSize" class="form-label">Barcos por página:</label>
                        <select id="pageSize" class="form-input">
                            <option value="35">35</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="p-2" style="display:flex; gap:12px;">
            <a href="{{ route('socios.export.excel') }}" class="export-btn export-btn--excel">
                <i class="fas fa-file-excel"></i>
                <span>Exportar Excel</span>
            </a>
            <a href="{{ route('socios.export.pdf') }}" class="export-btn export-btn--pdf">
                <i class="fas fa-file-pdf"></i>
                <span>Exportar PDF</span>
            </a>
        </div>

                    @switch($vista)
                        @case(1)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(2)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(3)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(4)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(5)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(6)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(7)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(8)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(9)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @case(10)
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break

                        @default
                            @livewire('socio.tabla-admin-component', ['vista' => $vista])
                        @break
                        @endswitch ($vista)
        </div>
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

    // Botones nativos de DataTables desactivados

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
    <!-- Buttons deshabilitados -->
    <!-- Responsive examples -->
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
@endsection

<style>
/* Botones de exportación unificados como en Socios */
.export-btn{ flex:1; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:10px 16px; border-radius:10px; font-weight:700; text-decoration:none; color:#fff; box-shadow:0 4px 10px rgba(0,0,0,.06); transition:all .2s ease; }
.export-btn--excel{ background:#198754; }
.export-btn--excel:hover{ background:#157347; color:#fff; text-decoration:none; }
.export-btn--pdf{ background:#dc3545; }
.export-btn--pdf:hover{ background:#bb2d3b; color:#fff; text-decoration:none; }

/* Título estandarizado como en Usuarios (con prioridad para evitar overrides) */
.page-title { font-size: 2.25rem !important; line-height: 2.5rem !important; font-weight: 700 !important; color: #111827 !important; margin: 0 0 8px 0 !important; display: flex !important; align-items: center !important; gap: 12px !important; }
.page-title i { color: #2563eb !important; font-size: 1.875rem !important; }

@media (max-width: 768px) {
  .page-title { font-size: 1.5rem !important; line-height: 1.75rem !important; }
  .page-title i { font-size: 1.25rem !important; }
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
