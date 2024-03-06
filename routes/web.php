<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/subir-archivo', [ExcelController::class, 'formulario'])->name('formulario.subir');
Route::post('/subir-archivo', [ExcelController::class, 'subir'])->name('subir.archivo');
