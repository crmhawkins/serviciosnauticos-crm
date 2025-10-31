<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;
use App\Models\Socio;
use App\Models\telefonos;

class TablaComponent extends Component
{
    public $socios;
    public $telefonos;
    public $vista;
    public $orderBy = 'nombre_socio';
    public $orderDir = 'asc';
    public function mount()
    {
        $this->loadSocios();
    }

    protected $listeners = ['sociosOrderChanged' => 'applyOrder'];

    protected function loadSocios(): void
    {
        switch ($this->vista) {
            case 1:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('alta_baja', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 2:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 0)
                    ->where('alta_baja', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 3:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 0)
                    ->where('alta_baja', 0)
                    ->where('situacion_barco', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 4:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 0)
                    ->where('alta_baja', 0)
                    ->where('situacion_barco', 1)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 5:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('alta_baja', 1)
                    ->where('situacion_persona', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;

            case 6:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 1)
                    ->where('alta_baja', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 7:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 1)
                    ->where('alta_baja', 0)
                    ->where('situacion_barco', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 8:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 1)
                    ->where('alta_baja', 0)
                    ->where('situacion_barco', 1)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 9:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('alta_baja', 1)
                    ->where('situacion_persona', 1)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            case 10:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('situacion_persona', 2)
                    ->where('alta_baja', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
            default:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                    ->where('alta_baja', 0)
                    ->with('telefonos') // Carga la relación de teléfonos
                    ->orderBy($this->orderBy, $this->orderDir)
                    ->get();
                break;
        }
    }

    public function updated($name, $value): void
    {
        if (in_array($name, ['orderBy', 'orderDir', 'vista'])) {
            $this->loadSocios();
        }
    }

    public function applyOrder(string $orderBy, string $orderDir): void
    {
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
        $this->loadSocios();
    }
    public function render()
    {
        return view('livewire.socio.tabla-component');
    }
}
