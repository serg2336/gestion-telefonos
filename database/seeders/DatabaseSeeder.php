<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartamentoSeeder::class,
            AdminUserSeeder::class,
        ]);

        \App\Models\Empleado::factory(20)->create();

        $this->call([
            UserSeeder::class,
        ]);

        \App\Models\Dispositivo::factory(30)->create();

        $empleados = \App\Models\Empleado::all();
        $dispositivos = \App\Models\Dispositivo::where('estado', 'disponible')->take(15)->get();

        foreach ($dispositivos as $dispositivo) {
            $fecha_asignacion = now()->subDays(rand(1, 180));
            $devuelto = rand(0, 1) ? $fecha_asignacion->copy()->addDays(rand(1, 90)) : null;

            \App\Models\Asignacion::create([
                'empleado_id' => $empleados->random()->id,
                'dispositivo_id' => $dispositivo->id,
                'fecha_asignacion' => $fecha_asignacion,
                'fecha_devolucion' => $devuelto,
                'estado' => $devuelto ? 'devuelto' : 'activo',
                'observaciones' => $devuelto
                    ? 'Dispositivo devuelto en buen estado'
                    : 'Asignado para uso diario',
            ]);

            if (!$devuelto) {
                $dispositivo->update(['estado' => 'asignado']);
            }
        }

        $this->garantizarAsignacionesUsuarioDemo();
    }

    private function garantizarAsignacionesUsuarioDemo()
    {
        $user = \App\Models\User::where('email', 'usuario@empresa.com')->first();
        if (!$user || !$user->empleado) return;

        $empleado = $user->empleado;

        $tieneActiva = $empleado->asignaciones()->whereIn('estado', ['activo', 'pendiente_devolver'])->exists();
        $tieneDevuelta = $empleado->asignaciones()->where('estado', 'devuelto')->exists();

        if (!$tieneDevuelta) {
            $dispositivo = \App\Models\Dispositivo::where('estado', 'disponible')->inRandomOrder()->first();
            if ($dispositivo) {
                $fecha = now()->subDays(rand(60, 120));
                \App\Models\Asignacion::create([
                    'empleado_id' => $empleado->id,
                    'dispositivo_id' => $dispositivo->id,
                    'fecha_asignacion' => $fecha,
                    'fecha_devolucion' => $fecha->copy()->addDays(rand(15, 45)),
                    'estado' => 'devuelto',
                    'observaciones' => 'Dispositivo devuelto en buen estado',
                ]);
                $dispositivo->update(['estado' => 'disponible']);
            }
        }

        if (!$tieneActiva) {
            $dispositivo = \App\Models\Dispositivo::where('estado', 'disponible')->inRandomOrder()->first();
            if ($dispositivo) {
                \App\Models\Asignacion::create([
                    'empleado_id' => $empleado->id,
                    'dispositivo_id' => $dispositivo->id,
                    'fecha_asignacion' => now()->subDays(rand(1, 30)),
                    'fecha_devolucion' => null,
                    'estado' => 'activo',
                    'observaciones' => 'Asignado para uso diario',
                ]);
                $dispositivo->update(['estado' => 'asignado']);
            }
        }
    }
}
