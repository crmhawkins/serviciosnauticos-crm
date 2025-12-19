<div class="modern-form-container">
    <!-- Header -->
    <div class="form-header">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-user-plus"></i>
                    Añadir Socio
                </h1>
                <p class="page-subtitle">Registra un nuevo socio o transeúnte en el club</p>
            </div>
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
                        <i class="fas fa-user-plus"></i>
                        Crear socio/transeúnte
                    </span>
                </nav>
            </div>
        </div>
    </div>

    <div class="form-layout">
        <!-- Main Form -->
        <div class="form-main">
            <!-- Situación del Barco -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-ship"></i>
                        Situación del Barco
                    </h3>
                </div>
                <div class="status-buttons">
                    <button type="button" 
                            class="status-btn status-barco-atraque {{ $situacion_barco == 0 ? 'active' : '' }}"
                            wire:click="cambiarSituacionBarco(0)">
                        <i class="fas fa-anchor"></i>
                        <span>Barco en Atraque</span>
                    </button>
                    <button type="button" 
                            class="status-btn status-barco-varada {{ $situacion_barco == 1 ? 'active' : '' }}"
                            wire:click="cambiarSituacionBarco(1)">
                        <i class="fas fa-tools"></i>
                        <span>Barco en Varada</span>
                    </button>
                </div>
                @error('situacion_barco')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Situación de Persona -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Tipo de Persona
                    </h3>
                </div>
                <div class="status-buttons">
                    <button type="button" 
                            class="status-btn status-persona-socio {{ $situacion_persona == 0 ? 'active' : '' }}"
                            wire:click="cambiarSituacionPersona(0)">
                        <i class="fas fa-user"></i>
                        <span>Socio</span>
                    </button>
                    <button type="button" 
                            class="status-btn status-persona-mixto {{ $situacion_persona == 2 ? 'active' : '' }}"
                            wire:click="cambiarSituacionPersona(2)">
                        <i class="fas fa-users"></i>
                        <span>Socio/Transeúnte</span>
                    </button>
                    <button type="button" 
                            class="status-btn status-persona-transeunte {{ $situacion_persona == 1 ? 'active' : '' }}"
                            wire:click="cambiarSituacionPersona(1)">
                        <i class="fas fa-user-clock"></i>
                        <span>Transeúnte</span>
                    </button>
                </div>
                @error('situacion_persona')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Datos Personales -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-id-card"></i>
                        Datos Personales
                    </h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i>
                            Fecha de Entrada
                        </label>
                        <input type="date" 
                               wire:model="fecha_entrada" 
                               class="form-input"
                               name="fecha_entrada">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label required">
                            <i class="fas fa-user"></i>
                            Nombre del Socio
                        </label>
                        <input type="text" 
                               wire:model="nombre_socio" 
                               class="form-input"
                               name="nombre_socio" 
                               placeholder="Ingresa el nombre completo">
                        @error('nombre_socio')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-hashtag"></i>
                            Número de Socio
                        </label>
                        <input type="number" 
                               wire:model="numero_socio" 
                               class="form-input"
                               name="numero_socio" 
                               placeholder="Número de socio">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-key"></i>
                            PIN de Socio
                        </label>
                        <input type="number" 
                               wire:model="pin_socio" 
                               class="form-input"
                               name="pin_socio" 
                               placeholder="PIN de socio">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-id-card"></i>
                            DNI
                        </label>
                        <input type="text" 
                               wire:model="dni" 
                               class="form-input"
                               name="dni" 
                               placeholder="DNI">
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Dirección
                        </label>
                        <input type="text" 
                               wire:model="direccion" 
                               class="form-input"
                               name="direccion" 
                               placeholder="Dirección completa">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" 
                               wire:model="email" 
                               class="form-input"
                               name="email" 
                               placeholder="email@ejemplo.com">
                    </div>
                </div>
            </div>

            <!-- Teléfonos -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-phone"></i>
                        Teléfonos de Contacto
                    </h3>
                    <button type="button" 
                            class="btn-add"
                            wire:click="addTelefono">
                        <i class="fas fa-plus"></i>
                        Añadir Teléfono
                    </button>
                </div>
                <div class="dynamic-list">
                    @foreach ($telefonos as $telefonoIndex => $telefono)
                        <div class="dynamic-item">
                            <div class="item-content">
                                <label class="form-label">
                                    <i class="fas fa-phone"></i>
                                    Teléfono {{ $telefonoIndex + 1 }}
                                </label>
                                <input type="text" 
                                       wire:model="telefonos.{{ $telefonoIndex }}.telefono" 
                                       class="form-input"
                                       name="telefonos[{{ $telefonoIndex }}][telefono]"
                                       placeholder="+34 123 456 789">
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

            <!-- Datos del Barco -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-ship"></i>
                        Datos del Barco
                    </h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-anchor"></i>
                            Pantalán y Atraque
                        </label>
                        <input type="text" 
                               wire:model="pantalan_t_atraque" 
                               class="form-input"
                               name="pantalan_t_atraque" 
                               placeholder="Pantalán y Atraque">
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-ship"></i>
                            Nombre del Barco
                        </label>
                        <input type="text" 
                               wire:model="nombre_barco" 
                               class="form-input"
                               name="nombre_barco" 
                               placeholder="Nombre del barco">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-certificate"></i>
                            Matrícula
                        </label>
                        <input type="text" 
                               wire:model="matricula" 
                               class="form-input"
                               name="matricula" 
                               placeholder="Matrícula">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-ruler-horizontal"></i>
                            Eslora (m)
                        </label>
                        <input type="number" 
                               step="0.01"
                               wire:model="eslora" 
                               class="form-input"
                               name="eslora" 
                               placeholder="Eslora">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-ruler-vertical"></i>
                            Manga (m)
                        </label>
                        <input type="number" 
                               step="0.01"
                               wire:model="manga" 
                               class="form-input"
                               name="manga" 
                               placeholder="Manga">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-water"></i>
                            Calado (m)
                        </label>
                        <input type="number" 
                               step="0.01"
                               wire:model="calado" 
                               class="form-input"
                               name="calado" 
                               placeholder="Calado">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-arrows-alt-v"></i>
                            Puntal (m)
                        </label>
                        <input type="number" 
                               step="0.01"
                               wire:model="puntal" 
                               class="form-input"
                               name="puntal" 
                               placeholder="Puntal">
                    </div>
                </div>
            </div>

            <!-- Números de Llave -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-key"></i>
                        Números de Llave
                    </h3>
                    <button type="button" 
                            class="btn-add"
                            wire:click="addNumeroLlave">
                        <i class="fas fa-plus"></i>
                        Añadir Llave
                    </button>
                </div>
                <div class="dynamic-list">
                    @foreach ($numeros_llave as $llaveIndex => $numero_llave)
                        <div class="dynamic-item">
                            <div class="item-content">
                                <label class="form-label">
                                    <i class="fas fa-key"></i>
                                    Número de Llave {{ $llaveIndex + 1 }}
                                </label>
                                <input type="text" 
                                       wire:model="numeros_llave.{{ $llaveIndex }}.numero_llave" 
                                       class="form-input"
                                       name="numeros_llave[{{ $llaveIndex }}][numero_llave]"
                                       placeholder="Número de llave">
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

            <!-- Seguro del Barco -->
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-shield-alt"></i>
                        Seguro del Barco
                    </h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-shield-alt"></i>
                            Seguro Barco
                        </label>
                        <input type="text" 
                               wire:model="seguro_barco" 
                               class="form-input"
                               name="seguro_barco" 
                               placeholder="Compañía de seguros">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-file-contract"></i>
                            Póliza
                        </label>
                        <input type="text" 
                               wire:model="poliza" 
                               class="form-input"
                               name="poliza" 
                               placeholder="Número de póliza">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar-times"></i>
                            Vencimiento
                        </label>
                        <input type="date" 
                               wire:model="vencimiento" 
                               class="form-input"
                               name="vencimiento">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar-check"></i>
                            ITB
                        </label>
                        <input type="date" 
                               wire:model="itb" 
                               class="form-input"
                               name="itb">
                    </div>
                </div>
            </div>

            <!-- Cobros por Fechas (Solo si es transeúnte o socio/transeúnte) -->
            @if($situacion_persona == 1 || $situacion_persona == 2)
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Cobros por Fechas
                    </h3>
                    <button type="button" 
                            class="btn-add"
                            wire:click="addCobroTranseunte">
                        <i class="fas fa-plus"></i>
                        Añadir Cobro
                    </button>
                </div>
                <div class="dynamic-list">
                    @foreach ($cobros_transeunte as $cobroIndex => $cobro)
                        <div class="dynamic-item">
                            <div class="item-content" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:12px; width:100%;">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-check"></i>
                                        Fecha de Entrada
                                    </label>
                                    <input type="date" 
                                           wire:model="cobros_transeunte.{{ $cobroIndex }}.fecha_entrada" 
                                           class="form-input"
                                           name="cobros_transeunte[{{ $cobroIndex }}][fecha_entrada]">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-times"></i>
                                        Fecha de Salida
                                    </label>
                                    <input type="date" 
                                           wire:model="cobros_transeunte.{{ $cobroIndex }}.fecha_salida" 
                                           class="form-input"
                                           name="cobros_transeunte[{{ $cobroIndex }}][fecha_salida]">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-euro-sign"></i>
                                        Precio por Día
                                    </label>
                                    <input type="number" 
                                           step="0.01"
                                           wire:model="cobros_transeunte.{{ $cobroIndex }}.precio" 
                                           class="form-input"
                                           name="cobros_transeunte[{{ $cobroIndex }}][precio]"
                                           placeholder="0.00">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calculator"></i>
                                        Total
                                    </label>
                                    <input type="number" 
                                           step="0.01"
                                           wire:model="cobros_transeunte.{{ $cobroIndex }}.total" 
                                           class="form-input"
                                           name="cobros_transeunte[{{ $cobroIndex }}][total]"
                                           placeholder="0.00"
                                           readonly
                                           style="background:#f3f4f6;">
                                </div>
                            </div>
                            <button type="button" 
                                    class="btn-remove"
                                    wire:click="deleteCobroTranseunte({{ $cobroIndex }})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Tripulantes (Solo si es transeúnte) -->
            @if($situacion_persona == 1 || $situacion_persona == 2)
            <div class="form-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-users"></i>
                        Tripulantes
                    </h3>
                    <button type="button" 
                            class="btn-add"
                            wire:click="addTripulante">
                        <i class="fas fa-plus"></i>
                        Añadir Tripulante
                    </button>
                </div>
                <div class="dynamic-list">
                    @foreach ($tripulantes as $tripulanteIndex => $tripulante)
                        <div class="dynamic-item">
                            <div class="item-content">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i>
                                        Nombre del Tripulante {{ $tripulanteIndex + 1 }}
                                    </label>
                                    <input type="text" 
                                           wire:model="tripulantes.{{ $tripulanteIndex }}.nombre" 
                                           class="form-input"
                                           name="tripulantes[{{ $tripulanteIndex }}][nombre]"
                                           placeholder="Nombre del tripulante">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-id-card"></i>
                                        DNI del Tripulante
                                    </label>
                                    <input type="text" 
                                           wire:model="tripulantes.{{ $tripulanteIndex }}.dni" 
                                           class="form-input"
                                           name="tripulantes[{{ $tripulanteIndex }}][dni]"
                                           placeholder="DNI del tripulante">
                                </div>
                            </div>
                            <button type="button" 
                                    class="btn-remove"
                                    wire:click="deleteTripulante({{ $tripulanteIndex }})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="form-sidebar">
            <!-- Fotos -->
            <div class="sidebar-section">
                <h4 class="sidebar-title">
                    <i class="fas fa-images"></i>
                    Fotos
                </h4>
                
                <!-- Foto del Barco -->
                <div class="photo-upload">
                    <label class="photo-label">
                        <i class="fas fa-ship"></i>
                        Foto del Barco
                    </label>
                    @if ($ruta_foto)
                        <div class="photo-preview">
                            <img src="{{ $ruta_foto->temporaryUrl() }}" alt="Foto del barco">
                        </div>
                    @endif
                    <input type="file" 
                           wire:model="ruta_foto" 
                           class="photo-input"
                           name="ruta_foto" 
                           id="ruta_foto"
                           accept="image/*">
                    @error('ruta_foto')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Foto del Socio -->
                <div class="photo-upload">
                    <label class="photo-label">
                        <i class="fas fa-user"></i>
                        Foto del Socio
                    </label>
                    @if ($ruta_foto2)
                        <div class="photo-preview">
                            <img src="{{ $ruta_foto2->temporaryUrl() }}" alt="Foto del socio">
                        </div>
                    @endif
                    <input type="file" 
                           wire:model="ruta_foto2" 
                           class="photo-input"
                           name="ruta_foto2" 
                           id="ruta_foto2"
                           accept="image/*">
                    @error('ruta_foto2')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>
    </div>

    <!-- Botón Fixed de Guardar -->
    <div class="fixed-save-button">
        <button type="button" 
                class="btn-save-fixed"
                wire:click.prevent="submit">
            <i class="fas fa-save"></i>
            <span>Guardar Nuevo Socio</span>
        </button>
    </div>
