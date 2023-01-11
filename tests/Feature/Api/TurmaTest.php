<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Turma;

use App\Models\Professor;
use App\Models\Disciplina;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TurmaTest extends TestCase
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
    public function it_gets_turmas_list()
    {
        $turmas = Turma::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.turmas.index'));

        $response->assertOk()->assertSee($turmas[0]->codigo);
    }

    /**
     * @test
     */
    public function it_stores_the_turma()
    {
        $data = Turma::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.turmas.store'), $data);

        $this->assertDatabaseHas('turma', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.turmas.update', $turma), $data);

        $data['id'] = $turma->id;

        $this->assertDatabaseHas('turma', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->deleteJson(route('api.turmas.destroy', $turma));

        $this->assertModelMissing($turma);

        $response->assertNoContent();
    }
}
