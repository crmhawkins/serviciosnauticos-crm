<?php

namespace App\Policies;

use App\Models\Socio;
use App\Models\Club;
use App\Models\User;
use App\Models\UserClub;

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

        // PN/GC/AP: sólo si el club es suyo (created_by = user->id)
        if (in_array((int) $user->role, [6,7,8], true)) {
            $club = Club::find($socio->club_id);
            return $club && (int) $club->created_by === (int) $user->id;
        }

        // Roles de gestión de club (ej. secretario, gerente, etc.)
        if (in_array((int) $user->role, [2,3,4], true)) {
            if (!$socio->club_id) {
                return false;
            }
            return UserClub::where('user_id', $user->id)
                ->where('club_id', $socio->club_id)
                ->exists();
        }

        // Resto no pueden editar
        return false;
    }

    public function create(User $user, int $clubId = null): bool
    {
        // Admin siempre
        if ((int) $user->role === 1) { return true; }

        if ($clubId === null) {
            return false; // necesitamos saber en qué club se va a crear
        }

        // PN/GC/AP: sólo si el club es suyo (created_by = user->id)
        if (in_array((int) $user->role, [6,7,8], true)) {
            $club = Club::find($clubId);
            return $club && (int) $club->created_by === (int) $user->id;
        }

        // Roles de gestión de club (secretario, etc.): sólo en clubs asignados
        if (in_array((int) $user->role, [2,3,4], true)) {
            return UserClub::where('user_id', $user->id)
                ->where('club_id', $clubId)
                ->exists();
        }

        return false;
    }
}


