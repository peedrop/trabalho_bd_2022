<?php

namespace App\Http\Controllers\Api;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CursoResource;
use App\Http\Resources\CursoCollection;
use App\Http\Requests\CursoStoreRequest;
use App\Http\Requests\CursoUpdateRequest;

class CursoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Curso::class);

        $search = $request->get('search', '');

        $cursos = Curso::search($search)
            ->latest('id')
            ->paginate();

        return new CursoCollection($cursos);
    }

    /**
     * @param \App\Http\Requests\CursoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoStoreRequest $request)
    {
        $this->authorize('create', Curso::class);

        $validated = $request->validated();

        $curso = Curso::create($validated);

        return new CursoResource($curso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Curso $curso)
    {
        $this->authorize('view', $curso);

        return new CursoResource($curso);
    }

    /**
     * @param \App\Http\Requests\CursoUpdateRequest $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function update(CursoUpdateRequest $request, Curso $curso)
    {
        $this->authorize('update', $curso);

        $validated = $request->validated();

        $curso->update($validated);

        return new CursoResource($curso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Curso $curso)
    {
        $this->authorize('delete', $curso);

        $curso->delete();

        return response()->noContent();
    }
}
