<?php

namespace App\Http\Livewire\Club;

use Livewire\Component;
use App\Models\Club;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $ruta_foto;
    public $club_logo;
    public $nombre;
    public $email;

    public function render()
    {
        return view('livewire.club.create-component');
    }
    public function submit()
    {
        $this->club_logo = 'placeholder';

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

        $clubSave = Club::create($validatedData);

        $name = 'logo_club' . $clubSave->id . '.png';

        $this->ruta_foto->storePubliclyAs('public', 'assets/images/' . $name);

        $clubSave->update(['club_logo' => $name]);

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
            'submit'
        ];
    }
    public function confirmed()
    {
        // Do something
        return redirect()->route('club.index');
    }
}
