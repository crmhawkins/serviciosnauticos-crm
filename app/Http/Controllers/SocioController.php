<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarcoFoto;
use App\Models\SocioFoto;
use App\Models\Socio as SocioModel;
use App\Models\Telefonos;
use App\Models\NumerosLlave;
use App\Models\TranseunteTripulantes;
use App\Models\Nota;
use App\Models\RegistrosEntradaTranseunte;
use Illuminate\Support\Facades\Auth;
use App\Models\UserClub;

class SocioController extends Controller
{
    public function index()
    {
        $response = '';
        // $user = Auth::user();

        return view('socio.index', compact('response'));
    }
    public function indexadmin()
    {
        $response = '';
        // $user = Auth::user();

        return view('socio.indexadmin', compact('response'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubId = session()->get('clubSeleccionado');
        $user = Auth::user();
        $role = (int) $user->role;
        
        if ($clubId && $role !== 1) { // No es admin
            $club = \App\Models\Club::find($clubId);

            // PN/GC: sólo pueden crear en clubs que han creado ellos mismos
            if (in_array($role, [6, 7], true)) {
                if (!$club || (int) $club->created_by !== (int) $user->id) {
                    abort(403, 'No tienes permisos para crear socios en este club.');
                }
            }
            // Roles 2,3,4 (gestión de club: secretario, etc.) sólo en clubs asignados vía user_clubs
            elseif (in_array($role, [2, 3, 4], true)) {
                $tieneClub = UserClub::where('user_id', $user->id)
                    ->where('club_id', $clubId)
                    ->exists();
                if (!$tieneClub) {
                    abort(403, 'No tienes permisos para crear socios en este club.');
                }
            }
            // Otros roles: sin permiso
            else {
                abort(403, 'No tienes permisos para crear socios.');
            }
        }
        return view('socio.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socio = SocioModel::find($id);
        // Autorizar vista/edición (vista permitida; edición se controla en update)
        
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }
        
        // Cargar relaciones
        $socio->load(['telefonos', 'numeros_llave', 'tripulantes', 'notas', 'socio_fotos', 'barco_fotos', 'registros_entradas_transeuntes']);
        
        // Verificar permisos
        $puede_editar = auth()->user()->role <= 3;
        $puede_notas = auth()->user()->role <= 4;
        $from = request('from') === 'todos' ? 'todos' : 'socios';
        $canEdit = \Illuminate\Support\Facades\Gate::allows('update', $socio);
        return view('socio.edit', compact('socio', 'puede_editar', 'puede_notas', 'from', 'canEdit'));
    }
    public function alta($id)
    {
        return view('socio.alta', compact('id'));

    }

    /**
     * Vista de registros de entrada y salida del socio
     */
    public function registros($id)
    {
        $socio = SocioModel::find($id);
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }
        // intentar cargar relaciones si existen
        try {
            $socio->load(['registros_entrada', 'registros_entradas_transeuntes']);
        } catch (\Throwable $e) {
            // continuar sin romper si las relaciones no existen
        }
        return view('socio.registros', compact('socio'));
    }

    /**
     * Vista HTML imprimible del socio (abre diálogo de impresión del navegador)
     */
    public function imprimir($id)
    {
        $socio = SocioModel::with(['telefonos', 'numeros_llave', 'tripulantes'])->find($id);
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }
        // Intentar usar primero el club del propio socio; si no, caer al club seleccionado en sesión
        $club = null;
        if ($socio->club_id) {
            $club = \App\Models\Club::find($socio->club_id);
        }
        if (!$club) {
            $clubIdSession = session()->get('clubSeleccionado');
            if ($clubIdSession) {
                $club = \App\Models\Club::find($clubIdSession);
            }
        }
        return view('socio.print', compact('socio', 'club'));
    }

    /**
     * Crear una nota rápida desde la vista clásica de edición
     */
    public function agregarNota(Request $request, $id)
    {
        $request->validate([
            'descripcion_nota' => 'required|string',
            'fecha_nota' => 'nullable|date',
        ]);
        $socio = SocioModel::findOrFail($id);
        Nota::create([
            'socio_id' => $socio->id,
            'user_id' => Auth::id(),
            'descripcion' => $request->input('descripcion_nota'),
            'fecha' => $request->input('fecha_nota') ?: now()->toDateString(),
        ]);
        return back()->with('status', 'Nota añadida');
    }

