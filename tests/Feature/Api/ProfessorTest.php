<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Professor;

use App\Models\Departamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessorTest extends TestCase
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
    public function it_gets_professors_list()
    {
        $professors = Professor::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.professors.index'));

        $response->assertOk()->assertSee($professors[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_professor()
    {
        $data = Professor::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.professors.store'), $data);

        $this->assertDatabaseHas('professor', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_professor()
    {
        $professor = Professor::factory()->create();

        $departamento = Departamento::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'departamento_id' => $departamento->id,
        ];

        $response = $this->putJson(
            route('api.professors.update', $professor),
            $data
        );

        $data['id'] = $professor->id;

        $this->assertDatabaseHas('professor', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_professor()
    {
        $professor = Professor::factory()->create();

        $response = $this->deleteJson(
            route('api.professors.destroy', $professor)
        );

        $this->assertModelMissing($professor);

        $response->assertNoContent();
    }
}
