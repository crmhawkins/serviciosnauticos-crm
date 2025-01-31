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
            <div class="p-0">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pageSize" class="form-label">Barcos por página:</label>
                        <select id="pageSize" class="form-select">
                            <option value="35">35</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                @mobile
                <table id="datatable-buttons" class="table p-0 table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;" wire:ignore>
                @elsemobile
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;" wire:ignore>
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
                                    loading="lazy" style="max-width: 50px !important; text-align: center">
                                    @endif
                                </td>
                                <td>{{ $socio->pantalan_t_atraque }}</td>
                                <td>{{ $socio->matricula }}</td>
                                @endnotmobile
                                @mobile
                                <th scope="col">
                                    @if($socio->ruta_foto)
                                    <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}"
                                    loading="lazy" style="max-width: 50px !important; text-align: center">
                                    @endif
                                    @switch($socio->club_id)
                                    @case(1)
                                        SL
                                        @break
                                    @case(2)
                                        RS
                                        @break
                                    @case(3)
                                        PR
                                        @break
                                    @case(4)
                                        MR
                                        @break
                                    @case(5)
                                        RL
                                        @break
                                    @default
                                @endswitch
                                -{{ $socio->pantalan_t_atraque }}-{{ $socio->matricula }}</th>
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
                                    @elseif ($socio->situacion_persona == 1)
                                        Transeúnte
                                    @else
                                        Socio/Transeúnte
                                    @endif
                                </td>
                                @mobile
                                <td> @if($socio->alta_baja == 0) <a href="socios-edit/{{ $socio->id }}" class="btn btn-primary">Ver/Editar</a> <br>@else <a href="socios-alta/{{ $socio->id }}" class="btn btn-primary">Dar de alta</a><br> @endif
                                    @if($socio->telefonos->isNotEmpty())
                                    @foreach($socio->telefonos as $telefono)
                                        @if(!empty($telefono->telefono))
                                            <a href="tel:{{ str_replace(" ","",$telefono->telefono) }}" class="btn btn-info mt-2">Llamar a {{ $telefono->telefono }}</a>
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                                @foreach($socio->telefonos as $telefono)
                                @if(Str::startsWith($telefono->telefono, ['6', '7']))
                                    <a href="https://wa.me/+34{{ str_replace(" ","",$telefono->telefono) }}" class="btn btn-success mt-2">WhatsApp a {{ ($telefono->telefono) }}</a><br>
                                @endif
                            @endforeach
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

