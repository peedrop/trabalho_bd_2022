<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Aluno;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_alunos()
    {
        $alunos = Aluno::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('alunos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.alunos.index')
            ->assertViewHas('alunos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_aluno()
    {
        $response = $this->get(route('alunos.create'));

        $response->assertOk()->assertViewIs('app.alunos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_aluno()
    {
        $data = Aluno::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('alunos.store'), $data);

        $this->assertDatabaseHas('aluno', $data);

        $aluno = Aluno::latest('id')->first();

        $response->assertRedirect(route('alunos.edit', $aluno));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_aluno()
    {
        $aluno = Aluno::factory()->create();

        $response = $this->get(route('alunos.show', $aluno));

        $response
            ->assertOk()
            ->assertViewIs('app.alunos.show')
            ->assertViewHas('aluno');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_aluno()
    {
        $aluno = Aluno::factory()->create();

        $response = $this->get(route('alunos.edit', $aluno));

        $response
            ->assertOk()
            ->assertViewIs('app.alunos.edit')
            ->assertViewHas('aluno');
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

        $response = $this->put(route('alunos.update', $aluno), $data);

        $data['id'] = $aluno->id;

        $this->assertDatabaseHas('aluno', $data);

        $response->assertRedirect(route('alunos.edit', $aluno));
    }

    /**
     * @test
     */
    public function it_deletes_the_aluno()
    {
        $aluno = Aluno::factory()->create();

        $response = $this->delete(route('alunos.destroy', $aluno));

        $response->assertRedirect(route('alunos.index'));

        $this->assertModelMissing($aluno);
    }
}
