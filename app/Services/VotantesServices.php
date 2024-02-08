<?php

namespace App\Services;

use App\Models\Votante;

class VotantesServices
{
    public function saveVotantes($padron_id, $user_id)
    {
        if ($this->validateVotanteExists($padron_id)) {
            return response()->json([
                'message' => 'El votante ya esta registrado',
                'status_id' => 2
            ], 422);
        }
        if (!$this->valiadaCantidadVotantesPorUsuario($user_id)) {
            // retorna un error 422 inidicando que el usuario ya tiene el maximo de votantes
            return response()->json([
                'message' => 'El usuario ya tiene el maximo de votantes',
                'status_id' => 1
            ], 422);
        };
        Votante::create([
            'padron_id' => $padron_id,
            'user_id' => $user_id

        ]);
    }
    public function valiadaCantidadVotantesPorUsuario($user_id)
    {
        $quantity = Votante::where('user_id', $user_id)->count();
        if ($quantity > 15) {
            return false;
        }
        return true;
    }
    public function validateVotanteExists($padron_id)
    {
        $votante = Votante::where('padron_id', $padron_id)->first();
        if ($votante) {
            return true;
        }
        return false;
    }
}
