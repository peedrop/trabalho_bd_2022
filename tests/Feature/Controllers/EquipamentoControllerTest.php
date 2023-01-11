<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Equipamento;

use App\Models\Sala;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipamentoControllerTest extends TestCase
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
    public function it_displays_index_view_with_equipamentos()
    {
        $equipamentos = Equipamento::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('equipamentos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.equipamentos.index')
            ->assertViewHas('equipamentos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_equipamento()
    {
        $response = $this->get(route('equipamentos.create'));

        $response->assertOk()->assertViewIs('app.equipamentos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_equipamento()
    {
        $data = Equipamento::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('equipamentos.store'), $data);

        $this->assertDatabaseHas('equipamento', $data);

        $equipamento = Equipamento::latest('id')->first();

        $response->assertRedirect(route('equipamentos.edit', $equipamento));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_equipamento()
    {
        $equipamento = Equipamento::factory()->create();

        $response = $this->get(route('equipamentos.show', $equipamento));

        $response
            ->assertOk()
            ->assertViewIs('app.equipamentos.show')
            ->assertViewHas('equipamento');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_equipamento()
    {
        $equipamento = Equipamento::factory()->create();

        $response = $this->get(route('equipamentos.edit', $equipamento));

        $response
            ->assertOk()
            ->assertViewIs('app.equipamentos.edit')
            ->assertViewHas('equipamento');
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

        $response = $this->put(
            route('equipamentos.update', $equipamento),
            $data
        );

        $data['id'] = $equipamento->id;

        $this->assertDatabaseHas('equipamento', $data);

        $response->assertRedirect(route('equipamentos.edit', $equipamento));
    }

    /**
     * @test
     */
    public function it_deletes_the_equipamento()
    {
        $equipamento = Equipamento::factory()->create();

        $response = $this->delete(route('equipamentos.destroy', $equipamento));

        $response->assertRedirect(route('equipamentos.index'));

        $this->assertModelMissing($equipamento);
    }
}
