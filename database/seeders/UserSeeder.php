<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@myblog.com',
            'password' => Hash::make('admin1234'),
            'phone' => '081370021414',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Tira Nur Indah',
            'email' => 'tira@myblog.com',
            'password' => Hash::make('admin1234'),
            'phone' => '081370021414',
            'role' => 'author',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'M. Artanabil',
            'email' => 'bibib@myblog.com',
            'password' => Hash::make('12345678'),
            'phone' => '081370021414',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

    }
}