<?php

namespace App\Http\Livewire\Club;

use Livewire\Component;
use App\Models\Club;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Socio;
use App\Models\UserClub;

class EditComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $identificador;
    public $ruta_foto;
    public $club_logo;
    public $nombre;
    public $email;

    public function mount()
    {
        $club = Club::find($this->identificador);
        $this->nombre = $club->nombre;
        $this->ruta_foto = $club->club_logo;
        $this->email = $club->email;
        $this->club_logo = $club->club_logo;
    }
    public function render()
    {
        return view('livewire.club.edit-component');
    }
    public function update()
    {
        if ($this->ruta_foto != $this->club_logo) {

            $name = 'logo_club' . $this->identificador . '.png';

            $this->ruta_foto->storePubliclyAs('public', 'assets/images/' . $name);

            $this->club_logo = $name;
        }

        $validatedData = $this->validate(
            [
                'club_logo' => 'required',
                'nombre' => 'required',
                'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],

            ],
            // Mensajes de error
            [
                'name.required' => 'El nombre es obligatorio.',
                'ruta_foto.required' => 'El logotipo es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
            ]
        );
        $club = Club::find($this->identificador);

        $clubSave = $club->update($validatedData);

        // Alertas de guardado exitoso
        if ($clubSave) {
            $this->alert('success', '¡Club registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del club!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }
    public function getListeners()
    {
        return [
            'confirmed',
            'update',
            'destroy',
            'confirmDelete'
        ];
    }
    public function destroy()
    {

        $this->alert('warning', '¿Seguro que desea borrar el usuario? No hay vuelta atrás', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmDelete',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }
    public function confirmDelete()
    {
        $club = Club::find($this->identificador);
        $socios = Socio::where('club_id', $this->identificador)->delete();
        $user_clubs = UserClub::where('club_id', $this->identificador)->delete();
        $club->delete();
        return redirect()->route('club.index');
    }
    public function confirmed()
    {
        // Do something
        return redirect()->route('club.index');
    }
}