    /**
     * Eliminar una nota (solo administradores)
     */
    public function eliminarNota($id, $notaId)
    {
        // Verificar que el usuario es administrador (rol 1)
        if ((int) Auth::user()->role !== 1) {
            abort(403, 'Solo los administradores pueden eliminar notas.');
        }

        $socio = SocioModel::findOrFail($id);
        $nota = Nota::where('socio_id', $id)->findOrFail($notaId);
        
        $nota->delete();
        
        return redirect()->route('socios.edit', $id)->with('status', 'Nota eliminada correctamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $socio = SocioModel::find($id);
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }

        // Autorización: permitir update sólo si policy lo permite (Admin o PN/GC dueño del club)
        $this->authorize('update', $socio);

        // validar mínimamente imágenes (opcionalmente otros campos)
        $request->validate([
            'ruta_foto' => 'nullable|image|max:5120',
            'ruta_foto2' => 'nullable|image|max:5120',
        ]);

        // Guardar fotos en storage/public/assets/images
        // Regla: si ya hay foto principal, nuevas subidas van a la galería correspondiente
        if ($request->hasFile('ruta_foto')) {
            $path = $request->file('ruta_foto')->store('assets/images', 'public');
            $basename = basename($path);
            if (!empty($socio->ruta_foto)) {
                BarcoFoto::create([
                    'socio_id'  => $socio->id,
                    'ruta'      => $basename,
                    'destacada' => false,
                    'orden'     => (int) (BarcoFoto::where('socio_id', $socio->id)->max('orden') ?? 0) + 1,
                ]);
            } else {
                $socio->ruta_foto = $basename;
            }
        }
        if ($request->hasFile('ruta_foto2')) {
            $path2 = $request->file('ruta_foto2')->store('assets/images', 'public');
            $basename2 = basename($path2);
            if (!empty($socio->ruta_foto2)) {
                SocioFoto::create([
                    'socio_id'  => $socio->id,
                    'ruta'      => $basename2,
                    'destacada' => false,
                    'orden'     => (int) (SocioFoto::where('socio_id', $socio->id)->max('orden') ?? 0) + 1,
                ]);
            } else {
                $socio->ruta_foto2 = $basename2;
            }
        }

        // Actualizar algunos campos básicos si vienen en la request
        $socio->nombre_socio = $request->input('nombre_socio', $socio->nombre_socio);
        $socio->numero_socio = $request->input('numero_socio', $socio->numero_socio);
        $socio->pin_socio = $request->input('pin_socio', $socio->pin_socio);
        $socio->dni = $request->input('dni', $socio->dni);
        $socio->direccion = $request->input('direccion', $socio->direccion);
        $socio->email = $request->input('email', $socio->email);
        $socio->pantalan_t_atraque = $request->input('pantalan_t_atraque', $socio->pantalan_t_atraque);
        $socio->nombre_barco = $request->input('nombre_barco', $socio->nombre_barco);
        $socio->matricula = $request->input('matricula', $socio->matricula);
        $socio->eslora = $request->input('eslora', $socio->eslora);
        $socio->manga = $request->input('manga', $socio->manga);
        $socio->calado = $request->input('calado', $socio->calado);
        $socio->seguro_barco = $request->input('seguro_barco', $socio->seguro_barco);
        $socio->poliza = $request->input('poliza', $socio->poliza);
        $socio->vencimiento = $request->input('vencimiento', $socio->vencimiento);
        $socio->itb = $request->input('itb', $socio->itb);

        $socio->save();

        $redirect = $request->input('redirect_to') === 'todos' ? 'socios.indexadmin' : 'socios.index';
        return redirect()->route($redirect)->with('status', 'Socio actualizado');
    }

    /**
     * Eliminar (placeholder)
     */
    public function destroy($id)
    {
        $socio = SocioModel::find($id);
        if ($socio) {
            $socio->delete();
            Telefonos::where('socio_id', $id)->delete();
            NumerosLlave::where('socio_id', $id)->delete();
            TranseunteTripulantes::where('socio_id', $id)->delete();
        }
        return redirect()->route('socios.index')->with('status', 'Socio eliminado');
    }

    /**
     * Dar de baja al socio (alta_baja = 1)
     */
    public function baja(Request $request, $id)
    {
        $socio = SocioModel::findOrFail($id);
        $socio->alta_baja = 1;
        if ($request->filled('fecha_baja')) {
            $socio->fecha_baja = $request->input('fecha_baja');
        }
        $socio->save();
        return back()->with('status', 'Socio dado de baja');
    }

    /**
     * Marcar como destacada una foto de barco de la galería
     */
    public function destacarBarcoFoto($id, $fotoId)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $foto = BarcoFoto::where('socio_id', $id)->findOrFail($fotoId);
        
        // Si hay una foto principal actual, moverla a la galería antes de reemplazarla
        if (!empty($socio->ruta_foto) && $socio->ruta_foto !== $foto->ruta) {
            // Verificar si la foto principal no está ya en la galería
            $existeEnGaleria = BarcoFoto::where('socio_id', $id)
                ->where('ruta', $socio->ruta_foto)
                ->exists();
            
            if (!$existeEnGaleria) {
                // Crear entrada en galería para la foto principal actual
                BarcoFoto::create([
                    'socio_id'  => $socio->id,
                    'ruta'      => $socio->ruta_foto,
                    'destacada' => false,
                    'orden'     => (int) (BarcoFoto::where('socio_id', $id)->max('orden') ?? 0) + 1,
                ]);
            }
        }
        
        // Resetear destacadas
        BarcoFoto::where('socio_id', $id)->update(['destacada' => false]);
        $foto->destacada = true;
        $foto->save();
        
        // Actualizar principal
        $socio->ruta_foto = $foto->ruta;
        $socio->save();
        
