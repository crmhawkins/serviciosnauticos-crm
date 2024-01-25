<?php

namespace App\Http\Livewire\Socio;

use App\Models\Socio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Telefonos;
use App\Models\NumerosLlave;
use App\Models\RegistrosEntrada;
use App\Models\RegistrosEntradaTranseunte;
use App\Models\TranseunteTripulantes;

class CreateComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $club_id = 1;
    public $situacion_persona = 0;
    public $situacion_barco = 0;
    public $numero_socio;
    public $nombre_socio;
    public $dni;
    public $direccion;
    public $telefonos = [];
    public $numeros_llave = [];
    public $tripulantes = [];
    public $registros_transeunte = [];
    public $registros_entrada = [];
    public $registros_barco = [];
    public $email;
    public $pantalan_t_atraque;
    public $nombre_barco;
    public $matricula;
    public $eslora;
    public $manga;
    public $calado;
    public $seguro_barco;
    public $poliza;
    public $vencimiento;
    public $itb;
    public $ruta_foto;
    public $ruta_foto2;
    public $alta_baja = 0; //Alta = 0, Baja = 1
    public $pin_socio;
    public $fecha_entrada;
    public $fecha_entrada_transeunte;
    public $puntal;
    public $atraque_fijo;

    public function mount()
    {
        $this->telefonos[] = ['telefono' => ''];
        $this->numeros_llave[] = ['numero_llave' => ''];
        $this->pin_socio = rand(0, 999999);
    }
    public function render()
    {
        return view('livewire.socio.create-component');
    }

    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate(
            [
                'club_id' => 'required',
                'situacion_persona' => 'required',
                'situacion_barco' => 'required',
                'numero_socio' => 'required',
                'nombre_socio' => 'required',
                'dni' => 'required',
                'direccion' => 'required',
                'email' => 'required',
                'pantalan_t_atraque' => 'required',
                'nombre_barco' => 'required',
                'matricula' => 'required',
                'eslora' => 'required',
                'manga' => 'required',
                'calado' => 'nullable',
                'seguro_barco' => 'required',
                'poliza' => 'required',
                'vencimiento' => 'required',
                'itb' => 'required',
                'ruta_foto' => 'nullable',
                'ruta_foto2' => 'nullable',
                'pin_socio' => 'required',
                'alta_baja' => 'required',
                'atraque_fijo' => 'required',

            ],
            // Mensajes de error
            [
                'club_id.required' => 'required',
                'situacion_persona.required' => 'required',
                'situacion_barco.required' => 'required',
                'numero_socio.required' => 'required',
                'nombre_socio.required' => 'required',
                'dni.required' => 'required',
                'direccion.required' => 'required',
                'email.required'  => 'required',
                'pantalan_t_atraque.required' => 'required',
                'nombre_barco.required' => 'required',
                'matricula.required' => 'required',
                'eslora.required' => 'required',
                'manga.required' => 'required',
                'calado.required' => 'required',
                'seguro_barco.required' => 'required',
                'poliza.required' => 'required',
                'vencimiento.required' => 'required',
                'itb.required' => 'required',
                'ruta_foto.required' => 'required',
                'ruta_foto2.required' => 'required',
                'pin_socio.required' => 'required',
                'alta_baja.required' => 'required',
                'atraque_fijo.required' => 'required',

            ]
        );
        $name = md5($this->ruta_foto . microtime()) . '.' . $this->ruta_foto->extension();

        $this->ruta_foto->storePubliclyAs('storage/photos/', $name);

        $validatedData['ruta_foto'] = $name;

        $name = md5($this->ruta_foto2 . microtime()) . '.' . $this->ruta_foto2->extension();

        $this->ruta_foto2->storePubliclyAs('storage/photos/', $name);

        $validatedData['ruta_foto2'] = $name;
        // Guardar datos validados
        $socioSave = Socio::create($validatedData);
        RegistrosEntrada::create(['socio_id' => $socioSave->id, 'fecha_entrada' => $this->fecha_entrada, 'estado' => 0]);

        foreach ($this->telefonos as $telefonoIndex => $telefono) {
            $nuevo_telefono = Telefonos::create(['socio_id' => $socioSave->id, 'telefono' => $telefono['telefono']]);
        }
        foreach ($this->numeros_llave as $llaveIndex => $numero_llave) {
            $nuevo_num_llave = NumerosLlave::create(['socio_id' => $socioSave->id, 'num_llave' => $numero_llave['numero_llave']]);
        }
        if($this->situacion_persona == 1){
            foreach ($this->tripulantes as $tripulanteIndex => $tripulante) {
                $nuevo_tripulante = TranseunteTripulantes::create(['socio_id' => $socioSave->id, 'nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
            }
            RegistrosEntradaTranseunte::create(['socio_id' => $socioSave->id, 'fecha_entrada' => $this->fecha_entrada, 'estado' => 0]);
        }


        // Alertas de guardado exitoso
        if ($socioSave) {
            $this->alert('success', '¡Socio registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del socio!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function cambiarSituacionBarco($situacion)
    {
        $this->situacion_barco = $situacion;
    }
    public function cambiarSituacionPersona($situacion)
    {
        $this->situacion_persona = $situacion;
    }

    public function checkAtraque()
    {
        $socio = Socio::where('pantalan_t_atraque', 'LIKE', '%' . $this->pantalan_t_atraque . '%')->where('situacion_barco', 1)->first();
        if($socio != null){

        }
    }

    public function addTripulante()
    {
        $this->tripulantes[] = ['nombre' => '', 'dni' => ''];
    }

    public function deleteTripulante($id)
    {
        if (count($this->tripulantes) <= 0) {
            $this->alert('warning', 'Añade otro tripulante para eliminar el seleccionado.');
        } else {
            unset($this->tripulantes[$id]);
            $this->tripulantes = array_values($this->tripulantes);
        }
    }
    public function addTelefono()
    {
        $this->telefonos[] = ['telefono' => ''];
    }

    public function deleteTelefono($id)
    {
        if (count($this->telefonos) <= 1) {
            $this->alert('warning', 'Añade otro teléfono para eliminar el seleccionado.');
        } else {
            unset($this->telefonos[$id]);
            $this->telefonos = array_values($this->telefonos);
        }
    }

    public function addNumeroLlave()
    {
        $this->numeros_llave[] = ['numero_llave' => ''];
    }
    public function deleteNumeroLlave($id)
    {
        if (count($this->numeros_llave) <= 1) {
            $this->alert('warning', 'Añade otro nº de llave para eliminar el seleccionado.');
        } else {
            unset($this->numeros_llave[$id]);
            $this->numeros_llave = array_values($this->numeros_llave);
        }
    }
    public function alertaGuardar()
    {
        $this->alert('warning', 'Asegúrese de que todos los datos son correctos antes de guardar.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'submit',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }
    public function getListeners()
    {
        return [
            'submit',
            'confirmed',
            'alertaGuardar'

        ];
    }

    public function confirmed()
    {
        // Do something
        return redirect()->route('socios.index');
    }
}
