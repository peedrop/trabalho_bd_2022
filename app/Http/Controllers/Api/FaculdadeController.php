<?php

namespace App\Http\Controllers\Api;

use App\Models\Faculdade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaculdadeResource;
use App\Http\Resources\FaculdadeCollection;
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
            ->paginate();

        return new FaculdadeCollection($faculdades);
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

        return new FaculdadeResource($faculdade);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faculdade $faculdade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Faculdade $faculdade)
    {
        $this->authorize('view', $faculdade);

        return new FaculdadeResource($faculdade);
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

        return new FaculdadeResource($faculdade);
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

        return response()->noContent();
    }
}
