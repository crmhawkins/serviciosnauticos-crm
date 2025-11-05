<?php

namespace App\Exports;

use App\Models\Socio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SociosExport implements FromCollection, WithHeadings
{
    private $clubId;

    public function __construct($clubId = null)
    {
        $this->clubId = $clubId;
    }

    public function collection()
    {
        $query = Socio::select([
            'id',
            'nombre_socio',
            'nombre_barco',
            'matricula',
            'pantalan_t_atraque',
            'situacion_persona',
        ]);
        if ($this->clubId) {
            $query->where('club_id', $this->clubId);
        }
        return $query->get();
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