</div>

<!-- Estilos CSS -->
<style>
/* Variables CSS del Design System */
:root {
    --primary-blue: #2563eb;
    --primary-blue-light: #3b82f6;
    --primary-blue-dark: #1d4ed8;
    --secondary-teal: #0d9488;
    --secondary-teal-light: #14b8a6;
    --secondary-teal-dark: #0f766e;
    --success-green: #10b981;
    --warning-orange: #f59e0b;
    --error-red: #ef4444;
    --info-blue: #06b6d4;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --space-1: 0.25rem;
    --space-2: 0.5rem;
    --space-3: 0.75rem;
    --space-4: 1rem;
    --space-5: 1.25rem;
    --space-6: 1.5rem;
    --space-8: 2rem;
    --space-10: 2.5rem;
    --space-12: 3rem;
    --space-16: 4rem;
    --font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    --font-size-xs: 0.75rem;
    --font-size-sm: 0.875rem;
    --font-size-base: 1rem;
    --font-size-lg: 1.125rem;
    --font-size-xl: 1.25rem;
    --font-size-2xl: 1.5rem;
    --font-size-3xl: 1.875rem;
    --transition-fast: 0.15s ease;
    --transition-normal: 0.2s ease;
    --transition-slow: 0.3s ease;
}

/* Reset y base */
.modern-form-container {
    font-family: var(--font-family);
    background: var(--gray-50);
    min-height: 100vh;
    padding: var(--space-6);
}

