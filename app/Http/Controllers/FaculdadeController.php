<?php

namespace App\Http\Controllers;

use App\Models\Faculdade;
use Illuminate\Http\Request;
use App\Http\Requests\FaculdadeStoreRequest;
use App\Http\Requests\FaculdadeUpdateRequest;

class FaculdadeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Faculdade::class);

        $search = $request->get('search', '');

        $faculdades = Faculdade::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.faculdades.index', compact('faculdades', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Faculdade::class);

        return view('app.faculdades.create');
    }

    /**
     * @param \App\Http\Requests\FaculdadeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaculdadeStoreRequest $request)
    {
        $this->authorize('create', Faculdade::class);

        $validated = $request->validated();

        $faculdade = Faculdade::create($validated);

        return redirect()
            ->route('faculdades.edit', $faculdade)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Faculdade $faculdade)
    {
        $this->authorize('view', $faculdade);

        return view('app.faculdades.show', compact('faculdade'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Faculdade $faculdade)
    {
        $this->authorize('update', $faculdade);

        return view('app.faculdades.edit', compact('faculdade'));
    }

    /**
     * @param \App\Http\Requests\FaculdadeUpdateRequest $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function update(
        FaculdadeUpdateRequest $request,
        Faculdade $faculdade
    ) {
        $this->authorize('update', $faculdade);

        $validated = $request->validated();

        $faculdade->update($validated);

        return redirect()
            ->route('faculdades.edit', $faculdade)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Faculdade $faculdade)
    {
        $this->authorize('delete', $faculdade);

        $faculdade->delete();

        return redirect()
            ->route('faculdades.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
