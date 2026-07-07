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
        // 1. Departamentos realistas
        $departamentos = [
            ['nombre' => 'Ventas', 'descripcion' => 'Comercialización y atención a clientes'],
            ['nombre' => 'Soporte Técnico', 'descripcion' => 'Mantenimiento y soporte de dispositivos'],
            ['nombre' => 'Desarrollo', 'descripcion' => 'Desarrollo de software y sistemas internos'],
            ['nombre' => 'Recursos Humanos', 'descripcion' => 'Gestión del personal y contrataciones'],
            ['nombre' => 'Administración', 'descripcion' => 'Finanzas, contabilidad y administración general'],
        ];
        foreach ($departamentos as $dep) {
            Departamento::create($dep);
        }

        // 2. Empleados con factory (Faker: nombres, emails y teléfonos realistas)
        Empleado::factory(20)->create();

        // 3. Dispositivos con factory (Faker: marcas, modelos y números de serie realistas)
        Dispositivo::factory(30)->create();

        // 4. Asignaciones realistas
        $empleados = Empleado::all();
        $dispositivos = Dispositivo::where('estado', 'disponible')->take(15)->get();

        foreach ($dispositivos as $dispositivo) {
            $fecha_asignacion = now()->subDays(rand(1, 180));
            $devuelto = rand(0, 1) ? $fecha_asignacion->copy()->addDays(rand(1, 90)) : null;

            Asignacion::create([
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

        // 5. Usuarios
        $this->call(AdminUserSeeder::class);
    }
}