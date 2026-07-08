<?php

namespace Database\Factories;

use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentoFactory extends Factory
{
    protected $model = Departamento::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Ventas', 'Soporte Técnico', 'Desarrollo', 'Recursos Humanos', 'Administración',
            ]),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
