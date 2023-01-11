<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Curso;

use App\Models\Faculdade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursoTest extends TestCase
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
    public function it_gets_cursos_list()
    {
        $cursos = Curso::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.cursos.index'));

        $response->assertOk()->assertSee($cursos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_curso()
    {
        $data = Curso::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.cursos.store'), $data);

        $this->assertDatabaseHas('curso', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.cursos.update', $curso), $data);

        $data['id'] = $curso->id;

        $this->assertDatabaseHas('curso', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_curso()
    {
        $curso = Curso::factory()->create();

        $response = $this->deleteJson(route('api.cursos.destroy', $curso));

        $this->assertModelMissing($curso);

        $response->assertNoContent();
    }
}
