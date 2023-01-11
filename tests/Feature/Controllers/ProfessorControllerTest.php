<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Professor;

use App\Models\Departamento;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessorControllerTest extends TestCase
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
    public function it_displays_index_view_with_professors()
    {
        $professors = Professor::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('professors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.professors.index')
            ->assertViewHas('professors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_professor()
    {
        $response = $this->get(route('professors.create'));

        $response->assertOk()->assertViewIs('app.professors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_professor()
    {
        $data = Professor::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('professors.store'), $data);

        $this->assertDatabaseHas('professor', $data);

        $professor = Professor::latest('id')->first();

        $response->assertRedirect(route('professors.edit', $professor));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_professor()
    {
        $professor = Professor::factory()->create();

        $response = $this->get(route('professors.show', $professor));

        $response
            ->assertOk()
            ->assertViewIs('app.professors.show')
            ->assertViewHas('professor');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_professor()
    {
        $professor = Professor::factory()->create();

        $response = $this->get(route('professors.edit', $professor));

        $response
            ->assertOk()
            ->assertViewIs('app.professors.edit')
            ->assertViewHas('professor');
    }

    /**
     * @test
     */
    public function it_updates_the_professor()
    {
        $professor = Professor::factory()->create();

        $departamento = Departamento::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'departamento_id' => $departamento->id,
        ];

        $response = $this->put(route('professors.update', $professor), $data);

        $data['id'] = $professor->id;

        $this->assertDatabaseHas('professor', $data);

        $response->assertRedirect(route('professors.edit', $professor));
    }

    /**
     * @test
     */
    public function it_deletes_the_professor()
    {
        $professor = Professor::factory()->create();

        $response = $this->delete(route('professors.destroy', $professor));

        $response->assertRedirect(route('professors.index'));

        $this->assertModelMissing($professor);
    }
}
