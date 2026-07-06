<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Dispositivo;
use App\Models\Asignacion;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear departamentos
        $departamentos = [
            ['nombre' => 'Ventas'],
            ['nombre' => 'Soporte'],
            ['nombre' => 'Desarrollo'],
            ['nombre' => 'Administración'],
        ];
        foreach ($departamentos as $dep) {
            Departamento::create($dep);
        }

        // 2. Crear 20 empleados
        Empleado::factory(20)->create();

        // 3. Crear 30 dispositivos
        Dispositivo::factory(30)->create();

        // 4. Crear 10 asignaciones activas
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
            // Cambiar estado del dispositivo a "asignado"
            $dispositivo->update(['estado' => 'asignado']);
        }
    }
}