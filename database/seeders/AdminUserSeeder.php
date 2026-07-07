<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@empresa.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@empresa.com',
                'password' => Hash::make('password'),
                'rol' => 'admin',
            ]);
        }

        if (!User::where('email', 'usuario@empresa.com')->exists()) {
            User::create([
                'name' => 'Usuario',
                'email' => 'usuario@empresa.com',
                'password' => Hash::make('password'),
                'rol' => 'usuario',
            ]);
        }
    }
}