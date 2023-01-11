<?php

namespace App\Http\Controllers\Api;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisciplinaResource;
use App\Http\Resources\DisciplinaCollection;
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
            ->paginate();

        return new DisciplinaCollection($disciplinas);
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

        return new DisciplinaResource($disciplina);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Disciplina $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Disciplina $disciplina)
    {
        $this->authorize('view', $disciplina);

        return new DisciplinaResource($disciplina);
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

        return new DisciplinaResource($disciplina);
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

        return response()->noContent();
    }
}
