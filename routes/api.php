<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', 'App\Http\Controllers\Api\LoginController@login');
Route::post('createUser', 'App\Http\Controllers\Api\LoginController@createUser')->middleware('auth:sanctum');
Route::post('updateUser', 'App\Http\Controllers\Api\LoginController@updateUser')->middleware('auth:sanctum');
Route::post('updatePassword', 'App\Http\Controllers\Api\LoginController@updatePassword')->middleware('auth:sanctum');

Route::get('getTotalVotantes', 'App\Http\Controllers\Api\V1\DashboardController@totalVotantes')->middleware('auth:sanctum');
Route::get('getVotantes/{qty}', 'App\Http\Controllers\Api\V1\DashboardController@votantes')->middleware('auth:sanctum');
Route::get('getCoordinadores/{qty}', 'App\Http\Controllers\Api\V1\DashboardController@getCoordinadores')->middleware('auth:sanctum');
Route::get('getTotalCoordinadores', 'App\Http\Controllers\Api\V1\DashboardController@getTotalCoordinadores')->middleware('auth:sanctum');
Route::resource('padron', 'App\Http\Controllers\Api\V1\PadronController')->middleware('auth:sanctum');
Route::get('getQuantityByPadron', 'App\Http\Controllers\Api\V1\PadronController@quantityByPadron')->middleware('auth:sanctum');
Route::get('getPadron/{qty}', 'App\Http\Controllers\Api\V1\PadronController@getPadron')->middleware('auth:sanctum');
Route::get('getDetailPadron', 'App\Http\Controllers\Api\V1\PadronController@getQtyPadron')->middleware('auth:sanctum');
Route::resource('votantes', 'App\Http\Controllers\Api\V1\VotantesController')->only(['store', 'destroy'])->middleware('auth:sanctum');
Route::get('getVotantesPorUser/{id}', 'App\Http\Controllers\Api\V1\VotantesController@getVotantesPorUser')->middleware('auth:sanctum');
Route::resource('municipios', 'App\Http\Controllers\Api\V1\MunicipiosController')->only(['index'])->middleware('auth:sanctum');
Route::resource('distritos', 'App\Http\Controllers\Api\V1\DistritosController')->only(['index'])->middleware('auth:sanctum');
Route::post('getQtyVotantesByDate', 'App\Http\Controllers\Api\V1\VotantesController@getQtyVotantesByDate')->middleware('auth:sanctum');
Route::post('updateVoto', 'App\Http\Controllers\Api\V1\PadronController@updateVoto')->middleware('auth:sanctum');