        // Recargar relaciones para que la vista muestre los cambios
        $socio->load(['barco_fotos']);
        return redirect()->route('socios.edit', $id)->with('status', 'Foto de barco destacada');
    }

    public function eliminarBarcoFoto($id, $fotoId)
    {
        $foto = BarcoFoto::where('socio_id', $id)->findOrFail($fotoId);
        $foto->delete();
        return back()->with('status', 'Foto de barco eliminada');
    }

    /**
     * Eliminar la foto principal del barco
     */
    public function eliminarFotoPrincipalBarco($id)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $socio->ruta_foto = null;
        $socio->save();
        return redirect()->route('socios.edit', $id)->with('status', 'Foto principal del barco eliminada');
    }

    /**
     * Marcar como destacada una foto de socio de la galería
     */
    public function destacarSocioFoto($id, $fotoId)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $foto = SocioFoto::where('socio_id', $id)->findOrFail($fotoId);
        
        // Si hay una foto principal actual, moverla a la galería antes de reemplazarla
        if (!empty($socio->ruta_foto2) && $socio->ruta_foto2 !== $foto->ruta) {
            // Verificar si la foto principal no está ya en la galería
            $existeEnGaleria = SocioFoto::where('socio_id', $id)
                ->where('ruta', $socio->ruta_foto2)
                ->exists();
            
            if (!$existeEnGaleria) {
                // Crear entrada en galería para la foto principal actual
                SocioFoto::create([
                    'socio_id'  => $socio->id,
                    'ruta'      => $socio->ruta_foto2,
                    'destacada' => false,
                    'orden'     => (int) (SocioFoto::where('socio_id', $id)->max('orden') ?? 0) + 1,
                ]);
            }
        }
        
        SocioFoto::where('socio_id', $id)->update(['destacada' => false]);
        $foto->destacada = true;
        $foto->save();
        $socio->ruta_foto2 = $foto->ruta;
        $socio->save();
        // Recargar relaciones para que la vista muestre los cambios
        $socio->load(['socio_fotos']);
        return redirect()->route('socios.edit', $id)->with('status', 'Foto de socio destacada');
    }

    public function eliminarSocioFoto($id, $fotoId)
    {
        $foto = SocioFoto::where('socio_id', $id)->findOrFail($fotoId);
        $foto->delete();
        return back()->with('status', 'Foto de socio eliminada');
    }

    /**
     * Eliminar la foto principal del socio
     */
    public function eliminarFotoPrincipalSocio($id)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $socio->ruta_foto2 = null;
        $socio->save();
        return redirect()->route('socios.edit', $id)->with('status', 'Foto principal del socio eliminada');
    }

    /**
     * Crear un nuevo cobro de transeúnte
     */
    public function crearCobroTranseunte(Request $request, $id)
    {
        $request->validate([
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'precio' => 'required|numeric|min:0',
        ]);

        $socio = SocioModel::findOrFail($id);
        
        $fechaEntrada = \Carbon\Carbon::parse($request->fecha_entrada);
        $fechaSalida = \Carbon\Carbon::parse($request->fecha_salida);
        $diferenciaDias = $fechaSalida->diffInDays($fechaEntrada);
        $total = $diferenciaDias * $request->precio;

        RegistrosEntradaTranseunte::create([
            'socio_id' => $socio->id,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'precio' => $request->precio,
            'total' => $total,
        ]);

        return redirect()->route('socios.edit', $id)->with('status', 'Cobro añadido correctamente');
    }

    /**
     * Actualizar un cobro de transeúnte (solo administradores)
     */
    public function actualizarCobroTranseunte(Request $request, $id, $cobroId)
    {
        // Verificar que el usuario es administrador (rol 1)
        if ((int) Auth::user()->role !== 1) {
            abort(403, 'Solo los administradores pueden editar cobros.');
        }

        $request->validate([
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'precio' => 'required|numeric|min:0',
        ]);

        $socio = SocioModel::findOrFail($id);
        $cobro = RegistrosEntradaTranseunte::where('socio_id', $id)->findOrFail($cobroId);
        
        $fechaEntrada = \Carbon\Carbon::parse($request->fecha_entrada);
        $fechaSalida = \Carbon\Carbon::parse($request->fecha_salida);
        $diferenciaDias = $fechaSalida->diffInDays($fechaEntrada);
        $total = $diferenciaDias * $request->precio;

        $cobro->update([
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'precio' => $request->precio,
            'total' => $total,
        ]);

        return redirect()->route('socios.edit', $id)->with('status', 'Cobro actualizado correctamente');
    }

    /**
     * Eliminar un cobro de transeúnte (solo administradores)
     */
    public function eliminarCobroTranseunte($id, $cobroId)
    {
        // Verificar que el usuario es administrador (rol 1)
        if ((int) Auth::user()->role !== 1) {
            abort(403, 'Solo los administradores pueden eliminar cobros.');
        }

        $cobro = RegistrosEntradaTranseunte::where('socio_id', $id)->findOrFail($cobroId);
        $cobro->delete();

        return redirect()->route('socios.edit', $id)->with('status', 'Cobro eliminado correctamente');
    }
}
