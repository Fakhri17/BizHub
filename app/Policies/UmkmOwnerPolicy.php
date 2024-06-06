<?php

namespace App\Policies;

use App\Models\User;

class UmkmOwnerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Super Admin', 'UMKM Owner']);
    }
}
