<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Curso;
use App\Models\Aluno;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursoAlunosTest extends TestCase
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
    public function it_gets_curso_alunos()
    {
        $curso = Curso::factory()->create();
        $aluno = Aluno::factory()->create();

        $curso->alunos()->attach($aluno);

        $response = $this->getJson(route('api.cursos.alunos.index', $curso));

        $response->assertOk()->assertSee($aluno->nome);
    }

    /**
     * @test
     */
    public function it_can_attach_alunos_to_curso()
    {
        $curso = Curso::factory()->create();
        $aluno = Aluno::factory()->create();

        $response = $this->postJson(
            route('api.cursos.alunos.store', [$curso, $aluno])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $curso
                ->alunos()
                ->where('aluno.id', $aluno->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_alunos_from_curso()
    {
        $curso = Curso::factory()->create();
        $aluno = Aluno::factory()->create();

        $response = $this->deleteJson(
            route('api.cursos.alunos.store', [$curso, $aluno])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $curso
                ->alunos()
                ->where('aluno.id', $aluno->id)
                ->exists()
        );
    }
}
