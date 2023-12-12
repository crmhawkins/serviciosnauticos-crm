<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;
use App\Models\Socio;

class TablaComponent extends Component
{
    public $socios;
    public $vista;
    public function mount()
    {
        switch ($this->vista) {
            case 1:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
                break;
            case 2:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->where('situacion_barco', 0)->get();
                break;
            case 3:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->where('situacion_barco', 1)->get();
                break;
            case 4:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 1)->where('situacion_persona', 0)->get();
                break;
            case 5:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 1)->where('situacion_persona', 1)->get();
                break;
            default:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
                break;
        }
    }
    public function render()
    {
        return view('livewire.socio.tabla-component');
    }
}
