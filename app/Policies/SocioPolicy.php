<?php

namespace App\Policies;

use App\Models\Socio;
use App\Models\Club;
use App\Models\User;

class SocioPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Todos pueden listar/ver socios
    }

    public function view(User $user, Socio $socio): bool
    {
        return true; // Todos pueden ver
    }

    public function update(User $user, Socio $socio): bool
    {
        // Admin siempre
        if ((int) $user->role === 1) { return true; }

        // PN/GC: sólo si el club es suyo (created_by = user->id)
        if (in_array((int) $user->role, [6,7], true)) {
            $club = Club::find($socio->club_id);
            return $club && (int) $club->created_by === (int) $user->id;
        }

        // Resto: comportamiento actual (por ahora, negar para ser conservadores)
        return false;
    }

    public function create(User $user, int $clubId = null): bool
    {
        if ((int) $user->role === 1) { return true; }
        if (in_array((int) $user->role, [6,7], true)) {
            if ($clubId === null) return false; // exigimos club destino
            $club = Club::find($clubId);
            return $club && (int) $club->created_by === (int) $user->id;
        }
        return false;
    }
}


