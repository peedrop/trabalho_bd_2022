<?php

namespace App\Http\Controllers\Api;

use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Resources\SalaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalaCollection;
use App\Http\Requests\SalaStoreRequest;
use App\Http\Requests\SalaUpdateRequest;

class SalaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Sala::class);

        $search = $request->get('search', '');

        $salas = Sala::search($search)
            ->latest('id')
            ->paginate();

        return new SalaCollection($salas);
    }

    /**
     * @param \App\Http\Requests\SalaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaStoreRequest $request)
    {
        $this->authorize('create', Sala::class);

        $validated = $request->validated();

        $sala = Sala::create($validated);

        return new SalaResource($sala);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sala $sala)
    {
        $this->authorize('view', $sala);

        return new SalaResource($sala);
    }

    /**
     * @param \App\Http\Requests\SalaUpdateRequest $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function update(SalaUpdateRequest $request, Sala $sala)
    {
        $this->authorize('update', $sala);

        $validated = $request->validated();

        $sala->update($validated);

        return new SalaResource($sala);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sala $sala)
    {
        $this->authorize('delete', $sala);

        $sala->delete();

        return response()->noContent();
    }
}
