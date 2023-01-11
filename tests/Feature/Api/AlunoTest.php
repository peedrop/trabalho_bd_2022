<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Aluno;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoTest extends TestCase
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
    public function it_gets_alunos_list()
    {
        $alunos = Aluno::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.alunos.index'));

        $response->assertOk()->assertSee($alunos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_aluno()
    {
        $data = Aluno::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.alunos.store'), $data);

        $this->assertDatabaseHas('aluno', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_aluno()
    {
        $aluno = Aluno::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->email,
            'data_nascimento' => $this->faker->date,
            'cpf' => $this->faker->cpf(false),
        ];

        $response = $this->putJson(route('api.alunos.update', $aluno), $data);

        $data['id'] = $aluno->id;

        $this->assertDatabaseHas('aluno', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_aluno()
    {
        $aluno = Aluno::factory()->create();

        $response = $this->deleteJson(route('api.alunos.destroy', $aluno));

        $this->assertModelMissing($aluno);

        $response->assertNoContent();
    }
}
