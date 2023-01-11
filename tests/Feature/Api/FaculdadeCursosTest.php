<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Curso;
use App\Models\Faculdade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaculdadeCursosTest extends TestCase
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
    public function it_gets_faculdade_cursos()
    {
        $faculdade = Faculdade::factory()->create();
        $cursos = Curso::factory()
            ->count(2)
            ->create([
                'faculdade_id' => $faculdade->id,
            ]);

        $response = $this->getJson(
            route('api.faculdades.cursos.index', $faculdade)
        );

        $response->assertOk()->assertSee($cursos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_faculdade_cursos()
    {
        $faculdade = Faculdade::factory()->create();
        $data = Curso::factory()
            ->make([
                'faculdade_id' => $faculdade->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.faculdades.cursos.store', $faculdade),
            $data
        );

        $this->assertDatabaseHas('curso', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $curso = Curso::latest('id')->first();

        $this->assertEquals($faculdade->id, $curso->faculdade_id);
    }
}
