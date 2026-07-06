<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Dispositivo;
use App\Models\Asignacion;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Departamentos
        $departamentos = [
            ['nombre' => 'Ventas'],
            ['nombre' => 'Soporte'],
            ['nombre' => 'Desarrollo'],
            ['nombre' => 'Administración'],
        ];
        foreach ($departamentos as $dep) {
            Departamento::create($dep);
        }

        // 2. Empleados (20) - SIN FACTORY
        for ($i = 1; $i <= 20; $i++) {
            Empleado::create([
                'primer_nombre' => 'Empleado' . $i,
                'apellido' => 'Apellido' . $i,
                'email' => 'empleado' . $i . '@example.com',
                'telefono' => '12345678' . $i,
                'identificacion' => 'ID' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'departamento_id' => Departamento::inRandomOrder()->first()->id ?? 1,
            ]);
        }

        // 3. Dispositivos (30) - SIN FACTORY
        for ($i = 1; $i <= 30; $i++) {
            Dispositivo::create([
                'marca' => ['Samsung', 'Apple', 'Xiaomi', 'Motorola', 'Huawei'][array_rand(['Samsung', 'Apple', 'Xiaomi', 'Motorola', 'Huawei'])],
                'modelo' => 'Modelo-' . $i,
                'numero_serie' => 'SN-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'imei' => str_pad($i, 15, '0', STR_PAD_LEFT),
                'estado' => 'disponible',
                'fecha_compra' => now()->subDays(rand(1, 365)),
                'observaciones' => 'Dispositivo ' . $i,
            ]);
        }

        // 4. Asignaciones (10 activas)
        $empleados = Empleado::all();
        $dispositivos = Dispositivo::where('estado', 'disponible')->take(10)->get();

        foreach ($dispositivos as $dispositivo) {
            Asignacion::create([
                'empleado_id' => $empleados->random()->id,
                'dispositivo_id' => $dispositivo->id,
                'fecha_asignacion' => now()->subDays(rand(1, 30)),
                'estado' => 'activo',
                'observaciones' => 'Asignación automática desde seeder',
            ]);
            $dispositivo->update(['estado' => 'asignado']);
        }

        // 5. Crear un usuario administrador (si no existe)
        if (!\App\Models\User::where('email', 'admin@example.com')->exists()) {
            \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'rol' => 'admin',
            ]);
        }
    }
}