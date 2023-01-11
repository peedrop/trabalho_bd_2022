<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Turma;
use App\Models\Professor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessorTurmasTest extends TestCase
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
    public function it_gets_professor_turmas()
    {
        $professor = Professor::factory()->create();
        $turmas = Turma::factory()
            ->count(2)
            ->create([
                'professor_id' => $professor->id,
            ]);

        $response = $this->getJson(
            route('api.professors.turmas.index', $professor)
        );

        $response->assertOk()->assertSee($turmas[0]->codigo);
    }

    /**
     * @test
     */
    public function it_stores_the_professor_turmas()
    {
        $professor = Professor::factory()->create();
        $data = Turma::factory()
            ->make([
                'professor_id' => $professor->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.professors.turmas.store', $professor),
            $data
        );

        $this->assertDatabaseHas('turma', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $turma = Turma::latest('id')->first();

        $this->assertEquals($professor->id, $turma->professor_id);
    }
}
