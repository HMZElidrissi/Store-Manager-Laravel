<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sale;

class SalePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role->hasPermission('sales.index');
    }
}
