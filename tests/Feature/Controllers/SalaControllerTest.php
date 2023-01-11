<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Sala;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaControllerTest extends TestCase
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
    public function it_displays_index_view_with_salas()
    {
        $salas = Sala::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('salas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.salas.index')
            ->assertViewHas('salas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sala()
    {
        $response = $this->get(route('salas.create'));

        $response->assertOk()->assertViewIs('app.salas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sala()
    {
        $data = Sala::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('salas.store'), $data);

        $this->assertDatabaseHas('sala', $data);

        $sala = Sala::latest('id')->first();

        $response->assertRedirect(route('salas.edit', $sala));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sala()
    {
        $sala = Sala::factory()->create();

        $response = $this->get(route('salas.show', $sala));

        $response
            ->assertOk()
            ->assertViewIs('app.salas.show')
            ->assertViewHas('sala');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sala()
    {
        $sala = Sala::factory()->create();

        $response = $this->get(route('salas.edit', $sala));

        $response
            ->assertOk()
            ->assertViewIs('app.salas.edit')
            ->assertViewHas('sala');
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

        $response = $this->put(route('salas.update', $sala), $data);

        $data['id'] = $sala->id;

        $this->assertDatabaseHas('sala', $data);

        $response->assertRedirect(route('salas.edit', $sala));
    }

    /**
     * @test
     */
    public function it_deletes_the_sala()
    {
        $sala = Sala::factory()->create();

        $response = $this->delete(route('salas.destroy', $sala));

        $response->assertRedirect(route('salas.index'));

        $this->assertModelMissing($sala);
    }
}
