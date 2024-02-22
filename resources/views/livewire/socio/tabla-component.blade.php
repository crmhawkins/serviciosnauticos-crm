<div>
    <style>
        ul.pagination {
        justify-content: space-evenly;
        }
    </style>
    @if (count($socios) > 0)
        @mobile
        <div class="col-md-12 p-0">
        @elsemobile
        <div class="col-md-12">
        @endmobile
            <div class="p-0" x-data=''
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
                    "paginate": { "first": "Primero" , "last": "Ultimo" , "next": ">" , "previous": "<"},
                    "zeroRecords" : "No se encontraron registros coincidentes",
                },
                order: [[0, "desc" ]],
            });

        table.buttons().container().appendTo("#datatable-buttons_wrapper.col-md-12:eq(0)");

        });'>   @mobile
                <table id="datatable-buttons" class="table p-0 table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                @elsemobile
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                @endmobile
                    <thead>
                        <tr>
                            @mobile
                            <th scope="col">Pant y Matrícula</th>
                            @elsemobile
                            <th scope="col">Foto</th>
                            <th scope="col">Pantalán y Atraque</th>
                            <th scope="col">Matrícula</th>
                            @endmobile
                            <th scope="col">Nombre del Barco @mobile<br>@endmobile</th>
                            <th scope="col">Nombre del Socio  @mobile <br>@endmobile</th>
                            <th scope="col">Teléfono @mobile<br>@endmobile</th>
                            <th scope="col">Situación de persona @mobile <br>@endmobile</th>
                            <th scope="col">Acciones @mobile<br>@endmobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr>
                                @notmobile
                                <td>
                                    @if($socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}"
                                    style="max-width: 50px !important; text-align: center">
                                    @endif

                                </td>
                                <td>{{ $socio->pantalan_t_atraque }}</td>
                                <td>{{ $socio->matricula }}</td>
                                @endnotmobile
                                @mobile

                                <th scope="col">
                                    @if($socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}"
                                    style="max-width: 50px !important; text-align: center">
                                @endif
                                    {{ $socio->pantalan_t_atraque }} - {{ $socio->matricula }}
                                </th>
                                @endmobile
                                <td>{{ $socio->nombre_barco }}</td>
                                <td>{{ $socio->nombre_socio }}</td>
                                <td>
                                    @if($socio->telefonos->first())
                                    {{ $socio->telefonos->first()->telefono }}
                                    @endif
                                </td>
                                <td>
                                    @if ($socio->situacion_persona == 0)
                                        Socio
                                    @else
                                        Transeúnte
                                    @endif
                                </td>
                                @mobile
                                <td> @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> @else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a> @endif
                                    @if(!empty($socio->telefonos->first()->telefono))<br> <a href="tel:{{ $socio->telefonos->first()->telefono }}" class="btn btn-info mt-2">Llamar</a> <br>@endif

                                    @if( $socio->telefonos()->where('telefono', 'like', '6%')->first())
                                    <a href="https://wa.me/{{ $socio->telefonos()->where('telefono', 'like', '6%')->first()->telefono }}" class="btn btn-success mt-2">Whatsapp</a> <br>
                                    @elseif( $socio->telefonos()->where('telefono', 'like', '7%')->first())
                                    <a href="https://wa.me/{{ $socio->telefonos()->where('telefono', 'like', '7%')->first()->telefono }}" class="btn btn-success mt-2">Whatsapp</a><br>
                                    @endif
                                </td>
                                @elsemobile
                                <td>
                                    @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> @else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a> @endif

                                </td>
                                @endmobile
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
