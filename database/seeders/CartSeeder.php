<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    public function run()
    {
        Cart::create([
            'user_id' => 1,
            'session_id' => 2,
            'quantity' => 3,
        ]);
    }
}