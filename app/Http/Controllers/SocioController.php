<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $socio->load(['telefonos', 'numeros_llave', 'tripulantes', 'notas']);
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }}
