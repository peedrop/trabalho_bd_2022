<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Turma;

use App\Models\Professor;
use App\Models\Disciplina;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TurmaControllerTest extends TestCase
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
    public function it_displays_index_view_with_turmas()
    {
        $turmas = Turma::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('turmas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.turmas.index')
            ->assertViewHas('turmas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_turma()
    {
        $response = $this->get(route('turmas.create'));

        $response->assertOk()->assertViewIs('app.turmas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_turma()
    {
        $data = Turma::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('turmas.store'), $data);

        $this->assertDatabaseHas('turma', $data);

        $turma = Turma::latest('id')->first();

        $response->assertRedirect(route('turmas.edit', $turma));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->get(route('turmas.show', $turma));

        $response
            ->assertOk()
            ->assertViewIs('app.turmas.show')
            ->assertViewHas('turma');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->get(route('turmas.edit', $turma));

        $response
            ->assertOk()
            ->assertViewIs('app.turmas.edit')
            ->assertViewHas('turma');
    }

    /**
     * @test
     */
    public function it_updates_the_turma()
    {
        $turma = Turma::factory()->create();

        $disciplina = Disciplina::factory()->create();
        $professor = Professor::factory()->create();

        $data = [
            'codigo' => $this->faker->text(255),
            'disciplina_id' => $disciplina->id,
            'professor_id' => $professor->id,
        ];

        $response = $this->put(route('turmas.update', $turma), $data);

        $data['id'] = $turma->id;

        $this->assertDatabaseHas('turma', $data);

        $response->assertRedirect(route('turmas.edit', $turma));
    }

    /**
     * @test
     */
    public function it_deletes_the_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->delete(route('turmas.destroy', $turma));

        $response->assertRedirect(route('turmas.index'));

        $this->assertModelMissing($turma);
    }
}
