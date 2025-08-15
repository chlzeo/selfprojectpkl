<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('role', 'admin')->first();
        $authorUser = User::where('role', 'author')->first();
        $categories = Category::all();

        if ($adminUser && $authorUser && $categories->count() > 0) {
            for ($i = 1; $i <= 10; $i++) {
                $user = ($i % 2 == 0) ? $adminUser : $authorUser;
                $category = $categories->random();

                $title = "Sample Informasi " . $i . " - " . $category->name;
                Informasi::create([
                    'title' => $title,
                    'meta_desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla exercitationem tenetur ad. Cum quo illum dolores dolore optio eius accusantium beatae incidunt repudiandae?',
                    'slug' => Str::slug($title),
                    'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla exercitationem tenetur ad. Cum quo illum dolores dolore optio eius accusantium beatae incidunt repudiandae? Perspiciatis temporibus omnis, optio enim asperiores ducimus?',
                    'status' => true,
                ]);
            }
        }
    }
}
