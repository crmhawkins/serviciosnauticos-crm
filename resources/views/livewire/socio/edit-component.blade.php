@include('livewire.socio.edit-component-styles')

<div class="modern-edit-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-user-edit"></i>
                    Editar Socio {{ $numero_socio ?? 'Cargando...' }}
                </h1>
                <p class="page-subtitle">Modifica los datos del socio y transeúnte</p>
            </div>
            <div class="header-actions">
                <a href="javascript:void(0);" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver</span>
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
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-users"></i>
                    Socios
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-user-edit"></i>
                    Editar socio
                </span>
            </nav>
        </div>
    </div>

    @if ($puede_editar == true)
        <!-- Main Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Photos Section -->
                <div class="photos-section">
                    <div class="photo-upload-card">
                        <div class="photo-header">
                            <h3 class="photo-title">
                                <i class="fas fa-camera"></i>
                                Foto del Barco
                            </h3>
                        </div>
                        <div class="photo-content">
                            @if (isset($ruta_foto))
                                <div class="photo-preview">
                                    @if (!is_string($ruta_foto))
                                        <img src="{{ $ruta_foto->temporaryUrl() }}" 
                                             alt="Foto del barco" 
                                             class="photo-image"
                                             data-toggle="modal" 
                                             data-target="#imageModal">
                                    @else
                                        <img src="{{ asset('assets/images/' . $ruta_foto) }}" 
                                             alt="Foto del barco" 
                                             class="photo-image"
                                             data-toggle="modal" 
                                             data-target="#imageModal">
                                    @endif
                                </div>
                            @endif
                            <div class="photo-upload">
                                <input type="file" 
                                       class="photo-input" 
                                       wire:model="ruta_foto"
                                       name="ruta_foto" 
                                       id="ruta_foto"
                                       accept="image/*">
                                <label for="ruta_foto" class="photo-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Subir foto del barco</span>
                                </label>
                                @error('ruta_foto')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="photo-upload-card">
                        <div class="photo-header">
                            <h3 class="photo-title">
                                <i class="fas fa-user"></i>
                                Foto del Socio
                            </h3>
                        </div>
                        <div class="photo-content">
                            @if (isset($ruta_foto2))
                                <div class="photo-preview">
                                    @if (!is_string($ruta_foto2))
                                        <img src="{{ $ruta_foto2->temporaryUrl() }}" 
                                             alt="Foto del socio" 
                                             class="photo-image"
                                             data-toggle="modal" 
                                             data-target="#imageModal2">
                                    @else
                                        <img src="{{ asset('assets/images/' . $ruta_foto2) }}" 
                                             alt="Foto del socio" 
                                             class="photo-image"
                                             data-toggle="modal" 
                                             data-target="#imageModal2">
                                    @endif
                                </div>
                            @endif
                            <div class="photo-upload">
                                <input type="file" 
                                       class="photo-input" 
                                       wire:model="ruta_foto2"
                                       name="ruta_foto2" 
                                       id="ruta_foto2"
                                       accept="image/*">
                                <label for="ruta_foto2" class="photo-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Subir foto del socio</span>
                                </label>
                                @error('ruta_foto2')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="gallery-card">
                        <div class="photo-header">
                            <h3 class="photo-title"><i class="fas fa-images"></i> Galería del Barco</h3>
                        </div>
                        <div class="photo-content">
                            <input type="file" class="photo-input" wire:model="fotos_barco_nuevas" multiple accept="image/*" id="galeria_barco_files">
                            <label for="galeria_barco_files" class="photo-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Añadir fotos del barco</span>
                            </label>
                            @error('fotos_barco_nuevas.*')<span class="error-message">{{ $message }}</span>@enderror
                            <div class="gallery-grid">
                                @foreach($galeria_barco as $foto)
                                    <div class="gallery-item">
                                        <img src="{{ asset('assets/images/' . $foto['ruta']) }}" class="gallery-image" alt="foto barco">
                                        <div class="gallery-actions">
                                            <button type="button" class="btn btn-sm btn-primary" wire:click="destacarFoto('barco', {{ $foto['id'] }})">
                                                <i class="fas fa-star"></i> Destacar
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="eliminarFoto('barco', {{ $foto['id'] }})">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="gallery-card">
                        <div class="photo-header">
                            <h3 class="photo-title"><i class="fas fa-images"></i> Galería del Socio</h3>
                        </div>
                        <div class="photo-content">
                            <input type="file" class="photo-input" wire:model="fotos_socio_nuevas" multiple accept="image/*" id="galeria_socio_files">
                            <label for="galeria_socio_files" class="photo-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Añadir fotos del socio</span>
                            </label>
                            @error('fotos_socio_nuevas.*')<span class="error-message">{{ $message }}</span>@enderror
                            <div class="gallery-grid">
                                @foreach($galeria_socio as $foto)
                                    <div class="gallery-item">
                                        <img src="{{ asset('assets/images/' . $foto['ruta']) }}" class="gallery-image" alt="foto socio">
                                        <div class="gallery-actions">
                                            <button type="button" class="btn btn-sm btn-primary" wire:click="destacarFoto('socio', {{ $foto['id'] }})">
                                                <i class="fas fa-star"></i> Destacar
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="eliminarFoto('socio', {{ $foto['id'] }})">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="status-section">
                    <div class="status-card">
                        <h3 class="section-title">
                            <i class="fas fa-anchor"></i>
                            Estado del Barco
                        </h3>
                        <div class="status-buttons">
                            <button type="button" 
                                    class="status-btn {{ $situacion_barco == 0 ? 'active' : '' }}"
                                    wire:click="cambiarSituacionBarco(0)">
                                <i class="fas fa-ship"></i>
                                <span>En Atraque</span>
                            </button>
                            <button type="button" 
                                    class="status-btn {{ $situacion_barco == 1 ? 'active' : '' }}"
                                    wire:click="cambiarSituacionBarco(1)">
                                <i class="fas fa-tools"></i>
                                <span>En Varada/Fuera</span>
                            </button>
                        </div>
                        
                        @if ($situacion_barco != $situacion_barco_old)
                            @if ($situacion_barco == 0)
                                <div class="date-input-group">
                                    <label class="input-label">Nueva fecha de entrada:</label>
                                    <input type="date" 
                                           wire:model="fecha_entrada"
                                           class="modern-input"
                                           name="fecha_entrada">
                                </div>
                            @elseif($situacion_barco == 1)
                                @if (is_null($this->ultimo_registroverif))
                                    <div class="date-input-group">
                                        <label class="input-label">Fecha de última entrada:</label>
                                        <input type="date" 
                                               wire:model="fecha_entrada_barco"
                                               class="modern-input"
                                               name="fecha_entrada">
                                    </div>
                                    <div class="date-input-group">
                                        <label class="input-label">Nueva fecha de salida:</label>
                                        <input type="date" 
                                               wire:model="fecha_entrada"
                                               class="modern-input"
                                               name="fecha_entrada">
                                    </div>
                                @else
                                    <div class="date-input-group">
                                        <label class="input-label">Nueva fecha de salida:</label>
                                        <input type="date" 
                                               wire:model="fecha_entrada"
                                               class="modern-input"
                                               name="fecha_entrada">
                                    </div>
                                @endif
                            @endif
                        @elseif($situacion_barco == 0)
                            <div class="date-input-group">
                                <label class="input-label">Fecha de última entrada:</label>
                                <input type="date" 
                                       wire:model="entrada"
                                       class="modern-input"
                                       name="entrada">
                            </div>
                        @endif
                    </div>

                    <div class="status-card">
                        <h3 class="section-title">
                            <i class="fas fa-user-tag"></i>
                            Tipo de Persona
                        </h3>
                        <div class="status-buttons">
                            <button type="button" 
                                    class="status-btn {{ $situacion_persona == 0 ? 'active' : '' }}"
                                    wire:click="cambiarSituacionPersona(0)">
                                <i class="fas fa-user"></i>
                                <span>Socio</span>
                            </button>
                            <button type="button" 
                                    class="status-btn {{ $situacion_persona == 1 ? 'active' : '' }}"
                                    wire:click="cambiarSituacionPersona(1)">
                                <i class="fas fa-walking"></i>
                                <span>Transeúnte</span>
                            </button>
                            <button type="button" 
                                    class="status-btn {{ $situacion_persona == 2 ? 'active' : '' }}"
                                    wire:click="cambiarSituacionPersona(2)">
                                <i class="fas fa-users"></i>
                                <span>Socio/Transeúnte</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Personal Data Section -->
                <div class="form-section-card">
                    <h3 class="section-title">
                        <i class="fas fa-id-card"></i>
                        Datos Personales
                    </h3>
                    <div class="form-grid">
                        <div class="input-group">
                            <label class="input-label">Nombre *</label>
                            <input type="text" 
                                   wire:model="nombre_socio"
                                   class="modern-input"
                                   name="nombre_socio" 
                                   placeholder="Nombre del socio">
                            @error('nombre_socio')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label class="input-label">Nº de socio</label>
                            <input type="number" 
                                   wire:model="numero_socio"
                                   class="modern-input"
                                   name="numero_socio" 
                                   placeholder="Número de socio">
                        </div>

                        <div class="input-group">
                            <label class="input-label">PIN de socio</label>
                            <input type="number" 
                                   wire:model="pin_socio"
                                   class="modern-input"
                                   name="pin_socio" 
                                   placeholder="PIN de socio">
                        </div>

                        <div class="input-group">
                            <label class="input-label">DNI</label>
                            <input type="text" 
                                   wire:model="dni"
                                   class="modern-input"
                                   name="dni" 
                                   placeholder="DNI">
                        </div>

                        <div class="input-group full-width">
                            <label class="input-label">Dirección</label>
                            <input type="text" 
                                   wire:model="direccion"
                                   class="modern-input"
                                   name="direccion" 
                                   placeholder="Dirección">
                        </div>

                        <div class="input-group full-width">
                            <label class="input-label">Email</label>
                            <input type="email" 
                                   wire:model="email"
                                   class="modern-input"
                                   name="email" 
                                   placeholder="Email">
                        </div>
                    </div>
                </div>

                <!-- Phones Section -->
                <div class="form-section-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-phone"></i>
                            Teléfonos
                        </h3>
                        <button type="button" 
                                class="btn-add"
                                wire:click="addTelefono">
                            <i class="fas fa-plus"></i>
                            <span>Añadir</span>
                        </button>
                    </div>
                    <div class="dynamic-list">
                        @foreach ($telefonos as $telefonoIndex => $telefono)
                            <div class="dynamic-item">
                                <div class="item-content">
                                    <label class="input-label">Teléfono {{ $telefonoIndex + 1 }}</label>
                                    <input type="text"
                                           wire:model="telefonos.{{ $telefonoIndex }}.telefono"
                                           class="modern-input"
                                           name="telefonos[{{ $telefonoIndex }}][telefono]"
                                           placeholder="Teléfono {{ $telefonoIndex + 1 }}">
                                </div>
                                <button type="button"
                                        class="btn-remove"
                                        wire:click="deleteTelefono({{ $telefonoIndex }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Boat Data Section -->
                <div class="form-section-card">
                    <h3 class="section-title">
                        <i class="fas fa-ship"></i>
                        Datos del Barco
                    </h3>
                    <div class="form-grid">
                        <div class="input-group">
                            <label class="input-label">Pantalán y Atraque</label>
                            <input type="text" 
                                   wire:model="pantalan_t_atraque"
                                   class="modern-input"
                                   name="pantalan_t_atraque" 
                                   placeholder="Pantalán y Atraque">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Nombre del barco</label>
                            <input type="text" 
                                   wire:model="nombre_barco"
                                   class="modern-input"
                                   name="nombre_barco" 
                                   placeholder="Nombre del barco">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Matrícula</label>
                            <input type="text" 
                                   wire:model="matricula"
                                   class="modern-input"
                                   name="matricula" 
                                   placeholder="Matrícula">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Eslora</label>
                            <input type="text" 
                                   wire:model="eslora"
                                   class="modern-input"
                                   name="eslora" 
                                   placeholder="Eslora">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Manga</label>
                            <input type="text" 
                                   wire:model="manga"
                                   class="modern-input"
                                   name="manga" 
                                   placeholder="Manga">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Calado</label>
                            <input type="text" 
                                   wire:model="calado"
                                   class="modern-input"
                                   name="calado" 
                                   placeholder="Calado">
                        </div>
                    </div>
                </div>

                <!-- Keys Section -->
                <div class="form-section-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-key"></i>
                            Números de Llave
                        </h3>
                        <button type="button" 
                                class="btn-add"
                                wire:click="addNumeroLlave">
                            <i class="fas fa-plus"></i>
                            <span>Añadir</span>
                        </button>
                    </div>
                    <div class="dynamic-list">
                        @foreach ($numeros_llave as $llaveIndex => $numero_llave)
                            <div class="dynamic-item">
                                <div class="item-content">
                                    <label class="input-label">Llave {{ $llaveIndex + 1 }}</label>
                                    <input type="text"
                                           wire:model="numeros_llave.{{ $llaveIndex }}.numero_llave"
                                           class="modern-input"
                                           name="numeros_llave[{{ $llaveIndex }}][numero_llave]"
                                           placeholder="Nº de llave {{ $llaveIndex + 1 }}">
                                </div>
                                <button type="button"
                                        class="btn-remove"
                                        wire:click="deleteNumeroLlave({{ $llaveIndex }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Insurance Section -->
                <div class="form-section-card">
                    <h3 class="section-title">
                        <i class="fas fa-shield-alt"></i>
                        Seguro del Barco
                    </h3>
                    <div class="form-grid">
                        <div class="input-group">
                            <label class="input-label">Seguro barco</label>
                            <input type="text" 
                                   wire:model="seguro_barco"
                                   class="modern-input"
                                   name="seguro_barco" 
                                   placeholder="Seguro barco">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Póliza</label>
                            <input type="text" 
                                   wire:model="poliza"
                                   class="modern-input"
                                   name="poliza" 
                                   placeholder="Póliza">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Vencimiento</label>
                            <input type="date" 
                                   wire:model="vencimiento"
                                   class="modern-input"
                                   name="vencimiento" 
                                   placeholder="Vencimiento">
                        </div>

                        <div class="input-group">
                            <label class="input-label">ITB</label>
                            <input type="date" 
                                   wire:model="itb"
                                   class="modern-input"
                                   name="itb" 
                                   placeholder="ITB">
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="form-section-card">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Notas
                    </h3>
                    <div class="notes-list">
                        @foreach ($notas as $nota)
                            <div class="note-item">
                                <div class="note-header">
                                    <span class="note-date">{{ date_format(date_create($nota->fecha), 'd/m/Y') }}</span>
                                    <span class="note-user">{{ $this->getNombre($nota->user_id) }}</span>
                                </div>
                                <div class="note-content">
                                    {{ $nota->descripcion }}
                                </div>
                                <div class="note-actions">
                                    <button type="button" 
                                            class="btn-edit-note"
                                            data-toggle="modal" 
                                            data-target="#modal-edit" 
                                            wire:click="cargarNota({{ $nota->id }})">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($puede_notas == true)
                        <button type="button" 
                                class="btn-add-note"
                                data-toggle="modal"
                                data-target="#modal-create">
                            <i class="fas fa-plus"></i>
                            <span>Añadir nota</span>
                        </button>
                    @endif
                </div>

                <!-- Transeunte Specific Data -->
                @if ($situacion_persona == 1 || $situacion_persona == 2)
                    <div class="form-section-card">
                        <h3 class="section-title">
                            <i class="fas fa-walking"></i>
                            Datos Específicos de Transeúnte
                        </h3>
                        
                        <!-- Entries Section -->
                        <div class="subsection">
                            <div class="section-header">
                                <h4 class="subsection-title">Nuevas Entradas</h4>
                                <button type="button" 
                                        class="btn-add"
                                        wire:click="addEntrada">
                                    <i class="fas fa-plus"></i>
                                    <span>Añadir</span>
                                </button>
                            </div>
                            <div class="table-container">
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th>Fecha Entrada</th>
                                            <th>Fecha Salida</th>
                                            <th>Precio/Día</th>
                                            <th>Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros_entrada_transeunte as $registroIndex => $registro)
                                            <tr>
                                                <td>
                                                    <input type="date"
                                                           wire:model="registros_entrada_transeunte.{{ $registroIndex }}.fecha_entrada"
                                                           class="modern-input">
                                                </td>
                                                <td>
                                                    <input type="date"
                                                           wire:model="registros_entrada_transeunte.{{ $registroIndex }}.fecha_salida"
                                                           class="modern-input">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                           wire:model="registros_entrada_transeunte.{{ $registroIndex }}.precio"
                                                           class="modern-input"
                                                           placeholder="Precio diario">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                           wire:model="registros_entrada_transeunte.{{ $registroIndex }}.total"
                                                           class="modern-input"
                                                           placeholder="Total">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn-remove"
                                                            wire:click="deleteEntrada({{ $registroIndex }})">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Crew Section -->
                        <div class="subsection">
                            <div class="section-header">
                                <h4 class="subsection-title">Tripulantes</h4>
                                <button type="button" 
                                        class="btn-add"
                                        wire:click="addTripulante">
                                    <i class="fas fa-plus"></i>
                                    <span>Añadir</span>
                                </button>
                            </div>
                            <div class="table-container">
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>DNI</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tripulantes as $tripulanteIndex => $tripulante)
                                            <tr>
                                                <td>
                                                    <input type="text"
                                                           wire:model="tripulantes.{{ $tripulanteIndex }}.nombre"
                                                           class="modern-input"
                                                           placeholder="Nombre del tripulante">
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           wire:model="tripulantes.{{ $tripulanteIndex }}.dni"
                                                           class="modern-input"
                                                           placeholder="DNI del tripulante">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn-remove"
                                                            wire:click="deleteTripulante({{ $tripulanteIndex }})">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="sidebar-section">
            <div class="sidebar-card">
                <h3 class="sidebar-title">
                    <i class="fas fa-cogs"></i>
                    Acciones
                </h3>
                <div class="action-buttons">
                    <button class="action-btn btn-success" 
                            id="btnRegistros" 
                            data-toggle="modal"
                            data-target="#modal-registros">
                        <i class="fas fa-history"></i>
                        <span>Ver registros de entrada y salida</span>
                    </button>
                    
                    @if ($puede_editar == true)
                        <button class="action-btn btn-danger" 
                                id="btnBaja" 
                                data-toggle="modal"
                                data-target="#modal-baja">
                            <i class="fas fa-user-times"></i>
                            <span>Dar de baja</span>
                        </button>
                    @endif
                </div>
            </div>

            <div class="sidebar-card">
                <h3 class="sidebar-title">
                    <i class="fas fa-save"></i>
                    Opciones de Guardado
                </h3>
                <div class="action-buttons">
                    <button class="action-btn btn-success" 
                            id="alertaGuardar"
                            wire:click.prevent="alertaGuardar">
                        <i class="fas fa-save"></i>
                        <span>Guardar datos de socio</span>
                    </button>
                    
                    @if ($puede_editar == true)
                        <button class="action-btn btn-warning" 
                                id="alertaImpresion"
                                wire:click.prevent="alertaImpresion">
                            <i class="fas fa-print"></i>
                            <span>Impresión de Socio</span>
                        </button>
                        
                        <button class="action-btn btn-danger" 
                                id="alertaEliminar"
                                wire:click.prevent="alertaEliminar">
                            <i class="fas fa-trash"></i>
                            <span>Eliminar datos de socio</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <!-- Read Only View -->
        <div class="readonly-section">
            <div class="readonly-container">
                <!-- Similar structure but with readonly inputs and different styling -->
                <!-- This would contain the same form structure but with disabled inputs -->
            </div>
        </div>
    @endif

    <!-- Fixed Save Button -->
    <div class="fixed-save-button">
        <button type="button"
                class="btn-save-fixed"
                wire:click.prevent="alertaGuardar">
            <i class="fas fa-save"></i>
            <span>Guardar Cambios</span>
        </button>
    </div>
