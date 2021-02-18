<?php

namespace App\Policies;

use App\Domain\Product;
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
        return $user->id == $product->getSellerId();
    }

    public function edit(User $user, Product $product): bool
    {
        return $user->id == $product->getSellerId();
    }

    public function update(User $user, Product $product): bool
    {
        return $user->id == $product->getSellerId();
    }
}
