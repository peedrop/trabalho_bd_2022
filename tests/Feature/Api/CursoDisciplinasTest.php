<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Curso;
use App\Models\Disciplina;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursoDisciplinasTest extends TestCase
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
    public function it_gets_curso_disciplinas()
    {
        $curso = Curso::factory()->create();
        $disciplinas = Disciplina::factory()
            ->count(2)
            ->create([
                'curso_id' => $curso->id,
            ]);

        $response = $this->getJson(
            route('api.cursos.disciplinas.index', $curso)
        );

        $response->assertOk()->assertSee($disciplinas[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_curso_disciplinas()
    {
        $curso = Curso::factory()->create();
        $data = Disciplina::factory()
            ->make([
                'curso_id' => $curso->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cursos.disciplinas.store', $curso),
            $data
        );

        $this->assertDatabaseHas('disciplina', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $disciplina = Disciplina::latest('id')->first();

        $this->assertEquals($curso->id, $disciplina->curso_id);
    }
}
