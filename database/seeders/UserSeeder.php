<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin QuisArena',
            'email' => env('ADMIN_EMAIL', 'projek.msyafiq19@gmail.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'rahasia123')),
            'role' => 'admin',
        ]);

    }
}
