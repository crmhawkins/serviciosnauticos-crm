@mobile
<div class="container-fluid p-1 ">
@elsemobile
<div class="container-fluid ">
@endmobile

    <style>
        .dataTables_wrapper .dataTables_filter>label {
            display: block;
            text-align: left;
            font-size: 1rem;
        }

        .dataTables_wrapper .dataTables_filter {
            width: 100%;
            margin-bottom: 1rem;
        }

        #datatable-buttons>tbody>tr.child>td>ul>li>span.dtr-title {
            font-weight: bold !important;
        }
    </style>
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">SOCIOS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Socios</a></li>
                    <li class="breadcrumb-item active">Todos los socios</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->
    @mobile
    <div class="row p-0">
        <div class="col-12 p-0">
            <div class="card m-b-30 p-0">
                <div class="card-body row p-1 m-0">
    @elsemobile
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body row">
    @endmobile
                    <div class="col-md-12 mb-3" wire:ignore.self>
                        <div x-init="$nextTick(() => {
                            $('#vista').select2();
                            $('#vista').on('change', function(e) {
                                var data = $('#vista').select2('val');
                                @this.set('vista', data);
                                @this.emit('cambiarVista');
                                console.log(data);
                            });
                        });" wire:key='{{ time() . 'juanito' }}'>
                            <label for="vista">Listado a seleccionar</label>
                            <select wire:model="vista" id="vista" class="form-control w-100 MB">
                                <option value="0">Todos en alta</option>
                                <option value="1">Socios en alta</option>
                                <option value="2">Socios en atraque</option>
                                <option value="3">Socios en varada</option>
                                <option value="4">Socios en baja</option>
                                <option value="5">Transeúntes en alta</option>
                                <option value="6">Transeúntes en atraque</option>
                                <option value="7">Transeúntes en varada</option>
                                <option value="8">Transeúntes en baja</option>
                                <option value="9">Socio/Transeúntes en alta</option>
                            </select>
                        </div>
                    </div>

                    @switch($vista)
                        @case(0)
                            @livewire('socio.tabla-component', ['vista' => $vista])
                        @break

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

                            @default
                        @endswitch ($vista)

                    <a href="socios-create" class="btn btn-lg btn-primary">Añadir socio al club</a>

                </div>
            </div>
        </div>
    </div>
</div>


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
@endsection
