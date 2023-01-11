<?php

namespace App\Http\Controllers\Api;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlunoResource;
use App\Http\Resources\AlunoCollection;
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
            ->paginate();

        return new AlunoCollection($alunos);
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

        return new AlunoResource($aluno);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Aluno $aluno)
    {
        $this->authorize('view', $aluno);

        return new AlunoResource($aluno);
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

        return new AlunoResource($aluno);
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

        return response()->noContent();
    }
}
