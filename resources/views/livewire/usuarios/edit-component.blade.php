<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-user-edit"></i>
                    Editar usuario {{ $name }}
                </h1>
                <p class="page-subtitle">Modifica los datos del usuario seleccionado</p>
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
                    <i class="fas fa-users"></i>
                    Usuarios
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-user-edit"></i>
                    Editar usuario {{ $name }}
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
                        Información del usuario
                    </h3>
                </div>
                <div class="form-content">
                    <form wire:update.prevent="update">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Alias</label>
                                <input type="text" wire:model="name" class="form-input" name="name" 
                                    id="name" placeholder="José Carlos...">
                                    @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="surname" class="form-label">Nombre Completo</label>
                                <input type="text" wire:model="surname" class="form-input" name="surname" 
                                    id="surname" placeholder="Pérez...">
                                    @error('surname')
                                    <span class="form-error">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" wire:model="email" class="form-input" name="email" 
                                id="email" placeholder="jose85@hotmail.com">
                                    @error('email')
                                <span class="form-error">{{ $message }}</span>
                                    @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Clubes</label>
                                <div class="checkbox-group">
                                    @foreach ($clubs as $club)
                                        <label class="checkbox-item">
                                            <input type="checkbox" value="{{ $club->id }}"
                                                wire:model.defer="user_clubs.{{ $club->id }}">
                                            <span class="checkbox-label">{{ $club->nombre }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('user_department_id')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role" class="form-label">Rol</label>
                                <div x-data="" x-init="$nextTick( () => { 
                                    $('#select2-role').select2();
                                $('#select2-role').on('change', function(e) {
                                    var data = $('#select2-role').select2('val');
                                    @this.set('role', data);
                                    }); 
                                });" wire:key="{{time()}}">
                                    <select id="select2-role" class="form-input js-example-responsive"
                                        wire:model.defer="role">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" wire:model="username" class="form-input" name="username" 
                                id="username" placeholder="jose85">
                                    @error('username')
                                <span class="form-error">{{ $message }}</span>
                                    @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña nueva</label>
                            <div class="password-input-wrapper">
                                <input type="password" wire:model="password" class="form-input" 
                                    name="password" id="password" placeholder="123456...">
                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye" id="eye-icon"></i>
                                </button>
                            </div>
                            @error('password')
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
                        <i class="fas fa-save"></i>
                        <span>Guardar usuario</span>
                    </button>
                    <button class="btn-action btn-delete" wire:click="destroy">
                        <i class="fas fa-trash"></i>
                        <span>Eliminar usuario</span>
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
            text: 'Pulsa el botón de confirmar para guardar los datos del usuario.',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('update');
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