</div>

<!-- Modals -->
<!-- Note Create Modal -->
<div wire:ignore.self class="modal fade" id="modal-create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir nota nueva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fecha_nota">Fecha</label>
                    <input type="date" 
                           wire:model="fecha_nota" 
                           class="modern-input"
                           name="fecha_nota">
                </div>
                <div class="form-group">
                    <label for="texto_nota">Nota</label>
                    <textarea wire:model="texto_nota" 
                              class="modern-input"
                              name="texto_nota" 
                              rows="3"
                              placeholder="Escribe tu nota aquí..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
                <button type="button" 
                        class="btn btn-primary"
                        wire:click="alertaNota">Guardar nota</button>
            </div>
        </div>
    </div>
</div>

<!-- Note Edit Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fecha_nota">Fecha</label>
                    <input type="date" 
                           wire:model="fecha_nota" 
                           class="modern-input"
                           name="fecha_nota">
                </div>
                <div class="form-group">
                    <label for="texto_nota">Nota</label>
                    <textarea wire:model="texto_nota" 
                              class="modern-input"
                              name="texto_nota" 
                              rows="3"
                              placeholder="Escribe tu nota aquí..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
                <button type="button" 
                        class="btn btn-primary"
                        wire:click="alertaNotaEdit">Guardar nota</button>
            </div>
        </div>
    </div>
