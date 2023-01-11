<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sala;
use App\Models\Reserva;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaReservasTest extends TestCase
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
    public function it_gets_sala_reservas()
    {
        $sala = Sala::factory()->create();
        $reservas = Reserva::factory()
            ->count(2)
            ->create([
                'sala_id' => $sala->id,
            ]);

        $response = $this->getJson(route('api.salas.reservas.index', $sala));

        $response->assertOk()->assertSee($reservas[0]->data);
    }

    /**
     * @test
     */
    public function it_stores_the_sala_reservas()
    {
        $sala = Sala::factory()->create();
        $data = Reserva::factory()
            ->make([
                'sala_id' => $sala->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.salas.reservas.store', $sala),
            $data
        );

        $this->assertDatabaseHas('reserva', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reserva = Reserva::latest('id')->first();

        $this->assertEquals($sala->id, $reserva->sala_id);
    }
}
