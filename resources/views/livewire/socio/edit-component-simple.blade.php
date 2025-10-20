<div class="modern-edit-container">
    <!-- Debug Info -->
    <div class="header-section">
        <h1>Debug Info</h1>
        <p>Identificador: {{ $identificador ?? 'No definido' }}</p>
        <p>Número Socio: {{ $numero_socio ?? 'No definido' }}</p>
        <p>Nombre Socio: {{ $nombre_socio ?? 'No definido' }}</p>
        <p>DNI: {{ $dni ?? 'No definido' }}</p>
        <p>Dirección: {{ $direccion ?? 'No definido' }}</p>
        <p>Teléfonos: {{ count($telefonos ?? []) }}</p>
        <p>Puede Editar: {{ $puede_editar ? 'Sí' : 'No' }}</p>
        <p>Socio ID: {{ $socio->id ?? 'No definido' }}</p>
    </div>

    @if ($puede_editar == true)
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
                           placeholder="Nombre del socio"
                           value="{{ $nombre_socio }}">
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
                           placeholder="Número de socio"
                           value="{{ $numero_socio }}">
                </div>

                <div class="input-group">
                    <label class="input-label">DNI</label>
                    <input type="text" 
                           wire:model="dni"
                           class="modern-input"
                           name="dni" 
                           placeholder="DNI"
                           value="{{ $dni }}">
                </div>

                <div class="input-group full-width">
                    <label class="input-label">Dirección</label>
                    <input type="text" 
                           wire:model="direccion"
                           class="modern-input"
                           name="direccion" 
                           placeholder="Dirección"
                           value="{{ $direccion }}">
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
                                   placeholder="Teléfono {{ $telefonoIndex + 1 }}"
                                   value="{{ $telefono['telefono'] ?? '' }}">
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
    @else
        <div class="form-section-card">
            <h3>No se puede editar</h3>
            <p>Puede editar: {{ $puede_editar ? 'true' : 'false' }}</p>
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

@include('livewire.socio.edit-component-styles')

