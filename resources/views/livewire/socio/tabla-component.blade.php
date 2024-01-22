<div>
    @if (count($socios) > 0)
        <div class="col-md-12">
            <div x-data=''
                x-init='$nextTick(() => {
            var table = $("#datatable-buttons").DataTable({
                lengthChange: false,
                dom: "Bfrtip",
                buttons: [
                    "copy", "csv", "excel", "pdf",
                ],
                "language": { "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords" : "Nothing found - sorry", "info" : "Mostrando página _PAGE_ of _PAGES_" ,
                    "infoEmpty": "No hay registros disponibles" ,
                    "infoFiltered": "(filtrado de _MAX_ total registros)" ,
                    "search": "Buscar:" ,
                    "paginate": { "first": "Primero" , "last": "Ultimo" , "next": "Siguiente" , "previous": "Anterior"},
                    "zeroRecords" : "No se encontraron registros coincidentes",
                },
                order: [[1, "desc" ]],
            });

        table.buttons().container().appendTo("#datatable-buttons_wrapper.col-md-12:eq(0)");

        });'>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Pantalán y Atraque</th>
                            <th scope="col">Matrícula @mobile<br>@endmobile</th>
                            <th scope="col">Nombre del Barco @mobile<br>@endmobile</th>
                            <th scope="col">Nombre del Socio @mobile<br>@endmobile</th>
                            <th scope="col">Teléfono @mobile<br>@endmobile</th>
                            <th scope="col">Situación de persona @mobile<br>@endmobile</th>
                            <th scope="col">Acciones @mobile<br>@endmobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr>
                                <td>{{ $socio->pantalan_t_atraque }}</td>
                                <td>{{ $socio->matricula }}</td>
                                <td>{{ $socio->nombre_barco }}</td>
                                <td>{{ $socio->nombre_socio }}</td>
                                <td>
                                    @if($socio->telefonos->first())
                                    {{ $socio->telefonos->first()->telefono }}
                                    @else
                                    Sin telefono definido
                                    @endif
                                </td>
                                <td>
                                    @if ($socio->situacion_persona == 0)
                                        Socio
                                    @else
                                        Transeúnte
                                    @endif
                                </td>
                                <td> @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> @else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a> @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h6 class="text-center">No se encuentran socios disponibles</h6>
    @endif

</div>
