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
        $query = Socio::with('telefonos');
        if ($clubId) { $query->where('club_id', $clubId); }
        $socios = $query->get();
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


