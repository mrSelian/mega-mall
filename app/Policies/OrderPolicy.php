<?php

namespace App\Policies;

use App\Domain\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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

    public function changeStatus(User $user, Order $order): bool
    {
        return $user->id == $order->getSellerId();
    }
}
