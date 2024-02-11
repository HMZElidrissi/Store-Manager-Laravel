<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('permissions.index');
    }

    /**
     * Determine whether the user can assign a permission to a role.
     */
    public function assign(User $user): bool
    {
        return $user->hasPermission('permissions.assign');
    }

    /**
     * Determine whether the user can revoke a permission from a role.
     */
    public function revoke(User $user): bool
    {
        return $user->hasPermission('permissions.revoke');
    }
}
