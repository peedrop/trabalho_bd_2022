<?php

namespace App\Http\Controllers\Api;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TurmaResource;
use App\Http\Resources\TurmaCollection;

class DisciplinaTurmasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Disciplina $disciplina)
    {
        $this->authorize('view', $disciplina);

        $search = $request->get('search', '');

        $turmas = $disciplina
            ->turmas()
            ->search($search)
            ->latest()
            ->paginate();

        return new TurmaCollection($turmas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Disciplina $disciplina)
    {
        $this->authorize('create', Turma::class);

        $validated = $request->validate([
            'professor_id' => ['required', 'exists:professor,id'],
            'codigo' => ['required', 'max:255', 'string'],
        ]);

        $turma = $disciplina->turmas()->create($validated);

        return new TurmaResource($turma);
    }
}
