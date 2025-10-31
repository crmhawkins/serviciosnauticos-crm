<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarcoFoto;
use App\Models\SocioFoto;

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
        $socio = \App\Models\Socio::find($id);
        
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }
        
        // Cargar relaciones
        $socio->load(['telefonos', 'numeros_llave', 'tripulantes', 'notas', 'socio_fotos', 'barco_fotos']);
        
        // Verificar permisos
        $puede_editar = auth()->user()->role <= 3;
        $puede_notas = auth()->user()->role <= 4;
        
        return view('socio.edit', compact('socio', 'puede_editar', 'puede_notas'));
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
        $socio = \App\Models\Socio::find($id);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $socio = \App\Models\Socio::find($id);
        if (!$socio) {
            abort(404, 'Socio no encontrado');
        }

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

        return redirect()->route('socios.edit', $socio->id)->with('status', 'Socio actualizado');
    }

    /**
     * Eliminar (placeholder)
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Marcar como destacada una foto de barco de la galería
     */
    public function destacarBarcoFoto($id, $fotoId)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $foto = BarcoFoto::where('socio_id', $id)->findOrFail($fotoId);
        // Resetear destacadas
        BarcoFoto::where('socio_id', $id)->update(['destacada' => false]);
        $foto->destacada = true;
        $foto->save();
        // Actualizar principal
        $socio->ruta_foto = $foto->ruta;
        $socio->save();
        return back()->with('status', 'Foto de barco destacada');
    }

    public function eliminarBarcoFoto($id, $fotoId)
    {
        $foto = BarcoFoto::where('socio_id', $id)->findOrFail($fotoId);
        $foto->delete();
        return back()->with('status', 'Foto de barco eliminada');
    }

    /**
     * Marcar como destacada una foto de socio de la galería
     */
    public function destacarSocioFoto($id, $fotoId)
    {
        $socio = \App\Models\Socio::findOrFail($id);
        $foto = SocioFoto::where('socio_id', $id)->findOrFail($fotoId);
        SocioFoto::where('socio_id', $id)->update(['destacada' => false]);
        $foto->destacada = true;
        $foto->save();
        $socio->ruta_foto2 = $foto->ruta;
        $socio->save();
        return back()->with('status', 'Foto de socio destacada');
    }

    public function eliminarSocioFoto($id, $fotoId)
    {
        $foto = SocioFoto::where('socio_id', $id)->findOrFail($fotoId);
        $foto->delete();
        return back()->with('status', 'Foto de socio eliminada');
    }
}
