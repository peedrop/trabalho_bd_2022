<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Disciplina;
use App\Models\Departamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartamentoDisciplinasTest extends TestCase
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
    public function it_gets_departamento_disciplinas()
    {
        $departamento = Departamento::factory()->create();
        $disciplinas = Disciplina::factory()
            ->count(2)
            ->create([
                'departamento_id' => $departamento->id,
            ]);

        $response = $this->getJson(
            route('api.departamentos.disciplinas.index', $departamento)
        );

        $response->assertOk()->assertSee($disciplinas[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_departamento_disciplinas()
    {
        $departamento = Departamento::factory()->create();
        $data = Disciplina::factory()
            ->make([
                'departamento_id' => $departamento->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.departamentos.disciplinas.store', $departamento),
            $data
        );

        $this->assertDatabaseHas('disciplina', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $disciplina = Disciplina::latest('id')->first();

        $this->assertEquals($departamento->id, $disciplina->departamento_id);
    }
}
