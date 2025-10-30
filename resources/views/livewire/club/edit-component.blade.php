<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-building"></i>
                    Editar club {{ $nombre }}
                </h1>
                <p class="page-subtitle">Modifica los datos del club seleccionado</p>
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
                    <i class="fas fa-edit"></i>
                    Editar club
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
                                <label for="nombre" class="form-label">Nombre del club</label>
                                <input type="text" wire:model.defer="nombre" class="form-input" name="nombre"
                                        id="nombre" placeholder="Club Náutico...">
                                    @error('nombre')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model.defer="email" class="form-input" name="email"
                                    id="email" placeholder="jose85@hotmail.com">
                                    @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ruta_foto" class="form-label">Logotipo del club</label>
                            <div class="image-upload-section">
                                @if (!is_string($ruta_foto))
                                    <div class="image-preview">
                                        <img src="{{ $ruta_foto->temporaryUrl() }}" alt="Vista previa" class="preview-image">
                                    </div>
                                @else
                                    <div class="image-preview">
                                        <img src="{{ asset('assets/images/' . $ruta_foto) }}" alt="Logo actual" class="preview-image">
                                </div>
                                @endif
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-input" wire:model="ruta_foto" name="ruta_foto"
                                        id="ruta_foto" accept="image/*">
                                    <label for="ruta_foto" class="file-input-label">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>Seleccionar imagen</span>
                                    </label>
                                </div>
                                @error('ruta_foto')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
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
                        <i class="fas fa-save"></i>
                        <span>Guardar datos</span>
                    </button>
                    <button class="btn-action btn-delete" id="alertaEliminar">
                        <i class="fas fa-trash"></i>
                        <span>Eliminar club</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $("#alertaGuardar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para guardar los datos.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('update');
                }
            });
        });
        $("#alertaEliminar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Estás seguro de que quieres borrar este club?',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('destroy');
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
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        document.addEventListener('livewire:load', function() {


        })
        $(document).ready(function() {
            console.log('select2')
            $("#datepicker").datepicker();

            $("#datepicker").on('change', function(e) {
                @this.set('fecha_nac', $('#datepicker').val());
            });

        });

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
    </script>
@endsection
