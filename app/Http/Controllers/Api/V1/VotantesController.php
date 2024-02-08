<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Votante;
use App\Services\VotantesServices;
use Illuminate\Http\Request;

class VotantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $votantesServices = new VotantesServices();
        $votante = $votantesServices->saveVotantes($request->padron_id, $request->user_id);
        return $votante;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // actualizar un solo registro por id

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // borrar un solo registro por id
        $votante = Votante::find($id);
        $votante->delete();
        return response()->json(null, 204);
    }
    public function getVotantesPorUser($id)
    {
        $votantes = Votante::where('user_id', $id)->with('user', 'padron', 'padron.municipio', 'padron.distrito')->get();
        return response()->json($votantes);
    }

    public function getQtyVotantesByDate(Request $request)
    {
        $votantes = Votante::whereBetween('created_at', [$request->fechaDesde, $request->fechaHasta])->count();
        return response()->json($votantes);
    }
}
