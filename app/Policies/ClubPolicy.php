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
        // Admin o roles PN/GC (6,7)
        return in_array((int) $user->role, [1,6,7], true);
    }
}


