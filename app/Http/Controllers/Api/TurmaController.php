<?php

namespace App\Http\Controllers\Api;

use App\Models\Turma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TurmaResource;
use App\Http\Resources\TurmaCollection;
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
            ->paginate();

        return new TurmaCollection($turmas);
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

        return new TurmaResource($turma);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Turma $turma
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Turma $turma)
    {
        $this->authorize('view', $turma);

        return new TurmaResource($turma);
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

        return new TurmaResource($turma);
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

        return response()->noContent();
    }
}