/* Header */
.form-header {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: var(--space-6);
    padding: var(--space-6);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.page-title {
    font-size: var(--font-size-3xl);
    font-weight: 700;
    color: var(--gray-900);
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.page-subtitle {
    color: var(--gray-600);
    margin: var(--space-1) 0 0 0;
    font-size: var(--font-size-base);
}

.breadcrumb {
    display: flex !important;
    align-items: center;
    gap: var(--space-1);
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
    flex-wrap: nowrap !important;
    background: transparent !important;
    border-radius: 0 !important;
    font-size: var(--font-size-sm);
    white-space: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    max-width: 100%;
    box-sizing: border-box;
}

.breadcrumb-item {
    color: var(--gray-500);
    text-decoration: none;
    font-size: var(--font-size-sm);
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-1);
    border-radius: 4px;
    transition: all var(--transition-normal);
    white-space: nowrap;
    flex-shrink: 0;
}

.breadcrumb-item:hover {
    color: var(--primary-blue);
    background: rgba(37, 99, 235, 0.1);
}

.breadcrumb-item.active {
    color: var(--gray-700);
    font-weight: 500;
    background: var(--gray-100);
}

.breadcrumb-separator {
    color: var(--gray-400);
    font-size: var(--font-size-sm);
    white-space: nowrap;
    flex-shrink: 0;
}

/* Layout principal */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: var(--space-6);
    max-width: 1400px;
    margin: 0 auto;
}

