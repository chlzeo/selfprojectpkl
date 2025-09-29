<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // Izinkan admin melakukan apa saja
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    // Siapa yang boleh melihat produk?
    public function view(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    // Siapa yang boleh mengedit/update produk?
    public function update(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    // Siapa yang boleh menghapus produk?
    public function delete(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }
}