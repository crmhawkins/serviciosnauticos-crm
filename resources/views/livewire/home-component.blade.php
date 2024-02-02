<div class="container-fluid">
    <div class="page-title-box">
        <div class="row">
            <div class="col-sm-12">
                <h1 style="text-align: center">SELECCIONA UN CLUB</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($clubs as $club)
            <div class="col-sm-6 col-xl-4">
                <div class="card"
                    style="height: 90% !important; justify-content: center !important; align-items: center !important; flex-direction: row !important">
                    <div class="card-heading p-4">
                        <button type="button" class="btn"
                            wire:click.prevent="seleccionarClub('{{ $club->id }}')">
                            <h3 style="text-align: center !important">{{ $club->nombre }}</h3>
                            <img src='{{ asset('assets/images/' . $club->club_logo) }}' width="50%">
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
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
