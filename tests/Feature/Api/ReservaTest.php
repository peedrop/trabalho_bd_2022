<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Reserva;

use App\Models\Sala;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaTest extends TestCase
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
    public function it_gets_reservas_list()
    {
        $reservas = Reserva::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.reservas.index'));

        $response->assertOk()->assertSee($reservas[0]->data);
    }

    /**
     * @test
     */
    public function it_stores_the_reserva()
    {
        $data = Reserva::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.reservas.store'), $data);

        $this->assertDatabaseHas('reserva', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_reserva()
    {
        $reserva = Reserva::factory()->create();

        $sala = Sala::factory()->create();

        $data = [
            'data' => $this->faker->date,
            'sala_id' => $sala->id,
        ];

        $response = $this->putJson(
            route('api.reservas.update', $reserva),
            $data
        );

        $data['id'] = $reserva->id;

        $this->assertDatabaseHas('reserva', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->deleteJson(route('api.reservas.destroy', $reserva));

        $this->assertModelMissing($reserva);

        $response->assertNoContent();
    }
}
