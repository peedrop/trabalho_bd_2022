<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Reserva;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.reservas.index', compact('reservas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Reserva::class);

        $salas = Sala::pluck('numero', 'id');

        return view('app.reservas.create', compact('salas'));
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

        return redirect()
            ->route('reservas.edit', $reserva)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Reserva $reserva)
    {
        $this->authorize('view', $reserva);

        return view('app.reservas.show', compact('reserva'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $salas = Sala::pluck('numero', 'id');

        return view('app.reservas.edit', compact('reserva', 'salas'));
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

        return redirect()
            ->route('reservas.edit', $reserva)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('reservas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