/* Formulario principal */
.form-main {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

/* Secciones del formulario */
.form-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--gray-200);
    padding: var(--space-6);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-6);
}

.section-title {
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

/* Botones de estado */
.status-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--space-4);
    margin-bottom: var(--space-4);
}

.status-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: 8px;
    background: white;
    color: var(--gray-600);
    font-weight: 500;
    transition: all var(--transition-normal);
    cursor: pointer;
}

.status-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Colores para Situación del Barco */
.status-barco-atraque {
    border-color: #22c55e !important;
    color: #22c55e !important;
}
.status-barco-atraque.active {
    background: #22c55e !important;
    color: white !important;
    border-color: #22c55e !important;
}
.status-barco-atraque:hover:not(.active) {
    border-color: #16a34a !important;
    color: #16a34a !important;
}

.status-barco-varada {
    border-color: #ef4444 !important;
    color: #ef4444 !important;
}
.status-barco-varada.active {
    background: #ef4444 !important;
    color: white !important;
    border-color: #ef4444 !important;
}
.status-barco-varada:hover:not(.active) {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
}

/* Colores para Tipo de Persona */
.status-persona-socio {
    border-color: #22c55e !important;
    color: #22c55e !important;
}
.status-persona-socio.active {
    background: #22c55e !important;
    color: white !important;
    border-color: #22c55e !important;
}
.status-persona-socio:hover:not(.active) {
    border-color: #16a34a !important;
    color: #16a34a !important;
}

.status-persona-transeunte {
    border-color: #ef4444 !important;
    color: #ef4444 !important;
}
.status-persona-transeunte.active {
    background: #ef4444 !important;
    color: white !important;
    border-color: #ef4444 !important;
}
.status-persona-transeunte:hover:not(.active) {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
}

.status-persona-mixto {
    border-color: #f59e0b !important;
    color: #f59e0b !important;
}
.status-persona-mixto.active {
    background: #f59e0b !important;
    color: white !important;
    border-color: #f59e0b !important;
}
.status-persona-mixto:hover:not(.active) {
    border-color: #d97706 !important;
    color: #d97706 !important;
}

