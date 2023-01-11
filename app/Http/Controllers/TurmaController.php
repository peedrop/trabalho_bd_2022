<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Professor;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Http\Requests\TurmaStoreRequest;
use App\Http\Requests\TurmaUpdateRequest;

class TurmaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Turma::class);

        $search = $request->get('search', '');

        $turmas = Turma::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.turmas.index', compact('turmas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Turma::class);

        $disciplinas = Disciplina::pluck('nome', 'id');
        $professors = Professor::pluck('name', 'id');

        return view('app.turmas.create', compact('disciplinas', 'professors'));
    }

    /**
     * @param \App\Http\Requests\TurmaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaStoreRequest $request)
    {
        $this->authorize('create', Turma::class);

        $validated = $request->validated();

        $turma = Turma::create($validated);

        return redirect()
            ->route('turmas.edit', $turma)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Turma $turma
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Turma $turma)
    {
        $this->authorize('view', $turma);

        return view('app.turmas.show', compact('turma'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Turma $turma
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Turma $turma)
    {
        $this->authorize('update', $turma);

        $disciplinas = Disciplina::pluck('nome', 'id');
        $professors = Professor::pluck('name', 'id');

        return view(
            'app.turmas.edit',
            compact('turma', 'disciplinas', 'professors')
        );
    }

    /**
     * @param \App\Http\Requests\TurmaUpdateRequest $request
     * @param \App\Models\Turma $turma
     * @return \Illuminate\Http\Response
     */
    public function update(TurmaUpdateRequest $request, Turma $turma)
    {
        $this->authorize('update', $turma);

        $validated = $request->validated();

        $turma->update($validated);

        return redirect()
            ->route('turmas.edit', $turma)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Turma $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Turma $turma)
    {
        $this->authorize('delete', $turma);

        $turma->delete();

        return redirect()
            ->route('turmas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
