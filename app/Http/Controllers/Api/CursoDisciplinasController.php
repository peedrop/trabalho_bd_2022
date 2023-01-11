<?php

namespace App\Http\Controllers\Api;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisciplinaResource;
use App\Http\Resources\DisciplinaCollection;

class CursoDisciplinasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Curso $curso)
    {
        $this->authorize('view', $curso);

        $search = $request->get('search', '');

        $disciplinas = $curso
            ->disciplinas()
            ->search($search)
            ->latest()
            ->paginate();

        return new DisciplinaCollection($disciplinas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Curso $curso)
    {
        $this->authorize('create', Disciplina::class);

        $validated = $request->validate([
            'departamento_id' => ['required', 'exists:departamento,id'],
            'nome' => ['required', 'max:255', 'string'],
            'codigo' => ['required', 'max:255', 'string'],
        ]);

        $disciplina = $curso->disciplinas()->create($validated);

        return new DisciplinaResource($disciplina);
    }
}
