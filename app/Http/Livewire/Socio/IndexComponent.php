<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;
use App\Models\Socio;

class IndexComponent extends Component
{
    public $socios;
    public $vista = 1;
    public $orderBy = 'nombre_socio';
    public $orderDir = 'asc';
    //protected $listeners = ['refreshComponent' => '$refresh', 'cambiarVista'];
    public function mount()
    {
        $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
    }
    public function render()
    {
        return view('livewire.socio.index-component');
    }

    public function updatedOrderBy($value)
    {
        $this->emit('sociosOrderChanged', $this->orderBy, $this->orderDir);
    }

    public function updatedOrderDir($value)
    {
        $this->emit('sociosOrderChanged', $this->orderBy, $this->orderDir);
    }

    // public function cambiarVista()
    // {
    //     switch ($this->vista) {
    //         case 1:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('alta_baja', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 2:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 0)
    //                 ->where('alta_baja', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 3:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 0)
    //                 ->where('alta_baja', 0)
    //                 ->where('situacion_barco', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 4:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 0)
    //                 ->where('alta_baja', 0)
    //                 ->where('situacion_barco', 1)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 5:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('alta_baja', 1)
    //                 ->where('situacion_persona', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;

    //         case 6:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 1)
    //                 ->where('alta_baja', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 7:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 1)
    //                 ->where('alta_baja', 0)
    //                 ->where('situacion_barco', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 8:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 1)
    //                 ->where('alta_baja', 0)
    //                 ->where('situacion_barco', 1)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 9:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('alta_baja', 1)
    //                 ->where('situacion_persona', 1)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         case 10:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('situacion_persona', 2)
    //                 ->where('alta_baja', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //         default:
    //             $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))
    //                 ->where('alta_baja', 0)
    //                 ->with('telefonos') // Carga la relación de teléfonos
    //                 ->get();
    //             break;
    //     }
    //     $this->emit('refreshComponent');
    // }
}
