<?php

namespace App\Http\Controllers\Api;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TurmaResource;
use App\Http\Resources\TurmaCollection;

class ProfessorTurmasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Professor $professor)
    {
        $this->authorize('view', $professor);

        $search = $request->get('search', '');

        $turmas = $professor
            ->turmas()
            ->search($search)
            ->latest()
            ->paginate();

        return new TurmaCollection($turmas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Professor $professor)
    {
        $this->authorize('create', Turma::class);

        $validated = $request->validate([
            'disciplina_id' => ['required', 'exists:disciplina,id'],
            'codigo' => ['required', 'max:255', 'string'],
        ]);

        $turma = $professor->turmas()->create($validated);

        return new TurmaResource($turma);
    }
}
