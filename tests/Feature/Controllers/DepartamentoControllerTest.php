<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Departamento;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartamentoControllerTest extends TestCase
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
    public function it_displays_index_view_with_departamentos()
    {
        $departamentos = Departamento::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('departamentos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.departamentos.index')
            ->assertViewHas('departamentos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_departamento()
    {
        $response = $this->get(route('departamentos.create'));

        $response->assertOk()->assertViewIs('app.departamentos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_departamento()
    {
        $data = Departamento::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('departamentos.store'), $data);

        $this->assertDatabaseHas('departamento', $data);

        $departamento = Departamento::latest('id')->first();

        $response->assertRedirect(route('departamentos.edit', $departamento));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_departamento()
    {
        $departamento = Departamento::factory()->create();

        $response = $this->get(route('departamentos.show', $departamento));

        $response
            ->assertOk()
            ->assertViewIs('app.departamentos.show')
            ->assertViewHas('departamento');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_departamento()
    {
        $departamento = Departamento::factory()->create();

        $response = $this->get(route('departamentos.edit', $departamento));

        $response
            ->assertOk()
            ->assertViewIs('app.departamentos.edit')
            ->assertViewHas('departamento');
    }

    /**
     * @test
     */
    public function it_updates_the_departamento()
    {
        $departamento = Departamento::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'area' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('departamentos.update', $departamento),
            $data
        );

        $data['id'] = $departamento->id;

        $this->assertDatabaseHas('departamento', $data);

        $response->assertRedirect(route('departamentos.edit', $departamento));
    }

    /**
     * @test
     */
    public function it_deletes_the_departamento()
    {
        $departamento = Departamento::factory()->create();

        $response = $this->delete(
            route('departamentos.destroy', $departamento)
        );

        $response->assertRedirect(route('departamentos.index'));

        $this->assertModelMissing($departamento);
    }
}
