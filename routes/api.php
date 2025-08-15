<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PesosipsController;
use App\Http\Controllers\IPSRegisController;
use App\Http\Controllers\RegistroIPSController;
use App\Http\Controllers\temperaturasController;
use App\Http\Controllers\coloranteController;
use App\Http\Controllers\defectosController;
use App\Http\Controllers\MPController;
use App\Http\Controllers\pesosController;
use App\Http\Controllers\procesosController;
use App\Http\Controllers\PdfMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistroProduccionController;
use App\Http\Controllers\TemperaturaController;



use App\Http\Controllers\ResistenciaController;


use App\Http\Controllers\FormularioGeneralProdController;


Route::prefix('messages')->group(function () {
    Route::post('/', [MessageController::class, 'store']); // Crear mensaje
    Route::get('/', [MessageController::class, 'index']); // Obtener todos los mensajes
    Route::get('/{id}', [MessageController::class, 'show']); // Obtener un mensaje por ID
    //Route::put('/{id}', [MessageController::class, 'update']); // Actualizar un mensaje
    Route::delete('/{id}', [MessageController::class, 'destroy']); // Eliminar un mensaje
     // Nueva ruta para crear mensaje y devolver el ID
    Route::post('/crear', [MessageController::class, 'crearMensaje']);

     // Nueva ruta para actualizar el último mensaje
    Route::put('/Actualizar', [MessageController::class, 'actualizarUltimoMensaje']);
    Route::get('/Ultimo', [MessageController::class, 'obtenerUltimoMensaje']);

 
});

Route::prefix('prueba')->group(function () {
    Route::post('/', [MessageController::class, 'crearMensaje']);
    Route::put('/', [MessageController::class, 'actualizarUltimoMensaje']);
    Route::get('/', [MessageController::class, 'obtenerUltimoMensaje']);
});

Route::prefix('IPS')->group(function () {
    Route::post('/', [IPSRegisController::class, 'crearIPSRegis']);
    Route::put('/', [IPSRegisController::class, 'actualizarUltimoIPSRegis']);
    Route::get('/', [IPSRegisController::class, 'obtenerUltimoIPSRegis']);
});

Route::get('/mensajeprueba', [MessageController::class, 'index']);

Route::prefix('pesosips')->group(function () {
    Route::post('/', [PesosipsController::class, 'store']); // Crear mensaje
    Route::get('/', [PesosipsController::class, 'index']); // Obtener todos los mensajes
    Route::get('/{id}', [PesosipsController::class, 'show']); // Obtener un mensaje por ID
    Route::put('/{id}', [PesosipsController::class, 'update']); // Actualizar un mensaje
    Route::delete('/{id}', [PesosipsController::class, 'destroy']); // Eliminar un mensaje
});
Route::prefix('RegistroIPS')->group(function () {
    Route::post('/', [RegistroIPSController::class, 'crearRegistroIPS']);
    Route::put('/{id}', [RegistroIPSController::class, 'actualizarUltimoRegistroIPS']);
    Route::get('/{id}', [RegistroIPSController::class, 'obtenerUltimoRegistroIPS']);
});

Route::prefix('MPips')->group(function () {
Route::post('/', [MPController::class, 'MandarMP']);
Route::get('/', [MPController::class, 'ObtenerMP']);
});


Route::prefix('coloranteIPS')->group(function () {
Route::post('/', [coloranteController::class, 'Mandarcolorante']);
Route::get('/', [coloranteController::class, 'Obtenercolorante']);
});


Route::prefix('defectosips')->group(function () {
Route::post('/', [defectosController::class, 'Mandardefectos']);
Route::get('/', [defectosController::class, 'Obtenerdefectos']);
});


Route::post('/pesos', [pesosController::class, 'Mandarpesos']);
Route::get('/pesos', [pesosController::class, 'Obtenerpesos']);

Route::prefix('procesIPS')->group(function () {
Route::post('/', [procesosController::class, 'Mandarprocesos']);
Route::get('/', [procesosController::class, 'Obtenerprocesos']);
});

Route::prefix('tempIPS')->group(function () {
Route::post('/', [temperaturasController::class, 'Mandartemperaturas']);
Route::get('/', [temperaturasController::class, 'Obtenertemperaturas']);
});


Route::post('/upload-pdf', [PdfController::class, 'uploadPdf']);
Route::get('/', function () {
    return redirect()->route('pdf-menu');
});

Route::get('/pdf-menu', [PdfMenuController::class, 'index'])->name('pdf-menu');





Route::get('/users', [UserController::class, 'index']);



Route::post('/registro-produccion', [RegistroProduccionController::class, 'store']);


Route::post('formulario-general', [FormularioGeneralProdController::class, 'store']);

Route::post('resistencias', [ResistenciaController::class, 'store']);

Route::post('/temperaturas', [TemperaturaController::class, 'store']);