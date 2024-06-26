<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">VOLVER A DAR DE ALTA SOCIO {{ $numero_socio }}</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Socio</a></li>
                    <li class="breadcrumb-item active">Volver a dar de alta socio</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <style>
        th,
        td {
            border: 1px solid black !important;
            padding: 5px 5px 5px 5px !important;
        }
    </style>
    <!-- end page-title -->
    <div class="row">
        <div class="col-md-9">
            <div class="card m-b-30">
                <div class="card-body">
                    @if ($puede_editar == true)
                        @mobile
                            <table class="table table-bordered dt-responsive nowrap"
                                style="table-layout: fixed !important; width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th colspan="12">
                                            <h5 class="text-center" style="vertical-align: top !important;">Subir foto del
                                                barco
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="12">
                                            @if (isset($ruta_foto))
                                                @if (!is_string($ruta_foto))
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ $ruta_foto->temporaryUrl() }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ asset('storage/photos/' . $ruta_foto) }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="mb-3 row d-flex align-items-center">
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" wire:model="ruta_foto"
                                                        name="ruta_foto" id="ruta_foto"
                                                        placeholder="Imagen del producto...">
                                                    @error('nombre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="12">
                                            <h5 class="text-center" style="vertical-align: top !important;">Subir foto del
                                                socio
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="12">
                                            @if (isset($ruta_foto2))
                                                @if (!is_string($ruta_foto2))
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ $ruta_foto2->temporaryUrl() }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ asset('storage/photos/' . $ruta_foto2) }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="mb-3 row d-flex align-items-center">
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" wire:model="ruta_foto2"
                                                        name="ruta_foto2" id="ruta_foto2"
                                                        placeholder="Imagen del producto...">
                                                    @error('nombre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6"
                                            @if ($situacion_barco == 0) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Barco en atraque</h6>
                                        </td>
                                        <td colspan="6"
                                            @if ($situacion_barco == 1) style="background-color: #dc3545 !important" @endif>
                                            <h6 style="text-align: center !important">Barco en varada</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"
                                            @if ($situacion_persona == 0) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Socio</h6>
                                        </td>
                                        <td colspan="6"
                                            @if ($situacion_persona == 1) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Transeúnte</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Nombre:</th>
                                        <td colspan="8"><input type="text" wire:model="nombre_socio"
                                                class="form-control" name="nombre_socio" placeholder="Nombre"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Nº de socio</th>
                                        <td colspan="8"><input type="number" wire:model="numero_socio"
                                                class="form-control" name="numero_socio" placeholder="Número de socio">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">PIN de socio</th>
                                        <td colspan="8"><input type="number" wire:model="pin_socio" class="form-control"
                                                name="numero_socio" placeholder="Número de socio">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">DNI:</th>
                                        <td colspan="8"><input type="text" wire:model="dni" class="form-control"
                                                name="dni" placeholder="DNI"></td>
                                    </tr>

                                    <tr>
                                        <th colspan="4">Dirección:</th>
                                        <td colspan="8"><input type="text" wire:model="direccion"
                                                class="form-control" name="direccion" placeholder="Dirección"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="10" class="text-center py-3">Teléfonos</th>
                                        <th colspan="2" class="text-center py-3"><button type="button"
                                                class="btn btn-primary" wire:click="addTelefono">+</button></th>
                                    </tr>
                                    @foreach ($telefonos as $telefonoIndex => $telefono)
                                        <tr>
                                            <th colspan="3">Tlf. {{ $telefonoIndex + 1 }}:</th>
                                            <td colspan="7"><input type="text"
                                                    wire:model="telefonos.{{ $telefonoIndex }}.telefono"
                                                    class="form-control" name="telefonos[{{ $telefonoIndex }}][telefono]"
                                                    placeholder="Teléfono {{ $telefonoIndex + 1 }}"></td>
                                            <td colspan="2" class="text-center"><button type="button"
                                                    class="btn btn-danger"
                                                    wire:click="deleteTelefono({{ $telefonoIndex }})">X</button></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="4">Email:</th>
                                        <td colspan="8"><input type="text" wire:model="email" class="form-control"
                                                name="email" placeholder="Email"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Pantalán y Atraque:</th>
                                        <td colspan="8"><input type="text" wire:model="pantalan_t_atraque"
                                                class="form-control" name="pantalan_t_atraque"
                                                placeholder="Pantalán y Atraque">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" wire:click="cambiarSituacionPersona(0)"
                                            @if ($situacion_persona == 0) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Fijo</h6>
                                        </td>
                                        <td colspan="6" wire:click="cambiarSituacionPersona(1)"
                                            @if ($situacion_persona == 1) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Temporal</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Nombre del barco:</th>
                                        <td colspan="8"><input type="text" wire:model="nombre_barco"
                                                class="form-control" name="nombre_barco" placeholder="Nombre del barco">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Matrícula:</th>
                                        <td colspan="8"><input type="text" wire:model="matricula"
                                                class="form-control" name="matricula" placeholder="Matrícula"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Eslora:</th>
                                        <td colspan="8"><input type="text" wire:model="eslora"
                                                class="form-control" name="eslora" placeholder="Eslora"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Manga:</th>
                                        <td colspan="8"><input type="text" wire:model="manga" class="form-control"
                                                name="manga" placeholder="Manga"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Calado:</th>
                                        <td colspan="8"><input type="text" wire:model="calado"
                                                class="form-control" name="calado" placeholder="Calado"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="10" class="text-center py-3">Números de llave</th>
                                        <th colspan="2" class="text-center py-3"><button type="button"
                                                class="btn btn-primary" wire:click="addNumeroLlave">+</button></th>
                                    </tr>
                                    @foreach ($numeros_llave as $llaveIndex => $numero_llave)
                                        <tr>
                                            <th colspan="3">Llave {{ $llaveIndex + 1 }}:</th>
                                            <td colspan="7"><input type="text"
                                                    wire:model="numeros_llave.{{ $llaveIndex }}.llaveIndex"
                                                    class="form-control"
                                                    name="numeros_llave[{{ $llaveIndex }}][llaveIndex]"
                                                    placeholder="Nº de llave {{ $llaveIndex + 1 }}"></td>
                                            <td colspan="2" class="text-center"><button type="button"
                                                    class="btn btn-danger"
                                                    wire:click="deleteNumeroLlave({{ $telefonoIndex }})">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="4">Seguro barco:</th>
                                        <td colspan="8"><input type="text" wire:model="seguro_barco"
                                                class="form-control" name="seguro_barco" placeholder="Seguro barco"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Póliza:</th>
                                        <td colspan="8"><input type="text" wire:model="poliza"
                                                class="form-control" name="poliza" placeholder="Póliza"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Vencimiento:</th>
                                        <td colspan="8"><input type="date" wire:model="vencimiento"
                                                class="form-control" name="vencimiento" placeholder="Vencimiento"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">ITB:</th>
                                        <td colspan="8"><input type="date" wire:model="itb" class="form-control"
                                                name="itb" placeholder="ITB"></td>
                                    </tr>
                            </table>
                        @elsemobile
                            <table class="table table-bordered dt-responsive nowrap"
                                style="table-layout: fixed !important; width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th colspan="8">
                                            <h5 class="text-center" style="vertical-align: top !important;">Subir foto del
                                                barco
                                            </h5>
                                        </th>
                                        <th colspan="4">
                                            <h5 class="text-center" style="vertical-align: top !important;">Subir foto del
                                                socio
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" rowspan="4">
                                            @if (isset($ruta_foto))
                                                @if (!is_string($ruta_foto))
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ $ruta_foto->temporaryUrl() }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ asset('storage/photos/' . $ruta_foto) }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="mb-3 row d-flex align-items-center">
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" wire:model="ruta_foto"
                                                        name="ruta_foto" id="ruta_foto"
                                                        placeholder="Imagen del producto...">
                                                    @error('nombre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="4" rowspan="4">
                                            @if (isset($ruta_foto2))
                                                @if (!is_string($ruta_foto2))
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ $ruta_foto2->temporaryUrl() }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-3 row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ asset('storage/photos/' . $ruta_foto2) }}"
                                                                style="max-width: 50% !important; height: auto;">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="mb-3 row d-flex align-items-center">
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" wire:model="ruta_foto2"
                                                        name="ruta_foto2" id="ruta_foto2"
                                                        placeholder="Imagen del producto...">
                                                    @error('nombre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        style="border-top:1px solid black; border-left:2px solid white; border-right:2px solid white;">
                                        <td colspan="12">&nbsp;</td>
                                    </tr>

                                    <tr style="border:2px solid white;">
                                        <td colspan="12">&nbsp;</td>
                                    </tr>
                                    <tr
                                        style="border-bottom:1px solid black; border-left:2px solid white; border-right:2px solid white;">
                                        <td colspan="12">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="text-center">
                                            <h1>{{ $pantalan_t_atraque }} {{ $matricula }}</h1>
                                            <h1>{{ $nombre_barco }}</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"
                                            @if ($situacion_barco == 0) style="background-color: #3b996d !important" @endif>
                                            <h6 style="text-align: center !important">Barco en atraque</h6>
                                        </td>
                                        <td colspan="6"
                                            @if ($situacion_barco == 1) style="background-color: #dc3545 !important" @endif>
                                            <h6 style="text-align: center !important">Barco en varada</h6>
                                        </td>
                                    </tr>
                                    @if ($situacion_barco != $situacion_barco_old)
                                        @if ($situacion_barco == 0)
                                            <tr>
                                                <th colspan="4">Fecha de entrada:</th>
                                                <td colspan="8"><input type="date" wire:model="fecha_entrada"
                                                        class="form-control" name="fecha_entrada"
                                                        placeholder="Fecha de entrada"></td>
                                            </tr>
                                        @elseif($situacion_barco == 1)
                                            <tr>
                                                <th colspan="4">Fecha de salida:</th>
                                                <td colspan="8"><input type="date" wire:model="fecha_entrada"
                                                        class="form-control" name="fecha_entrada"
                                                        placeholder="Fecha de salida"></td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr>
                                        <th colspan="3">Nombre:</th>
                                        <td colspan="3"><input type="text" wire:model="nombre_socio"
                                                class="form-control" name="nombre_socio" placeholder="Nombre"></td>
                                        <th colspan="3">Nº de socio</th>
                                        <td colspan="3"><input type="number" wire:model="numero_socio"
                                                class="form-control" name="numero_socio" placeholder="Número de socio">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">PIN de socio</th>
                                        <td colspan="3"><input type="number" wire:model="pin_socio"
                                                class="form-control" name="pin_socio" placeholder="PIN de socio">
                                        </td>
                                        <th colspan="3">DNI:</th>
                                        <td colspan="3"><input type="text" wire:model="dni" class="form-control"
                                                name="dni" placeholder="DNI"></td>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Dirección:</th>
                                        <td colspan="9"><input type="text" wire:model="direccion"
                                                class="form-control" name="direccion" placeholder="Dirección"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="10" class="text-center py-3">Teléfonos</th>
                                        <th colspan="2" class="text-center"><button type="button"
                                                class="btn btn-primary" wire:click="addTelefono">+</button></th>
                                    </tr>
                                    @foreach ($telefonos as $telefonoIndex => $telefono)
                                        <tr>
                                            <th colspan="3">Teléfono {{ $telefonoIndex + 1 }}:</th>
                                            <td colspan="7"><input type="text"
                                                    wire:model="telefonos.{{ $telefonoIndex }}.telefono"
                                                    class="form-control" name="telefonos[{{ $telefonoIndex }}][telefono]"
                                                    placeholder="Teléfono {{ $telefonoIndex + 1 }}"></td>
                                            <td colspan="2" class="text-center"><button type="button"
                                                    class="btn btn-danger"
                                                    wire:click="deleteTelefono({{ $telefonoIndex }})">X</button></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3">Email:</th>
                                        <td colspan="9"><input type="text" wire:model="email" class="form-control"
                                                name="email" placeholder="Email"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Pantalán y Atraque:</th>
                                        <td colspan="9"><input type="text" wire:model="pantalan_t_atraque"
                                                class="form-control" name="pantalan_t_atraque"
                                                placeholder="Pantalán y Atraque">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Nombre del barco:</th>
                                        <td colspan="9"><input type="text" wire:model="nombre_barco"
                                                class="form-control" name="nombre_barco" placeholder="Nombre del barco">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Matrícula:</th>
                                        <td colspan="9"><input type="text" wire:model="matricula"
                                                class="form-control" name="matricula" placeholder="Matrícula"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Eslora:</th>
                                        <td colspan="3"><input type="text" wire:model="eslora"
                                                class="form-control" name="eslora" placeholder="Eslora"></td>
                                        <th colspan="3">Manga:</th>
                                        <td colspan="3"><input type="text" wire:model="manga" class="form-control"
                                                name="manga" placeholder="Manga"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Calado:</th>
                                        <td colspan="3"><input type="text" wire:model="calado"
                                                class="form-control" name="calado" placeholder="Calado"></td>
                                        <th colspan="3">Puntal:</th>
                                        <td colspan="3"><input type="text" wire:model="puntal"
                                                class="form-control" name="puntal" placeholder="Puntal"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="10" class="text-center py-3">Números de llave</th>
                                        <th colspan="2" class="text-center"><button type="button"
                                                class="btn btn-primary" wire:click="addNumeroLlave">+</button>
                                        </th>
                                    </tr>
                                    @foreach ($numeros_llave as $llaveIndex => $numero_llave)
                                        <tr>
                                            <th colspan="3">Nº de llave {{ $llaveIndex + 1 }}:</th>
                                            <td colspan="7"><input type="text"
                                                    wire:model="numeros_llave.{{ $llaveIndex }}.llaveIndex"
                                                    class="form-control"
                                                    name="numeros_llave[{{ $llaveIndex }}][llaveIndex]"
                                                    placeholder="Nº de llave {{ $llaveIndex + 1 }}"></td>
                                            <td colspan="2" class="text-center"><button type="button"
                                                    class="btn btn-danger"
                                                    wire:click="deleteNumeroLlave({{ $telefonoIndex }})">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3">Seguro barco:</th>
                                        <td colspan="3"><input type="text" wire:model="seguro_barco"
                                                class="form-control" name="seguro_barco" placeholder="Seguro barco">
                                        </td>
                                        <th colspan="3">Póliza:</th>
                                        <td colspan="3"><input type="text" wire:model="poliza"
                                                class="form-control" name="poliza" placeholder="Póliza"></td>

                                    </tr>
                                    <tr>
                                        <th colspan="3">Vencimiento:</th>
                                        <td colspan="3"><input type="date" wire:model="vencimiento"
                                                class="form-control" name="vencimiento" placeholder="Vencimiento">
                                        </td>
                                        <th colspan="3">ITB:</th>
                                        <td colspan="3"><input type="date" wire:model="itb" class="form-control"
                                                name="itb" placeholder="ITB"></td>
                                    </tr>
                            </table>
                        @endmobile

                        @if ($situacion_persona == 1)
                            <table class="table table-bordered dt-responsive nowrap"
                                style="table-layout: fixed !important; width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th colspan="12">
                                            <h4 style="text-align: center !important">Datos específicos de transeúnte
                                            </h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th colspan="10" class="text-center py-3">Tripulantes</th>
                                    <th colspan="2" class="text-center"><button type="button"
                                            class="btn btn-primary" wire:click="addTripulante">+</button></th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-center py-3">Nombre</th>
                                    <th colspan="5" class="text-center py-3">DNI</th>
                                    <th colspan="2" class="text-center py-3">Eliminar</th>
                                </tr>
                                @foreach ($tripulantes as $tripulanteIndex => $tripulante)
                                    <tr>
                                        <td colspan="5"><input type="text"
                                                wire:model="tripulantes.{{ $tripulanteIndex }}.nombre"
                                                class="form-control"
                                                name="tripulantes[{{ $tripulanteIndex }}][nombre]"
                                                placeholder="Nombre del tripulante {{ $tripulanteIndex + 1 }}"></td>
                                        <td colspan="5"><input type="text"
                                                wire:model="tripulantes.{{ $tripulanteIndex }}.dni"
                                                class="form-control" name="tripulantes[{{ $tripulanteIndex }}][dni]"
                                                placeholder="DNI del tripulante {{ $tripulanteIndex + 1 }}"></td>
                                        <td colspan="2" class="text-center"><button type="button"
                                                class="btn btn-danger"
                                                wire:click="deleteTripulante({{ $tripulanteIndex }})">X</button></td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif
                    @else
                        <table class="table table-bordered nowrap"
                            style="table-layout: fixed !important; width: 100% !important;">
                            <thead>
                                <tr>
                                    <th colspan="12" rowspan="4">
                                        @if ($ruta_foto)
                                            <div class="mb-3 row d-flex justify-content-center">
                                                <div class="col text-center">
                                                    @if (is_string($ruta_foto))
                                                        <img src="{{ asset('storage/photos/' . $ruta_foto) }}"
                                                            style="max-height: 30vh !important; text-align: center">
                                                    @else
                                                        <img src="{{ $ruta_foto->temporaryUrl() }}"
                                                            style="max-height: 30vh !important; text-align: center">
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div class="mb-3 row d-flex align-items-center">
                                            <div class="col-sm-12">
                                                @error('nombre')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tr style="border-color: white !important;">
                                <td colspan="12"
                                    style="border-left-color: white !important; border-right-color: white !important;">
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"
                                    @if ($situacion_barco == 0) style="background-color: #3b996d !important" @endif>
                                    <h6 style="text-align: center !important">Barco en atraque</h6>
                                </td>
                                <td colspan="6"
                                    @if ($situacion_barco == 1) style="background-color: #dc3545 !important" @endif>
                                    <h6 style="text-align: center !important">Barco en varada</h6>
                                </td>
                            </tr>
                            @mobile
                                <tr>
                                    <td colspan="6"
                                        @if ($situacion_persona == 0) style="background-color: #3b996d !important" @endif>
                                        <h6 style="text-align: center !important">Socio</h6>
                                    </td>
                                    <td colspan="6"
                                        @if ($situacion_persona == 1) style="background-color: #3b996d !important" @endif>
                                        <h6 style="text-align: center !important">Transeúnte</h6>
                                    </td>
                                </tr>
                            @endmobile
                            <tr style="border-color: white !important;">
                                <td colspan="12"
                                    style="border-left-color: white !important; border-right-color: white !important;">
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="12">
                                    <h4 style="text-align: center !important">{{ $pantalan_t_atraque }}
                                        {{ $matricula }}<br>{{ $nombre_barco }}</h4>
                                </th>
                            </tr>
                            @mobile
                                <tr>
                                    <th colspan="4">Nombre:</th>
                                    <td colspan="8">{{ $nombre_socio }}</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Nº de socio</th>
                                    <td colspan="8">{{ $numero_socio }}
                                    </td>
                                </tr>
                            @elsemobile
                                <tr>
                                    <th colspan="3">Nombre:</th>
                                    <td colspan="3">{{ $nombre_socio }}</td>
                                    <th colspan="3">Nº de socio</th>
                                    <td colspan="3">{{ $numero_socio }}
                                    </td>
                                </tr>
                            @endmobile

                            <tr>
                                <th colspan="4">DNI:</th>
                                <td colspan="8">{{ $dni }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Dirección:</th>
                                <td colspan="8">{{ $direccion }}</td>
                            </tr>
                            @foreach ($telefonos as $telefonoIndex => $telefono)
                                <tr>
                                    <th colspan="4">Teléfono {{ $telefonoIndex + 1 }}:</th>
                                    <td colspan="8">{{ $telefono['telefono'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="4">Email:</th>
                                <td colspan="8">{{ $email }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Pantalán y Atraque:</th>
                                <td colspan="8">{{ $pantalan_t_atraque }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4">Nombre del barco:</th>
                                <td colspan="8">{{ $nombre_barco }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Matrícula:</th>
                                <td colspan="8">{{ $matricula }}</td>
                            </tr>

                            <tr style="border-color: white !important;">
                                <td colspan="12"
                                    style="border-left-color: white !important; border-right-color: white !important;">
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="12">
                                    <h4 style="text-align: center !important">Notas</h4>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="12">
                                    <table style="width: 100% !important;">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Descripción</th>
                                            <th>Usuario</th>
                                            <th>Editar</th>
                                        </tr>
                                        @foreach ($notas as $nota)
                                            <li>{{ date_format(date_create($nota->fecha), 'd/m/Y') }}:
                                                {{ $nota->descripcion }}</li>
                                        @endforeach
                                    </table>
                                    @if ($puede_notas == true)
                                        <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                            style="align-self: end !important;"
                                            data-target="#modal-create">Añadir</button>
                                    @endif
                                </th>
                            </tr>
                        </table>
                    @endif
                    <div wire:ignore.self class="modal fade" id="modal-create" tabindex="-1" role="dialog">
                        <div class="modal-dialog"
                            style="min-width: 25vw !important; align-self: center !important; margin-top: 10% !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Añadir nota nueva</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4" style="text-align: center !important;">
                                            <label for="fecha_nota">Fecha</label>
                                        </div>
                                        <div class="col-md-8" style="text-align: center !important;">
                                            <label for="texto_nota">Nota</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" wire:model="fecha_nota" class="form-control"
                                                name="fecha_nota" placeholder="Fecha">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" wire:model="texto_nota" class="form-control"
                                                name="texto_nota" placeholder="Nota">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary w-100"
                                        wire:click="alertaNota">Guardar
                                        nota</button>
                                    <button type="button" class="btn btn-secondary w-100"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
                        <div class="modal-dialog"
                            style="min-width: 25vw !important; align-self: center !important; margin-top: 10% !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar nota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4" style="text-align: center !important;">
                                            <label for="fecha_nota">Fecha</label>
                                        </div>
                                        <div class="col-md-8" style="text-align: center !important;">
                                            <label for="texto_nota">Nota</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" wire:model="fecha_nota" class="form-control"
                                                name="fecha_nota" placeholder="Fecha">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" wire:model="texto_nota" class="form-control"
                                                name="texto_nota" placeholder="Nota">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary w-100"
                                        wire:click="alertaNotaEdit">Guardar
                                        nota</button>
                                    <button type="button" class="btn btn-secondary w-100"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modal-registros" tabindex="-1" role="dialog">
                        <div class="modal-dialog"
                            style="min-width: 25vw !important; align-self: center !important; margin-top: 10% !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registro de entrada/salida del barco</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($registros_entrada as $registroIndex => $registro)
                                        @if (isset($registro['estado']))
                                            <h6>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}
                                                ({{ $registro['tiempoAtraque'] }} días de baja)</h6>
                                        @else
                                            @if ($registroIndex % 2 !== 0 && isset( $registro['tiempoVarada']))
                                                <h6>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}
                                                    ({{ $registro['tiempoVarada'] }} días en varada)</h6>
                                            @else
                                                <h6>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}
                                                    ({{ $registro['tiempoAtraque'] }} días en atraque)</h6>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary w-100"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modal-registros2" tabindex="-1" role="dialog">
                        <div class="modal-dialog"
                            style="min-width: 25vw !important; align-self: center !important; margin-top: 10% !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registro de entrada/salida del transeúnte</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($registros_entrada_transeunte as $registroIndex => $registro)
                                        @if ($registroIndex % 2 !== 0)
                                            <h6>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}
                                                ({{ $registro['tiempoVarada'] }} días en varada)
                                            </h6>
                                        @else
                                            <h6>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}
                                                ({{ $registro['tiempoAtraque'] }} días en atraque)</h6>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary w-100"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modal-baja" tabindex="-1" role="dialog">
                        <div class="modal-dialog"
                            style="min-width: 25vw !important; align-self: center !important; margin-top: 10% !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Volver a dar de alta al socio/transeúnte</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <tr>
                                        <th colspan="4">Fecha de alta:</th>
                                        <td colspan="8"><input type="date" wire:model="fecha_baja"
                                                class="form-control" name="fecha_baja" placeholder="Fecha de baja">
                                        </td>
                                    </tr>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary w-100" data-dismiss="modal"
                                        wire:click="alertaBaja">Dar de alta</button>
                                    <button type="button" class="btn btn-secondary w-100"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 justify-content-center">
            @notmobile
                <div class="position-fixed">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>Situación de persona</h6>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered dt-responsive nowrap">
                                        <tr>
                                            <td
                                                @if ($situacion_persona == 0) style="background-color: #3b996d !important" @endif>
                                                <h6 style="text-align: center !important">Socio</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                @if ($situacion_persona == 1) style="background-color: #3b996d !important" @endif>
                                                <h6 style="text-align: center !important">Transeúnte</h6>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endnotmobile
                <div class="card m-b-30">
                    <div class="card-body">
                        <h6>Opciones</h6>
                        <div class="row">
                            <div class="col-12">
                                @if ($puede_editar == true)
                                    <button class="w-100 btn btn-success mb-2" id="btnBaja" data-toggle="modal"
                                        data-target="#modal-baja">Dar
                                        de alta</button>
                                @endif
                                <button class="w-100 btn btn-info mb-2" id="btnRegistros" data-toggle="modal"
                                    data-target="#modal-registros">Ver registros de entrada
                                    y salida</button>
                                @if ($situacion_persona == 1)
                                    <button class="w-100 btn btn-info mb-2" id="btnRegistros2" data-toggle="modal"
                                        data-target="#modal-registros2">Ver registros de transeúnte</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @notmobile
                </div>
            @endnotmobile
        </div>
        <style>
            fieldset.scheduler-border {
                border: 1px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow: 0px 0px 0px 0px #000;
                box-shadow: 0px 0px 0px 0px #000;
            }

            table {
                border: 1px black solid !important;
            }

            th {
                border-bottom: 1px black solid !important;
                border: 1px black solid !important;
                border-top: 1px black solid !important;
            }

            th.header {
                border-bottom: 1px black solid !important;
                border: 1px black solid !important;
                border-top: 2px black solid !important;
            }

            td.izquierda {
                border-left: 1px black solid !important;

            }

            td.derecha {
                border-right: 1px black solid !important;

            }

            td.suelo {}
        </style>
    </div>
</div>


@section('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#modal-create').modal('hide')
            $('#modal-edit').modal('hide')
        })

        $("#alertaAceptar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro? Comprueba que todo está en orden.',
                icon: 'warning',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para imprimir el presupuesto.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('imprimirPresupuesto');
                }
            });
        });

        $("#alertaCancelar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                icon: 'error',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para imprimir contrato.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('confirmedImprimir');
                }
            });
        });

        $("#alertaEliminar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro? No se podrá revertir la acción.',
                icon: 'error',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para eliminar el presupuesto.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('destroy');
                }
            });
        });


        $("#alertaGuardar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro? Comprueba que todo está en orden.',
                icon: 'warning',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para guardar el presupuesto.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('updateEvento');
                }
            });
        });

        $("#alertaImprimir").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro? Comprueba que todo está en orden.',
                icon: 'warning',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para descargar el PDF del presupuesto.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('imprimirPresupuesto');
                }
            });
        });

        $("#alertaFacturar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro? Comprueba que todo está en orden.',
                icon: 'info',
                text: 'Si estás seguro, pulsa el botón de "Confirmar" para crear una factura para este presupuesto.',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('facturarPresupuesto');
                }
            });
        });
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        // document.addEventListener('livewire:load', function() {


        // })
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.js-example-basic-single').select2();
            });

            // $('#id_cliente').on('change', function (e) {
            // console.log('change')
            // console.log( e.target.value)
            // // var data = $('.js-example-basic-single').select2("val");
            // })
        });



        $(document).ready(function() {

            $('.js-example-basic-single').select2();
            // $('.js-example-basic-single').on('change', function (e) {
            // console.log('change')
            // console.log( e.target.value)
            // var data = $('.js-example-basic-single').select2("val");

            // @this.set('foo', data);
            //     livewire.emit('selectedCompanyItem', e.target.value)
            // });
            // $('#tableServicios').DataTable({
            //     responsive: true,
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ],
            //     buttons: [{
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: [{
            //                 extend: 'pdf',
            //                 className: 'btn-export'
            //             },
            //             {
            //                 extend: 'excel',
            //                 className: 'btn-export'
            //             }
            //         ],
            //         className: 'btn btn-info text-white'
            //     }],
            //     "language": {
            //         "lengthMenu": "Mostrando _MENU_ registros por página",
            //         "zeroRecords": "Nothing found - sorry",
            //         "info": "Mostrando página _PAGE_ of _PAGES_",
            //         "infoEmpty": "No hay registros disponibles",
            //         "infoFiltered": "(filtrado de _MAX_ total registros)",
            //         "search": "Buscar:",
            //         "paginate": {
            //             "first": "Primero",
            //             "last": "Ultimo",
            //             "next": "Siguiente",
            //             "previous": "Anterior"
            //         },
            //         "zeroRecords": "No se encontraron registros coincidentes",
            //     }

        });



        // $("#fechaEmision").datepicker();


        // $("#fechaEmision").on('change', function(e) {
        //     @this.set('fechaEmision', $('#fechaEmision').val());
        // });



        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.className = "fas fa-eye-slash";
            } else {
                passwordInput.type = "password";
                eyeIcon.className = "fas fa-eye";
            }
        }

        //observer para aplicar el datepicker de evento
        // const observer = new MutationObserver((mutations, observer) => {
        //     console.log(mutations, observer);
        // });
        // observer.observe(document, {
        //     subtree: true,
        //     attributes: true
        // });



        document.addEventListener('DOMSubtreeModified', (e) => {
            $("#diaEvento").datepicker();

            // $("#diaEvento").on('focus', function(e) {
            //     document.getElementById("guardar-evento").style.visibility = "hidden";
            // })
            // $("#diaEvento").on('focusout', function(e) {
            //     if ($('#diaEvento').val() != "") {
            //         document.getElementById("guardar-evento").style.visibility = "visible";
            //     }

            // })
            // $("#diaFinal").on('focus', function(e) {
            //     document.getElementById("guardar-evento").style.visibility = "hidden";
            // })
            // $("#diaFinal").on('focusout', function(e) {
            //     if ($('#diaFinal').val() != "") {
            //         document.getElementById("guardar-evento").style.visibility = "visible";
            //     }

            // })

            $("#diaFinal").datepicker();

            $("#diaFinal").on('change', function(e) {
                @this.set('diaFinal', $('#diaFinal').val());

            });

            $("#diaEvento").on('change', function(e) {
                @this.set('diaEvento', $('#diaEvento').val());
                @this.set('diaFinal', $('#diaEvento').val());

            });

            $('#id_cliente').on('change', function(e) {
                console.log('change')
                console.log(e.target.value)
                var data = $('#id_cliente').select2("val");
                @this.set('id_cliente', data);
                Livewire.emit('selectCliente')

                // livewire.emit('selectedCompanyItem', data)
            })
        })

        function OpenSecondPage() {
            var id = @this.id_cliente
            window.open(`/admin/clientes-edit/` + id, '_blank'); // default page
        };
    </script>
@endsection
