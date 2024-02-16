<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Votante;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //devolver la cantidad total de votantes API
    public function totalVotantes()
    {
        $totalVotantes = Votante::count();
        return response()->json(['totalVotantes' => $totalVotantes]);
    }
    //Devolver detalle de vontantes API paginados
    public function votantes($qty)
    {
        $qty = $qty + 1;
        $votantes = Votante::with('user', 'padron', 'padron.municipio', 'padron.distrito')->paginate($qty);
        return response()->json($votantes);
    }
    public function getCoordinadores($qty)
    {
        $qty = $qty + 1;
        $coordinadores = User::where('role_id', 2)->paginate($qty);
        //agregar cantidad de votantes por coordinador
        foreach ($coordinadores as $coordinador) {
            $coordinador->votantes = Votante::where('user_id', $coordinador->id)->count();
        }
        return response()->json($coordinadores);
    }
    public function getTotalCoordinadores()
    {
        $totalCoordinadores = User::where('role_id', 2)->count();
        return response()->json(['totalCoordinadores' => $totalCoordinadores]);
    }
}
