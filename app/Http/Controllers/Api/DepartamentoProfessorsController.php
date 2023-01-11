<?php

namespace App\Http\Controllers\Api;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessorResource;
use App\Http\Resources\ProfessorCollection;

class DepartamentoProfessorsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Departamento $departamento)
    {
        $this->authorize('view', $departamento);

        $search = $request->get('search', '');

        $professors = $departamento
            ->professors()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProfessorCollection($professors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Departamento $departamento)
    {
        $this->authorize('create', Professor::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $professor = $departamento->professors()->create($validated);

        return new ProfessorResource($professor);
    }
}
