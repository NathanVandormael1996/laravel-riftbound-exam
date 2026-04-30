<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Enums\UserRole;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Users can view their own list
    }

    public function view(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->id === $order->user_id;
    }

    public function create(User $user): bool
    {
        return true; // Users can create orders
    }

    public function update(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }
}
