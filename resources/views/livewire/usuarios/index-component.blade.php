<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-users"></i>
                    Usuarios
                </h1>
                <p class="page-subtitle">Gestiona los usuarios del sistema</p>
            </div>
            <div class="header-actions header-actions--single">
                <a href="usuarios-create" class="btn-add-socio btn-add-socio--full">
                    <i class="fas fa-user-plus"></i>
                    <span>Nuevo usuario</span>
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
                    <i class="fas fa-users"></i>
                    Usuarios
                </span>
            </nav>
        </div>
    </div>

    <div class="content-section p-0">
        <div class="p-4">
            @if (count($usuarios) > 0)
                <div class="mb-3" style="display:flex; gap:12px;">
                    <a href="{{ route('usuarios.export.excel') }}" class="export-btn export-btn--excel">
                        <i class="fas fa-file-excel"></i>
                        <span>Exportar Excel</span>
                    </a>
                    <a href="{{ route('usuarios.export.pdf') }}" class="export-btn export-btn--pdf">
                        <i class="fas fa-file-pdf"></i>
                        <span>Exportar PDF</span>
                    </a>
                </div>
                <!-- Vista de escritorio: tabla -->
                <div class="search-control" style="max-width:480px; margin-bottom:12px;">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input id="usuariosSearchInput" type="search" class="search-input" placeholder="Buscar usuarios...">
                    </div>
                </div>
                <div class="desktop-view">
                    <table id="usuariosTable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Alias</th>
                                <th scope="col">Username</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $this->getRole($user->role) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="usuarios-edit/{{ $user->id }}" class="btn btn-primary">Ver/Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Vista móvil: cards -->
                <div class="mobile-view">
            <div class="cards-container">
                @foreach ($usuarios as $user)
                    <div class="usuario-card socio-card" data-search="{{ \Illuminate\Support\Str::slug(($user->name.' '.$user->username.' '.$this->getRole($user->role).' '.$user->email), ' ') }}">
                                <div class="card-header">
                                    <div class="socio-info">
                                        <div class="socio-photo-section">
                                            <div class="photo-wrapper" style="width:64px;height:64px;">
                                                <div class="photo-placeholder">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="socio-details">
                                            <h3 class="socio-name">{{ $user->name }}</h3>
                                            <p class="barco-name">{{ $user->username }}</p>
                                            <div class="socio-meta">
                                                <span class="role-info">
                                                    <i class="fas fa-user-tag"></i>
                                                    {{ $this->getRole($user->role) }}
                                                </span>
                                                <span class="email-info">
                                                    <i class="fas fa-envelope"></i>
                                                    {{ $user->email }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <a href="usuarios-edit/{{ $user->id }}" class="btn-card btn-edit">
                                        <i class="fas fa-edit"></i>
                                        <span>Ver/Editar</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h6 class="text-center m-4">No se encuentran usuarios disponibles</h6>
            @endif
        </div>
    </div>
</div>


@section('scripts')
    <script src="../assets/js/jquery.slimscroll.js"></script>

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
    
    <!-- Responsive examples -->
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script>
        function getUsuariosDT(){
            if (!$('#usuariosTable').length) return null;
            if ($.fn.DataTable.isDataTable('#usuariosTable')) {
                return $('#usuariosTable').DataTable();
            }
            return $('#usuariosTable').DataTable({
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

        function bindUsuariosSearchAndTable(){
            // Inicializa/recicla DataTable solo si la tabla está en DOM
            var usuariosTable = getUsuariosDT();

            const doFilterUsuarios = function(){
                var q = ($('#usuariosSearchInput').val() ?? '').toString();
                // Si hay tabla visible (desktop), usar DataTables
                if ($('#usuariosTable').is(':visible') && usuariosTable) {
                    usuariosTable.search(q).draw();
                    return;
                }
                // En móvil: filtrar cards
                const norm = (s) => (s||'')
                    .toString()
                    .toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
                    .replace(/[-_]+/g,' ')
                    .replace(/\s+/g,' ')
                    .trim();
                const query = norm(q);
                let shown = 0, total = 0;
                document.querySelectorAll('.mobile-view .usuario-card').forEach(function(card){
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
                console.log('[usuarios] filter=', q, 'normalized=', query, 'cards shown/total=', shown, '/', total);
            };

            // Desacoplar handlers anteriores para evitar múltiples bindings tras Livewire
            // Modo robusto: delegación a nivel de documento (sobrevive a Livewire)
            document.removeEventListener('input', window.__usuariosInputHandler || (()=>{}));
            window.__usuariosInputHandler = function(e){
                if (e.target && e.target.id === 'usuariosSearchInput') doFilterUsuarios.call(e.target);
            };
            document.addEventListener('input', window.__usuariosInputHandler);

            document.removeEventListener('keydown', window.__usuariosKeyHandler || (()=>{}));
            window.__usuariosKeyHandler = function(e){
                if (e.target && e.target.id === 'usuariosSearchInput' && e.key === 'Enter') { e.preventDefault(); doFilterUsuarios.call(e.target); }
            };
            document.addEventListener('keydown', window.__usuariosKeyHandler);

            document.removeEventListener('keyup', window.__usuariosKeyupHandler || (()=>{}));
            window.__usuariosKeyupHandler = function(e){
                if (e.target && e.target.id === 'usuariosSearchInput') doFilterUsuarios.call(e.target);
            };
            document.addEventListener('keyup', window.__usuariosKeyupHandler);

            doFilterUsuarios();
        }

        $(document).ready(function(){ bindUsuariosSearchAndTable(); });
        document.addEventListener('livewire:load', function(){
            window.livewire.hook('message.processed', function(){
                bindUsuariosSearchAndTable();
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

    <style>
    /* Por defecto: solo tabla en escritorio */
    .desktop-view { display: block; }
    .mobile-view { display: none; }
    /* Estilo del botón como en Nuevo club/Nuevo socio */
    .btn-add-socio {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #22c55e; /* success green */
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
    @media (min-width: 992px) {
        .header-actions--single { width: auto; }
        .btn-add-socio--full { width: auto; }
    }

    /* Alineación responsive del header como en Socios/Clubes */
    @media (max-width: 1024px) {
        .header-content { flex-direction: column; align-items: stretch; gap: var(--space-4); }
        .header-actions--single { width: 100%; }
        .btn-add-socio--full { width: 100%; }
    }

    @media (max-width: 768px) {
        .desktop-view { display: none !important; }
        .mobile-view { display: block !important; }
        .cards-container { display: flex; flex-direction: column; gap: 16px; }
        .usuario-card { 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -1px rgba(0,0,0,.06); 
            border: 1px solid #e5e7eb; 
            overflow: hidden; 
            display: flex !important;
            flex-direction: column !important;
        }
        .usuario-card.is-hidden { display: none !important; }
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
        .photo-placeholder { 
            width: 100%; 
            height: 100%; 
            background: #f3f4f6; 
            border: 2px solid #e5e7eb; 
            border-radius: 10px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #9ca3af; 
            font-size: 1.5rem; 
        }
        .socio-details { flex: 1; min-width: 0; }
        .socio-name { font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0 0 4px 0; }
        .barco-name { font-size: .95rem; color: #6b7280; margin: 0 0 8px 0; }
        .socio-meta { display: flex; flex-direction: column; gap: 4px; }
        .role-info, .email-info { 
            display: flex; 
            align-items: center; 
            gap: 6px; 
            font-size: 0.875rem; 
            color: #6b7280; 
        }
        .role-info i, .email-info i { color: #2563eb; width: 12px; }
    }
    </style>
@endsection
