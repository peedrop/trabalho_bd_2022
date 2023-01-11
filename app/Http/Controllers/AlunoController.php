<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoStoreRequest;
use App\Http\Requests\AlunoUpdateRequest;

class AlunoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Aluno::class);

        $search = $request->get('search', '');

        $alunos = Aluno::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.alunos.index', compact('alunos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Aluno::class);

        return view('app.alunos.create');
    }

    /**
     * @param \App\Http\Requests\AlunoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoStoreRequest $request)
    {
        $this->authorize('create', Aluno::class);

        $validated = $request->validated();

        $aluno = Aluno::create($validated);

        return redirect()
            ->route('alunos.edit', $aluno)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Aluno $aluno)
    {
        $this->authorize('view', $aluno);

        return view('app.alunos.show', compact('aluno'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Aluno $aluno)
    {
        $this->authorize('update', $aluno);

        return view('app.alunos.edit', compact('aluno'));
    }

    /**
     * @param \App\Http\Requests\AlunoUpdateRequest $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(AlunoUpdateRequest $request, Aluno $aluno)
    {
        $this->authorize('update', $aluno);

        $validated = $request->validated();

        $aluno->update($validated);

        return redirect()
            ->route('alunos.edit', $aluno)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Aluno $aluno)
    {
        $this->authorize('delete', $aluno);

        $aluno->delete();

        return redirect()
            ->route('alunos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