</div>

<!-- Records Modal -->
<div wire:ignore.self class="modal fade" id="modal-registros" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                        @if ($registro['estado'] == 1)
                            <div class="record-item">
                                <strong>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}</strong>
                                <span class="record-status status-varada">
                                    {{ $registro['tiempoAtraque'] ?? '-' }} días en varada/fuera
                                </span>
                            </div>
                        @else
                            <div class="record-item">
                                <strong>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}</strong>
                                <span class="record-status status-atraque">
                                    {{ $registro['tiempoAtraque'] ?? '-' }} días de atraque
                                </span>
                            </div>
                        @endif
                    @else
                        @if (isset($registro['tiempoVarada']))
                            <div class="record-item">
                                <strong>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}</strong>
                                <span class="record-status status-varada">
                                    {{ $registro['tiempoVarada'] }} días en varada/fuera
                                </span>
                            </div>
                        @else
                            <div class="record-item">
                                <strong>{{ $registro['fecha_1'] }} - {{ $registro['fecha_2'] }}</strong>
                                <span class="record-status status-atraque">
                                    {{ $registro['tiempoAtraque'] ?? '-' }} días en atraque
                                </span>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Modal -->
<div wire:ignore.self class="modal fade" id="modal-baja" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dar de baja al socio/transeúnte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fecha_baja">Fecha de baja:</label>
                    <input type="date" 
                           wire:model="fecha_baja"
                           class="modern-input"
                           name="fecha_baja">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
                <button type="button" 
                        class="btn btn-danger"
                        data-dismiss="modal"
                        wire:click="alertaBaja">Dar de baja</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modals -->