.status-btn i {
    font-size: var(--font-size-xl);
}

/* Grid del formulario */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-4);
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-weight: 500;
    color: var(--gray-700);
    font-size: var(--font-size-sm);
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.form-label.required::after {
    content: '*';
    color: var(--error-red);
    margin-left: var(--space-1);
}

.form-input {
    padding: var(--space-3) var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: 8px;
    font-size: var(--font-size-base);
    transition: border-color var(--transition-normal);
    background: white;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Listas dinámicas */
.dynamic-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.dynamic-item {
    display: flex;
    align-items: flex-end;
    gap: var(--space-3);
    padding: var(--space-4);
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    background: var(--gray-50);
}

.item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

/* Botones */
.btn-add {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    background: var(--primary-blue);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: var(--font-size-sm);
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-add:hover {
    background: var(--primary-blue-dark);
    transform: translateY(-1px);
}

.btn-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: var(--error-red);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-remove:hover {
    background: #dc2626;
    transform: scale(1.1);
}

.btn-save {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    padding: var(--space-4) var(--space-6);
    background: var(--success-green);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: var(--font-size-base);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-save:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

/* Sidebar */
.form-sidebar {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

.sidebar-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--gray-200);
    padding: var(--space-6);
}

.sidebar-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 var(--space-4) 0;
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

/* Upload de fotos */
.photo-upload {
    margin-bottom: var(--space-4);
}

.photo-label {
    display: block;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: var(--space-2);
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.photo-input {
    width: 100%;
    padding: var(--space-3);
    border: 2px dashed var(--gray-300);
    border-radius: 8px;
    background: var(--gray-50);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.photo-input:hover {
    border-color: var(--primary-blue);
    background: rgba(37, 99, 235, 0.05);
}

.photo-preview {
    margin-bottom: var(--space-3);
}

.photo-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid var(--gray-200);
}

/* Mensajes de error */
.error-message {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--error-red);
    font-size: var(--font-size-sm);
    margin-top: var(--space-2);
}

/* Responsive */
@media (max-width: 1024px) {
    .form-layout {
        grid-template-columns: 1fr;
    }
    
    .form-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .modern-form-container {
        padding: var(--space-4);
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .status-buttons {
        grid-template-columns: 1fr;
    }
    
    .dynamic-item {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-remove {
        align-self: flex-end;
    }
    
    /* Breadcrumb más compacto en móvil */
    .breadcrumb {
        gap: 4px;
        font-size: 12px;
    }
    
    .breadcrumb-item {
        padding: 2px 4px;
        font-size: 12px;
    }
    
    .breadcrumb-item i {
        font-size: 10px;
    }
    
    .breadcrumb-separator {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: var(--font-size-2xl);
    }
    
    .section-title {
        font-size: var(--font-size-lg);
    }
    
    .form-section {
        padding: var(--space-4);
    }
}

/* Botón Fixed de Guardar */
.fixed-save-button {
    position: fixed;
    /* lo elevamos por encima del menú inferior de la app */
    bottom: 64px;
    left: 0;
    right: 0;
    background: white;
    border-top: 1px solid var(--gray-200);
    padding: var(--space-4);
    z-index: 1000;
    box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
}

.btn-save-fixed {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    background: var(--success-green);
    color: white;
    border: none;
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius-lg);
    font-size: var(--font-size-base);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    outline: none;
    position: relative;
}

.btn-save-fixed:hover {
    background: var(--success-green-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(34, 197, 94, 0.4);
}

.btn-save-fixed:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

.btn-save-fixed:focus {
    outline: none;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

.btn-save-fixed:focus:not(:active) {
    transform: none;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

.btn-save-fixed i {
    font-size: var(--font-size-lg);
}

/* Evitar que el botón se quede en estado activo */
.btn-save-fixed:not(:active):not(:focus) {
    transform: none;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    background: var(--success-green);
}

/* Reset del estado cuando no está siendo interactuado */
.btn-save-fixed:not(:hover):not(:active):not(:focus) {
    transform: none;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    background: var(--success-green);
}

/* Ajustar el padding del body para el botón fixed */
body {
    /* dejamos hueco para botón + menú inferior */
    padding-bottom: 140px;
}

@media (max-width: 768px) {
    .fixed-save-button {
        padding: var(--space-3);
        bottom: 72px;
    }
    
    .btn-save-fixed {
        padding: var(--space-3);
        font-size: var(--font-size-sm);
    }
    
    body {
        padding-bottom: 150px;
    }
}
</style>
