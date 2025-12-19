<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Socio extends Model
{
    use HasFactory;
    protected $table = "socios";

    protected $fillable = [
        'club_id',
        'situacion_persona',
        'situacion_barco',
        'numero_socio',
        'nombre_socio',
        'dni',
        'direccion',
        'email',
        'pantalan_t_atraque',
        'nombre_barco',
        'matricula',
        'eslora',
        'manga',
        'calado',
        'puntal',
        'seguro_barco',
        'poliza',
        'vencimiento',
        'itb',
        'ruta_foto',
        'ruta_foto2',
        'pin_socio',
        'alta_baja',
        'atraque_fijo',
    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * Get all of the comments for the Socio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'socio_id');
    }
    public function telefonos(): HasMany
    {
        return $this->hasMany(Telefonos::class, 'socio_id');
    }
    public function numeros_llave(): HasMany
    {
        return $this->hasMany(NumerosLlave::class, 'socio_id');
    }
    public function tripulantes(): HasMany
    {
        return $this->hasMany(TranseunteTripulantes::class, 'socio_id');
    }
    public function registros_entrada(): HasMany
    {
        return $this->hasMany(RegistrosEntrada::class, 'socio_id');
    }
    public function registros_entradas_transeuntes(): HasMany
    {
        return $this->hasMany(RegistrosEntradaTranseunte::class, 'socio_id');
    }

    public function socio_fotos(): HasMany
    {
        return $this->hasMany(SocioFoto::class, 'socio_id')->orderBy('orden');
    }

    public function barco_fotos(): HasMany
    {
        return $this->hasMany(BarcoFoto::class, 'socio_id')->orderBy('orden');
    }

    public function favorito(): HasMany
    {
        return $this->hasMany(FavoritoSocio::class, 'socio_id');
    }
}
