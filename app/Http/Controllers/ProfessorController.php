<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Models\Departamento;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.professors.index', compact('professors', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Professor::class);

        $departamentos = Departamento::pluck('nome', 'id');

        return view('app.professors.create', compact('departamentos'));
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

        return redirect()
            ->route('professors.edit', $professor)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Professor $professor)
    {
        $this->authorize('view', $professor);

        return view('app.professors.show', compact('professor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Professor $professor)
    {
        $this->authorize('update', $professor);

        $departamentos = Departamento::pluck('nome', 'id');

        return view(
            'app.professors.edit',
            compact('professor', 'departamentos')
        );
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

        return redirect()
            ->route('professors.edit', $professor)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('professors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
