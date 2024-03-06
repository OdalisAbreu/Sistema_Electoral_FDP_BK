<?php

namespace App\Imports;

use App\Models\Padron;
use Maatwebsite\Excel\Concerns\ToModel;

class PadronImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Padron([
            'card_id' => $row[0], // Asumiendo que la columna 'cedula' es la primera en el archivo Excel
            'mesa' => $row[1], // Asumiendo que la columna 'mesa' es la segunda en el archivo Excel
        ]);
    }
}
