<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'primer_nombre' => fake()->firstName(),
        'apellido' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'telefono' => fake()->phoneNumber(),
        'identificacion' => fake()->unique()->numerify('########'),
        'departamento_id' => \App\Models\Departamento::inRandomOrder()->first()->id ?? null,
        'created_at' => now(),
        'updated_at' => now(),
    ];
}
}
