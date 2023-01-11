<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Aluno;
use App\Models\Curso;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoCursosTest extends TestCase
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
    public function it_gets_aluno_cursos()
    {
        $aluno = Aluno::factory()->create();
        $curso = Curso::factory()->create();

        $aluno->cursos()->attach($curso);

        $response = $this->getJson(route('api.alunos.cursos.index', $aluno));

        $response->assertOk()->assertSee($curso->nome);
    }

    /**
     * @test
     */
    public function it_can_attach_cursos_to_aluno()
    {
        $aluno = Aluno::factory()->create();
        $curso = Curso::factory()->create();

        $response = $this->postJson(
            route('api.alunos.cursos.store', [$aluno, $curso])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $aluno
                ->cursos()
                ->where('curso.id', $curso->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_cursos_from_aluno()
    {
        $aluno = Aluno::factory()->create();
        $curso = Curso::factory()->create();

        $response = $this->deleteJson(
            route('api.alunos.cursos.store', [$aluno, $curso])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $aluno
                ->cursos()
                ->where('curso.id', $curso->id)
                ->exists()
        );
    }
}
