<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sala;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaTest extends TestCase
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
    public function it_gets_salas_list()
    {
        $salas = Sala::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.salas.index'));

        $response->assertOk()->assertSee($salas[0]->numero);
    }

    /**
     * @test
     */
    public function it_stores_the_sala()
    {
        $data = Sala::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.salas.store'), $data);

        $this->assertDatabaseHas('sala', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sala()
    {
        $sala = Sala::factory()->create();

        $data = [
            'numero' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.salas.update', $sala), $data);

        $data['id'] = $sala->id;

        $this->assertDatabaseHas('sala', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sala()
    {
        $sala = Sala::factory()->create();

        $response = $this->deleteJson(route('api.salas.destroy', $sala));

        $this->assertModelMissing($sala);

        $response->assertNoContent();
    }
}
