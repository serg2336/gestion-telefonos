<?php

namespace Tests\Feature;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'admin']);
        $this->user = User::factory()->create(['rol' => 'usuario']);
    }

    public function test_index_returns_empleados()
    {
        Departamento::factory()->create();
        Empleado::factory()->create(['primer_nombre' => 'Carlos']);

        $response = $this->actingAs($this->admin)->get('/empleados');

        $response->assertStatus(200);
        $response->assertSee('Carlos');
    }

    public function test_create_empleado_requires_admin()
    {
        $response = $this->actingAs($this->user)->get('/empleados/create');
        $response->assertStatus(403);
    }

    public function test_edit_empleado_requires_admin()
    {
        $departamento = Departamento::factory()->create();
        $empleado = Empleado::factory()->create();

        $response = $this->actingAs($this->user)->get("/empleados/{$empleado->id}/edit");
        $response->assertStatus(403);
    }

    public function test_show_empleado_allows_all_users()
    {
        $departamento = Departamento::factory()->create();
        $empleado = Empleado::factory()->create();

        $response = $this->actingAs($this->user)->get("/empleados/{$empleado->id}");

        $response->assertStatus(200);
    }
}
