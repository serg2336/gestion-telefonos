<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            ['nombre' => 'Ventas', 'descripcion' => 'Departamento de ventas y atención al cliente'],
            ['nombre' => 'Marketing', 'descripcion' => 'Departamento de marketing y publicidad'],
            ['nombre' => 'Soporte Técnico', 'descripcion' => 'Soporte técnico y mantenimiento'],
            ['nombre' => 'Recursos Humanos', 'descripcion' => 'Gestión de personal y contrataciones'],
            ['nombre' => 'Desarrollo', 'descripcion' => 'Desarrollo de software y sistemas'],
            ['nombre' => 'Administración', 'descripcion' => 'Administración y finanzas'],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}