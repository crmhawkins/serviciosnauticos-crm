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
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\HandlesErrors;

class CreateComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use HandlesErrors;
    public $club_id;
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
    public $atraque_fijo= 0;

    public function mount()
    {
        $this->club_id= session()->get('clubSeleccionado');
        $this->telefonos[] = ['telefono' => ''];
        $this->numeros_llave[] = ['numero_llave' => ''];
        $this->pin_socio = rand(0, 999999);
        $this->fecha_entrada = date('Y-m-d');;

    }
    public function render()
    {
        return view('livewire.socio.create-component');
    }

    public function submit()
    {
        try {
            // Validación de datos
            $validatedData = $this->validate(
                [
                    'club_id' => 'required',
                    'situacion_persona' => 'required',
                    'situacion_barco' => 'required',
                    'numero_socio' => 'nullable',
                    'nombre_socio' => 'required',
                    'dni' => 'nullable',
                    'direccion' => 'nullable',
                    'email' => 'nullable',
                    'pantalan_t_atraque' => 'nullable',
                    'nombre_barco' => 'nullable',
                    'matricula' => 'nullable',
                    'eslora' => 'nullable',
                    'manga' => 'nullable',
                    'calado' => 'nullable',
                    'seguro_barco' => 'nullable',
                    'poliza' => 'nullable',
                    'vencimiento' => 'nullable',
                    'itb' => 'nullable',
                    'ruta_foto' => 'nullable',
                    'ruta_foto2' => 'nullable',
                    'pin_socio' => 'nullable',
                    'alta_baja' => 'required',
                    'atraque_fijo' => 'nullable',

                ],
                // Mensajes de error
                [
                    'club_id.required' => 'El club es obligatorio.',
                    'situacion_persona.required' => 'La situación de persona es obligatoria.',
                    'situacion_barco.required' => 'La situación del barco es obligatoria.',
                    'nombre_socio.required' => 'El nombre del socio es obligatorio.',
                    'alta_baja.required' => 'El estado de alta/baja es obligatorio.',
                ]
            );
        if($this->ruta_foto){
            $targetWidth = 800;
            $sourcePath = $this->ruta_foto->path();
            list($width, $height) = getimagesize($sourcePath);
            $ratio = $height / $width;
            $targetHeight = $targetWidth * $ratio;

            // Crear una imagen en blanco con las dimensiones objetivo
            $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

            // Cargar la imagen original
            $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));

            // Redimensionar la imagen original en la imagen objetivo
            imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

            // Guardar la imagen redimensionada
            $name = md5($this->ruta_foto . microtime()) . '.' . $this->ruta_foto->extension();
            $tempPath = sys_get_temp_dir() . '/' . $name;
            imagejpeg($targetImage, $tempPath, 75); // 75 es la calidad de JPEG

            // Mover la imagen al almacenamiento
            Storage::disk('public')->put('assets/images/' . $name, file_get_contents($tempPath));

            // Limpiar
            imagedestroy($sourceImage);
            imagedestroy($targetImage);
            unlink($tempPath);

            $validatedData['ruta_foto'] = $name;
        }
        if($this->ruta_foto2){
            $targetWidth = 800;
            $sourcePath = $this->ruta_foto2->path();
            list($width, $height) = getimagesize($sourcePath);
            $ratio = $height / $width;
            $targetHeight = $targetWidth * $ratio;

            // Crear una imagen en blanco con las dimensiones objetivo
            $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

            // Cargar la imagen original
            $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));

            // Redimensionar la imagen original en la imagen objetivo
            imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

            // Guardar la imagen redimensionada
            $name = md5($this->ruta_foto2 . microtime()) . '.' . $this->ruta_foto2->extension();
            $tempPath = sys_get_temp_dir() . '/' . $name;
            imagejpeg($targetImage, $tempPath, 75); // 75 es la calidad de JPEG

            // Mover la imagen al almacenamiento
            Storage::disk('public')->put('assets/images/' . $name, file_get_contents($tempPath));

            // Limpiar
            imagedestroy($sourceImage);
            imagedestroy($targetImage);
            unlink($tempPath);

            $validatedData['ruta_foto2'] = $name;
        }
        
        // Guardar datos validados
        $socioSave = Socio::create($validatedData);
        RegistrosEntrada::create(['socio_id' => $socioSave->id, 'fecha_entrada' => $this->fecha_entrada, 'estado' => 0]);

        // Limpiar y guardar solo teléfonos válidos
        $telefonosLimpios = $this->limpiarTelefonos($this->telefonos);
        foreach ($telefonosLimpios as $telefono) {
            Telefonos::create(['socio_id' => $socioSave->id, 'telefono' => $telefono]);
        }

        // Guardar números de llave (filtrar vacíos)
        foreach ($this->numeros_llave as $llaveIndex => $numero_llave) {
            if (!empty(trim($numero_llave['numero_llave']))) {
                NumerosLlave::create(['socio_id' => $socioSave->id, 'num_llave' => $numero_llave['numero_llave']]);
            }
        }

        // Guardar tripulantes si es transeúnte
        if($this->situacion_persona == 1){
            foreach ($this->tripulantes as $tripulanteIndex => $tripulante) {
                if (!empty(trim($tripulante['nombre'])) && !empty(trim($tripulante['dni']))) {
                    TranseunteTripulantes::create(['socio_id' => $socioSave->id, 'nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
                }
            }
        }

        // Mostrar mensaje de éxito
        $this->showSuccessModal('¡Socio creado correctamente!', 'El socio ha sido registrado exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Los errores de validación se muestran inline automáticamente
            throw $e;
            
        } catch (\Exception $e) {
            $this->handleException($e, 'creación de socio');
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
