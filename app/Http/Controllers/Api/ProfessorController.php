<?php

namespace App\Http\Controllers\Api;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessorResource;
use App\Http\Resources\ProfessorCollection;
use App\Http\Requests\ProfessorStoreRequest;
use App\Http\Requests\ProfessorUpdateRequest;

class ProfessorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Professor::class);

        $search = $request->get('search', '');

        $professors = Professor::search($search)
            ->latest('id')
            ->paginate();

        return new ProfessorCollection($professors);
    }

    /**
     * @param \App\Http\Requests\ProfessorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorStoreRequest $request)
    {
        $this->authorize('create', Professor::class);

        $validated = $request->validated();

        $professor = Professor::create($validated);

        return new ProfessorResource($professor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Professor $professor)
    {
        $this->authorize('view', $professor);

        return new ProfessorResource($professor);
    }

    /**
     * @param \App\Http\Requests\ProfessorUpdateRequest $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProfessorUpdateRequest $request,
        Professor $professor
    ) {
        $this->authorize('update', $professor);

        $validated = $request->validated();

        $professor->update($validated);

        return new ProfessorResource($professor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Professor $professor)
    {
        $this->authorize('delete', $professor);

        $professor->delete();

        return response()->noContent();
    }
}
