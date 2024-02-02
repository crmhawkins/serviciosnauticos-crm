<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;
use App\Models\Socio;
use App\Models\telefonos;

class TablaAdminComponent extends Component
{
    public $socios;
    public $telefonos;
    public $vista;
    public function mount()
    {
        switch ($this->vista) {
            case 1:
                $this->socios = Socio::where('alta_baja', 0)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
            case 2:
                $this->socios = Socio::where('alta_baja', 0)
                     ->where('situacion_barco', 0)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
            case 3:
                $this->socios = Socio::where('alta_baja', 0)
                     ->where('situacion_barco', 1)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
            case 4:
                $this->socios = Socio::where('alta_baja', 1)
                     ->where('situacion_persona', 0)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
            case 5:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
                     ->where('alta_baja', 1)
                     ->where('situacion_persona', 1)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
            default:
                $this->socios = Socio::where('alta_baja', 0)
                     ->with('telefonos') // Carga la relación de teléfonos
                     ->get();
                break;
        }
    }
    public function render()
    {
        return view('livewire.socio.tabla-admin-component');
    }
}
