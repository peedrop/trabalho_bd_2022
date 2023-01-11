<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sala;
use App\Models\Equipamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaEquipamentosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_sala_equipamentos()
    {
        $sala = Sala::factory()->create();
        $equipamentos = Equipamento::factory()
            ->count(2)
            ->create([
                'sala_id' => $sala->id,
            ]);

        $response = $this->getJson(
            route('api.salas.equipamentos.index', $sala)
        );

        $response->assertOk()->assertSee($equipamentos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_sala_equipamentos()
    {
        $sala = Sala::factory()->create();
        $data = Equipamento::factory()
            ->make([
                'sala_id' => $sala->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.salas.equipamentos.store', $sala),
            $data
        );

        $this->assertDatabaseHas('equipamento', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $equipamento = Equipamento::latest('id')->first();

        $this->assertEquals($sala->id, $equipamento->sala_id);
    }
}
