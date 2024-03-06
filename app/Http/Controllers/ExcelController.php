<?php

namespace App\Http\Controllers;

use App\Imports\PadronImport;
use App\Models\Padron;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function formulario()
    {
        return view('subir-archivo');
    }

    public function subir(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('archivo');

        // Obtener los datos del archivo Excel
        $data = Excel::toArray(new PadronImport, $file)[0];

        // Iterar sobre cada fila de datos
        foreach ($data as $row) {
            // Buscar el registro en base a la cedula y actualizar la mesa si existe
            $padron = Padron::where('card_id', $row[0])->first();
            if ($padron) {
                $padron->mesa = $row[1];
                $padron->save();
            }
        }

        return redirect()->route('formulario.subir')->with('success', 'Base de datos actualizada correctamente.');
    }
}
