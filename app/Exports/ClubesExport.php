<?php

namespace App\Exports;

use App\Models\Club;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClubesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Club::select(['id','nombre','email'])->get();
    }

    public function headings(): array
    {
        return ['ID','Nombre del club','Email'];
    }
}


