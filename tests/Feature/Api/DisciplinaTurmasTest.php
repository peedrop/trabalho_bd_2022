<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Turma;
use App\Models\Disciplina;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisciplinaTurmasTest extends TestCase
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
    public function it_gets_disciplina_turmas()
    {
        $disciplina = Disciplina::factory()->create();
        $turmas = Turma::factory()
            ->count(2)
            ->create([
                'disciplina_id' => $disciplina->id,
            ]);

        $response = $this->getJson(
            route('api.disciplinas.turmas.index', $disciplina)
        );

        $response->assertOk()->assertSee($turmas[0]->codigo);
    }

    /**
     * @test
     */
    public function it_stores_the_disciplina_turmas()
    {
        $disciplina = Disciplina::factory()->create();
        $data = Turma::factory()
            ->make([
                'disciplina_id' => $disciplina->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.disciplinas.turmas.store', $disciplina),
            $data
        );

        $this->assertDatabaseHas('turma', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $turma = Turma::latest('id')->first();

        $this->assertEquals($disciplina->id, $turma->disciplina_id);
    }
}
