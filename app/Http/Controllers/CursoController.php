<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Faculdade;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.cursos.index', compact('cursos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Curso::class);

        $faculdades = Faculdade::pluck('nome', 'id');

        return view('app.cursos.create', compact('faculdades'));
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

        return redirect()
            ->route('cursos.edit', $curso)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Curso $curso)
    {
        $this->authorize('view', $curso);

        return view('app.cursos.show', compact('curso'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Curso $curso)
    {
        $this->authorize('update', $curso);

        $faculdades = Faculdade::pluck('nome', 'id');

        return view('app.cursos.edit', compact('curso', 'faculdades'));
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

        return redirect()
            ->route('cursos.edit', $curso)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('cursos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
