<?php

use App\Http\Controllers\ParametrosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\RegistroPdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/registros', [RegistroController::class, 'obtenerDatos'])->name('registro');
Route::get('/registros/pdf/{id}/{auxiliar?}', [RegistroPdfController::class, 'generarPdf'])
     ->name('registros.pdf')
     ->where('id', '[0-9]+');

Route::prefix('parametros')->group(function () {
    Route::get('/', [ParametrosController::class, 'index'])->name('parametros.index');
    Route::post('/save', [ParametrosController::class, 'save'])->name('parametros.save');
});
