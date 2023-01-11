<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.departamentos.index',
            compact('departamentos', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Departamento::class);

        return view('app.departamentos.create');
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

        return redirect()
            ->route('departamentos.edit', $departamento)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Departamento $departamento)
    {
        $this->authorize('view', $departamento);

        return view('app.departamentos.show', compact('departamento'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Departamento $departamento)
    {
        $this->authorize('update', $departamento);

        return view('app.departamentos.edit', compact('departamento'));
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

        return redirect()
            ->route('departamentos.edit', $departamento)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('departamentos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
