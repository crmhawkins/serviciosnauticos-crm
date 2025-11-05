<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class IndexComponent extends Component
{
    // public $search;
    public $usuarios;

    public function mount()
    {
        $this->usuarios = User::all();
    }

    public function render()
    {

        return view('livewire.usuarios.index-component');
    }

    public function getRole($id)
    {
        switch ($id) {
            case 1:
                return 'Administrador';
                break;
            case 2:
                return 'Secretaría';
                break;
            case 3:
                return 'Comodoro';
                break;
            case 4:
                return 'Marinero';
                break;
            case 5:
                return 'Acceso info';
                break;
            case 6:
                return 'Policía Nacional';
                break;
            case 7:
                return 'Guardia Civil';
                break;
            default:
                return '';
                break;
        }
    }
}
