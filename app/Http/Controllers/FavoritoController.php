<?php

namespace App\Http\Controllers;

use App\Models\FavoritoSocio;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Verificar si el usuario tiene acceso a favoritos
     */
    private function tieneAcceso(): bool
    {
        $user = Auth::user();
        return in_array((int) $user->role, [1, 6], true); // Admin (1) o Policía Nacional (6)
    }

    /**
     * Listar todos los favoritos
     */
    public function index()
    {
        if (!$this->tieneAcceso()) {
            abort(403, 'No tienes acceso a esta sección');
        }

        $favoritos = FavoritoSocio::with(['socio.telefonos', 'creador'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Contar favoritos no vistos
        $noVistos = FavoritoSocio::whereNull('viewed_at')->count();

        return view('favoritos.index', compact('favoritos', 'noVistos'));
    }

    /**
     * Añadir un socio a favoritos
     */
    public function store(Request $request, $socioId)
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['error' => 'No tienes acceso'], 403);
        }

        $socio = Socio::findOrFail($socioId);

        // Verificar si ya existe
        $existe = FavoritoSocio::where('socio_id', $socioId)->exists();
        if ($existe) {
            return response()->json(['error' => 'Este socio ya está en favoritos'], 400);
        }

        FavoritoSocio::create([
            'socio_id' => $socioId,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Socio añadido a favoritos']);
    }

    /**
     * Eliminar un favorito por ID
     */
    public function destroy($id)
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['error' => 'No tienes acceso'], 403);
        }

        $favorito = FavoritoSocio::findOrFail($id);
        $favorito->delete();

        return response()->json(['success' => true, 'message' => 'Favorito eliminado']);
    }

    /**
     * Eliminar un favorito por socio_id
     */
    public function destroyBySocio($socioId)
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['error' => 'No tienes acceso'], 403);
        }

        $favorito = FavoritoSocio::where('socio_id', $socioId)->first();
        
        if (!$favorito) {
            return response()->json(['error' => 'Favorito no encontrado'], 404);
        }

        $favorito->delete();

        return response()->json(['success' => true, 'message' => 'Favorito eliminado']);
    }

    /**
     * Marcar favorito como visto
     */
    public function marcarVisto($id)
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['error' => 'No tienes acceso'], 403);
        }

        $favorito = FavoritoSocio::findOrFail($id);
        $favorito->marcarVisto();

        return response()->json(['success' => true]);
    }

    /**
     * Obtener contador de favoritos no vistos (para el badge)
     */
    public function contadorNoVistos()
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['count' => 0]);
        }

        $count = FavoritoSocio::whereNull('viewed_at')->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Verificar si hay favoritos nuevos (para la alerta)
     */
    public function hayNuevos()
    {
        if (!$this->tieneAcceso()) {
            return response()->json(['hayNuevos' => false]);
        }

        $hayNuevos = FavoritoSocio::whereNull('viewed_at')->exists();
        return response()->json(['hayNuevos' => $hayNuevos]);
    }
}
