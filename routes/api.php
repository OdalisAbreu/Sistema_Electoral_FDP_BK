<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', 'App\Http\Controllers\Api\LoginController@login');
Route::post('createUser', 'App\Http\Controllers\Api\LoginController@createUser')->middleware('auth:sanctum');

Route::get('getTotalVotantes', 'App\Http\Controllers\API\V1\DashboardController@totalVotantes')->middleware('auth:sanctum');
Route::get('getVotantes/{qty}', 'App\Http\Controllers\API\V1\DashboardController@votantes')->middleware('auth:sanctum');
Route::get('getCoordinadores/{qty}', 'App\Http\Controllers\API\V1\DashboardController@getCoordinadores')->middleware('auth:sanctum');
Route::get('getTotalCoordinadores', 'App\Http\Controllers\API\V1\DashboardController@getTotalCoordinadores')->middleware('auth:sanctum');
