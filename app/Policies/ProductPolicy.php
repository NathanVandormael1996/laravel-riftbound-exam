<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Enums\UserRole;

class ProductPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Product $product): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function update(User $user, Product $product): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function restore(User $user, Product $product): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }
}
