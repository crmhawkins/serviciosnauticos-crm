<?php

namespace App\Http\Livewire\Socio;

use App\Models\Nota;
use App\Models\Socio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Telefonos;
use App\Models\NumerosLlave;
use App\Models\RegistrosEntrada;
use App\Models\RegistrosEntradaTranseunte;
use App\Models\TranseunteTripulantes;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use App\Http\Livewire\Traits\HandlesErrors;

class AltaComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use HandlesErrors;
    public $identificador;
    public $club_id;
    public $situacion_persona;
    public $situacion_barco_old;
    public $situacion_barco;
    public $numero_socio;
    public $nombre_socio;
    public $dni;
    public $direccion;
    public $telefonos = [];
    public $telefonos_borrar = [];
    public $numeros_llave = [];
    public $numeros_llave_borrar = [];
    public $tripulantes = [];
    public $tripulantes_borrar = [];
    public $alta_baja;
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
    public $notas;
    public $puntal;
    public $fecha_nota;
    public $fecha_entrada;
    public $fecha_baja;

    public $texto_nota;
    public $id_nota;
    public $pin_socio;
    public $registros_entrada = [];
    public $registros_entrada_transeunte = [];
    public $puede_editar = false;
    public $puede_notas = false;

    public function mount()
    {
        $this->club_id= session()->get('clubSeleccionado');
        $socio = Socio::find($this->identificador);
        $this->notas = Nota::where('socio_id', $this->identificador)->get();
        $this->situacion_barco_old = $socio->situacion_barco;
        $this->situacion_persona = $socio->situacion_persona;
        $this->situacion_barco = 0;
        $this->numero_socio = $socio->numero_socio;
        $this->nombre_socio = $socio->nombre_socio;
        $this->dni = $socio->dni;
        $this->direccion = $socio->direccion;
        $this->alta_baja = $socio->alta_baja;
        if ($socio->telefonos()->count() > 0) {
            foreach ($socio->telefonos as $telefono) {
                $this->telefonos[] = ['id' => $telefono->id, 'telefono' => $telefono->telefono];
            }
        } else {
            $this->telefonos[] = ['telefono' => ''];
        }
        if ($socio->numeros_llave()->count() > 0) {
            foreach ($socio->numeros_llave as $numero_llave) {
                $this->numeros_llave[] = ['id' => $numero_llave->id, 'numero_llave' => $numero_llave->numero_llave];
            }
        } else {
            $this->numeros_llave[] = ['numero_llave' => ''];
        }

        if ($this->situacion_persona == 1) {
            if ($socio->tripulantes()->count() > 0) {
                foreach ($socio->tripulantes as $tripulante) {
                    $this->tripulantes[] = ['id' => $tripulante->id, 'nombre' => $tripulante->nombre, 'dni' => $tripulante->dni];
                }
            }
        }
        $registros = RegistrosEntrada::where('socio_id', $this->identificador)->get();

        foreach ($registros as $index => $registro) {
            if ($registro->estado != 2) {
                $tiempoAtraque = $registro->fecha_salida !== null ? Carbon::parse($registro->fecha_salida)->diffInDays(Carbon::parse($registro->fecha_entrada)) : Carbon::parse($registro->fecha_entrada)->diffInDays(Carbon::now()->toDate());

                $this->registros_entrada[] = [
                    'fecha_1' => $registro->fecha_entrada,
                    'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de atraque',
                    'tiempoAtraque' => $tiempoAtraque
                ];
                $tiempoVarada = null;
                if (isset($registros[$index + 1]) && $registros[$index + 1]->estado != 2) {
                    $tiempoVarada = Carbon::parse($registros[$index + 1]->fecha_entrada)->diffInDays(Carbon::parse($registro->fecha_salida));
                    $this->registros_entrada[] = [
                        'fecha_1' => $registro->fecha_salida,
                        'fecha_2' => $registros[$index + 1]->fecha_entrada,
                        'tiempoVarada' => $tiempoVarada
                    ];
                }
            } else {
                $tiempoAtraque = $registro->fecha_salida !== null ? Carbon::parse($registro->fecha_salida)->diffInDays(Carbon::parse($registro->fecha_entrada)) : Carbon::parse($registro->fecha_entrada)->diffInDays(Carbon::now()->toDate());

                $this->registros_entrada[] = [
                    'fecha_1' => $registro->fecha_entrada,
                    'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de alta',
                    'tiempoAtraque' => $tiempoAtraque,
                    'estado' => 2,
                ];
                $tiempoVarada = null;
            }
        }

        $registros2 = RegistrosEntradaTranseunte::where('socio_id', $this->identificador)->get();

        foreach ($registros2 as $index => $registro) {
            $tiempoAtraque = $registro->fecha_salida !== null ? Carbon::parse($registro->fecha_salida)->diffInDays(Carbon::parse($registro->fecha_entrada)) : Carbon::parse($registro->fecha_entrada)->diffInDays(Carbon::now()->toDate());

            $this->registros_entrada_transeunte[] = [
                'fecha_1' => $registro->fecha_entrada,
                'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de salida',
                'tiempoAtraque' => $tiempoAtraque
            ];
            $tiempoVarada = null;
            if (isset($registros2[$index + 1])) {
                $tiempoVarada = Carbon::parse($registros2[$index + 1]->fecha_entrada)->diffInDays(Carbon::parse($registro->fecha_salida));
                $this->registros_entrada_transeunte[] = [
                    'fecha_1' => $registro->fecha_salida,
                    'fecha_2' => $registros2[$index + 1]->fecha_entrada,
                    'tiempoVarada' => $tiempoVarada
                ];
            }
        }
        $this->email = $socio->email;
        $this->pantalan_t_atraque = $socio->pantalan_t_atraque;
        $this->nombre_barco = $socio->nombre_barco;
        $this->matricula = $socio->matricula;
        $this->eslora = $socio->eslora;
        $this->manga = $socio->manga;
        $this->puntal = $socio->puntal;
        $this->poliza = $socio->poliza;
        $this->calado = $socio->calado;
        $this->seguro_barco = $socio->seguro_barco;
        $this->vencimiento = $socio->vencimiento;
        $this->itb = $socio->itb;
        $this->ruta_foto = $socio->ruta_foto;
        $this->ruta_foto2 = $socio->ruta_foto2;
        $this->pin_socio = $socio->pin_socio;
        $this->puedeEditar();
    }
    public function render()
    {
        return view('livewire.socio.alta-component');
    }

    public function puedeEditar()
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3) {
            $this->puede_editar = true;
        }
        if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4) {
            $this->puede_notas = true;
        }
    }

    public function updateAlta()
    {
        $this->alta_baja = 0;

        // $camposFaltantes = [];

        // $camposRequeridos = [
        //     'club_id',
        //     'situacion_persona',
        //     'situacion_barco',
        //     'numero_socio',
        //     'nombre_socio',
        //     'dni',
        //     'direccion',
        //     'email',
        //     'pantalan_t_atraque',
        //     'nombre_barco',
        //     'matricula',
        //     'eslora',
        //     'manga',
        //     'calado',
        //     'seguro_barco',
        //     'poliza',
        //     'vencimiento',
        //     'itb',
        //     'ruta_foto',
        //     'ruta_foto2'
        // ];
        // $nombresDescriptivos = [
        //     'club_id' => 'ID del Club',
        //     'situacion_persona' => 'Situación de persona',
        //     'situacion_barco' => 'Situación de barco',
        //     'numero_socio' => 'Nº de socio',
        //     'nombre_socio' => 'Nombre de socio',
        //     'dni' => 'DNI',
        //     'direccion' => 'Dirección',
        //     'email' => 'Email',
        //     'pantalan_t_atraque' => 'Pantalán y Atraque',
        //     'nombre_barco' => 'Nombre del barco',
        //     'matricula' => 'Matrícula',
        //     'eslora' => 'Eslora',
        //     'manga' => 'Manga',
        //     'calado' => 'Calado',
        //     'seguro_barco' => 'Seguro del barco',
        //     'poliza' => 'Póliza',
        //     'vencimiento' => 'Vencimiento',
        //     'itb' => 'ITB',
        //     'ruta_foto' => 'Imagen del barco',
        //     'ruta_foto2' => 'Imagen del socio',
        // ];
        // foreach ($camposRequeridos as $campo) {
        //     if ($this->{$campo} === null) {
        //         $camposFaltantes[] = $nombresDescriptivos[$campo] ?? $campo;
        //     }
        // }

        // if (!empty($camposFaltantes)) {
        //     $mensajeError = "Los siguientes campos son obligatorios y están faltantes: " . implode(', ', $camposFaltantes);
        //     $this->alert('error', $mensajeError, [
        //         'position' => 'center',
        //         'timer' => 3000,
        //         'toast' => false,
        //         'showConfirmButton' => true,
        //         'confirmButtonText' => 'ok',
        //         'timerProgressBar' => false,
        //     ]);
        //     return;
        // }

        $validatedData = $this->validate(
            [
                'club_id' => 'nullable',
                'situacion_persona' => 'nullable',
                'situacion_barco' => 'nullable',
                'numero_socio' => 'nullable',
                'nombre_socio' => 'nullable',
                'dni' => 'nullable',
                'direccion' => 'nullable',
                'email' => 'nullable',
                'pantalan_t_atraque' => 'nullable',
                'nombre_barco' => 'nullable',
                'matricula' => 'nullable',
                'eslora' => 'nullable',
                'manga' => 'nullable',
                'calado' => 'nullable',
                'puntal' => 'nullable',
                'seguro_barco' => 'nullable',
                'poliza' => 'nullable',
                'vencimiento' => 'nullable',
                'itb' => 'nullable',
                'ruta_foto' => 'nullable',
                'ruta_foto2' => 'nullable',
                'alta_baja' => 'nullable',

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
                'alta_baja.required' => 'required',
            ]
        );

        if (Storage::disk('public')->exists('assets/images/' . $this->ruta_foto) == false && isset($this->ruta_foto) && is_object($this->ruta_foto)) {
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

        if (Storage::disk('public')->exists('assets/images/' . $this->ruta_foto2) == false && isset($this->ruta_foto2) && is_object($this->ruta_foto2)) {
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
        $socio = Socio::find($this->identificador);
        $socioSave = $socio->update($validatedData);
        
        // Crear nuevos teléfonos solo si no están vacíos
        foreach ($this->telefonos as $telefonoIndex => $telefono) {
            if (!isset($telefono['id'])) {
                if (!empty(trim($telefono['telefono']))) {
                    $telefonoLimpio = preg_replace('/\D+/', '', $telefono['telefono']);
                    if (!empty($telefonoLimpio) && strlen($telefonoLimpio) >= 7) {
                        Telefonos::create(['socio_id' => $this->identificador, 'telefono' => $telefonoLimpio]);
                    }
                }
            }
        }
        foreach ($this->numeros_llave as $llaveIndex => $numero_llave) {
            if (!isset($numero_llave['id'])) {
                $nuevo_num_llave = NumerosLlave::create(['socio_id' => $this->identificador, 'num_llave' => $numero_llave['numero_llave']]);
            }
        }
        foreach ($this->telefonos_borrar as $telefonoIndex => $telefono) {
            if (isset($telefono['id'])) {
                $telefono_eliminar = Telefonos::find($telefono['id'])->delete();
            }
        }
        foreach ($this->numeros_llave_borrar as $llaveIndex => $numero_llave) {
            if (isset($numero_llave['id'])) {
                $nuevo_num_llave = NumerosLlave::find($numero_llave['id'])->delete();
            }
        }
        foreach ($this->tripulantes_borrar as $tripulanteIndex => $tripulante) {
            if (isset($tripulante['id'])) {
                $nuevo_tripulante = NumerosLlave::find($numero_llave['id'])->delete();
            }
        }
        $this->validate(['fecha_baja' => 'required']);

        RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_baja, 'fecha_salida' => $this->fecha_baja,  'estado' => 0]);



        if ($this->situacion_persona == 1) {
            $ultimo_registro = RegistrosEntradaTranseunte::where('socio_id', $this->identificador)->latest()->first();
            if(isset($ultimo_registro)){
                $ultimo_registro->update(['fecha_salida' => $this->fecha_baja]);}
        }

        // Alertas de guardado exitoso
        if ($socioSave) {
            $this->alert('success', '¡Socio actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => false,
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

    public function addTelefono()
    {
        $this->telefonos[] = ['telefono' => ''];
    }

    public function addNumeroLlave()
    {
        $this->numeros_llave[] = ['numero_llave' => ''];
    }

    public function deleteTelefono($id)
    {
        if (isset($this->telefonos[$id]['id'])) {
            if (count($this->telefonos) <= 1) {
                $this->telefonos_borrar[] = $this->telefonos[$id];
                $this->telefonos[$id] = ['telefono' => ''];
            } else {
                $this->telefonos_borrar[] = $this->telefonos[$id];
                unset($this->telefonos[$id]);
                $this->telefonos = array_values($this->telefonos);
            }
        } else {
            if (count($this->telefonos) <= 1) {
                $this->alert('warning', 'Añade otro teléfono para eliminar el seleccionado.');
            } else {
                unset($this->telefonos[$id]);
                $this->telefonos = array_values($this->telefonos);
            }
        }
    }

    public function deleteNumeroLlave($id)
    {
        if (isset($this->numeros_llave[$id]['id'])) {
            if (count($this->numeros_llave) <= 1) {
                $this->numeros_llave_borrar[] = $this->numeros_llave[$id];
                $this->numeros_llave[$id] = ['numero_llave' => ''];
            } else {
                $this->numeros_llave_borrar[] = $this->numeros_llave[$id];
                unset($this->numeros_llave[$id]);
                $this->numeros_llave = array_values($this->numeros_llave);
            }
        } else {
            if (count($this->numeros_llave) <= 1) {
                $this->alert('warning', 'Añade otro nº de llave para eliminar el seleccionado.');
            } else {
                unset($this->numeros_llave[$id]);
                $this->numeros_llave = array_values($this->numeros_llave);
            }
        }
    }
    public function deleteTripulante($id)
    {
        if (isset($this->tripulantes[$id]['id'])) {
            if (count($this->numeros_llave) <= 1) {
                $this->tripulantes_borrar[] = $this->tripulantes[$id];
            } else {
                $this->tripulantes_borrar[] = $this->tripulantes[$id];
                unset($this->tripulantes[$id]);
                $this->tripulantes = array_values($this->tripulantes);
            }
        } else {
            if (count($this->tripulantes) <= 1) {
                $this->alert('warning', 'Añade otro nº de llave para eliminar el seleccionado.');
            } else {
                unset($this->tripulantes[$id]);
                $this->tripulantes = array_values($this->tripulantes);
            }
        }
    }
    public function alertaGuardar()
    {
        $this->alert('warning', 'Asegúrese de que todos los datos son correctos antes de guardar.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'update',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }
    public function alertaEliminar()
    {
        $this->alert('warning', '¿Está seguro de que desea eliminar a este socio? Si busca desactivar al socio, use la opción de Dar de baja.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }


    public function alertaNota()
    {
        $this->alert('warning', '¿Estás seguro? Revisa la nota antes de guardarla.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'guardarNota',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }

    public function alertaBaja()
    {
        $this->alert('warning', '¿Estás seguro de dar a este socio o transeúnte de alta?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'updateAlta',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }

    public function alertaNotaEdit()
    {
        $this->alert('warning', '¿Estás seguro? Revisa la nota antes de editarla.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'guardarNotaEdit',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }

    public function getUser($id)
    {
        $user = User::find($id);
        return $user->name . " " . $user->surname;
    }

    public function editNota($id)
    {
        $nota = Nota::find($id);
        $this->texto_nota = $nota->descripcion;
        $this->fecha_nota = $nota->fecha;
        $this->id_nota = $id;
    }
    public function nuevaNota()
    {
        $this->texto_nota = '';
        $this->fecha_nota = '';
    }
    public function guardarNota()
    {
        $notaSave = Nota::create(['socio_id' => $this->identificador, 'user_id' => Auth::id(), 'descripcion' => $this->texto_nota, 'fecha' => $this->fecha_nota]);
        if ($notaSave) {
            $this->notas = Nota::where('socio_id', $this->identificador)->get();
            $this->dispatchBrowserEvent('closeModal');
            $this->texto_nota = "";
            $this->fecha_nota = "";
        } else {
            $this->alert('error', '¡No se pudo guardar la nota!', [
                'position' => 'center',
                'toast' => false,
                'showDenyButton' => true,
                'denyButtonText' => 'Volver',
                'timerProgressBar' => true,
            ]);
        }
    }
    public function guardarNotaEdit()
    {
        $nota = Nota::find($this->id_nota);
        $notaSave = $nota->update(['socio_id' => $this->identificador, 'user_id' => Auth::id(), 'descripcion' => $this->texto_nota, 'fecha' => $this->fecha_nota]);
        if ($notaSave) {
            $this->notas = Nota::where('socio_id', $this->identificador)->get();
            $this->dispatchBrowserEvent('closeModal');
            $this->texto_nota = "";
            $this->fecha_nota = "";
            unset($this->id_nota);
        } else {
            $this->alert('error', '¡No se pudo guardar la nota!', [
                'position' => 'center',
                'toast' => false,
                'showDenyButton' => true,
                'denyButtonText' => 'Volver',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function getListeners()
    {
        return [
            'update',
            'confirmed',
            'alertaGuardar',
            'alertaEliminar',
            'alertaNota',
            'alertaBaja',
            'updateAlta',
            'guardarNota',
            'guardarNotaEdit',
            'destroy',
            'confirmDelete'
        ];
    }

    public function confirmed()
    {
        // Do something
        return redirect()->route('socios.index');
    }

    public function destroy()
    {
        $this->alert('error', '¿Seguro que desea borrar al socio? No hay vuelta atrás.', [
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
        $socios = Socio::find($this->identificador)->delete();
        $telefonos = Telefonos::where('socio_id', $this->identificador)->delete();
        $num_llaves = NumerosLlave::where('socio_id', $this->identificador)->delete();
        $tripulantes = TranseunteTripulantes::where('socio_id', $this->identificador)->delete();
        $socios->delete();
        return redirect()->route('socios.index');
    }
}
