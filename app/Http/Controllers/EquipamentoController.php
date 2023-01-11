<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Equipamento;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.equipamentos.index',
            compact('equipamentos', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Equipamento::class);

        $salas = Sala::pluck('numero', 'id');

        return view('app.equipamentos.create', compact('salas'));
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

        return redirect()
            ->route('equipamentos.edit', $equipamento)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipamento $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Equipamento $equipamento)
    {
        $this->authorize('view', $equipamento);

        return view('app.equipamentos.show', compact('equipamento'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipamento $equipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Equipamento $equipamento)
    {
        $this->authorize('update', $equipamento);

        $salas = Sala::pluck('numero', 'id');

        return view('app.equipamentos.edit', compact('equipamento', 'salas'));
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

        return redirect()
            ->route('equipamentos.edit', $equipamento)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('equipamentos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
