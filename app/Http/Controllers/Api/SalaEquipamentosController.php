<?php

namespace App\Http\Controllers\Api;

use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EquipamentoResource;
use App\Http\Resources\EquipamentoCollection;

class SalaEquipamentosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Sala $sala)
    {
        $this->authorize('view', $sala);

        $search = $request->get('search', '');

        $equipamentos = $sala
            ->equipamentos()
            ->search($search)
            ->latest()
            ->paginate();

        return new EquipamentoCollection($equipamentos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sala $sala)
    {
        $this->authorize('create', Equipamento::class);

        $validated = $request->validate([
            'nome' => ['required', 'max:255', 'string'],
            'num_serie' => ['required', 'max:255', 'string'],
        ]);

        $equipamento = $sala->equipamentos()->create($validated);

        return new EquipamentoResource($equipamento);
    }
}
