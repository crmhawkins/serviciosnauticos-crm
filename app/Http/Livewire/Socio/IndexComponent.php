<?php

namespace App\Http\Livewire\Socio;

use Livewire\Component;
use App\Models\Socio;

class IndexComponent extends Component
{
    public $socios;
    public $vista = 1;
    protected $listeners = ['refreshComponent' => '$refresh', 'cambiarVista'];
    public function mount()
    {
        $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
    }
    public function render()
    {
        return view('livewire.socio.index-component');
    }

    public function cambiarVista()
    {
        switch ($this->vista) {
            case 0:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
                break;
            case 1:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->where('situacion_barco', 0)->get();
                break;
            case 2:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->where('situacion_barco', 1)->get();
                break;
            case 3:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 1)->where('situacion_persona', 0)->get();
                break;
            case 4:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 1)->where('situacion_persona', 1)->get();
                break;
            default:
                $this->socios = Socio::where('club_id', session()->get('clubSeleccionado'))->where('alta_baja', 0)->get();
                break;
        }
        $this->emit('refreshComponent');
    }
}
