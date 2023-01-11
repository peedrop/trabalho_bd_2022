<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Faculdade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaculdadeTest extends TestCase
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
    public function it_gets_faculdades_list()
    {
        $faculdades = Faculdade::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.faculdades.index'));

        $response->assertOk()->assertSee($faculdades[0]->nome);
    }

    /**
     * @test
     */
    public function it_stores_the_faculdade()
    {
        $data = Faculdade::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.faculdades.store'), $data);

        $this->assertDatabaseHas('faculdade', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'endereco' => $this->faker->address,
        ];

        $response = $this->putJson(
            route('api.faculdades.update', $faculdade),
            $data
        );

        $data['id'] = $faculdade->id;

        $this->assertDatabaseHas('faculdade', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_faculdade()
    {
        $faculdade = Faculdade::factory()->create();

        $response = $this->deleteJson(
            route('api.faculdades.destroy', $faculdade)
        );

        $this->assertModelMissing($faculdade);

        $response->assertNoContent();
    }
}
