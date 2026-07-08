<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $empleados = Empleado::all();

        if ($empleados->isEmpty()) return;

        if (!User::where('email', 'usuario@empresa.com')->exists()) {
            User::create([
                'name' => 'Usuario',
                'email' => 'usuario@empresa.com',
                'password' => Hash::make('password'),
                'rol' => 'usuario',
                'empleado_id' => $empleados->random()->id,
            ]);
        }

        $empleadosSinUsuario = $empleados->reject(fn($e) =>
            User::where('empleado_id', $e->id)->exists()
        );

        $empleadosSinUsuario->take(5)->each(fn($empleado) =>
            User::create([
                'name' => $empleado->primer_nombre . ' ' . $empleado->apellido,
                'email' => 'user.' . $empleado->id . '@empresa.com',
                'password' => Hash::make('password'),
                'rol' => 'usuario',
                'empleado_id' => $empleado->id,
            ])
        );
    }
}