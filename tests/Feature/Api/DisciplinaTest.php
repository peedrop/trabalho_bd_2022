<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Disciplina;

use App\Models\Curso;
use App\Models\Departamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisciplinaTest extends TestCase
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
    public function it_gets_disciplinas_list()
    {
        $disciplinas = Disciplina::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.disciplinas.index'));

        $response->assertOk()->assertSee($disciplinas[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_disciplina()
    {
        $data = Disciplina::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.disciplinas.store'), $data);

        $this->assertDatabaseHas('disciplina', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.disciplinas.update', $disciplina),
            $data
        );

        $data['id'] = $disciplina->id;

        $this->assertDatabaseHas('disciplina', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $response = $this->deleteJson(
            route('api.disciplinas.destroy', $disciplina)
        );

        $this->assertModelMissing($disciplina);

        $response->assertNoContent();
    }
}
