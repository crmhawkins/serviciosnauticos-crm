<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoritoSocio extends Model
{
    use HasFactory;

    protected $table = 'favoritos_socios';

    protected $fillable = [
        'socio_id',
        'created_by',
        'viewed_at',
    ];

    protected $dates = [
        'viewed_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con el socio
     */
    public function socio(): BelongsTo
    {
        return $this->belongsTo(Socio::class, 'socio_id');
    }

    /**
     * Relación con el usuario que creó el favorito
     */
    public function creador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Verificar si el favorito ha sido visto
     */
    public function isVisto(): bool
    {
        return !is_null($this->viewed_at);
    }

    /**
     * Marcar como visto
     */
    public function marcarVisto(): void
    {
        $this->update(['viewed_at' => now()]);
    }
}
