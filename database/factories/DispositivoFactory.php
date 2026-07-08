<?php

namespace Database\Factories;

use App\Models\Dispositivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DispositivoFactory extends Factory
{
    protected $model = Dispositivo::class;

    public function definition(): array
    {
        return [
            'marca' => $this->faker->randomElement(['Samsung', 'Apple', 'Xiaomi', 'Motorola', 'Huawei']),
            'modelo' => $this->faker->bothify('Modelo-??-####'),
            'numero_serie' => $this->faker->unique()->bothify('SN-#####'),
            'imei' => $this->faker->unique()->numerify('##############'),
            'estado' => 'disponible',
            'fecha_compra' => $this->faker->date(),
        ];
    }
}