<?php

namespace Tests\Feature;

use App\Models\Asignacion;
use App\Models\Departamento;
use App\Models\Dispositivo;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AsignacionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'admin']);
        $this->user = User::factory()->create(['rol' => 'usuario']);
    }

    public function test_index_returns_asignaciones()
    {
        Departamento::factory()->create();
        $empleado = Empleado::factory()->create();
        $dispositivo = Dispositivo::factory()->create(['estado' => 'asignado']);
        Asignacion::factory()->create([
            'empleado_id' => $empleado->id,
            'dispositivo_id' => $dispositivo->id,
        ]);

        $response = $this->actingAs($this->admin)->get('/asignaciones');

        $response->assertStatus(200);
    }

    public function test_create_asignacion_requires_admin()
    {
        $response = $this->actingAs($this->user)->get('/asignaciones/create');
        $response->assertStatus(403);
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/asignaciones');
        $response->assertRedirect('/login');
    }
}
