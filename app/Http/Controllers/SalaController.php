<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.salas.index', compact('salas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Sala::class);

        return view('app.salas.create');
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

        return redirect()
            ->route('salas.edit', $sala)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sala $sala)
    {
        $this->authorize('view', $sala);

        return view('app.salas.show', compact('sala'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sala $sala)
    {
        $this->authorize('update', $sala);

        return view('app.salas.edit', compact('sala'));
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

        return redirect()
            ->route('salas.edit', $sala)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('salas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
