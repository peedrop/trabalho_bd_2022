<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Faculdade;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaculdadeControllerTest extends TestCase
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
    public function it_displays_index_view_with_faculdades()
    {
        $faculdades = Faculdade::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('faculdades.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.faculdades.index')
            ->assertViewHas('faculdades');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_faculdade()
    {
        $response = $this->get(route('faculdades.create'));

        $response->assertOk()->assertViewIs('app.faculdades.create');
    }

    /**
     * @test
     */
    public function it_stores_the_faculdade()
    {
        $data = Faculdade::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('faculdades.store'), $data);

        $this->assertDatabaseHas('faculdade', $data);

        $faculdade = Faculdade::latest('id')->first();

        $response->assertRedirect(route('faculdades.edit', $faculdade));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $response = $this->get(route('faculdades.show', $faculdade));

        $response
            ->assertOk()
            ->assertViewIs('app.faculdades.show')
            ->assertViewHas('faculdade');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $response = $this->get(route('faculdades.edit', $faculdade));

        $response
            ->assertOk()
            ->assertViewIs('app.faculdades.edit')
            ->assertViewHas('faculdade');
    }

    /**
     * @test
     */
    public function it_updates_the_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'endereco' => $this->faker->address,
        ];

        $response = $this->put(route('faculdades.update', $faculdade), $data);

        $data['id'] = $faculdade->id;

        $this->assertDatabaseHas('faculdade', $data);

        $response->assertRedirect(route('faculdades.edit', $faculdade));
    }

    /**
     * @test
     */
    public function it_deletes_the_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $response = $this->delete(route('faculdades.destroy', $faculdade));

        $response->assertRedirect(route('faculdades.index'));

        $this->assertModelMissing($faculdade);
    }
}
