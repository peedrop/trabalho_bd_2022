<?php

namespace App\Http\Controllers\Api;

use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservaResource;
use App\Http\Resources\ReservaCollection;

class SalaReservasController extends Controller
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

        $reservas = $sala
            ->reservas()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReservaCollection($reservas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sala $sala
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sala $sala)
    {
        $this->authorize('create', Reserva::class);

        $validated = $request->validate([
            'data' => ['required', 'date'],
        ]);

        $reserva = $sala->reservas()->create($validated);

        return new ReservaResource($reserva);
    }
}
