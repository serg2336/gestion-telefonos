<?php

namespace Tests\Feature;

use App\Models\Dispositivo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DispositivoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'admin']);
        $this->user = User::factory()->create(['rol' => 'usuario']);
    }

    public function test_index_returns_dispositivos()
    {
        Dispositivo::factory()->create(['marca' => 'Samsung']);

        $response = $this->actingAs($this->admin)->get('/dispositivos');

        $response->assertStatus(200);
        $response->assertSee('Samsung');
    }

    public function test_create_dispositivo_requires_admin()
    {
        $response = $this->actingAs($this->user)->get('/dispositivos/create');
        $response->assertStatus(403);
    }

    public function test_edit_dispositivo_requires_admin()
    {
        $dispositivo = Dispositivo::factory()->create();

        $response = $this->actingAs($this->user)->get("/dispositivos/{$dispositivo->id}/edit");
        $response->assertStatus(403);
    }

    public function test_show_dispositivo_allows_all_users()
    {
        $dispositivo = Dispositivo::factory()->create();

        $response = $this->actingAs($this->user)->get("/dispositivos/{$dispositivo->id}");

        $response->assertStatus(200);
    }
}
