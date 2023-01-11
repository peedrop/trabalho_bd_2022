<?php

namespace App\Http\Controllers\Api;

use App\Models\Faculdade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CursoResource;
use App\Http\Resources\CursoCollection;

class FaculdadeCursosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Faculdade $faculdade)
    {
        $this->authorize('view', $faculdade);

        $search = $request->get('search', '');

        $cursos = $faculdade
            ->cursos()
            ->search($search)
            ->latest()
            ->paginate();

        return new CursoCollection($cursos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faculdade $faculdade)
    {
        $this->authorize('create', Curso::class);

        $validated = $request->validate([
            'nome' => ['required', 'max:255', 'string'],
        ]);

        $curso = $faculdade->cursos()->create($validated);

        return new CursoResource($curso);
    }
}
