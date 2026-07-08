<?php

namespace Tests\Feature;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartamentoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'admin']);
        $this->user = User::factory()->create(['rol' => 'usuario']);
    }

    public function test_index_returns_departamentos()
    {
        Departamento::factory()->create(['nombre' => 'Ventas']);

        $response = $this->actingAs($this->admin)->get('/departamentos');

        $response->assertStatus(200);
        $response->assertSee('Ventas');
    }

    public function test_create_departamento_requires_admin()
    {
        $response = $this->actingAs($this->user)->get('/departamentos/create');
        $response->assertStatus(403);
    }

    public function test_create_departamento_allows_admin()
    {
        $response = $this->actingAs($this->admin)->get('/departamentos/create');
        $response->assertStatus(200);
    }

    public function test_edit_departamento_requires_admin()
    {
        $departamento = Departamento::factory()->create();

        $response = $this->actingAs($this->user)->get("/departamentos/{$departamento->id}/edit");
        $response->assertStatus(403);
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/departamentos');
        $response->assertRedirect('/login');
    }
}
