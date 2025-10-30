<div class="modern-index-container">
    <div class="header-section">
        <div class="header-content">
            <div class="title-section">
                <h1 class="page-title">
                    <i class="fas fa-flag"></i>
                    Selecciona un club
                </h1>
                <p class="page-subtitle">Elige el club con el que quieres trabajar</p>
            </div>
        </div>
        <div class="breadcrumb-section">
            <nav class="breadcrumb">
                <a href="javascript:void(0);" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-flag"></i>
                    Selección de club
                </span>
            </nav>
        </div>
    </div>

    <div class="content-section p-4">
        <div class="club-grid">
        @foreach ($clubs as $club)
                <div class="club-card h-100">
                    <button type="button" class="btn club-card__btn w-100"
                            wire:click.prevent="seleccionarClub('{{ $club->id }}')">
                        <h3 class="text-center club-card__title">{{ strtoupper($club->nombre) }}</h3>
                        @php
                            $logoPath = $club->club_logo ? asset('assets/images/' . $club->club_logo) : asset('assets/images/club-placeholder.svg');
                            $fallback = asset('assets/images/club-placeholder.svg');
                        @endphp
                        <div class="club-card__image-wrap">
                            <img class="club-card__image" src="{{ $logoPath }}" alt="Logo {{ $club->nombre }}"
                                onerror="this.onerror=null;this.src='{{ $fallback }}';">
                        </div>
                        </button>
                </div>
            @endforeach
            </div>
    </div>
@if (is_null(Auth::user()->proteccion))
    <div class="modal" id="proteccionDatosModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ley de Protección de Datos</h5>
                </div>
                <div class="modal-body">
                    <p>Texto sobre la ley de protección de datos...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="aceptarProteccion">Aceptar</button>
                    <button type="button" class="btn btn-secondary" wire:click="rechazarProteccion">Rechazar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            $('#proteccionDatosModal').modal('show');
        });
    </script>
@endif
</div>
