<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Equipamento;

use App\Models\Sala;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipamentoTest extends TestCase
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
    public function it_gets_equipamentos_list()
    {
        $equipamentos = Equipamento::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.equipamentos.index'));

        $response->assertOk()->assertSee($equipamentos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_equipamento()
    {
        $data = Equipamento::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.equipamentos.store'), $data);

        $this->assertDatabaseHas('equipamento', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_equipamento()
    {
        $equipamento = Equipamento::factory()->create();

        $sala = Sala::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'num_serie' => $this->faker->text(255),
            'sala_id' => $sala->id,
        ];

        $response = $this->putJson(
            route('api.equipamentos.update', $equipamento),
            $data
        );

        $data['id'] = $equipamento->id;

        $this->assertDatabaseHas('equipamento', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_equipamento()
    {
        $equipamento = Equipamento::factory()->create();

        $response = $this->deleteJson(
            route('api.equipamentos.destroy', $equipamento)
        );

        $this->assertModelMissing($equipamento);

        $response->assertNoContent();
    }
}