<div wire:ignore.self class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                @if (isset($ruta_foto))
                    @if (!is_string($ruta_foto))
                        <img src="{{ $ruta_foto->temporaryUrl() }}" 
                             style="max-width: 100%; height: auto; max-height: 80vh;">
                    @else
                        <img src="{{ asset('assets/images/' . $ruta_foto) }}" 
                             style="max-width: 100%; height: auto; max-height: 80vh;">
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="imageModal2" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                @if (isset($ruta_foto2))
                    @if (!is_string($ruta_foto2))
                        <img src="{{ $ruta_foto2->temporaryUrl() }}" 
                             style="max-width: 100%; height: auto; max-height: 80vh;">
                    @else
                        <img src="{{ asset('assets/images/' . $ruta_foto2) }}" 
                             style="max-width: 100%; height: auto; max-height: 80vh;">
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-secondary" 
                        data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Forzar apertura del modal de registros aunque data-toggle no se inicialice tras Livewire
(function(){
    function bindRegistrosModal(){
        var btn = document.getElementById('btnRegistros');
        if (!btn) return;
        btn.removeEventListener('click', window.__openRegistros || (()=>{}));
        window.__openRegistros = function(ev){
            ev.preventDefault();
            try { $('#modal-registros').modal('show'); } catch(e) { console.warn('Bootstrap modal not found:', e); }
        };
        btn.addEventListener('click', window.__openRegistros);
    }
    document.addEventListener('DOMContentLoaded', bindRegistrosModal);
    document.addEventListener('livewire:load', function(){
        window.livewire.hook('message.processed', bindRegistrosModal);
    });
})();
</script>
