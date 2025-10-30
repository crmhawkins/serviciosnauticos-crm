<?php

namespace App\Exports;

use App\Models\Usuario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsuariosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Usuario::select(['name','username','role','email'])->get();
    }

    public function headings(): array
    {
        return ['Alias','Username','Rol','Email'];
    }
}


