<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Professor;
use App\Models\Departamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartamentoProfessorsTest extends TestCase
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
    public function it_gets_departamento_professors()
    {
        $departamento = Departamento::factory()->create();
        $professors = Professor::factory()
            ->count(2)
            ->create([
                'departamento_id' => $departamento->id,
            ]);

        $response = $this->getJson(
            route('api.departamentos.professors.index', $departamento)
        );

        $response->assertOk()->assertSee($professors[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_departamento_professors()
    {
        $departamento = Departamento::factory()->create();
        $data = Professor::factory()
            ->make([
                'departamento_id' => $departamento->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.departamentos.professors.store', $departamento),
            $data
        );

        $this->assertDatabaseHas('professor', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $professor = Professor::latest('id')->first();

        $this->assertEquals($departamento->id, $professor->departamento_id);
    }
}
