<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Http\Requests\DisciplinaStoreRequest;
use App\Http\Requests\DisciplinaUpdateRequest;

class DisciplinaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Disciplina::class);

        $search = $request->get('search', '');

        $disciplinas = Disciplina::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.disciplinas.index', compact('disciplinas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Disciplina::class);

        $cursos = Curso::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');

        return view(
            'app.disciplinas.create',
            compact('cursos', 'departamentos')
        );
    }

    /**
     * @param \App\Http\Requests\DisciplinaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplinaStoreRequest $request)
    {
        $this->authorize('create', Disciplina::class);

        $validated = $request->validated();

        $disciplina = Disciplina::create($validated);

        return redirect()
            ->route('disciplinas.edit', $disciplina)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Disciplina $disciplina)
    {
        $this->authorize('view', $disciplina);

        return view('app.disciplinas.show', compact('disciplina'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Disciplina $disciplina)
    {
        $this->authorize('update', $disciplina);

        $cursos = Curso::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');

        return view(
            'app.disciplinas.edit',
            compact('disciplina', 'cursos', 'departamentos')
        );
    }

    /**
     * @param \App\Http\Requests\DisciplinaUpdateRequest $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(
        DisciplinaUpdateRequest $request,
        Disciplina $disciplina
    ) {
        $this->authorize('update', $disciplina);

        $validated = $request->validated();

        $disciplina->update($validated);

        return redirect()
            ->route('disciplinas.edit', $disciplina)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Disciplina $disciplina)
    {
        $this->authorize('delete', $disciplina);

        $disciplina->delete();

        return redirect()
            ->route('disciplinas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
