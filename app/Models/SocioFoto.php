<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocioFoto extends Model
{
    use HasFactory;

    protected $table = 'socio_fotos';

    protected $fillable = [
        'socio_id', 'ruta', 'destacada', 'orden'
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}


