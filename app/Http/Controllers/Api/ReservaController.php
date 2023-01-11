<?php

namespace App\Http\Controllers\Api;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservaResource;
use App\Http\Resources\ReservaCollection;
use App\Http\Requests\ReservaStoreRequest;
use App\Http\Requests\ReservaUpdateRequest;

class ReservaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Reserva::class);

        $search = $request->get('search', '');

        $reservas = Reserva::search($search)
            ->latest('id')
            ->paginate();

        return new ReservaCollection($reservas);
    }

    /**
     * @param \App\Http\Requests\ReservaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservaStoreRequest $request)
    {
        $this->authorize('create', Reserva::class);

        $validated = $request->validated();

        $reserva = Reserva::create($validated);

        return new ReservaResource($reserva);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Reserva $reserva)
    {
        $this->authorize('view', $reserva);

        return new ReservaResource($reserva);
    }

    /**
     * @param \App\Http\Requests\ReservaUpdateRequest $request
     * @param \App\Models\Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(ReservaUpdateRequest $request, Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $validated = $request->validated();

        $reserva->update($validated);

        return new ReservaResource($reserva);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Reserva $reserva)
    {
        $this->authorize('delete', $reserva);

        $reserva->delete();

        return response()->noContent();
    }
}
