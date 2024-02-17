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
        //si viene distrito en la url filtrar por id de distrito que viene en la url del padron
        if (request()->has('distrito')) {
            $votantes = Votante::with('user', 'padron', 'padron.municipio', 'padron.distrito')->whereHas('padron', function ($query) {
                $query->where('distrito_id', request('distrito'));
            })->paginate($qty);
            return response()->json($votantes);
        }
        //si viene municipio en la url filtrar por id de munucipio que viene en la url del padron
        if (request()->has('municipio')) {
            $votantes = Votante::with('user', 'padron', 'padron.municipio', 'padron.distrito')->whereHas('padron', function ($query) {
                $query->where('municipio_id', request('municipio'));
            })->paginate($qty);
            return response()->json($votantes);
        }
        //devolver votantes paginados
        $votantes = Votante::with('user', 'padron', 'padron.municipio', 'padron.distrito')->paginate($qty);
        //filtrar votantes por distrito


        return response()->json($votantes);
    }
    public function getCoordinadores($qty)
    {
        //si viene distrito en la url filtrar por id de distrito que viene en la url
        if (request()->has('distrito')) {
            $coordinadores = User::where('role_id', 2)->where('distrito_id', request('distrito'))->paginate($qty);
            return response()->json($coordinadores);
        }
        //si viene municipio en la url filtrar por id de munucipio que viene en la url
        if (request()->has('municipio')) {
            $coordinadores = User::where('role_id', 2)->where('municipio_id', request('municipio'))->paginate($qty);
            return response()->json($coordinadores);
        }
        //devolver votantes paginados
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
