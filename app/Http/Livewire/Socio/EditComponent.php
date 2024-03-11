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
use App\Models\Club;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


use DateTime;

class EditComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $identificador;
    public $club_id;
    public $socio;
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
    public $fecha_entrada_barco;
    public $fecha_baja;

    public $texto_nota;
    public $id_nota;
    public $pin_socio;
    public $registros_entrada = [];
    public $registros_entrada_transeunte = [];
    public $registros_entrada_transeunte_borrar = [];
    public $puede_editar = false;
    public $puede_notas = false;
    public $ultimo_registroverif;
    public $entrada;




    public function mount()
    {

        $this->ultimo_registroverif = RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first();
        if(isset($this->ultimo_registroverif)){
        $this->entrada = $this->ultimo_registroverif->fecha_entrada;}
        $this->club_id=session()->get('clubSeleccionado');
        $socio = Socio::find($this->identificador);
        $this->socio = $socio;
        $this->notas = Nota::where('socio_id', $this->identificador)->get();
        $this->situacion_barco_old = $socio->situacion_barco;
        $this->situacion_persona = $socio->situacion_persona;
        $this->situacion_barco = $socio->situacion_barco;
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
                $this->numeros_llave[] = ['id' => $numero_llave->id, 'numero_llave' => $numero_llave->num_llave];
            }
        } else {
            $this->numeros_llave[] = ['numero_llave' => ''];
        }

        if ($this->situacion_persona == 1 || $this->situacion_persona == 2){
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
                    'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de salida',
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
                if ($index % 2 !== 0) {
                    $tiempoAtraque = $registro->fecha_salida !== null ? Carbon::parse($registro->fecha_salida)->diffInDays(Carbon::parse($registro->fecha_entrada)) : Carbon::parse($registro->fecha_entrada)->diffInDays(Carbon::now()->toDate());

                    $this->registros_entrada[] = [
                        'fecha_1' => $registro->fecha_entrada,
                        'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de varada',
                        'tiempoAtraque' => $tiempoAtraque,
                        'estado' => 1,
                    ];
                    $tiempoVarada = null;
                } else {
                    $tiempoAtraque = $registro->fecha_salida !== null ? Carbon::parse($registro->fecha_salida)->diffInDays(Carbon::parse($registro->fecha_entrada)) : Carbon::parse($registro->fecha_entrada)->diffInDays(Carbon::now()->toDate());

                    $this->registros_entrada[] = [
                        'fecha_1' => $registro->fecha_entrada,
                        'fecha_2' => $registro->fecha_salida !== null ? $registro->fecha_salida : 'Sin fecha de salida',
                        'tiempoAtraque' => $tiempoAtraque,
                        'estado' => 2,
                    ];
                    $tiempoVarada = null;
                }
            }
        }

        if ($this->situacion_persona == 1 || $this->situacion_persona == 2){
            if ($socio->registros_entradas_transeuntes()->count() > 0) {
                foreach ($socio->registros_entradas_transeuntes as $registro) {
                    $this->registros_entrada_transeunte[] = [
                        'id' => $registro->id,
                        'fecha_entrada' => $registro->fecha_entrada,
                        'fecha_salida' => $registro->fecha_salida,
                        'precio' => $registro->precio,
                        'total' => $registro->total,
                        ];
                }
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
        return view('livewire.socio.edit-component');
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

    public function getNombre($id)
    {
        $usuario = User::find($id);

        return $usuario->name;

    }
    public function update()
    {
        if (isset($this->ultimo_registroverif)){
            $this->ultimo_registroverif->update(['fecha_entrada' => $this->entrada , 'estado' => 0]);
        }elseif(isset($this->entrada)){
            RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->entrada,  'estado' => 0]);
        }
        if ($this->situacion_barco_old != $this->situacion_barco) {
            if ($this->situacion_barco == 0) {
                if ($this->fecha_entrada != null) {
                    $ultima_salida = RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first()->fecha_salida;
                    if ($ultima_salida != null) {
                        $fecha_anterior = new DateTime($ultima_salida);
                        $fecha_actual = new DateTime($this->fecha_entrada);
                        if ($fecha_actual > $fecha_anterior) {
                            RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_entrada,  'estado' => 0]);
                        } else {
                            return $this->alert('error', '¡La fecha de entrada indicada es anterior al último registro!');
                        }
                    } else {
                        $socio = Socio::find($this->identificador);
                        RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first()->update(['fecha_salida' => $socio->updated_at, 'estado' => 1]);
                        $fecha_anterior = new DateTime($socio->created_at);
                        $fecha_actual = new DateTime($this->fecha_entrada);
                        if ($fecha_actual > $fecha_anterior) {
                            RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_entrada, 'estado' => 0]);
                        } else {
                            return $this->alert('error', '¡La fecha de entrada indicada es anterior al último registro!');
                        }
                    }
                } else {
                    return $this->alert('error', '¡Indica la fecha de entrada del barco!');
                }
            } else if ($this->situacion_barco == 1) {
                if ($this->fecha_entrada != null) {
                    $ultimo_registro = RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first();
                    if(is_null($ultimo_registro)){
                        $ultima_entrada = $this->fecha_entrada_barco;
                        RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_entrada_barco ,'fecha_salida' => $this->fecha_entrada , 'estado' => 1]);
                    }else{
                        $ultima_entrada = $ultimo_registro->fecha_entrada;
                        $ultima_salida = $ultimo_registro->fecha_salida;
                        if ($ultima_entrada != null && $ultima_salida == null) {
                            $fecha_anterior = new DateTime($ultima_entrada);
                            $fecha_actual = new DateTime($this->fecha_entrada);
                            if ($fecha_actual > $fecha_anterior) {
                                $ultimo_registro->update(['fecha_salida' => $this->fecha_entrada, 'estado' => 1]);
                            }
                        }
                    }
                } else {
                    return $this->alert('error', '¡Indica la fecha de entrada del barco!');
                }
            }
        }

        $camposFaltantes = [];

        $camposRequeridos = [
            'club_id',
            'situacion_persona',
            'situacion_barco',
            'nombre_socio',

        ];
        $nombresDescriptivos = [
            'club_id' => 'ID del Club',
            'situacion_persona' => 'Situación de persona',
            'situacion_barco' => 'Situación de barco',
            'nombre_socio' => 'Nombre de socio',

        ];
        foreach ($camposRequeridos as $campo) {
            if ($this->{$campo} === null) {
                $camposFaltantes[] = $nombresDescriptivos[$campo] ?? $campo;
            }
        }

        if (empty($this->telefonos[0]['telefono'])) {
            $camposFaltantes[] ='telefono';
        }

        if (!empty($camposFaltantes)) {
            $mensajeError = "Los siguientes campos son obligatorios y están faltantes: " . implode(', ', $camposFaltantes);
            $this->alert('error', $mensajeError, [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'ok',
                'timerProgressBar' => false,
            ]);
            return;
        }

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
                'puntal' => 'nullable',
                'seguro_barco' => 'nullable',
                'poliza' => 'nullable',
                'vencimiento' => 'nullable',
                'itb' => 'nullable',
                'ruta_foto' => 'nullable',
                'ruta_foto2' => 'nullable',

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
        foreach ($this->telefonos as $telefonoIndex => $telefono) {
            if (isset($telefono['id'])) {
                Telefonos::find($telefono['id'])->update(['telefono' => $telefono['telefono']]);
            }else{
                Telefonos::create(['socio_id' => $this->identificador, 'telefono' => $telefono['telefono']]);
            }
        }
        foreach ($this->numeros_llave as $llaveIndex => $numero_llave) {
            if (isset($numero_llave['id'])) {
                    NumerosLlave::find($numero_llave['id'])->update(['num_llave' => $numero_llave['numero_llave']]);
                }else{
                    NumerosLlave::create(['socio_id' => $this->identificador, 'num_llave' => $numero_llave['numero_llave']]);
                }

        }
        if($this->situacion_persona == 1 || $this->situacion_persona == 2){
            foreach ($this->tripulantes as $tripulanteIndex => $tripulante) {
                if (isset($tripulante['id'])) {
                TranseunteTripulantes::find($tripulante['id'])->update(['nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
                }else{
                TranseunteTripulantes::create(['socio_id' => $this->identificador, 'nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
                }
            }
        }

        if($this->situacion_persona == 1 || $this->situacion_persona == 2){
            foreach ($this->registros_entrada_transeunte as $registroindexIndex => $registro) {
                if (isset($registro['id'])) {
                    RegistrosEntradaTranseunte::find($registro['id'])->update([
                        'fecha_entrada' => $registro['fecha_entrada'],
                        'fecha_salida' => $registro['fecha_salida'],
                        'precio' => $registro['precio'],
                        'total' => $registro['total'],


                    ]);
                }else{
                    RegistrosEntradaTranseunte::create([
                        'socio_id' => $this->identificador,
                        'fecha_entrada' => $registro['fecha_entrada'],
                        'fecha_salida' => $registro['fecha_salida'],
                        'precio' => $registro['precio'],
                        'total' => $registro['total'],

                    ]);
                }
            }
        }
        foreach ($this->registros_entrada_transeunte_borrar as $registroindex => $registro) {
            if (isset($registro['id'])) {
             RegistrosEntradaTranseunte::find($registro['id'])->delete();
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
                $nuevo_tripulante = TranseunteTripulantes::find($tripulante['id'])->delete();
            }
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

    public function updateBaja()
    {
        $this->alta_baja = 1;

        $camposFaltantes = [];

        $camposRequeridos = [
            'club_id',
            'situacion_persona',
            'situacion_barco',

        ];
        $nombresDescriptivos = [
            'club_id' => 'ID del Club',
            'situacion_persona' => 'Situación de persona',
            'situacion_barco' => 'Situación de barco',
            'numero_socio' => 'Nº de socio',
            'nombre_socio' => 'Nombre de socio',
            'dni' => 'DNI',
            'direccion' => 'Dirección',
            'email' => 'Email',
            'pantalan_t_atraque' => 'Pantalán y Atraque',
            'nombre_barco' => 'Nombre del barco',
            'matricula' => 'Matrícula',
            'eslora' => 'Eslora',
            'manga' => 'Manga',
            'calado' => 'Calado',
            'seguro_barco' => 'Seguro del barco',
            'poliza' => 'Póliza',
            'vencimiento' => 'Vencimiento',
            'itb' => 'ITB',
            'ruta_foto' => 'Imagen del barco',
            'ruta_foto2' => 'Imagen del socio',
        ];
        foreach ($camposRequeridos as $campo) {
            if ($this->{$campo} === null) {
                $camposFaltantes[] = $nombresDescriptivos[$campo] ?? $campo;
            }
        }

        if (empty($this->telefonos[0]['telefono'])) {
            $camposFaltantes[] ='telefono';
        }

        if (!empty($camposFaltantes)) {
            $mensajeError = "Los siguientes campos son obligatorios y están faltantes: " . implode(', ', $camposFaltantes);
            $this->alert('error', $mensajeError, [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'ok',
                'timerProgressBar' => false,
            ]);
            return;
        }

        $validatedData = $this->validate(
            [
                'club_id' => 'required',
                'situacion_persona' => 'required',
                'situacion_barco' => 'required',
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
                'alta_baja' => 'required',

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
            $sourcePath = $this->ruta_foto->getPathname();
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
            $sourcePath = $this->ruta_foto2->getPathname();
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
        foreach ($this->telefonos as $telefonoIndex => $telefono) {
            if (isset($telefono['id'])) {
                Telefonos::find($telefono['id'])->update(['telefono' => $telefono['telefono']]);
            }else{
                Telefonos::create(['socio_id' => $this->identificador, 'telefono' => $telefono['telefono']]);
            }
        }
        foreach ($this->numeros_llave as $llaveIndex => $numero_llave) {
            if (isset($numero_llave['id'])) {
                    NumerosLlave::find($numero_llave['id'])->update(['num_llave' => $numero_llave['numero_llave']]);
                }else{
                    NumerosLlave::create(['socio_id' => $this->identificador, 'num_llave' => $numero_llave['numero_llave']]);
                }

        }
        if($this->situacion_persona == 1 || $this->situacion_persona == 2){
            foreach ($this->tripulantes as $tripulanteIndex => $tripulante) {
                if (isset($tripulante['id'])) {
                TranseunteTripulantes::find($tripulante['id'])->update(['nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
                }else{
                TranseunteTripulantes::create(['socio_id' => $this->identificador, 'nombre' => $tripulante['nombre'], 'dni' => $tripulante['dni']]);
                }
            }
        }
        if($this->situacion_persona == 1 || $this->situacion_persona == 2){
            foreach ($this->registros_entrada_transeunte as $registroindexIndex => $registro) {
                if (isset($registro['id'])) {
                    RegistrosEntradaTranseunte::find($registro['id'])->update([
                        'fecha_entrada' => $registro['fecha_entrada'],
                        'fecha_salida' => $registro['fecha_salida'],
                        'precio' => $registro['precio'],
                        'total' => $registro['total'],


                    ]);
                }else{
                    RegistrosEntradaTranseunte::create([
                        'socio_id' => $this->identificador,
                        'fecha_entrada' => $registro['fecha_entrada'],
                        'fecha_salida' => $registro['fecha_salida'],
                        'precio' => $registro['precio'],
                        'total' => $registro['total'],

                    ]);
                }
            }
        }
        foreach ($this->registros_entrada_transeunte_borrar as $registroindex => $registro) {
            if (isset($registro['id'])) {
             RegistrosEntradaTranseunte::find($registro['id'])->delete();
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
               TranseunteTripulantes::find($tripulante['id'])->delete();
            }
        }
        $this->validate(['fecha_baja' => 'required']);

        if ($this->situacion_barco == 0) {
            if ($this->fecha_baja != null) {
                $ultima_salida = RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first()->fecha_salida;
                if ($ultima_salida != null) {
                    $fecha_anterior = new DateTime($ultima_salida);
                    $fecha_actual = new DateTime($this->fecha_baja);
                    if ($fecha_actual > $fecha_anterior) {
                        RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_baja, 'fecha_salida' => $this->fecha_baja,  'estado' => 0]);
                    } else {
                        return $this->alert('error', '¡La fecha de entrada indicada es anterior al último registro!');
                    }
                } else {
                    $socio = Socio::find($this->identificador);
                    RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first()->update(['fecha_salida' => $this->fecha_baja, 'estado' => 2]);
                    $fecha_anterior = new DateTime($socio->created_at);
                    $fecha_actual = new DateTime($this->fecha_baja);
                    if ($fecha_actual > $fecha_anterior) {
                        RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_baja, 'fecha_salida' => $this->fecha_baja, 'estado' => 2]);
                    } else {
                        return $this->alert('error', '¡La fecha de entrada indicada es anterior al último registro!');
                    }
                }
            } else {
                return $this->alert('error', '¡Indica la fecha de entrada del barco!');
            }
        } else if ($this->situacion_barco == 1) {
            if ($this->fecha_entrada != null) {
                $ultimo_registro = RegistrosEntrada::where('socio_id', $this->identificador)->latest()->first();
                if(is_null($ultimo_registro)){
                    $ultima_entrada = $this->fecha_entrada_barco;
                    RegistrosEntrada::create(['socio_id' => $this->identificador, 'fecha_entrada' => $this->fecha_entrada_barco ,'fecha_salida' => $this->fecha_entrada , 'estado' => 1]);
                }else{
                    $ultima_entrada = $ultimo_registro->fecha_entrada;
                    $ultima_salida = $ultimo_registro->fecha_salida;
                    if ($ultima_entrada != null && $ultima_salida == null) {
                        $fecha_anterior = new DateTime($ultima_entrada);
                        $fecha_actual = new DateTime($this->fecha_entrada);
                        if ($fecha_actual > $fecha_anterior) {
                            $ultimo_registro->update(['fecha_salida' => $this->fecha_entrada, 'estado' => 1]);
                        }
                    }
                }
            } else {
                return $this->alert('error', '¡Indica la fecha de entrada del barco!');
            }
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
    public function addTripulante()
    {
        $this->tripulantes[] = ['nombre' => '', 'dni' => ''];
    }
    public function addEntrada()
    {
        $this->registros_entrada_transeunte[] = [
            'fecha_entrada' => '',
            'fecha_salida' => '',
            'precio' => '',
            'total' => '',
        ];
    }
    public function deleteEntrada($id)
    {
        if (isset($this->registros_entrada_transeunte[$id]['id'])) {
                $this->registros_entrada_transeunte_borrar[] = $this->registros_entrada_transeunte[$id];
                unset($this->registros_entrada_transeunte[$id]);
                $this->registros_entrada_transeunte = array_values($this->registros_entrada_transeunte);
        } else {
                unset($this->registros_entrada_transeunte[$id]);
                $this->registros_entrada_transeunte = array_values($this->registros_entrada_transeunte);
        }
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
                $this->tripulantes_borrar[] = $this->tripulantes[$id];
                unset($this->tripulantes[$id]);
                $this->tripulantes = array_values($this->tripulantes);
        } else {
                unset($this->tripulantes[$id]);
                $this->tripulantes = array_values($this->tripulantes);
        }
    }

    public function updated($propertyName)
    {
        // Verifica si la actualización es para 'registros_entrada_transeunte'
        if (Str::startsWith($propertyName, 'registros_entrada_transeunte.')) {
            // Extrae el índice y el campo basado en el nombre de la propiedad
            list($field, $index, $subField) = explode('.', $propertyName);

            if (in_array($subField, ['fecha_entrada', 'fecha_salida', 'precio'])) {
                $entrada = $this->registros_entrada_transeunte[$index]['fecha_entrada'] ?? null;
                $salida = $this->registros_entrada_transeunte[$index]['fecha_salida'] ?? null;
                $precio = $this->registros_entrada_transeunte[$index]['precio'] ?? 0;

                if ($entrada && $salida && $precio) {
                    $fechaEntrada = Carbon::createFromFormat('Y-m-d', $entrada);
                    $fechaSalida = Carbon::createFromFormat('Y-m-d', $salida);
                    $diferenciaDias = $fechaSalida->diffInDays($fechaEntrada);

                    // Actualiza el total en el registro específico
                    $this->registros_entrada_transeunte[$index]['total'] = $diferenciaDias * $precio;
                }
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
        $this->alert('warning', '¿Estás seguro de dar a este socio o transeúnte de baja?.', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'updateBaja',
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

    public function cargarNota($id)
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
        $notaSave = Nota::create(['socio_id' => $this->identificador, 'user_id' => Auth::id(), 'descripcion' => $this->texto_nota, 'fecha' => $this->fecha_nota ?? carbon::now()]);
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
            'updateBaja',
            'guardarNota',
            'guardarNotaEdit',
            'destroy',
            'confirmDelete',
            'alertaImpresion',
            'imprecionSocio',
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
        Socio::find($this->identificador)->delete();
        Telefonos::where('socio_id', $this->identificador)->delete();
        NumerosLlave::where('socio_id', $this->identificador)->delete();
        TranseunteTripulantes::where('socio_id', $this->identificador)->delete();
        return redirect()->route('socios.index');
    }
    public function alertaImpresion()
    {
        $this->alert('info', '¿Seguro que desea imprimir el Socio?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'imprecionSocio',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
            'timer' => null
        ]);
    }
    public function imprecionSocio()
    {

        $club = Club::find($this->club_id);

        $datos =  [
            'socio' => $this->socio, 'telefonos' => $this->telefonos, 'llaves' => $this->numeros_llave, 'tripulantes' => $this->tripulantes, 'registros_entrada_transeunte' => $this->registros_entrada_transeunte,
            'registros_entrada' => $this->registros_entrada ,'club' => $club];

        $pdf = Pdf::loadView('livewire.socio.pdf-component', $datos)->setPaper('a4', 'vertical')->output(); //
        return response()->streamDownload(
            fn () => print($pdf),
            'Socio_nº_'.$this->identificador.'.pdf'
        );
    }

}
