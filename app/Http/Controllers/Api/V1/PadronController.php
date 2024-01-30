<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Padron;
use Illuminate\Http\Request;

class PadronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //devolver padron apginados
        $padron = Padron::paginate(10);
        return response()->json($padron);
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
        $padron = Padron::where('card_id', $id)->first();
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
        // borrar un solo registro por id
        $padron = Padron::find($id);
        $padron->delete();
        return response()->json(null, 204);
    }
}
