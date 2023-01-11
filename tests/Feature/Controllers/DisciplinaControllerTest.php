<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Disciplina;

use App\Models\Curso;
use App\Models\Departamento;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisciplinaControllerTest extends TestCase
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
    public function it_displays_index_view_with_disciplinas()
    {
        $disciplinas = Disciplina::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('disciplinas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.disciplinas.index')
            ->assertViewHas('disciplinas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_disciplina()
    {
        $response = $this->get(route('disciplinas.create'));

        $response->assertOk()->assertViewIs('app.disciplinas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_disciplina()
    {
        $data = Disciplina::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('disciplinas.store'), $data);

        $this->assertDatabaseHas('disciplina', $data);

        $disciplina = Disciplina::latest('id')->first();

        $response->assertRedirect(route('disciplinas.edit', $disciplina));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $response = $this->get(route('disciplinas.show', $disciplina));

        $response
            ->assertOk()
            ->assertViewIs('app.disciplinas.show')
            ->assertViewHas('disciplina');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $response = $this->get(route('disciplinas.edit', $disciplina));

        $response
            ->assertOk()
            ->assertViewIs('app.disciplinas.edit')
            ->assertViewHas('disciplina');
    }

    /**
     * @test
     */
    public function it_updates_the_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $curso = Curso::factory()->create();
        $departamento = Departamento::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'codigo' => $this->faker->text(255),
            'curso_id' => $curso->id,
            'departamento_id' => $departamento->id,
        ];

        $response = $this->put(route('disciplinas.update', $disciplina), $data);

        $data['id'] = $disciplina->id;

        $this->assertDatabaseHas('disciplina', $data);

        $response->assertRedirect(route('disciplinas.edit', $disciplina));
    }

    /**
     * @test
     */
    public function it_deletes_the_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $response = $this->delete(route('disciplinas.destroy', $disciplina));

        $response->assertRedirect(route('disciplinas.index'));

        $this->assertModelMissing($disciplina);
    }
}
