<?php

namespace App\Policies;

use App\Models\Club;
use App\Models\User;

class ClubPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Todos pueden listar/ver
    }

    public function view(User $user, Club $club): bool
    {
        return true; // Todos pueden ver
    }

    public function create(User $user): bool
    {
        // Admin o roles PN/GC/AP (6,7,8)
        return in_array((int) $user->role, [1,6,7,8], true);
    }

    public function update(User $user, Club $club): bool
    {
        // Admin siempre puede editar
        if ((int) $user->role === 1) {
            return true;
        }

        // PN/GC/AP: solo pueden editar clubes que ellos crearon
        if (in_array((int) $user->role, [6,7,8], true)) {
            return (int) $club->created_by === (int) $user->id;
        }

        // Resto no pueden editar
        return false;
    }
}


