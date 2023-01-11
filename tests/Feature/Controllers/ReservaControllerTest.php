<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Reserva;

use App\Models\Sala;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_reservas()
    {
        $reservas = Reserva::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('reservas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.reservas.index')
            ->assertViewHas('reservas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_reserva()
    {
        $response = $this->get(route('reservas.create'));

        $response->assertOk()->assertViewIs('app.reservas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_reserva()
    {
        $data = Reserva::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('reservas.store'), $data);

        $this->assertDatabaseHas('reserva', $data);

        $reserva = Reserva::latest('id')->first();

        $response->assertRedirect(route('reservas.edit', $reserva));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->get(route('reservas.show', $reserva));

        $response
            ->assertOk()
            ->assertViewIs('app.reservas.show')
            ->assertViewHas('reserva');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->get(route('reservas.edit', $reserva));

        $response
            ->assertOk()
            ->assertViewIs('app.reservas.edit')
            ->assertViewHas('reserva');
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

        $response = $this->put(route('reservas.update', $reserva), $data);

        $data['id'] = $reserva->id;

        $this->assertDatabaseHas('reserva', $data);

        $response->assertRedirect(route('reservas.edit', $reserva));
    }

    /**
     * @test
     */
    public function it_deletes_the_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->delete(route('reservas.destroy', $reserva));

        $response->assertRedirect(route('reservas.index'));

        $this->assertModelMissing($reserva);
    }
}
