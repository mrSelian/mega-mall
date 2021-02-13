<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Product $product): bool
    {
        return $user->id == $product->user_id;
    }

    public function edit(User $user, Product $product): bool
    {
        return $user->id == $product->user_id;
    }

    public function update(User $user, Product $product): bool
    {
        return $user->id == $product->user_id;
    }
}
