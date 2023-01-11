<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Curso;

use App\Models\Faculdade;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursoControllerTest extends TestCase
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
    public function it_displays_index_view_with_cursos()
    {
        $cursos = Curso::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('cursos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.cursos.index')
            ->assertViewHas('cursos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_curso()
    {
        $response = $this->get(route('cursos.create'));

        $response->assertOk()->assertViewIs('app.cursos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_curso()
    {
        $data = Curso::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('cursos.store'), $data);

        $this->assertDatabaseHas('curso', $data);

        $curso = Curso::latest('id')->first();

        $response->assertRedirect(route('cursos.edit', $curso));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_curso()
    {
        $curso = Curso::factory()->create();

        $response = $this->get(route('cursos.show', $curso));

        $response
            ->assertOk()
            ->assertViewIs('app.cursos.show')
            ->assertViewHas('curso');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_curso()
    {
        $curso = Curso::factory()->create();

        $response = $this->get(route('cursos.edit', $curso));

        $response
            ->assertOk()
            ->assertViewIs('app.cursos.edit')
            ->assertViewHas('curso');
    }

    /**
     * @test
     */
    public function it_updates_the_curso()
    {
        $curso = Curso::factory()->create();

        $faculdade = Faculdade::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'faculdade_id' => $faculdade->id,
        ];

        $response = $this->put(route('cursos.update', $curso), $data);

        $data['id'] = $curso->id;

        $this->assertDatabaseHas('curso', $data);

        $response->assertRedirect(route('cursos.edit', $curso));
    }

    /**
     * @test
     */
    public function it_deletes_the_curso()
    {
        $curso = Curso::factory()->create();

        $response = $this->delete(route('cursos.destroy', $curso));

        $response->assertRedirect(route('cursos.index'));

        $this->assertModelMissing($curso);
    }
}
