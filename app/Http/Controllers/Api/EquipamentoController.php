<?php

namespace App\Http\Controllers\Api;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EquipamentoResource;
use App\Http\Resources\EquipamentoCollection;
use App\Http\Requests\EquipamentoStoreRequest;
use App\Http\Requests\EquipamentoUpdateRequest;

class EquipamentoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Equipamento::class);

        $search = $request->get('search', '');

        $equipamentos = Equipamento::search($search)
            ->latest('id')
            ->paginate();

        return new EquipamentoCollection($equipamentos);
    }

    /**
     * @param \App\Http\Requests\EquipamentoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipamentoStoreRequest $request)
    {
        $this->authorize('create', Equipamento::class);

        $validated = $request->validated();

        $equipamento = Equipamento::create($validated);

        return new EquipamentoResource($equipamento);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipamento $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Equipamento $equipamento)
    {
        $this->authorize('view', $equipamento);

        return new EquipamentoResource($equipamento);
    }

    /**
     * @param \App\Http\Requests\EquipamentoUpdateRequest $request
     * @param \App\Models\Equipamento $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(
        EquipamentoUpdateRequest $request,
        Equipamento $equipamento
    ) {
        $this->authorize('update', $equipamento);

        $validated = $request->validated();

        $equipamento->update($validated);

        return new EquipamentoResource($equipamento);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipamento $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Equipamento $equipamento)
    {
        $this->authorize('delete', $equipamento);

        $equipamento->delete();

        return response()->noContent();
    }
}
