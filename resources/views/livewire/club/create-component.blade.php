<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-building"></i>
                    Añadir nuevo club
                </h1>
                <p class="page-subtitle">Crea un club con su información básica y logotipo</p>
            </div>
        </div>
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-building"></i>
                    Club
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-plus-circle"></i>
                    Añadir nuevo club
                </span>
            </nav>
            </div>
    </div>

    <div class="form-layout">
        <div class="form-main">
            <div class="form-card">
                <div class="form-header">
                    <h3 class="form-title">
                        <i class="fas fa-info-circle"></i>
                        Información del club
                    </h3>
                </div>
                <div class="form-content">
                    <form wire:submit.prevent="submit">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" wire:model.defer="nombre" class="form-input" name="nombre" id="nombre" placeholder="Club Náutico...">
                                    @error('nombre')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model.defer="email" class="form-input" name="email" id="email" placeholder="jose85@hotmail.com">
                                    @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group image-upload-section">
                            <label class="form-label">Logotipo del club</label>

                                @if ($ruta_foto)
                                <div class="image-preview">
                                    <img class="preview-image" src="{{ $ruta_foto->temporaryUrl() }}" alt="Vista previa del logotipo">
                                </div>
                            @endif

                            <div class="file-input-wrapper">
                                <label for="ruta_foto" class="file-input-label">
                                    <i class="fas fa-upload"></i>
                                    Seleccionar archivo
                                </label>
                                <input type="file" wire:model="ruta_foto" name="ruta_foto" id="ruta_foto" accept="image/*">
                            </div>
                            @error('ruta_foto')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="form-sidebar">
            <div class="actions-card">
                <div class="actions-header">
                    <h3 class="actions-title">
                        <i class="fas fa-cogs"></i>
                        Acciones
                    </h3>
                        </div>
                <div class="actions-content">
                    <button class="btn-action btn-save" id="alertaGuardar">
                        <i class="fas fa-plus"></i>
                        <span>Crear nuevo club</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        document.getElementById('alertaGuardar').addEventListener('click', function () {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para crear el nuevo club.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('submit');
                }
            });
        });
    </script>
@endsection
