<?php

namespace App\Exports;

use App\Models\Socio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SociosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Socio::select([
            'id',
            'nombre_socio',
            'nombre_barco',
            'matricula',
            'pantalan_t_atraque',
            'situacion_persona',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Socio',
            'Barco',
            'Matrícula',
            'Pantalán/Atraque',
            'Situación',
        ];
    }
}


