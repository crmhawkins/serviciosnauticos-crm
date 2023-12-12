<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranseunteTripulantes extends Model
{
    use HasFactory;

    protected $table = "transeuntes_tripulantes";

    protected $fillable = [
        'socio_id',
        'nombre',
        'dni',
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
