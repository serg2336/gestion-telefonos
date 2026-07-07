<?php

namespace Database\Factories;

use App\Models\Asignacion;
use App\Models\Dispositivo;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsignacionFactory extends Factory
{
    protected $model = Asignacion::class;

    public function definition(): array
    {
        return [
            'empleado_id' => Empleado::factory(),
            'dispositivo_id' => Dispositivo::factory(),
            'fecha_asignacion' => now()->subDays(rand(1, 30)),
            'fecha_devolucion' => null,
            'estado' => 'activo',
            'observaciones' => $this->faker->sentence(),
        ];
    }

    public function devuelto(): static
    {
        return $this->state(fn (array $attributes) => [
            'fecha_devolucion' => now()->subDays(rand(1, 10)),
            'estado' => 'devuelto',
        ]);
    }
}
