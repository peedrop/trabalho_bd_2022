<?php

namespace App\Http\Controllers\Api;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisciplinaResource;
use App\Http\Resources\DisciplinaCollection;

class DepartamentoDisciplinasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Departamento $departamento)
    {
        $this->authorize('view', $departamento);

        $search = $request->get('search', '');

        $disciplinas = $departamento
            ->disciplinas()
            ->search($search)
            ->latest()
            ->paginate();

        return new DisciplinaCollection($disciplinas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Departamento $departamento)
    {
        $this->authorize('create', Disciplina::class);

        $validated = $request->validate([
            'curso_id' => ['required', 'exists:curso,id'],
            'nome' => ['required', 'max:255', 'string'],
            'codigo' => ['required', 'max:255', 'string'],
        ]);

        $disciplina = $departamento->disciplinas()->create($validated);

        return new DisciplinaResource($disciplina);
    }
}
