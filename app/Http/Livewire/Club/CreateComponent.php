<?php

namespace App\Http\Livewire\Club;

use Livewire\Component;
use App\Models\Club;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;

class CreateComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $ruta_foto;
    public $nombre;
    public $email;

    public function render()
    {
        return view('livewire.club.create-component');
    }
    public function submit()
    {
        $validatedData = $this->validate(
            [
                'ruta_foto' => 'required|image|max:5120',
                'nombre' => 'required',
                'email' => ['nullable', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],

            ],
            // Mensajes de error
            [
                'name.required' => 'El nombre es obligatorio.',
                'ruta_foto.required' => 'El logotipo es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
            ]
        );

        // Generar nombre temporal único para el logo
        $tempName = 'logo_club_' . time() . '_' . uniqid() . '.' . $this->ruta_foto->extension();
        
        // Guardar el logo primero
        $this->ruta_foto->storeAs('assets/images', $tempName, 'public');

        // Crear club con el logo
        $clubSave = Club::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'created_by' => Auth::id(),
            'club_logo' => $tempName,
        ]);

        // Renombrar el logo con el ID del club
        $finalName = 'logo_club' . $clubSave->id . '.' . $this->ruta_foto->extension();
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists('assets/images/' . $tempName)) {
            \Illuminate\Support\Facades\Storage::disk('public')->move('assets/images/' . $tempName, 'assets/images/' . $finalName);
            $clubSave->update(['club_logo' => $finalName]);
        }

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
