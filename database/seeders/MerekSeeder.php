<?php

namespace Database\Seeders;

use App\Models\Merek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merek = ['Lamborghini', 'Ferari', 'Pagani', 'Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Mitsubishi', 'Nissan', 'Mazda'];

        foreach ($merek as $merek) {
            Merek::create([
                'name' => $merek,
                'slug' => Str::slug($merek),
            ]);
        }
    }
}