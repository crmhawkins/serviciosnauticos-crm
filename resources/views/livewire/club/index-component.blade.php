<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-building"></i>
                    Clubes
                </h1>
                <p class="page-subtitle">Gestiona los clubes dados de alta en el sistema</p>
            </div>
            <div class="header-actions header-actions--single">
                <a href="club-create" class="btn-add-socio btn-add-socio--full">
                    <i class="fas fa-plus"></i>
                    <span>Nuevo club</span>
                </a>
            </div>
        </div>
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-building"></i>
                    Clubes
                </span>
            </nav>
        </div>
    </div>

    <div class="content-section p-0">
        <div class="p-4">
            <div class="mb-3" style="display:flex; gap:12px;">
                <a href="{{ route('club.export.excel') }}" class="export-btn export-btn--excel">
                    <i class="fas fa-file-excel"></i>
                    <span>Exportar Excel</span>
                </a>
                <a href="{{ route('club.export.pdf') }}" class="export-btn export-btn--pdf">
                    <i class="fas fa-file-pdf"></i>
                    <span>Exportar PDF</span>
                </a>
            </div>
            <div class="search-control" style="max-width:480px; margin-bottom:12px;">
                <div class="search-input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input id="clubsSearchInput" type="search" class="search-input" placeholder="Buscar clubes...">
                </div>
            </div>
            @if (count($clubes) > 0)
                <!-- Vista de escritorio: tabla -->
                <div class="desktop-view">
                    <table id="clubsTable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Nombre del club</th>
                                <th scope="col">Email del club</th>
                                <th scope="col">Editar club</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clubes as $club)
                                <tr>
                                    <td width="12%">
                                        @php
                                            $logo = $club->club_logo ? asset('assets/images/' . $club->club_logo) : asset('assets/images/club-placeholder.svg');
                                        @endphp
                                        <img src="{{ $logo }}" width="90%" onerror="this.onerror=null;this.src='{{ asset('assets/images/club-placeholder.svg') }}';">
                                    </td>
                                    <td width="40%"><h4 class="m-0">{{ $club->nombre }}</h4></td>
                                    <td width="38%">{{ $club->email }}</td>
                                    <td width="10%">
                                        @can('update', $club)
                                            <a href="club-edit/{{ $club->id }}" class="btn btn-primary">Ver/Editar</a>
                                        @else
                                            <a href="club-edit/{{ $club->id }}" class="btn btn-secondary">Ver</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Vista móvil: cards -->
                <div class="mobile-view">
                    <div class="cards-container">
                        @foreach ($clubes as $club)
                            <div class="club-card socio-card" data-search="{{ \Illuminate\Support\Str::slug(($club->nombre.' '.($club->email ?? '')), ' ') }}">
                                <div class="card-header">
                                    <div class="socio-info">
                                        <div class="socio-photo-section">
                                            <div class="photo-wrapper" style="width:64px;height:64px;">
                                                @php
                                                    $logo = $club->club_logo ? asset('assets/images/' . $club->club_logo) : asset('assets/images/club-placeholder.svg');
                                                @endphp
                                                <img src="{{ $logo }}" class="socio-photo" alt="Logo {{ $club->nombre }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/club-placeholder.svg') }}';">
                                            </div>
                                        </div>
                                        <div class="socio-details">
                                            <h3 class="socio-name">{{ $club->nombre }}</h3>
                                            <p class="barco-name">{{ $club->email ?: 'Sin email' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    @can('update', $club)
                                        <a href="club-edit/{{ $club->id }}" class="btn-card btn-edit">
                                            <i class="fas fa-edit"></i>
                                            <span>Ver/Editar</span>
                                        </a>
                                    @else
                                        <a href="club-edit/{{ $club->id }}" class="btn-card" style="background:#6b7280;color:#fff">
                                            <i class="fas fa-eye"></i>
                                            <span>Ver</span>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h6 class="text-center m-4">No se encuentran clubes disponibles</h6>
            @endif
        </div>
    </div>
</div>

<style>
/* Botón "Nuevo club" igual que "Nuevo socio" */
.btn-add-socio {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #22c55e; /* success-green */
    color: #fff;
    text-decoration: none;
    padding: 10px 24px;
    border-radius: 12px;
    font-weight: 600;
    transition: all .2s ease;
    box-shadow: 0 4px 12px rgba(34,197,94,.25);
    border: none;
}
.btn-add-socio:hover { background: #16a34a; color: #fff; }
.header-actions--single { width: 100%; }
.btn-add-socio--full { width: 100%; justify-content: center; }

/* Título estandarizado como en Usuarios */
.page-title { font-size: 2.25rem; font-weight: 700; color: #111827; margin: 0 0 8px 0; display: flex; align-items: center; gap: 12px; }
.page-title i { color: #2563eb; font-size: 1.875rem; }

@media (min-width: 992px) {
    .header-actions--single { width: auto; }
    .btn-add-socio--full { width: auto; }
}

/* Responsive: que el botón baje a su propia línea como en Socios */
@media (max-width: 1024px) {
    .header-content { flex-direction: column; align-items: stretch; gap: 16px; }
    .header-actions--single { width: 100%; }
    .btn-add-socio--full { width: 100%; }
}

@media (max-width: 768px) {
    .page-title { font-size: 1.5rem; }
    .page-title i { font-size: 1.25rem; }
    .desktop-view { display: none !important; }
    .mobile-view { display: block !important; }
    .cards-container { display: flex; flex-direction: column; gap: 16px; }
    .club-card { 
        background: #fff; 
        border-radius: 12px; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -1px rgba(0,0,0,.06); 
        border: 1px solid #e5e7eb; 
        overflow: hidden; 
        display: flex !important;
        flex-direction: column !important;
    }
    .club-card.is-hidden { display: none !important; }
    .card-header { 
        padding: 16px; 
        border-bottom: 1px solid #e5e7eb; 
        background: #fff; 
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
    }
    .card-actions { 
        padding: 16px; 
        background: #fff; 
        border-top: 1px solid #e5e7eb; 
        display: block !important;
        width: 100% !important;
    }
    .btn-card { 
        display: flex !important; 
        align-items: center; 
        justify-content: center; 
        gap: 8px; 
        width: 100% !important; 
        padding: 12px 16px; 
        border-radius: 10px; 
        font-weight: 600; 
        text-decoration: none; 
        background: #2563eb; 
        color: #fff; 
    }
    .btn-card:hover { background: #1d4ed8; color: #fff; text-decoration: none; }

    /* Alinear contenido como en Socios */
    .socio-info { display: flex; gap: 12px; flex: 1; align-items: center; }
    .socio-photo-section { flex-shrink: 0; }
    .photo-wrapper { width: 56px; height: 56px; }
    .socio-photo { width: 100%; height: 100%; object-fit: contain; border-radius: 10px; border: 2px solid #e5e7eb; background: #fff; }
    .socio-details { flex: 1; min-width: 0; }
    .socio-name { font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0 0 4px 0; }
    .barco-name { font-size: .95rem; color: #6b7280; margin: 0; }
}

/* Export buttons unified */
.search-input-wrapper{ position:relative; }
.search-input{ width:100%; padding:10px 14px 10px 36px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; }
.search-input:focus{ outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,0.1); }
.search-icon{ position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:12px; }
/* Botones de exportación unificados como en Socios */
.export-btn{ flex:1; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:10px 16px; border-radius:10px; font-weight:700; text-decoration:none; color:#fff; box-shadow:0 4px 10px rgba(0,0,0,.06); transition:all .2s ease; }
.export-btn--excel{ background:#198754; }
.export-btn--excel:hover{ background:#157347; color:#fff; }
.export-btn--pdf{ background:#dc3545; }
.export-btn--pdf:hover{ background:#bb2d3b; color:#fff; }
</style>


@section('scripts')
    {{-- <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('entro');
            $('#tablePresupuestos').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [{
                            extend: 'pdf',
                            className: 'btn-export'
                        },
                        {
                            extend: 'excel',
                            className: 'btn-export'
                        }
                    ],
                    className: 'btn btn-info text-white'
                }],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Mostrando página _PAGE_ of _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ total registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "zeroRecords": "No se encontraron registros coincidentes",
                }
            });

            addEventListener("resize", (event) => {
                location.reload();
            })
        });
    </script> --}}
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
    <script>
        function getClubsDT(){
            if (!$('#clubsTable').length) return null;
            if ($.fn.DataTable.isDataTable('#clubsTable')) return $('#clubsTable').DataTable();
            return $('#clubsTable').DataTable({
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
                    paginate: { first: 'Primero', last: 'Ultimo', next: 'Siguiente', previous: 'Anterior' }
                        }
            });
        }

        function bindClubsSearchAndTable(){
            var clubsTable = getClubsDT();

            const norm = (s) => (s||'')
                .toString()
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
                .replace(/[-_]+/g,' ')
                .replace(/\s+/g,' ')
                .trim();
            const doFilterClubs = function(){
                var q = ($('#clubsSearchInput').val() ?? '').toString();
                const query = norm(q);
                // Siempre sincronizamos ambos: tabla (si existe) y cards
                if (clubsTable) { clubsTable.search(q).draw(); }
                let shown = 0, total = 0;
                document.querySelectorAll('.mobile-view .club-card').forEach(function(card){
                    total++;
                    const data = card.getAttribute('data-search') || '';
                    const haystack = norm((data + ' ' + card.textContent) || '');
                    const match = !query || haystack.includes(query);
                    if (match) {
                        card.classList.remove('is-hidden');
                        card.style.display = '';
                    } else {
                        card.classList.add('is-hidden');
                        card.style.display = 'none';
                    }
                    if (match) shown++;
                });
                console.log('[clubs] filter=', q, 'normalized=', query, 'cards shown/total=', shown, '/', total);
            };

            document.removeEventListener('input', window.__clubsInputHandler || (()=>{}));
            window.__clubsInputHandler = function(e){
                if (e.target && e.target.id === 'clubsSearchInput') doFilterClubs.call(e.target);
            };
            document.addEventListener('input', window.__clubsInputHandler);

            document.removeEventListener('keydown', window.__clubsKeyHandler || (()=>{}));
            window.__clubsKeyHandler = function(e){
                if (e.target && e.target.id === 'clubsSearchInput' && e.key === 'Enter') { e.preventDefault(); doFilterClubs.call(e.target); }
            };
            document.addEventListener('keydown', window.__clubsKeyHandler);

            // Fallback por si input no dispara 'input' en algunos navegadores
            document.removeEventListener('keyup', window.__clubsKeyupHandler || (()=>{}));
            window.__clubsKeyupHandler = function(e){
                if (e.target && e.target.id === 'clubsSearchInput') doFilterClubs.call(e.target);
            };
            document.addEventListener('keyup', window.__clubsKeyupHandler);

            // Aplicar valor actual si ya hay texto
            doFilterClubs();
        }

        $(document).ready(function(){ bindClubsSearchAndTable(); });
        document.addEventListener('livewire:load', function(){
            window.livewire.hook('message.processed', function(){
                bindClubsSearchAndTable();
            });
        });
    </script>
    <style>
        .search-input-wrapper{ position:relative; }
        .search-input{ width:100%; padding:10px 14px 10px 36px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; }
        .search-input:focus{ outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,0.1); }
        .search-icon{ position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:12px; }
        /* Botones de exportación unificados como en Socios */
        .export-btn{ flex:1; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:10px 16px; border-radius:10px; font-weight:700; text-decoration:none; color:#fff; box-shadow:0 4px 10px rgba(0,0,0,.06); transition:all .2s ease; }
        .export-btn--excel{ background:#198754; }
        .export-btn--excel:hover{ background:#157347; color:#fff; }
        .export-btn--pdf{ background:#dc3545; }
        .export-btn--pdf:hover{ background:#bb2d3b; color:#fff; }
    </style>
@endsection
