<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Departamento;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartamentoTest extends TestCase
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
    public function it_gets_departamentos_list()
    {
        $departamentos = Departamento::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.departamentos.index'));

        $response->assertOk()->assertSee($departamentos[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_departamento()
    {
        $data = Departamento::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.departamentos.store'), $data);

        $this->assertDatabaseHas('departamento', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_departamento()
    {
        $departamento = Departamento::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'area' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.departamentos.update', $departamento),
            $data
        );

        $data['id'] = $departamento->id;

        $this->assertDatabaseHas('departamento', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_departamento()
    {
        $departamento = Departamento::factory()->create();

        $response = $this->deleteJson(
            route('api.departamentos.destroy', $departamento)
        );

        $this->assertModelMissing($departamento);

        $response->assertNoContent();
    }
}
