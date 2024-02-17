<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Padron;
use App\Models\Votante;
use Illuminate\Http\Request;

class PadronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //devolver padron paginado con sus distrito y municipio
        $padron = Padron::with('distrito', 'municipio')->paginate(20);
        return response()->json($padron);
        // $padron = Padron::paginate(10);
        // return response()->json($padron);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // guardar en la base de datos
        $data = $request->all();

        // Save the data to the database
        $padron = Padron::create($data);
        return response()->json($padron, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mostrar un solo registro por card_id
        $padron = Padron::where('card_id', $id)->with('distrito', 'municipio')->first();
        //validar que exista el registro
        if (!$padron) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($padron);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // actualizar un solo registro por id
        $padron = Padron::find($id);
        $padron->update($request->all());
        return response()->json($padron);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //borrar el registro en votantes
        $votantesId = Votante::where('padron_id', $id)->pluck('id')->toArray();
        Votante::destroy($votantesId);
        // borrar un solo registro por id
        $padron = Padron::find($id);
        $padron->delete();
        return response()->json(null, 204);
    }
    public function quantityByPadron()
    {
        $padron = Padron::count();
        return response()->json($padron);
    }
    public function getPadron($paginate)
    {
        //valida si viene distrito en la url y filtra por id de distrito que viene en la url
        if (request()->has('distrito')) {
            $padron = Padron::where('distrito_id', request('distrito'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }
        //valida si ciene municipio en la url y filtra por id de munucipio que viene en la url
        if (request()->has('municipio')) {
            $padron = Padron::where('municipio_id', request('municipio'))->with('distrito', 'municipio')->paginate($paginate);
            return response()->json($padron);
        }

        //devolver padron paginado con sus distrito y municipio
        $padron = Padron::with('distrito', 'municipio')->paginate($paginate);

        return response()->json($padron);
        // $padron = Padron::paginate(10);
        // return response()->json($padron);
    }
    public function updateVoto(Request $request)
    {
        $votante = Padron::find($request->id);
        $votante->voto  = $request->voto;
        $votante->save();
        return response()->json($votante);
    }
}
