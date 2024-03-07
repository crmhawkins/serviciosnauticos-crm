<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosEntradaTranseunte extends Model
{
    use HasFactory;

    protected $table = "registros_entradas_transeuntes";

    protected $fillable = [
        'socio_id',
        'fecha_entrada',
        'fecha_salida',
        'precio',
        'total',
        'estado'
    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
