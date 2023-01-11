<?php

namespace App\Http\Controllers\Api;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartamentoResource;
use App\Http\Resources\DepartamentoCollection;
use App\Http\Requests\DepartamentoStoreRequest;
use App\Http\Requests\DepartamentoUpdateRequest;

class DepartamentoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Departamento::class);

        $search = $request->get('search', '');

        $departamentos = Departamento::search($search)
            ->latest('id')
            ->paginate();

        return new DepartamentoCollection($departamentos);
    }

    /**
     * @param \App\Http\Requests\DepartamentoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoStoreRequest $request)
    {
        $this->authorize('create', Departamento::class);

        $validated = $request->validated();

        $departamento = Departamento::create($validated);

        return new DepartamentoResource($departamento);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Departamento $departamento)
    {
        $this->authorize('view', $departamento);

        return new DepartamentoResource($departamento);
    }

    /**
     * @param \App\Http\Requests\DepartamentoUpdateRequest $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(
        DepartamentoUpdateRequest $request,
        Departamento $departamento
    ) {
        $this->authorize('update', $departamento);

        $validated = $request->validated();

        $departamento->update($validated);

        return new DepartamentoResource($departamento);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Departamento $departamento)
    {
        $this->authorize('delete', $departamento);

        $departamento->delete();

        return response()->noContent();
    }
}
