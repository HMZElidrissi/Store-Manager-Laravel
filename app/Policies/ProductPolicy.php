<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->hasPermission('products.index');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->hasPermission('products.store');
            // ? Response::allow()
            // : Response::deny('You do not have permission to create a product.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->role->hasPermission('products.update');
            // ? Response::allow()
            // : Response::deny('You do not have permission to update a product.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role->hasPermission('products.destroy');
            // ? Response::allow()
            // : Response::deny('You do not have permission to delete a product.');
    }
}
