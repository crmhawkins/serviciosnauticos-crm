<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\Club;
use App\Models\Usuario;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SociosExport;
use PDF; // barryvdh/laravel-dompdf

class ExportController extends Controller
{
    public function sociosExcel(Request $request)
    {
        $clubId = session()->get('clubSeleccionado');
        $filename = 'socios_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new SociosExport($clubId), $filename);
    }

    public function sociosPdf(Request $request)
    {
        $clubId = session()->get('clubSeleccionado');
        $orderBy = $request->get('orderBy', 'nombre_socio');
        $orderDir = $request->get('orderDir', 'asc');
        $vista   = (int) $request->get('vista', 1);

        // Campos permitidos para ordenar
        $allowedOrderBy = [
            'pantalan_t_atraque',
            'nombre_socio',
            'numero_socio',
            'nombre_barco',
            'matricula',
        ];
        if (!in_array($orderBy, $allowedOrderBy, true)) {
            $orderBy = 'nombre_socio';
        }
        $orderDir = $orderDir === 'desc' ? 'desc' : 'asc';

        $query = Socio::with('telefonos');
        if ($clubId) {
            $query->where('club_id', $clubId);
        }

        // Aplicar el mismo filtro de "vista" que en el listado
        switch ($vista) {
            case 1: // Todos en alta
                $query->where('alta_baja', 0);
                break;
            case 2: // Socios en alta
                $query->where('situacion_persona', 0)
                      ->where('alta_baja', 0);
                break;
            case 3: // Socios en atraque
                $query->where('situacion_persona', 0)
                      ->where('alta_baja', 0)
                      ->where('situacion_barco', 0);
                break;
            case 4: // Socios en varada
                $query->where('situacion_persona', 0)
                      ->where('alta_baja', 0)
                      ->where('situacion_barco', 1);
                break;
            case 5: // Socios en baja
                $query->where('alta_baja', 1)
                      ->where('situacion_persona', 0);
                break;
            case 6: // Transeúntes en alta
                $query->where('situacion_persona', 1)
                      ->where('alta_baja', 0);
                break;
            case 7: // Transeúntes en atraque
                $query->where('situacion_persona', 1)
                      ->where('alta_baja', 0)
                      ->where('situacion_barco', 0);
                break;
            case 8: // Transeúntes en varada
                $query->where('situacion_persona', 1)
                      ->where('alta_baja', 0)
                      ->where('situacion_barco', 1);
                break;
            case 9: // Transeúntes en baja
                $query->where('alta_baja', 1)
                      ->where('situacion_persona', 1);
                break;
            case 10: // Socio/Transeúntes en alta
                $query->where('situacion_persona', 2)
                      ->where('alta_baja', 0);
                break;
            default:
                // mismo comportamiento que "todos en alta"
                $query->where('alta_baja', 0);
                break;
        }

        $socios = $query->orderBy($orderBy, $orderDir)->get();
        $pdf = PDF::loadView('exports.socios', [ 'socios' => $socios ]);
        return $pdf->download('socios_' . now()->format('Ymd_His') . '.pdf');
    }

    public function clubesExcel(Request $request)
    {
        $filename = 'clubes_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new \App\Exports\ClubesExport(), $filename);
    }

    public function clubesPdf(Request $request)
    {
        $clubes = Club::select(['id','nombre','email','club_logo'])->get();
        $pdf = PDF::loadView('exports.clubs', [ 'clubes' => $clubes ]);
        return $pdf->download('clubes_' . now()->format('Ymd_His') . '.pdf');
    }

    public function usuariosExcel(Request $request)
    {
        $filename = 'usuarios_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new \App\Exports\UsuariosExport(), $filename);
    }

    public function usuariosPdf(Request $request)
    {
        $usuarios = Usuario::select(['name','username','role','email'])->get();
        $pdf = PDF::loadView('exports.usuarios', [ 'usuarios' => $usuarios ]);
        return $pdf->download('usuarios_' . now()->format('Ymd_His') . '.pdf');
    }
}


