@extends('layouts.app')

@section('title', 'Editar Socio')

@section('content-principal')
<div class="modern-edit-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-user-edit"></i>
                    Editar Socio {{ $socio->numero_socio }}
                </h1>
                <p class="page-subtitle">Modifica los datos del socio y transeúnte</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('socios.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver</span>
                </a>
            </div>
        </div>
        
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('socios.index') }}" class="breadcrumb-item">
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

    @if ($puede_editar)
        <form method="POST" action="{{ route('socios.update', $socio->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
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
                                @if ($socio->ruta_foto)
                                    <div class="photo-preview">
                                        <img src="{{ asset('assets/images/' . $socio->ruta_foto) }}" 
                                             alt="Foto del barco" 
                                             class="photo-image">
                                    </div>
                                @endif
                                <div class="photo-upload">
                                    <input type="file" 
                                           class="photo-input" 
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
                                @if ($socio->ruta_foto2)
                                    <div class="photo-preview">
                                        <img src="{{ asset('assets/images/' . $socio->ruta_foto2) }}" 
                                             alt="Foto del socio" 
                                             class="photo-image">
                                    </div>
                                @endif
                                <div class="photo-upload">
                                    <input type="file" 
                                           class="photo-input" 
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
                    </div>

                    <!-- Status Section -->
                    <div class="status-section">
                        <div class="status-card">
                            <h3 class="section-title">
                                <i class="fas fa-anchor"></i>
                                Estado del Barco
                            </h3>
                            <div class="status-buttons">
                                <label class="status-btn {{ $socio->situacion_barco == 0 ? 'active' : '' }}">
                                    <input type="radio" name="situacion_barco" value="0" {{ $socio->situacion_barco == 0 ? 'checked' : '' }} style="display: none;">
                                    <i class="fas fa-ship"></i>
                                    <span>En Atraque</span>
                                </label>
                                <label class="status-btn {{ $socio->situacion_barco == 1 ? 'active' : '' }}">
                                    <input type="radio" name="situacion_barco" value="1" {{ $socio->situacion_barco == 1 ? 'checked' : '' }} style="display: none;">
                                    <i class="fas fa-tools"></i>
                                    <span>En Varada/Fuera</span>
                                </label>
                            </div>
                        </div>

                        <div class="status-card">
                            <h3 class="section-title">
                                <i class="fas fa-user-tag"></i>
                                Tipo de Persona
                            </h3>
                            <div class="status-buttons">
                                <label class="status-btn {{ $socio->situacion_persona == 0 ? 'active' : '' }}">
                                    <input type="radio" name="situacion_persona" value="0" {{ $socio->situacion_persona == 0 ? 'checked' : '' }} style="display: none;">
                                    <i class="fas fa-user"></i>
                                    <span>Socio</span>
                                </label>
                                <label class="status-btn {{ $socio->situacion_persona == 1 ? 'active' : '' }}">
                                    <input type="radio" name="situacion_persona" value="1" {{ $socio->situacion_persona == 1 ? 'checked' : '' }} style="display: none;">
                                    <i class="fas fa-walking"></i>
                                    <span>Transeúnte</span>
                                </label>
                                <label class="status-btn {{ $socio->situacion_persona == 2 ? 'active' : '' }}">
                                    <input type="radio" name="situacion_persona" value="2" {{ $socio->situacion_persona == 2 ? 'checked' : '' }} style="display: none;">
                                    <i class="fas fa-users"></i>
                                    <span>Socio/Transeúnte</span>
                                </label>
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
                                       name="nombre_socio"
                                       class="modern-input"
                                       value="{{ old('nombre_socio', $socio->nombre_socio) }}"
                                       placeholder="Nombre del socio">
                                @error('nombre_socio')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="input-label">Nº de socio</label>
                                <input type="number" 
                                       name="numero_socio"
                                       class="modern-input"
                                       value="{{ old('numero_socio', $socio->numero_socio) }}"
                                       placeholder="Número de socio">
                            </div>

                            <div class="input-group">
                                <label class="input-label">PIN de socio</label>
                                <input type="number" 
                                       name="pin_socio"
                                       class="modern-input"
                                       value="{{ old('pin_socio', $socio->pin_socio) }}"
                                       placeholder="PIN de socio">
                            </div>

                            <div class="input-group">
                                <label class="input-label">DNI</label>
                                <input type="text" 
                                       name="dni"
                                       class="modern-input"
                                       value="{{ old('dni', $socio->dni) }}"
                                       placeholder="DNI">
                            </div>

                            <div class="input-group full-width">
                                <label class="input-label">Dirección</label>
                                <input type="text" 
                                       name="direccion"
                                       class="modern-input"
                                       value="{{ old('direccion', $socio->direccion) }}"
                                       placeholder="Dirección">
                            </div>

                            <div class="input-group full-width">
                                <label class="input-label">Email</label>
                                <input type="email" 
                                       name="email"
                                       class="modern-input"
                                       value="{{ old('email', $socio->email) }}"
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
                            <button type="button" class="btn-add" onclick="addTelefono()">
                                <i class="fas fa-plus"></i>
                                <span>Añadir</span>
                            </button>
                        </div>
                        <div class="dynamic-list" id="telefonos-list">
                            @foreach ($socio->telefonos as $index => $telefono)
                                <div class="dynamic-item">
                                    <div class="item-content">
                                        <label class="input-label">Teléfono {{ $index + 1 }}</label>
                                        <input type="text"
                                               name="telefonos[{{ $index }}][telefono]"
                                               class="modern-input"
                                               value="{{ old('telefonos.'.$index.'.telefono', $telefono->telefono) }}"
                                               placeholder="Teléfono {{ $index + 1 }}">
                                        <input type="hidden" name="telefonos[{{ $index }}][id]" value="{{ $telefono->id }}">
                                    </div>
                                    <button type="button" class="btn-remove" onclick="removeTelefono(this)">
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
                                       name="pantalan_t_atraque"
                                       class="modern-input"
                                       value="{{ old('pantalan_t_atraque', $socio->pantalan_t_atraque) }}"
                                       placeholder="Pantalán y Atraque">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Nombre del barco</label>
                                <input type="text" 
                                       name="nombre_barco"
                                       class="modern-input"
                                       value="{{ old('nombre_barco', $socio->nombre_barco) }}"
                                       placeholder="Nombre del barco">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Matrícula</label>
                                <input type="text" 
                                       name="matricula"
                                       class="modern-input"
                                       value="{{ old('matricula', $socio->matricula) }}"
                                       placeholder="Matrícula">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Eslora</label>
                                <input type="text" 
                                       name="eslora"
                                       class="modern-input"
                                       value="{{ old('eslora', $socio->eslora) }}"
                                       placeholder="Eslora">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Manga</label>
                                <input type="text" 
                                       name="manga"
                                       class="modern-input"
                                       value="{{ old('manga', $socio->manga) }}"
                                       placeholder="Manga">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Calado</label>
                                <input type="text" 
                                       name="calado"
                                       class="modern-input"
                                       value="{{ old('calado', $socio->calado) }}"
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
                            <button type="button" class="btn-add" onclick="addNumeroLlave()">
                                <i class="fas fa-plus"></i>
                                <span>Añadir</span>
                            </button>
                        </div>
                        <div class="dynamic-list" id="numeros-llave-list">
                            @foreach ($socio->numeros_llave as $index => $numero_llave)
                                <div class="dynamic-item">
                                    <div class="item-content">
                                        <label class="input-label">Llave {{ $index + 1 }}</label>
                                        <input type="text"
                                               name="numeros_llave[{{ $index }}][numero_llave]"
                                               class="modern-input"
                                               value="{{ old('numeros_llave.'.$index.'.numero_llave', $numero_llave->num_llave) }}"
                                               placeholder="Nº de llave {{ $index + 1 }}">
                                        <input type="hidden" name="numeros_llave[{{ $index }}][id]" value="{{ $numero_llave->id }}">
                                    </div>
                                    <button type="button" class="btn-remove" onclick="removeNumeroLlave(this)">
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
                                       name="seguro_barco"
                                       class="modern-input"
                                       value="{{ old('seguro_barco', $socio->seguro_barco) }}"
                                       placeholder="Seguro barco">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Póliza</label>
                                <input type="text" 
                                       name="poliza"
                                       class="modern-input"
                                       value="{{ old('poliza', $socio->poliza) }}"
                                       placeholder="Póliza">
                            </div>

                            <div class="input-group">
                                <label class="input-label">Vencimiento</label>
                                <input type="date" 
                                       name="vencimiento"
                                       class="modern-input"
                                       value="{{ old('vencimiento', $socio->vencimiento) }}"
                                       placeholder="Vencimiento">
                            </div>

                            <div class="input-group">
                                <label class="input-label">ITB</label>
                                <input type="date" 
                                       name="itb"
                                       class="modern-input"
                                       value="{{ old('itb', $socio->itb) }}"
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
                            @foreach ($socio->notas as $nota)
                                <div class="note-item">
                                    <div class="note-header">
                                        <span class="note-date">{{ $nota->fecha->format('d/m/Y') }}</span>
                                        <span class="note-user">{{ $nota->user->name ?? 'Usuario' }}</span>
                                    </div>
                                    <div class="note-content">
                                        {{ $nota->descripcion }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                        <a href="#" class="action-btn btn-success">
                            <i class="fas fa-history"></i>
                            <span>Ver registros de entrada y salida</span>
                        </a>
                        
                        <a href="#" class="action-btn btn-danger">
                            <i class="fas fa-user-times"></i>
                            <span>Dar de baja</span>
                        </a>
                    </div>
                </div>

                <div class="sidebar-card">
                    <h3 class="sidebar-title">
                        <i class="fas fa-save"></i>
                        Opciones de Guardado
                    </h3>
                    <div class="action-buttons">
                        <button type="submit" class="action-btn btn-success">
                            <i class="fas fa-save"></i>
                            <span>Guardar datos de socio</span>
                        </button>
                        
                        <a href="#" class="action-btn btn-warning">
                            <i class="fas fa-print"></i>
                            <span>Impresión de Socio</span>
                        </a>
                        
                        <a href="#" class="action-btn btn-danger">
                            <i class="fas fa-trash"></i>
                            <span>Eliminar datos de socio</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    @else
        <!-- Read Only View -->
        <div class="readonly-section">
            <div class="readonly-container">
                <p>No tienes permisos para editar este socio.</p>
            </div>
        </div>
    @endif

    <!-- Fixed Save Button -->
    @if ($puede_editar)
        <div class="fixed-save-button">
            <button type="submit" form="socio-form" class="btn-save-fixed">
                <i class="fas fa-save"></i>
                <span>Guardar Cambios</span>
            </button>
        </div>
    @endif
</div>

@include('livewire.socio.edit-component-styles')

<script>
// JavaScript para manejar elementos dinámicos
let telefonoIndex = {{ $socio->telefonos->count() }};
let llaveIndex = {{ $socio->numeros_llave->count() }};

function addTelefono() {
    const container = document.getElementById('telefonos-list');
    const newItem = document.createElement('div');
    newItem.className = 'dynamic-item';
    newItem.innerHTML = `
        <div class="item-content">
            <label class="input-label">Teléfono ${telefonoIndex + 1}</label>
            <input type="text"
                   name="telefonos[${telefonoIndex}][telefono]"
                   class="modern-input"
                   placeholder="Teléfono ${telefonoIndex + 1}">
        </div>
        <button type="button" class="btn-remove" onclick="removeTelefono(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newItem);
    telefonoIndex++;
}

function removeTelefono(button) {
    button.closest('.dynamic-item').remove();
}

function addNumeroLlave() {
    const container = document.getElementById('numeros-llave-list');
    const newItem = document.createElement('div');
    newItem.className = 'dynamic-item';
    newItem.innerHTML = `
        <div class="item-content">
            <label class="input-label">Llave ${llaveIndex + 1}</label>
            <input type="text"
                   name="numeros_llave[${llaveIndex}][numero_llave]"
                   class="modern-input"
                   placeholder="Nº de llave ${llaveIndex + 1}">
        </div>
        <button type="button" class="btn-remove" onclick="removeNumeroLlave(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newItem);
    llaveIndex++;
}

function removeNumeroLlave(button) {
    button.closest('.dynamic-item').remove();
}

// Manejar radio buttons de estado
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Remover clase active de todos los botones del mismo grupo
        document.querySelectorAll(`input[name="${this.name}"]`).forEach(r => {
            r.closest('.status-btn').classList.remove('active');
        });
        // Añadir clase active al seleccionado
        this.closest('.status-btn').classList.add('active');
    });
});
</script>
@endsection
